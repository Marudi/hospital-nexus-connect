<?php namespace App\Controllers;

/**
 * PatientController Class
 * 
 * Handles patient data with HIPAA-compliant audit logging
 */
class PatientController extends BaseController {
    protected $patientModel;
    protected $auditLogger;
    
    public function __construct() {
        $this->patientModel = new \App\Models\PatientModel();
        $this->auditLogger = new \App\Libraries\AuditLogger();
    }
    
    /**
     * Show list of patients with minimal PHI
     */
    public function index() {
        // Log the access attempt
        $this->auditLogger->log('patient_list_access', 'all', [
            'access_type' => 'list',
            'department' => session()->get('department')
        ]);
        
        $data['patients'] = $this->patientModel->findAll();
        return view('patients/index', $data);
    }
    
    /**
     * View detailed patient information (PHI)
     */
    public function view($patientId) {
        // Log the access attempt before permissions check
        $this->auditLogger->log('patient_record_access_attempt', $patientId);
        
        // Check if user has permission
        if (!$this->hasAccessPermission($patientId)) {
            $this->auditLogger->log('access_denied', $patientId, [
                'reason' => 'insufficient_permissions'
            ]);
            return redirect()->to('/unauthorized');
        }
        
        // Log successful access
        $this->auditLogger->log('patient_record_access', $patientId, [
            'access_type' => 'view',
            'department' => session()->get('department')
        ]);
        
        $data['patient'] = $this->patientModel->find($patientId);
        return view('patients/view', $data);
    }
    
    /**
     * Update patient information
     */
    public function update($patientId) {
        // Log the access attempt before permissions check
        $this->auditLogger->log('patient_record_update_attempt', $patientId);
        
        // Check if user has permission
        if (!$this->hasUpdatePermission($patientId)) {
            $this->auditLogger->log('update_denied', $patientId, [
                'reason' => 'insufficient_permissions'
            ]);
            return redirect()->to('/unauthorized');
        }
        
        if ($this->request->getMethod() === 'post') {
            // Validate input
            $rules = [
                'name' => 'required|min_length[3]|max_length[100]',
                'dob' => 'required|valid_date',
                'email' => 'permit_empty|valid_email|max_length[100]',
                'phone' => 'required|min_length[10]|max_length[15]',
                'address' => 'required|min_length[5]|max_length[255]'
            ];
            
            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }
            
            // Prepare data
            $data = [
                'name' => $this->request->getPost('name'),
                'dob' => $this->request->getPost('dob'),
                'email' => $this->request->getPost('email'),
                'phone' => $this->request->getPost('phone'),
                'address' => $this->request->getPost('address')
            ];
            
            // Record before state for audit
            $patientBefore = $this->patientModel->find($patientId);
            
            // Update the record
            $this->patientModel->update($patientId, $data);
            
            // Log the update with changes
            $changes = $this->getChanges($patientBefore, $data);
            $this->auditLogger->log('patient_record_updated', $patientId, [
                'changes' => $changes,
                'department' => session()->get('department')
            ]);
            
            return redirect()->to('/patients/view/' . $patientId)->with('message', 'Patient updated successfully');
        }
        
        $data['patient'] = $this->patientModel->find($patientId);
        return view('patients/edit', $data);
    }
    
    /**
     * Create new patient record
     */
    public function create() {
        // Log the access attempt
        $this->auditLogger->log('patient_record_create_attempt', 'new');
        
        if ($this->request->getMethod() === 'post') {
            // Validate input
            $rules = [
                'name' => 'required|min_length[3]|max_length[100]',
                'dob' => 'required|valid_date',
                'email' => 'permit_empty|valid_email|max_length[100]',
                'phone' => 'required|min_length[10]|max_length[15]',
                'address' => 'required|min_length[5]|max_length[255]'
            ];
            
            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }
            
            // Prepare data
            $data = [
                'name' => $this->request->getPost('name'),
                'dob' => $this->request->getPost('dob'),
                'email' => $this->request->getPost('email'),
                'phone' => $this->request->getPost('phone'),
                'address' => $this->request->getPost('address')
            ];
            
            // Create the record
            $patientId = $this->patientModel->insert($data);
            
            // Log the creation
            $this->auditLogger->log('patient_record_created', $patientId, [
                'data' => $data,
                'department' => session()->get('department')
            ]);
            
            return redirect()->to('/patients')->with('message', 'Patient created successfully');
        }
        
        return view('patients/create');
    }
    
    /**
     * Emergency access to patient record (break-glass)
     */
    public function emergencyAccess($patientId) {
        // Validate input
        $validationRules = [
            'reason' => 'required|min_length[10]',
            'emergency_code' => 'required'
        ];
        
        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        // Log emergency access with detailed reason
        $this->auditLogger->log('emergency_access', $patientId, [
            'reason' => $this->request->getPost('reason'),
            'emergency_code' => $this->request->getPost('emergency_code'),
            'supervisor_notified' => true
        ]);
        
        // Alert supervisor via email/SMS
        $this->notificationService->alertSupervisor(
            session()->get('user_id'),
            $patientId,
            $this->request->getPost('reason')
        );
        
        // Grant temporary access
        session()->set('emergency_access_' . $patientId, time() + 3600);
        
        return redirect()->to('/patients/view/' . $patientId);
    }
    
    /**
     * Check if the current user has access permission for a patient
     */
    protected function hasAccessPermission($patientId) {
        // Example permission check - replace with actual logic
        // This could check if the patient is assigned to this doctor, 
        // if user is in the right department, etc.
        $user = session()->get('user');
        
        // Allow emergency access if it's been granted
        if (session()->has('emergency_access_' . $patientId)) {
            $expires = session()->get('emergency_access_' . $patientId);
            if (time() < $expires) {
                return true;
            } else {
                session()->remove('emergency_access_' . $patientId);
            }
        }
        
        // Implement your actual permission logic here
        return true;
    }
    
    /**
     * Check if the current user has update permission for a patient
     */
    protected function hasUpdatePermission($patientId) {
        // More restrictive than view permission
        // Example permission check - replace with actual logic
        $user = session()->get('user');
        
        // Implement your actual permission logic here
        return true;
    }
    
    /**
     * Get changes between old and new data
     */
    protected function getChanges($oldData, $newData) {
        $changes = [];
        foreach ($newData as $key => $value) {
            if (isset($oldData[$key]) && $oldData[$key] !== $value) {
                $changes[$key] = [
                    'old' => $oldData[$key],
                    'new' => $value
                ];
            }
        }
        return $changes;
    }
} 
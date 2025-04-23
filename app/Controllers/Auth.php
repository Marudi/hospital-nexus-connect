<?php

namespace App\Controllers;

use App\Libraries\AuditLogger;
use App\Services\SecurityMonitoringService;

class Auth extends BaseController
{
    public function login() {
        $auditLogger = new \App\Libraries\AuditLogger();
        
        if ($this->request->getMethod() === 'post') {
            $rules = [
                'username' => 'required',
                'password' => 'required'
            ];
            
            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }
            
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');
            
            $userModel = new \App\Models\UserModel();
            $user = $userModel->where('username', $username)->first();
            
            if ($user && password_verify($password, $user['password'])) {
                // Log successful login
                $auditLogger->log('login_success', 'auth', [
                    'username' => $username,
                    'user_id' => $user['id']
                ]);
                
                // Create session
                $this->setUserSession($user);
                
                // Check for suspicious activity
                $securityService = new \App\Services\SecurityMonitoringService();
                $securityService->checkForSuspiciousActivity($user['id']);
                
                return redirect()->to('/dashboard');
            } else {
                // Log failed login attempt
                $auditLogger->log('login_failure', 'auth', [
                    'username' => $username,
                    'reason' => 'invalid_credentials'
                ]);
                
                return redirect()->back()->with('error', 'Invalid login credentials');
            }
        }
        
        return view('auth/login');
    }

    public function logout() {
        // Log logout
        $auditLogger = new \App\Libraries\AuditLogger();
        $auditLogger->log('logout', 'auth', [
            'user_id' => session()->get('user_id')
        ]);
        
        // Destroy session
        session()->destroy();
        
        return redirect()->to('/login');
    }
} 
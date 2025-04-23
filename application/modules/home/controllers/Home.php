<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('finance/finance_model');
        $this->load->model('appointment/appointment_model');
        $this->load->model('notice/notice_model');
        $this->load->model('logs/logs_model');
        $this->load->model('home_model');
        $this->load->model('finance/pharmacy_model');
        $this->load->model('doctor/doctor_model');
        $this->load->model('patient/patient_model'); 
    }
    public function test(){
        $this->load->view('dashboard'); // just the header file
        $this->load->view('feedback');
        $this->load->view('footer');
    }

    public function index() {
        $data = array();

        if (!$this->ion_auth->in_group(array('superadmin'))) {

            $date = date('d-m-Y');
            $clock_in = date('h:i A');
            $clock_out = "";
            $late = "";
            $halfday = "";
            $work_from = "";
            $details = array();
            $month = date('F', strtotime($date));
            $year = date('Y', strtotime($date));
            $day = explode('-', $date);

            $result = $this->db->get_where('attendance', array('staff' => $this->ion_auth->user()->row()->id, 'month' => $month, 'year' => $year))->row();
            if (!empty($result->details)) {
                $details = explode('#', $result->details);

                $detail = explode('_', $details[$day[0] - 1]);
            }

            $finalDetail = ($clock_in != '' ? $clock_in : 'NONE') . '_' . ($clock_out != '' ? $clock_out : 'NONE') . '_' . ($late == 'late' ? $late : 'NONE') . '_' . ($halfday == 'halfday' ? $halfday : 'NONE') . '_' . ($work_from == '' ? 'office' : $work_from);

            $details[$day[0] - 1] = $finalDetail;

            $detail = implode('#', $details);
            if (!empty($result->log)) {
                $logs = explode("_", $result->log);
                $checkAdded = "";

                if ($clock_in != '') {
                    $checkAdded = $logs[$day[0] - 1];
                    $logs[$day[0] - 1] = 'yes';
                }

                $log = implode('_', $logs);
            } else {
                $log = '';
                $checkAdded = '';
            }


            $data = array(
                'log' => $log,
                'details' => $detail
            );
            if (!empty($result->id)) {
                if ($checkAdded != 'yes') {
                    $this->db->where('id', $result->id);
                    $this->db->update('attendance', $data);
                }
            }

            $data['sum'] = $this->home_model->getSum('gross_total', 'payment');
            $data['payments'] = $this->finance_model->getPayment();
            $data['notices'] = $this->notice_model->getNotice();
            $data['this_month'] = $this->finance_model->getThisMonth();
           
            $data['expenses'] = $this->finance_model->getExpense();

            if ($this->ion_auth->in_group(array('Doctor'))) {
                redirect('doctor/details');
            } else {
                $data['appointments'] = $this->appointment_model->getAppointment();
            }

            if ($this->ion_auth->in_group(array('Accountant', 'Receptionist'))) {
                redirect('finance/addPaymentView');
            }

            if ($this->ion_auth->in_group(array('Pharmacist'))) {
                redirect('finance/pharmacy/home');
            }

            if ($this->ion_auth->in_group(array('Patient'))) {
                redirect('patient/medicalHistory');
            }
            if ($this->ion_auth->in_group(array('Laboratorist'))) {
                redirect('lab');
            }


            if (!$this->ion_auth->in_group(array('Patient', 'Pharmacist', 'Accountant', 'Receptionist', 'Doctor'))) {
                $data['this_month']['payment'] = $this->finance_model->thisMonthPayment();
                $data['this_month']['expense'] = $this->finance_model->thisMonthExpense();
                $data['this_month']['appointment'] = $this->finance_model->thisMonthAppointment();

                $data['this_day']['payment'] = $this->finance_model->thisDayPayment();
                $data['this_day']['expense'] = $this->finance_model->thisDayExpense();
                $data['this_day']['appointment'] = $this->finance_model->thisDayAppointment();
                $data['paymentda']=$this->finance_model->getThisMonthPayments();
                
                $data['logs_useraccess']=$this->logs_model->getThisLogsTodays();
                $data['expenseda']=$this->finance_model->getThisMonthExpense();
                $data['this_year']['payment'] = $this->finance_model->thisYearPayment();
                $data['this_year']['expense'] = $this->finance_model->thisYearExpense();
                $data['this_year']['appointment'] = $this->finance_model->thisYearAppointment();

                $data['this_month']['appointment'] = $this->finance_model->thisMonthAppointment();
                $data['this_month']['appointment_treated'] = $this->finance_model->thisMonthAppointmentTreated();
                $data['this_month']['appointment_cancelled'] = $this->finance_model->thisMonthAppointmentCancelled();

                $data['this_year']['payment_per_month'] = $this->finance_model->getPaymentPerMonthThisYear();

                $data['this_year']['expense_per_month'] = $this->finance_model->getExpensePerMonthThisYear();
                $data['settings'] = $this->settings_model->getSettings();
                $data['transaction_logs']=$this->home_model->getTransactionLogs();
                $data['salesbycategory']['appointment']=$this->finance_model->thisYearPaymentByCategory('appointment');
                $data['salesbycategory']['bed']=$this->finance_model->thisYearPaymentByCategory('admitted_patient_bed_medicine');
                $data['salesbycategory']['payment']=$this->finance_model->thisYearPaymentByCategory('payment');
                $data['salesbycategory']['pharmacy']=$this->pharmacy_model->thisYearPaymentByCategory();
                $data['salesbycategory']['total']=array_sum($data['salesbycategory']);
                $tes='';
                foreach($data['transaction_logs'] as $logs){
                    $time_diff = time()-strtotime($logs->date_time) ;
                    $days = floor($time_diff / (60 * 60 * 24));

                    if ($days <= 0) {
                        // Calculate hours
                        $hours = floor($time_diff / (60 * 60));
                        $h= $hours . ' hours ago';
                    } else {
                        $h= $days . ' days ago';
                    }

                        $tes .= '<li class="feed-item">
                        <div class="d-flex justify-content-between feed-item-list">
                            <div>
                                <h5 class="font-size-15 mb-1">'.$this->finance_model->getPaymentById($logs->invoice_id)->payment_from .'</h5>
                                <p class="text-muted mt-0 mb-0">'.$logs->patientname.'<br>'.$data['settings']->currency.' '.number_format($logs->amount,2, '.', ',').'</p>
                            </div>
                            <div>
                                <p class="text-muted mb-0">'.$h.'</p>
                            </div>
                        </div>
                    </li>';
                
                }
                $data['options_log']=$tes;
               
                $data['login_logs']=$this->logs_model->frequentLogin();

                $data['sub']['appointment']=$this->finance_model->thismonthPaymentByCategory('appointment');
                $data['sub']['bed']=$this->finance_model->thismonthPaymentByCategory('admitted_patient_bed_medicine');
                $data['sub']['payment']=$this->finance_model->thismonthPaymentByCategory('payment');
                $data['sub']['pharmacy']=$this->pharmacy_model->thismonthPaymentByCategory();
                $data['patients'] = $this->patient_model->getPatient();
                $data['doctors'] = $this->doctor_model->getDoctor();
                // $data['payments'] = $this->finance_model->getPaymentByDate($date_from, $date_to);
                $this->load->view('dashboard'); // just the header file
                $this->load->view('home', $data);
                $this->load->view('footer', $data);
            }
        } else {
            $data['hospitals'] = $this->hospital_model->getHospital();
            $data['this_month']['payment'] = $this->hospital_model->thisMonthlyDepositCount();
            $data['this_yearly']['payment'] = $this->hospital_model->thisYearlyDepositCount();
            $data['this_year']['payment_per_month'] = $this->hospital_model->getPaymentPerMonthThisYear();
            $data['this_monthly']['payment'] = $this->hospital_model->thisMonthlyDeposit();
            $data['this_year']['payment'] = $this->hospital_model->thisYearlyDeposit();
            $data['this_day']['payment'] = $this->hospital_model->thisDayMonthlyPayment();
            $data['this_day']['payment_yearly'] = $this->hospital_model->thisDayYearlyPayment();
            $data['this_year_payment']['payment'] = $this->hospital_model->thisYearYearlyPayment();
            $data['this_month_payment']['payment'] = $this->hospital_model->thisYearMonthlyPayment();
            $data['hospitals'] = $this->hospital_model->getHospital();
            $data['settings'] = $this->settings_model->getSettings();


           
            // $data['packages'] = $this->package_model->getPackage();
           
            // $data['gateway'] = $this->db->get_where('paymentGateway', array('name' => $data['settings']->payment_gateway, 'hospital_id' => 'superadmin'))->row();
            $this->load->view('dashboard'); // just the header file
            $this->load->view('home', $data);
            $this->load->view('footer');
        }
    }

    public function permission() {
        $this->load->view('permission');
    }
     public function navBarColor(){
        $color=$this->input->get('color');
        $user=$this->ion_auth->get_user_id();
      
        $update=$this->db->where('id', $user)->update('users',array('color'=>$color));

        echo json_encode($update);
    }

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */

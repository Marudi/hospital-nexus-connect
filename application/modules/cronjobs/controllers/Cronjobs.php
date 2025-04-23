<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
use Twilio\Rest\Client;
class Cronjobs extends MX_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('cronjobs_model');
        $this->load->model('email/email_model');
        $this->load->model('doctor/doctor_model');
        $this->load->model('patient/patient_model');
    }

    public function index() {
        
    }

    public function appointmentRemainder() {
        $settings_superadmin = $this->cronjobs_model->getSettings('superadmin');
        $num_of_hours = $settings_superadmin->remainder_appointment;
        
        if (!empty($num_of_hours)) {
            $time = strtotime(date('d-m-Y'));

            $appointment_details = $this->cronjobs_model->getAppointment($time);
           
            if (!empty($appointment_details)) {
                foreach ($appointment_details as $appointment) {
                    $date = date('d-m-Y', $appointment->date) . ' ' . $appointment->s_time;
                   
                    $date_stamp = strtotime($date);
                    if($appointment->cron_job !='1' || empty($appointment->cron_job)){
                     
                    if (($date_stamp - time()) <= ($num_of_hours * 3600) && $date_stamp > time()) {
                        $hospital_id = $appointment->hospital_id;
                     
                        $settings = $this->cronjobs_model->getSettings($hospital_id);

                        $autosms = $this->cronjobs_model->getAutoSmsByType($hospital_id, 'appoinment_remainder');
                        $autoemail = $this->cronjobs_model->getAutoEmailByType($hospital_id, 'appoinment_remainder');
                        $hospital_id = $appointment->hospital_id;
                        $patientdetails = $this->cronjobs_model->getPatientById($hospital_id,$appointment->patient);
                        $doctordetails = $this->cronjobs_model->getDoctorById($hospital_id,$appointment->doctor);

                        $message = $autosms->message;
                        $to = $patientdetails->phone;
                        $name1 = explode(' ', $patientdetails->name);
                        if (!isset($name1[1])) {
                            $name1[1] = null;
                        }
                        $data1 = array(
                            'firstname' => $name1[0],
                            'lastname' => $name1[1],
                            'name' => $patientdetails->name,
                            'doctorname' => $doctordetails->name,
                            'appoinmentdate' => date('d-m-Y', $appointment->date),
                            'time_slot' => $appointment->time_slot,
                            'hospital_name' => $settings->system_vendor
                        );
                        if ($autosms->status == 'Active') {
                            $messageprint = $this->parser->parse_string($message, $data1);

                            $data2[] = array($to => $messageprint);
                            $data_ret=$this->sendSms($hospital_id, $data2);
                        }

                        if ($autoemail->status == 'Active') {
                            $mail_provider = $this->cronjobs_model->getSettings($hospital_id)->emailtype;
                            $settngs_name = $this->cronjobs_model->getSettings($hospital_id)->system_vendor;
                            $email_Settings = $this->cronjobs_model->getEmailSettingsByType($hospital_id,$mail_provider);
                            
                            $message1 = $autoemail->message;
                            $messageprint1 = $this->parser->parse_string($message1, $data1);
                            if ($mail_provider == 'Smtp') {
                                $config['protocol'] = 'smtp';
                                $config['mailpath'] = '/usr/sbin/sendmail';
                                $config['smtp_host'] = $email_Settings->smtp_host;
                                $config['smtp_port'] = number_format($email_Settings->smtp_port);
                                $config['smtp_user'] = $email_Settings->user;
                                $config['smtp_pass'] = base64_decode($email_Settings->password);
                                $config['smtp_crypto'] = 'tls';
                                $config['mailtype'] = 'html';
                                $config['charset'] = 'utf-8';
                                $config['wordwrap'] = TRUE;
                                $config['send_multipart'] = TRUE;
                                $config['newline'] = "\r\n";
                                $this->load->library('email');
                                $this->email->initialize($config);
                                $this->load->library('email');
                            } else {
                                $this->load->library('email');
                            }
                            if ($mail_provider == 'Domain Email') {
                                $this->email->from($email_Settings->admin_email);
                            }
                            if ($mail_provider == 'Smtp') {
                                $this->email->from($email_Settings->user, $settngs_name);
                            }
                            $this->email->to($patientdetails->email);
                            $this->email->subject(lang('appointment_remainder'));
                            $this->email->message($messageprint1);
                            $this->email->send();
                        }
                        $data_appointment=array();
                        $data_appointment=array(
                          'cron_job' => '1' 
                        );
                        $this->cronjobs_model->updateAppointment($appointment->id,$data_appointment);
                    }
                 }
                }
            }
        }
    }

    public function sendSms($hospital_id, $data) {
        $sms_gateway = $this->cronjobs_model->getSettings($hospital_id)->sms_gateway;
        if (!empty($sms_gateway)) {
            $smsSettings = $this->cronjobs_model->getSmsSettingsByGatewayName($hospital_id,$sms_gateway);
        } else {
            return 0;
        }
        $j = sizeof($data);

        foreach ($data as $key2 => $value2) {

            if ($smsSettings->name == 'Clickatell') {
                $username = $smsSettings->username;
                $password = $smsSettings->password;
                $api_id = $smsSettings->api_id;

                $racepage[] = file_get_contents("https://api.clickatell.com/http/sendmsg?user=" . $username . "&password=" . $password . "&api_id=" . $api_id . "&to=" . $key2 . "&text=" . $value2);
                return $racepage;
            }

            if ($smsSettings->name == 'MSG91') {
                $authkey = $smsSettings->authkey;
                $sender = $smsSettings->sender;
                $value2 = urlencode($value2);

                $racepage[] = file_get_contents('http://world.msg91.com/api/v2/sendsms?authkey=' . $authkey . '&mobiles=' . $key2 . '&message=' . $value2 . '&sender=' . $sender . '&route=4&country=0');
                return $racepage;
            }
            if ($smsSettings->name == 'Twilio') {
                $sid = $smsSettings->sid;
                $token = $smsSettings->token;
                $sendername = $smsSettings->sendernumber;
                if (!empty($sid) && !empty($token) && !empty($sendername)) {
                    $client = new Client($sid, $token);
                    $client->messages->create(
                            $key2, // Text this number
                            array(
                                'from' => $sendername, // From a valid Twilio number
                                'body' => $value2
                            )
                    );
                    $racepage = array();
                    return $racepage;
                }
            }
            if ($smsSettings->name == '80Kobo') {
                $email = $smsSettings->email;
                $password = $smsSettings->password;
                $sender_name = $smsSettings->sender_name;

                $data = array("email" => $email, "password" => $password, "message" => $value2, "sender_name" => $sender_name, "recipients" => $key2);

                $data_string = json_encode($data);
                $ch = curl_init('https://api.80kobosms.com/v2/app/sms');
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Content-Length: ' . strlen($data_string)));
                $result = curl_exec($ch);
                $res_array = json_decode($result);
                return $res_array;
            }
        }
    }

}

<?php

/**
 * Created By Trimmytech
 * Fiverr Handle : @trimmytech
 * Date: 4/14/2018
 * Time: 9:26 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Paystack extends MX_Controller {

    function __construct() {

        parent::__construct();
        $this->load->helper('url');
        $this->load->model('finance/finance_model');
        $this->load->model('pgateway/pgateway_model');
    }

    private function getPaymentInfo($ref) {
        $result = array();
        $url = 'https://api.paystack.co/transaction/verify/' . $ref;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt(
                $ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . PAYSTACK_SECRET_KEY]
        );
        $request = curl_exec($ch);
        curl_close($ch);
        //
        $result = json_decode($request, true);
        //
        return $result['data'];
    }

    public function verify_payment($ref) {
        $paystack = $this->pgateway_model->getPaymentGatewaySettingsByName('Paystack');
        $result = array();
        $url = 'https://api.paystack.co/transaction/verify/' . $ref;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt(
                $ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $paystack->secret]
        );
        $request = curl_exec($ch);
        curl_close($ch);
        //
        if ($request) {
            $result = json_decode($request, true);
            
            if ($result) {
                if ($result['data']) {
                    //something came in
                    if ($result['data']['status'] == 'success') {

                       
                        header("Location: " . base_url() . 'paystack/success/' . $ref);
                    } else {
                       
                        header("Location: " . base_url() . 'paystack/fail/' . $ref);
                    }
                } else {

                   
                    header("Location: " . base_url() . 'paystack/fail/' . $ref);
                }
            } else {

                header("Location: " . base_url() . 'paystack/fail/' . $ref);
            }
        } else {
           
            header("Location: " . base_url() . 'paystack/fail/' . $ref);
        }
    }

    public function paystack_standard($amount, $ref, $patient, $inserted_id, $user, $redirlink) {
    
        $paystack = $this->pgateway_model->getPaymentGatewaySettingsByName('Paystack');

     
        $patientdetails = $this->db->get_where('patient', array('id =' => $patient))->row();
        $result = array();
        $amount = $amount * 100;

        if ($redirlink == '0save') {
            $callback_url = base_url() . 'finance/invoice?id=' . $inserted_id;
        }
        if ($redirlink == '0saveandprint') {
            $callback_url = base_url() . 'finance/printInvoice?id=' . $inserted_id;
        }
        if ($redirlink == '1deposit') {
            $callback_url = base_url() . 'finance/patientPaymentHistory?patient=' . $patient;
        }
        if ($redirlink == '1due') {
            $callback_url = base_url() . 'finance/invoice?id=' . $inserted_id;
        }
        if ($redirlink == '2') {
            $callback_url = base_url() . 'patient/myPaymentHistory';
        }
       
        $postdata = array('first_name' => $patientdetails->name, 'email' => $patientdetails->email, 'amount' => $amount, "reference" => $ref, 'callback_url' => $callback_url);

       

        $url = "https://api.paystack.co/transaction/initialize";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postdata));  //Post Fields
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $headers = [
            'Authorization: Bearer ' . $paystack->secret,
            'Content-Type: application/json',
        ];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $request = curl_exec($ch);
        curl_close($ch);


        if ($request) {
            $result = json_decode($request, true);
           
        }

        if(!$result['data']){
            $this->session->set_flashdata('feedback', lang('transaction_failed'));
            redirect($_SERVER['HTTP_REFERER']);
        }

        $redir = $result['data']['authorization_url'];

        header("Location: " . $redir);
        $payment_details = $this->finance_model->getPaymentById($inserted_id);
        if ($result['status'] == 1) {
            $date = time();
            if ($redirlink == '0') {
                $data1 = array(
                    'date' => $date,
                    'patient' => $patient,
                    'deposited_amount' => $amount / 100,
                    'payment_id' => $inserted_id,
                    'amount_received_id' => $inserted_id . '.' . 'gp',
                    'gateway' => 'Paystack',
                    'deposit_type' => 'Card',
                    'user' => $user,
                    'payment_from'=>$payment_details->payment_from
                );
                $data_payment = array('amount_received' => $amount / 100, 'deposit_type' => 'Card');
                $this->finance_model->updatePayment($inserted_id, $data_payment);
            } else {
                $data1 = array(
                    'date' => $date,
                    'patient' => $patient,
                    'deposited_amount' => $amount / 100,
                    'payment_id' => $inserted_id,
                    'gateway' => 'Paystack',
                    'deposit_type' => 'Card',
                    'user' => $user,
                    'payment_from'=>$payment_details->payment_from
                );
            }
            $this->finance_model->insertDeposit($data1);
        }
       
          exit();
    }

    public function paystack_inline() {
        $data = array();
        $data['title'] = "Paystack InLine Demo";
        //
        $this->load->view('paystack_inline', $data);
    }

    public function success($ref) {
        $data = array();
        $info = $this->getPaymentInfo($ref);
     
        $data['title'] = "Paystack InLine Demo";
        $data['amount'] = $info['amount'] / 100;
       
        $this->load->view('success', $data);
    }

    public function fail() {
        $this->load->view('fail');
    }

}

?>
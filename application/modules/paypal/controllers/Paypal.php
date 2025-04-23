<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
include("./vendor/autoload.php");

use Omnipay\Omnipay;

class Paypal extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('finance/finance_model');
        $this->load->model('pgateway/pgateway_model');
    }
   public function paymentPaypalFromFrontend($data,$from){
        $paypal = $this->db->get_where('paymentGateway',array('hospital_id'=>'superadmin','name'=>'PayPal'))->row();
        $gateway = Omnipay::create('PayPal_Pro');
        $gateway->setUsername($paypal->APIUsername);
        $gateway->setPassword($paypal->APIPassword);
        $gateway->setSignature($paypal->APISignature);
        if ($paypal->status == 'test') {
            $gateway->setTestMode(true); 
        } else {
            $gateway->setTestMode(false);
        }
        $arr_expiry = explode("/", $data['expire_date']);
        $cardholdername = explode(" ", $data['cardholder']);
        $currency = $this->currencyCode();
        $formData = array(
            'firstName' => trim($cardholdername[0]),
            'lastName' => trim($cardholdername[1]),
            'number' => $data['card_number'],
            'expiryMonth' => trim($arr_expiry[0]),
            'expiryYear' => trim($arr_expiry[1]),
            'cvv' => $data['cvv']
        );
        
         try {
     
            $response = $gateway->purchase([
                        'amount' => $data['price'],
                        'currency' => $currency,
                        'card' => $formData
                    ])->send();
          
            if ($response->isSuccessful()) {
               
               $response_update='yes';
               return $response_update;
                
               
            } else {
           
                $response_update='no';
                return $response_update;
            }
           
            
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function paymentPaypal($data) {
        $paypal = $this->pgateway_model->getPaymentGatewaySettingsByName('PayPal');
       
        $gateway = Omnipay::create('PayPal_Pro');
        $gateway->setUsername($paypal->APIUsername);
        $gateway->setPassword($paypal->APIPassword);
        $gateway->setSignature($paypal->APISignature);
        if ($paypal->status == 'test') {
            $gateway->setTestMode(true); 
        } else {
            $gateway->setTestMode(false);
        }
        $arr_expiry = explode("/", $data['expire_date']);
        $cardholdername = explode(" ", $data['cardholdername']);
        $currency = $this->currencyCode();
        $formData = array(
            'firstName' => trim($cardholdername[0]),
            'lastName' => trim($cardholdername[1]),
            'number' => $data['card_number'],
            'expiryMonth' => trim($arr_expiry[0]),
            'expiryYear' => trim($arr_expiry[1]),
            'cvv' => $data['cvv']
        );

        try {
          
            $response = $gateway->purchase([
                        'amount' => $data['deposited_amount'],
                        'currency' => $currency,
                        'card' => $formData
                    ])->send();
 
            // Process response
            if ($response->isSuccessful()) {

                $payment_details = $this->finance_model->getPaymentById($data['payment_id']);
                if ($data['from'] == 'pos') {
                    $data1 = array(
                        'date' => time(),
                        'patient' => $data['patient'],
                        'deposited_amount' => $data['deposited_amount'],
                        'payment_id' => $data['payment_id'],
                        'amount_received_id' => $data['payment_id'] . '.' . 'gp',
                        'gateway' => 'PayPal',
                        'deposit_type' => 'Card',
                        'user' => $this->ion_auth->get_user_id(),
                        'hospital_id' => $this->session->userdata('hospital_id'),
                        'payment_from'=>$payment_details->payment_from
                    );
                    $this->finance_model->insertDeposit($data1);

                    $data_payment = array('amount_received' => $data['deposited_amount'], 'deposit_type' => 'Card');
                    $this->finance_model->updatePayment($data['payment_id'], $data_payment);

                    $this->session->set_flashdata('feedback', lang('payment_successful'));
                    if($data['form_submit']=='save'){
                        redirect("finance/invoice?id=" . $data['payment_id']);
                    }else{
                        redirect("finance/printInvoice?id=".$data['payment_id']);
                    }
                  
                } else {
                    $date = time();
                    $data1 = array('patient' => $data['patient'],
                        'date' => $date,
                        'payment_id' => $data['payment_id'],
                        'deposited_amount' => $data['deposited_amount'],
                        'deposit_type' => 'Card',
                        'gateway' => 'PayPal',
                        'user' => $this->ion_auth->get_user_id(),
                         'hospital_id'=>$this->session->userdata('hospital_id'),
                         'payment_from'=>$payment_details->payment_from
                    );
                    $this->finance_model->insertDeposit($data1);
                    $this->session->set_flashdata('feedback', lang('payment_successful'));
                    if ($this->ion_auth->in_group(array('Patient'))) {
                        redirect('patient/myPaymentHistory');
                    } else {
                        if($data['redirect']=='deposit'){
                            redirect('finance/patientPaymentHistory?patient=' . $data['patient']);
                        }else{
                            redirect("finance/invoice?id=" . $data['payment_id']);
                        }
                       
                    }

                   
                }
            } else {
               
                if ($data['from'] == 'pos') {
                    $this->session->set_flashdata('feedback', lang('transaction_failed'));
                    if($data['form_submit']=='save'){
                        redirect("finance/invoice?id=" . $data['payment_id']);
                    }else{
                        redirect("finance/printInvoice?id=".$data['payment_id']);
                    }
                   
                } else {
                    $this->session->set_flashdata('feedback', lang('transaction_failed'));
                    if ($this->ion_auth->in_group(array('Patient'))) {
                        redirect('patient/myPaymentHistory');
                    } else {
                        if($data['redirect']=='deposit'){
                            redirect('finance/patientPaymentHistory?patient=' . $data['patient']);
                        }else{
                            redirect("finance/invoice?id=" . $data['payment_id']);
                        }
                    }
                }
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    function currencyCode() {
        $currency = $this->db->get('settings')->row()->currency;
        if ($currency == '$' || strtoupper($currency) == 'USD') {
            $currency = 'USD';
        }
        if ($currency == 'R' || strtoupper($currency) == 'ZAR') {
            $currency = 'ZAR';
        }
        if (strtoupper($currency) == 'TK' || strtoupper($currency) == 'BDT' || strtoupper($currency) == 'TAKA' || $currency == 'ট') {
            $currency = 'BDT';
        }
        if (strtoupper($currency) == 'CNY') {
            $currency = 'CNY';
        }
        if ($currency == '€' || strtoupper($currency) == 'EUR') {
            $currency = 'EUR';
        }
        if ($currency == '₹' || strtoupper($currency) == 'INR') {
            $currency = 'INR';
        }
        if (strtoupper($currency) == 'CNY') {
            $currency = 'CNY';
        }
        if (strtoupper($currency) == 'BRL' || $currency == 'R$') {
            $currency = 'BRL';
        }
        if (strtoupper($currency) == 'GBP' || $currency == '£') {
            $currency = 'GBP';
        }
        if (strtoupper($currency) == 'IDR' || $currency == 'Rp') {
            $currency = 'IDR';
        }
        if (strtoupper($currency) == 'NGN' || $currency == '₦') {
            $currency = 'NGN';
        }

        if (strtoupper($currency) == 'RS' || strtoupper($currency) == 'INR' || strtoupper($currency) == 'RUPEE') {
            $currency = 'INR';
        }
        if (strtoupper($currency) == 'AUD') {
            $currency = 'AUD';
        }
        if (strtoupper($currency) == 'CAD') {
            $currency = 'CAD';
        }
        return $currency;
    }

}

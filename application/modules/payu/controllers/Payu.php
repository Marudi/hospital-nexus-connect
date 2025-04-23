<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Payu extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('patient/patient_model');
        $this->load->model('donor/donor_model');
        $this->load->model('finance/finance_model');
        $this->load->model('finance/pharmacy_model');
        $this->load->model('prescription/prescription_model');
        $this->load->model('doctor/doctor_model');
        $this->load->model('pgateway/pgateway_model');
    }

    public function index() {
        redirect('home');
    }

    public function check() {

        $amount = $this->input->get('deposited_amount');
        $invoice_id = $this->input->get('payment_id');
        $deposit_from = $this->input->get('deposit_from');
        $payment = $this->finance_model->getPaymentById($invoice_id);

        $client_info = $this->patient_model->getPatientById($payment->patient);

        $product_info = $invoice_id;
        $customer_name = $client_info->name;
        $customer_emial = $client_info->email;
        $customer_mobile = $client_info->phone;
        $customer_address = $client_info->address;

        $payumoney = $this->pgateway_model->getPaymentGatewaySettingsByName('Pay U Money');

        if ($payumoney->status == 'live') {
            $action = "https://secure.payu.in";
        } else {
            $action = "https://sandboxsecure.payu.in";
        }

        $MERCHANT_KEY = $payumoney->merchant_key; //change  merchant with yours
        $SALT = $payumoney->salt;  //change salt with yours 

        $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);

        $udf1 = '';
        $udf2 = '';
        $udf3 = '';
        $udf4 = '';
        $udf5 = '';

        $hashstring = $MERCHANT_KEY . '|' . $txnid . '|' . $amount . '|' . $product_info . '|' . $customer_name . '|' . $customer_emial . '|' . $udf1 . '|' . $udf2 . '|' . $udf3 . '|' . $udf4 . '|' . $udf5 . '||||||' . $SALT;
        $hash = strtolower(hash('sha512', $hashstring));
        if($deposit_from=='deposit'){
            $success = base_url() . 'payu/Status';
            $fail = base_url() . 'payu/Status';
            $cancel = base_url() . 'payu/Status';
        }else{
            $success = base_url() . 'payu/Status/index5';
            $fail = base_url() . 'payu/Status/index5';
            $cancel = base_url() . 'payu/Status/index5';
        }
     

        $data = array(
            'mkey' => $MERCHANT_KEY,
            'tid' => $txnid,
            'hash' => $hash,
            'amount' => $amount,
            'name' => $customer_name,
            'productinfo' => $product_info,
            'mailid' => $customer_emial,
            'phoneno' => $customer_mobile,
            'address' => $customer_address,
            'action' => $action, //for live change action  https://secure.payu.in  
            'sucess' => $success,
            'failure' => $fail,
            'cancel' => $cancel
        );

        $this->load->view('home/dashboard');
        $this->load->view('confirmation', $data);
        $this->load->view('home/footer');
    }

    public function check1() {

        $amount = $this->input->get('deposited_amount');
        $invoice_id = $this->input->get('payment_id');
        $form_submit = $this->input->get('form_submit');
        $payment = $this->finance_model->getPaymentById($invoice_id);

        $client_info = $this->patient_model->getPatientById($payment->patient);

        $product_info = $invoice_id;
        $customer_name = $client_info->name;
        $customer_emial = $client_info->email;
        $customer_mobile = $client_info->phone;
        $customer_address = $client_info->address;

        $payumoney = $this->pgateway_model->getPaymentGatewaySettingsByName('Pay U Money');

        if ($payumoney->status == 'live') {
            $action = "https://secure.payu.in";
        } else {
            $action = "https://sandboxsecure.payu.in";
        }


        $MERCHANT_KEY = $payumoney->merchant_key; //change  merchant with yours
        $SALT = $payumoney->salt;  //change salt with yours 

        $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
        //optional udf values 
        $udf1 = '';
        $udf2 = '';
        $udf3 = '';
        $udf4 = '';
        $udf5 = '';

        $hashstring = $MERCHANT_KEY . '|' . $txnid . '|' . $amount . '|' . $product_info . '|' . $customer_name . '|' . $customer_emial . '|' . $udf1 . '|' . $udf2 . '|' . $udf3 . '|' . $udf4 . '|' . $udf5 . '||||||' . $SALT;
        $hash = strtolower(hash('sha512', $hashstring));
        if($form_submit=='save'){
            $success = base_url() . 'payu/Status/index1';
                $fail = base_url() . 'payu/Status/index1';
                $cancel = base_url() . 'payu/Status/index1';
        }else{
            $success = base_url() . 'payu/Status/index4';
            $fail = base_url() . 'payu/Status/index4';
            $cancel = base_url() . 'payu/Status/index4';
        }
        

        $data = array(
            'mkey' => $MERCHANT_KEY,
            'tid' => $txnid,
            'hash' => $hash,
            'amount' => $amount,
            'name' => $customer_name,
            'productinfo' => $product_info,
            'mailid' => $customer_emial,
            'phoneno' => $customer_mobile,
            'address' => $customer_address,
            'action' => $action, //for live change action  https://secure.payu.in  
            'sucess' => $success,
            'failure' => $fail,
            'cancel' => $cancel
        );

        $this->load->view('home/dashboard');
        $this->load->view('confirmation', $data);
        $this->load->view('home/footer');
    }

    public function check2() {

        $amount = $this->input->post('amount_received');
        $invoice_id = $this->input->post('id');

        $payment = $this->pharmacy_model->getPaymentById($invoice_id);

        $client_info = $this->patient_model->getPatientById($payment->patient);

        $product_info = $invoice_id;
        $customer_name = $client_info->name;
        $customer_emial = $client_info->email;
        $customer_mobile = $client_info->phone;
        $customer_address = $client_info->address;

        $payumoney = $this->pgateway_model->getPaymentGatewaySettingsByName('Pay U Money');

        if ($payumoney->status == 'live') {
            $action = "https://secure.payu.in";
        } else {
            $action = "https://sandboxsecure.payu.in";
        }


        $MERCHANT_KEY = $payumoney->merchant_key; //change  merchant with yours
        $SALT = $payumoney->salt;  //change salt with yours 

        $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);

        $udf1 = '';
        $udf2 = '';
        $udf3 = '';
        $udf4 = '';
        $udf5 = '';

        $hashstring = $MERCHANT_KEY . '|' . $txnid . '|' . $amount . '|' . $product_info . '|' . $customer_name . '|' . $customer_emial . '|' . $udf1 . '|' . $udf2 . '|' . $udf3 . '|' . $udf4 . '|' . $udf5 . '||||||' . $SALT;
        $hash = strtolower(hash('sha512', $hashstring));

        $success = base_url() . 'payu/Status/index2';
        $fail = base_url() . 'payu/Status/index2';
        $cancel = base_url() . 'payu/Status/index2';

        $data = array(
            'mkey' => $MERCHANT_KEY,
            'tid' => $txnid,
            'hash' => $hash,
            'amount' => $amount,
            'name' => $customer_name,
            'productinfo' => $product_info,
            'mailid' => $customer_emial,
            'phoneno' => $customer_mobile,
            'address' => $customer_address,
            'action' => $action, //for live change action  https://secure.payu.in  
            'sucess' => $success,
            'failure' => $fail,
            'cancel' => $cancel
        );

        $this->load->view('home/dashboard');
        $this->load->view('confirmation', $data);
        $this->load->view('home/footer');
    }

    public function check3() {

        $amount = $this->input->get('amount_received');
        $invoice_id = $this->input->get('id');

        $payment = $this->pharmacy_model->getPaymentById($invoice_id);

        $client_info = $this->patient_model->getPatientById($payment->patient);

        $product_info = $invoice_id;
        $customer_name = $client_info->name;
        $customer_emial = $client_info->email;
        $customer_mobile = $client_info->phone;
        $customer_address = $client_info->address;

        $payumoney = $this->pgateway_model->getPaymentGatewaySettingsByName('Pay U Money');

        if ($payumoney->status == 'live') {
            $action = "https://secure.payu.in";
        } else {
            $action = "https://sandboxsecure.payu.in";
        }


        $MERCHANT_KEY = $payumoney->merchant_key; //change  merchant with yours
        $SALT = $payumoney->salt;  //change salt with yours 

        $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);

        $udf1 = '';
        $udf2 = '';
        $udf3 = '';
        $udf4 = '';
        $udf5 = '';

        $hashstring = $MERCHANT_KEY . '|' . $txnid . '|' . $amount . '|' . $product_info . '|' . $customer_name . '|' . $customer_emial . '|' . $udf1 . '|' . $udf2 . '|' . $udf3 . '|' . $udf4 . '|' . $udf5 . '||||||' . $SALT;
        $hash = strtolower(hash('sha512', $hashstring));

        $success = base_url() . 'payu/Status/index2';
        $fail = base_url() . 'payu/Status/index2';
        $cancel = base_url() . 'payu/Status/index2';

        $data = array(
            'mkey' => $MERCHANT_KEY,
            'tid' => $txnid,
            'hash' => $hash,
            'amount' => $amount,
            'name' => $customer_name,
            'productinfo' => $product_info,
            'mailid' => $customer_emial,
            'phoneno' => $customer_mobile,
            'address' => $customer_address,
            'action' => $action, //for live change action  https://secure.payu.in  
            'sucess' => $success,
            'failure' => $fail,
            'cancel' => $cancel
        );

        $this->load->view('home/dashboard');
        $this->load->view('confirmation', $data);
        $this->load->view('home/footer');
    }

    public function check4($data, $price, $id, $from) {

        $amount = $price;
        $invoice_id = $id;
if($from=='backend'){
    $password=$data['password'];
}else{
    $password='12345';
}
        if ($from == 'deposit_backend') {
            $product_info = $data['package_duration'] . '-' . $invoice_id . '-' . 'test' . '-' . $data['package'] . '-' . $from . '-' . $data['from'];
        } elseif ($from == 'expire') {
            $product_info = $data['package_duration'] . '-' . $invoice_id . '-' . 'test' . '-' . $data['package'] . '-' . $from . '-' . $data['from'];
        } else {
            $product_info = $data['package_duration'] . '-' . $data['country'] . '-' . $data['language'] . '-' . $data['package'] . '-' . $from. '-' . base64_encode($password);
        }

        $customer_name = $data['name'];
        $customer_emial = $data['email'];
        ;
        $customer_mobile = $data['phone'];
        ;
        $customer_address = $data['address'];

        $payumoney = $this->db->get_where('paymentGateway', array('hospital_id' => 'superadmin', 'name' => 'Pay U Money'))->row();

        if ($payumoney->status == 'live') {
            $action = "https://secure.payu.in";
        } else {
            $action = "https://sandboxsecure.payu.in";
        }


        $MERCHANT_KEY = $payumoney->merchant_key; //change  merchant with yours
        $SALT = $payumoney->salt;  //change salt with yours 

        $txnid = substr(hash('sha512', mt_rand() . microtime()), 0, 20);

        $udf1 = '';
        $udf2 = '';
        $udf3 = '';
        $udf4 = '';
        $udf5 = '';

        $hashstring = $MERCHANT_KEY . '|' . $txnid . '|' . $amount . '|' . $product_info . '|' . $customer_name . '|' . $customer_emial . '|' . $udf1 . '|' . $udf2 . '|' . $udf3 . '|' . $udf4 . '|' . $udf5 . '||||||' . $SALT;
        $hash = strtolower(hash('sha512', $hashstring));

        $success = base_url() . 'payu/status/index3';
        $fail = base_url() . 'payu/status/index3';
        $cancel = base_url() . 'payu/status/index3';

        $data = array(
            'mkey' => $MERCHANT_KEY,
            'tid' => $txnid,
            'hash' => $hash,
            'amount' => $amount,
            'name' => $customer_name,
            'productinfo' => $product_info,
            'mailid' => $customer_emial,
            'phoneno' => $customer_mobile,
            'address' => $customer_address,
            'action' => $action, //for live change action  https://secure.payu.in  
            'sucess' => $success,
            'failure' => $fail,
            'cancel' => $cancel
        );

        if ($this->ion_auth->logged_in()) {

           //        $this->load->view('home/dashboard'); 
            $this->load->view('confirmation_frontend', $data);
            $this->load->view('home/footer');
        } else {

//        $this->load->view('home/dashboard'); 
            $this->load->view('confirmation_frontend', $data);
            $this->load->view('home/footer');
        }
    }

    public function help() {
        $this->load->view('help');
    }

}

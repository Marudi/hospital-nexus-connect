<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once APPPATH . '../vendor/autoload.php';

class Finance extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('finance_model');
        $this->load->model('doctor/doctor_model');
        $this->load->model('patient/patient_model');
        $this->load->model('finance/pharmacy_model');
        $this->load->model('accountant/accountant_model');
        $this->load->model('appointment/appointment_model');
        $this->load->model('receptionist/receptionist_model');
        $this->load->model('lab/lab_model');
        $this->load->model('pgateway/pgateway_model');
        $this->load->module('sms');
        require APPPATH . 'third_party/stripe/stripe-php/init.php';
        $this->load->module('paypal');

        if (!$this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist', 'Nurse', 'Laboratorist', 'Doctor'))) {
            redirect('home/permission');
        }
    }

    public function index()
    {

        redirect('finance/financial_report');
    }

    public function payment()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $data['settings'] = $this->settings_model->getSettings();

        $this->load->view('home/dashboard');
        $this->load->view('finance/payment', $data);
        $this->load->view('home/footer');
    }

    function amountDistribution()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $data['settings'] = $this->settings_model->getSettings();
        $data['payments'] = $this->finance_model->getPayment();

        $this->load->view('home/dashboard');
        $this->load->view('finance/amount_distribution', $data);
        $this->load->view('home/footer');
    }

    public function addPaymentView()
    {
        $data = array();
        $data['discount_type'] = $this->finance_model->getDiscountType();
        $data['settings'] = $this->settings_model->getSettings();
        $data['categories'] = $this->finance_model->getPaymentCategory();
        $data['gateway'] = $this->finance_model->getGatewayByName($data['settings']->payment_gateway);
        $data['patients'] = $this->patient_model->getPatient();
        $data['doctors'] = $this->doctor_model->getDoctor();
        $this->load->view('home/dashboard');
        $this->load->view('finance/add_payment_view', $data);
        $this->load->view('home/footer');
    }

    public function addPayment()
    {
        $form_submit = $this->input->post('form_submit');
        if ($form_submit == 'save_as_draft') {
            $draft_id = $this->input->post('draft_id');
            $item_selected = array();
            $time = $this->input->post('time_delivery');
            $date_delivery = $this->input->post('date_delivery');
            $quantity = array();
            $category_selected = array();
            $percent_discount = $this->input->post('percent_discount');
            $category_selected = $this->input->post('category_name');
            $item_selected = $this->input->post('category_id');
            $quantity = $this->input->post('quantity');
            $remarks = $this->input->post('remarks');
            $vat = $this->input->post('vat_amount');
            $vat_amount = $this->input->post('vat');
            $item_quantity_array = array();
            $item_quantity_array = array_combine($item_selected, $quantity);
            $cat_and_price = array();
            if (!empty($item_quantity_array)) {
                foreach ($item_quantity_array as $key => $value) {
                    $current_item = $this->finance_model->getPaymentCategoryById($key);
                    $category_price = $current_item->c_price;
                    $category_type = $current_item->type;
                    $qty = $value;
                    $cat_and_price[] = $key . '*' . $category_price . '*' . $category_type . '*' . $qty;
                    $amount_by_category[] = $category_price * $qty;
                }
                $category_name = implode(',', $cat_and_price);
            }

            $patient = $this->input->post('patient');

            $p_name = $this->input->post('p_name');
            $p_email = $this->input->post('p_email');
            $birthdate = $this->input->post('p_birth');
            if (empty($birthdate)) {
                $years = $this->input->post('years');
                $months = $this->input->post('months');
                $days = $this->input->post('days');
                if (empty($years)) {
                    $years = '0';
                }
                if (empty($months)) {
                    $months = '0';
                }
                if (empty($days)) {
                    $days = '0';
                }
            } else {
                $dateOfBirth = $birthdate;
                $today = date("Y-m-d");
                $diff = date_diff(date_create($dateOfBirth), date_create($today));
                $years = $diff->format('%y');
                $months = $diff->format('%m');
                $days = $diff->format('%d');
            }
            $age = $years . '-' . $months . '-' . $days;

            $p_phone = $this->input->post('p_phone');
            $p_age = $this->input->post('p_age');
            $p_gender = $this->input->post('p_gender');
            $add_date = date('m/d/y');

            $patient_id = rand(10000, 1000000);

            $d_name = $this->input->post('d_name');
            $d_email = $this->input->post('d_email');

            $d_phone = $this->input->post('d_phone');

            $doctor = $this->input->post('doctor');
            $date = time();
            $date_string = date('d-m-y', $date);
            $discount = $this->input->post('discount');

            $amount_received = $this->input->post('amount_received');
            $deposit_type = $this->input->post('deposit_type');
            $user = $this->ion_auth->get_user_id();
            $amount = array_sum($amount_by_category);
            $sub_total = $amount + $vat;
            $discount_type = $this->finance_model->getDiscountType();
            if ($discount_type == 'flat') {
                $flat_discount = $discount;
                $gross_total = $sub_total - $flat_discount;
                $hospital_amount = $gross_total;
            } else {
                $flat_discount = $amount * ($discount / 100);
                $gross_total = $sub_total - $flat_discount;
                $hospital_amount = $gross_total;
            }
            $data = array();
            $data = array(
                'category_name' => $category_name,
                'patient' => $patient,
                'date' => $date,
                'amount' => $sub_total,
                'doctor' => $doctor,
                'discount' => $discount,
                'flat_discount' => $flat_discount,
                'gross_total' => $gross_total,
                'user' => $user,
                'patient_name' => $p_name,
                'patient_phone' => $p_phone,
                'patient_email' => $p_email,
                'patient_gender' => $p_gender,
                'date_string' => $date_string,
                'remarks' => $remarks,
                'date_delivery' => $date_delivery,
                'time_delivery' => $time,
                'age' => $age,
                'birthdate' => $birthdate,
                'deposit_type' => $deposit_type,
                'doctor_name' => $d_name,
                'doctor_email' => $d_email,
                'doctor_phone' => $d_phone,
                'amount_received' => $amount_received,
                'vat' => $vat,
                'vat_amount_percent' => $vat_amount,
                'percent_discount' => $percent_discount

            );
            if (empty($draft_id)) {
                $this->finance_model->insertDraftPayment($data);
            } else {
                $this->finance_model->updateDraftPayment($draft_id, $data);
            }
            $this->session->set_flashdata('feedback', 'Draft Saved');
            redirect('finance/draftPayment');
        } else {
            if (!empty($this->input->post('draft_id'))) {
                $this->finance_model->deleteDraftPayment($this->input->post('draft_id'));
            }
        }

        $id = $this->input->post('id');
        $item_selected = array();
        $time = $this->input->post('time_delivery');
        $date_delivery = $this->input->post('date_delivery');
        $quantity = array();
        $category_selected = array();
        $vat = $this->input->post('vat_amount');
        $vat_amount = $this->input->post('vat');
        $category_selected = $this->input->post('category_name');
        $item_selected = $this->input->post('category_id');
        $quantity = $this->input->post('quantity');
        $remarks = $this->input->post('remarks');

        if (empty($item_selected)) {
            $this->session->set_flashdata('feedback', lang('select_an_item'));
            redirect('finance/addPaymentView');
        } else {
            $item_quantity_array = array();
            $item_quantity_array = array_combine($item_selected, $quantity);
        }
        $cat_and_price = array();
        if (!empty($item_quantity_array)) {
            foreach ($item_quantity_array as $key => $value) {
                $current_item = $this->finance_model->getPaymentCategoryById($key);
                $category_price = $current_item->c_price;
                $category_type = $current_item->type;
                $qty = $value;
                $cat_and_price[] = $key . '*' . $category_price . '*' . $category_type . '*' . $qty;
                $amount_by_category[] = $category_price * $qty;
            }
            $category_name = implode(',', $cat_and_price);
        } else {
            $this->session->set_flashdata('feedback', lang('attend_the_required_fields'));
            redirect('finance/addPaymentView');
        }

        $patient = $this->input->post('patient');

        $p_name = $this->input->post('p_name');
        $p_email = $this->input->post('p_email');
        $birthdate = $this->input->post('p_birth');
        if (empty($birthdate)) {
            $years = $this->input->post('years');
            $months = $this->input->post('months');
            $days = $this->input->post('days');
            if (empty($years)) {
                $years = '0';
            }
            if (empty($months)) {
                $months = '0';
            }
            if (empty($days)) {
                $days = '0';
            }
        } else {
            $dateOfBirth = $birthdate;
            $today = date("Y-m-d");
            $diff = date_diff(date_create($dateOfBirth), date_create($today));
            $years = $diff->format('%y');
            $months = $diff->format('%m');
            $days = $diff->format('%d');
        }
        $age = $years . '-' . $months . '-' . $days;
        if (empty($p_email)) {
            $p_email = $p_name . '-' . rand(1, 1000) . '-' . $p_name . '-' . rand(1, 1000) . '@example.com';
        }
        if (!empty($p_name)) {
            $password = $p_name . '-' . rand(1, 100000000);
        }
        $p_phone = $this->input->post('p_phone');
        $p_age = $this->input->post('p_age');
        $p_gender = $this->input->post('p_gender');
        $add_date = date('m/d/y');

        $patient_id = rand(10000, 1000000);

        $d_name = $this->input->post('d_name');
        $d_email = $this->input->post('d_email');
        if (empty($d_email)) {
            $d_email = $d_name . '-' . rand(1, 1000) . '-' . $d_name . '-' . rand(1, 1000) . '@example.com';
        }
        if (!empty($d_name)) {
            $password = $d_name . '-' . rand(1, 100000000);
        }
        $d_phone = $this->input->post('d_phone');

        $doctor = $this->input->post('doctor');
        $date = time();
        $date_string = date('d-m-y', $date);
        $discount = $this->input->post('discount');
        if (empty($discount)) {
            $discount = 0;
        }
        $amount_received = $this->input->post('amount_received');
        $deposit_type = $this->input->post('deposit_type');
        $user = $this->ion_auth->get_user_id();

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        // Validating Category Field
        // $this->form_validation->set_rules('category_amount[]', 'Category', 'min_length[1]|max_length[100]');
        // Validating Price Field
        $this->form_validation->set_rules('patient', 'Patient', 'trim|min_length[1]|max_length[100]|xss_clean');
        // Validating Price Field
        $this->form_validation->set_rules('discount', 'Discount', 'trim|min_length[1]|max_length[100]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            redirect('finance/addPaymentView');
        } else {
            if ($patient == 'add_new') {

                $limit = $this->patient_model->getLimit();
                if ($limit <= 0) {
                    $this->session->set_flashdata('feedback', lang('patient_limit_exceed'));
                    redirect('patient');
                }

                $data_p = array(
                    'patient_id' => $patient_id,
                    'name' => $p_name,
                    'email' => $p_email,
                    'phone' => $p_phone,
                    'sex' => $p_gender,
                    'age' => $age,
                    'add_date' => $add_date,
                    'how_added' => 'from_pos',
                    'payment_confirmation' => 'Active',
                    'appointment_confirmation' => 'Active',
                    'appointment_creation' => 'Active',
                    'meeting_schedule' => 'Active',
                    'birthdate' => $birthdate,

                );
                $username = $this->input->post('p_name');

                if ($this->ion_auth->email_check($p_email)) {
                    $this->session->set_flashdata('feedback', lang('this_email_address_is_already_registered'));
                    redirect('finance/addPaymentView');
                } else {
                    $dfg = 5;
                    $this->ion_auth->register($username, $password, $p_email, $dfg);
                    $ion_user_id = $this->db->get_where('users', array('email' => $p_email))->row()->id;
                    $this->patient_model->insertPatient($data_p);
                    $patient_user_id = $this->db->get_where('patient', array('email' => $p_email))->row()->id;
                    $id_info = array('ion_user_id' => $ion_user_id);
                    $this->patient_model->updatePatient($patient_user_id, $id_info);
                    $this->hospital_model->addHospitalIdToIonUser($ion_user_id, $this->hospital_id);
                }
            }

            if (!empty($d_name)) {

                $limit = $this->doctor_model->getLimit();
                if ($limit <= 0) {
                    $this->session->set_flashdata('feedback', lang('doctor_limit_exceed'));
                    redirect('doctor');
                }

                $data_d = array(
                    'name' => $d_name,
                    'email' => $d_email,
                    'phone' => $d_phone,

                    'appointment_confirmation' => 'Active',

                );
                $username = $this->input->post('d_name');

                if ($this->ion_auth->email_check($d_email)) {
                    $this->session->set_flashdata('feedback', lang('this_email_address_is_already_registered'));
                    redirect('finance/addPaymentView');
                } else {
                    $dfgg = 4;
                    $this->ion_auth->register($username, $password, $d_email, $dfgg);
                    $ion_user_id = $this->db->get_where('users', array('email' => $d_email))->row()->id;
                    $this->doctor_model->insertDoctor($data_d);
                    $doctor_user_id = $this->db->get_where('doctor', array('email' => $d_email))->row()->id;
                    $id_info = array('ion_user_id' => $ion_user_id);
                    $this->doctor_model->updateDoctor($doctor_user_id, $id_info);
                    $this->hospital_model->addHospitalIdToIonUser($ion_user_id, $this->hospital_id);
                }
            }


            if ($patient == 'add_new') {
                $patient = $patient_user_id;
            }

            if ($doctor == 'add_new') {
                $doctor = $doctor_user_id;
            }











            $percent_discount = $this->input->post('percent_discount');
            $amount = array_sum($amount_by_category);
            $sub_total = $amount;
            $discount_type = $this->finance_model->getDiscountType();
            if (!empty($doctor)) {
                $all_cat_name = explode(',', $category_name);
                foreach ($all_cat_name as $indiviual_cat_nam) {
                    $indiviual_cat_nam1 = explode('*', $indiviual_cat_nam);
                    $qty = $indiviual_cat_nam1[3];
                    $d_commission = $this->finance_model->getPaymentCategoryById($indiviual_cat_nam1[0])->d_commission;
                    $h_commission = 100 - $d_commission;
                    $hospital_amount_per_unit = $indiviual_cat_nam1[1] * $h_commission / 100;
                    $hospital_amount_by_category[] = $hospital_amount_per_unit * $qty;
                }
                $hospital_amount = array_sum($hospital_amount_by_category) + $vat;
                if ($discount_type == 'flat') {
                    $flat_discount = $discount;
                    $gross_total = $sub_total - $flat_discount + $vat;
                    $doctor_amount = $amount - $hospital_amount - $flat_discount + $vat;
                } else {
                    $flat_discount = $sub_total * ($discount / 100);
                    $gross_total = $sub_total - $flat_discount + $vat;
                    $doctor_amount = $amount - $hospital_amount - $flat_discount + $vat;
                }
            } else {
                $doctor_amount = '0';
                if ($discount_type == 'flat') {
                    $flat_discount = $discount;
                    $gross_total = $sub_total - $flat_discount + $vat;
                    $hospital_amount = $gross_total;
                } else {
                    $flat_discount = $amount * ($discount / 100);
                    $gross_total = $sub_total - $flat_discount + $vat;
                    $hospital_amount = $gross_total;
                }
            }
            $data = array();

            if (!empty($patient)) {
                $patient_details = $this->patient_model->getPatientById($patient);
                $patient_name = $patient_details->name;
                $patient_phone = $patient_details->phone;
                $patient_address = $patient_details->address;
                $patient_email = $patient_details->email;
            } else {
                $patient_name = 0;
                $patient_phone = 0;
                $patient_address = 0;
            }

            if (!empty($doctor)) {
                $doctor_details = $this->doctor_model->getDoctorById($doctor);
                $doctor_name = $doctor_details->name;
            } else {
                $doctor_name = 0;
            }

            if (empty($id)) {
                $data = array(
                    'category_name' => $category_name,
                    'patient' => $patient,
                    'date' => $date,
                    'amount' => $sub_total,
                    'doctor' => $doctor,
                    'discount' => $discount,
                    'flat_discount' => $flat_discount,
                    'gross_total' => $gross_total,
                    'status' => 'unpaid',
                    'hospital_amount' => $hospital_amount,
                    'doctor_amount' => $doctor_amount,
                    'user' => $user,
                    'patient_name' => $patient_name,
                    'patient_phone' => $patient_phone,
                    'patient_address' => $patient_address,
                    'doctor_name' => $doctor_name,
                    'date_string' => $date_string,
                    'remarks' => $remarks,
                    'payment_from' => 'payment',
                    'date_delivery' => $date_delivery,
                    'time_delivery' => $time,
                    'vat' => $vat,
                    'percent_discount' => $percent_discount,
                    'vat_amount_percent' => $vat_amount
                );

                $this->finance_model->insertPayment($data);
                $inserted_id = $this->db->insert_id();

                if (!empty($item_selected)) {
                    foreach ($item_selected as $key => $items) {
                        $patient_category = $this->finance_model->getPaymentCategoryById($items);
                        if ($patient_category->type == 'diagnostic') {
                            $lab_report = array();
                            $lab_report = array(
                                'patient' => $patient,
                                'doctor' => $doctor,
                                'user' => $user,
                                'patient_name' => $patient_name,
                                'patient_phone' => $patient_phone,
                                'patient_address' => $patient_address,
                                'doctor_name' => $doctor_name,
                                'test_status' => 'not_done',
                                'invoice_id' => $inserted_id,
                                'category_id' => $patient_category->id,
                                'date' => time(),
                                'date_string' => date('d-m-y')
                            );
                            $this->lab_model->insertLab($lab_report);
                        }
                    }
                }
                $data_logs = array(
                    'date_time' => date('d-m-Y H:i'),
                    'patientname' => $patient_name,
                    'invoice_id' => $inserted_id,
                    'action' => 'Added',
                    'deposit_type' => $deposit_type,
                    'user' => $this->ion_auth->get_user_id()
                    // 'amount'=>$depos


                );


                //$patient_details = $this->patient_model->getPatientById($patient);
                //sms
                $set['settings'] = $this->settings_model->getSettings();
                $autosms = $this->sms_model->getAutoSmsByType('payment');
                $message = $autosms->message;
                $to = $patient_phone;
                $name1 = explode(' ', $patient_name);
                if (!isset($name1[1])) {
                    $name1[1] = null;
                }
                $data1 = array(
                    'firstname' => $name1[0],
                    'lastname' => $name1[1],
                    'name' => $patient_name,
                    'amount' => $gross_total,
                );

                if ($autosms->status == 'Active') {
                    $messageprint = $this->parser->parse_string($message, $data1);
                    $data2[] = array($to => $messageprint);
                    $this->sms->sendSms($to, $message, $data2);
                }
                //end
                //email 

                $autoemail = $this->email_model->getAutoEmailByType('payment');
                if ($autoemail->status == 'Active') {
                    if ($patient_details->payment_confirmation != 'Inactive') {
                        $mail_provider = $this->settings_model->getSettings()->emailtype;
                        $settngs_name = $this->settings_model->getSettings()->system_vendor;
                        $email_Settings = $this->email_model->getEmailSettingsByType($mail_provider);
                        $message1 = $autoemail->message;
                        $messageprint1 = $this->parser->parse_string($message1, $data1);
                        if ($mail_provider == 'Domain Email') {
                            $this->email->from($email_Settings->admin_email);
                        }
                        if ($mail_provider == 'Smtp') {
                            $this->email->from($email_Settings->user, $settngs_name);
                        }
                        $this->email->to($patient_email);
                        $this->email->subject('Payment confirmation');
                        $this->email->message($messageprint1);
                        $this->email->send();
                    }
                }

                //end


                if ($deposit_type == 'Card') {
                    $gateway = $this->settings_model->getSettings()->payment_gateway;
                    if ($gateway == 'PayPal') {

                        $card_type = $this->input->post('card_type');
                        $card_number = $this->input->post('card_number');
                        $expire_date = $this->input->post('expire_date');
                        $cvv = $this->input->post('cvv');

                        $all_details = array(
                            'patient' => $patient,
                            'date' => $date,
                            'amount' => $sub_total,
                            'doctor' => $doctor,
                            'discount' => $discount,
                            'flat_discount' => $flat_discount,
                            'gross_total' => $gross_total,
                            'status' => 'unpaid',
                            'hospital_amount' => $hospital_amount,
                            'doctor_amount' => $doctor_amount,
                            'patient_name' => $patient_name,
                            'patient_phone' => $patient_phone,
                            'patient_address' => $patient_address,
                            'doctor_name' => $doctor_name,
                            'date_string' => $date_string,
                            'remarks' => $remarks,
                            'deposited_amount' => $amount_received,
                            'payment_id' => $inserted_id,
                            'card_type' => $card_type,
                            'card_number' => $card_number,
                            'expire_date' => $expire_date,
                            'cvv' => $cvv,
                            'from' => 'pos',
                            'user' => $user,
                            'cardholdername' => $this->input->post('cardholder'),
                            'form_submit' => $form_submit
                        );
                        //    $data_payments['all_details'] = $all_details;
                        //    $this->load->view('home/dashboard'); 
                        //    $this->load->view('paypal/confirmation', $data_payments);
                        //    $this->load->view('home/footer'); 
                        $data_logs['amount'] = $amount_received;
                        $this->logs_model->insertTransactionLogs($data_logs);
                        $this->paypal->paymentPaypal($all_details);
                    } elseif ($gateway == 'Paystack') {


                        $ref = date('Y') . '-' . rand() . date('d') . '-' . date('m');
                        $amount_in_kobo = $amount_received;
                        $data_logs['amount'] = $amount_received;
                        $this->logs_model->insertTransactionLogs($data_logs);
                        $this->load->module('paystack');
                        $redirect = '0' . $form_submit;
                        $this->paystack->paystack_standard($amount_in_kobo, $ref, $patient, $inserted_id, $user, $redirect);

                        // $email=$patient_email;
                    } elseif ($gateway == 'Stripe') {
                        $card_number = $this->input->post('card_number');
                        $expire_date = $this->input->post('expire_date');
                        $cvv = $this->input->post('cvv');
                        $token = $this->input->post('token');
                        $stripe = $this->pgateway_model->getPaymentGatewaySettingsByName('Stripe');
                        // $stripe = $this->db->get_where('paymentGateway', array('name =' => 'Stripe','hospital_id', $this->session->userdata('hospital_id')))->row();
                        \Stripe\Stripe::setApiKey($stripe->secret);
                        $charge = \Stripe\Charge::create(array(
                            "amount" => $amount_received * 100,
                            "currency" => "usd",
                            "source" => $token
                        ));
                        $chargeJson = $charge->jsonSerialize();
                        if ($chargeJson['status'] == 'succeeded') {
                            $data1 = array(
                                'date' => $date,
                                'patient' => $patient,
                                'payment_id' => $inserted_id,
                                'deposited_amount' => $amount_received,
                                'amount_received_id' => $inserted_id . '.' . 'gp',
                                'gateway' => 'Stripe',
                                'user' => $user,
                                'hospital_id' => $this->session->userdata('hospital_id')
                            );
                            $data1['payment_from'] = 'payment';

                            $this->finance_model->insertDeposit($data1);
                            $data_logs['amount'] = $amount_received;
                            $this->logs_model->insertTransactionLogs($data_logs);
                            $data_payment = array('amount_received' => $amount_received, 'deposit_type' => $deposit_type);
                            $this->finance_model->updatePayment($inserted_id, $data_payment);
                        } else {
                            $this->session->set_flashdata('feedback', lang('transaction_failed'));
                        }
                        if ($form_submit == 'save') {
                            redirect("finance/invoice?id=" . "$inserted_id");
                        } else {
                            redirect("finance/printInvoice?id=" . $inserted_id);
                        }
                    } elseif ($gateway == 'Pay U Money') {
                        $data_logs['amount'] = $amount_received;
                        $this->logs_model->insertTransactionLogs($data_logs);

                        redirect("payu/check1?deposited_amount=" . "$amount_received" . '&payment_id=' . $inserted_id . '&form_submit' . $form_submit);
                    } else {
                        $this->session->set_flashdata('feedback', lang('payment_failed_no_gateway_selected'));
                        if ($form_submit == 'save') {
                            redirect("finance/invoice?id=" . "$inserted_id");
                        } else {
                            redirect("finance/printInvoice?id=" . $inserted_id);
                        }
                    }
                } else {
                    $data_logs['amount'] = $amount_received;

                    $this->logs_model->insertTransactionLogs($data_logs);
                    $data1 = array(
                        'date' => $date,
                        'patient' => $patient,
                        'deposited_amount' => $amount_received,
                        'payment_id' => $inserted_id,
                        'amount_received_id' => $inserted_id . '.' . 'gp',
                        'deposit_type' => $deposit_type,
                        'user' => $user
                    );
                    $this->finance_model->insertDeposit($data1);

                    $data_payment = array('amount_received' => $amount_received, 'deposit_type' => $deposit_type);
                    $this->finance_model->updatePayment($inserted_id, $data_payment);

                    $this->session->set_flashdata('feedback', lang('added'));
                    if ($form_submit == 'save') {
                        redirect("finance/invoice?id=" . "$inserted_id");
                    } else {
                        redirect("finance/printInvoice?id=" . $inserted_id);
                    }
                }
            } else {
                $deposit_edit_amount = $this->input->post('deposit_edit_amount');
                $deposit_edit_id = $this->input->post('deposit_edit_id');
                if (!empty($deposit_edit_amount)) {
                    $deposited_edit = array_combine($deposit_edit_id, $deposit_edit_amount);
                    foreach ($deposited_edit as $key_deposit => $value_deposit) {
                        $data_deposit = array(
                            'deposited_amount' => $value_deposit
                        );
                        $this->finance_model->updateDeposit($key_deposit, $data_deposit);
                    }
                }


                $a_r_i = $id . '.' . 'gp';
                $deposit_id = $this->db->get_where('patient_deposit', array('amount_received_id' => $a_r_i))->row();

                $data = array(
                    'category_name' => $category_name,
                    'patient' => $patient,
                    'doctor' => $doctor,
                    'amount' => $sub_total,
                    'discount' => $discount,
                    'flat_discount' => $flat_discount,
                    'gross_total' => $gross_total,
                    'amount_received' => $amount_received,
                    'hospital_amount' => $hospital_amount,
                    'doctor_amount' => $doctor_amount,
                    'user' => $user,
                    'patient_name' => $patient_details->name,
                    'patient_phone' => $patient_details->phone,
                    'patient_address' => $patient_details->address,
                    'doctor_name' => $doctor_details->name,
                    'remarks' => $remarks,
                    'vat' => $vat,
                    'percent_discount' => $percent_discount,
                    'vat_amount_percent' => $vat_amount
                );
                $data_logs = array(
                    'date_time' => date('d-m-Y H:i'),
                    'patientname' => $patient_details->name,
                    'invoice_id' => $id,
                    'action' => 'Updated',
                    'user' => $this->ion_auth->get_user_id()
                    //  'deposit_type'=>$deposit_type,
                    // 'amount'=>$depos


                );
                $lab_reports_previous = $this->lab_model->getLabByInvoice($id);
                if (!empty($lab_reports_previous)) {
                    foreach ($lab_reports_previous as $lab) {
                        $this->lab_model->deleteLab($lab->id);
                    }
                }
                if (!empty($item_selected)) {

                    foreach ($item_selected as $items) {
                        $patient_category = $this->finance_model->getPaymentCategoryById($items);

                        if ($patient_category->type == 'diagnostic') {
                            $lab_report = array();
                            $lab_report = array(
                                'patient' => $patient,
                                'doctor' => $doctor,
                                'user' => $user,
                                'patient_name' => $patient_name,
                                'patient_phone' => $patient_phone,
                                'patient_address' => $patient_address,
                                'doctor_name' => $doctor_name,
                                'test_status' => 'not_done',
                                'invoice_id' => $id,
                                'category_id' => $patient_category->id,
                                'date' => time(),
                                'date_string' => date('d-m-y')
                            );

                            $this->lab_model->insertLab($lab_report);
                        }
                    }
                }

                if (!empty($deposit_id->id)) {
                    $data1 = array(
                        // 'date' => $date,
                        'patient' => $patient,
                        'payment_id' => $id,
                        'deposited_amount' => $amount_received,
                        'user' => $user
                    );
                    $this->finance_model->updateDeposit($deposit_id->id, $data1);
                    $data_logs['amount'] = $amount_received;
                    $data_logs['deposit_type'] = $deposit_id->deposit_type;
                    $this->logs_model->insertTransactionLogs($data_logs);
                } else {
                    $data1 = array(
                        'date' => $date,
                        'patient' => $patient,
                        'payment_id' => $id,
                        'deposited_amount' => $amount_received,
                        'amount_received_id' => $id . '.' . 'gp',
                        'user' => $user
                    );
                    $data_logs['amount'] = $amount_received;
                    $data_logs['deposit_type'] = $deposit_id->deposit_type;
                    $this->logs_model->insertTransactionLogs($data_logs);
                    $this->finance_model->insertDeposit($data1);
                }


                $this->finance_model->updatePayment($id, $data);
                $this->session->set_flashdata('feedback', lang('updated'));
                redirect("finance/invoice?id=" . "$id");
            }
        }
    }

    function editPayment()
    {
        if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist'))) {
            $data = array();
            $data['discount_type'] = $this->finance_model->getDiscountType();
            $data['settings'] = $this->settings_model->getSettings();
            $data['categories'] = $this->finance_model->getPaymentCategory();
            // $data['patients'] = $this->patient_model->getPatient();
            //  $data['doctors'] = $this->doctor_model->getDoctor();
            $id = $this->input->get('id');

            if (!empty($id)) {
                $payment_details = $this->finance_model->getPaymentById($id);
                if ($payment_details->hospital_id != $this->session->userdata('hospital_id')) {
                    redirect('home/permission');
                }
            }

            $data['payment'] = $this->finance_model->getPaymentById($id);
            $data['patients'] = $this->patient_model->getPatientById($data['payment']->patient);
            $data['doctors'] = $this->doctor_model->getDoctorById($data['payment']->doctor);
            $this->load->view('home/dashboard');
            $this->load->view('finance/add_payment_view', $data);
            $this->load->view('home/footer');
        }
    }

    function delete()
    {
        if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist'))) {
            $id = $this->input->get('id');

            if (!empty($id)) {
                $payment_details = $this->finance_model->getPaymentById($id);
                if ($payment_details->hospital_id != $this->session->userdata('hospital_id')) {
                    redirect('home/permission');
                }
            }
            $data_logs = array(
                'date_time' => date('d-m-Y H:i'),
                'patientname' => $payment_details->patient_name,
                'invoice_id' => $payment_details->id,
                'action' => 'deleted',
                'deposit_type' => $payment_details->deposit_type,
                'user' => $this->ion_auth->get_user_id(),
                'amount' => $payment_details->amount_received


            );

            $this->finance_model->deletePayment($id);
            $this->logs_model->insertTransactionLogs($data_logs);
            $this->finance_model->deleteDepositByInvoiceId($id);
            $this->finance_model->deleteLabByInvoiceId($id);
            $this->session->set_flashdata('feedback', lang('deleted'));
            redirect('finance/payment');
        }
    }

    public function otPayment()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $data['settings'] = $this->settings_model->getSettings();
        $data['ot_payments'] = $this->finance_model->getOtPayment();

        $this->load->view('home/dashboard');
        $this->load->view('finance/ot_payment', $data);
        $this->load->view('home/footer');
    }

    public function addOtPaymentView()
    {
        $data = array();
        $data['doctors'] = $this->doctor_model->getDoctor();
        $data['discount_type'] = $this->finance_model->getDiscountType();
        $data['settings'] = $this->settings_model->getSettings();
        $data['categories'] = $this->finance_model->getPaymentCategory();
        $data['patients'] = $this->patient_model->getPatient();
        $this->load->view('home/dashboard');
        $this->load->view('finance/add_ot_payment', $data);
        $this->load->view('home/footer');
    }

    public function addOtPayment()
    {
        $id = $this->input->post('id');
        $patient = $this->input->post('patient');
        $doctor_c_s = $this->input->post('doctor_c_s');
        $doctor_a_s_1 = $this->input->post('doctor_a_s_1');
        $doctor_a_s_2 = $this->input->post('doctor_a_s_2');
        $doctor_anaes = $this->input->post('doctor_anaes');
        $n_o_o = $this->input->post('n_o_o');

        $c_s_f = $this->input->post('c_s_f');
        $a_s_f_1 = $this->input->post('a_s_f_1');
        $a_s_f_2 = $this->input->post('a_s_f_2');
        $anaes_f = $this->input->post('anaes_f');
        $ot_charge = $this->input->post('ot_charge');
        $cab_rent = $this->input->post('cab_rent');
        $seat_rent = $this->input->post('seat_rent');
        $others = $this->input->post('others');

        $discount = $this->input->post('discount');
        $vat = $this->input->post('vat');
        $amount_received = $this->input->post('amount_received');

        $date = time();
        $user = $this->ion_auth->get_user_id();

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        // Validating Patient Field
        $this->form_validation->set_rules('patient', 'Patient', 'trim|required|min_length[2]|max_length[100]|xss_clean');
        // Validating Consultant surgeon Field
        $this->form_validation->set_rules('doctor_c_s', 'Consultant surgeon', 'trim|min_length[1]|max_length[100]|xss_clean');
        // Validating Assistant Surgeon Field
        $this->form_validation->set_rules('doctor_a_s_1', 'Assistant Surgeon (1)', 'trim|min_length[1]|max_length[100]|xss_clean');
        // Validating Assistant Surgeon Field
        $this->form_validation->set_rules('doctor_a_s_2', 'Assistant Surgeon(2)', 'trim|min_length[1]|max_length[100]|xss_clean');
        // Validating Anaesthisist Field
        $this->form_validation->set_rules('doctor_anaes', 'Anaesthisist', 'trim|min_length[2]|max_length[100]|xss_clean');
        // Validating Nature Of Operation Field
        $this->form_validation->set_rules('n_o_o', 'Nature Of Operation', 'trim|min_length[1]|max_length[100]|xss_clean');
        // Validating Consultant Surgeon Fee Field
        $this->form_validation->set_rules('c_s_f', 'Consultant Surgeon Fee', 'trim|min_length[1]|max_length[100]|xss_clean');
        // Validating Assistant surgeon fee Field
        $this->form_validation->set_rules('a_s_f_1', 'Assistant surgeon fee', 'trim|min_length[1]|max_length[100]|xss_clean');
        // Validating Assistant surgeon fee Field
        $this->form_validation->set_rules('a_s_f_2', 'Assistant surgeon fee', 'trim|min_length[1]|max_length[100]|xss_clean');
        // Validating Anaesthesist Field
        $this->form_validation->set_rules('anaes_f', 'Anaesthesist', 'trim|min_length[1]|max_length[100]|xss_clean');
        // Validating OT Charge Field
        $this->form_validation->set_rules('ot_charge', 'OT Charge', 'trim|min_length[1]|max_length[100]|xss_clean');
        // Validating Cabin Rent Field
        $this->form_validation->set_rules('cab_rent', 'Cabin Rent', 'trim|min_length[1]|max_length[100]|xss_clean');
        // Validating Seat Rent Field
        $this->form_validation->set_rules('seat_rent', 'Seat Rent', 'trim|min_length[1]|max_length[100]|xss_clean');
        // Validating Others Field
        $this->form_validation->set_rules('others', 'Others', 'trim|min_length[1]|max_length[100]|xss_clean');
        // Validating Discount Field
        $this->form_validation->set_rules('discount', 'Discount', 'trim|min_length[1]|max_length[100]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            echo 'form validate noe nai re';
            // redirect('accountant/add_new'); 
        } else {
            $doctor_fees = $c_s_f + $a_s_f_1 + $a_s_f_2 + $anaes_f;
            $hospital_fees = $ot_charge + $cab_rent + $seat_rent + $others;
            $amount = $doctor_fees + $hospital_fees;
            $discount_type = $this->finance_model->getDiscountType();

            if ($discount_type == 'flat') {
                $amount_with_discount = $amount - $discount;
                $gross_total = $amount_with_discount + $amount_with_discount * ($vat / 100);
                $flat_discount = $discount;
                $flat_vat = $amount_with_discount * ($vat / 100);
                $hospital_fees = $hospital_fees - $flat_discount;
            } else {
                $flat_discount = $amount * ($discount / 100);
                $amount_with_discount = $amount - $amount * ($discount / 100);
                $gross_total = $amount_with_discount + $amount_with_discount * ($vat / 100);
                $discount = $discount . '*' . $amount * ($discount / 100);
                $flat_vat = $amount_with_discount * ($vat / 100);
                $hospital_fees = $hospital_fees - $flat_discount;
            }

            $data = array();

            if (empty($id)) {
                $data = array(
                    'patient' => $patient,
                    'doctor_c_s' => $doctor_c_s,
                    'doctor_a_s_1' => $doctor_a_s_1,
                    'doctor_a_s_2' => $doctor_a_s_2,
                    'doctor_anaes' => $doctor_anaes,
                    'n_o_o' => $n_o_o,
                    'c_s_f' => $c_s_f,
                    'a_s_f_1' => $a_s_f_1,
                    'a_s_f_2' => $a_s_f_2,
                    'anaes_f' => $anaes_f,
                    'ot_charge' => $ot_charge,
                    'cab_rent' => $cab_rent,
                    'seat_rent' => $seat_rent,
                    'others' => $others,
                    'discount' => $discount,
                    'date' => $date,
                    'amount' => $amount,
                    'doctor_fees' => $doctor_fees,
                    'hospital_fees' => $hospital_fees,
                    'gross_total' => $gross_total,
                    'flat_discount' => $flat_discount,
                    'amount_received' => $amount_received,
                    'status' => 'unpaid',
                    'user' => $user
                );
                $this->finance_model->insertOtPayment($data);
                $inserted_id = $this->db->insert_id();
                $data1 = array(
                    'date' => $date,
                    'patient' => $patient,
                    'deposited_amount' => $amount_received,
                    'amount_received_id' => $inserted_id . '.' . 'ot',
                    'user' => $user
                );
                $this->finance_model->insertDeposit($data1);

                $this->session->set_flashdata('feedback', lang('added'));
                redirect("finance/otInvoice?id=" . "$inserted_id");
            } else {
                $a_r_i = $id . '.' . 'ot';
                $deposit_id = $this->db->get_where('patient_deposit', array('amount_received_id' => $a_r_i))->row()->id;
                $data = array(
                    'patient' => $patient,
                    'doctor_c_s' => $doctor_c_s,
                    'doctor_a_s_1' => $doctor_a_s_1,
                    'doctor_a_s_2' => $doctor_a_s_2,
                    'doctor_anaes' => $doctor_anaes,
                    'n_o_o' => $n_o_o,
                    'c_s_f' => $c_s_f,
                    'a_s_f_1' => $a_s_f_1,
                    'a_s_f_2' => $a_s_f_2,
                    'anaes_f' => $anaes_f,
                    'ot_charge' => $ot_charge,
                    'cab_rent' => $cab_rent,
                    'seat_rent' => $seat_rent,
                    'others' => $others,
                    'discount' => $discount,
                    'amount' => $amount,
                    'doctor_fees' => $doctor_fees,
                    'hospital_fees' => $hospital_fees,
                    'gross_total' => $gross_total,
                    'flat_discount' => $flat_discount,
                    'amount_received' => $amount_received,
                    'user' => $user
                );
                $data1 = array(
                    'date' => $date,
                    'patient' => $patient,
                    'deposited_amount' => $amount_received,
                    'user' => $user
                );
                $this->finance_model->updateDeposit($deposit_id, $data1);
                $this->finance_model->updateOtPayment($id, $data);
                $this->session->set_flashdata('feedback', lang('updated'));
                redirect("finance/otInvoice?id=" . "$id");
            }
        }
    }

    function editOtPayment()
    {
        if ($this->ion_auth->in_group(array('admin', 'Accountant'))) {
            $data = array();
            $data['discount_type'] = $this->finance_model->getDiscountType();
            $data['settings'] = $this->settings_model->getSettings();
            $data['patients'] = $this->patient_model->getPatient();
            $id = $this->input->get('id');
            $data['ot_payment'] = $this->finance_model->getOtPaymentById($id);
            $data['doctors'] = $this->doctor_model->getDoctor();
            $this->load->view('home/dashboard');
            $this->load->view('finance/add_ot_payment', $data);
            $this->load->view('home/footer');
        }
    }

    function otInvoice()
    {
        $id = $this->input->get('id');
        $data['settings'] = $this->settings_model->getSettings();
        $data['discount_type'] = $this->finance_model->getDiscountType();
        $data['ot_payment'] = $this->finance_model->getOtPaymentById($id);
        $this->load->view('home/dashboard');
        $this->load->view('finance/ot_invoice', $data);
        $this->load->view('home/footer');
    }

    function otPaymentDetails()
    {
        $id = $this->input->get('id');
        $patient = $this->input->get('patient');
        $data['patient'] = $this->patient_model->getPatientByid($patient);
        $data['settings'] = $this->settings_model->getSettings();
        $data['discount_type'] = $this->finance_model->getDiscountType();
        $data['ot_payment'] = $this->finance_model->getOtPaymentById($id);
        $this->load->view('home/dashboard');
        $this->load->view('finance/ot_payment_details', $data);
        $this->load->view('home/footer');
    }

    function otPaymentDelete()
    {
        if ($this->ion_auth->in_group(array('admin', 'Accountant'))) {
            $id = $this->input->get('id');
            $this->finance_model->deleteOtPayment($id);
            $this->session->set_flashdata('feedback', lang('deleted'));
            redirect('finance/otPayment');
        }
    }

    function addPaymentByPatient()
    {
        $data = array();
        $id = $this->input->get('id');
        $data['patient'] = $this->patient_model->getPatientById($id);
        $this->load->view('home/dashboard');
        $this->load->view('finance/choose_payment_type', $data);
        $this->load->view('home/footer');
    }

    function addPaymentByPatientView()
    {
        $id = $this->input->get('id');
        $type = $this->input->get('type');
        $data = array();
        $data['discount_type'] = $this->finance_model->getDiscountType();
        $data['settings'] = $this->settings_model->getSettings();
        $data['categories'] = $this->finance_model->getPaymentCategory();
        $data['gateway'] = $this->finance_model->getGatewayByName($data['settings']->payment_gateway);
        $data['doctors'] = $this->doctor_model->getDoctor();

        $data['patient'] = $this->patient_model->getPatientById($id);
        if ($type == 'gen') {
            $this->load->view('home/dashboard');
            $this->load->view('finance/add_payment_view_single', $data);
            $this->load->view('home/footer');
        } else {
            $this->load->view('home/dashboard');
            $this->load->view('finance/add_ot_payment_view_single', $data);
            $this->load->view('home/footer');
        }
    }

    public function paymentCategory()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $data['paycategories'] = $this->finance_model->getCategory();
        $data['categories'] = $this->finance_model->getPaymentCategory();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard');
        $this->load->view('finance/payment_category', $data);
        $this->load->view('home/footer');
    }

    public function addPaymentCategoryView()
    {
        $data['paycategories'] = $this->finance_model->getCategory();
        $this->load->view('home/dashboard');
        $this->load->view('finance/add_payment_category', $data);
        $this->load->view('home/footer');
    }

    public function addPaymentCategory()
    {
        $id = $this->input->post('id');
        $category = $this->input->post('category');
        $type = $this->input->post('type');
        $description = $this->input->post('description');
        $c_price = $this->input->post('c_price');
        $payment_category = $this->input->post('payment_category');
        $payment_category_name =  $this->finance_model->getCategoryById($payment_category)->category;
        $code = $this->input->post('code');
        $d_commission = $this->input->post('d_commission');
        if (empty($c_price)) {
            $c_price = 0;
        }


        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Category Name Field
        $this->form_validation->set_rules('category', 'Category', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Description Field
        $this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Description Field
        $this->form_validation->set_rules('c_price', 'Category price', 'trim|min_length[1]|max_length[100]|xss_clean');
        // Validating Doctor Commission Rate Field
        $this->form_validation->set_rules('d_commission', 'Doctor Commission rate', 'trim|min_length[1]|max_length[100]|xss_clean');
        // Validating Description Field
        $this->form_validation->set_rules('type', 'Type', 'trim|min_length[1]|max_length[100]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                $this->session->set_flashdata('feedback', lang('validation_error'));
                redirect('finance/editPaymentCategory?id=' . $id);
            } else {
                $data = array();
                $data['paycategories'] = $this->finance_model->getCategory();
                $data['setval'] = 'setval';
                $this->load->view('home/dashboard');
                $this->load->view('finance/add_payment_category', $data);
                $this->load->view('home/footer');
            }
        } else {
            $data = array();
            $data = array(
                'category' => $category,
                'description' => $description,
                'type' => $type,
                'c_price' => $c_price,
                'd_commission' => $d_commission,
                'code' => $code,
                'payment_category' => $payment_category,
                'payment_category_name' => $payment_category_name
            );
            if (empty($id)) {
                $this->finance_model->insertPaymentCategory($data);
                $this->session->set_flashdata('feedback', lang('added'));
            } else {
                $this->finance_model->updatePaymentCategory($id, $data);
                $this->session->set_flashdata('feedback', lang('updated'));
            }
            redirect('finance/paymentCategory');
        }
    }

    function editPaymentCategory()
    {
        $data = array();
        $id = $this->input->get('id');
        $data['paycategories'] = $this->finance_model->getCategory();
        $data['category'] = $this->finance_model->getPaymentCategoryById($id);
        $this->load->view('home/dashboard');
        $this->load->view('finance/add_payment_category', $data);
        $this->load->view('home/footer');
    }

    function editPaymentCategoryByjason()
    {
        $id = $this->input->get('id');
        $data['payment_category'] = $this->finance_model->getPaymentCategoryById($id);
        echo json_encode($data);
    }


    function deletePaymentCategory()
    {
        $id = $this->input->get('id');
        $this->finance_model->deletePaymentCategory($id);
        redirect('finance/paymentCategory');
    }

    public function expense()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $data['settings'] = $this->settings_model->getSettings();
        $data['expenses'] = $this->finance_model->getExpense();

        $this->load->view('home/dashboard');
        $this->load->view('finance/expense', $data);
        $this->load->view('home/footer');
    }

    public function addExpenseView()
    {
        $data = array();
        $data['settings'] = $this->settings_model->getSettings();
        $data['categories'] = $this->finance_model->getExpenseCategory();
        $this->load->view('home/dashboard');
        $this->load->view('finance/add_expense_view', $data);
        $this->load->view('home/footer');
    }

    public function addExpense()
    {
        $id = $this->input->post('id');
        $category = $this->input->post('category');
        $date = time();
        $amount = $this->input->post('amount');
        $user = $this->ion_auth->get_user_id();
        $note = $this->input->post('note');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        // Validating Category Field
        $this->form_validation->set_rules('category', 'Category', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Generic Name Field
        $this->form_validation->set_rules('amount', 'Amount', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Note Field
        $this->form_validation->set_rules('note', 'Note', 'trim|min_length[1]|max_length[100]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                $this->session->set_flashdata('feedback', lang('validation_error'));
                redirect('finance/editExpense?id=' . $id);
            } else {
                $data = array();
                $data['setval'] = 'setval';
                $data['settings'] = $this->settings_model->getSettings();
                $data['categories'] = $this->finance_model->getExpenseCategory();
                $this->load->view('home/dashboard');
                $this->load->view('finance/add_expense_view', $data);
                $this->load->view('home/footer');
            }
        } else {
            $data = array();
            if (empty($id)) {
                $data = array(
                    'category' => $category,
                    'date' => $date,
                    'datestring' => date('d/m/y', $date),
                    'amount' => $amount,
                    'note' => $note,
                    'user' => $user
                );
            } else {
                $data = array(
                    'category' => $category,
                    'amount' => $amount,
                    'note' => $note,
                    'user' => $user,
                );
            }
            if (empty($id)) {
                $this->finance_model->insertExpense($data);
                $this->session->set_flashdata('feedback', lang('added'));
            } else {
                $this->finance_model->updateExpense($id, $data);
                $this->session->set_flashdata('feedback', lang('updated'));
            }
            redirect('finance/expense');
        }
    }

    function editExpense()
    {
        $data = array();
        $data['categories'] = $this->finance_model->getExpenseCategory();
        $data['settings'] = $this->settings_model->getSettings();
        $id = $this->input->get('id');

        if (!empty($id)) {
            $expense_details = $this->finance_model->getExpenseById($id);
            if ($expense_details->hospital_id != $this->session->userdata('hospital_id')) {
                redirect('home/permission');
            }
        }

        $data['expense'] = $this->finance_model->getExpenseById($id);
        $this->load->view('home/dashboard');
        $this->load->view('finance/add_expense_view', $data);
        $this->load->view('home/footer');
    }

    function deleteExpense()
    {
        $id = $this->input->get('id');

        if (!empty($id)) {
            $expense_details = $this->finance_model->getExpenseById($id);
            if ($expense_details->hospital_id != $this->session->userdata('hospital_id')) {
                redirect('home/permission');
            }
        }

        $this->finance_model->deleteExpense($id);
        redirect('finance/expense');
    }

    public function expenseCategory()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $data['categories'] = $this->finance_model->getExpenseCategory();
        $this->load->view('home/dashboard');
        $this->load->view('finance/expense_category', $data);
        $this->load->view('home/footer');
    }

    public function addExpenseCategoryView()
    {
        $this->load->view('home/dashboard');
        $this->load->view('finance/add_expense_category');
        $this->load->view('home/footer');
    }

    public function addExpenseCategory()
    {
        $id = $this->input->post('id');
        $category = $this->input->post('category');
        $description = $this->input->post('description');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Category Name Field
        $this->form_validation->set_rules('category', 'Category', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Description Field
        $this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                $this->session->set_flashdata('feedback', lang('validation_error'));
                redirect('finance/editExpenseCategory?id=' . $id);
            } else {
                $data = array();
                $data['setval'] = 'setval';
                $this->load->view('home/dashboard');
                $this->load->view('finance/add_expense_category', $data);
                $this->load->view('home/footer');
            }
        } else {
            $data = array();
            $data = array(
                'category' => $category,
                'description' => $description
            );
            if (empty($id)) {
                $this->finance_model->insertExpenseCategory($data);
                $this->session->set_flashdata('feedback', lang('added'));
            } else {
                $this->finance_model->updateExpenseCategory($id, $data);
                $this->session->set_flashdata('feedback', lang('updated'));
            }
            redirect('finance/expenseCategory');
        }
    }

    function editExpenseCategory()
    {
        $data = array();
        $id = $this->input->get('id');

        if (!empty($id)) {
            $expense_category_details = $this->finance_model->getExpenseCategoryById($id);
            if ($expense_category_details->hospital_id != $this->session->userdata('hospital_id')) {
                redirect('home/permission');
            }
        }

        $data['category'] = $this->finance_model->getExpenseCategoryById($id);
        $this->load->view('home/dashboard');
        $this->load->view('finance/add_expense_category', $data);
        $this->load->view('home/footer');
    }

    function deleteExpenseCategory()
    {
        $id = $this->input->get('id');

        if (!empty($id)) {
            $expense_category_details = $this->finance_model->getExpenseCategoryById($id);
            if ($expense_category_details->hospital_id != $this->session->userdata('hospital_id')) {
                redirect('home/permission');
            }
        }

        $this->finance_model->deleteExpenseCategory($id);
        redirect('finance/expenseCategory');
    }

    function invoice()
    {
        $id = $this->input->get('id');
        $data['payment'] = $this->finance_model->getPaymentById($id);
        $patient_hospital_id = $this->patient_model->getPatientById($data['payment']->patient)->hospital_id;
        if ($patient_hospital_id != $this->session->userdata('hospital_id')) {
            redirect('home/permission');
        }
        $data['redirectlink'] = '';
        $data['redirect'] = '';
        $data['settings'] = $this->settings_model->getSettings();
        $data['discount_type'] = $this->finance_model->getDiscountType();
        $data['payment'] = $this->finance_model->getPaymentById($id);
        $this->load->view('home/dashboard');
        if ($data['settings']->invoice_choose == 'invoice1') {
            $this->load->view('finance/invoice_A4', $data);
        } else {
            $this->load->view('finance/invoice_test', $data);
        }

        $this->load->view('home/footer');
    }

    function printInvoice()
    {
        $id = $this->input->get('id');
        $data['settings'] = $this->settings_model->getSettings();
        $data['discount_type'] = $this->finance_model->getDiscountType();
        $data['payment'] = $this->finance_model->getPaymentById($id);

        $patient_hospital_id = $this->patient_model->getPatientById($data['payment']->patient)->hospital_id;
        if ($patient_hospital_id != $this->session->userdata('hospital_id')) {
            redirect('home/permission');
        }
        $data['redirect'] = '';
        $data['redirectlink'] = 'print';
        $this->load->view('home/dashboard');
        if ($data['settings']->invoice_choose == 'invoice1') {
            $this->load->view('finance/invoice_A4', $data);
        } else {
            $this->load->view('finance/invoice_test', $data);
        }
        $this->load->view('home/footer');
    }

    function expenseInvoice()
    {
        $id = $this->input->get('id');

        if (!empty($id)) {
            $expense_details = $this->finance_model->getExpenseById($id);
            if ($expense_details->hospital_id != $this->session->userdata('hospital_id')) {
                redirect('home/permission');
            }
        }

        $data['settings'] = $this->settings_model->getSettings();
        $data['expense'] = $this->finance_model->getExpenseById($id);
        $this->load->view('home/dashboard');
        $this->load->view('finance/expense_invoice', $data);
        $this->load->view('home/footer');
    }

    function amountReceived()
    {
        $id = $this->input->post('id');
        $amount_received = $this->input->post('amount_received');
        $previous_amount_received = $this->db->get_where('payment', array('id' => $id))->row()->amount_received;
        $amount_received = $amount_received + $previous_amount_received;
        $data = array();
        $data = array('amount_received' => $amount_received);
        $this->finance_model->amountReceived($id, $data);
        redirect('finance/invoice?id=' . $id);
    }

    function otAmountReceived()
    {
        $id = $this->input->post('id');
        $amount_received = $this->input->post('amount_received');
        $previous_amount_received = $this->db->get_where('ot_payment', array('id' => $id))->row()->amount_received;
        $amount_received = $amount_received + $previous_amount_received;
        $data = array();
        $data = array('amount_received' => $amount_received);
        $this->finance_model->otAmountReceived($id, $data);
        redirect('finance/oTinvoice?id=' . $id);
    }

    function patientPaymentHistory()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $patient = $this->input->get('patient');
        if (empty($patient)) {
            $patient = $this->input->post('patient');
        }


        $patient_hospital_id = $this->patient_model->getPatientById($patient)->hospital_id;
        if ($patient_hospital_id != $this->session->userdata('hospital_id')) {
            redirect('home/permission');
        }



        $data['settings'] = $this->settings_model->getSettings();
        $date_from = strtotime($this->input->post('date_from'));
        $date_to = strtotime($this->input->post('date_to'));
        if (!empty($date_to)) {
            $date_to = $date_to + 86399;
        }

        $data['date_from'] = $date_from;
        $data['date_to'] = $date_to;

        if (!empty($date_from)) {
            $data['payments'] = $this->finance_model->getPaymentByPatientIdByDate($patient, $date_from, $date_to);
            $data['deposits'] = $this->finance_model->getDepositByPatientIdByDate($patient, $date_from, $date_to);
            $data['gateway'] = $this->finance_model->getGatewayByName($data['settings']->payment_gateway);
        } else {
            $data['payments'] = $this->finance_model->getPaymentByPatientId($patient);
            $data['pharmacy_payments'] = $this->pharmacy_model->getPaymentByPatientId($patient);
            $data['ot_payments'] = $this->finance_model->getOtPaymentByPatientId($patient);
            $data['deposits'] = $this->finance_model->getDepositByPatientId($patient);
            $data['gateway'] = $this->finance_model->getGatewayByName($data['settings']->payment_gateway);
        }



        $data['patient'] = $this->patient_model->getPatientByid($patient);

        $this->load->view('home/dashboard');
        $this->load->view('finance/patient_deposit', $data);
        $this->load->view('home/footer');
    }

    function deposit()
    {
        $id = $this->input->post('id');
        $patient = $this->input->post('patient');
        $patient_details=$this->patient_model->getPatientById($patient);
        $payment_id = $this->input->post('payment_id');

        $date = time();
        $redirect = $this->input->post('redirect');
        $deposited_amount = $this->input->post('deposited_amount');
        $payment_details11=$this->finance_model->getPaymentById($payment_id);
        $deposit_type = $this->input->post('deposit_type');

        if (empty($deposit_type)) {
            $deposit_type = 'Cash';
        }

        $user = $this->ion_auth->get_user_id();

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Patient Name Field
        $this->form_validation->set_rules('patient', 'Patient', 'trim|min_length[1]|max_length[100]|xss_clean');
        // Validating Deposited Amount Field
        $this->form_validation->set_rules('deposited_amount', 'Deposited Amount', 'trim|min_length[1]|max_length[100]|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            if (empty($redirect)) {
                redirect('finance/patientPaymentHistory?patient=' . $patient);
            } else {
                redirect("finance/invoice?id=" . $payment_id);
            }
        } else {
            $data = array();
            // $patient_details =
                $data = array(
                    'patient' => $patient,
                    //  'date' => $date,
                    'payment_id' => $payment_id,
                    'deposited_amount' => $deposited_amount,
                    'deposit_type' => $deposit_type,
                    'user' => $user,
                    'payment_from'=>$payment_details11->payment_from
                );

            if (empty($id)) {
                $data['date'] = $date;
            }
            if (empty($id)) {
                $data_logs = array(
                    'date_time' => date('d-m-Y H:i'),
                    'patientname' => $patient_details->name,
                    'invoice_id' => $payment_id,
                    'action' => 'Added/deposited',
                    'deposit_type' => $deposit_type,
                    'amount' => $deposited_amount,
                    'user' => $this->ion_auth->get_user_id(),
                  


                );

                if ($deposit_type == 'Card') {
                    $payment_details = $this->finance_model->getPaymentById($payment_id);
                    $gateway = $this->settings_model->getSettings()->payment_gateway;

                    if ($gateway == 'PayPal') {
                        $card_type = $this->input->post('card_type');
                        $card_number = $this->input->post('card_number');
                        $expire_date = $this->input->post('expire_date');
                        $cvv = $this->input->post('cvv');
                        if (empty($redirect)) {
                            $redirect = 'deposit';
                        } else {
                            $redirect = 'due';
                        }
                        $all_details = array(
                            'patient' => $payment_details->patient,
                            'date' => $payment_details->date,
                            'amount' => $payment_details->amount,
                            'doctor' => $payment_details->doctor_name,
                            'discount' => $payment_details->discount,
                            'flat_discount' => $payment_details->flat_discount,
                            'gross_total' => $payment_details->gross_total,
                            'status' => 'unpaid',
                            'patient_name' => $payment_details->patient_name,
                            'patient_phone' => $payment_details->patient_phone,
                            'patient_address' => $payment_details->patient_address,
                            'deposited_amount' => $deposited_amount,
                            'payment_id' => $payment_details->id,
                            'card_type' => $card_type,
                            'card_number' => $card_number,
                            'expire_date' => $expire_date,
                            'cvv' => $cvv,
                            'from' => 'patient_payment_details',
                            'user' => $user,
                            'cardholdername' => $this->input->post('cardholder'),
                            'redirect' => $redirect
                        );
                        $this->logs_model->insertTransactionLogs($data_logs);
                        $this->paypal->paymentPaypal($all_details);
                    } elseif ($gateway == 'Paystack') {
                        $ref = date('Y') . '-' . rand() . date('d') . '-' . date('m');
                        $amount_in_kobo = $deposited_amount;
                        $this->load->module('paystack');
                        if (empty($redirect)) {
                            $redirect = '1deposit';
                        } else {
                            $redirect = '1due';
                        }
                        $this->paystack->paystack_standard($amount_in_kobo, $ref, $patient, $payment_id, $user, $redirect);
                    } elseif ($gateway == 'Stripe') {
                        $card_number = $this->input->post('card_number');
                        $expire_date = $this->input->post('expire_date');
                        $cvv = $this->input->post('cvv');
                        $token = $this->input->post('token');
                        $stripe = $this->pgateway_model->getPaymentGatewaySettingsByName('Stripe');
                        \Stripe\Stripe::setApiKey($stripe->secret);
                        $charge = \Stripe\Charge::create(array(
                            "amount" => $deposited_amount * 100,
                            "currency" => "usd",
                            "source" => $token
                        ));
                        $chargeJson = $charge->jsonSerialize();

                        if ($chargeJson['status'] == 'succeeded') {
                            $data1 = array(
                                'date' => $date,
                                'patient' => $patient,
                                'payment_id' => $payment_id,
                                'deposited_amount' => $deposited_amount,
                                'gateway' => 'Stripe',
                                'deposit_type' => 'Card',
                                'user' => $user,
                                'hospital_id' => $this->session->userdata('hospital_id'),
                                'payment_from'=>$payment_details->payment_from
                            );

                            $this->finance_model->insertDeposit($data1);
                            $this->logs_model->insertTransactionLogs($data_logs);
                            $this->session->set_flashdata('feedback', lang('added'));
                        } else {
                            $this->session->set_flashdata('feedback', lang('transaction_failed'));
                        }
                        if (empty($redirect)) {
                            redirect('finance/patientPaymentHistory?patient=' . $patient);
                        } else {
                            redirect("finance/invoice?id=" . $payment_id);
                        }
                    } elseif ($gateway == 'Pay U Money') {
                        $this->logs_model->insertTransactionLogs($data_logs);
                        if (empty($redirect)) {
                            $redirect = 'deposit';
                        } else {
                            $redirect = 'due';
                        }
                        redirect("payu/check?deposited_amount=" . "$deposited_amount" . '&payment_id=' . $payment_id . '&deposit_from=' . $redirect);
                    } else {
                        $this->session->set_flashdata('feedback', lang('payment_failed_no_gateway_selected'));
                        if (empty($redirect)) {
                            redirect('finance/patientPaymentHistory?patient=' . $patient);
                        } else {
                            redirect("finance/invoice?id=" . $payment_id);
                        }
                    }
                } else {
                    $this->logs_model->insertTransactionLogs($data_logs);
                    $this->finance_model->insertDeposit($data);
                    $this->session->set_flashdata('feedback', lang('added'));
                }
            } else {
                $data_logs = array(
                    'date_time' => date('d-m-Y H:i'),
                    'patientname' => $patient_details->name,
                    'invoice_id' => $payment_id,
                    'action' => 'Updated/deposited',
                    'deposit_type' => $deposit_type,
                    'amount' => $deposited_amount,
                    'user' => $this->ion_auth->get_user_id()


                );
                $this->finance_model->updateDeposit($id, $data);
                $this->logs_model->insertTransactionLogs($data_logs);
                $amount_received_id = $this->finance_model->getDepositById($id)->amount_received_id;
                if (!empty($amount_received_id)) {
                    $amount_received_payment_id = explode('.', $amount_received_id);
                    $payment_id = $amount_received_payment_id[0];
                    $data_amount_received = array('amount_received' => $deposited_amount);
                    $this->finance_model->updatePayment($amount_received_payment_id[0], $data_amount_received);
                }

                $this->session->set_flashdata('feedback', lang('updated'));
            }
            if (empty($redirect)) {
                redirect('finance/patientPaymentHistory?patient=' . $patient);
            } else {
                redirect("finance/invoice?id=" . $payment_id);
            }
        }
    }

    function editDepositByJason()
    {
        $id = $this->input->get('id');
        $data['deposit'] = $this->finance_model->getDepositById($id);
        $payment = $this->finance_model->getPaymentById($data['deposit']->payment_id);
        $data['patient'] = $this->patient_model->getPatientById($payment->patient);
        $deposit = $this->finance_model->getDepositByInvoiceId($payment->id);
        if (!empty($deposit)) {
            foreach ($deposit as $depos) {
                $deposits[] = $depos->deposited_amount;
            }
            $data['response'] = $payment->gross_total - array_sum($deposits);
        } else {
            $data['response'] = $payment->gross_total;
        }
        echo json_encode($data);
    }

    function deleteDeposit()
    {
        $id = $this->input->get('id');

        if (!empty($id)) {
            $deposit_details = $this->finance_model->getDepositById($id);
            $patient = $this->patient_model->getPatientById($deposit_details->patient)->name;
            if ($deposit_details->hospital_id != $this->session->userdata('hospital_id')) {
                redirect('home/permission');
            }
        }

        $patient = $this->input->get('patient');

        $amount_received_id = $this->finance_model->getDepositById($id)->amount_received_id;
        if (!empty($amount_received_id)) {
            $amount_received_payment_id = explode('.', $amount_received_id);
            $payment_id = $amount_received_payment_id[0];
            $data_amount_received = array('amount_received' => NULL);
            $this->finance_model->updatePayment($amount_received_payment_id[0], $data_amount_received);
        }
        $data_logs = array(
            'date_time' => date('d-m-Y H:i'),
            'patientname' => $patient,
            'invoice_id' => $deposit_details->payment_id,
            'action' => 'deleted_deposit',
            'deposit_type' => $deposit_details->deposit_type,
            'user' => $this->ion_auth->get_user_id(),
            'amount' => $deposit_details->deposited_amount


        );

        $this->finance_model->deleteDeposit($id);
        $this->logs_model->insertTransactionLogs($data_logs);
        redirect('finance/patientPaymentHistory?patient=' . $patient);
    }

    function invoicePatientTotal()
    {
        $id = $this->input->get('id');
        $data['settings'] = $this->settings_model->getSettings();
        $data['discount_type'] = $this->finance_model->getDiscountType();
        $data['payments'] = $this->finance_model->getPaymentByPatientIdByStatus($id);
        $data['ot_payments'] = $this->finance_model->getOtPaymentByPatientIdByStatus($id);
        $data['patient_id'] = $id;
        $this->load->view('home/dashboard');
        $this->load->view('finance/invoicePT', $data);
        $this->load->view('home/footer');
    }

    function lastPaidInvoice()
    {
        $id = $this->input->get('id');
        $data['settings'] = $this->settings_model->getSettings();
        $data['discount_type'] = $this->finance_model->getDiscountType();
        $data['payments'] = $this->finance_model->lastPaidInvoice($id);
        $data['ot_payments'] = $this->finance_model->lastOtPaidInvoice($id);
        $data['patient_id'] = $id;
        $this->load->view('home/dashboard');
        $this->load->view('finance/LPInvoice', $data);
        $this->load->view('home/footer');
    }

    function makePaid()
    {
        $id = $this->input->get('id');
        $patient_id = $this->finance_model->getPaymentById($id)->patient;
        $data = array();
        $data = array('status' => 'paid');
        $data1 = array();
        $data1 = array('status' => 'paid-last');
        $this->finance_model->makeStatusPaid($id, $patient_id, $data, $data1);
        $this->session->set_flashdata('feedback', lang('paid'));
        redirect('finance/invoice?id=' . $id);
    }

    function makePaidByPatientIdByStatus()
    {
        $id = $this->input->get('id');
        $data = array();
        $data = array('status' => 'paid-last');
        $data1 = array();
        $data1 = array('status' => 'paid');
        $this->finance_model->makePaidByPatientIdByStatus($id, $data, $data1);
        $this->session->set_flashdata('feedback', lang('paid'));
        redirect('patient');
    }

    function makeOtStatusPaid()
    {
        $id = $this->input->get('id');
        $this->finance_model->makeOtStatusPaid($id);
        $this->session->set_flashdata('feedback', lang('paid'));
        redirect("finance/otInvoice?id=" . "$id");
    }

    function doctorsCommission()
    {
        $date_from = strtotime($this->input->post('date_from'));
        $date_to = strtotime($this->input->post('date_to'));
        if (!empty($date_to)) {
            $date_to = $date_to + 86399;
        }
        $data['doctors'] = $this->doctor_model->getDoctor();
        $data['payments'] = $this->finance_model->getPaymentByDate($date_from, $date_to);
        $data['ot_payments'] = $this->finance_model->getOtPaymentByDate($date_from, $date_to);
        $data['settings'] = $this->settings_model->getSettings();
        $data['from'] = $this->input->post('date_from');
        $data['to'] = $this->input->post('date_to');
        $this->load->view('home/dashboard');
        $this->load->view('finance/doctors_commission', $data);
        $this->load->view('home/footer');
    }

    function docComDetails()
    {
        $date_from = strtotime($this->input->post('date_from'));
        $date_to = strtotime($this->input->post('date_to'));
        if (!empty($date_to)) {
            $date_to = $date_to + 86399;
        }
        $doctor = $this->input->get('id');
        if (empty($doctor)) {
            $doctor = $this->input->post('doctor');
        }
        $data['doctor'] = $doctor;
        if (!empty($date_from)) {
            $data['payments'] = $this->finance_model->getPaymentByDoctorDate($doctor, $date_from, $date_to);
        } else {
            $data['payments'] = $this->finance_model->getPaymentByDoctor($doctor);
        }
        $data['settings'] = $this->settings_model->getSettings();
        $data['from'] = $this->input->post('date_from');
        $data['to'] = $this->input->post('date_to');
        $this->load->view('home/dashboard');
        $this->load->view('finance/doc_com_view', $data);
        $this->load->view('home/footer');
    }

    function financialReport()
    {
        $date_from = strtotime($this->input->post('date_from'));
        $date_to = strtotime($this->input->post('date_to'));
        if (!empty($date_to)) {
            $date_to = $date_to + 86399;
        }
        $data = array();
        $data['payment_categories'] = $this->finance_model->getPaymentCategory();
        $data['expense_categories'] = $this->finance_model->getExpenseCategory();

        $data['payments'] = $this->finance_model->getPaymentByDate($date_from, $date_to);
        $data['ot_payments'] = $this->finance_model->getOtPaymentByDate($date_from, $date_to);
        $data['deposits'] = $this->finance_model->getDepositsByDate($date_from, $date_to);
        $data['expenses'] = $this->finance_model->getExpenseByDate($date_from, $date_to);

        $data['from'] = $this->input->post('date_from');
        $data['to'] = $this->input->post('date_to');
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data);
        $this->load->view('finance/financial_report', $data);
        $this->load->view('home/footer');
    }

    function UserActivityReport()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if ($this->ion_auth->in_group(array('Accountant'))) {
            $user = $this->ion_auth->get_user_id();
            $data['user'] = $this->accountant_model->getAccountantByIonUserId($user);
        }
        if ($this->ion_auth->in_group(array('Receptionist'))) {
            $user = $this->ion_auth->get_user_id();
            $data['user'] = $this->receptionist_model->getReceptionistByIonUserId($user);
        }
        $hour = 0;
        $TODAY_ON = $this->input->get('today');
        $YESTERDAY_ON = $this->input->get('yesterday');
        $ALL = $this->input->get('all');

        $today = strtotime($hour . ':00:00');
        $today_last = strtotime($hour . ':00:00') + 86399;
        $data['payments'] = $this->finance_model->getPaymentByUserIdByDate($user, $today, $today_last);
        $data['ot_payments'] = $this->finance_model->getOtPaymentByUserIdByDate($user, $today, $today_last);
        $data['deposits'] = $this->finance_model->getDepositByUserIdByDate($user, $today, $today_last);
        $data['day'] = 'Today';
        if (!empty($YESTERDAY_ON)) {
            $today = strtotime($hour . ':00:00');
            $yesterday = strtotime('-1 day', $today);
            $data['day'] = 'Yesterday';
            $data['payments'] = $this->finance_model->getPaymentByUserIdByDate($user, $yesterday, $today);
            $data['ot_payments'] = $this->finance_model->getOtPaymentByUserIdByDate($user, $yesterday, $today);
            $data['deposits'] = $this->finance_model->getDepositByUserIdByDate($user, $yesterday, $today);
        }
        if (!empty($ALL)) {
            $data['day'] = 'All';
            $data['payments'] = $this->finance_model->getPaymentByUserId($user);
            $data['ot_payments'] = $this->finance_model->getOtPaymentByUserId($user);
            $data['deposits'] = $this->finance_model->getDepositByUserId($user);
        }
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard');
        $this->load->view('finance/user_activity_report', $data);
        $this->load->view('home/footer');
    }

    function UserActivityReportDateWise()
    {
        $data = array();
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        if ($this->ion_auth->in_group(array('Accountant'))) {
            $user = $this->input->post('user');
            $data['user'] = $this->accountant_model->getAccountantByIonUserId($user);
        }
        if ($this->ion_auth->in_group(array('Receptionist'))) {
            $user = $this->input->post('user');
            $data['user'] = $this->receptionist_model->getReceptionistByIonUserId($user);
        }
        $date_from = strtotime($this->input->post('date_from'));
        $date_to = strtotime($this->input->post('date_to'));
        if (!empty($date_to)) {
            $date_to = $date_to + 86399;
        }

        $data['date_from'] = $date_from;
        $data['date_to'] = $date_to;

        $data['payments'] = $this->finance_model->getPaymentByUserIdByDate($user, $date_from, $date_to);
        $data['ot_payments'] = $this->finance_model->getOtPaymentByUserIdByDate($user, $date_from, $date_to);
        $data['deposits'] = $this->finance_model->getDepositByUserIdByDate($user, $date_from, $date_to);
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard');
        $this->load->view('finance/user_activity_report', $data);
        $this->load->view('home/footer');
    }

    function AllUserActivityReport()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $user = $this->input->get('user');

        if (!empty($user)) {
            $user_group = $this->db->get_where('users_groups', array('user_id' => $user))->row()->group_id;
            if ($user_group == '3') {
                $data['user'] = $this->accountant_model->getAccountantByIonUserId($user);
            }
            if ($user_group == '10') {
                $data['user'] = $this->receptionist_model->getReceptionistByIonUserId($user);
            }
            $data['settings'] = $this->settings_model->getSettings();
            $hour = 0;
            $TODAY_ON = $this->input->get('today');
            $YESTERDAY_ON = $this->input->get('yesterday');
            $ALL = $this->input->get('all');

            $today = strtotime($hour . ':00:00');
            $today_last = strtotime($hour . ':00:00') + 86399;
            $data['payments'] = $this->finance_model->getPaymentByUserIdByDate($user, $today, $today_last);
            $data['ot_payments'] = $this->finance_model->getOtPaymentByUserIdByDate($user, $today, $today_last);
            $data['deposits'] = $this->finance_model->getDepositByUserIdByDate($user, $today, $today_last);
            $data['day'] = 'Today';

            if (!empty($YESTERDAY_ON)) {
                $today = strtotime($hour . ':00:00');
                $yesterday = strtotime('-1 day', $today);
                $data['payments'] = $this->finance_model->getPaymentByUserIdByDate($user, $yesterday, $today);
                $data['ot_payments'] = $this->finance_model->getOtPaymentByUserIdByDate($user, $yesterday, $today);
                $data['deposits'] = $this->finance_model->getDepositByUserIdByDate($user, $yesterday, $today);
                $data['day'] = 'Yesterday';
            }

            if (!empty($ALL)) {
                $data['payments'] = $this->finance_model->getPaymentByUserId($user);
                $data['ot_payments'] = $this->finance_model->getOtPaymentByUserId($user);
                $data['deposits'] = $this->finance_model->getDepositByUserId($user);
                $data['day'] = 'All';
            }


            $this->load->view('home/dashboard');
            $this->load->view('finance/user_activity_report', $data);
            $this->load->view('home/footer');
        }

        if (empty($user)) {
            $hour = 0;
            $today = strtotime($hour . ':00:00');
            $today_last = strtotime($hour . ':00:00') + 86399;
            $data['accountants'] = $this->accountant_model->getAccountant();
            $data['receptionists'] = $this->receptionist_model->getReceptionist();
            $data['settings'] = $this->settings_model->getSettings();
            $data['payments'] = $this->finance_model->getPaymentByDate($today, $today_last);
            $data['ot_payments'] = $this->finance_model->getOtPaymentByDate($today, $today_last);
            $data['deposits'] = $this->finance_model->getDepositsByDate($today, $today_last);
            $this->load->view('home/dashboard');
            $this->load->view('finance/all_user_activity_report', $data);
            $this->load->view('home/footer');
        }
    }

    function AllUserActivityReportDateWise()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $user = $this->input->post('user');

        if (!empty($user)) {
            $user_group = $this->db->get_where('users_groups', array('user_id' => $user))->row()->group_id;
            if ($user_group == '3') {
                $data['user'] = $this->accountant_model->getAccountantByIonUserId($user);
            }
            if ($user_group == '10') {
                $data['user'] = $this->receptionist_model->getReceptionistByIonUserId($user);
            }
            $date_from = strtotime($this->input->post('date_from'));
            $date_to = strtotime($this->input->post('date_to'));
            if (!empty($date_to)) {
                $date_to = $date_to + 86399;
            }

            $data['settings'] = $this->settings_model->getSettings();
            $data['date_from'] = $date_from;
            $data['date_to'] = $date_to;
            $data['payments'] = $this->finance_model->getPaymentByUserIdByDate($user, $date_from, $date_to);
            $data['ot_payments'] = $this->finance_model->getOtPaymentByUserIdByDate($user, $date_from, $date_to);
            $data['deposits'] = $this->finance_model->getDepositByUserIdByDate($user, $date_from, $date_to);

            $this->load->view('home/dashboard');
            $this->load->view('finance/user_activity_report', $data);
            $this->load->view('home/footer');
        }

        if (empty($user)) {
            $hour = 0;
            $today = strtotime($hour . ':00:00');
            $today_last = strtotime($hour . ':00:00') + 86399;
            $data['accountants'] = $this->accountant_model->getAccountant();
            $data['receptionists'] = $this->receptionist_model->getReceptionist();
            $data['settings'] = $this->settings_model->getSettings();
            $data['payments'] = $this->finance_model->getPaymentByDate($today, $today_last);
            $data['ot_payments'] = $this->finance_model->getOtPaymentByDate($today, $today_last);
            $data['deposits'] = $this->finance_model->getDepositsByDate($today, $today_last);
            $this->load->view('home/dashboard');
            $this->load->view('finance/all_user_activity_report', $data);
            $this->load->view('home/footer');
        }
    }

    function getPayment()
    {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];
        $settings = $this->settings_model->getSettings();
        $start_date = $_GET['start_date'];
        $end_date = $_GET['end_date'];
        $order = $this->input->post("order");
        $columns_valid = array(
            "0" => "id",
            "1" => "patient",
            "2" => "doctor",
            "3" => "date",
            "4" => "amount",
            "5" => "discount",
            "6" => "gross_total",
        );
        $values = $this->settings_model->getColumnOrder($order, $columns_valid);
        $dir = $values[0];
        $order = $values[1];
        if (empty($start_date) || empty($end_date)) {
            if ($limit == -1) {
                if (!empty($search)) {
                    $data['payments'] = $this->finance_model->getPaymentBysearch($search, $order, $dir);
                } else {
                    $data['payments'] = $this->finance_model->getPaymentWitoutSearch($order, $dir);
                }
            } else {
                if (!empty($search)) {
                    $data['payments'] = $this->finance_model->getPaymentByLimitBySearch($limit, $start, $search, $order, $dir);
                } else {
                    $data['payments'] = $this->finance_model->getPaymentByLimit($limit, $start, $order, $dir);
                }
            }
        } else {
            $start_date_stamp = strtotime($start_date);
            $end_date_stamp = strtotime($end_date);
            if ($limit == -1) {
                if (!empty($search)) {
                    $data['payments'] = $this->finance_model->getPaymentBysearchByDate($search, $order, $dir, $start_date_stamp, $end_date_stamp);
                } else {
                    $data['payments'] = $this->finance_model->getPaymentWitoutSearchByDate($order, $dir, $start_date_stamp, $end_date_stamp);
                }
            } else {
                if (!empty($search)) {
                    $data['payments'] = $this->finance_model->getPaymentByLimitBySearchByDate($limit, $start, $search, $order, $dir, $start_date_stamp, $end_date_stamp);
                } else {
                    $data['payments'] = $this->finance_model->getPaymentByLimitByDate($limit, $start, $order, $dir, $start_date_stamp, $end_date_stamp);
                }
            }
        }



        foreach ($data['payments'] as $payment) {
            $date = date('d-m-y', $payment->date);

            $vat = $payment->vat;
            $discount = $payment->discount;
            if (empty($discount)) {
                $discount = 0;
            }
            $lab_pending = array();
            if ($payment->payment_from == 'payment' || empty($payment->payment_from)) {
                $lab_reports_previous = $this->lab_model->getLabByInvoice($payment->id);

                if (!empty($lab_reports_previous)) {
                    foreach ($lab_reports_previous as $lab) {
                        if ($lab->test_status == 'not_done' || empty($lab->test_status)) {
                            $lab_pending[] = 'no';
                        } else {
                            $lab_sample = 'yes';
                        }
                    }
                }
            }
            if ($this->ion_auth->in_group(array('admin', 'Accountant'))) {
                if ($payment->payment_from == 'payment' || empty($payment->payment_from)) {
                    if (count($lab_reports_previous) == count($lab_pending) || empty($lab_reports_previous)) {
                        $options1 = ' <a class="btn btn-soft-primary btn-xs editbutton" title="' . lang('edit') . '" href="finance/editPayment?id=' . $payment->id . '"><i class="fa fa-edit"> </i> ' . lang('edit') . '</a>';
                    } else {
                        $options1 = '';
                    }
                } elseif ($payment->payment_from == 'appointment') {
                    $appointment_details = $this->appointment_model->getAppointmentById($payment->appointment_id);
                    if ($appointment_details) {
                        $options1 = ' <a class="btn btn-soft-info btn-xs " title="' . lang('edit') . '" href="appointment/editAppointment?id=' . $payment->appointment_id . '"><i class="fa fa-edit"> </i> ' . lang('edit') . '</a>';
                    } else {
                        $options1 = '';
                    }
                } else {
                    $options1 = '';
                }
            }

            $options2 = '<a class="btn btn-soft-info btn-xs " title="' . lang('invoice') . '"  href="finance/invoice?id=' . $payment->id . '"><i class="fa fa-file-invoice"></i> ' . lang('invoice') . '</a>';
            $options4 = '<a class="btn btn-soft-info btn-xs " title="' . lang('print') . '"  href="finance/printInvoice?id=' . $payment->id . '"target="_blank"> <i class="fa fa-print"></i> ' . lang('print') . '</a>';
            if ($this->ion_auth->in_group(array('admin', 'Accountant'))) {
                if ($payment->payment_from == 'payment' || empty($payment->payment_from)) {
                    if (count($lab_reports_previous) == count($lab_pending) || empty($lab_reports_previous)) {
                        $options3 = '<a class="btn btn-soft-danger btn-xs delete_button" title="' . lang('delete') . '" href="finance/delete?id=' . $payment->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"></i> ' . lang('delete') . '</a>';
                    } else {
                        $options3 = '';
                    }
                } else {
                    $options3 = '';
                }
            }

            if (empty($options1)) {
                $options1 = '';
            }

            if (empty($options3)) {
                $options3 = '';
            }

            $doctor_details = $this->doctor_model->getDoctorById($payment->doctor);

            if (!empty($doctor_details)) {
                $doctor = $doctor_details->name;
            } else {
                if (!empty($payment->doctor_name)) {
                    $doctor = $payment->doctor_name;
                } else {
                    $doctor = $payment->doctor_name;
                }
            }

            $patient_info = $this->db->get_where('patient', array('id' => $payment->patient))->row();
            if (!empty($patient_info)) {
                $patient_details = $patient_info->name . '</br>' . $patient_info->address . '</br>' . $patient_info->phone . '</br>';
            } else {
                $patient_details = ' ';
            }
            if ($payment->payment_from == 'appointment') {
                $from = '<span class="badge badge-soft-warning">' . lang('appointment') . '</span>';
            } elseif ($payment->payment_from == 'payment' || empty($payment->payment_from)) {
                $from = '<span class="badge badge-soft-primary">' . lang('opd') . '</span>';
            } elseif ($payment->payment_from == 'admitted_patient_bed_medicine') {
                $from = '<span class="badge badge-soft-warning">' . lang('ipd_medicine') . '</span>';
            } elseif ($payment->payment_from == 'admitted_patient_bed_service') {
                $from = '<span class="badge badge-soft-success">' . lang('ipd_service') . '</span>';
            } elseif ($payment->payment_from == 'admitted_patient_bed_diagnostic') {
                $from = '<span class="badge badge-soft-info">' . lang('ipd_diagnostic') . '</span>';
            }
            $amount[] = $payment->amount;
            $vat_amount[] = $vat;
            $discount_amount[] = $discount;
            $gross[] = $payment->gross_total;
            $deposited_money[] = $this->finance_model->getDepositAmountByPaymentId($payment->id);
            $due_money[] = ($payment->gross_total - $this->finance_model->getDepositAmountByPaymentId($payment->id));
            $info[] = array(
                $payment->id,
                $patient_details,
                $doctor,
                $date,
                $from,
                $settings->currency . '' . $payment->amount,
                $settings->currency . '' . $vat,
                $settings->currency . '' . $discount,
                $settings->currency . '' . $payment->gross_total,
                $settings->currency . '' . $this->finance_model->getDepositAmountByPaymentId($payment->id),
                $settings->currency . '' . ($payment->gross_total - $this->finance_model->getDepositAmountByPaymentId($payment->id)),
                $payment->remarks,
                $options1 . ' ' . $options2 . ' ' . $options4 . ' ' . $options3,
            );
        }
        $info[] = array(
            '',
            '',
            '',
            '',
            '<strong>' . lang('total') . ':</strong>',
            '<strong>' . $settings->currency . ' ' . array_sum($amount) . '</strong>',
            '<strong>' . $settings->currency . ' ' . array_sum($vat_amount) . '</strong>',
            '<strong>' . $settings->currency . ' ' . array_sum($discount_amount) . '</strong>',
            '<strong>' . $settings->currency . ' ' . array_sum($gross) . '</strong>',
            '<strong>' . $settings->currency . ' ' . array_sum($deposited_money) . '</strong>',
            '<strong>' . $settings->currency . ' ' . array_sum($due_money) . '</strong>',
            ' ',
            ' '
        );







        if (!empty($data['payments'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => count($data['payments']),
                "recordsFiltered" => count($data['payments']),
                "data" => $info
            );
        } else {
            $output = array(
                // "draw" => 1,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => []
            );
        }




        echo json_encode($output);
    }

    function previousInvoice()
    {
        $id = $this->input->get('id');
        $data1 = $this->finance_model->getFirstRowPaymentById();
        if ($id == $data1->id) {
            $data = $this->finance_model->getLastRowPaymentById();
            redirect('finance/invoice?id=' . $data->id);
        } else {
            for ($id1 = $id - 1; $id1 >= $data1->id; $id1--) {

                $data = $this->finance_model->getPreviousPaymentById($id1);
                if (!empty($data)) {
                    redirect('finance/invoice?id=' . $data->id);
                    break;
                } elseif ($id1 == $data1->id) {
                    $data = $this->finance_model->getLastRowPaymentById();
                    redirect('finance/invoice?id=' . $data->id);
                } else {
                    continue;
                }
            }
        }
    }

    function nextInvoice()
    {
        $id = $this->input->get('id');

        $data1 = $this->finance_model->getLastRowPaymentById();

        if ($id == $data1->id) {
            $data = $this->finance_model->getFirstRowPaymentById();
            redirect('finance/invoice?id=' . $data->id);
        } else {
            for ($id1 = $id + 1; $id1 <= $data1->id; $id1++) {

                $data = $this->finance_model->getNextPaymentById($id1);

                if (!empty($data)) {
                    redirect('finance/invoice?id=' . $data->id);
                    break;
                } elseif ($id1 == $data1->id) {
                    $data = $this->finance_model->getFirstRowPaymentById();
                    redirect('finance/invoice?id=' . $data->id);
                } else {
                    continue;
                }
            }
        }
    }

    function daily()
    {
        $data = array();
        $year = $this->input->get('year');
        $month = $this->input->get('month');

        if (empty($year)) {
            $year = date('Y');
        }
        if (empty($month)) {
            $month = date('m');
        }

        $first_minute = mktime(0, 0, 0, $month, 1, $year);
        $last_minute = mktime(23, 59, 59, $month, date("t", $first_minute), $year);

        $payments = $this->finance_model->getPaymentByDate($first_minute, $last_minute);
       
        $all_payments = array();
        foreach ($payments as $payment) {
            $date = date('D d-m-y', $payment->date);
            if (array_key_exists($date, $all_payments)) {
                $all_payments[$date] = $all_payments[$date] + $payment->gross_total;
            } else {
                $all_payments[$date] = $payment->gross_total;
            }
        }
        
        $data['year'] = $year;
        $data['month'] = $month;
        $data['first_minute'] = $first_minute;
        $data['last_minute'] = $last_minute;
        $data['all_payments'] = $all_payments;

        $this->load->view('home/dashboard', $data);
        $this->load->view('finance/daily', $data);
        $this->load->view('home/footer');
    }

    function dailyExpense()
    {
        $data = array();
        $year = $this->input->get('year');
        $month = $this->input->get('month');

        if (empty($year)) {
            $year = date('Y');
        }
        if (empty($month)) {
            $month = date('m');
        }

        $first_minute = mktime(0, 0, 0, $month, 1, $year);
        $last_minute = mktime(23, 59, 59, $month, date("t", $first_minute), $year);

        $expenses = $this->finance_model->getExpenseByDate($first_minute, $last_minute);
        $all_expenses = array();
        foreach ($expenses as $expense) {
            $date = date('D d-m-y', $expense->date);
            if (array_key_exists($date, $all_expenses)) {
                $all_expenses[$date] = $all_expenses[$date] + $expense->amount;
            } else {
                $all_expenses[$date] = $expense->amount;
            }
        }

        $data['year'] = $year;
        $data['month'] = $month;
        $data['first_minute'] = $first_minute;
        $data['last_minute'] = $last_minute;
        $data['all_expenses'] = $all_expenses;

        $this->load->view('home/dashboard', $data);
        $this->load->view('finance/daily_expense', $data);
        $this->load->view('home/footer');
    }

    function monthly()
    {
        $data = array();
        $year = $this->input->get('year');

        if (empty($year)) {
            $year = date('Y');
        }


        $first_minute = mktime(0, 0, 0, 1, 1, $year);
        $last_minute = mktime(23, 59, 59, 12, 31, $year);

        $payments = $this->finance_model->getPaymentByDate($first_minute, $last_minute);
        $all_payments = array();
        foreach ($payments as $payment) {
            $month = date('m-Y', $payment->date);
            if (array_key_exists($month, $all_payments)) {
                $all_payments[$month] = $all_payments[$month] + $payment->gross_total;
            } else {
                $all_payments[$month] = $payment->gross_total;
            }
        }

        $data['year'] = $year;
        $data['first_minute'] = $first_minute;
        $data['last_minute'] = $last_minute;
        $data['all_payments'] = $all_payments;

        $this->load->view('home/dashboard', $data);
        $this->load->view('finance/monthly', $data);
        $this->load->view('home/footer');
    }

    function monthlyExpense()
    {
        $data = array();
        $year = $this->input->get('year');

        if (empty($year)) {
            $year = date('Y');
        }


        $first_minute = mktime(0, 0, 0, 1, 1, $year);
        $last_minute = mktime(23, 59, 59, 12, 31, $year);

        $expenses = $this->finance_model->getExpenseByDate($first_minute, $last_minute);
        $all_expenses = array();
        foreach ($expenses as $expense) {
            $month = date('m-Y', $expense->date);
            if (array_key_exists($month, $all_expenses)) {
                $all_expenses[$month] = $all_expenses[$month] + $expense->amount;
            } else {
                $all_expenses[$month] = $expense->amount;
            }
        }

        $data['year'] = $year;
        $data['first_minute'] = $first_minute;
        $data['last_minute'] = $last_minute;
        $data['all_expenses'] = $all_expenses;

        $this->load->view('home/dashboard', $data);
        $this->load->view('finance/monthly_expense', $data);
        $this->load->view('home/footer');
    }

    function getExpense()
    {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];
        $settings = $this->settings_model->getSettings();

        $order = $this->input->post("order");
        $columns_valid = array(
            "0" => "id",
            "1" => "date",
        );
        $values = $this->settings_model->getColumnOrder($order, $columns_valid);
        $dir = $values[0];
        $order = $values[1];

        if ($limit == -1) {
            if (!empty($search)) {
                $data['expenses'] = $this->finance_model->getExpenseBysearch($search, $order, $dir);
            } else {
                $data['expenses'] = $this->finance_model->getExpenseWithoutSearch($order, $dir);
            }
        } else {
            if (!empty($search)) {
                $data['expenses'] = $this->finance_model->getExpenseByLimitBySearch($limit, $start, $search, $order, $dir);
            } else {
                $data['expenses'] = $this->finance_model->getExpenseByLimit($limit, $start, $order, $dir);
            }
        }


        foreach ($data['expenses'] as $expense) {


            if ($this->ion_auth->in_group(array('admin'))) {
                $options1 = ' <a class="btn btn-soft-primary btn-xs editbutton" title="' . lang('edit') . '" href="finance/editExpense?id=' . $expense->id . '"><i class="fa fa-edit"> </i></a>';
            }

            $options2 = '<a class="btn btn-soft-info btn-xs " title="' . lang('invoice') . '"  href="finance/expenseInvoice?id=' . $expense->id . '"><i class="fa fa-file-invoice"></i> </a>';

            if ($this->ion_auth->in_group(array('admin'))) {
                $options3 = '<a class="btn btn-soft-danger btn-xs delete_button" title="' . lang('delete') . '" href="finance/deleteExpense?id=' . $expense->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"></i> </a>';
            }

            if (empty($options1)) {
                $options1 = '';
            }

            if (empty($options3)) {
                $options3 = '';
            }


            $info[] = array(
                $expense->category,
                date('d/m/y', $expense->date),
                $expense->note,
                $settings->currency . '' . $expense->amount,
                $options1 . ' ' . $options2 . ' ' . $options3,
            );
        }







        if (!empty($data['expenses'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => count($this->finance_model->getExpense()),
                "recordsFiltered" => count($this->finance_model->getExpense()),
                "data" => $info
            );
        } else {
            $output = array(
                // "draw" => 1,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => []
            );
        }




        echo json_encode($output);
    }



    function download()
    {
        $id = $this->input->get('id');
        $data['settings'] = $this->settings_model->getSettings();
        $data['discount_type'] = $this->finance_model->getDiscountType();
        $data['payment'] = $this->finance_model->getPaymentById($id);
        $payment = $this->finance_model->getPaymentById($id);
        $settings1 = $this->settings_model->getSettings();
        $patient_info = $this->db->get_where('patient', array('id' => $data['payment']->patient))->row();
        if (!empty($patient_info)) {
            $age = explode('-', $patient_info->age);
        }
        if (!empty($patient_info)) {
            if ($patient_info->sex == 'Male') {
                $sex = lang('male');
            } else {
                $sex = lang('female');
            }
        }
        $numlength = strlen((string) $data['payment']->id);
        $remaining = 10 - $numlength;
        $patient_info_id = '';
        $invoice_id = '';
        if ($remaining < 10) {
            for ($i = 0; $i < $remaining; $i++) {
                $invoice_id .= '0';
                $patient_info_id .= '0';
            }
            $patient_info_id .= $patient_info->id;
            $invoice_id .=  $data['payment']->id;
        } else {
            $invoice_id =  $data['payment']->id;
            $patient_info_id = $patient_info->id;
        }

        if (!empty($payment->doctor)) {
            $doc_details = $this->doctor_model->getDoctorById($payment->doctor);
            if (!empty($doc_details)) {
                $doctor = $doc_details->name . ' - <br>' . $doc_details->profile . ' <br>';
            } else {
                $doctor = $payment->doctor_name . ' <br>';
            }
        }



        error_reporting(0);
        $data['redirect'] = 'download';
        $header = '<div id="invoice_header" style="width:100%;">
                        <table class="info_rer">
                            <tr class="tr_info">

                                <td id="first_td" style="">
                                    <img class="img_class_logo" alt="" src="' . $this->settings_model->getSettings()->logo . '" width="120">
                                    <br>
                                    
                                        <div style="">
                                        
                                        <strong id="invoice_word">' . lang('invoice') . '</strong><br>
                                       
                                        
                                        
                                        <span class="invoice_id">' . $invoice_id . '</span>

                                       
                                        </div>
                                </td>
                                <td class="second_td">
                                   
                                        <div class="paragraphprint col-md-12" style="padding-top:-20px;">
                                            <p style="font-size:18px !important;margin-top: -20px; font-weight:800; ">
                                            <h4>
                                                ' . $settings1->title . '
                                            </h4><br>
                                            <h6 style="font-size:18px !important;margin-top: -20px; ">
                                            ' . $settings1->address . '
                                            </h6>
                                            <h4>
                                                Phone: ' . $settings1->phone . '
                                            </h4>
                                            </p>


                                        </div>
                                   
                                </td>


                                <td class="last_td">
                                   
                                        <table class="information_table">
                                            <tr>
                                                <td colspan="2">
                                                    <div class="paragraphprint col-md-12">
                                                       
                                                        <label class="control-label"> ' . lang('name') . ' </label>
                                                        <span class="info_text"> :
                                                            
                                                               ' . $patient_info->name . ' <br>
                                                           
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>

                                                    <label class="control-label">' . lang('age') . '</label>
                                                    <span class="info_text"> :
                                                        
                                                            ' . $age[0] . ' ' . lang('y') . ' ' . $age[1] . ' ' . lang('m') . ' ' . $age[2] . ' ' . lang('d') . '<br>
                                                        
                                                    </span>

                                                </td>
                                                <td>

                                                    <label class="control-label">' . lang('gender') . ' </label>
                                                    <span class="info_text"> :
                                                        ' . $sex . '
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="paragraphprint col-md-6 info_test">

                                                        <label class="control-label">HN </label>
                                                        <span class="info_text"> :
                                                            
                                                            ' . $patient_info_id . ' <br>
                                                           
                                                        </span>
                                                    </div>

                                                </td>
                                                <td>

                                                    <div class="paragraphprint col-md-6 info_test">
                                                        <label class="control-label"> ' . lang('phone') . ' </label>
                                                        <span class="info_text"> :
                                                           ' . $patient_info->phone . '
                                                            
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="paragraphprint col-md-6 info_test">
                                                        <label class="control-label">VN </label>
                                                        <span class="info_text"> :
                                                            ' . $invoice_id . '
                                                            
                                                        </span>
                                                    </div>

                                                </td>
                                                <td>

                                                    <div class="paragraphprint col-md-6 info_test">
                                                        <label class="control-label">VN  ' . lang('date') . ' </label>
                                                        <span class="info_text"> :
                                                            
                                                              ' . date('d/m/Y', $payment->date) . '
                                                           
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <div class="paragraphprint col-md-12 last_td_info">
                                                        <label class="control-label"> ' . lang('doctor') . ' </label>
                                                        <span class="info_text"> :
                                                            ' . $doctor . '
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                   
                                </td>

                            </tr>
                        </table>
                        <table class="table_bar" style="margin-bottom: -52px;">
                            <tr>
                                <td class="barcode_first_td">
                                    <div class="paragraphprint">
                                        <label class="control-label image_text">VN </label>
                                        <span class="info_text"> :
                                            <img class="image_bar" alt="testing" src="' . site_url('lab/barcode') . '?text=' . $invoice_id . '&print=true" />
                                        </span>
                                    </div>
                                </td>

                                <td class="barcode_third_td">
                                    <div class="paragraphprint">
                                        <label class="control-label image_text">HN </label>
                                        <span class="info_text"> :
                                            <img class="image_bar" alt="testing" src="' . site_url('lab/barcode') . '?text=' . $patient_info_id . '&print=true" />
                                        </span>
                                    </div>

                                </td>

                            </tr>
                        </table>
                    </div>';
        if ($data['settings']->invoice_choose == 'invoice1') {

            $mpdf = new \Mpdf\Mpdf(['format' => 'A4']);
            $mpdf->setAutoTopMargin = 'stretch';
            $mpdf->SetHTMLHeader($header);
            //$this->autoMarginPadding = 300;
            $mpdf->setAutoBottomMargin = 'stretch';
            $mpdf->SetHTMLFooter('
        <div style="text-align:center;font-weight: bold; font-size: 7pt; !important;">' .
                $settings1->footer_invoice_message . '</div>', 'O');
            $html = $this->load->view('finance/invoiceA4_download', $data, true);
        } else {
            $mpdf = new \Mpdf\Mpdf(['format' => 'A5', 'setAutoTopMargin' => 'true', 'margin_top' => -30]);
            $mpdf->SetHTMLHeader($header);
            $mpdf->setAutoTopMargin = 'stretch';
            $mpdf->SetHTMLHeader($header);
            $mpdf->setAutoBottomMargin = 'stretch';
            $html = $this->load->view('finance/invoice_test', $data, true);
            $mpdf->SetHTMLFooter('
        <div style="text-align:center;font-weight: bold; font-size: 7pt; !important;">' .
                $settings1->footer_invoice_message . '</div>', 'O');
        }

        $mpdf->WriteHTML($html);

        $filename = "invoice--00" . $id . ".pdf";
        $mpdf->Output($filename, 'D');
    }

    function sendInvoice()
    {
        $id = $this->input->post('id');
        $is_v_v = $this->input->post('radio');
        $data['settings'] = $this->settings_model->getSettings();
        $data['discount_type'] = $this->finance_model->getDiscountType();
        $data['payment'] = $this->finance_model->getPaymentById($id);
        $settings1 = $this->settings_model->getSettings();
        $patient_info = $this->db->get_where('patient', array('id' => $data['payment']->patient))->row();
        if (!empty($patient_info)) {
            $age = explode('-', $patient_info->age);
        }
        if (!empty($patient_info)) {
            if ($patient_info->sex == 'Male') {
                $sex = lang('male');
            } else {
                $sex = lang('female');
            }
        }
        $numlength = strlen((string) $data['payment']->id);
        $remaining = 10 - $numlength;
        $patient_info_id = '';
        $invoice_id = '';
        if ($remaining < 10) {
            for ($i = 0; $i < $remaining; $i++) {
                $invoice_id .= '0';
                $patient_info_id .= '0';
            }
            $patient_info_id .= $patient_info->id;
            $invoice_id .=  $data['payment']->id;
        } else {
            $invoice_id =  $data['payment']->id;
            $patient_info_id = $patient_info->id;
        }

        if (!empty($payment->doctor)) {
            $doc_details = $this->doctor_model->getDoctorById($payment->doctor);
            if (!empty($doc_details)) {
                $doctor = $doc_details->name . ' - <br>' . $doc_details->profile . ' <br>';
            } else {
                $doctor = $payment->doctor_name . ' <br>';
            }
        }



        error_reporting(0);
        $data['redirect'] = 'download';
        $header = '<div id="invoice_header" style="width:100%;">
                       <table class="info_rer">
                           <tr class="tr_info">

                               <td id="first_td" style="">
                                   <img class="img_class_logo" alt="" src="' . $this->settings_model->getSettings()->logo . '" width="120">
                                   <br>
                                   
                                       <div style="">
                                       
                                       <strong id="invoice_word">' . lang('invoice') . '</strong><br>
                                      
                                       
                                       
                                       <span class="invoice_id">' . $invoice_id . '</span>

                                      
                                       </div>
                               </td>
                               <td class="second_td">
                                  
                                       <div class="paragraphprint col-md-12" style="padding-top:-20px;">
                                           <p style="font-size:18px !important;margin-top: -20px; font-weight:800; ">
                                           <h4>
                                               ' . $settings1->title . '
                                           </h4><br>
                                           <h6 style="font-size:18px !important;margin-top: -20px; ">
                                           ' . $settings1->address . '
                                           </h6>
                                           <h4>
                                               Phone: ' . $settings->phone . '
                                           </h4>
                                           </p>


                                       </div>
                                  
                               </td>


                               <td class="last_td">
                                  
                                       <table class="information_table">
                                           <tr>
                                               <td colspan="2">
                                                   <div class="paragraphprint col-md-12">
                                                      
                                                       <label class="control-label"> ' . lang('name') . ' </label>
                                                       <span class="info_text"> :
                                                           
                                                              ' . $patient_info->name . ' <br>
                                                          
                                                       </span>
                                                   </div>
                                               </td>
                                           </tr>
                                           <tr>
                                               <td>

                                                   <label class="control-label">' . lang('age') . '</label>
                                                   <span class="info_text"> :
                                                       
                                                           ' . $age[0] . ' ' . lang('y') . ' ' . $age[1] . ' ' . lang('m') . ' ' . $age[2] . ' ' . lang('d') . '<br>
                                                       
                                                   </span>

                                               </td>
                                               <td>

                                                   <label class="control-label">' . lang('gender') . ' </label>
                                                   <span class="info_text"> :
                                                       ' . $sex . '
                                                   </span>
                                               </td>
                                           </tr>
                                           <tr>
                                               <td>
                                                   <div class="paragraphprint col-md-6 info_test">

                                                       <label class="control-label">HN </label>
                                                       <span class="info_text"> :
                                                           
                                                           ' . $patient_info_id . ' <br>
                                                          
                                                       </span>
                                                   </div>

                                               </td>
                                               <td>

                                                   <div class="paragraphprint col-md-6 info_test">
                                                       <label class="control-label"> ' . lang('phone') . ' </label>
                                                       <span class="info_text"> :
                                                          ' . $patient_info->phone . '
                                                           
                                                       </span>
                                                   </div>
                                               </td>
                                           </tr>
                                           <tr>
                                               <td>
                                                   <div class="paragraphprint col-md-6 info_test">
                                                       <label class="control-label">VN </label>
                                                       <span class="info_text"> :
                                                           ' . $invoice_id . '
                                                           
                                                       </span>
                                                   </div>

                                               </td>
                                               <td>

                                                   <div class="paragraphprint col-md-6 info_test">
                                                       <label class="control-label">VN  ' . lang('date') . ' </label>
                                                       <span class="info_text"> :
                                                           
                                                             ' . date('d/m/Y', $payment->date) . '
                                                          
                                                       </span>
                                                   </div>
                                               </td>
                                           </tr>
                                           <tr>
                                               <td colspan="2">
                                                   <div class="paragraphprint col-md-12 last_td_info">
                                                       <label class="control-label"> ' . lang('doctor') . ' </label>
                                                       <span class="info_text"> :
                                                           ' . $doctor . '
                                                       </span>
                                                   </div>
                                               </td>
                                           </tr>
                                       </table>
                                  
                               </td>

                           </tr>
                       </table>
                       <table class="table_bar" id="invoice_header">
                           <tr>
                               <td class="barcode_first_td">
                                   <div class="paragraphprint">
                                       <label class="control-label image_text">VN </label>
                                       <span class="info_text"> :
                                           <img class="image_bar" alt="testing" src="' . site_url('lab/barcode') . '?text=' . $invoice_id . '&print=true" />
                                       </span>
                                   </div>
                               </td>

                               <td class="barcode_third_td">
                                   <div class="paragraphprint">
                                       <label class="control-label image_text">HN </label>
                                       <span class="info_text"> :
                                           <img class="image_bar" alt="testing" src="' . site_url('lab/barcode') . '?text=' . $patient_info_id . '&print=true" />
                                       </span>
                                   </div>

                               </td>

                           </tr>
                       </table>
                   </div>';
        if ($data['settings']->invoice_choose == 'invoice1') {

            $mpdf = new \Mpdf\Mpdf(['format' => 'A4']);
            $mpdf->setAutoTopMargin = 'stretch';
            $mpdf->SetHTMLHeader($header);
            //$this->autoMarginPadding = 300;
            $mpdf->setAutoBottomMargin = 'stretch';
            $mpdf->SetHTMLFooter('
       <div style="text-align:center;font-weight: bold; font-size: 7pt; !important;">' .
                $settings1->footer_invoice_message . '</div>', 'O');
            $html = $this->load->view('finance/invoiceA4_download', $data, true);
        } else {
            $mpdf = new \Mpdf\Mpdf(['format' => 'A5', 'setAutoTopMargin' => 'true', 'margin_top' => -30]);
            $mpdf->SetHTMLHeader($header);
            $mpdf->setAutoTopMargin = 'stretch';
            $mpdf->SetHTMLHeader($header);
            $mpdf->setAutoBottomMargin = 'stretch';
            $html = $this->load->view('finance/invoice_test', $data, true);
            $mpdf->SetHTMLFooter('
       <div style="text-align:center;font-weight: bold; font-size: 7pt; !important;">' .
                $settings1->footer_invoice_message . '</div>', 'O');
        }
        $mpdf->WriteHTML($html);

        $filename = "invoice--00" . $id . ".pdf";
        $mpdf->Output(APPPATH . '../invoicefile/' . $filename, 'F');
        // $patientemail = $this->patient_model->getPatientById($data['payment']->patient)->email;
        if ($is_v_v == 'patient') {
            $patientemail = $this->patient_model->getPatientById($data['payment']->patient)->email;
        }
        if ($is_v_v == 'other') {
            $patientemail = $this->input->post('other_email');
        }
        $subject = lang('invoice');
        $mail_provider = $this->settings_model->getSettings()->emailtype;
        $settngs_name = $this->settings_model->getSettings()->system_vendor;
        $email_Settings = $this->email_model->getEmailSettingsByType($mail_provider);

        $this->load->library('encryption');
        if ($mail_provider == 'Domain Email') {
            $this->email->from($email_Settings->admin_email);
        }
        if ($mail_provider == 'Smtp') {
            $this->email->from($email_Settings->user, $settngs_name);
        }

        $this->email->to($patientemail);
        $this->email->subject($subject);

        $this->email->attach('invoicefile/' . $filename);


        if ($this->email->send()) {

            unlink(APPPATH . '../invoicefile/' . $filename);
            $this->session->set_flashdata('feedback', lang('send_invoice'));
            redirect("finance/invoice?id=" . $id);
        } else {
            unlink(APPPATH . '../invoicefile/' . $filename);
            $this->session->set_flashdata('feedback', lang('not') . ' ' . lang('send_invoice'));
            redirect("finance/invoice?id=" . "$id");
        }
    }
    public function expenseVsIncome()
    {
        $month_year = date('m-y');
        $now = time();

        $incomes = $this->finance_model->getDeposit();
        $expenses = $this->finance_model->getExpense();
        $total_income = 0;
        $this_month_total_income = 0;
        $this_week_total_income = 0;
        $this_week_total_expense = 0;
        $this_last_30_total_income = 0;
        $this_last_30_total_expense = 0;
        if (!empty($incomes)) {
            foreach ($incomes as $income) {

                $total_income += floatval($income->deposited_amount);
                $month = date('m-y', $income->date);
                if ($month_year == $month) {
                    $this_month_total_income +=  floatval($income->deposited_amount);
                }
                if (($now - $income->date) <= (7 * 24 * 60 * 60)) {
                    $this_week_total_income +=  floatval($income->deposited_amount);
                }
                if (($now - $income->date) <= (30 * 24 * 60 * 60)) {
                    $this_last_30_total_income +=  floatval($income->deposited_amount);
                }
            }
        } else {
            $this_month_total_income = 0;
            $total_income = 0;
            $this_week_total_income = 0;
            $this_last_30_total_income = 0;
        }
        $total_expense = 0;
        $this_month_total_expense = 0;
        if (!empty($expenses)) {
            foreach ($expenses as $expense) {
                $total_expense += $expense->amount;
                $month = date('m-y', $expense->date);
                if ($month_year == $month) {
                    $this_month_total_expense += floatval($expense->amount);
                }

                if (($now - $expense->date) <= (7 * 24 * 60 * 60)) {
                    $this_week_total_expense += floatval($expense->amount);
                }
                if (($now - $expense->date) <= (30 * 24 * 60 * 60)) {
                    $this_last_30_total_expense += floatval($expense->amount);
                }
            }
        } else {
            $total_expense = 0;
            $this_month_total_expense = 0;
            $this_week_total_expense = 0;
            $this_last_30_total_expense = 0;
        }

        $data['total_income'] = $total_income;
        $data['total_expense'] = $total_expense;
        $data['this_month_total_income'] = $this_month_total_income;
        $data['this_month_total_expense'] = $this_month_total_expense;
        $data['this_week_total_income'] = $this_week_total_income;
        $data['this_week_total_expense'] = $this_week_total_expense;
        $data['this_last_30_total_income'] = $this_last_30_total_income;
        $data['this_last_30_total_expense'] = $this_last_30_total_expense;

        $this->load->view('home/dashboard');
        $this->load->view('finance/expense_vs_income', $data);
        $this->load->view('home/footer');
    }
    function getPaymentCategoryNameVerify()
    {
        $attr = $this->input->get('attr');
        $id = $this->input->get('id');
        $category_found = $this->finance_model->getPaymentCategoryByNameSearch($attr);
        $data['response'] = 'no';
        if (empty($id)) {

            if (!empty($category_found)) {
                $data['response'] = 'no';
            } else {
                $data['response'] = 'yes';
            }
        } else {

            if (empty($category_found)) {
                $data['response'] = 'yes';
            } else {
                foreach ($category_found as $category) {
                    if ($category->id == $id) {
                        $data['response'] = 'yes';
                    }
                }
            }
        }
        echo json_encode($data);
    }
    function getPatientById()
    {
        $id = $this->input->get('id');
        $data['patient'] = $this->patient_model->getPatientById($id);
        echo json_encode($data);
    }
    function editCategory()
    {
        $data = array();
        $id = $this->input->get('id');

        if (!empty($id)) {
            $category_details = $this->finance_model->getCategoryById($id);
            if ($category_details->hospital_id != $this->session->userdata('hospital_id')) {
                redirect('home/permission');
            }
        }

        $data['category'] = $this->finance_model->getCategoryById($id);
        $this->load->view('home/dashboard');
        $this->load->view('finance/add_category', $data);
        $this->load->view('home/footer');
    }
    function deleteCategory()
    {
        $id = $this->input->get('id');

        if (!empty($id)) {
            $expense_category_details = $this->finance_model->getCategoryById($id);
            if ($expense_category_details->hospital_id != $this->session->userdata('hospital_id')) {
                redirect('home/permission');
            }
        }

        $this->finance_model->deleteCategory($id);
        redirect('finance/category');
    }
    public function addCategory()
    {
        $id = $this->input->post('id');
        $category = $this->input->post('category');
        $description = $this->input->post('description');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Category Name Field
        $this->form_validation->set_rules('category', 'Category', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Description Field
        $this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                $this->session->set_flashdata('feedback', lang('validation_error'));
                redirect('finance/editCategory?id=' . $id);
            } else {
                $data = array();
                $data['setval'] = 'setval';
                $this->load->view('home/dashboard');
                $this->load->view('finance/add_category', $data);
                $this->load->view('home/footer');
            }
        } else {
            $data = array();
            $data = array(
                'category' => $category,
                'description' => $description
            );
            if (empty($id)) {
                $this->finance_model->insertCategory($data);
                $this->session->set_flashdata('feedback', lang('added'));
            } else {
                $this->finance_model->updateCategory($id, $data);
                $this->session->set_flashdata('feedback', lang('updated'));
            }
            redirect('finance/category');
        }
    }
    public function addCategoryView()
    {
        $this->load->view('home/dashboard');
        $this->load->view('finance/add_category');
        $this->load->view('home/footer');
    }
    public function category()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $data['categories'] = $this->finance_model->getCategory();
        $this->load->view('home/dashboard');
        $this->load->view('finance/category', $data);
        $this->load->view('home/footer');
    }
    function getDepositByInvoiceId()
    {
        $id = $this->input->get('id');
        $deposit = $this->finance_model->getDepositByInvoiceId($id);
        if (!empty($deposit)) {
            foreach ($deposit as $depos) {
                $deposits[] = $depos->deposited_amount;
            }
            $data['response'] = array_sum($deposits);
        } else {
            $data['response'] = 0;
        }
        echo json_encode($data);
    }
    function getDepositByInvoiceIdForDeposit()
    {
        $id = $this->input->get('id');
        $deposit = $this->finance_model->getDepositByInvoiceId($id);
        $payment = $this->finance_model->getPaymentById($id);
        $data['patient'] = $this->patient_model->getPatientById($payment->patient);
        if (!empty($deposit)) {
            $total_deposit = $this->finance_model->getDepositAmountByPaymentId($payment->id);
            $data['response'] = $payment->gross_total - $total_deposit;
        } else {
            $data['response'] = $payment->gross_total;
        }
        echo json_encode($data);
    }
    public function dueCollection()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $data['settings'] = $this->settings_model->getSettings();

        $data['gateway'] = $this->finance_model->getGatewayByName($data['settings']->payment_gateway);
        $this->load->view('home/dashboard');
        $this->load->view('finance/due_collection', $data);
        $this->load->view('home/footer');
    }
    function getDuePayment()
    {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];
        $settings = $this->settings_model->getSettings();
        $start_date = $_GET['start_date'];
        $end_date = $_GET['end_date'];
        $order = $this->input->post("order");
        $columns_valid = array(
            "0" => "id",
            "1" => "patient",
            "2" => "doctor",
            "3" => "date",
            "4" => "amount",
            "5" => "discount",
            "6" => "gross_total",
        );
        $values = $this->settings_model->getColumnOrder($order, $columns_valid);
        $dir = $values[0];
        $order = $values[1];

        if (empty($start_date) || empty($end_date)) {
            if ($limit == -1) {
                if (!empty($search)) {
                    $data['payments'] = $this->finance_model->getPaymentBysearch($search, $order, $dir);
                } else {
                    $data['payments'] = $this->finance_model->getPaymentWitoutSearch($order, $dir);
                }
            } else {
                if (!empty($search)) {
                    $data['payments'] = $this->finance_model->getPaymentByLimitBySearch($limit, $start, $search, $order, $dir);
                } else {
                    $data['payments'] = $this->finance_model->getPaymentByLimit($limit, $start, $order, $dir);
                }
            }
        } else {
            $start_date_stamp = strtotime($start_date);
            $end_date_stamp = strtotime($end_date);
            if ($limit == -1) {
                if (!empty($search)) {
                    $data['payments'] = $this->finance_model->getPaymentBysearchByDate($search, $order, $dir, $start_date_stamp, $end_date_stamp);
                } else {
                    $data['payments'] = $this->finance_model->getPaymentWitoutSearchByDate($order, $dir, $start_date_stamp, $end_date_stamp);
                }
            } else {
                if (!empty($search)) {
                    $data['payments'] = $this->finance_model->getPaymentByLimitBySearchByDate($limit, $start, $search, $order, $dir, $start_date_stamp, $end_date_stamp);
                } else {
                    $data['payments'] = $this->finance_model->getPaymentByLimitByDate($limit, $start, $order, $dir, $start_date_stamp, $end_date_stamp);
                }
            }
        }

        $count = 0;
        $amount[] = array();
        $discount_amount = array();
        $gross = array();
        $deposited_money = array();
        $due_money = array();
        foreach ($data['payments'] as $payment) {
            $date = date('d-m-y', $payment->date);

            $discount = $payment->discount;
            if (empty($discount)) {
                $discount = 0;
            }
            $lab_pending = array();
            if ($payment->payment_from == 'payment' || empty($payment->payment_from)) {
                $lab_reports_previous = $this->lab_model->getLabByInvoice($payment->id);

                if (!empty($lab_reports_previous)) {
                    foreach ($lab_reports_previous as $lab) {
                        if ($lab->test_status == 'not_done' || empty($lab->test_status)) {
                            $lab_pending[] = 'no';
                        } else {
                            $lab_sample = 'yes';
                        }
                    }
                }
            }
            if ($this->ion_auth->in_group(array('admin', 'Accountant'))) {
                if ($payment->payment_from == 'payment' || empty($payment->payment_from)) {
                    if (count($lab_reports_previous) == count($lab_pending) || empty($lab_reports_previous)) {
                        $options1 = ' <a class="btn btn-soft-primary btn-xs editbutton" title="' . lang('edit') . '" href="finance/editPayment?id=' . $payment->id . '"><i class="fa fa-edit"> </i> ' . lang('edit') . '</a>';
                    } else {
                        $options1 = '';
                    }
                } else {
                    $options1 = '';
                }
            }

            $options2 = '<a class="btn btn-soft-info btn-xs " title="' . lang('invoice') . '"  href="finance/invoice?id=' . $payment->id . '"><i class="fa fa-file-invoice"></i> ' . lang('invoice') . '</a>';
            $options4 = '<a class="btn btn-soft-info btn-xs " title="' . lang('print') . '"  href="finance/printInvoice?id=' . $payment->id . '"target="_blank"> <i class="fa fa-print"></i> ' . lang('print') . '</a>';
            if ($this->ion_auth->in_group(array('admin', 'Accountant'))) {
                if ($payment->payment_from == 'payment' || empty($payment->payment_from)) {
                    if (count($lab_reports_previous) == count($lab_pending) || empty($lab_reports_previous)) {
                        $options3 = '<a class="btn btn-soft-danger btn-xs delete_button" title="' . lang('delete') . '" href="finance/delete?id=' . $payment->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"></i> ' . lang('delete') . '</a>';
                    } else {
                        $options3 = '';
                    }
                } else {
                    $options3 = '';
                }
            }

            if (empty($options1)) {
                $options1 = '';
            }

            if (empty($options3)) {
                $options3 = '';
            }
            $deposit = ' <a type="button" class="btn btn-xs btn-soft-primary depositButton" title="' . lang('deposit') . '" data-toggle = "modal" data-id="' . $payment->id . '" data-from="' . $payment->payment_from . '"><i class="fa fa-money"> </i> ' . lang('deposit') . '</a>';
            $doctor_details = $this->doctor_model->getDoctorById($payment->doctor);

            if (!empty($doctor_details)) {
                $doctor = $doctor_details->name;
            } else {
                if (!empty($payment->doctor_name)) {
                    $doctor = $payment->doctor_name;
                } else {
                    $doctor = $payment->doctor_name;
                }
            }

            $patient_info = $this->db->get_where('patient', array('id' => $payment->patient))->row();
            if (!empty($patient_info)) {
                $patient_details = $patient_info->name . '</br>' . $patient_info->address . '</br>' . $patient_info->phone . '</br>';
            } else {
                $patient_details = ' ';
            }
            if ($payment->payment_from == 'appointment') {
                $from = '<span class="badge badge-soft-warning">' . lang('appointment') . '</span>';
            } elseif ($payment->payment_from == 'payment' || empty($payment->payment_from)) {
                $from = '<span class="badge badge-soft-primary">' . lang('opd') . '</span>';
            } elseif ($payment->payment_from == 'admitted_patient_bed_medicine') {
                $from = '<span class="badge badge-soft-warning">' . lang('ipd_medicine') . '</span>';
            } elseif ($payment->payment_from == 'admitted_patient_bed_service') {
                $from = '<span class="badge badge-soft-success">' . lang('ipd_service') . '</span>';
            } elseif ($payment->payment_from == 'admitted_patient_bed_diagnostic') {
                $from = '<span class="badge badge-soft-info">' . lang('ipd_diagnostic') . '</span>';
            }

            if (($payment->gross_total - $this->finance_model->getDepositAmountByPaymentId($payment->id)) > 0) {
                $amount[] = $payment->amount;
                $discount_amount[] = $discount;
                $gross[] = $payment->gross_total;
                $deposited_money[] = $this->finance_model->getDepositAmountByPaymentId($payment->id);
                $due_money[] = ($payment->gross_total - $this->finance_model->getDepositAmountByPaymentId($payment->id));

                $info[] = array(
                    $payment->id,
                    $patient_details,
                    $doctor,
                    $date,
                    $from,
                    $settings->currency . '' . $payment->amount,
                    $settings->currency . '' . $discount,
                    $settings->currency . '' . $payment->gross_total,
                    $settings->currency . '' . $this->finance_model->getDepositAmountByPaymentId($payment->id),
                    $settings->currency . '' . ($payment->gross_total - $this->finance_model->getDepositAmountByPaymentId($payment->id)),
                    $payment->remarks,
                    $options1 . ' ' . $deposit . ' ' . $options3,
                );
                $count++;
            } else {
                $info1[] = array(
                    $payment->id,
                    $patient_details,
                    $doctor,
                    $date,
                    $from,
                    $settings->currency . '' . $payment->amount,
                    $settings->currency . '' . $discount,
                    $settings->currency . '' . $payment->gross_total,
                    $settings->currency . '' . $this->finance_model->getDepositAmountByPaymentId($payment->id),
                    $settings->currency . '' . ($payment->gross_total - $this->finance_model->getDepositAmountByPaymentId($payment->id)),
                    $payment->remarks,
                    $options1 . ' ' . $deposit . ' ' . $options3,
                );
            }
        }



        $info[] = array(
            '',
            '',
            '',
            '',
            '<strong>TOTAL:</strong>',
            '<strong>' . $settings->currency . ' ' . array_sum($amount) . '</strong>',
            '<strong>' . $settings->currency . ' ' . array_sum($discount_amount) . '</strong>',
            '<strong>' . $settings->currency . ' ' . array_sum($gross) . '</strong>',
            '<strong>' . $settings->currency . ' ' . array_sum($deposited_money) . '</strong>',
            '<strong>' . $settings->currency . ' ' . array_sum($due_money) . '</strong>',
            ' ',
            ' '
        );



        if ($count != 0) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => count($info),
                "recordsFiltered" => count($info),
                "data" => $info
            );
        } else {
            $output = array(
                // "draw" => 1,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => []
            );
        }




        echo json_encode($output);
    }
    function getPaymentProccedureTemplate()
    {
        $id = $this->input->get('id');
        $data['payment_proccedure'] = $this->finance_model->getPaymentCategoryById($id);
        echo json_encode($data);
    }
    function addPaymentProccedureTemplate()
    {
        $id = $this->input->post('id');
        $report = $this->input->post('report');
        $data = array();
        $data = array('report' => $report);
        $this->finance_model->updatePaymentCategory($id, $data);
        $this->session->set_flashdata('feedback', lang('updated'));
        redirect('finance/paymentCategory');
    }
    public function draftPayment()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $data['settings'] = $this->settings_model->getSettings();

        $this->load->view('home/dashboard');
        $this->load->view('finance/draft_payment', $data);
        $this->load->view('home/footer');
    }
    function getdraftPayment()
    {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];
        $settings = $this->settings_model->getSettings();

        $order = $this->input->post("order");
        $columns_valid = array(
            "0" => "id",
            "1" => "patient",
            "2" => "doctor",
            "3" => "date",
            "4" => "amount",
            "5" => "discount",
            "6" => "gross_total",
        );
        $values = $this->settings_model->getColumnOrder($order, $columns_valid);
        $dir = $values[0];
        $order = $values[1];

        if ($limit == -1) {
            if (!empty($search)) {
                $data['payments'] = $this->finance_model->getDraftPaymentBysearch($search, $order, $dir);
            } else {
                $data['payments'] = $this->finance_model->getDraftPaymentWitoutSearch($order, $dir);
            }
        } else {
            if (!empty($search)) {
                $data['payments'] = $this->finance_model->getDraftPaymentByLimitBySearch($limit, $start, $search, $order, $dir);
            } else {
                $data['payments'] = $this->finance_model->getDraftPaymentByLimit($limit, $start, $order, $dir);
            }
        }


        foreach ($data['payments'] as $payment) {
            $date = date('d-m-y', $payment->date);

            $discount = $payment->discount;
            if (empty($discount)) {
                $discount = 0;
            }

            if ($this->ion_auth->in_group(array('admin', 'Accountant'))) {


                $options1 = ' <a class="btn btn-soft-primary btn-xs editbutton" title="' . lang('edit') . '" href="finance/editDraftPayment?id=' . $payment->id . '"><i class="fa fa-edit"> </i> ' . lang('edit') . '</a>';
            }


            if ($this->ion_auth->in_group(array('admin', 'Accountant'))) {


                $options3 = '<a class="btn btn-soft-danger btn-xs delete_button" title="' . lang('delete') . '" href="finance/deleteDraftPayment?id=' . $payment->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"></i> ' . lang('delete') . '</a>';
            }

            if (empty($options1)) {
                $options1 = '';
            }

            if (empty($options3)) {
                $options3 = '';
            }




            $info[] = array(
                $date,
                $payment->patient_name,
                $payment->doctor_name,
                $settings->currency . '' . $payment->amount,
                $settings->currency . '' . $discount,
                $settings->currency . '' . $payment->gross_total,
                $payment->remarks,
                $options1  . ' ' . $options3,
            );
        }







        if (!empty($data['payments'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => count($data['payments']),
                "recordsFiltered" => count($data['payments']),
                "data" => $info
            );
        } else {
            $output = array(
                // "draw" => 1,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => []
            );
        }




        echo json_encode($output);
    }
    function deleteDraftPayment()
    {
        if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist'))) {
            $id = $this->input->get('id');



            $this->finance_model->deleteDraftPayment($id);

            $this->session->set_flashdata('feedback', lang('deleted'));
            redirect('finance/draftPayment');
        }
    }
    function editDraftPayment()
    {
        $id = $this->input->get('id');
        $data['draft'] = $this->finance_model->getDraftPaymentById($id);
        $data['payment'] = array();
        $data['discount_type'] = $this->finance_model->getDiscountType();
        $data['settings'] = $this->settings_model->getSettings();
        $data['categories'] = $this->finance_model->getPaymentCategory();
        $data['gateway'] = $this->finance_model->getGatewayByName($data['settings']->payment_gateway);

        $this->load->view('home/dashboard');
        $this->load->view('finance/add_payment_view', $data);
        $this->load->view('home/footer');
    }
    function getCategoryList()
    {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];
        $settings = $this->settings_model->getSettings();
        $filter_category = $_GET['category'];

        $order = $this->input->post("order");
        $columns_valid = array(
            "0" => "id",
            "1" => "category",
            "2" => "description",
            "3" => "payment_category_name",
            "4" => "type",

        );
        $values = $this->settings_model->getColumnOrder($order, $columns_valid);
        $dir = $values[0];
        $order = $values[1];
        if (empty($filter_category) || $filter_category == 'all') {
            if ($limit == -1) {
                if (!empty($search)) {
                    $data['payments_category'] = $this->finance_model->getPaymentCategoryBySearch($search, $order, $dir);
                } else {
                    $data['payments'] = $this->finance_model->getPaymentCategoryWithoutSearch($order, $dir);
                }
            } else {
                if (!empty($search)) {
                    $data['payments_category'] = $this->finance_model->getPaymentCategoryByLimitBySearch($limit, $start, $search, $order, $dir);
                } else {
                    $data['payments_category'] = $this->finance_model->getPaymentCategoryByLimit($limit, $start, $order, $dir);
                }
            }
        } else {

            if ($limit == -1) {
                if (!empty($search)) {
                    $data['payments_category'] = $this->finance_model->getPaymentCategoryBySearchByCategory($search, $order, $dir, $filter_category);
                } else {
                    $data['payments_category'] = $this->finance_model->getPaymentCategoryWithoutSearchByCategory($order, $dir, $filter_category);
                }
            } else {
                if (!empty($search)) {
                    $data['payments_category'] = $this->finance_model->getPaymentCategoryByLimitBySearchByCategory($limit, $start, $search, $order, $dir, $filter_category);
                } else {
                    $data['payments_category'] = $this->finance_model->getPaymentCategoryByLimitByCategory($limit, $start, $order, $dir, $filter_category);
                }
            }
        }



        foreach ($data['payments_category'] as $category) {



            if ($this->ion_auth->in_group(array('admin', 'Accountant'))) {
                $options2 = ' <a class="btn btn-soft-primary btn-xs editbutton" title="' . lang('edit') . '" href="finance/editPaymentCategory?id=' . $category->id . '"><i class="fa fa-edit"> </i></a>';
                $options3 = '<a class="btn btn-soft-danger btn-xs delete_button" title="' . lang('delete') . '" href="finance/deletePaymentCategory?id=' . $category->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"></i> ' . lang('delete') . '</a>';

                if (empty($category->report)) {
                    $template = '<a type="button" class="btn btn-xs btn-soft-primary template" title="' . lang('template') . '" data-toggle = "modal" data-id="' . $category->id . '"><i class="fa fa-money"> </i>' .  lang('template') . '</a>';
                } else {
                    $template = '<a type="button" class="btn btn-xs btn-soft-info template" title="' .  lang('template') . '" data-toggle = "modal" data-id="' . $category->id . '"><i class="fa fa-money"> </i>' . lang('edit') . ' ' . lang('template') . '</a>';
                }
            } else {
                $options2 = ' ';
                $options3 = ' ';
                $template = ' ';
            }
            $category_details = $this->finance_model->getCategoryById($category->payment_category);
            if (empty($category_details)) {
                $details = $category_details->category;
            } else {
                $details =  $category->payment_category_name;
            }
            if ($category->type == 'diagnostic') {
                $type = lang('diagnostic_test');
            } else {
                $type = lang('others');
            }
            $payment_category_details = $this->finance_model->getCategoryById($category->payment_category);
            if (empty($payment_category_details)) {
                $category_word = $payment_category_details->payment_category_name;
            } else {
                $category_word = $payment_category_details->category;
            }

            $info[] = array(
                $category->code,
                $category->category,
                $category->description,
                $category_word,
                $settings->currency . ' ' . $category->c_price,
                $category->d_commission,
                $type,
                $options2 . ' ' . $options3 . ' ' . $template,
            );
        }








        if (!empty($data['payments_category'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => count($data['payments_category']),
                "recordsFiltered" => count($data['payments_category']),
                "data" => $info
            );
        } else {
            $output = array(
                // "draw" => 1,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => []
            );
        }




        echo json_encode($output);
    }
}

/* End of file finance.php */
/* Location: ./application/modules/finance/controllers/finance.php */
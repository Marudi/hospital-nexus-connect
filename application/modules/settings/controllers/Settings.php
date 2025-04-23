<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once APPPATH . '../vendor/autoload.php';

class Settings extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('sma');
        $this->load->model('hospital/package_model');
        $this->load->model('hospital/hospital_model');
        require APPPATH . 'third_party/stripe/stripe-php/init.php';
        if (!$this->ion_auth->in_group(array('admin', 'superadmin'))) {
            redirect('home/permission');
        }
    }

    public function index()
    {
        $data = array();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard');
        $this->load->view('settings', $data);
        $this->load->view('home/footer');
    }

    function subscription()
    {
        $data['settings'] = $this->settings_model->getSettings();
        $data['subscription'] = $this->settings_model->getSubscription();
        $user = $this->ion_auth->get_user_id();
        $ion_user_id = $this->db->get_where('users', array('id' => $user))->row();
        $data['hospital'] = $this->db->get_where('hospital', array('ion_user_id' => $ion_user_id->id))->row();
        $data['package'] = $this->package_model->getPackageById($data['subscription']->package);
        $data['hospital_payments'] = $this->settings_model->getHospitalPaymentsById($data['subscription']->id);
        $data['settings1'] = $this->db->get_where('settings', array('hospital_id' => 'superadmin'))->row();
        $data['deposits'] = $this->db->get_where('hospital_deposit', array('hospital_user_id' => $data['hospital_payments']->hospital_user_id))->result();
        $data['gateway'] = $this->db->get_where('paymentGateway', array('name' => $data['settings1']->payment_gateway, 'hospital_id' => 'superadmin'))->row();
        $this->load->view('home/dashboard', $data);
        $this->load->view('subscription', $data);
        $this->load->view('home/footer');
    }

    public function update()
    {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $discount_percent = $this->input->post('discount_percent');
        $footer_invoice_message = $this->input->post('footer_invoice_message');
        $vat = $this->input->post('vat');
        $invoice_choose = $this->input->post('invoice_choose');
        $title = $this->input->post('title');
        $email = $this->input->post('email');
        $address = $this->input->post('address');
        $phone = $this->input->post('phone');
        $currency = $this->input->post('currency');
        $logo = $this->input->post('logo');
        $footer_message = $this->input->post('footer_message');
        $buyer = $this->input->post('buyer');
        $p_code = $this->input->post('p_code');
        $show_odontogram_in_history = $this->input->post('show_odontogram_in_history');
        $theme = $this->input->post('theme');
        if ($this->ion_auth->in_group(array('superadmin'))) {
            $remainder_appointment = $this->input->post('remainder_appointment');
        } else {
            $remainder_appointment = '';
        }

        $video_type = $this->input->post('video_type');
        
        // Drug interaction API settings
        $drug_interaction_source = $this->input->post('drug_interaction_source');
        $drugbank_api_key = $this->input->post('drugbank_api_key');
        
        // Validate drug interaction source
        if (!in_array($drug_interaction_source, array('openfda', 'drugbank', 'ddinter', 'both'))) {
            $drug_interaction_source = 'openfda'; // Default to OpenFDA if invalid value
        }
        
        // Test DDInter connectivity if selected
        if ($drug_interaction_source == 'ddinter' || $drug_interaction_source == 'both') {
            $this->load->helper('drug_interaction_helper');
            $ddinter_available = verify_ddinter_api_connectivity();
            if (!$ddinter_available) {
                $this->session->set_flashdata('warning', lang('ddinter_api_connectivity_warning'));
            }
        }

        if (!empty($email)) {
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            // Validating Name Field
            $this->form_validation->set_rules('name', 'System Name', 'trim|required|min_length[1]|max_length[100]|xss_clean');
            // Validating Title Field
            $this->form_validation->set_rules('title', 'Title', 'trim|required|min_length[1]|max_length[100]|xss_clean');
            // Validating Email Field
            $this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[1]|max_length[100]|xss_clean');
            // Validating Address Field    
            $this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[1]|max_length[500]|xss_clean');
            // Validating Phone Field           
            $this->form_validation->set_rules('phone', 'Phone', 'trim|required|min_length[1]|max_length[50]|xss_clean');
            // Validating Currency Field   
            $this->form_validation->set_rules('currency', 'Currency', 'trim|required|min_length[1]|max_length[3]|xss_clean');
            // Validating Logo Field   
            $this->form_validation->set_rules('logo', 'Logo', 'trim|min_length[1]|max_length[1000]|xss_clean');
            // Validating Department Field   
            $this->form_validation->set_rules('buyer', 'Buyer', 'trim|min_length[5]|max_length[500]|xss_clean');
            // Validating Phone Field           
            $this->form_validation->set_rules('p_code', 'Purchase Code', 'trim|min_length[5]|max_length[50]|xss_clean');

            if ($this->form_validation->run() == FALSE) {
                $data = array();
                $data['settings'] = $this->settings_model->getSettings();
                $this->load->view('home/dashboard');
                $this->load->view('settings', $data);
                $this->load->view('home/footer');
            } else {

                $file_name = $_FILES['img_url']['name'];
                $file_name_pieces = explode('_', $file_name);
                $new_file_name = '';
                $count = 1;
                foreach ($file_name_pieces as $piece) {
                    if ($count !== 1) {
                        $piece = ucfirst($piece);
                    }

                    $new_file_name .= $piece;
                    $count++;
                }
                $config = array(
                    'file_name' => $new_file_name,
                    'upload_path' => "./uploads/",
                    'allowed_types' => "gif|jpg|png|jpeg|pdf",
                    'overwrite' => False,
                    'max_size' => "20480000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
                    'max_height' => "1768",
                    'max_width' => "2024"
                ); 

                $this->load->library('Upload', $config);
                $this->upload->initialize($config);

                if ($this->upload->do_upload('img_url')) {
                    $path = $this->upload->data();
                    $img_url = "uploads/" . $path['file_name'];
                    $data = array();
                    $data = array(
                        'system_vendor' => $name,
                        'title' => $title,
                        'address' => $address,
                        'phone' => $phone,
                        'email' => $email,
                        'currency' => $currency,
                        'codec_username' => $buyer,
                        'codec_purchase_code' => $p_code,
                        'logo' => $img_url,
                        'remainder_appointment' => $remainder_appointment,
                        'footer_message' => $footer_message,
                        'show_odontogram_in_history' => $show_odontogram_in_history,
                        'invoice_choose' => $invoice_choose,
                        'vat' => $vat,
                        'discount_percent' => $discount_percent,
                        'footer_invoice_message' => $footer_invoice_message,
                        'theme' => $theme,
                        'video_type' => $video_type,
                        'map_provider' => $this->input->post('map_provider'),
                        'drug_interaction_source' => $drug_interaction_source,
                        'drugbank_api_key' => $drugbank_api_key
                    );
                } else {
                    $data = array();
                    $data = array(
                        'system_vendor' => $name,
                        'title' => $title,
                        'address' => $address,
                        'phone' => $phone,
                        'email' => $email,
                        'currency' => $currency,
                        'codec_username' => $buyer,
                        'codec_purchase_code' => $p_code,
                        'logo' => $logo,
                        'remainder_appointment' => $remainder_appointment,
                        'footer_message' => $footer_message,
                        'show_odontogram_in_history' => $show_odontogram_in_history,
                        'invoice_choose' => $invoice_choose,
                        'vat' => $vat,
                        'discount_percent' => $discount_percent,
                        'footer_invoice_message' => $footer_invoice_message,
                        'theme' => $theme,
                        'video_type' => $video_type,
                        'map_provider' => $this->input->post('map_provider'),
                        'drug_interaction_source' => $drug_interaction_source,
                        'drugbank_api_key' => $drugbank_api_key
                    );
                }


                $this->settings_model->updateSettings($id, $data);
                $this->session->set_flashdata('feedback', lang('updated'));

                redirect('settings');
            }
        } else {
            $this->session->set_flashdata('feedback', lang('email_required'));
            redirect('settings', 'refresh');
        }
    }

    function backups()
    {
        if ($this->ion_auth->in_group(array())) {
            $data['files'] = glob('./files/backups/*.zip', GLOB_BRACE);
            $data['dbs'] = glob('./files/backups/*.txt', GLOB_BRACE);
            $data['settings'] = $this->settings_model->getSettings();

            $this->load->view('home/dashboard', $data);
            $this->load->view('backups', $data);
            $this->load->view('home/footer');
        } else {
            redirect('home');
        }
    }

    function language()
    {

        $data['settings'] = $this->settings_model->getSettings();

        $this->load->view('home/dashboard', $data);
        $this->load->view('language', $data);
        $this->load->view('home/footer');
    }

    function changeLanguage()
    {
        $id = $this->input->post('id');
        $language = $this->input->post('language');
        $language_settings = $this->input->post('language_settings');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Name Field
        $this->form_validation->set_rules('language', 'language', 'trim|required|min_length[1]|max_length[100]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            $data = array();
            $data['settings'] = $this->settings_model->getSettings();
            $this->load->view('home/dashboard', $data);
            $this->load->view('settings', $data);
            $this->load->view('home/footer');
        } else {


            $data = array();
            $data = array(
                'language' => $language,
            );

            $this->settings_model->updateSettings($id, $data);

            // Loading View
            $this->session->set_flashdata('feedback', lang('updated'));
            if (!empty($language_settings)) {
                redirect('settings/language');
            } else {
                redirect('');
            }
        }
    }

    function selectPaymentGateway()
    {
        $id = $this->input->post('id');
        $payment_gateway = $this->input->post('payment_gateway');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Name Field
        $this->form_validation->set_rules('payment_gateway', 'Payment Gateway', 'trim|required|min_length[1]|max_length[100]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            redirect('pgateway');
        } else {


            $data = array();
            $data = array(
                'payment_gateway' => $payment_gateway,
            );

            $this->settings_model->updateSettings($id, $data);

            // Loading View
            $this->session->set_flashdata('feedback', lang('updated'));
            if (!empty($payment_gateway)) {
                redirect('pgateway');
            } else {
                redirect('');
            }
        }
    }

    function selectSmsGateway()
    {
        $id = $this->input->post('id');
        $sms_gateway = $this->input->post('sms_gateway');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Name Field
        $this->form_validation->set_rules('sms_gateway', 'Sms Gateway', 'trim|required|min_length[1]|max_length[100]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            redirect('pgateway');
        } else {


            $data = array();
            $data = array(
                'sms_gateway' => $sms_gateway,
            );

            $this->settings_model->updateSettings($id, $data);

            // Loading View
            $this->session->set_flashdata('feedback', lang('updated'));
            if (!empty($sms_gateway)) {
                redirect('sms');
            } else {
                redirect('');
            }
        }
    }

    function backup_database()
    {
        if (!$this->ion_auth->in_group('admin')) {
            $this->session->set_flashdata('error', lang('access_denied'));
            redirect("home/permission");
        }
        $this->load->dbutil();
        $prefs = array(
            'format' => 'sql',
            'filename' => 'hms_db_backup.sql'
        );
        $back = $this->dbutil->backup($prefs);
        $backup = &$back;
        $db_name = 'db-backup-on-' . date("Y-m-d-H-i-s") . '.txt';
        $save = './files/backups/' . $db_name;
        $this->load->helper('file');
        write_file($save, $backup);
        $this->session->set_flashdata('message', 'Database backup Successfull !');
        redirect("settings/backups");
    }

    function backup_files()
    {
        if (!$this->ion_auth->in_group('admin')) {
            $this->session->set_flashdata('error', lang('access_denied'));
            redirect("home/permission");
        }
        $this->load->library('zip');
        $data = array_diff(scandir(FCPATH), array('..', '.', 'files')); // 'files' folder will be excluded here with '.' and '..'
        foreach ($data as $d) {
            $path = FCPATH . $d;
            if (is_dir($path))
                $this->zip->read_dir($path, false);
            if (is_file($path))
                $this->zip->read_file($path, false);
        }
        $filename = 'file-backup-' . date("Y-m-d-H-i-s") . '.zip';
        $this->zip->archive(FCPATH . 'files/backups/' . $filename);
        $this->session->set_flashdata('message', 'Application backup Successfull !');
        redirect("settings/backups");
        exit();
    }

    function restore_database($dbfile)
    {
        if (!$this->ion_auth->in_group('admin')) {
            $this->session->set_flashdata('error', lang('access_denied'));
            redirect("home/permission");
        }
        $file = file_get_contents('./files/backups/' . $dbfile . '.txt');
        $this->db->conn_id->multi_query($file);
        $this->db->conn_id->close();
        $this->session->set_flashdata('message', 'Restoring of Backup Successfull');
        redirect('settings/backups');
    }

    function download_database($dbfile)
    {
        if (!$this->ion_auth->in_group('admin')) {
            $this->session->set_flashdata('error', lang('access_denied'));
            redirect("home/permission");
        }
        $this->load->library('zip');
        $this->zip->read_file('./files/backups/' . $dbfile . '.txt');
        $name = 'db_backup_' . date('Y_m_d_H_i_s') . '.zip';
        $this->zip->download($name);
        exit();
    }

    function download_backup($zipfile)
    {
        if (!$this->ion_auth->in_group('admin')) {
            $this->session->set_flashdata('error', lang('access_denied'));
            redirect("home/permission");
        }
        $this->load->helper('download');
        force_download('./files/backups/' . $zipfile . '.zip', NULL);
        exit();
    }

    function restore_backup($zipfile)
    {
        if (!$this->ion_auth->in_group('admin')) {
            $this->session->set_flashdata('error', lang('access_denied'));
            redirect("home/permission");
        }
        $file = './files/backups/' . $zipfile . '.zip';
        $this->sma->unzip($file, './');
        $this->session->set_flashdata('info', 'Restoring of Application Successfull');
        redirect("settings/backups");
        exit();
    }

    function delete_database($dbfile)
    {
        if (!$this->ion_auth->in_group('admin')) {
            $this->session->set_flashdata('error', lang('access_denied'));
            redirect("home/permission");
        }
        unlink('./files/backups/' . $dbfile . '.txt');
        $this->session->set_flashdata('info', 'Deleting of Database Successfull');
        redirect("settings/backups");
    }

    function delete_backup($zipfile)
    {
        if (!$this->ion_auth->in_group('admin')) {
            $this->session->set_flashdata('error', lang('access_denied'));
            redirect("home/permission");
        }
        unlink('./files/backups/' . $zipfile . '.zip');
        $this->session->set_flashdata('info', 'Deleting of App Backup Successfull');
        redirect("settings/backups");
    }

    function substring($index, $value)
    {

        foreach ($value as $key => $value2) {

            $value3 = trim(substr($value2, 2));
            $value4[] = substr($value3, 0, -2);
        }

        foreach ($index as $key => $index2) {

            $index3 = substr($index2, 7);
            $index4[] = substr($index3, 0, -3);
        }

        return array_combine($index4, $value4);
    }

    function languageEdit()
    {

        if (!$this->ion_auth->in_group('superadmin')) {
            redirect('home/permission');
        }

        $id = $this->input->get('id');
        //load helper for language
        $this->load->helper('string');

        if ($id == 'arabic') {
            $path = APPPATH . 'language/arabic/system_syntax_lang.php';
        }
        if ($id == 'english') {
            $path = APPPATH . 'language/english/system_syntax_lang.php';
        }
        if ($id == 'italian') {
            $path = APPPATH . 'language/italian/system_syntax_lang.php';
        }
        if ($id == 'french') {
            $path = APPPATH . 'language/french/system_syntax_lang.php';
        }

        if ($id == 'spanish') {
            $path = APPPATH . 'language/spanish/system_syntax_lang.php';
        }
        if ($id == 'portuguese') {
            $path = APPPATH . 'language/portuguese/system_syntax_lang.php';
        }

        $file = fopen($path, "r");
        $i = 0;
        while (!feof($file)) {
            $line = fgets($file);

            $arr = explode("=", $line, 2);
            if (!empty($arr[1])) {
                $index[$i] = $arr[0];
                $value[$i] = $arr[1];
                $i = $i + 1;
            }
        }
        fclose($file);

        $data = array();
        $data['languages'] = $this->substring($index, $value);

        $data['languagename'] = $id;

        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard');
        $this->load->view('edit_language', $data);
        $this->load->view('home/footer');
    }

    function addLanguageTranslation()
    {
        $id = $this->input->post('language');
        $indexes = $this->input->post('indexupdate');
        $index = explode("#**##***", $indexes);
        $valueupdate = $this->input->post('valueupdate');
        $value = explode("*##**###", $valueupdate);

        foreach ($index as $key => $values) {
            if ($key !== 0) {

                $indexupdate[] = $values;
            }
        }
        foreach ($value as $key => $values) {
            if ($key !== 0) {
                $values = trim($values);

                $value2 = explode("'", $values);
                $length = count($value2);

                if (empty($value2[1])) {

                    $valueupdated[] = $value2[0];
                } else {
                    $valuefinal = array();
                    foreach ($value2 as $keys => $value3) {


                        $lastChar = substr($value3, -1);
                        if (preg_match('/\\\\/', $lastChar)) {
                            $valuefinal[] = $value3 . "'";
                        } else {

                            if ($keys != ($length - 1)) {
                                $valuefinal[] = $value3 . "\'";
                            } else {
                                $valuefinal[] = $value3;
                            }
                        }
                    }
                    $valueconcate = "";
                    foreach ($valuefinal as $valuefinal) {
                        $valueconcate .= $valuefinal;
                    }
                    $valueupdated[] = $valueconcate;
                }
            }
        }

        $data = array_combine($indexupdate, $valueupdated);

        if ($id == 'arabic') {
            $path = APPPATH . 'language/arabic/system_syntax_lang.php';
        }
        if ($id == 'english') {
            $path = APPPATH . 'language/english/system_syntax_lang.php';
        }
        if ($id == 'italian') {
            $path = APPPATH . 'language/italian/system_syntax_lang.php';
        }
        if ($id == 'french') {
            $path = APPPATH . 'language/french/system_syntax_lang.php';
        }

        if ($id == 'spanish') {
            $path = APPPATH . 'language/spanish/system_syntax_lang.php';
        }
        if ($id == 'portuguese') {
            $path = APPPATH . 'language/portuguese/system_syntax_lang.php';
        }

        unlink($path);
        $option = "<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * Name:  Auth Lang -" . $id . "
 *
 * Author: Ben Edmunds
 * 		  ben.edmunds@gmail.com
 *         @benedmunds
 *
 * Author: Daniel Davis
 *         @ourmaninjapan
 *
 * Location: http://github.com/benedmunds/ion_auth/
 *
 * Created:  03.09.2013
 *
 * Description: " . $id . " language file for Ion Auth example views
 *
 */
// Errors";
        $file_handle = fopen($path, 'a+');
        fwrite($file_handle, $option);
        fwrite($file_handle, "\n");
        foreach ($data as $key => $value) {
            $valueupdate = trim($value);
            $option1 = '$lang' . "['" . $key . "'] = '$valueupdate';";
            fwrite($file_handle, $option1);
            fwrite($file_handle, "\n");
        }


        fclose($file_handle);
        $this->session->set_flashdata('feedback', lang('updated'));
        redirect('settings/language');
    }

    public function packages()
    {
        $data['packages'] = $this->package_model->getPackage();
        $data['settings'] = $this->settings_model->getSettings();
        $user = $this->ion_auth->get_user_id();
        $ion_user_id = $this->db->get_where('users', array('id' => $user))->row();
        $data['hospital'] = $this->db->get_where('hospital', array('ion_user_id' => $ion_user_id->id))->row();

        $data['package_details'] = $this->package_model->getPackageById($data['hospital']->package);
        $data['settings1'] = $this->db->get_where('settings', array('hospital_id' => 'superadmin'))->row();
        $data['gateway'] = $this->db->get_where('paymentGateway', array('name' => $data['settings1']->payment_gateway, 'hospital_id' => 'superadmin'))->row();

        $this->load->view('home/dashboard');
        $this->load->view('change_plan', $data);
        $this->load->view('home/footer');
    }

    function getHospitalDetailsPayment()
    {
        $id = $this->input->get('id');
        $data['hospital_payment'] = $this->settings_model->getHospitalPaymentsById($id);
        echo json_encode($data);
    }

    function editPackageById()
    {
        $id = $this->input->get('id');

        $data['package'] = $this->package_model->getPackageById($id);

        //$data['settings'] = $this->settings_model->getSettingsByHId($id);
        echo json_encode($data);
    }

    function changePlanPayment()
    {
        $from = $this->input->post('from');
        $packageId = $this->input->post('id');
        $package_type = $this->input->post('package_type');
        $hospital_id = $this->input->post('hospital_id');
        $deposit_type = $this->input->post('deposit_type');
        $hospital_details = $this->hospital_model->getHospitalById($hospital_id);
        $package_list = $this->package_model->getPackageById($packageId);

        if ($package_type == 'monthly') {
            $price = $package_list->monthly_price;
        } else {
            $price = $package_list->yearly_price;
        }

        if (!empty($packageId)) {
            $module = $this->package_model->getPackageById($packageId)->module;
            $p_limit = $this->package_model->getPackageById($packageId)->p_limit;
            $d_limit = $this->package_model->getPackageById($packageId)->d_limit;
        }
        $data = array();
        $data = array(
            'name' => $hospital_details->name,
            'email' => $hospital_details->email,
            'address' => $hospital_details->address,
            'phone' => $hospital_details->phone,
            'package' => $packageId,
            'package_duration' => $package_type,
            'price' => $price,
            'hospital_id' => $hospital_id,
            'module' => $module,
            'p_limit' => $p_limit,
            'd_limit' => $d_limit,
            'map_provider' => $this->input->post('map_provider'),
        );
        if ($deposit_type == 'Card') {
            $gateway = $this->db->get_where('settings', array('hospital_id' => 'superadmin'))->row()->payment_gateway;
            if ($gateway == 'PayPal') {
                $data['cardholder'] = $this->input->post('cardholder');
                $data['card_type'] = $this->input->post('card_type');
                $data['card_number'] = $this->input->post('card_number');
                $data['expire_date'] = $this->input->post('expire_date');
                $data['cvv'] = $this->input->post('cvv_number');
                $this->load->module('paypal');
                $response = $this->paypal->paymentPaypalFromFrontend($data, 'backend');

                if ($response == 'yes') {
                    $data['gateway'] = 'PayPal';
                    $data['from'] = $from;
                    $this->changePlan($data);
                } else {
                    $this->session->set_flashdata('feedback', lang('Please_check_card_details'));
                    if ($from == 'expire') {
                        redirect('hospital/lisenceExpired');
                    } else {
                        redirect('settings/subscription');
                    }
                    redirect('settings/subscription');
                }
            } elseif ($gateway == 'Stripe') {

                $token = $this->input->post('token');

                $stripe = $this->db->get_where('paymentGateway', array('hospital_id' => 'superadmin', 'name' => 'Stripe'))->row();

                \Stripe\Stripe::setApiKey($stripe->secret);
                $charge = \Stripe\Charge::create(array(
                    "amount" => $price * 100,
                    "currency" => "usd",
                    "source" => $token
                ));
                $chargeJson = $charge->jsonSerialize();
                if ($chargeJson['status'] == 'succeeded') {
                    $data['gateway'] = 'Stripe';
                    $data['from'] = $from;
                    $this->changePlan($data);
                } else {
                    $this->session->set_flashdata('feedback', lang('Please_check_card_details'));
                    if (empty($from)) {
                        redirect('settings/subscription');
                    } else {

                        if ($from == 'expire') {
                            redirect('hospital/lisenceExpired');
                        } else {
                            redirect('hospital');
                        }
                    }
                }
            } elseif ($gateway == 'Paystack') {
                $paystack = $this->db->get_where('paymentGateway', array('hospital_id' => 'superadmin', 'name' => 'Paystack'))->row();

                $ref = date('Y') . '-' . rand() . date('d') . '-' . date('m');
                $amount_in_kobo = $price;
                if (empty($from)) {
                    $callback_url = base_url() . 'settings/subscription';
                } else {
                    if ($from == 'expire') {
                        $callback_url = base_url() . 'hospital/lisenceExpired';
                    } else {
                        $callback_url = base_url() . 'hospital';
                    }
                }

                $postdata = array('first_name' => $hospital_details->name, 'email' => $hospital_details->email, 'amount' => $amount_in_kobo * 100, "reference" => $ref, 'callback_url' => $callback_url);

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

                $redir = $result['data']['authorization_url'];

                header("Location: " . $redir);
                if ($result['status'] == 1) {
                    $data['gateway'] = 'Paystack';

                    $this->changePlan($data);
                }
                exit();
            } elseif ($gateway == 'Pay U Money') {

                $this->load->module('payu');
                $data['from'] = $from;
                if ($from == 'expire') {
                    $this->payu->check4($data, $price, $hospital_id, 'expire');
                } else {
                    $this->payu->check4($data, $price, $hospital_id, 'deposit_backend');
                }
            }
        } else {
            $data['gateway'] = 'Cash';
            $data['from'] = $from;
            $this->changePlan($data);
        }
    }

    function changePlan($data)
    {
        $packageId = $data['package'];
        $package_type = $data['package_duration'];
        $hospital_id = $data['hospital_id'];
        $package_list = $this->package_model->getPackageById($packageId);
        $gateway = $data['gateway'];
        if (!empty($this->input->post('renew'))) {
            if ($package_type == 'monthly') {
                $price = $package_list->monthly_price;
                $next_due_date_stamp = strtotime($this->input->post('next_due_date'));
                $package_lang = lang('monthly');
            } else {
                $price = $package_list->yearly_price;
                $next_due_date_stamp = strtotime($this->input->post('next_due_date'));
                $package_lang = lang('yearly');
            }
        } else {
            if ($package_type == 'monthly') {
                $price = $package_list->monthly_price;
                $next_due_date_stamp = time() + 2592000;
                $package_lang = lang('monthly');
            } else {
                $price = $package_list->yearly_price;
                $next_due_date_stamp = time() + 31536000;
                $package_lang = lang('yearly');
            }
        }
        $next_due_date = date('d-m-Y', $next_due_date_stamp);

        if (!empty($packageId)) {
            $module = $this->package_model->getPackageById($packageId)->module;
            $p_limit = $this->package_model->getPackageById($packageId)->p_limit;
            $d_limit = $this->package_model->getPackageById($packageId)->d_limit;
        }
        $data_up = array();
        $data_up = array(
            'package' => $packageId,
            'p_limit' => $p_limit,
            'd_limit' => $d_limit,
            'module' => $module
        );
        $this->hospital_model->updateHospital($hospital_id, $data_up);
        $data_payment = array();
        $data_payment = array(
            'price' => $price,
            'package_duration' => $package_type,
            'next_due_date_stamp' => $next_due_date_stamp,
            'next_due_date' => $next_due_date,
            'package' => $packageId,
            'status' => 'paid'
        );
        $this->hospital_model->updateHospitalPaymentByHospitalId($hospital_id, $data_payment);
        $hospital_details_payment = $this->hospital_model->getHospitalPaymentByHospitalId($hospital_id);
        $data_deposit = array();
        $data_deposit = array(
            'payment_id' => $hospital_details_payment->id,
            'date' => time(),
            'deposited_amount' => $price,
            'gateway' => $gateway,
            'hospital_user_id' => $hospital_id,
            'next_due_date_stamp' => $next_due_date_stamp,
            'next_due_date' => $next_due_date,
            'add_date_stamp' => time(),
            'add_date' => date('d-m-Y', time()),
        );
        $deposit = $this->hospital_model->addHospitalDeposit($data_deposit);
        $base_url = str_replace(array('http://', 'https://', ' '), '', base_url()) . "auth/login";
        $set['settings'] = $this->db->get_where('settings', array('hospital_id' => 'superadmin'))->row();

        $package_name = $this->db->get_where('package', array('id' => $packageId))->row()->name;
        $hospital_details = $this->db->get_where('hospital', array('id' => $hospital_id))->row();
        $data1 = array(
            'name' => $hospital_details->name,
            'package_name' => $package_name,
            'subscription_duration' => $package_lang,
            'base_url' => $base_url,
            'amount' => $price,
            'username' => $hospital_details->name,
            'phone' => $set['settings']->phone,
            'next_payment_date' => $next_due_date
        );

        $emailSettings = $this->email_model->getAdminEmailSettingsById();
        if (!empty($data['from'])) {
            $message1 = '<strong>{name}</strong> ,<br>
Your hospital package has changed successfully . Please check the details Below.<br>
Migrated Package Name: {package_name}.<br>
Subscription Length: {subscription_duration}.<br>
Amount Paid: {amount}.<br>
Next Payment Date: {next_payment_date}.<br>


For Any Support Please Contact with Phone No: {phone}';
        } else {
            $message1 = '<strong>{name}</strong> ,<br>
Your hospital package has renewed successfully . Please check the details Below.<br>
Migrated Package Name: {package_name}.<br>
Subscription Length: {subscription_duration}.<br>
Amount Paid: {amount}.<br>
Next Payment Date: {next_payment_date}.<br>


For Any Support Please Contact with Phone No: {phone}';
        }

        $messageprint1 = $this->parser->parse_string($message1, $data1);
        $this->email->from($emailSettings->admin_email, $set['settings']->system_vendor);
        $this->email->to($hospital_details->email);
        $this->email->subject('Hospital Package Changed');
        $this->email->message($messageprint1);
        $this->email->send();
        $hospital_details_ion = $this->db->get_where('hospital', array('id' => $hospital_id))->row()->ion_user_id;
        $data_activation = array();
        $data_activation = array("active" => 1);
        $this->db->where('id', $hospital_details_ion)->update('users', $data_activation);
        $this->session->set_flashdata('feedback', lang('package_changed'));
        if ($gateway != 'Paystack') {
            if (empty($data['from'])) {
                redirect('settings/subscription');
            } else {
                if ($data['from'] == 'expire') {
                    redirect('hospital/lisenceExpired');
                } else {
                    redirect('hospital');
                }
            }
        }
    }

    function getHospitalPayments()
    {
        $id = $this->input->get('id');
        $data['hospital'] = $this->hospital_model->getHospitalPaymentById($id);
        $data['package'] = $this->package_model->getPackageById($data['hospital']->package);
        echo json_encode($data);
    }

    function downloadInvoice()
    {
        $id = $this->input->get('id');
        $data['deposit'] = $this->hospital_model->getHospitalDepositById($id);
        $data['settings'] = $this->db->get_where('settings', array('hospital_id' => 'superadmin'))->row();

        error_reporting(0);
        $mpdf = new \Mpdf\Mpdf(['format' => 'A4']);

        $html = $this->load->view('invoice', $data, true);

        $mpdf->WriteHTML($html);

        $filename = "invoice--00" . $id . ".pdf";
        $mpdf->Output($filename, 'D');
    }

    function selectEmailGateway()
    {
        $id = $this->input->post('id');
        $email_gateway = $this->input->post('email_gateway');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Name Field
        $this->form_validation->set_rules('email_gateway', 'Email Gateway', 'trim|required|min_length[1]|max_length[100]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            redirect('email/emailSettings');
        } else {


            $data = array();
            $data = array(
                'emailtype' => $email_gateway,
            );

            $this->settings_model->updateSettings($id, $data);

            $this->session->set_flashdata('feedback', lang('updated'));
            if (!empty($email_gateway)) {
                redirect('email/emailSettings');
            } else {
                redirect('');
            }
        }
    }

    public function getStaffinfoWithAddNewOption()
    {
        // Search term
        $searchTerm = $this->input->post('searchTerm');

        // Get users
        $response = $this->settings_model->getStaffinfoWithAddNewOption($searchTerm);

        echo json_encode($response);
    }

    function googleReCaptcha()
    {
        if (!$this->ion_auth->in_group(array('superadmin'))) {
            redirect('home');
        }
        $data = array();
        $data['captcha'] = $this->settings_model->getGoogleReCaptchaSettings();
        $this->load->view('home/dashboard');
        $this->load->view('googleReCaptcha', $data);
        $this->load->view('home/footer');
    }

    function updateGoogleReCaptcha()
    {
        if (!$this->ion_auth->in_group(array('superadmin'))) {
            redirect('settings/googleReCaptcha');
        }
        $id = $this->input->post('id');
        $site_key = $this->input->post('site_key');
        $secret_key = $this->input->post('secret_key');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');


        $this->form_validation->set_rules('site_key', 'Site Key', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        $this->form_validation->set_rules('secret_key', 'Secret_key', 'trim|min_length[1]|max_length[100]|xss_clean');


        if ($this->form_validation->run() == FALSE) {
            redirect('settings/googleReCaptcha?id=' . $id);
        } else {
            $data = array();
            $data = array(
                'site_key' => $site_key,
                'secret_key' => $secret_key,
            );
            if (!empty($id)) {
                $this->settings_model->updateGoogleReCaptcha($id, $data);
            } else {
                $this->settings_model->addGoogleReCaptcha($data);
            }

            $this->session->set_flashdata('feedback', lang('updated'));
            redirect('settings/googleReCaptcha');
        }
    }

    function updateGoogleReCaptchaForLogin()
    {
        if (!$this->ion_auth->in_group(array('superadmin'))) {
            redirect('settings/googleReCaptcha');
        }
        $id = $this->input->post('id');
        $site_key = $this->input->post('site_key_login');

        $secret_key = $this->input->post('secret_key_login');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');


        $this->form_validation->set_rules('site_key_login', 'Site Key', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        $this->form_validation->set_rules('secret_key_login', 'Secret_key', 'trim|min_length[1]|max_length[100]|xss_clean');


        if ($this->form_validation->run() == FALSE) {
            redirect('settings/googleReCaptcha?id=' . $id);
        } else {
            $data = array();
            $data = array(
                'site_key_login' => $site_key,
                'secret_key_login' => $secret_key,
            );
            
            if (!empty($id)) {
                $this->settings_model->updateGoogleReCaptcha($id, $data);
            } else {
                $this->settings_model->addGoogleReCaptcha($data);
            }

            $this->session->set_flashdata('feedback', lang('updated'));
            redirect('settings/googleReCaptcha');
        }
    }
    function verifyPurchase()
    {
        $data['verified'] = $this->input->get('verify');
        $this->load->view('home/dashboard.php');
        $this->load->view('purchase_code_verification', $data);
        $this->load->view('home/footer.php');
    }


    function addPurchaseCode()
    {
        $purchase_code = $this->input->post("validation");
        $base_url = $this->input->get('base_url');
        $insertPurchase = file_get_contents("http://verify.codearistos.net/api/verify?validation=" . $purchase_code . "&base_url=" . $base_url);
        $insertPurchase = json_decode($insertPurchase);
        if ($insertPurchase->message == 3) {
            $this->session->set_flashdata('feedback', 'Purcase code validated successfully');
            $this->settings_model->updateHospitalSettings('superadmin', array('codec_purchase_code' => $purchase_code));
            redirect("settings/verifyPurchase");
        } elseif ($insertPurchase->message == 1) {
            $this->session->set_flashdata('feedback', 'Already Validated');
            redirect("settings/verifyPurchase?verify=yes");
        } elseif ($insertPurchase->message == 2) {
            $this->session->set_flashdata('feedback', 'This purchase code is validated for other domain. Please purchase a new licence or send request to support for removing the prevous domain.');
            redirect("settings/verifyPurchase");
        } elseif ($insertPurchase->message == 4) {
            $this->session->set_flashdata('feedback', 'This domain is already registerred with another purchase code.');
            redirect("settings/verifyPurchase");
        } elseif ($insertPurchase->message == 0) {
            $this->session->set_flashdata('feedback', 'This purchase code is invalid');
            redirect("settings/verifyPurchase");
        }
    }

    function chatgpt()
    {

        $data['settings'] = $this->settings_model->getSettings();

        $this->load->view('home/dashboard', $data);
        $this->load->view('chatgpt', $data);
        $this->load->view('home/footer');
    }

    function chatgptSettings()
    {
        $id = $this->input->post('id');
        $api_key = $this->input->post('api_key');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Name Field
        $this->form_validation->set_rules('api_key', 'API Key', 'trim|required|min_length[1]|max_length[1000]|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            redirect('settings/chatgpt');
        } else {
            $data = array();
            $data = array(
                'chatgpt_api_key' => $api_key,
            );
            $this->settings_model->updateSettings($id, $data);
            $this->session->set_flashdata('feedback', lang('updated'));
            // show_swal(lang('updated'), 'success', lang('updated'));
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    /**
     * Test DDInter API connectivity
     * 
     * AJAX endpoint to test connectivity to the DDInter API
     */
    public function testDDInterConnectivity() {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        
        $this->load->helper('drug_interaction_helper');
        $result = verify_ddinter_api_connectivity();
        
        // Return JSON response
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(array(
                'success' => $result,
                'message' => $result ? 
                    lang('ddinter_api_connectivity_success') : 
                    lang('ddinter_api_connectivity_failure')
            )));
    }

}
/* End of file settings.php */
/* Location: ./application/modules/settings/controllers/settings.php */

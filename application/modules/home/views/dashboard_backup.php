<!DOCTYPE html>
<html lang="en" <?php
                if (!$this->ion_auth->in_group(array('superadmin'))) {

                    $this->db->where('hospital_id', $this->hospital_id);
                    $settings_lang = $this->db->get('settings')->row()->language;
                    if ($this->language == 'arabic') {
                ?> dir="rtl" <?php } else { ?> dir="ltr" <?php
                                                        }
                                                    } else {
                                                        $this->db->where('hospital_id', 'superadmin');
                                                        $settings_lang = $this->db->get('settings')->row()->language;
                                                        if ($this->language == 'arabic') {
                                                            ?> dir="rtl" <?php } else { ?> dir="ltr" <?php
                                                                                                    }
                                                                                                }
                                                                                                        ?>>

<head>
    <base href="<?php echo base_url(); ?>">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Rizvi">
    <meta name="keyword" content="Php, Hospital, Clinic, Management, Software, Php, CodeIgniter, Hms, Accounting">
    <link rel="shortcut icon" href="uploads/favicon.png">

    <?php
    $class_name = $this->router->fetch_class();
    $class_name_lang = lang($class_name);
    if (empty($class_name_lang)) {
        $class_name_lang = $class_name;
    }
    ?>

    <title> <?php echo $class_name_lang; ?> |
        <?php
        if ($this->ion_auth->in_group(array('superadmin'))) {
            $this->db->where('hospital_id', 'superadmin');
        } else {
            $this->db->where('hospital_id', $this->hospital_id);
        }
        ?>
        <?php
        echo $this->db->get('settings')->row()->system_vendor;
        ?>
    </title>
    <link href="common/css/bootstrap.min.css" rel="stylesheet">
    <link href="common/css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="common/assets/fontawesome5pro/css/all.min.css" rel="stylesheet" />
    <link href="common/assets/DataTables/datatables.min.css" rel="stylesheet" />
    <link href="common/assets/DataTables/Responsive/css/responsive.dataTables.min.css" rel="stylesheet" />
    <link href="common/assets/DataTables/Responsive/css/responsive.dataTables.css" rel="stylesheet" />


    <link href="common/css/style.css" rel="stylesheet">

    <link rel="stylesheet" href="common/assets/bootstrap-datepicker/css/bootstrap-datepicker.css" />
    <link rel="stylesheet" type="text/css" href="common/assets/bootstrap-daterangepicker/daterangepicker-bs3.css" />
    <link rel="stylesheet" type="text/css" href="common/assets/bootstrap-datetimepicker/css/datetimepicker.css" />
    <link rel="stylesheet" type="text/css" href="common/assets/bootstrap-timepicker/compiled/timepicker.css">
    <link rel="stylesheet" type="text/css" href="common/assets/jquery-multi-select/css/multi-select.css" />
    <link href="common/css/invoice-print.css" rel="stylesheet" media="print">
    <link href="common/assets/fullcalendar/fullcalendar.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="common/assets/select2/css/select2.min.css" />
    <link rel="stylesheet" type="text/css" href="common/css/lightbox.css" />
    <link rel="stylesheet" type="text/css" href="common/assets/bootstrap-fileupload/bootstrap-fileupload.css" />
    <link rel="stylesheet" type="text/css" href="common/assets/bootstrap-wysihtml5/bootstrap-wysihtml5.css" />
    <link rel="stylesheet" href="common/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="common/css/bootstrap-select-country.min.css">
    <link rel="stylesheet" href="common/extranal/toast.css">
    <!-- Google Fonts -->

    <link href="common/extranal/css/medical_history_calendar_modal.css" rel="stylesheet">


    <link href="common/css/style-responsive.css" rel="stylesheet" />

    <?php
    if (!$this->ion_auth->in_group(array('superadmin'))) {
        if ($this->language == 'arabic') {
    ?>
            <link href="common/extranal/css/dashboard_arabic.css" rel="stylesheet">

        <?php
        }
    } else {
        if ($this->language == 'arabic') {
        ?>
            <link href="common/extranal/css/dashboard_arabic.css" rel="stylesheet">

    <?php
        }
    }
    ?>
    <style>
        .ck-editor__editable {
            height: 300px;
        }
    </style>
</head>




<?php
// $validation = "1b53b301-43d6-44cb-97c9-f0329e937f82";
// $validation  = "9cc0efc1-4a17-4761-b399-7c548bad0dfc";
// $base_url = base_url();
// $verify = file_get_contents("http://verify.codearistos.net/api/getPurchaseCode?validation=" . $validation . "&base_url=" . $base_url);
// $verify = json_decode($verify);
// if ($verify) {
//     if ($verify->message == 0) {
//         echo 'invalid licence';
//     }
//     if ($verify->message == 1) {
//         echo 'valid Licence';
//     }
//     if ($verify->message == 2) {
//         echo 'Invalid Domain';
//     }
// } else {
//     redirect('frontend/verifyPurchase');
// }

?>







<body>
    <section id="container" class="">
        <!--header start-->
        <header class="header white-bg">
            <div class="sidebar-toggle-box">
                <div data-original-title="Toggle Navigation" class="fa fa-dedent fa-bars tooltips"></div>
            </div>
            <!--logo start-->
            <?php
            if (!$this->ion_auth->in_group(array('superadmin'))) {
                $this->db->where('hospital_id', $this->hospital_id);
                $settings_title = $this->db->get('settings')->row()->title;
                $settings_title = explode(' ', $settings_title);
            ?>
                <a href="home" class="logo">
                    <strong>
                        <?php echo $settings_title[0]; ?>

                        <?php
                        if (!empty($settings_title[1])) {
                            echo $settings_title[1];
                        }
                        ?>

                        <?php
                        if (!empty($settings_title[2])) {
                            echo $settings_title[2];
                        }
                        ?>

                    </strong>
                </a>

            <?php } else { ?>

                <a href="" class="logo">
                    <strong>
                        Hospital
                        <span>
                            System
                        </span>
                    </strong>
                </a>

            <?php } ?>
            <!--logo end-->
            <div class="nav notify-row" id="top_menu">
                <!--  notification start -->
                <ul class="nav top-menu">
                    <!-- Bed Notification start -->
                    <?php if ($this->ion_auth->in_group(array('admin', 'Doctor', 'Nurse'))) { ?>
                        <?php if (in_array('bed', $this->modules)) { ?>
                            <li class="dropdown">
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <i class="fa fa-procedures"></i>
                                    <span class="badge bg-success">



                                        <?php
                                        $this->db->where('hospital_id', $this->hospital_id);
                                        $query = $this->db->get('bed')->result();
                                        $available_bed = 0;
                                        foreach ($query as $bed) {
                                            $last_a_time = explode('-', $bed->last_a_time);
                                            $last_d_time = explode('-', $bed->last_d_time);
                                            if (!empty($last_d_time[1])) {
                                                $last_d_h_am_pm = explode(' ', $last_d_time[1]);
                                                $last_d_h = explode(':', $last_d_h_am_pm[1]);
                                                if ($last_d_h_am_pm[2] == 'AM') {
                                                    $last_d_m = ($last_d_h[0] * 60 * 60) + ($last_d_h[1] * 60);
                                                } else {
                                                    $last_d_m = (12 * 60 * 60) + ($last_d_h[0] * 60 * 60) + ($last_d_h[1] * 60);
                                                }
                                                $last_d_time_s = strtotime($last_d_time[0]) + $last_d_m;
                                                if (time() > $last_d_time_s) {
                                                    $available_bed = $available_bed + 1;
                                                }
                                            } else {
                                                $available_bed = $available_bed + 1;
                                            }
                                        }
                                        echo $available_bed;
                                        ?>

                                    </span>
                                </a>
                                <ul class="dropdown-menu extended tasks-bar">
                                    <div class="notify-arrow notify-arrow-green"></div>
                                    <li>
                                        <p class="green">
                                            <?php
                                            if (!empty($query)) {
                                                echo $available_bed;
                                            } else {
                                                $available_bed = 0;
                                                echo $available_bed;
                                            }
                                            ?>
                                            <?php
                                            if ($available_bed <= 1) {
                                                echo lang('bed_is_available');
                                            } else {
                                                echo lang('beds_are_available');
                                            }
                                            ?>
                                        </p>
                                    </li>
                                    <?php ?>
                                    <li class="external">
                                        <a href="bed/bedAllotment">
                                            <p class="green"><?php
                                                                if ($available_bed > 0) {
                                                                    echo lang('add_a_allotment');
                                                                } else {
                                                                    echo lang('no_bed_is_available_for_allotment');
                                                                }
                                                                ?></p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php } ?>
                    <?php } ?>

                    <?php if ($this->ion_auth->in_group(array('admin', 'Accountant'))) { ?>
                        <?php if (in_array('finance', $this->modules)) { ?>
                            <li id="header_inbox_bar" class="dropdown">
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <i class="fa fa-money-check"></i>
                                    <span class="badge bg-important">
                                        <?php
                                        $this->db->where('hospital_id', $this->hospital_id);
                                        $query = $this->db->get('payment');
                                        $query = $query->result();
                                        foreach ($query as $payment) {
                                            $payment_date = date('y/m/d', $payment->date);
                                            if ($payment_date == date('y/m/d')) {
                                                $payment_number[] = '1';
                                            }
                                        }
                                        if (!empty($payment_number)) {
                                            echo $payment_number = array_sum($payment_number);
                                        } else {
                                            $payment_number = 0;
                                            echo $payment_number;
                                        }
                                        ?>
                                    </span>
                                </a>
                                <ul class="dropdown-menu extended inbox">
                                    <div class="notify-arrow notify-arrow-red"></div>
                                    <li>
                                        <p class="red"> <?php
                                                        echo $payment_number . ' ';
                                                        if ($payment_number <= 1) {
                                                            echo lang('payment_today');
                                                        } else {
                                                            echo lang('payments_today');
                                                        }
                                                        ?></p>
                                    </li>
                                    <li>
                                        <a href="finance/payment">
                                            <p class="green"> <?php echo lang('see_all_payments'); ?></p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php } ?>
                    <?php } ?>
                    <!-- payment notification end -->
                    <!-- patient notification start-->
                    <?php if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Doctor', 'Nurse', 'Laboratorist'))) { ?>
                        <?php if (in_array('patient', $this->modules)) { ?>
                            <li id="header_notification_bar" class="dropdown">
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <i class="fa fa-user"></i>
                                    <span class="badge bg-warning">
                                        <?php
                                        $this->db->where('hospital_id', $this->hospital_id);
                                        $this->db->where('add_date', date('m/d/y'));
                                        $query = $this->db->get('patient');
                                        $query = $query->result();
                                        foreach ($query as $patient) {
                                            $patient_number[] = '1';
                                        }
                                        if (!empty($patient_number)) {
                                            echo $patient_number = array_sum($patient_number);
                                        } else {
                                            $patient_number = 0;
                                            echo $patient_number;
                                        }
                                        ?>
                                    </span>
                                </a>
                                <ul class="dropdown-menu extended notification">
                                    <div class="notify-arrow notify-arrow-yellow"></div>
                                    <li>
                                        <p class="yellow"><?php
                                                            echo $patient_number . ' ';
                                                            if ($patient_number <= 1) {
                                                                echo lang('patient_registerred_today');
                                                            } else {
                                                                echo lang('patients_registerred_today');
                                                            }
                                                            ?> </p>
                                    </li>
                                    <li>
                                        <a href="patient">
                                            <p class="green"><?php echo lang('see_all_patients'); ?></p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php } ?>
                    <?php } ?>
                    <!-- patient notification end -->
                    <!-- donor notification start-->
                    <?php if ($this->ion_auth->in_group(array('admin', 'Doctor', 'Nurse', 'Laboratorist'))) { ?>
                        <?php if (in_array('donor', $this->modules)) { ?>
                            <li id="header_notification_bar" class="dropdown">
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <i class="fa fa-user"></i>
                                    <span class="badge bg-success">
                                        <?php
                                        $this->db->where('hospital_id', $this->hospital_id);
                                        $this->db->where('add_date', date('m/d/y'));
                                        $query = $this->db->get('donor');
                                        $query = $query->result();
                                        foreach ($query as $donor) {
                                            $donor_number[] = '1';
                                        }
                                        if (!empty($donor_number)) {
                                            echo $donor_number = array_sum($donor_number);
                                        } else {
                                            $donor_number = 0;
                                            echo $donor_number;
                                        }
                                        ?>
                                    </span>
                                </a>
                                <ul class="dropdown-menu extended notification">
                                    <div class="notify-arrow notify-arrow-yellow"></div>
                                    <li>
                                        <p class="green"><?php
                                                            echo $donor_number . ' ';
                                                            if ($donor_number <= 1) {
                                                                echo lang('donor_registerred_today');
                                                            } else {
                                                                echo lang('donors_registerred_today');
                                                            }
                                                            ?> </p>
                                    </li>
                                    <li>
                                        <a href="donor">
                                            <p class="green"><?php echo lang('see_all_donors'); ?></p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php } ?>
                    <?php } ?>
                    <!-- donor notification end -->
                    <!-- medicine notification start-->
                    <?php if ($this->ion_auth->in_group(array('admin', 'Pharmacist', 'Doctor'))) { ?>
                        <?php if (in_array('medicine', $this->modules)) { ?>
                            <li id="header_notification_bar" class="dropdown">
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <i class="fa fa-medkit"></i>
                                    <span class="badge bg-success">
                                        <?php
                                        $this->db->where('hospital_id', $this->hospital_id);
                                        $this->db->where('add_date', date('m/d/y'));
                                        $query = $this->db->get('medicine');
                                        $query = $query->result();
                                        foreach ($query as $medicine) {
                                            $medicine_number[] = '1';
                                        }
                                        if (!empty($medicine_number)) {
                                            echo $medicine_number = array_sum($medicine_number);
                                        } else {
                                            $medicine_number = 0;
                                            echo $medicine_number;
                                        }
                                        ?>
                                    </span>
                                </a>
                                <ul class="dropdown-menu extended notification">
                                    <div class="notify-arrow notify-arrow-yellow"></div>
                                    <li>
                                        <p class="yellow"><?php
                                                            echo $medicine_number . ' ';
                                                            if ($medicine_number <= 1) {
                                                                echo lang('medicine_registerred_today');
                                                            } else {
                                                                echo lang('medicines_registered_today');
                                                            }
                                                            ?> </p>
                                    </li>
                                    <li>
                                        <a href="medicine">
                                            <p class="green"><?php echo lang('see_all_medicines'); ?></p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php } ?>
                    <?php } ?>
                    <!-- medicine notification end -->
                    <!-- report notification start-->
                    <?php if ($this->ion_auth->in_group(array('admin', 'Doctor', 'Laboratorist', 'Nurse'))) { ?>
                        <?php if (in_array('report', $this->modules)) { ?>
                            <li id="header_notification_bar" class="dropdown">
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <i class="fa fa-notes-medical"></i>
                                    <span class="badge bg-success">
                                        <?php
                                        $this->db->where('hospital_id', $this->hospital_id);
                                        $this->db->where('add_date', date('m/d/y'));
                                        $query = $this->db->get('report');
                                        $query = $query->result();
                                        foreach ($query as $report) {
                                            $report_number[] = '1';
                                        }
                                        if (!empty($report_number)) {
                                            echo $report_number = array_sum($report_number);
                                        } else {
                                            $report_number = 0;
                                            echo $report_number;
                                        }
                                        ?>
                                    </span>
                                </a>
                                <ul class="dropdown-menu extended notification">
                                    <div class="notify-arrow notify-arrow-yellow"></div>
                                    <li>
                                        <p class="yellow"><?php
                                                            echo $report_number . ' ';
                                                            if ($report_number <= 1) {
                                                                echo lang('report_added_today');
                                                            } else {
                                                                echo lang('reports_added_today');
                                                            }
                                                            ?> </p>
                                    </li>
                                    <li>
                                        <a href="report">
                                            <p class="green"><?php echo lang('see_all_reports'); ?></p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php } ?>
                    <?php } ?>
                    <?php if ($this->ion_auth->in_group('Patient')) { ?>
                        <?php if (in_array('report', $this->modules)) { ?>
                            <li id="header_notification_bar" class="dropdown">
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <i class="fa fa-notes-medical"></i>
                                    <span class="badge bg-success">
                                        <?php
                                        $this->db->where('hospital_id', $this->hospital_id);
                                        $query = $this->db->get('report');
                                        $query = $query->result();
                                        foreach ($query as $report) {
                                            if ($this->ion_auth->user()->row()->id == explode('*', $report->patient)[1]) {
                                                $report_number[] = '1';
                                            }
                                        }
                                        if (!empty($report_number)) {
                                            echo $report_number = array_sum($report_number);
                                        } else {
                                            $report_number = 0;
                                            echo $report_number;
                                        }
                                        ?>
                                    </span>
                                </a>
                                <ul class="dropdown-menu extended notification">
                                    <div class="notify-arrow notify-arrow-yellow"></div>
                                    <li>
                                        <p class="yellow"><?php
                                                            echo $report_number . ' ';
                                                            if ($report_number <= 1) {
                                                                echo lang('report_is_available_for_you');
                                                            } else {
                                                                echo lang('reports_are_available_for_you');
                                                            }
                                                            ?> </p>
                                    </li>
                                    <li>
                                        <a href="report/myreports">
                                            <p class="green"><?php echo lang('see_your_reports'); ?></p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php } ?>
                    <?php } ?>
                    <!-- report notification end -->
                </ul>
            </div>
            <div class="top-nav ">

                <ul class="nav pull-right top-menu">
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <img alt="" src="uploads/favicon.png" width="21" height="23">
                            <span class="username">
                                <?php
                                $username = $this->ion_auth->user()->row()->username;
                                if (!empty($username)) {
                                    $username = explode(' ', $username);
                                    $first_name = $username[0];
                                    echo $first_name;
                                }
                                ?>
                            </span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <div class="log-arrow-up"></div>
                            <?php if (!$this->ion_auth->in_group('admin')) { ?>
                                <li><a href=""><i class="fa fa-home"></i> <?php echo lang('dashboard'); ?></a></li>
                            <?php } ?>
                            <li><a href="profile"><i class=" fa fa-suitcase"></i><?php echo lang('profile'); ?></a></li>
                            <?php if ($this->ion_auth->in_group('admin')) { ?>
                                <li><a href="settings"><i class="fa fa-cog"></i> <?php echo lang('settings'); ?></a></li>
                            <?php } ?>

                            <li><a><i class="fa fa-user"></i> <?php echo $this->ion_auth->get_users_groups()->row()->name ?></a></li>
                            <li><a href="auth/logout"><i class="fa fa-key"></i> <?php echo lang('log_out'); ?></a></li>
                        </ul>
                    </li>
                    <!-- user login dropdown end -->
                </ul>
                <?php
                $message = $this->session->flashdata('feedback');
                if (!empty($message)) {
                ?>
                    <code class="flashmessage pull-right"> <?php echo $message; ?></code>
                <?php } ?>
            </div>
            <?php if ($this->ion_auth->in_group(array('admin', 'superadmin'))) { ?>
                <?php if ($this->ion_auth->in_group(array('superadmin'))) {
                    $site_map = $this->db->where('for_login', 'superadmin')->get('site_map')->result();
                } else {
                    $site_map = $this->db->where('for_login', 'admin')->get('site_map')->result();
                } ?>
                <span class="nav pull-right top-menu quickFindDiv">
                    <input type="search" id="txtQuickFind" class="form-control hidden-xs input-sm input-quick-find" autocomplete="off" placeholder="Go to" role="combobox" aria-expanded="false" aria-label="Search" aria-autocomplete="list" aria-owns="typeahead-menu">
                    <ul class="dropdown-menu menu-position" role="listbox" aria-hidden="false" id="typeahead-menu">
                        <?php foreach ($site_map as $option) { ?>


                            <li role="option" class="site_map hide-option" id="typeahead-option-<?php echo $option->id ?>" data-name="<?php echo $option->name ?>">
                                <a href="<?php echo $option->url ?>" class="option-link">
                                    <?php echo $option->name ?>
                                </a>
                            </li>

                        <?php } ?>
                        <ul>
                </span>
            <?php } ?>
        </header>
        <!--header end-->
        <!--sidebar start-->

        <!--sidebar start-->

        <aside>
            <div id="sidebar" class="nav-collapse">
                <!-- sidebar menu start-->
                <?php
                $user = $this->ion_auth->get_user_id();

                $users_details = $this->db->get_where('users', array('id' => $user))->row();

                if ($this->ion_auth->in_group(array('Patient'))) {
                    $img_url = $this->db->get_where('patient', array('ion_user_id' => $users_details->id))->row()->img_url;
                } elseif ($this->ion_auth->in_group(array('Doctor'))) {
                    $img_url = $this->db->get_where('doctor', array('ion_user_id' => $users_details->id))->row()->img_url;
                } elseif ($this->ion_auth->in_group(array('Receptionist'))) {
                    $img_url = $this->db->get_where('receptionist', array('ion_user_id' => $users_details->id))->row()->img_url;
                } elseif ($this->ion_auth->in_group(array('Nurse'))) {
                    $img_url = $this->db->get_where('nurse', array('ion_user_id' => $users_details->id))->row()->img_url;
                } elseif ($this->ion_auth->in_group(array('Accountant'))) {
                    $img_url = $this->db->get_where('accountant', array('ion_user_id' => $users_details->id))->row()->img_url;
                } elseif ($this->ion_auth->in_group(array('Pharmacist'))) {
                    $img_url = $this->db->get_where('pharmacist', array('ion_user_id' => $users_details->id))->row()->img_url;
                } elseif ($this->ion_auth->in_group(array('Laboratorist'))) {
                    $img_url = $this->db->get_where('laboratorist', array('ion_user_id' => $users_details->id))->row()->img_url;
                } elseif ($this->ion_auth->in_group(array('superadmin'))) {
                    $img_url = $this->db->get_where('superadmin', array('ion_user_id' => $users_details->id))->row()->img_url;
                } else {
                    $img_url = 'uploads/sidebar_image.png';
                }

                if (empty($img_url)) {
                    $img_url = 'uploads/sidebar_image.png';
                }

                ?>
                <ul class="sidebar-menu" id="nav-accordion">
                    <!-- <li class="li_info">   <div class="text-center">
                       <img src="<?php echo $img_url; ?>" class="img_dashboard" alt="">
                      
                       </div>
                       <div class="text-center"><p class="profile_name"><?php echo $users_details->username; ?></p></div>
                    </li> -->
                    <li>
                        <a href="home">
                            <i class="fa fa-home"></i>
                            <span><?php echo lang('dashboard'); ?></span>
                        </a>
                    </li>
                    <?php if ($this->ion_auth->in_group('admin')) { ?>
                        <?php if (in_array('department', $this->modules)) { ?>
                            <li>
                                <a href="department">
                                    <i class="fa fa-sitemap"></i>
                                    <span><?php echo lang('departments'); ?></span>
                                </a>
                            </li>
                        <?php } ?>
                    <?php } ?>
                    <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                        <?php if (in_array('doctor', $this->modules)) { ?>
                            <li class="sub-menu">
                                <a href="javascript:;">
                                    <i class="fa fa-user-md"></i>
                                    <span><?php echo lang('doctor'); ?></span>
                                </a>
                                <ul class="sub">
                                    <li><a href="doctor"><i class="fa fa-user"></i><?php echo lang('list_of_doctors'); ?></a></li>
                                    <li><a href="appointment/treatmentReport"><i class="fa fa-history"></i><?php echo lang('treatment_history'); ?></a></li>
                                    <li><a href="doctorvisit"><i class="fa fa-clinic-medical"></i><?php echo lang('doctor_visit'); ?></a></li>
                                </ul>
                            </li>
                        <?php } ?>
                    <?php } ?>
                    <?php if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Nurse', 'Doctor', 'Laboratorist', 'Receptionist'))) { ?>
                        <?php if (in_array('patient', $this->modules)) { ?>
                            <li class="sub-menu">
                                <a href="javascript:;">
                                    <i class="fa fa-users-medical"></i>
                                    <span><?php echo lang('patient'); ?></span>
                                </a>
                                <ul class="sub">
                                    <li><a href="patient"><i class="fa fa-user"></i><?php echo lang('patient_list'); ?></a></li>

                                    <?php if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Doctor', 'Receptionist'))) { ?>
                                        <li><a href="patient/patientPayments"><i class="fa fa-money-check"></i><?php echo lang('payments'); ?></a></li>
                                    <?php } ?>
                                    <?php if (!$this->ion_auth->in_group(array('Accountant', 'Receptionist'))) { ?>
                                        <li><a href="patient/caseList"><i class="fa fa-book"></i><?php echo lang('case'); ?> <?php echo lang('manager'); ?></a></li>
                                        <li><a href="patient/documents"><i class="fa fa-file"></i><?php echo lang('documents'); ?></a></li>
                                    <?php } ?>
                                </ul>
                            </li>
                        <?php } ?>
                    <?php } ?>


                    <?php if ($this->ion_auth->in_group(array('admin', 'Nurse', 'Receptionist'))) { ?>
                        <?php if (in_array('appointment', $this->modules)) { ?>
                            <li class="sub-menu">
                                <a href="javascript:;">
                                    <i class="fa fa-clock"></i>
                                    <span><?php echo lang('schedule'); ?></span>
                                </a>
                                <ul class="sub">
                                    <li><a href="schedule"><i class="fa fa-list-alt"></i><?php echo lang('all'); ?> <?php echo lang('schedule'); ?></a></li>
                                    <li><a href="schedule/allHolidays"><i class="fa fa-list-alt"></i><?php echo lang('holidays'); ?></a></li>
                                </ul>
                            </li>
                        <?php } ?>
                    <?php } ?>

                    <?php if ($this->ion_auth->in_group(array('Doctor'))) { ?>
                        <?php if (in_array('appointment', $this->modules)) { ?>
                            <li class="sub-menu">
                                <a href="javascript:;">
                                    <i class="fa fa-clock"></i>
                                    <span><?php echo lang('schedule'); ?></span>
                                </a>
                                <ul class="sub">
                                    <li><a href="schedule/timeSchedule"><i class="fa fa-list-alt"></i><?php echo lang('all'); ?> <?php echo lang('schedule'); ?></a></li>
                                    <li><a href="schedule/holidays"><i class="fa fa-list-alt"></i><?php echo lang('holidays'); ?></a></li>
                                </ul>
                            </li>
                        <?php } ?>
                    <?php } ?>

                    <?php if ($this->ion_auth->in_group(array('admin', 'Doctor', 'Nurse', 'Receptionist'))) { ?>
                        <?php if (in_array('appointment', $this->modules)) { ?>
                            <li class="sub-menu">
                                <a href="javascript:;">
                                    <i class="fa fa-calendar-check"></i>
                                    <span><?php echo lang('appointment'); ?></span>
                                </a>
                                <ul class="sub">
                                    <li><a href="appointment"><i class="fa fa-list-alt"></i><?php echo lang('all'); ?></a></li>
                                    <li><a href="appointment/addNewView"><i class="fa fa-plus-circle"></i><?php echo lang('add'); ?></a></li>
                                    <li><a href="appointment/todays"><i class="fa fa-list-alt"></i><?php echo lang('todays'); ?></a></li>
                                    <li><a href="appointment/upcoming"><i class="fa fa-list-alt"></i><?php echo lang('upcoming'); ?></a></li>
                                    <li><a href="appointment/calendar"><i class="fa fa-list-alt"></i><?php echo lang('calendar'); ?></a></li>
                                    <li><a href="appointment/request"><i class="fa fa-list-alt"></i><?php echo lang('request'); ?></a></li>
                                </ul>
                            </li>
                        <?php } ?>
                    <?php } ?>


                    <?php if ($this->ion_auth->in_group(array(''))) { ?>
                        <?php if (in_array('appointment', $this->modules)) { ?>
                            <li class="sub-menu">
                                <a href="javascript:;">
                                    <i class="fa fa-headphones"></i>
                                    <span><?php echo lang('live'); ?> <?php echo lang('meetings'); ?></span>
                                </a>
                                <ul class="sub">
                                    <?php if (!$this->ion_auth->in_group(array('Patient'))) { ?>
                                        <li><a href="meeting/addNewView"><i class="fa fa-plus-circle"></i><?php echo lang('create'); ?> <?php echo lang('meeting'); ?></a></li>
                                    <?php } ?>
                                    <li><a href="meeting"><i class="fa fa-video"></i><?php echo lang('live'); ?> <?php echo lang('now'); ?></a></li>
                                    <li><a href="meeting/upcoming"><i class="fa fa-list-alt"></i><?php echo lang('upcoming'); ?> <?php echo lang('meetings'); ?></a></li>
                                    <li><a href="meeting/previous"><i class="fa fa-list-alt"></i><?php echo lang('previous'); ?> <?php echo lang('meetings'); ?></a></li>
                                </ul>
                            </li>
                        <?php } ?>
                    <?php } ?>



                    <?php if ($this->ion_auth->in_group(array(''))) { ?>
                        <?php if (in_array('appointment', $this->modules)) { ?>
                            <li><a href="meeting"><i class="fa fa-headphones"></i><?php echo lang('join_live'); ?></a></li>
                        <?php } ?>
                    <?php } ?>

                    <?php if ($this->ion_auth->in_group(array('Patient'))) { ?>
                        <?php if (in_array('appointment', $this->modules)) { ?>
                            <li><a href="appointment/myTodays"><i class="fa fa-headphones"></i><?php echo lang('todays'); ?> <?php echo lang('appointment'); ?></a></li>
                        <?php } ?>
                        <?php if (in_array('notice', $this->modules)) { ?>
                            <li><a href="notice"><i class="fa fa-bell"></i><?php echo lang('notice'); ?></a></li>
                        <?php } ?>
                    <?php } ?>






                    <?php if ($this->ion_auth->in_group('admin')) { ?>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-users"></i>
                                <span><?php echo lang('human_resources'); ?></span>
                            </a>
                            <ul class="sub">
                                <?php if (in_array('nurse', $this->modules)) { ?>
                                    <li><a href="nurse"><i class="fa fa-user"></i><?php echo lang('nurse'); ?></a></li>
                                <?php } ?>
                                <?php if (in_array('pharmacist', $this->modules)) { ?>
                                    <li><a href="pharmacist"><i class="fa fa-user"></i><?php echo lang('pharmacist'); ?></a></li>
                                <?php } ?>
                                <?php if (in_array('laboratorist', $this->modules)) { ?>
                                    <li><a href="laboratorist"><i class="fa fa-user"></i><?php echo lang('laboratorist'); ?></a></li>
                                <?php } ?>
                                <?php if (in_array('accountant', $this->modules)) { ?>
                                    <li><a href="accountant"><i class="fa fa-user"></i><?php echo lang('accountant'); ?></a></li>
                                <?php } ?>
                                <?php if (in_array('receptionist', $this->modules)) { ?>
                                    <li><a href="receptionist"><i class="fa fa-user"></i><?php echo lang('receptionist'); ?></a></li>
                                <?php } ?>
                            </ul>
                        </li>
                    <?php } ?>

                    <!-- NEW ADDITIONS -->
                    <?php if ($this->ion_auth->in_group(array('Accountant', 'Receptionist', 'Nurse', 'Laboratorist', 'Pharmacist', 'Doctor'))) { ?>
                        <?php if (in_array('attendance', $this->modules)) { ?>
                            <li class="sub-menu">
                                <a href="attendance">
                                    <i class="fa fa-bell-slash"></i>
                                    <span><?php echo lang('attendance'); ?></span>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if (in_array('leave', $this->modules)) { ?>
                            <li class="sub-menu">
                                <a href="javascript:;">
                                    <i class="fa fa-bell-slash"></i>
                                    <span><?php echo lang('leave'); ?></span>
                                </a>
                                <ul class="sub">
                                    <?php if (in_array('leave', $this->modules)) { ?>
                                        <li><a href="leave"><i class="fa fa-user"></i><?php echo lang('leave'); ?></a></li>
                                    <?php } ?>
                                </ul>
                            </li>
                        <?php } ?>
                        <?php if (in_array('payroll', $this->modules)) { ?>
                            <li class="sub-menu">
                                <a href="javascript:;">
                                    <i class="fa fa-money-check"></i>
                                    <span><?php echo lang('payroll'); ?></span>
                                </a>
                                <ul class="sub">
                                    <?php if (in_array('payroll', $this->modules)) { ?>
                                        <li><a href="payroll/employeePayroll"><i class="fa fa-user"></i><?php echo lang('payroll'); ?></a></li>
                                    <?php } ?>
                                </ul>
                            </li>
                        <?php } ?>
                        <?php if (in_array('notice', $this->modules)) { ?>
                            <li class="sub-menu">
                                <a href="notice">
                                    <i class="fa fa-bell"></i>
                                    <span><?php echo lang('notice'); ?></span>
                                </a>
                            </li>
                        <?php } ?>
                    <?php } ?>


                    <?php if ($this->ion_auth->in_group('admin')) { ?>
                        <?php if (in_array('finance', $this->modules)) { ?>
                            <li class="sub-menu">
                                <a href="javascript:;">
                                    <i class="fa fa-money-check"></i>
                                    <span><?php echo lang('financial_activities'); ?></span>
                                </a>
                                <ul class="sub">
                                    <li><a href="finance/addPaymentView"><i class="fa fa-plus-circle"></i><?php echo lang('add_payment'); ?></a></li>
                                    <li><a href="finance/payment"><i class="fa fa-money-check"></i> <?php echo lang('payments'); ?></a></li>
                                    <li><a href="finance/draftPayment"><i class="fa fa-money-check"></i> <?php echo lang('draft_payments'); ?></a></li>
                                    <li><a href="finance/dueCollection"><i class="fa fa-money-check"></i> <?php echo lang('due_collection'); ?></a></li>
                                    <!-- <li><a  href="finance/addPaymentView"><i class="fa fa-plus-circle"></i><?php echo lang('add_payment'); ?></a></li> -->
                                    <li><a href="finance/paymentCategory"><i class="fa fa-edit"></i><?php echo lang('payment_procedures'); ?></a></li>
                                    <li><a href="finance/category"><i class="fa fa-edit"></i><?php echo lang('payment_categories'); ?></a></li>
                                    <li><a href="finance/expense"><i class="fa fa-money-check"></i><?php echo lang('expense'); ?></a></li>
                                    <li><a href="finance/addExpenseView"><i class="fa fa-plus-circle"></i><?php echo lang('add_expense'); ?></a></li>
                                    <li><a href="finance/expenseCategory"><i class="fa fa-edit"></i><?php echo lang('expense_categories'); ?> </a></li>


                                </ul>
                            </li>
                        <?php } ?>
                    <?php } ?>

                    <?php if ($this->ion_auth->in_group('Receptionist')) { ?>
                        <?php if (in_array('appointment', $this->modules)) { ?>
                            <li>
                                <a href="appointment/calendar">
                                    <i class="fa fa-calendar"></i>
                                    <span> <?php echo lang('calendar'); ?> </span>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if (in_array('finance', $this->modules)) { ?>
                            <li class="sub-menu">
                                <a href="javascript:;">
                                    <i class="fa fa-money-check"></i>
                                    <span><?php echo lang('financial_activities'); ?></span>
                                </a>
                                <ul class="sub">
                                    <li><a href="finance/payment"><i class="fa fa-money-check"></i> <?php echo lang('payments'); ?></a></li>
                                    <li><a href="finance/addPaymentView"><i class="fa fa-plus-circle"></i><?php echo lang('add_payment'); ?></a></li>
                                    <li><a href="finance/dueCollection"><i class="fa fa-money-check"></i> <?php echo lang('due_collection'); ?></a></li>
                                </ul>
                            </li>
                        <?php } ?>
                    <?php } ?>



                    <?php if ($this->ion_auth->in_group(array('admin', 'Pharmacist'))) { ?>
                        <?php if (in_array('prescription', $this->modules)) { ?>
                            <li>
                                <a href="prescription/all">
                                    <i class="fas fa-prescription"></i>
                                    <span> <?php echo lang('prescription'); ?> </span>
                                </a>
                            </li>
                        <?php } ?>
                    <?php } ?>

                    <?php
                    if ($this->ion_auth->in_group(array('Receptionist'))) {
                    ?>
                        <?php if (in_array('lab', $this->modules)) { ?>
                            <li>
                                <a href="lab/lab1">
                                    <i class="fas fa-file-medical"></i>
                                    <span><?php echo lang('lab_reports'); ?></span>
                                </a>
                            </li>
                        <?php } ?>
                    <?php
                    }
                    ?>

                    <?php
                    if ($this->ion_auth->in_group(array('Accountant', 'Receptionist'))) {
                    ?>
                        <?php if (in_array('finance', $this->modules)) { ?>
                            <li>
                                <a href="finance/UserActivityReport">
                                    <i class="fa fa-file-user"></i>
                                    <span><?php echo lang('user_activity_report'); ?></span>
                                </a>
                            </li>
                        <?php } ?>
                    <?php
                    }
                    ?>


                    <?php if ($this->ion_auth->in_group(array('Doctor'))) { ?>
                        <?php if (in_array('prescription', $this->modules)) { ?>
                            <li>
                                <a href="prescription">
                                    <i class="fa fa-prescription"></i>
                                    <span><?php echo lang('prescription'); ?></span>
                                </a>
                            </li>
                        <?php } ?>
                    <?php } ?>



                    <?php if ($this->ion_auth->in_group(array('admin', 'Doctor', 'Laboratorist'))) { ?>
                        <?php if (in_array('lab', $this->modules)) { ?>
                            <li class="sub-menu">
                                <a href="javascript:;">
                                    <i class="fa fa-flask"></i>
                                    <span><?php echo lang('labs'); ?></span>
                                </a>
                                <ul class="sub">
                                    <li><a href="lab/testStatus"><i class="fa fa-file-medical"></i><?php echo lang('lab_tests'); ?></a></li>
                                    <li><a href="lab"><i class="fa fa-file-medical"></i><?php echo lang('lab_reports'); ?></a></li>
                                    <li><a href="lab/reportDelivery"><i class="fa fa-file-medical"></i><?php echo lang('report') . " " . lang('delivery');; ?></a></li>
                                    <!--                                        <li><a  href="lab"><i class="fa fa-file-medical"></i><?php echo lang('lab_reports'); ?></a></li>
                                        <li><a  href="lab"><i class="fa fa-file-medical"></i><?php echo lang('lab_reports'); ?></a></li>-->
                                    <!--                                        <li><a  href="lab/addLabView"><i class="fa fa-plus-circle"></i><?php echo lang('add_lab_report'); ?></a></li>-->
                                    <li><a href="lab/template"><i class="fa fa-plus-circle"></i><?php echo lang('template'); ?></a></li>
                                    <li><a href="macro"><i class="fa fa-file-medical"></i><?php echo lang('macro'); ?></a></li>
                                </ul>
                            </li>
                        <?php } ?>
                    <?php } ?>
                    <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                        <?php if (in_array('bed', $this->modules)) { ?>
                            <li class="sub-menu">
                                <a href="javascript:;">
                                    <i class="fas fa-procedures"></i>
                                    <span><?php echo lang('bed_and_admission'); ?></span>
                                </a>
                                <ul class="sub">
                                    <li><a href="bed/bedAllotment"><i class="fas fa-bed"></i><?php echo lang('all_admissions'); ?></a></li>
                                    <li><a href="bed/addAllotmentView"><i class="fa fa-plus-circle"></i><?php echo lang('add_admission'); ?></a></li>
                                    <li><a href="bed"><i class="fas fa-procedures"></i><?php echo lang('bed_list'); ?></a></li>
                                    <li><a href="bed/addBedView"><i class="fa fa-plus-circle"></i><?php echo lang('add_bed'); ?></a></li>
                                    <li><a href="bed/bedCategory"><i class="fa fa-edit"></i><?php echo lang('bed_category'); ?></a></li>
                                    <li><a href="pservice"><i class="fa fa-smile"></i><?php echo lang('patient'); ?> <?php echo lang('service'); ?></a></li>
                                </ul>
                            </li>
                        <?php } ?>
                    <?php } ?>
                    <?php if ($this->ion_auth->in_group(array('admin', 'Pharmacist'))) { ?>
                        <?php if (in_array('pharmacy', $this->modules)) { ?>
                            <li class="sub-menu">
                                <a href="javascript:;">
                                    <i class="fas fa-capsules"></i>
                                    <span><?php echo lang('pharmacy'); ?></span>
                                </a>
                                <ul class="sub">
                                    <?php if (!$this->ion_auth->in_group(array('Pharmacist'))) { ?>
                                        <li><a href="finance/pharmacy/home"><i class="fa fa-home"></i> <?php echo lang('dashboard'); ?></a></li>
                                    <?php } ?>
                                    <li><a href="finance/pharmacy/payment"><i class="fa fa-money-check"></i> <?php echo lang('sales'); ?></a></li>
                                    <li><a href="finance/pharmacy/addPaymentView"><i class="fa fa-plus-circle"></i><?php echo lang('add_new_sale'); ?></a></li>
                                    <li><a href="finance/pharmacy/expense"><i class="fa fa-money-check"></i><?php echo lang('expense'); ?></a></li>
                                    <li><a href="finance/pharmacy/addExpenseView"><i class="fa fa-plus-circle"></i><?php echo lang('add_expense'); ?></a></li>
                                    <li><a href="finance/pharmacy/expenseCategory"><i class="fa fa-edit"></i><?php echo lang('expense_categories'); ?> </a></li>
                                    <?php if ($this->ion_auth->in_group(array('admin', 'Pharmacist'))) { ?>
                                        <li class="sub-menu">
                                            <a href="javascript:;">
                                                <i class="fas fa-file-medical-alt"></i>
                                                <span><?php echo lang(''); ?> <?php echo lang('report'); ?></span>
                                            </a>
                                            <ul class="sub">
                                                <li><a href="finance/pharmacy/financialReport"><i class="fa fa-book"></i><?php echo lang('pharmacy'); ?> <?php echo lang('report'); ?> </a></li>
                                                <li><a href="finance/pharmacy/monthly"><i class="fa fa-chart-bar"></i> <?php echo lang('monthly_sales'); ?> </a></li>
                                                <li><a href="finance/pharmacy/daily"><i class="fa fa-chart-bar"></i> <?php echo lang('daily_sales'); ?> </a></li>
                                                <li><a href="finance/pharmacy/monthlyExpense"><i class="fa fa-chart-area"></i> <?php echo lang('monthly_expense'); ?> </a></li>
                                                <li><a href="finance/pharmacy/dailyExpense"><i class="fa fa-chart-area"></i> <?php echo lang('daily_expense'); ?> </a></li>

                                            </ul>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </li>
                        <?php } ?>
                    <?php } ?>
                    <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                        <?php if (in_array('medicine', $this->modules)) { ?>
                            <li class="sub-menu">
                                <a href="javascript:;">
                                    <i class="fa  fa-medkit"></i>
                                    <span><?php echo lang('medicine'); ?></span>
                                </a>
                                <ul class="sub">
                                    <li><a href="medicine"><i class="fa fa-medkit"></i><?php echo lang('medicine_list'); ?></a></li>
                                    <li><a href="medicine/addMedicineView"><i class="fa fa-plus-circle"></i><?php echo lang('add_medicine'); ?></a></li>
                                    <li><a href="medicine/medicineCategory"><i class="fa fa-edit"></i><?php echo lang('medicine_category'); ?></a></li>
                                    <li><a href="medicine/addCategoryView"><i class="fa fa-plus-circle"></i><?php echo lang('add_medicine_category'); ?></a></li>
                                    <li><a href="medicine/medicineStockAlert"><i class="fa fa-plus-circle"></i><?php echo lang('medicine_stock_alert'); ?></a></li>

                                </ul>
                            </li>
                        <?php } ?>
                    <?php } ?>
                    <?php if ($this->ion_auth->in_group(array('admin', 'Laboratorist'))) { ?>
                        <?php if (in_array('donor', $this->modules)) { ?>
                            <li class="sub-menu">
                                <a href="javascript:;">
                                    <i class="fa  fa-hand-holding-water"></i>
                                    <span><?php echo lang('donor') ?></span>
                                </a>
                                <ul class="sub">
                                    <li><a href="donor"><i class="fa fa-user"></i><?php echo lang('donor_list'); ?></a></li>
                                    <li><a href="donor/addDonorView"><i class="fa fa-plus-circle"></i><?php echo lang('add_donor'); ?></a></li>
                                    <li><a href="donor/bloodBank"><i class="fa fa-tint"></i><?php echo lang('blood_bank'); ?></a></li>
                                </ul>
                            </li>
                        <?php } ?>
                    <?php } ?>
                    <?php if ($this->ion_auth->in_group(array('admin', 'Nurse', 'Accountant', 'Pharmacist', 'Doctor', 'Laboratorist', 'Receptionist'))) { ?>
                        <?php if (in_array('file', $this->modules)) { ?>
                            <li class="sub-menu">
                                <a href="javascript:;">
                                    <i class="fa fa-clock"></i>
                                    <span><?php echo lang('file_manager'); ?></span>
                                </a>
                                <ul class="sub">
                                    <li><a href="file"><i class="fa fa-list-alt"></i><?php echo lang('all'); ?> <?php echo lang('file'); ?></a></li>
                                    <li><a href="file/addNewView"><i class="fa fa-list-alt"></i><?php echo lang('add_file'); ?></a></li>
                                </ul>
                            </li>
                        <?php } ?>
                    <?php } ?>
                    <?php if ($this->ion_auth->in_group(array('admin', 'Nurse', 'Laboratorist', 'Doctor'))) { ?>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fas fa-file-medical-alt"></i>
                                <span><?php echo lang('report'); ?></span>
                            </a>
                            <ul class="sub">
                                <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                    <?php if (in_array('finance', $this->modules)) { ?>
                                        <li><a href="finance/financialReport"><i class="fa fa-book"></i><?php echo lang('financial_report'); ?></a></li>
                                        <li> <a href="finance/AllUserActivityReport"> <i class="fa fa-home"></i> <span><?php echo lang('user_activity_report'); ?></span> </a></li>
                                    <?php } ?>
                                <?php } ?>
                                <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                    <?php if (in_array('finance', $this->modules)) { ?>
                                        <li><a href="finance/doctorsCommission"><i class="fa fa-edit"></i><?php echo lang('doctors_commission'); ?> </a></li>
                                        <li><a href="finance/monthly"><i class="fa fa-chart-bar"></i> <?php echo lang('monthly_sales'); ?> </a></li>
                                        <li><a href="finance/daily"><i class="fa fa-chart-bar"></i> <?php echo lang('daily_sales'); ?> </a></li>
                                        <li><a href="finance/monthlyExpense"><i class="fa fa-chart-area"></i> <?php echo lang('monthly_expense'); ?> </a></li>
                                        <li><a href="finance/dailyExpense"><i class="fa fa-chart-area"></i> <?php echo lang('daily_expense'); ?> </a></li>
                                        <li><a href="finance/expenseVsIncome"><i class="fa fa-chart-bar"></i> <?php echo lang('expense_vs_income'); ?> </a></li>
                                    <?php } ?>
                                <?php } ?>
                                <?php if (in_array('report', $this->modules)) { ?>
                                    <li><a href="report/birth"><i class="fas fa-file-medical"></i><?php echo lang('birth_report'); ?></a></li>
                                    <li><a href="report/operation"><i class="fa fa-wheelchair"></i><?php echo lang('operation_report'); ?></a></li>
                                    <li><a href="report/expire"><i class="fas fa-file-medical"></i><?php echo lang('expire_report'); ?></a></li>
                                <?php } ?>
                            </ul>
                        </li>
                    <?php } ?>
                    <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                        <?php if (in_array('notice', $this->modules)) { ?>
                            <li class="sub-menu">
                                <a href="javascript:;">
                                    <i class="fa fa-bells"></i>
                                    <span><?php echo lang('notice'); ?></span>
                                </a>
                                <ul class="sub">
                                    <li><a href="notice"><i class="fa fa-bells"></i><?php echo lang('notice'); ?></a></li>
                                    <li><a href="notice/addNewView"><i class="fa fa-list-alt"></i><?php echo lang('add_new'); ?></a></li>
                                </ul>
                            </li>
                        <?php } ?>
                    <?php } ?>
                    <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                        <?php if (in_array('email', $this->modules)) { ?>
                            <li class="sub-menu">
                                <a href="javascript:;">
                                    <i class="fa fa-mail-bulk"></i>
                                    <span><?php echo lang('email'); ?></span>
                                </a>
                                <ul class="sub">
                                    <li><a href="email/autoEmailTemplate"><i class="fa fa-robot"></i><?php echo lang('autoemailtemplate'); ?></a></li>
                                    <li><a href="email/sendView"><i class="fa fa-location-arrow"></i><?php echo lang('new'); ?></a></li>
                                    <li><a href="email/sent"><i class="fa fa-list-alt"></i><?php echo lang('sent'); ?></a></li>
                                    <?php
                                    if ($this->ion_auth->in_group(array('admin'))) {
                                        $mail_setting = $this->email_model->getHospitalEmailSettings();
                                        foreach ($mail_setting as $email_set) {
                                            if ($email_set->type == 'Smtp') {
                                                $email_id = $email_set->id;
                                            }
                                        }
                                    ?>
                                        <li><a href="email/settings?id=<?php echo $email_id; ?>"><i class="fa fa-cogs"></i><?php echo lang('settings'); ?></a></li>
                                    <?php } ?>
                                </ul>
                            </li>
                        <?php } ?>
                    <?php } ?>
                    <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                        <?php if (in_array('sms', $this->modules)) { ?>
                            <li class="sub-menu">
                                <a href="javascript:;">
                                    <i class="fa fa-sms"></i>
                                    <span><?php echo lang('sms'); ?></span>
                                </a>
                                <ul class="sub">
                                    <li><a href="sms/autoSMSTemplate"><i class="fa fa-robot"></i><?php echo lang('autosmstemplate'); ?></a></li>
                                    <li><a href="sms/sendView"><i class="fa fa-location-arrow"></i><?php echo lang('write_message'); ?></a></li>
                                    <li><a href="sms/sent"><i class="fa fa-list-alt"></i><?php echo lang('sent_messages'); ?></a></li>
                                    <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                        <li><a href="sms"><i class="fa fa-cogs"></i><?php echo lang('sms_settings'); ?></a></li>
                                    <?php } ?>
                                </ul>
                            </li>
                        <?php } ?>
                    <?php } ?>
                    <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                        <?php if (in_array('payroll', $this->modules)) { ?>
                            <li class="sub-menu">
                                <a href="javascript:;">
                                    <i class="fa fa-money-check"></i>
                                    <span><?php echo lang('payroll'); ?></span>
                                </a>
                                <ul class="sub">
                                    <?php if (in_array('payroll', $this->modules)) { ?>
                                        <li><a href="payroll"><i class="fa fa-user"></i><?php echo lang('payroll'); ?></a></li>
                                    <?php } ?>
                                    <?php if (in_array('payroll', $this->modules)) { ?>
                                        <li><a href="payroll/salary"><i class="fa fa-user"></i><?php echo lang('salary'); ?></a></li>
                                    <?php } ?>
                                </ul>
                            </li>
                    <?php
                        }
                    }
                    ?>
                    <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                        <?php if (in_array('attendance', $this->modules)) { ?>
                            <li class="sub-menu">
                                <a href="attendance">
                                    <i class="fa fa-bell-slash"></i>
                                    <span><?php echo lang('attendance'); ?></span>
                                </a>

                            </li>
                    <?php
                        }
                    }
                    ?>
                    <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                        <?php if (in_array('leave', $this->modules)) { ?>
                            <li class="sub-menu">
                                <a href="javascript:;">
                                    <i class="fa fa-bell-slash"></i>
                                    <span><?php echo lang('leave'); ?></span>
                                </a>
                                <ul class="sub">
                                    <?php if (in_array('leave', $this->modules)) { ?>
                                        <li><a href="leave"><i class="fa fa-user"></i><?php echo lang('leave'); ?></a></li>
                                    <?php } ?>
                                    <?php if (in_array('leave', $this->modules)) { ?>
                                        <li><a href="leave/leaveType"><i class="fa fa-user"></i><?php echo lang('leave_type'); ?></a></li>
                                    <?php } ?>
                                </ul>
                            </li>
                    <?php
                        }
                    }
                    ?>
                    <?php if ($this->ion_auth->in_group(array('admin', 'Nurse', 'Accountant', 'Pharmacist', 'Doctor', 'Laboratorist', 'Receptionist'))) { ?>
                        <?php if (in_array('chat', $this->modules)) { ?>
                            <li class="sub-menu">
                            <li><a href="chat"><i class="fa fa-comment"></i><?php echo lang('chat'); ?> <span id="chatCount">0</span> </a></li>
                            </li>
                            <script src="common/js/jquery.js"></script>
                            <script src="common/extranal/js/chat.js"></script>
                        <?php } ?>
                    <?php } ?>
                    <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fas fa-globe"></i>
                                <span><?php echo lang('website'); ?></span>
                            </a>
                            <?php

                            $hospital_username = $this->db->get_where('hospital', array('id' => $this->session->userdata('hospital_id')))->row()->username;
                            if (empty($hospital_username)) {
                                $hospital_username = '';
                            }

                            ?>
                            <ul class="sub">
                                <li><a href='site/<?php echo $hospital_username ?>' target="_blank"><i class="fa fa-globe"></i><?php echo lang('visit_site'); ?></a></li>
                                <li><a href="site/settings"><i class="fa fa-cog"></i><?php echo lang('website_settings'); ?></a></li>
                                <li><a href="site/review"><i class="fa fa-cog"></i><?php echo lang('reviews'); ?></a></li>
                                <li><a href="site/gridsection"><i class="fa fa-cog"></i><?php echo lang('gridsections'); ?></a></li>
                                <li><a href="site/gallery"><i class="fa fa-cog"></i><?php echo lang('gallery'); ?></a></li>
                                <li><a href="site/slide"><i class="fa fa-wrench"></i><?php echo lang('slides'); ?></a></li>
                                <li><a href="site/service"><i class="fab fa-servicestack"></i><?php echo lang('services'); ?></a></li>
                                <li><a href="site/featured"><i class="fa fa-address-card"></i><?php echo lang('featured_doctors'); ?></a></li>
                            </ul>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-cogs"></i>
                                <span><?php echo lang('settings'); ?></span>
                            </a>
                            <ul class="sub">
                                <li><a href="settings"><i class="fa fa-cog"></i><?php echo lang('system_settings'); ?></a></li>
                                <li><a href="pgateway"><i class="fa fa-credit-card"></i><?php echo lang('payment_gateway'); ?></a></li>
                                <li><a href="settings/language"><i class="fa fa-language"></i><?php echo lang('language'); ?></a></li>
                                <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                    <li><a href="import"><i class="fa fa-arrow-right"></i><?php echo lang('bulk'); ?> <?php echo lang('import'); ?></a></li>
                                <?php } ?>
                                <!-- <li><a href="logs"><i class="fa fa-history"></i><?php echo lang('login_logs'); ?></a></li> -->
                            </ul>
                        </li>
                    <?php } ?>
                    <?php if ($this->ion_auth->in_group('Accountant')) { ?>
                        <?php if (in_array('finance', $this->modules)) { ?>
                            <li class="sub-menu">
                                <a href="javascript:;">
                                    <i class="fa fa-money-bill-alt"></i>
                                    <span><?php echo lang('payments'); ?></span>
                                </a>
                                <ul class="sub">
                                    <li>
                                        <a href="finance/payment">
                                            <i class="fa fa-money-check"></i>
                                            <span> <?php echo lang('payments'); ?> </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="finance/addPaymentView">
                                            <i class="fa fa-plus-circle"></i>
                                            <span> <?php echo lang('add_payment'); ?> </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="finance/dueCollection"><i class="fa fa-money-check"></i>
                                            <?php echo lang('due_collection'); ?>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="finance/paymentCategory">
                                            <i class="fa fa-edit"></i>
                                            <span> <?php echo lang('payment_procedures'); ?> </span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="finance/expense">
                                    <i class="fa fa-money-check"></i>
                                    <span> <?php echo lang('expense'); ?> </span>
                                </a>
                            </li>
                            <li>
                                <a href="finance/addExpenseView">
                                    <i class="fa fa-plus-circle"></i>
                                    <span> <?php echo lang('add_expense'); ?> </span>
                                </a>
                            </li>
                            <li>
                                <a href="finance/expenseCategory">
                                    <i class="fa fa-edit"></i>
                                    <span> <?php echo lang('expense_categories'); ?> </span>
                                </a>
                            </li>
                            <li>
                                <a href="finance/doctorsCommission">
                                    <i class="fa fa-edit"></i>
                                    <span> <?php echo lang('doctors_commission'); ?> </span>
                                </a>
                            </li>
                            <li>
                                <a href="finance/financialReport">
                                    <i class="fa fa-book"></i>
                                    <span> <?php echo lang('financial_report'); ?> </span>
                                </a>
                            </li>
                        <?php } ?>
                    <?php } ?>
                    <?php if ($this->ion_auth->in_group('Pharmacist')) { ?>
                        <?php if (in_array('medicine', $this->modules)) { ?>
                            <li>
                                <a href="medicine">
                                    <i class="fa fa-medkit"></i>
                                    <span> <?php echo lang('medicine_list'); ?> </span>
                                </a>
                            </li>
                            <li>
                                <a href="medicine/addMedicineView">
                                    <i class="fa fa-plus-circle"></i>
                                    <span> <?php echo lang('add_medicine'); ?> </span>
                                </a>
                            </li>
                            <li>
                                <a href="medicine/medicineCategory">
                                    <i class="fa fa-medkit"></i>
                                    <span> <?php echo lang('medicine_category'); ?> </span>
                                </a>
                            </li>
                            <li>
                                <a href="medicine/addCategoryView">
                                    <i class="fa fa-plus-circle"></i>
                                    <span> <?php echo lang('add_medicine_category'); ?> </span>
                                </a>
                            </li>
                        <?php } ?>
                    <?php } ?>
                    <?php if ($this->ion_auth->in_group('Nurse')) { ?>
                        <?php if (in_array('bed', $this->modules)) { ?>
                            <li>
                                <a href="bed">
                                    <i class="fa fa-procedures"></i>
                                    <span> <?php echo lang('bed_list'); ?> </span>
                                </a>
                            </li>
                            <li>
                                <a href="bed/bedCategory">
                                    <i class="fa fa-edit"></i>
                                    <span> <?php echo lang('bed_category'); ?> </span>
                                </a>
                            </li>
                            <li>
                                <a href="bed/bedAllotment">
                                    <i class="fa fa-plus-circle"></i>
                                    <span> <?php echo lang('bed_allotments'); ?> </span>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if (in_array('donor', $this->modules)) { ?>
                            <li>
                                <a href="donor">
                                    <i class="fa fa-medkit"></i>
                                    <span> <?php echo lang('donor'); ?> </span>
                                </a>
                            </li>
                            <li>
                                <a href="donor/bloodBank">
                                    <i class="fa fa-tint"></i>
                                    <span> <?php echo lang('blood_bank'); ?> </span>
                                </a>
                            </li>
                        <?php } ?>
                    <?php } ?>
                    <?php if ($this->ion_auth->in_group('Patient')) { ?>
                        <?php if (in_array('lab', $this->modules)) { ?>
                            <li>
                                <a href="lab/myLab">
                                    <i class="fa fa-file-medical-alt"></i>
                                    <span> <?php echo lang('diagnosis'); ?> <?php echo lang('reports'); ?> </span>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if (in_array('appointment', $this->modules)) { ?>
                            <li>
                                <a href="patient/calendar">
                                    <i class="fa fa-calendar"></i>
                                    <span> <?php echo lang('appointment'); ?> <?php echo lang('calendar'); ?> </span>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if (in_array('patient', $this->modules)) { ?>
                            <li>
                                <a href="patient/myCaseList">
                                    <i class="fa fa-file-medical"></i>
                                    <span> <?php echo lang('cases'); ?> </span>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if (in_array('prescription', $this->modules)) { ?>
                            <li>
                                <a href="patient/myPrescription">
                                    <i class="fa fa-prescription"></i>
                                    <span> <?php echo lang('prescription'); ?> </span>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if (in_array('patient', $this->modules)) { ?>
                            <li>
                                <a href="patient/myDocuments">
                                    <i class="fa fa-file-upload"></i>
                                    <span> <?php echo lang('documents'); ?> </span>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if (in_array('finance', $this->modules)) { ?>
                            <li>
                                <a href="patient/myPaymentHistory">
                                    <i class="fa fa-money-bill-alt"></i>
                                    <span> <?php echo lang('payment'); ?> </span>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if (in_array('report', $this->modules)) { ?>
                            <li>
                                <a href="report/myreports">
                                    <i class="fa fa-file-medical-alt"></i>
                                    <span> <?php echo lang('other'); ?> <?php echo lang('reports'); ?> </span>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if (in_array('donor', $this->modules)) { ?>
                            <li>
                                <a href="donor">
                                    <i class="fa fa-user"></i>
                                    <span><?php echo lang('donor'); ?></span>
                                </a>
                            </li>
                        <?php } ?>
                    <?php } ?>
                    <?php if ($this->ion_auth->in_group('im')) { ?>
                        <li>
                            <a href="patient/addNewView">
                                <i class="fa fa-user"></i>
                                <span> <?php echo lang('add_patient'); ?> </span>
                            </a>
                        </li>
                        <li>
                            <a href="finance/addPaymentView">
                                <i class="fa fa-user"></i>
                                <span> <?php echo lang('add_payment'); ?> </span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (!$this->ion_auth->in_group(array('admin', 'Patient', 'superadmin'))) { ?>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-mail-bulk"></i>
                                <span><?php echo lang('email'); ?></span>
                            </a>
                            <ul class="sub">
                                <li><a href="email/sendView"><i class="fa fa-location-arrow"></i><?php echo lang('new'); ?></a></li>
                            </ul>
                        </li>
                    <?php } ?>
                    <?php if ($this->ion_auth->in_group('superadmin')) { ?>
                        <?php if (in_array('superadmin', $this->super_modules)) { ?>
                            <li>
                                <a href="superadmin">
                                    <i class="fa fa-users"></i>
                                    <span><?php echo lang('superadmin'); ?></span>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if (in_array('hospital', $this->super_modules)) { ?>
                            <li>
                                <a href="hospital">
                                    <i class="fa fa-sitemap"></i>
                                    <span><?php echo lang('all_hospitals'); ?></span>
                                </a>
                            </li>
                            <li>
                                <a href="hospital/addNewView">
                                    <i class="fa fa-plus-circle"></i>
                                    <span><?php echo lang('create_new_hospital'); ?></span>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if (in_array('package', $this->super_modules)) { ?>
                            <li>
                                <a href="hospital/package">
                                    <i class="fa fa-sitemap"></i>
                                    <span><?php echo lang('packages'); ?></span>
                                </a>
                            </li>
                            <li>
                                <a href="hospital/package/addNewView">
                                    <i class="fa fa-plus-circle"></i>
                                    <span><?php echo lang('add_new_package'); ?></span>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if (in_array('request', $this->super_modules)) { ?>
                            <li>
                                <a href="request">
                                    <i class="fa fa-sitemap"></i>
                                    <span><?php echo lang('registration_from_website'); ?></span>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if (in_array('systems', $this->super_modules)) { ?>
                            <li class="sub-menu">
                                <a href="javascript:;">
                                    <i class="fa fa-file-excel"></i>
                                    <span><?php echo lang('report'); ?></span>
                                </a>
                                <ul class="sub">
                                    <li><a href="systems/activeHospitals"><i class="fa fa-file-alt"></i><?php echo lang('active_hospitals'); ?></a></li>
                                    <li><a href="systems/inactiveHospitals"><i class="fa fa-file-alt"></i><?php echo lang('inactive_hospitals'); ?></a></li>
                                    <li><a href="systems/expiredHospitals"><i class="fa fa-file-alt"></i><?php echo lang('license_expire_hospitals'); ?></a></li>
                                    <li><a href="systems/registeredPatient"><i class="fa fa-file-alt"></i><?php echo lang('registered_patient'); ?></a></li>
                                    <li><a href="systems/registeredDoctor"><i class="fa fa-file-alt"></i><?php echo lang('registered_doctor'); ?></a></li>
                                    <li><a href="hospital/reportSubscription"><i class="fa fa-file-alt"></i><?php echo lang('subscription_report'); ?></a></li>
                                </ul>
                            </li>
                        <?php } ?>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-cogs"></i>
                                <span><?php echo lang('website'); ?></span>
                            </a>
                            <ul class="sub">
                                <li><a href="frontend" target="_blank"><i class="fa fa-globe"></i><?php echo lang('visit_site'); ?></a></li>
                                <li><a href="frontend/settings"><i class="fa fa-cog"></i><?php echo lang('website_settings'); ?></a></li>
                                <?php if (in_array('slide', $this->super_modules)) { ?>
                                    <li><a href="slide"><i class="fa fa-wrench"></i><?php echo lang('slides'); ?></a></li>
                                <?php } ?>
                                <?php if (in_array('service', $this->super_modules)) { ?>
                                    <li><a href="service"><i class="fa fa-smile"></i><?php echo lang('services'); ?></a></li>
                                <?php } ?>
                            </ul>
                        </li>
                    <?php } ?>
                    <?php if ($this->ion_auth->in_group(array('superadmin'))) { ?>
                        <?php if (in_array('email', $this->super_modules)) { ?>
                            <li class="sub-menu">
                                <a href="javascript:;">
                                    <i class="fa fa-mail-bulk"></i>
                                    <span><?php echo lang('email'); ?></span>
                                </a>
                                <ul class="sub">
                                    <li><a href="email/superadminSendView"><i class="fa fa-location-arrow"></i><?php echo lang('new'); ?></a></li>
                                    <li><a href="email/sent"><i class="fa fa-list-alt"></i><?php echo lang('sent'); ?></a></li>

                                    <li><a href="email/emailSettings"><i class="fa fa-cogs"></i><?php echo lang('settings'); ?></a></li>
                                    <li><a href="email/contactEmailSettings"><i class="fa fa-mail-bulk"></i><?php echo lang('contact'); ?> <?php echo lang('email'); ?></a></li>
                                </ul>
                            </li>
                        <?php } ?>
                    <?php } ?>
                    <?php if ($this->ion_auth->in_group(array('superadmin'))) { ?>
                        <li><a href="settings"><i class="fa fa-cog"></i><?php echo lang('system_settings'); ?></a></li>
                        <li><a href="settings/googleReCaptcha"><i class="fa fa-cog"></i>Google reCAPTCHA</a></li>
                        <?php if (in_array('pgateway', $this->super_modules)) { ?>
                            <li><a href="pgateway"><i class="fa fa-credit-card"></i><?php echo lang('payment_gateway'); ?></a></li>
                        <?php } ?>
                        <li><a href="settings/language"><i class="fa fa-language"></i><?php echo lang('language'); ?></a></li>
                        <!-- <li><a href="settings/verifyPurchase"><i class="fa fa-arrow-right"></i> <?php echo lang('purchase_code'); ?></a></li> -->
                    <?php } ?>
                    <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-history"></i>
                                <span><?php echo lang('logs'); ?></span>
                            </a>
                            <ul class="sub">
                                <li><a href="transactionLogs"><i class="fa fa-history"></i> <?php echo lang('transaction_logs'); ?></a></li>
                                <li><a href="logs"><i class="fa fa-history"></i><?php echo lang('user'); ?> <?php echo lang('login_logs'); ?></a></li>
                            </ul>
                        </li>
                    <?php } ?>
                    <li>
                        <a href="profile">
                            <i class="fa fa-user"></i>
                            <span> <?php echo lang('profile'); ?> </span>
                        </a>
                    </li>
                    <?php if ($this->ion_auth->in_group('admin')) { ?>
                        <li>
                            <a href="settings/subscription">
                                <i class="fa fa-user"></i>
                                <span> <?php echo lang('subscription'); ?> </span>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </aside>
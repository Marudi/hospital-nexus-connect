<!doctype html>
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
    <?php
    $class_name = $this->router->fetch_class();
    $class_name_lang = lang($class_name);
    if (empty($class_name_lang)) {
        $class_name_lang = $class_name;
    }
    ?>

        <meta charset="utf-8" />
        <title><?php echo $class_name_lang; ?> |
        <?php
        // if ($this->ion_auth->in_group(array('superadmin'))) {
        //     $this->db->where('hospital_id', 'superadmin');
        // } else {
        //     $this->db->where('hospital_id', $this->hospital_id);
        // }
        $this->db->where('hospital_id', 'superadmin');
        ?>
        <?php
        echo $this->db->get('settings')->row()->system_vendor;
        ?></title>
         <base href="<?php echo base_url(); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="Shaibal Saha" />
        <!-- App favicon -->
        <!-- <link rel="shortcut icon" href="uploads/test-removebg-preview.png"> -->
        <link rel="shortcut icon" type="image/x-icon" href="uploads/fav_icon.jpeg">
        <script>
            document.addEventListener("DOMContentLoaded", function () {
    const menuBtn = document.querySelector(".vertical-menu-btn");
    const verticalMenu = document.querySelector(".vertical-menu");

    menuBtn.addEventListener("click", function () {
        verticalMenu.classList.toggle("sidebar-open");
    });
});
        </script>
        <style>
            
@media (max-width: 768px) {
    .vertical-menu {
        display: none !important; /* Hide the side menu by default */
    }
.vertical-menu.sidebar-open {
  display: block !important; /* Shown when the class is added */
}
    
}
                #txtQuickFind {
                    width: 296px !important;
                }
                .form-group{
                    margin-bottom: 1rem!important;
                }
                @media print
                        {    
                            .no-print, .no-print *
                            {
                                display: none !important;
                            }
                        }
        </style>
       


        <!-- <link href="common/css/bootstrap.min.css" rel="stylesheet">
        <link href="common/css/bootstrap-reset.css" rel="stylesheet"> -->
        
        <!-- Bootstrap Css -->
        <link href="public/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="public/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="public/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
        <link href="common/assets/fontawesome5pro/css/all.min.css" rel="stylesheet" />
        <link href="common/assets/fullcalendar/fullcalendar.css" rel="stylesheet">
        <!-- Previous css -->
        <!-- <link href="common/css/style.css" rel="stylesheet"> -->

        <link rel="stylesheet" href="common/assets/bootstrap-datepicker/css/bootstrap-datepicker.css" />
        <link rel="stylesheet" type="text/css" href="common/assets/bootstrap-daterangepicker/daterangepicker-bs3.css" />
        <link rel="stylesheet" type="text/css" href="common/assets/bootstrap-datetimepicker/css/datetimepicker.css" />
        <link rel="stylesheet" type="text/css" href="common/assets/bootstrap-timepicker/compiled/timepicker.css">
        <link rel="stylesheet" type="text/css" href="common/assets/jquery-multi-select/css/multi-select.css" />
        <link rel="stylesheet" type="text/css" href="common/assets/select2/css/select2.min.css" />
        <link rel="stylesheet" type="text/css" href="common/css/lightbox.css" />
        <link rel="stylesheet" type="text/css" href="common/assets/bootstrap-fileupload/bootstrap-fileupload.css" />
        <link rel="stylesheet" type="text/css" href="common/assets/bootstrap-wysihtml5/bootstrap-wysihtml5.css" />
        <link rel="stylesheet" href="common/css/bootstrap-select.min.css">
        <!-- <link rel="stylesheet" href="common/css/bootstrap-select-country.min.css"> -->
        <link rel="stylesheet" href="common/extranal/toast.css">
        <link href="common/assets/DataTables/datatables.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="common/css/bootstrap-select-country.min.css"  type='text/css' media='all' >
        
        <!-- datepicker css
        <link rel="stylesheet" href="assets/libs/flatpickr/flatpickr.min.css"> -->
        <link href="common/assets/DataTables/Responsive/css/responsive.dataTables.min.css" rel="stylesheet" />
        <link href="common/assets/DataTables/Responsive/css/responsive.dataTables.css" rel="stylesheet" />
        <link href="public/assets/css/style.css" id="app-style" rel="stylesheet" type="text/css" />
    </head>
              
    <body data-layout="vertical" data-sidebar="dark" class="sidebar-enable" data-sidebar-size="lg">

        <!-- Begin page -->
        <div id="layout-wrapper">

            
            <header id="page-topbar" class="isvertical-topbar">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box">

                        <?php
                            if (!$this->ion_auth->in_group(array('superadmin'))) {
                                $this->db->where('hospital_id', $this->hospital_id);
                                $settings_title = $this->db->get('settings')->row()->title;
                                $settings_title = explode(' ', $settings_title);
                            ?>
                                      <a href="home" class="logo logo-light">
                                        <span class="logo-sm">
                                            <img src="uploads/test-removebg-preview.png" alt="" height="22">
                                        </span>
                                        <span class="logo-lg">
                                            <img src="uploads/test-removebg-preview.png" alt="" height="22"> <span class="logo-txt"> <?php echo $settings_title[0]; ?>

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
                                        </span>
                                      
                                    </a>
                                    
                            <?php } else { ?>

                                <a href="home" class="logo logo-light">
                                        <span class="logo-sm">
                                            <img src=" uploads/test-removebg-preview.png" alt="" height="22">
                                        </span>
                                        <span class="logo-lg">
                                            <img src=" uploads/test-removebg-preview.png" alt="" height="22"> <span class="logo-txt"> 
                                            Hospital System
                                        </span>
                                      
                                    </a>

                            <?php } ?>
                         
                
                        </div>

                        <button type="button" class="btn btn-sm px-3 font-size-16 header-item vertical-menu-btn">
                            <i class="fa fa-fw fa-bars"></i>
                        </button>

                        <!-- Search -->
                        <?php if ($this->ion_auth->in_group(array('admin', 'superadmin'))) { ?>
                       
                            <div class="position-relative" style="padding-left: 10px;">
                                
                                <?php if ($this->ion_auth->in_group(array('superadmin'))) {
                                                    $site_map = $this->db->where('for_login', 'superadmin')->get('site_map')->result();
                                                } else {
                                                    $site_map = $this->db->where('for_login', 'admin')->get('site_map')->result();
                                                } ?>
                                                <span class="top-menu quickFindDiv">
                                                <input type="search" id="txtQuickFind" class="form-control hidden-xs input-sm input-quick-find rounded bg-light border-0" autocomplete="off" placeholder="Quick Links" role="combobox" aria-expanded="false" aria-label="Search" aria-autocomplete="list" aria-owns="typeahead-menu">
                                                <ul class="dropdown-menu menu-position" role="listbox" aria-hidden="false" id="typeahead-menu">
                                                    <?php foreach ($site_map as $option) { ?>


                                                        <li role="option" class="site_map hide-option" id="typeahead-option-<?php echo $option->id ?>" data-name="<?php echo $option->name ?>">
                                                            <a href="<?php echo $option->url ?>" class="option-link dropdown-item">
                                                                <?php echo $option->name ?>
                                                            </a>
                                                        </li>

                              <?php } ?>
                        <ul>
                </span>
                            </div>
                        
                        <?php }else{ ?>
                            <div class="position-relative" style="padding-left: 10px;">
                            <form class="app-search d-none d-lg-block">
                            <div class="position-relative">
                                <!-- <input type="text" class="form-control" placeholder="Search...">
                                <span class="bx bx-search"></span> -->
                            </div>
                        </form>
                            </div>
                        <?php } ?>
                    </div>
                    <?php if ($this->ion_auth->in_group(array('admin', 'superadmin'))) { ?>
                        <div class="d-flex">
                            <div class="dropdown d-inline-block d-lg-none">
                                <button type="button" class="btn header-item"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="icon-sm" data-feather="search"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0">
                                    <!-- <form class="p-2"> -->
                                        <div class="search-box">
                                            <div class="position-relative"  style="padding-left: 10px;">
                                        
                                                <?php if ($this->ion_auth->in_group(array('superadmin'))) {
                                                    $site_map = $this->db->where('for_login', 'superadmin')->get('site_map')->result();
                                                } else {
                                                    $site_map = $this->db->where('for_login', 'admin')->get('site_map')->result();
                                                } ?>
                                                <span class="nav pull-right top-menu quickFindDiv">
                                                    <input type="search" id="txtQuickFind" class="form-control hidden-xs input-sm input-quick-find rounded bg-light border-0" autocomplete="off" placeholder="Go to" role="combobox" aria-expanded="false" aria-label="Search" aria-autocomplete="list" aria-owns="typeahead-menu">
                                                    <ul class="dropdown-menu menu-position" role="listbox" aria-hidden="false" id="typeahead-menu">
                                                        <?php foreach ($site_map as $option) { ?>


                                                            <li role="option" class="site_map hide-option" id="typeahead-option-<?php echo $option->id ?>" data-name="<?php echo $option->name ?>">
                                                                <a href="<?php echo $option->url ?>" class="option-link dropdown-item">
                                                                    <?php echo $option->name ?>
                                                                </a>
                                                            </li>

                                                            <?php } ?>
                                                    <ul>
                                                </span>
                                               
                                            </div>
                                        </div>
                                    <!-- </form> -->
                                </div>
                            </div>
                            <?php }else{ ?>
                            <div class="d-flex">
                             <div class="dropdown d-inline-block d-lg-none">
                                <button type="button" class="btn header-item"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="icon-sm" data-feather="search"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0">
                                    <!-- <form class="p-2"> -->
                                        <div class="search-box">
                                            <div class="position-relative"  style="padding-left: 10px;">
                                            </div>
                                        </div>
                                    <!-- </form> -->
                                </div>
                            </div>
                            
                        <?php } ?>
                        <!--  notification start -->
                        <!-- Bed Notification start -->
                    <?php if ($this->ion_auth->in_group(array('admin', 'Doctor', 'Nurse'))) { ?>
                      <?php if (in_array('bed', $this->modules)) { ?>
                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item noti-icon" id="page-header-notifications-dropdown"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="icon-sm bx bx-bed"></i>
                                <span class="noti-dot bg-danger rounded-pill"> <?php
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
                                        ?></span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                                aria-labelledby="page-header-notifications-dropdown">
                                
                                <div data-simplebar style="max-height: 250px;">
                                    
                                    <a href="" class="text-reset notification-item" style="pointer-events: none;">
                                        <div class="d-flex border-bottom align-items-start">
                                            <div class="flex-shrink-0">
                                                <div class="avatar-sm me-3">
                                                    <span class="avatar-title bg-primary rounded-circle font-size-16">
                                                        <i class="bx bx-shopping-bag"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 notifications">
                                                <h6 class="mb-1"><?php
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
                                            ?> </h6>
                                                
                                            </div>
                                        </div>
                                    </a>
                                  
                                </div>
                                <div class="p-2 border-top d-grid">
                                    <a class="btn btn-sm btn-link font-size-14 btn-block text-center" href="bed/bedAllotment">
                                        <i class="uil-arrow-circle-right me-1"></i> <span><?php
                                                                if ($available_bed > 0) {
                                                                    echo lang('add_a_allotment');
                                                                } else {
                                                                    echo lang('no_bed_is_available_for_allotment');
                                                                }
                                                                ?></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php } } ?>

                    <!-- End Bed Notification start -->
                    <!-- Payments Notification start -->
                    <?php if ($this->ion_auth->in_group(array('admin', 'Accountant'))) { ?>
                        <?php if (in_array('finance', $this->modules)) { ?>
                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item noti-icon" id="page-header-notifications-dropdown"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="icon-sm fa fa-money-check"></i>
                                <span class="noti-dot bg-danger rounded-pill">  <?php
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
                                        ?></span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                                aria-labelledby="page-header-notifications-dropdown">
                                
                                <div data-simplebar style="max-height: 250px;">
                                    
                                    <a href="" class="text-reset notification-item" style="pointer-events: none;">
                                        <div class="d-flex border-bottom align-items-start">
                                            <div class="flex-shrink-0">
                                                <div class="avatar-sm me-3">
                                                    <span class="avatar-title bg-primary rounded-circle font-size-16">
                                                        <i class="fa fa-money-check"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 notifications">
                                                <h6 class="mb-1">
                                                        <?php
                                                        echo $payment_number . ' ';
                                                        if ($payment_number <= 1) {
                                                            echo lang('payment_today');
                                                        } else {
                                                            echo lang('payments_today');
                                                        }
                                                        ?></h6>
                                                
                                            </div>
                                        </div>
                                    </a>
                                  
                                </div>
                                <div class="p-2 border-top d-grid">
                                    <a class="btn btn-sm btn-link font-size-14 btn-block text-center" href="finance/payment">
                                        <i class="uil-arrow-circle-right me-1"></i> <span> <?php echo lang('see_all_payments'); ?></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php } } ?>
                    <!-- End payments Notification start -->
                    <!-- patient Notification start -->
                    <?php if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Doctor', 'Nurse', 'Laboratorist'))) { ?>
                        <?php if (in_array('patient', $this->modules)) { ?>
                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item noti-icon" id="page-header-notifications-dropdown"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="icon-sm bx bx-user"></i>
                                <span class="noti-dot bg-danger rounded-pill">   <?php
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
                                        ?></span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                                aria-labelledby="page-header-notifications-dropdown">
                                
                                <div data-simplebar style="max-height: 250px;">
                                    
                                    <a href="" class="text-reset notification-item" style="pointer-events: none;">
                                        <div class="d-flex border-bottom align-items-start">
                                            <div class="flex-shrink-0">
                                                <div class="avatar-sm me-3">
                                                    <span class="avatar-title bg-primary rounded-circle font-size-16">
                                                        <i class="bx bx-user"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 notifications">
                                                <h6 class="mb-1">
                                                <?php
                                                            echo $patient_number . ' ';
                                                            if ($patient_number <= 1) {
                                                                echo lang('patient_registerred_today');
                                                            } else {
                                                                echo lang('patients_registerred_today');
                                                            }
                                                            ?> </h6>
                                                
                                            </div>
                                        </div>
                                    </a>
                                  
                                </div>
                                <div class="p-2 border-top d-grid">
                                    <a class="btn btn-sm btn-link font-size-14 btn-block text-center" href="patient">
                                        <i class="uil-arrow-circle-right me-1"></i> <span> <?php echo lang('see_all_patients'); ?></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php } } ?>

                     <!-- End patients Notification start -->
                    <!-- donor Notification start -->
                    <?php if ($this->ion_auth->in_group(array('admin', 'Doctor', 'Nurse', 'Laboratorist'))) { ?>
                        <?php if (in_array('donor', $this->modules)) { ?>
                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item noti-icon" id="page-header-notifications-dropdown"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="icon-sm bx bx-user-plus"></i>
                                <span class="noti-dot bg-danger rounded-pill">  <?php
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
                                        ?></span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                                aria-labelledby="page-header-notifications-dropdown">
                                
                                <div data-simplebar style="max-height: 250px;">
                                    
                                    <a href="" class="text-reset notification-item" style="pointer-events: none;">
                                        <div class="d-flex border-bottom align-items-start">
                                            <div class="flex-shrink-0">
                                                <div class="avatar-sm me-3">
                                                    <span class="avatar-title bg-primary rounded-circle font-size-16">
                                                        <i class="bx bx-user-plus"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 notifications">
                                                <h6 class="mb-1">
                                                <?php
                                                            echo $donor_number . ' ';
                                                            if ($donor_number <= 1) {
                                                                echo lang('donor_registerred_today');
                                                            } else {
                                                                echo lang('donors_registerred_today');
                                                            }
                                                            ?> </h6>
                                                
                                            </div>
                                        </div>
                                    </a>
                                  
                                </div>
                                <div class="p-2 border-top d-grid">
                                    <a class="btn btn-sm btn-link font-size-14 btn-block text-center" href="donor">
                                        <i class="uil-arrow-circle-right me-1"></i> <span> <?php echo lang('see_all_donors'); ?></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php } } ?>

                     <!-- End donor Notification start -->
                    <!-- medicine Notification start -->
                    <?php if ($this->ion_auth->in_group(array('admin', 'Pharmacist', 'Doctor'))) { ?>
                        <?php if (in_array('medicine', $this->modules)) { ?>
                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item noti-icon" id="page-header-notifications-dropdown"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="icon-sm mdi mdi-medical-bag"></i>
                                <span class="noti-dot bg-danger rounded-pill">   <?php
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
                                        ?></span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                                aria-labelledby="page-header-notifications-dropdown">
                                
                                <div data-simplebar style="max-height: 250px;">
                                    
                                    <a href="" class="text-reset notification-item" style="pointer-events: none;">
                                        <div class="d-flex border-bottom align-items-start">
                                            <div class="flex-shrink-0">
                                                <div class="avatar-sm me-3">
                                                    <span class="avatar-title bg-primary rounded-circle font-size-16">
                                                        <i class="mdi mdi-medical-bag"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 notifications">
                                                <h6 class="mb-1">
                                                <?php
                                                            echo $medicine_number . ' ';
                                                            if ($medicine_number <= 1) {
                                                                echo lang('medicine_registerred_today');
                                                            } else {
                                                                echo lang('medicines_registered_today');
                                                            }
                                                            ?> </h6>
                                                
                                            </div>
                                        </div>
                                    </a>
                                  
                                </div>
                                <div class="p-2 border-top d-grid">
                                    <a class="btn btn-sm btn-link font-size-14 btn-block text-center" href="medicine">
                                        <i class="uil-arrow-circle-right me-1"></i> <span> <?php echo lang('see_all_medicines'); ?></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php } } ?>
                     <!-- End medicine Notification start -->
                    <!-- report Notification start -->
                    <?php if ($this->ion_auth->in_group(array('admin', 'Pharmacist', 'Doctor'))) { ?>
                        <?php if (in_array('medicine', $this->modules)) { ?>
                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item noti-icon" id="page-header-notifications-dropdown"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="icon-sm fa fa-notes-medical"></i>
                                <span class="noti-dot bg-danger rounded-pill">  <?php
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
                                        ?></span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                                aria-labelledby="page-header-notifications-dropdown">
                                
                                <div data-simplebar style="max-height: 250px;">
                                    
                                    <a href="" class="text-reset notification-item" style="pointer-events: none;">
                                        <div class="d-flex border-bottom align-items-start">
                                            <div class="flex-shrink-0">
                                                <div class="avatar-sm me-3">
                                                    <span class="avatar-title bg-primary rounded-circle font-size-16">
                                                        <i class="fa fa-notes-medical"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 notifications">
                                                <h6 class="mb-1">
                                                <?php
                                                            echo $report_number . ' ';
                                                            if ($report_number <= 1) {
                                                                echo lang('report_added_today');
                                                            } else {
                                                                echo lang('reports_added_today');
                                                            }
                                                            ?> </h6>
                                                
                                            </div>
                                        </div>
                                    </a>
                                  
                                </div>
                                <div class="p-2 border-top d-grid">
                                    <a class="btn btn-sm btn-link font-size-14 btn-block text-center" href="report">
                                        <i class="uil-arrow-circle-right me-1"></i> <span> <?php echo lang('see_all_reports'); ?></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php } } ?>

                      <!-- End report Notification start -->
                    <!-- patient report Notification start -->
                    <?php if ($this->ion_auth->in_group('Patient')) { ?>
                        <?php if (in_array('report', $this->modules)) { ?>
                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item noti-icon" id="page-header-notifications-dropdown"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="icon-sm fa fa-notes-medical"></i>
                                <span class="noti-dot bg-danger rounded-pill">  <?php
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
                                        ?></span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                                aria-labelledby="page-header-notifications-dropdown">
                                
                                <div data-simplebar style="max-height: 250px;">
                                    
                                    <a href="" class="text-reset notification-item" style="pointer-events: none;">
                                        <div class="d-flex border-bottom align-items-start">
                                            <div class="flex-shrink-0">
                                                <div class="avatar-sm me-3">
                                                    <span class="avatar-title bg-primary rounded-circle font-size-16">
                                                        <i class="fa fa-notes-medical"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 notifications">
                                                <h6 class="mb-1">
                                                <?php
                                                            echo $report_number . ' ';
                                                            if ($report_number <= 1) {
                                                                echo lang('report_is_available_for_you');
                                                            } else {
                                                                echo lang('reports_are_available_for_you');
                                                            }
                                                            ?> </h6>
                                                
                                            </div>
                                        </div>
                                    </a>
                                  
                                </div>
                                <div class="p-2 border-top d-grid">
                                    <a class="btn btn-sm btn-link font-size-14 btn-block text-center" href="report/myreports">
                                        <i class="uil-arrow-circle-right me-1"></i> <span> <?php echo lang('see_your_reports'); ?></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php } } ?>
                    <!-- <?php// if ($this->ion_auth->in_group(array('superadmin','admin'))) { ?> -->

                    <div class="dropdown d-none d-sm-inline-block">
                            <button type="button" class="btn header-item light-dark" id="mode-setting-btn">
                                <i data-feather="moon" class="icon-sm layout-mode-dark"></i>
                                <i data-feather="sun" class="icon-sm layout-mode-light"></i>
                            </button>
                        </div>
                        <!-- <?php// } ?> -->
                      <!-- End patient report Notification start -->
                    <!-- Notification End -->
                    
                    

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
                                $img_url = 'public/assets/images/users/profile.png';
                            }

                            if (empty($img_url)) {
                                $img_url = 'public/assets/images/users/profile.png';
                            }

                            ?>
                       
                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item user text-start d-flex align-items-center" id="page-header-user-dropdown"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="rounded-circle header-profile-user" src="<?php echo $img_url; ?>"
                                alt="Header Avatar">
                            </button>
                            <div class="dropdown-menu dropdown-menu-end pt-0">
                                <?php if (!$this->ion_auth->in_group('admin')) { ?>
                                    <a class="dropdown-item" href=""><i class='bx bx-tachometer text-muted font-size-18 align-middle me-1'></i> <span class="align-middle"><?php echo lang('dashboard'); ?></span></a>
                                <?php } ?>

                                
                                <a class="dropdown-item" href="profile"><i class='bx bx-user-circle text-muted font-size-18 align-middle me-1'></i> <span class="align-middle"><?php echo lang('profile'); ?></span></a>
                                <?php if ($this->ion_auth->in_group('admin')) { ?>
                                    <a class="dropdown-item" href="settings"><i class='bx bx-cog text-muted font-size-18 align-middle me-1'></i> <span class="align-middle"><?php echo lang('settings'); ?></span></a>
                                    
                                <?php } ?>

                                <a class="dropdown-item"><i class='bx bx-user text-muted font-size-18 align-middle me-1'></i> <span class="align-middle"><?php echo $this->ion_auth->get_users_groups()->row()->name ?></span></a>
                               
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="auth/logout"><i class='bx bx-log-out text-muted font-size-18 align-middle me-1'></i> <span class="align-middle"><?php echo lang('log_out'); ?></span></a>
                            </div>
                        </div>
                        <?php
                            $message = $this->session->flashdata('feedback');
                            if (!empty($message)) {
                            ?>
                                <!-- <code class="flashmessage pull-right"> <?php echo $message; ?></code> -->
                            <?php } ?>
                    </div>
                </div>
            </header>
            <!-- ========== Left Sidebar Start ========== -->
            <div class="vertical-menu">

                <!-- LOGO -->
                <div class="navbar-brand-box">
                <?php
                            if (!$this->ion_auth->in_group(array('superadmin'))) {
                                $this->db->where('hospital_id', $this->hospital_id);
                                $settings_title = $this->db->get('settings')->row()->title;
                                $settings_title = explode(' ', $settings_title);
                            ?>
                                      <a href="home" class="logo logo-light">
                                        <span class="logo-sm">
                                            <img src="uploads/test-removebg-preview.png" alt="" height="22">
                                        </span>
                                        <span class="logo-lg">
                                            <img src="uploads/test-removebg-preview.png" alt="" height="22"> <span class="logo-txt"> <?php echo $settings_title[0]; ?>

                                            <?php
                                            if (!empty($settings_title[1])) {
                                                echo $settings_title[1];
                                            }
                                            ?>

                                            <!-- <?php
                                            // if (!empty($settings_title[2])) {
                                            //     echo $settings_title[2];
                                            // }
                                            ?> -->
                                        </span>
                                      
                                    </a>
                                    
                            <?php } else { ?>

                                <a href="home" class="logo logo-light">
                                        <span class="logo-sm">
                                            <img src="uploads/test-removebg-preview.png" alt="" height="22">
                                        </span>
                                        <span class="logo-lg">
                                            <img src="uploads/test-removebg-preview.png" alt="" height="22"> <span class="logo-txt"> 
                                            Klinicx 
                                        </span>
                                      
                                    </a>

                            <?php } ?>
                </div>

                <button type="button" class="btn btn-sm px-3 font-size-16 header-item vertical-menu-btn">
                    <i class="fa fa-fw fa-bars"></i>
                </button>

                <div data-simplebar class="sidebar-menu-scroll">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu list-unstyled" id="side-menu">
                            <li class="menu-title" data-key="t-menu">Menu</li>

                            <li class="sub-menu" data-menu="dashboard">
                                <a href="home">
                                    <i class="bx bx-tachometer icon nav-icon"></i>
                                    <span class="menu-item" data-key="t-dashboards"><?php echo lang('dashboard'); ?></span>
                                    
                                </a>
                            </li>

                            <li class="menu-title" data-key="t-applications">Applications</li>
                            
                            <?php if ($this->ion_auth->in_group('admin')) { ?>
                                 <?php if (in_array('department', $this->modules)) { ?>
                                    <li class="sub-menu" data-menu="department">
                                        <a href="department">
                                            <i class="fa fa-sitemap icon nav-icon"></i>
                                            <span class="menu-item" data-key="t-calendar"><?php echo lang('departments'); ?></span>
                                        </a>
                                    </li>


                            <?php } } ?>
                         

                            <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                <?php if (in_array('doctor', $this->modules)) { ?>
                                    <li>
                                        <a href="javascript: void(0);" class="has-arrow">
                                            <i class="mdi mdi-doctor icon nav-icon"></i>
                                            <span class="menu-item" data-key="t-email"><?php echo lang('doctor'); ?></span>
                                        </a>
                                        <ul class="sub-menu" data-menu="doctor" aria-expanded="false">
                                            <li><a href="doctor" data-key="t-inbox"><?php echo lang('list_of_doctors'); ?></a></li>
                                            <li><a href="appointment/treatmentReport" data-key="t-read-email"><?php echo lang('treatment_history'); ?></a></li>
                                            <li><a href="doctorvisit" data-key="t-read-email"><?php echo lang('doctor_visit'); ?></a></li>
                                        </ul>
                                    </li>
                                <?php } ?>
                             <?php } ?>

                             <?php if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Nurse', 'Doctor', 'Laboratorist', 'Receptionist'))) { ?>
                                <?php if (in_array('patient', $this->modules)) { ?>
                                    <li>
                                        <a href="javascript: void(0);" class="has-arrow">
                                            <i class="fa fa-users-medical icon nav-icon"></i>
                                            <span class="menu-item" data-key="t-email"><?php echo lang('patient'); ?></span>
                                        </a>
                                        <ul class="sub-menu" data-menu="patient" aria-expanded="false">
                                            <li><a href="patient" data-key="t-inbox"><?php echo lang('patient_list'); ?></a></li>
                                            <?php if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Doctor', 'Receptionist'))) { ?>
                                                <li><a href="patient/patientPayments" data-key="t-read-email"><?php echo lang('payments'); ?></a></li>

                                            <?php } ?>
                                            <?php if (!$this->ion_auth->in_group(array('Accountant', 'Receptionist'))) { ?>
                                                <li><a href="patient/caseList" data-key="t-read-email"><?php echo lang('case'); ?> <?php echo lang('manager'); ?></a></li>
                                                <li><a href="patient/documents" data-key="t-read-email"><?php echo lang('documents'); ?></a></li>
                                            <?php } ?>
                                        </ul>
                                    </li>
                                <?php } ?>
                             <?php } ?>

                             <?php if ($this->ion_auth->in_group(array('admin', 'Nurse', 'Receptionist'))) { ?>
                                <?php if (in_array('appointment', $this->modules)) { ?>
                                    <li>
                                        <a href="javascript: void(0);" class="has-arrow">
                                            <i class="fa fa-clock icon nav-icon"></i>
                                            <span class="menu-item" data-key="t-email"><?php echo lang('schedule'); ?></span>
                                        </a>
                                        <ul class="sub-menu" data-menu="schedule" aria-expanded="false">
                                            <li><a href="schedule" data-key="t-inbox"><?php echo lang('all'); ?> <?php echo lang('schedule'); ?></a></li>
                                            <li><a href="schedule/allHolidays" data-key="t-read-email"><?php echo lang('holidays'); ?></a></li>
                                        </ul>
                                    </li>
                                <?php } ?>
                             <?php } ?>

                             <?php if ($this->ion_auth->in_group(array('Doctor'))) { ?>
                                <?php if (in_array('appointment', $this->modules)) { ?>
                                    <li>
                                        <a href="javascript: void(0);" class="has-arrow">
                                            <i class="fa fa-clock icon nav-icon"></i>
                                            <span class="menu-item" data-key="t-email"><?php echo lang('schedule'); ?></span>
                                        </a>
                                        <ul class="sub-menu" data-menu="scheduled" aria-expanded="false">
                                            <li><a href="schedule/timeSchedule" data-key="t-inbox"><?php echo lang('all'); ?> <?php echo lang('schedule'); ?></a></li>
                                            <li><a href="schedule/holidays" data-key="t-read-email"><?php echo lang('holidays'); ?></a></li>
                                        </ul>
                                    </li>
                                <?php } ?>
                             <?php } ?>

                             <?php if ($this->ion_auth->in_group(array('admin', 'Doctor', 'Nurse', 'Receptionist'))) { ?>
                                <?php if (in_array('appointment', $this->modules)) { ?>
                                    <li>
                                        <a href="javascript: void(0);" class="has-arrow">
                                            <i class="mdi mdi-calendar-cursor icon nav-icon"></i>
                                            <span class="menu-item" data-key="t-email"><?php echo lang('appointment'); ?></span>
                                        </a>
                                        <ul class="sub-menu" data-menu="appointment" aria-expanded="false">
                                            <li><a href="appointment" data-key="t-inbox"><?php echo lang('all'); ?></a></li>
                                            <li><a href="appointment/addNewView" data-key="t-read-email"><?php echo lang('add'); ?></a></li>
                                            <li><a href="appointment/todays" data-key="t-inbox"><?php echo lang('todays'); ?></a></li>
                                            <li><a href="appointment/upcoming" data-key="t-read-email"><?php echo lang('upcoming'); ?></a></li>
                                            <li><a href="appointment/calendar" data-key="t-inbox"><?php echo lang('calendar'); ?></a></li>
                                            <li><a href="appointment/request" data-key="t-read-email"><?php echo lang('request'); ?></a></li>
                                        </ul>
                                    </li>
                                <?php } ?>
                             <?php } ?>

                             <?php if ($this->ion_auth->in_group(array('Patient'))) { ?>
                                <?php if (in_array('appointment', $this->modules)) { ?>
                                    <li class="sub-menu" data-menu="pappointment">
                                        <a href="appointment/myTodays">
                                            <i class="fa fa-headphones icon nav-icon"></i>
                                            <span class="menu-item" data-key="t-calendar"><?php echo lang('todays'); ?> <?php echo lang('appointment'); ?></span>
                                        </a>
                                    </li>


                            <?php } 
                                if (in_array('notice', $this->modules)) { ?>

                                        <li class="sub-menu" data-menu="pnotice">
                                            <a href="notice">
                                                <i class="bx bx-notification icon nav-icon"></i>
                                                <span class="menu-item" data-key="t-calendar"><?php echo lang('notice'); ?></span>
                                            </a>
                                        </li>
                                
                                <?php } } ?>

                           

                            <?php if ($this->ion_auth->in_group('admin')) { ?>
                               
                               <li>
                                   <a href="javascript: void(0);" class="has-arrow">
                                       <i class="fa fa-users icon nav-icon"></i>
                                       <span class="menu-item" data-key="t-email"><?php echo lang('human_resources'); ?></span>
                                   </a>
                                   <ul class="sub-menu" data-menu="human" aria-expanded="false">
                                   <?php if (in_array('nurse', $this->modules)) { ?>
                                       <li><a href="nurse" data-key="t-inbox"><?php echo lang('nurse'); ?></a></li>
                                   <?php } ?>
                                   <?php if (in_array('pharmacist', $this->modules)) { ?>    
                                       <li><a href="pharmacist" data-key="t-read-email"><?php echo lang('pharmacist'); ?></a></li>
                                   <?php } ?>
                                   <?php if (in_array('laboratorist', $this->modules)) { ?>  
                                       <li><a href="laboratorist" data-key="t-inbox"><?php echo lang('laboratorist'); ?></a></li>
                                       <?php } ?>
                                   <?php if (in_array('accountant', $this->modules)) { ?> 
                                       <li><a href="accountant" data-key="t-read-email"><?php echo lang('accountant'); ?></a></li>
                                   <?php } ?>  
                                   <?php if (in_array('receptionist', $this->modules)) { ?> 
                                       <li><a href="receptionist" data-key="t-read-email"><?php echo lang('receptionist'); ?></a></li>
                                   <?php } ?>  
                                       
                                   </ul>
                               </li>
                          
                        <?php } ?>
                        <?php if ($this->ion_auth->in_group(array('Accountant', 'Receptionist', 'Nurse', 'Laboratorist', 'Pharmacist', 'Doctor'))) { ?>
                                
                              <?php   if (in_array('attendance', $this->modules)) { ?>

                                        <li class="sub-menu" data-menu="attendance">
                                            <a href="attendance">
                                                <i class="fa fa-bell-slash icon nav-icon"></i>
                                                <span class="menu-item" data-key="t-calendar"><?php echo lang('attendance'); ?></span>
                                            </a>
                                        </li>

                             <?php } ?>
                             <?php   if (in_array('leave', $this->modules)) { ?>

                                <li class="sub-menu" data-menu="rleave">
                                    <a href="leave">
                                        <i class="fa fa-bell-slash icon nav-icon"></i>
                                        <span class="menu-item" data-key="t-calendar"><?php echo lang('leave'); ?></span>
                                    </a>
                                </li>

                            <?php } ?>
                            <?php   if (in_array('payroll', $this->modules)) { ?>

                                    <li class="sub-menu" data-menu="rpayroll">
                                        <a href="payroll/employeePayroll">
                                            <i class="fa fa-money-check icon nav-icon"></i>
                                            <span class="menu-item" data-key="t-calendar"><?php echo lang('payroll'); ?></span>
                                        </a>
                                    </li>

                                    <?php } ?>
                                    <?php   if (in_array('notice', $this->modules)) { ?>

                                    <li class="sub-menu" data-menu="rnotice">
                                        <a href="notice">
                                            <i class="fa fa-bell icon nav-icon"></i>
                                            <span class="menu-item" data-key="t-calendar"><?php echo lang('notice'); ?></span>
                                        </a>
                                    </li>

                                    <?php } ?>
                               
                             <?php } ?> 
                             
                             <?php if ($this->ion_auth->in_group('admin')) { ?>
                                  <?php if (in_array('finance', $this->modules)) { ?>
                                    <li>
                                        <a href="javascript: void(0);" class="has-arrow">
                                            <i class="fa fa-money-check icon nav-icon"></i>
                                            <span class="menu-item" data-key="t-email"><?php echo lang('financial_activities'); ?></span>
                                        </a>
                                        <ul class="sub-menu" data-menu="finance" aria-expanded="false">
                                            <li><a href="finance/addPaymentView" data-key="t-inbox"><?php echo lang('add_payment'); ?></a></li>
                                            <li><a href="finance/payment" data-key="t-read-email"><?php echo lang('payments'); ?></a></li>
                                            <li><a href="finance/draftPayment" data-key="t-inbox"><?php echo lang('draft_payments'); ?></a></li>
                                            <li><a href="finance/dueCollection" data-key="t-read-email"><?php echo lang('due_collection'); ?></a></li>
                                            <li><a href="finance/paymentCategory" data-key="t-inbox"><?php echo lang('payment_procedures'); ?></a></li>
                                            <li><a href="finance/category" data-key="t-read-email"><?php echo lang('payment_categories'); ?></a></li>
                                            <li><a href="finance/expense" data-key="t-read-email"><?php echo lang('expense'); ?></a></li>
                                            <li><a href="finance/addExpenseView" data-key="t-read-email"><?php echo lang('add_expense'); ?></a></li>
                                            <li><a href="finance/expenseCategory" data-key="t-read-email"><?php echo lang('expense_categories'); ?></a></li>

                                        </ul>
                                    </li>
                                <?php } ?>
                             <?php } ?>

                             <?php if ($this->ion_auth->in_group('Receptionist')) { ?>
                                <?php if (in_array('appointment', $this->modules)) { ?>
                                    <li class="sub-menu" data-menu="calender">
                                        <a href="appointment/calendar">
                                            <i class="fa fa-calendar icon nav-icon"></i>
                                            <span class="menu-item" data-key="t-calendar"> <?php echo lang('calendar'); ?> </span>
                                        </a>
                                    </li>
                                <?php } ?>
                                <?php if (in_array('finance', $this->modules)) { ?>
                                    <li>
                                        <a href="javascript: void(0);" class="has-arrow">
                                            <i class="fa fa-money-check icon nav-icon"></i>
                                            <span class="menu-item" data-key="t-email"><?php echo lang('financial_activities'); ?></span>
                                        </a>
                                        <ul class="sub-menu" data-menu="financer" aria-expanded="false">
                                            <li><a href="finance/payment" data-key="t-read-email"><?php echo lang('payments'); ?></a></li>
                                            <li><a href="finance/addPaymentView" data-key="t-inbox"><?php echo lang('add_payment'); ?></a></li>
                                            
                                            <li><a href="finance/dueCollection" data-key="t-read-email"><?php echo lang('due_collection'); ?></a></li>
                                           

                                        </ul>
                                    </li>
                                <?php } ?>
                            <?php } ?>

                            <?php if ($this->ion_auth->in_group(array('admin', 'Pharmacist'))) { ?>
                                <?php if (in_array('prescription', $this->modules)) { ?>
                                    <li class="sub-menu" data-menu="prescribtion">
                                        <a href="prescription/all">
                                            <i class="fas fa-prescription icon nav-icon"></i>
                                            <span class="menu-item" data-key="t-calendar"> <?php echo lang('prescription'); ?> </span>
                                        </a>
                                    </li>
                                <?php } ?>
                            <?php } ?>
                           <?php if ($this->ion_auth->in_group(array('Receptionist'))) {
                            ?>
                                <?php if (in_array('lab', $this->modules)) { ?>
                                    <li class="sub-menu" data-menu="labreport">
                                        <a href="lab/lab1">
                                            <i class="fas fa-file-medical icon nav-icon"></i>
                                            <span class="menu-item" data-key="t-calendar"><?php echo lang('lab_reports'); ?></span>
                                        </a>
                                    </li>
                                <?php } ?>
                            <?php
                            }
                            ?>

        
                            <?php if ($this->ion_auth->in_group(array('Accountant', 'Receptionist'))) { ?>
                            
                                <?php if (in_array('finance', $this->modules)) { ?>
                                    <li class="sub-menu" data-menu="userreport">
                                        <a href="finance/UserActivityReport">
                                            <i class="fa fa-file-user icon nav-icon"></i>
                                            <span class="menu-item" data-key="t-calendar"><?php echo lang('user_activity_report'); ?></span>
                                        </a>
                                    </li>
                                <?php } ?>
                            
                            <?php } ?>
                           


                            <?php if ($this->ion_auth->in_group(array('Doctor'))) { ?>
                                <?php if (in_array('prescription', $this->modules)) { ?>
                                    <li class="sub-menu" data-menu="dprescription">
                                        <a href="prescription">
                                            <i class="fa fa-prescription icon nav-icon"></i>
                                            <span class="menu-item" data-key="t-calendar"><?php echo lang('prescription'); ?></span>
                                        </a>
                                    </li>
                                <?php } ?>
                            <?php } ?>
                            <?php if ($this->ion_auth->in_group(array('admin', 'Doctor', 'Laboratorist'))) { ?>
                                <?php if (in_array('lab', $this->modules)) { ?>
                                    <li>
                                        <a href="javascript: void(0);" class="has-arrow">
                                            <i class="fa fa-flask icon nav-icon"></i>
                                            <span class="menu-item" data-key="t-email"><?php echo lang('labs'); ?></span>
                                        </a>
                                        <ul class="sub-menu" data-menu="labd" data-menu="lab" aria-expanded="false">
                                            <li><a href="lab/testStatus" data-key="t-inbox"><?php echo lang('lab_tests'); ?></a></li>
                                            <li><a href="lab" data-key="t-read-email"><?php echo lang('lab_reports'); ?></a></li>
                                            <li><a href="lab/reportDelivery" data-key="t-inbox"><?php echo lang('report') . " " . lang('delivery'); ?></a></li>
                                            <li><a href="lab/template" data-key="t-read-email"><?php echo lang('template'); ?></a></li>
                                            <li><a href="macro" data-key="t-inbox"><?php echo lang('macro'); ?></a></li>
                                          

                                        </ul>
                                    </li>
                                <?php } ?>
                             <?php } ?>
                             <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                <?php if (in_array('lab', $this->modules)) { ?>
                                    <li>
                                        <a href="javascript: void(0);" class="has-arrow">
                                            <i class="fas fa-procedures icon nav-icon"></i>
                                            <span class="menu-item" data-key="t-email"><?php echo lang('bed_and_admission'); ?></span>
                                        </a>
                                        <ul class="sub-menu" data-menu="bed" aria-expanded="false">
                                            <li><a href="bed/bedAllotment" data-key="t-inbox"><?php echo lang('all_admissions'); ?></a></li>
                                            <li><a href="bed/addAllotmentView" data-key="t-read-email"><?php echo lang('add_admission'); ?></a></li>
                                            <li><a href="bed" data-key="t-inbox"><?php echo lang('bed_list'); ?></a></li>
                                            <li><a href="bed/addBedView" data-key="t-read-email"><?php echo lang('add_bed'); ?></a></li>
                                            <li><a href="bed/bedCategory" data-key="t-inbox"><?php echo lang('bed_category'); ?></a></li>
                                            <li><a href="pservice" data-key="t-inbox"><?php echo lang('patient'); ?> <?php echo lang('service'); ?></a></li>

                                          

                                        </ul>
                                    </li>
                                <?php } ?>
                             <?php } ?>
                             <?php if ($this->ion_auth->in_group(array('admin', 'Pharmacist'))) { ?>
                                 <?php if (in_array('pharmacy', $this->modules)) { ?>
                                    <li>
                                        <a href="javascript: void(0);" class="has-arrow">
                                            <i class="fas fa-capsules icon nav-icon"></i>
                                            <span class="menu-item" data-key="t-multi-level"><?php echo lang('pharmacy'); ?></span>
                                        </a>
                                        <ul class="sub-menu" data-menu="pharmacy" aria-expanded="true">
                                        <?php if (!$this->ion_auth->in_group(array('Pharmacist'))) { ?>
                                            <li><a href="finance/pharmacy/home" data-key="t-level-1.1"><?php echo lang('dashboard'); ?></a></li>
                                        <?php } ?>
                                        <li><a href="finance/pharmacy/payment" data-key="t-level-1.1"><?php echo lang('sales'); ?></a></li>
                                        <li><a href="finance/pharmacy/addPaymentView" data-key="t-level-1.1"><?php echo lang('add_new_sale'); ?></a></li>
                                        <li><a href="finance/pharmacy/expense" data-key="t-level-1.1"><?php echo lang('expense'); ?></a></li>
                                        <li><a href="finance/pharmacy/addExpenseView" data-key="t-level-1.1"><?php echo lang('add_expense'); ?></a></li>
                                        <li><a href="finance/pharmacy/expenseCategory" data-key="t-level-1.1"><?php echo lang('expense_categories'); ?></a></li>

                                            <li><a href="javascript: void(0);" class="has-arrow" data-key="t-level-1.2"><?php echo lang('report'); ?></a>
                                                <ul class="sub-menu" data-menu="freport" aria-expanded="true">
                                                    <li><a href="finance/pharmacy/financialReport"><?php echo lang('pharmacy'); ?> <?php echo lang('report'); ?> </a></li>
                                                    <li><a href="finance/pharmacy/monthly"><?php echo lang('monthly_sales'); ?> </a></li>
                                                    <li><a href="finance/pharmacy/daily"><?php echo lang('daily_sales'); ?> </a></li>
                                                    <li><a href="finance/pharmacy/monthlyExpense"><?php echo lang('monthly_expense'); ?> </a></li>
                                                    <li><a href="finance/pharmacy/dailyExpense"><?php echo lang('daily_expense'); ?> </a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>

                                 <?php } ?>
                             <?php } ?>
                             <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                <?php if (in_array('medicine', $this->modules)) { ?>
                                    <li>
                                        <a href="javascript: void(0);" class="has-arrow">
                                            <i class="fa fa-medkit icon nav-icon"></i>
                                            <span class="menu-item" data-key="t-email"><?php echo lang('medicine'); ?></span>
                                        </a>
                                        <ul class="sub-menu" data-menu="medicine" aria-expanded="false">
                                            <li><a href="medicine" data-key="t-inbox"><?php echo lang('medicine_list'); ?></a></li>
                                            <li><a href="medicine/addMedicineView" data-key="t-read-email"><?php echo lang('add_medicine'); ?></a></li>
                                            <li><a href="medicine/medicineCategory" data-key="t-inbox"><?php echo lang('medicine_category'); ?></a></li>
                                            <li><a href="medicine/addCategoryView" data-key="t-read-email"><?php echo lang('add_medicine_category'); ?></a></li>
                                            <li><a href="medicine/medicineStockAlert" data-key="t-inbox"><?php echo lang('medicine_stock_alert'); ?></a></li>

                                          

                                        </ul>
                                    </li>
                                <?php } ?>
                             <?php } ?>

                             <?php if ($this->ion_auth->in_group(array('admin', 'Laboratorist'))) { ?>
                                <?php if (in_array('donor', $this->modules)) { ?>
                                    <li>
                                        <a href="javascript: void(0);" class="has-arrow">
                                            <i class="fa fa-hand-holding-water icon nav-icon"></i>
                                            <span class="menu-item" data-key="t-email"><?php echo lang('donor'); ?></span>
                                        </a>
                                        <ul class="sub-menu" data-menu="donor" aria-expanded="false">
                                            <li><a href="donor" data-key="t-inbox"><?php echo lang('donor_list'); ?></a></li>
                                            <li><a href="donor/addDonorView" data-key="t-read-email"><?php echo lang('add_donor'); ?></a></li>
                                            <li><a href="donor/bloodBank" data-key="t-inbox"><?php echo lang('blood_bank'); ?></a></li>
                                            

                                          

                                        </ul>
                                    </li>
                                <?php } ?>
                             <?php } ?>
                             <?php if ($this->ion_auth->in_group(array('admin', 'Nurse', 'Accountant', 'Pharmacist', 'Doctor', 'Laboratorist', 'Receptionist'))) { ?>

                                 <li class="menu-title" data-key="t-applications">File & Report</li>
                            <?php } ?>
                             <?php if ($this->ion_auth->in_group(array('admin', 'Nurse', 'Accountant', 'Pharmacist', 'Doctor', 'Laboratorist', 'Receptionist'))) { ?>
                                <?php if (in_array('file', $this->modules)) { ?>
                                    <li>
                                        <a href="javascript: void(0);" class="has-arrow">
                                            <i class="fa fa-clock icon nav-icon"></i>
                                            <span class="menu-item" data-key="t-email"><?php echo lang('file_manager'); ?></span>
                                        </a>
                                        <ul class="sub-menu" data-menu="file" aria-expanded="false">
                                            <li><a href="file"><?php echo lang('all'); ?> <?php echo lang('file'); ?></a></li>
                                            <li><a href="file/addNewView"><?php echo lang('add_file'); ?></a></li>
                                        
                                        </ul>
                                    </li>
                                <?php } ?>
                             <?php } ?>
                             <?php if ($this->ion_auth->in_group(array('admin', 'Nurse', 'Laboratorist', 'Doctor'))) { ?>
                                <li>
                                        <a href="javascript: void(0);" class="has-arrow">
                                            <i class="fas fa-file-medical-alt icon nav-icon"></i>
                                            <span class="menu-item" data-key="t-email"><?php echo lang('report'); ?></span>
                                        </a>
                                        <ul class="sub-menu" data-menu="report" aria-expanded="false">
                                <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                    <?php if (in_array('finance', $this->modules)) { ?>
                                        <li><a href="finance/financialReport"><?php echo lang('financial_report'); ?></a></li>
                                        <li> <a href="finance/AllUserActivityReport"><?php echo lang('user_activity_report'); ?></a></li>
                                    <?php } ?>
                                <?php } ?>
                                <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                    <?php if (in_array('finance', $this->modules)) { ?>
                                        <li><a href="finance/doctorsCommission"><?php echo lang('doctors_commission'); ?> </a></li>
                                        <li><a href="finance/monthly"><?php echo lang('monthly_sales'); ?> </a></li>
                                        <li><a href="finance/daily"><?php echo lang('daily_sales'); ?> </a></li>
                                        <li><a href="finance/monthlyExpense"><?php echo lang('monthly_expense'); ?> </a></li>
                                        <li><a href="finance/dailyExpense"><?php echo lang('daily_expense'); ?> </a></li>
                                        <li><a href="finance/expenseVsIncome"><?php echo lang('expense_vs_income'); ?> </a></li>
                                    <?php } ?>
                                <?php } ?>
                                <?php if (in_array('report', $this->modules)) { ?>
                                    <li><a href="report/birth"><?php echo lang('birth_report'); ?></a></li>
                                    <li><a href="report/operation"><?php echo lang('operation_report'); ?></a></li>
                                    <li><a href="report/expire"><?php echo lang('expire_report'); ?></a></li>
                                <?php } ?>
                                        
                                        </ul>
                                    </li>
                             <?php } ?>
                             <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                <?php if (in_array('notice', $this->modules)) { ?>
                                    <li>
                                        <a href="javascript: void(0);" class="has-arrow">
                                            <i class="bx bx-notification icon nav-icon"></i>
                                            <span class="menu-item" data-key="t-email"><?php echo lang('notice'); ?></span>
                                        </a>
                                        <ul class="sub-menu" data-menu="notice" aria-expanded="false">
                                             <li><a href="notice"><?php echo lang('notice'); ?></a></li>
                                            <li><a href="notice/addNewView"><?php echo lang('add_new'); ?></a></li>
                                        
                                        </ul>
                                    </li>
                                <?php } ?>
                             <?php } ?>

                             <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                 <li class="menu-title" data-key="t-applications">E-mail & SMS</li>
                             <?php } ?>

                              <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                <?php if (in_array('email', $this->modules)) { ?>
                                    <li>
                                        <a href="javascript: void(0);" class="has-arrow">
                                            <i class="fa fa-mail-bulk icon nav-icon"></i>
                                            <span class="menu-item" data-key="t-email"><?php echo lang('email'); ?></span>
                                        </a>
                                        <ul class="sub-menu" data-menu="email" aria-expanded="false">
                                            <li><a href="email/autoEmailTemplate"><?php echo lang('autoemailtemplate'); ?></a></li>
                                            <li><a href="email/sendView"><?php echo lang('new'); ?></a></li>
                                            <li><a href="email/sent"><?php echo lang('sent'); ?></a></li>
                                            <?php if ($this->ion_auth->in_group(array('admin'))) {
                                                $mail_setting = $this->email_model->getHospitalEmailSettings();
                                                foreach ($mail_setting as $email_set) {
                                                    if ($email_set->type == 'Smtp') {
                                                        $email_id = $email_set->id;
                                            }
                                        }
                                    ?>
                                            <li><a href="email/settings?id=<?php echo $email_id; ?>"><?php echo lang('settings'); ?></a></li>
                                            <?php } ?>
                                        </ul>
                                    </li>
                                <?php } ?>
                             <?php } ?>
                             <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                <?php if (in_array('sms', $this->modules)) { ?>
                                    <li>
                                        <a href="javascript: void(0);" class="has-arrow">
                                            <i class="fa fa-sms icon nav-icon"></i>
                                            <span class="menu-item" data-key="t-email"><?php echo lang('sms'); ?></span>
                                        </a>
                                        <ul class="sub-menu" data-menu="sms" aria-expanded="false">
                                            <li><a href="sms/autoSMSTemplate"><?php echo lang('autosmstemplate'); ?></a></li>
                                            <li><a href="sms/sendView"><?php echo lang('write_message'); ?></a></li>
                                            <li><a href="sms/sent"><?php echo lang('sent_messages'); ?></a></li>
                                            <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                                <li><a href="sms"><?php echo lang('sms_settings'); ?></a></li>
                                            <?php } ?>
                                        </ul>
                                    </li>
                                <?php } ?>
                             <?php } ?>
                             <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                <li class="menu-title" data-key="t-applications">Management</li>
                             <?php } ?>

                             <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                <?php if (in_array('payroll', $this->modules)) { ?>
                                    <li>
                                        <a href="javascript: void(0);" class="has-arrow">
                                            <i class="fa fa-money-check icon nav-icon"></i>
                                            <span class="menu-item" data-key="t-email"><?php echo lang('payroll'); ?></span>
                                        </a>
                                        <ul class="sub-menu" data-menu="payroll" aria-expanded="false">
                                            <?php if (in_array('payroll', $this->modules)) { ?>
                                                <li><a href="payroll"><?php echo lang('payroll'); ?></a></li>
                                            <?php } ?>
                                            <?php if (in_array('payroll', $this->modules)) { ?>
                                                <li><a href="payroll/salary"><?php echo lang('salary'); ?></a></li>
                                            <?php } ?>
                                        </ul>
                                    </li>
                                <?php } ?>
                             <?php } ?>
                             <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                <?php if (in_array('attendance', $this->modules)) { ?>
                                    <li class="sub-menu" data-menu="aattendance">
                                        <a href="attendance">
                                            <i class="fa fa-bell-slash icon nav-icon"></i>
                                            <span class="menu-item" data-key="t-calendar"><?php echo lang('attendance'); ?></span>
                                        </a>
                                    </li>
                            <?php
                                }
                            }
                            ?>
                            <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                <?php if (in_array('leave', $this->modules)) { ?>
                                    <li>
                                        <a href="javascript: void(0);" class="has-arrow">
                                            <i class="fa fa-bell-slash icon nav-icon"></i>
                                            <span class="menu-item" data-key="t-email"><?php echo lang('leave'); ?></span>
                                        </a>
                                        <ul class="sub-menu" data-menu="leave" aria-expanded="false">
                                            <?php if (in_array('leave', $this->modules)) { ?>
                                                <li><a href="leave"><?php echo lang('leave'); ?></a></li>
                                            <?php } ?>
                                            <?php if (in_array('leave', $this->modules)) { ?>
                                                <li><a href="leave/leaveType"><?php echo lang('leave_type'); ?></a></li>
                                            <?php } ?>
                                        </ul>
                                    </li>
                                <?php } ?>
                             <?php } ?>
                             <?php if ($this->ion_auth->in_group(array('admin', 'Nurse', 'Accountant', 'Pharmacist', 'Doctor', 'Laboratorist', 'Receptionist'))) { ?>
                                <li class="menu-title" data-key="t-applications">Chat</li>
                             <?php } ?>
                             <?php if ($this->ion_auth->in_group(array('admin', 'Nurse', 'Accountant', 'Pharmacist', 'Doctor', 'Laboratorist', 'Receptionist'))) { ?>
                                <?php if (in_array('chat', $this->modules)) { ?>
                                    <li class="sub-menu" data-menu="chat">
                                        <a href="chat">
                                            <i class="bx bx-chat icon nav-icon"></i>
                                            <span class="menu-item" data-key="t-chat"><?php echo lang('chat'); ?></span>
                                            <span class="badge rounded-pill bg-danger" data-key="t-hot" id="chatCount">0</span>
                                            
                                        </a>

                                    </li>
                                    <script src="common/js/jquery.js"></script>
                                    <script src="common/extranal/js/chat.js"></script>
                            <?php
                                }
                            }
                            ?>
                            <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                <li class="menu-title" data-key="t-applications">Website & Settings</li>
                            <?php } ?>

                            <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                               
                                    <li>
                                        <a href="javascript: void(0);" class="has-arrow">
                                            <i class="fas fa-globe icon nav-icon"></i>
                                            <span class="menu-item" data-key="t-email"><?php echo lang('website'); ?></span>
                                        </a>
                                        <?php

                                            $hospital_username = $this->db->get_where('hospital', array('id' => $this->session->userdata('hospital_id')))->row()->username;
                                            if (empty($hospital_username)) {
                                                $hospital_username = '';
                                            }

                                        ?>
                                        <ul class="sub-menu" data-menu="awebsite" aria-expanded="false">
                                            <li><a href='site/<?php echo $hospital_username ?>' target="_blank"><?php echo lang('visit_site'); ?></a></li>
                                            <li><a href="site/settings"><?php echo lang('website_settings'); ?></a></li>
                                            <li><a href="site/review"><?php echo lang('reviews'); ?></a></li>
                                            <li><a href="site/gridsection"><?php echo lang('gridsections'); ?></a></li>
                                            <li><a href="site/gallery"><?php echo lang('gallery'); ?></a></li>
                                            <li><a href="site/slide"><?php echo lang('slides'); ?></a></li>
                                            <li><a href="site/service"><?php echo lang('services'); ?></a></li>
                                            <li><a href="site/featured"><?php echo lang('featured_doctors'); ?></a></li>
                                        </ul>
                                    </li>

                                    <li>
                                        <a href="javascript: void(0);" class="has-arrow">
                                            <i class="mdi mdi-application-settings icon nav-icon"></i>
                                            <span class="menu-item" data-key="t-email"><?php echo lang('settings'); ?></span>
                                        </a>
                                       
                                        <ul class="sub-menu" data-menu="settings" aria-expanded="false">
                                            <li><a href="settings"><?php echo lang('system_settings'); ?></a></li>
                                            <li><a href="settings/chatgpt"><?php echo lang('chatgpt_settings'); ?></a></li>
                                             <!--<li><a href="meeting/settings">Zoom Settings</a></li>-->
                                            <li><a href="pgateway"><?php echo lang('payment_gateway'); ?></a></li>
                                            <li><a href="settings/language"><?php echo lang('language'); ?></a></li>
                                            <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                                <li><a href="import"><?php echo lang('bulk'); ?> <?php echo lang('import'); ?></a></li>
                                            <?php } ?>
                                        </ul>
                                    </li>
                                
                             <?php } ?>
                             <?php if ($this->ion_auth->in_group('Accountant')) { ?>
                                <?php if (in_array('finance', $this->modules)) { ?>
                                <li>
                                        <a href="javascript: void(0);" class="has-arrow">
                                            <i class="fa fa-money-bill-alt icon nav-icon"></i>
                                            <span class="menu-item" data-key="t-email"><?php echo lang('payments'); ?></span>
                                        </a>
                                       
                                        <ul class="sub-menu" data-menu="apayment" aria-expanded="false">
                                            <li><a href="finance/addPaymentView" data-key="t-inbox"><?php echo lang('add_payment'); ?></a></li>
                                            <li><a href="finance/payment" data-key="t-read-email"><?php echo lang('payments'); ?></a></li>                                            <li><a href="finance/dueCollection" data-key="t-read-email"><?php echo lang('due_collection'); ?></a></li>
                                            <li><a href="finance/paymentCategory" data-key="t-inbox"><?php echo lang('payment_procedures'); ?></a></li>
                                            <li><a href="finance/dueCollection"><?php echo lang('due_collection'); ?></a></li>
                                            <li><a href="finance/category" data-key="t-read-email"><?php echo lang('payment_categories'); ?></a></li>
                                            <li><a href="finance/expense" data-key="t-read-email"><?php echo lang('expense'); ?></a></li>
                                            <li><a href="finance/addExpenseView" data-key="t-read-email"><?php echo lang('add_expense'); ?></a></li>
                                            <li><a href="finance/expenseCategory" data-key="t-read-email"><?php echo lang('expense_categories'); ?></a></li>
                                            <li><a href="finance/doctorsCommission"><?php echo lang('doctors_commission'); ?></a></li>
                                            <li>
                                                <a href="finance/financialReport"><?php echo lang('financial_report'); ?></a>
                                            </li>
                                        </ul>
                                    </li>
                            <?php } ?>
                            <?php } ?>
                            <?php if ($this->ion_auth->in_group('Pharmacist')) { ?>
                            <?php if (in_array('medicine', $this->modules)) { ?>
                                <li class="menu-title" data-key="t-applications">Medicine</li>
                                <li class="sub-menu" data-menu="medicinelist">
                                    <a href="medicine">
                                        <i class="fa fa-medkit icon nav-icon"></i>
                                        <span class="menu-item" data-key="t-chat"> <?php echo lang('medicine_list'); ?> </span>
                                    </a>
                                </li>
                                <li class="sub-menu" data-menu="addmedicine">
                                    <a href="medicine/addMedicineView">
                                        <i class="fa fa-plus-circle icon nav-icon"></i>
                                        <span class="menu-item" data-key="t-chat"> <?php echo lang('add_medicine'); ?> </span>
                                    </a>
                                </li>
                                <li class="sub-menu" data-menu="medicinecategory">
                                    <a href="medicine/medicineCategory">
                                        <i class="fa fa-medkit icon nav-icon"></i>
                                        <span class="menu-item" data-key="t-chat"> <?php echo lang('medicine_category'); ?> </span>
                                    </a>
                                </li>
                                <li class="sub-menu" data-menu="addmedicinecategory">
                                    <a href="medicine/addCategoryView">
                                        <i class="fa fa-plus-circle icon nav-icon"></i>
                                        <span class="menu-item" data-key="t-chat"> <?php echo lang('add_medicine_category'); ?> </span>
                                    </a>
                                </li>
                            <?php } ?>
                    <?php } ?>
                    <?php if ($this->ion_auth->in_group('Nurse')) { ?>
                        <?php if (in_array('bed', $this->modules)) { ?>
                            <li class="menu-title" data-key="t-applications">Bed</li>
                            <li class="sub-menu" data-menu="bedlist">
                                <a href="bed">
                                    <i class="fa fa-procedures icon nav-icon"></i>
                                    <span class="menu-item"> <?php echo lang('bed_list'); ?> </span>
                                </a>
                            </li>
                            <li class="sub-menu" data-menu="bedcategory">
                                <a href="bed/bedCategory">
                                    <i class="fa fa-edit icon nav-icon"></i>
                                    <span class="menu-item"> <?php echo lang('bed_category'); ?> </span>
                                </a>
                            </li>
                            <li class="sub-menu" data-menu="bedallotment">
                                <a href="bed/bedAllotment">
                                    <i class="fa fa-plus-circle icon nav-icon"></i>
                                    <span class="menu-item"> <?php echo lang('bed_allotments'); ?> </span>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if (in_array('donor', $this->modules)) { ?>
                            <li class="sub-menu" data-menu="donorlist">
                                <a href="donor">
                                    <i class="fa fa-medkit icon nav-icon"></i>
                                    <span class="menu-item"> <?php echo lang('donor'); ?> </span>
                                </a>
                            </li>
                            <li class="sub-menu" data-menu="bloodbank">
                                <a href="donor/bloodBank">
                                    <i class="fa fa-tint icon nav-icon"></i>
                                    <span class="menu-item"> <?php echo lang('blood_bank'); ?> </span>
                                </a>
                            </li>
                        <?php } ?>
                    <?php } ?>

                    <?php if ($this->ion_auth->in_group('Patient')) { ?>
                        <?php if (in_array('lab', $this->modules)) { ?>
                            <li class="menu-title" data-key="t-applications">My Appplications</li>
                            <li class="sub-menu" data-menu="dreport">
                                <a href="lab/myLab">
                                    <i class="fa fa-file-medical-alt icon nav-icon"></i>
                                    <span class="menu-item"> <?php echo lang('diagnosis'); ?> <?php echo lang('reports'); ?> </span>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if (in_array('appointment', $this->modules)) { ?>
                            <li class="sub-menu" data-menu="acalendar">
                                <a href="patient/calendar">
                                    <i class="fa fa-calendar icon nav-icon"></i>
                                    <span class="menu-item"> <?php echo lang('appointment'); ?> <?php echo lang('calendar'); ?> </span>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if (in_array('patient', $this->modules)) { ?>
                            <li class="sub-menu" data-menu="cases">
                                <a href="patient/myCaseList">
                                    <i class="fa fa-file-medical icon nav-icon"></i>
                                    <span class="menu-item"> <?php echo lang('cases'); ?> </span>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if (in_array('prescription', $this->modules)) { ?>
                            <li class="sub-menu" data-menu="myprescription">
                                <a href="patient/myPrescription">
                                    <i class="fa fa-prescription icon nav-icon"></i>
                                    <span class="menu-item"> <?php echo lang('prescription'); ?> </span>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if (in_array('patient', $this->modules)) { ?>
                            <li class="sub-menu" data-menu="document">
                                <a href="patient/myDocuments">
                                    <i class="fa fa-file-upload icon nav-icon"></i>
                                    <span class="menu-item"> <?php echo lang('documents'); ?> </span>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if (in_array('finance', $this->modules)) { ?>
                            <li class="sub-menu" data-menu="mypayment">
                                <a href="patient/myPaymentHistory">
                                    <i class="fa fa-money-bill-alt icon nav-icon"></i>
                                    <span class="menu-item"> <?php echo lang('payment'); ?> </span>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if (in_array('report', $this->modules)) { ?>
                            <li class="sub-menu" data-menu="myreport">
                                <a href="report/myreports">
                                    <i class="fa fa-file-medical-alt icon nav-icon"></i>
                                    <span class="menu-item"> <?php echo lang('other'); ?> <?php echo lang('reports'); ?> </span>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if (in_array('donor', $this->modules)) { ?>
                            <li class="sub-menu" data-menu="donors">
                                <a href="donor">
                                    <i class="fa fa-user icon nav-icon"></i>
                                    <span class="menu-item"><?php echo lang('donor'); ?></span>
                                </a>
                            </li>
                        <?php } ?>
                    <?php } ?>
                    <?php if (!$this->ion_auth->in_group(array('admin', 'Patient', 'superadmin'))) { ?>
                        <li class="menu-title" data-key="t-applications">E-mail</li>
                        <li>
                                <a href="javascript: void(0);" class="has-arrow">
                                    <i class="fa fa-email-bulk icon nav-icon"></i>
                                    <span class="menu-item" data-key="t-email"><?php echo lang('email'); ?></span>
                                </a>
                                <ul class="sub-menu" data-menu="aemail" aria-expanded="false">
                                    <li><a href="email/sendView"><?php echo lang('new'); ?></a></li>
                                </ul>
                            </li>
                    <?php } ?>
                    <?php if ($this->ion_auth->in_group('superadmin')) { ?>
                        <?php if (in_array('superadmin', $this->super_modules)) { ?>
                            <li class="sub-menu" data-menu="superadmin">
                                <a href="superadmin">
                                    <i class="fa fa-users icon nav-icon"></i>
                                    <span class="menu-item"><?php echo lang('superadmin'); ?></span>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if (in_array('hospital', $this->super_modules)) { ?>
                            <li class="sub-menu" data-menu="hospital">
                                <a href="hospital">
                                    <i class="fa fa-sitemap icon nav-icon"></i>
                                    <span class="menu-item"><?php echo lang('all_hospitals'); ?></span>
                                </a>
                            </li>
                            <li class="sub-menu" data-menu="createhospital">
                                <a href="hospital/addNewView">
                                    <i class="fa fa-plus-circle icon nav-icon"></i>
                                    <span class="menu-item"><?php echo lang('create_new_hospital'); ?></span>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if (in_array('package', $this->super_modules)) { ?>
                            <li class="sub-menu" data-menu="package">
                                <a href="hospital/package">
                                    <i class="fa fa-sitemap icon nav-icon"></i>
                                    <span class="menu-item"><?php echo lang('packages'); ?></span>
                                </a>
                            </li>
                            <li class="sub-menu" data-menu="createpackage">
                                <a href="hospital/package/addNewView">
                                    <i class="fa fa-plus-circle icon nav-icon"></i>
                                    <span class="menu-item"><?php echo lang('add_new_package'); ?></span>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if (in_array('request', $this->super_modules)) { ?>
                            <li class="sub-menu" data-menu="rwebsite">
                                <a href="request">
                                    <i class="fa fa-sitemap icon nav-icon"></i>
                                    <span class="menu-item"><?php echo lang('registration_from_website'); ?></span>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if (in_array('systems', $this->super_modules)) { ?>
                            <li class="menu-title" data-key="t-applications">Report</li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow">
                                    <i class="fa fa-file-excel icon nav-icon"></i>
                                    <span class="menu-item" data-key="t-email"><?php echo lang('report'); ?></span>
                                </a>
                                <ul class="sub-menu" data-menu="sreport" aria-expanded="false">
                                    <li><a href="systems/activeHospitals"><?php echo lang('active_hospitals'); ?></a></li>
                                    <li><a href="systems/inactiveHospitals"><?php echo lang('inactive_hospitals'); ?></a></li>
                                    <li><a href="systems/expiredHospitals"><?php echo lang('license_expire_hospitals'); ?></a></li>
                                    <li><a href="systems/registeredPatient"><?php echo lang('registered_patient'); ?></a></li>
                                    <li><a href="systems/registeredDoctor"><?php echo lang('registered_doctor'); ?></a></li>
                                    <li><a href="hospital/reportSubscription"><?php echo lang('subscription_report'); ?></a></li>
                                </ul>
                            </li>
                        <?php } ?>

                        <li class="menu-title" data-key="t-applications">Feedback</li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow">
                                <i class="fa fa-comments icon nav-icon"></i>
                                    <span class="menu-item" data-key="t-email">Feedback</span>
                                </a>
                                <ul class="sub-menu" data-menu="feedback" aria-expanded="false">
                                <li><a href="feedback/overview">Overview</a></li>
                                <li><a href="feedback">All Feedback</a></li>
                                <li><a href="feedback/comments">All Comments</a></li>
                                    <li><a href="category">Category</a></li>
                                    <li><a href="roadmap">Feedback Roadmap</a></li>
                                    <li><a href="board">Board</a></li>
                                    
                                   
                                </ul>
                            </li>
                        <li class="menu-title" data-key="t-applications">Website</li>
                        <li>
                                <a href="javascript: void(0);" class="has-arrow">
                                    <i class="fa fa-cogs icon nav-icon"></i>
                                    <span class="menu-item" data-key="t-email"><?php echo lang('website'); ?></span>
                                </a>
                                <ul class="sub-menu" data-menu="website" aria-expanded="false">
                                    <li><a href="frontend" target="_blank"><?php echo lang('visit_site'); ?></a></li>
                                    <li><a href="frontend/settings"></i><?php echo lang('website_settings'); ?></a></li>
                                    <?php if (in_array('slide', $this->super_modules)) { ?>
                                        <li><a href="slide"><?php echo lang('slides'); ?></a></li>
                                    <?php } ?>
                                    <?php if (in_array('service', $this->super_modules)) { ?>
                                        <li><a href="service"><?php echo lang('services'); ?></a></li>
                                    <?php } ?>
                                    <li><a href="featured">Top Doctors</a></li>
                                    <li><a href="frontend/review">Reviews</a></li>
                                    <li><a href="frontend/gallery">Gallery</a></li>
                                    <li><a href="frontend/gridsection">Weekly Time</a></li>
                                    <li><a href="frontend/crutches">Crutches</a></li>
                                    <li><a href="blog">News</a></li>
                                    <li><a href="faq">FAQs</a></li>
                                    <li><a href="frontend/subscribe">Subscribers</a></li>
                                </ul>
                            </li>
                            <?php if (in_array('email', $this->super_modules)) { ?>
                                <li class="menu-title" data-key="t-applications">E-mail</li>
                                <li>
                                    <a href="javascript: void(0);" class="has-arrow">
                                        <i class="fa fa-mail-bulk icon nav-icon"></i>
                                        <span class="menu-item" data-key="t-email"><?php echo lang('email'); ?></span>
                                    </a>
                                    <ul class="sub-menu" data-menu="semail" aria-expanded="false">
                                        <li><a href="email/superadminSendView"><?php echo lang('new'); ?></a></li>
                                        <li><a href="email/sent"><?php echo lang('sent'); ?></a></li>

                                        <li><a href="email/emailSettings"><?php echo lang('settings'); ?></a></li>
                                        <li><a href="email/contactEmailSettings"><?php echo lang('contact'); ?> <?php echo lang('email'); ?></a></li>
                                    </ul>
                                </li>

                            <?php } ?>
                            <li class="menu-title" data-key="t-applications">Settings</li>
                            <li class="sub-menu" data-menu="systemsettings"><a href="settings"><i class="fa fa-cog icon nav-icon"></i><span class="menu-item" data-key="t-chat"><?php echo lang('system_settings'); ?></span></a></li>
                            <li class="sub-menu" data-menu="recapcha"><a href="settings/googleReCaptcha"><i class="fa fa-cog icon nav-icon"></i><span class="menu-item" data-key="t-chat">Google reCAPTCHA</a></span></li>
                            <?php if (in_array('pgateway', $this->super_modules)) { ?>
                                <li class="sub-menu" data-menu="paymentgateway"><a href="pgateway"><i class="fa fa-credit-card icon nav-icon"></i><span class="menu-item" data-key="t-chat"><?php echo lang('payment_gateway'); ?></span></a></li>
                            <?php } ?>
                            <li class="sub-menu" data-menu="language"><a href="settings/language"><i class="fa fa-language icon nav-icon"></i><span class="menu-item" data-key="t-chat"><?php echo lang('language'); ?></span></a></li>
                    <?php } ?>
                    <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                        <li class="menu-title" data-key="t-applications">Logs</li>
                        <li>
                                <a href="javascript: void(0);" class="has-arrow">
                                    <i class="fa fa-history icon nav-icon"></i>
                                    <span class="menu-item" data-key="t-email"><?php echo lang('logs'); ?></span>
                                </a>
                                <ul class="sub-menu" data-menu="log" aria-expanded="false">
                                    <li><a href="transactionLogs"><?php echo lang('transaction_logs'); ?></a></li>
                                    <li><a href="logs"><?php echo lang('user'); ?> <?php echo lang('login_logs'); ?></a></li>
                                </ul>
                            </li>
                            <li>
                            <li class="menu-title" data-key="t-applications">Subscription</li>
                            <li class="sub-menu" data-menu="subscription">
                            <a href="settings/subscription">
                                <i class="fa fa-user icon nav-icon"></i>
                                <span class="menu-item"> <?php echo lang('subscription'); ?> </span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if ($this->ion_auth->in_group(array('Doctor'))) { ?>
                        <!-- <li class="menu-title" data-key="t-applications"><?php echo lang('Zoom Setting'); ?></li>
                    <li>
                        <a href="meeting/settings">
                            <i class="fa fa-cog icon nav-icon"></i>
                            <span class="menu-item"> <?php echo lang('Zoom Setting'); ?> </span>
                        </a>
                    </li> -->
                        <?php } ?>
                        <?php if ($this->ion_auth->in_group('admin')) { ?>
                            <li class="sub-menu" data-menu="afedback">
                                        <a href="feedback">
                                            <i class="fa fa-sitemap icon nav-icon"></i>
                                            <span class="menu-item" data-key="t-calendar">Feedback</span>
                                        </a>
                                    </li>
                                    <li class="sub-menu" data-menu="comments">
                                        <a href="feedback/comments">
                                            <i class="fa fa-comment icon nav-icon"></i>
                                            <span class="menu-item" data-key="t-calendar">Feedback Comments</span>
                                        </a>
                                    </li>
                                    <?php } ?>
                    <li class="menu-title" data-key="t-applications">Profile</li>
                    <li class="sub-menu" data-menu="profile">
                        <a href="profile">
                            <i class="fa fa-user icon nav-icon"></i>
                            <span class="menu-item"> <?php echo lang('profile'); ?> </span>
                        </a>
                    </li>
                        
                        </ul>
                    </div>
                    <!-- Sidebar -->
                </div>
            </div>
           
<script>
document.addEventListener("DOMContentLoaded", function () {
    let activeMenu = localStorage.getItem("activeMenu");

    if (activeMenu) {
        let activeLink = document.querySelector(`.sub-menu a[href="${activeMenu}"]`);
        if (activeLink) {
            let parentLi = activeLink.closest("li");
            let parentSubMenu = activeLink.closest(".sub-menu");
            let mainMenuItem = parentSubMenu ? parentSubMenu.closest("li") : null;

            // Add active class to the clicked link
            if (parentLi) {
                parentLi.classList.add("active");
            }

            // Expand submenu
            if (parentSubMenu) {
                parentSubMenu.style.display = "block"; // Show submenu
            }

            // Ensure parent menu item is also open
            if (mainMenuItem) {
                mainMenuItem.classList.add("active");
            }
            setTimeout(() => {
                activeLink.scrollIntoView({ behavior: "smooth", block: "center" });
            }, 300);
        }
    }

    // Add click event to all submenu links
    document.querySelectorAll(".sub-menu a").forEach(function (menuLink) {
        menuLink.addEventListener("click", function () {
            localStorage.setItem("activeMenu", this.getAttribute("href"));
        });
    });
    console.log(localStorage.getItem("activeMenu"));

});
</script>





          
                       

              
      

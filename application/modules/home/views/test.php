<!doctype html>

<html lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title></title>

    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="">


    <!-- Disable tap highlight on IE -->
    <meta name="msapplication-tap-highlight" content="no">


    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/main.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/custom.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/scripts/responsive.dataTables.min.css'); ?>">
    <style type="text/css">
    .mce-flow-layout-item.mce-last {
        display: none !important;
    }

    .app-sidebar__footer {
        z-index: 9
    }
    </style>
    <script src="<?php echo base_url('assets/plugins/jquery/jquery-3.6.0.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/tinymce/tinymce.min.js'); ?>"></script>
    <script>
    tinymce.init({
        selector: 'editor',
    });
    </script>

</head>

<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar">
        <div class="app-header header-shadow">
            <div class="app-header__logo">

                <div class="widget-heading fsize-2"> company_name</div>

                <div class="header__pane ms-auto">
                    <div>
                        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                            data-class="closed-sidebar">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="app-header__mobile-menu">
                <div>
                    <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="app-header__menu">
                <span>
                    <button type="button"
                        class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                    </button>
                </span>
            </div>
            <div class="app-header__content">
                <div class="app-header-left">

                </div>
                <div class="app-header-right">
                    <div class="header-dots">
                    </div>

                    <div class=" pe-5">
                        <div class="widget-content">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left">
                                    <div class="btn-group">
                                        <a data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                            class="p-0 btn">
                                            <div class="profile-image"></div>
                                        </a>
                                        <div tabindex="-1" role="menu" aria-hidden="true"
                                            class="rm-pointers dropdown-menu-lg dropdown-menu dropdown-menu-right outer-round">
                                            <div class="dropdown-menu-header">
                                                <div class="dropdown-menu-header-inner bg-info br--4">
                                                    <div class="menu-header-content text-start">
                                                        <div class="widget-content p-0">
                                                            <div class="widget-content-wrapper">
                                                                <div class="widget-content-left me-3">
                                                                    <div class="profile-image"></div>
                                                                </div>
                                                                <div class="widget-content-left">
                                                                    <div class="widget-heading"> </div>
                                                                    <div class="widget-subheading opacity-8"> </div>
                                                                </div>
                                                                <div class="widget-content-right me-2">
                                                                    <a href=""
                                                                        class="btn-pill btn-shadow btn-shine btn btn-focus">logout

                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="header-btn-lg"></div>
                                <div class="widget-content-left header-user-info">
                                    <div class="widget-heading"> </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="header-btn-lg">
                        <button type="button" class="hamburger hamburger--elastic open-right-drawer">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>


        <div class="app-drawer-wrapper right-sidebar">
            <div class="drawer-nav-btn">
                <button type="button" class="hamburger hamburger--elastic is-active close_server_status_btn">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
            <div class="drawer-content-wrapper">
                <div class="scrollbar-container">
                    <h3 class="drawer-heading"></h3>
                    <div class="drawer-section">
                        <div class="row">
                            <div class="col">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="app-main">
            <div class="app-sidebar sidebar-shadow">
                <div class="app-header__logo">
                    <div class="logo-src"></div>
                    <div class="header__pane ms-auto">
                        <div>
                            <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                                data-class="closed-sidebar">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="app-header__mobile-menu">
                    <div>
                        <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
                <div class="app-header__menu">
                    <span>
                        <button type="button"
                            class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                            <span class="btn-icon-wrapper">
                                <i class="fa fa-ellipsis-v fa-w-6"></i>
                            </span>
                        </button>
                    </span>
                </div>
                <div class="scrollbar-sidebar">
                <div data-simplebar class="sidebar-menu-scroll">

<!--- Sidemenu -->
<div id="sidebar-menu">
    <!-- Left Menu Start -->
    <ul class="metismenu list-unstyled" id="side-menu">
        <li class="menu-title" data-key="t-menu">Menu</li>

        <li>
            <a href="home">
                <i class="bx bx-tachometer icon nav-icon"></i>
                <span class="menu-item" data-key="t-dashboards"><?php echo lang('dashboard'); ?></span>
                
            </a>
        </li>

        <li class="menu-title" data-key="t-applications">Applications</li>
        
        <?php if ($this->ion_auth->in_group('admin')) { ?>
             <?php if (in_array('department', $this->modules)) { ?>
                <li>
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
                    <ul class="sub-menu" aria-expanded="false">
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
                    <ul class="sub-menu" aria-expanded="false">
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
                    <ul class="sub-menu" aria-expanded="false">
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
                    <ul class="sub-menu" aria-expanded="false">
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
                    <ul class="sub-menu" aria-expanded="false">
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
                <li>
                    <a href="appointment/myTodays">
                        <i class="fa fa-headphones icon nav-icon"></i>
                        <span class="menu-item" data-key="t-calendar"><?php echo lang('todays'); ?> <?php echo lang('appointment'); ?></span>
                    </a>
                </li>


        <?php } 
            if (in_array('notice', $this->modules)) { ?>

                    <li>
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
               <ul class="sub-menu" aria-expanded="false">
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

                    <li>
                        <a href="attendance">
                            <i class="fa fa-bell-slash icon nav-icon"></i>
                            <span class="menu-item" data-key="t-calendar"><?php echo lang('attendance'); ?></span>
                        </a>
                    </li>

         <?php } ?>
         <?php   if (in_array('leave', $this->modules)) { ?>

            <li>
                <a href="leave">
                    <i class="fa fa-bell-slash icon nav-icon"></i>
                    <span class="menu-item" data-key="t-calendar"><?php echo lang('leave'); ?></span>
                </a>
            </li>

        <?php } ?>
        <?php   if (in_array('payroll', $this->modules)) { ?>

                <li>
                    <a href="payroll/employeePayroll">
                        <i class="fa fa-money-check icon nav-icon"></i>
                        <span class="menu-item" data-key="t-calendar"><?php echo lang('payroll'); ?></span>
                    </a>
                </li>

                <?php } ?>
                <?php   if (in_array('notice', $this->modules)) { ?>

                <li>
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
                    <ul class="sub-menu" aria-expanded="false">
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
                <li>
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
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="finance/payment" data-key="t-read-email"><?php echo lang('payments'); ?></a></li>
                        <li><a href="finance/addPaymentView" data-key="t-inbox"><?php echo lang('add_payment'); ?></a></li>
                        
                        <li><a href="finance/dueCollection" data-key="t-read-email"><?php echo lang('due_collection'); ?></a></li>
                       

                    </ul>
                </li>
            <?php } ?>
        <?php } ?>

        <?php if ($this->ion_auth->in_group(array('admin', 'Pharmacist'))) { ?>
            <?php if (in_array('prescription', $this->modules)) { ?>
                <li>
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
                <li>
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
                <li>
                    <a href="finance/UserActivityReport">
                        <i class="fa fa-file-user icon nav-icon"></i>
                        <span class="menu-item" data-key="t-calendar"><?php echo lang('user_activity_report'); ?></span>
                    </a>
                </li>
            <?php } ?>
        
        <?php } ?>
       


        <?php if ($this->ion_auth->in_group(array('Doctor'))) { ?>
            <?php if (in_array('prescription', $this->modules)) { ?>
                <li>
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
                    <ul class="sub-menu" aria-expanded="false">
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
                    <ul class="sub-menu" aria-expanded="false">
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
                    <ul class="sub-menu" aria-expanded="true">
                    <?php if (!$this->ion_auth->in_group(array('Pharmacist'))) { ?>
                        <li><a href="finance/pharmacy/home" data-key="t-level-1.1"><?php echo lang('dashboard'); ?></a></li>
                    <?php } ?>
                    <li><a href="finance/pharmacy/payment" data-key="t-level-1.1"><?php echo lang('sales'); ?></a></li>
                    <li><a href="finance/pharmacy/addPaymentView" data-key="t-level-1.1"><?php echo lang('add_new_sale'); ?></a></li>
                    <li><a href="finance/pharmacy/expense" data-key="t-level-1.1"><?php echo lang('expense'); ?></a></li>
                    <li><a href="finance/pharmacy/addExpenseView" data-key="t-level-1.1"><?php echo lang('add_expense'); ?></a></li>
                    <li><a href="finance/pharmacy/expenseCategory" data-key="t-level-1.1"><?php echo lang('expense_categories'); ?></a></li>

                        <li><a href="javascript: void(0);" class="has-arrow" data-key="t-level-1.2"><?php echo lang('report'); ?></a>
                            <ul class="sub-menu" aria-expanded="true">
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
                    <ul class="sub-menu" aria-expanded="false">
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
                    <ul class="sub-menu" aria-expanded="false">
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
                    <ul class="sub-menu" aria-expanded="false">
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
                    <ul class="sub-menu" aria-expanded="false">
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
                    <ul class="sub-menu" aria-expanded="false">
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
                    <ul class="sub-menu" aria-expanded="false">
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
                    <ul class="sub-menu" aria-expanded="false">
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
                    <ul class="sub-menu" aria-expanded="false">
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
                <li>
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
                    <ul class="sub-menu" aria-expanded="false">
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
                <li>
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
                    <ul class="sub-menu" aria-expanded="false">
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
                   
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="settings"><?php echo lang('system_settings'); ?></a></li>
                        <li><a href="settings/chatgpt"><?php echo lang('chatgpt_settings'); ?></a></li>
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
                   
                    <ul class="sub-menu" aria-expanded="false">
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
            <li>
                <a href="medicine">
                    <i class="fa fa-medkit icon nav-icon"></i>
                    <span class="menu-item" data-key="t-chat"> <?php echo lang('medicine_list'); ?> </span>
                </a>
            </li>
            <li>
                <a href="medicine/addMedicineView">
                    <i class="fa fa-plus-circle icon nav-icon"></i>
                    <span class="menu-item" data-key="t-chat"> <?php echo lang('add_medicine'); ?> </span>
                </a>
            </li>
            <li>
                <a href="medicine/medicineCategory">
                    <i class="fa fa-medkit icon nav-icon"></i>
                    <span class="menu-item" data-key="t-chat"> <?php echo lang('medicine_category'); ?> </span>
                </a>
            </li>
            <li>
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
        <li>
            <a href="bed">
                <i class="fa fa-procedures icon nav-icon"></i>
                <span class="menu-item"> <?php echo lang('bed_list'); ?> </span>
            </a>
        </li>
        <li>
            <a href="bed/bedCategory">
                <i class="fa fa-edit icon nav-icon"></i>
                <span class="menu-item"> <?php echo lang('bed_category'); ?> </span>
            </a>
        </li>
        <li>
            <a href="bed/bedAllotment">
                <i class="fa fa-plus-circle icon nav-icon"></i>
                <span class="menu-item"> <?php echo lang('bed_allotments'); ?> </span>
            </a>
        </li>
    <?php } ?>
    <?php if (in_array('donor', $this->modules)) { ?>
        <li>
            <a href="donor">
                <i class="fa fa-medkit icon nav-icon"></i>
                <span class="menu-item"> <?php echo lang('donor'); ?> </span>
            </a>
        </li>
        <li>
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
        <li>
            <a href="lab/myLab">
                <i class="fa fa-file-medical-alt icon nav-icon"></i>
                <span class="menu-item"> <?php echo lang('diagnosis'); ?> <?php echo lang('reports'); ?> </span>
            </a>
        </li>
    <?php } ?>
    <?php if (in_array('appointment', $this->modules)) { ?>
        <li>
            <a href="patient/calendar">
                <i class="fa fa-calendar icon nav-icon"></i>
                <span class="menu-item"> <?php echo lang('appointment'); ?> <?php echo lang('calendar'); ?> </span>
            </a>
        </li>
    <?php } ?>
    <?php if (in_array('patient', $this->modules)) { ?>
        <li>
            <a href="patient/myCaseList">
                <i class="fa fa-file-medical icon nav-icon"></i>
                <span class="menu-item"> <?php echo lang('cases'); ?> </span>
            </a>
        </li>
    <?php } ?>
    <?php if (in_array('prescription', $this->modules)) { ?>
        <li>
            <a href="patient/myPrescription">
                <i class="fa fa-prescription icon nav-icon"></i>
                <span class="menu-item"> <?php echo lang('prescription'); ?> </span>
            </a>
        </li>
    <?php } ?>
    <?php if (in_array('patient', $this->modules)) { ?>
        <li>
            <a href="patient/myDocuments">
                <i class="fa fa-file-upload icon nav-icon"></i>
                <span class="menu-item"> <?php echo lang('documents'); ?> </span>
            </a>
        </li>
    <?php } ?>
    <?php if (in_array('finance', $this->modules)) { ?>
        <li>
            <a href="patient/myPaymentHistory">
                <i class="fa fa-money-bill-alt icon nav-icon"></i>
                <span class="menu-item"> <?php echo lang('payment'); ?> </span>
            </a>
        </li>
    <?php } ?>
    <?php if (in_array('report', $this->modules)) { ?>
        <li>
            <a href="report/myreports">
                <i class="fa fa-file-medical-alt icon nav-icon"></i>
                <span class="menu-item"> <?php echo lang('other'); ?> <?php echo lang('reports'); ?> </span>
            </a>
        </li>
    <?php } ?>
    <?php if (in_array('donor', $this->modules)) { ?>
        <li>
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
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="email/sendView"><?php echo lang('new'); ?></a></li>
            </ul>
        </li>
<?php } ?>
<?php if ($this->ion_auth->in_group('superadmin')) { ?>
    <?php if (in_array('superadmin', $this->super_modules)) { ?>
        <li>
            <a href="superadmin">
                <i class="fa fa-users icon nav-icon"></i>
                <span class="menu-item"><?php echo lang('superadmin'); ?></span>
            </a>
        </li>
    <?php } ?>
    <?php if (in_array('hospital', $this->super_modules)) { ?>
        <li>
            <a href="hospital">
                <i class="fa fa-sitemap icon nav-icon"></i>
                <span class="menu-item"><?php echo lang('all_hospitals'); ?></span>
            </a>
        </li>
        <li>
            <a href="hospital/addNewView">
                <i class="fa fa-plus-circle icon nav-icon"></i>
                <span class="menu-item"><?php echo lang('create_new_hospital'); ?></span>
            </a>
        </li>
    <?php } ?>
    <?php if (in_array('package', $this->super_modules)) { ?>
        <li>
            <a href="hospital/package">
                <i class="fa fa-sitemap icon nav-icon"></i>
                <span class="menu-item"><?php echo lang('packages'); ?></span>
            </a>
        </li>
        <li>
            <a href="hospital/package/addNewView">
                <i class="fa fa-plus-circle icon nav-icon"></i>
                <span class="menu-item"><?php echo lang('add_new_package'); ?></span>
            </a>
        </li>
    <?php } ?>
    <?php if (in_array('request', $this->super_modules)) { ?>
        <li>
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
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="systems/activeHospitals"><?php echo lang('active_hospitals'); ?></a></li>
                <li><a href="systems/inactiveHospitals"><?php echo lang('inactive_hospitals'); ?></a></li>
                <li><a href="systems/expiredHospitals"><?php echo lang('license_expire_hospitals'); ?></a></li>
                <li><a href="systems/registeredPatient"><?php echo lang('registered_patient'); ?></a></li>
                <li><a href="systems/registeredDoctor"><?php echo lang('registered_doctor'); ?></a></li>
                <li><a href="hospital/reportSubscription"><?php echo lang('subscription_report'); ?></a></li>
            </ul>
        </li>
    <?php } ?>
    <li class="menu-title" data-key="t-applications">Website</li>
    <li>
            <a href="javascript: void(0);" class="has-arrow">
                <i class="fa fa-cogs icon nav-icon"></i>
                <span class="menu-item" data-key="t-email"><?php echo lang('website'); ?></span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="frontend" target="_blank"><?php echo lang('visit_site'); ?></a></li>
                <li><a href="frontend/settings"></i><?php echo lang('website_settings'); ?></a></li>
                <?php if (in_array('slide', $this->super_modules)) { ?>
                    <li><a href="slide"><?php echo lang('slides'); ?></a></li>
                <?php } ?>
                <?php if (in_array('service', $this->super_modules)) { ?>
                    <li><a href="service"><?php echo lang('services'); ?></a></li>
                <?php } ?>
            </ul>
        </li>
        <?php if (in_array('email', $this->super_modules)) { ?>
            <li class="menu-title" data-key="t-applications">E-mail</li>
            <li>
                <a href="javascript: void(0);" class="has-arrow">
                    <i class="fa fa-mail-bulk icon nav-icon"></i>
                    <span class="menu-item" data-key="t-email"><?php echo lang('email'); ?></span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="email/superadminSendView"><?php echo lang('new'); ?></a></li>
                    <li><a href="email/sent"><?php echo lang('sent'); ?></a></li>

                    <li><a href="email/emailSettings"><?php echo lang('settings'); ?></a></li>
                    <li><a href="email/contactEmailSettings"><?php echo lang('contact'); ?> <?php echo lang('email'); ?></a></li>
                </ul>
            </li>

        <?php } ?>
        <li class="menu-title" data-key="t-applications">Settings</li>
        <li><a href="settings"><i class="fa fa-cog icon nav-icon"></i><span class="menu-item" data-key="t-chat"><?php echo lang('system_settings'); ?></span></a></li>
        <li><a href="settings/googleReCaptcha"><i class="fa fa-cog icon nav-icon"></i><span class="menu-item" data-key="t-chat">Google reCAPTCHA</a></span></li>
        <?php if (in_array('pgateway', $this->super_modules)) { ?>
            <li><a href="pgateway"><i class="fa fa-credit-card icon nav-icon"></i><span class="menu-item" data-key="t-chat"><?php echo lang('payment_gateway'); ?></span></a></li>
        <?php } ?>
        <li><a href="settings/language"><i class="fa fa-language icon nav-icon"></i><span class="menu-item" data-key="t-chat"><?php echo lang('language'); ?></span></a></li>
<?php } ?>
<?php if ($this->ion_auth->in_group(array('admin'))) { ?>
    <li class="menu-title" data-key="t-applications">Logs</li>
    <li>
            <a href="javascript: void(0);" class="has-arrow">
                <i class="fa fa-history icon nav-icon"></i>
                <span class="menu-item" data-key="t-email"><?php echo lang('logs'); ?></span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="transactionLogs"><?php echo lang('transaction_logs'); ?></a></li>
                <li><a href="logs"><?php echo lang('user'); ?> <?php echo lang('login_logs'); ?></a></li>
            </ul>
        </li>
        <li>
        <li class="menu-title" data-key="t-applications">Subscription</li>
        <li>
        <a href="settings/subscription">
            <i class="fa fa-user icon nav-icon"></i>
            <span class="menu-item"> <?php echo lang('subscription'); ?> </span>
        </a>
    </li>
<?php } ?>
<?php if ($this->ion_auth->in_group(array('Doctor'))) { ?>
    <li class="menu-title" data-key="t-applications"><?php echo lang('Zoom Setting'); ?></li>
<li>
    <a href="meeting/settings">
        <i class="fa fa-cog icon nav-icon"></i>
        <span class="menu-item"> <?php echo lang('Zoom Setting'); ?> </span>
    </a>
</li>
    <?php } ?>
<li class="menu-title" data-key="t-applications">Profile</li>
<li>
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
            </div>

            <div class="app-main__outer">
                <div class="app-main__inner">
                    <div class="app-page-title">
                        <div class="page-title-wrapper">
                            <div class="page-title-heading">
                                <div class="page-title-icon">
                                    <a href="<?php echo site_url('admin'); ?>">
                                        <i class="pe-7s-home icon-gradient bg-mean-fruit"></i>
                                    </a>
                                </div>
                                <div>

                                    <div class="page-title-subheading">

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card mb-4">
                            <div class="card-header"><strong>Category</strong></div>
                            <div class="card-body">
                                <form action="https://idea.themesic.com/admin/category/store" method="post"
                                    accept-charset="utf-8">
                                    <input type="hidden" name="csrf_test_name" value="0a3d2de384ebae0a7bb833b609830704">
                                    <div class="tab-content rounded-bottom">
                                        <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-237"
                                            style="width: 100%; overflow: hidden;">
                                            <div class="mb-3">
                                                <label class="form-label">Title</label>
                                                <input class="form-control " type="text" name="title"
                                                    placeholder="Category Title" value="">
                                                <div class="invalid-feedback">
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Description</label>
                                                <input class="form-control " type="text" name="description"
                                                    placeholder="Category Description" value="">
                                                <div class="invalid-feedback">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="p-3">
                                            <button type="submit"
                                                class="mb-2 me-2 btn btn-shadow btn-primary">Save</button>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="app-wrapper-footer">
        <div class="app-footer">
            <div class="app-footer__inner">
                <div class="app-footer-left">
                    <span class="app-sidebar__footer"><a href="https://themesic.com/idea-feedback-management-system"
                            alt="Feedback Management" target="_blank">Idea - Feedback management system</a></li>
                </div>
                <div class="app-footer-right">

                </div>
            </div>
        </div>
    </div>
    <div class="app-drawer-overlay d-none animated fadeIn"></div>
    <script type="text/javascript" src="<?php echo base_url('assets/scripts/toastr.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('/assets/main.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/scripts/jquery.dataTables.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/scripts/dataTables.bootstrap4.min.js'); ?>">
    </script>
    <script type="text/javascript" src="<?php echo base_url('assets/scripts/dataTables.responsive.min.js'); ?>">
    </script>
    <script type="text/javascript" src="<?php echo base_url('assets/scripts/custom.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/highcharts/highcharts.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/highcharts/variable-pie.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/highcharts/export-data.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/highcharts/accessibility.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/highcharts/exporting.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/plugins/highcharts/highcharts-3d.js'); ?>"></script>
    <script>
    "use strict";
    <?php $alertclass = '';
    $session          = session();
    if ($session->getFlashdata('message-success')) {
        $alertclass = 'success';
    } elseif ($session->getFlashdata('message-warning')) {
        $alertclass = 'warning';
    } elseif ($session->getFlashdata('message-info')) {
        $alertclass = 'info';
    } elseif ($session->getFlashdata('message-danger')) {
        $alertclass = 'danger';
    }
    if ($session->getFlashdata('message-'.$alertclass.'')) {
        $tempdata = $session->getFlashdata('message-'.$alertclass.'');
        ?>
    alert_float('<?php echo $alertclass; ?>', "<?php echo $tempdata['title']; ?>",
        '<?php echo $tempdata['message']; ?>');
    <?php
    }
    ?>

    tinymce.init({
        selector: '.editor',
        theme: 'modern',
        height: 200
    });
    </script>

</body>

</html>
<script>
$('.open-right-drawer').on('click', function() {
    $('.app-drawer-wrapper').css('display', 'block')
});
$('.close_server_status_btn').on('click', function() {
    $('.app-drawer-wrapper').css('display', 'none')
})
</script>
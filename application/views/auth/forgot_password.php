<!DOCTYPE html>
<html lang="en">
<?php
$settings = $this->frontend_model->getSettings();
$title = explode(' ', $settings->title);
?>
<head>
    <base href="<?php echo base_url(); ?>">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Klinicx medicare solutions">
    <meta name="author" content="Shaibal Saha">
    <title>Klinicx Medicare Software</title>

    <!-- Favicons-->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="<?php
                                                if (!empty($settings->logo)) {
                                                    if (file_exists($settings->logo)) {
                                                        echo $settings->logo ;
                                                    } else {
                                                        echo $title[0] . '<span> ' . $title[1] . '</span>';
                                                    }
                                                } else {
                                                    echo $title[0] . '<span> ' . $title[1] . '</span>';
                                                }
                                                ?>">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="<?php
                                                if (!empty($settings->logo)) {
                                                    if (file_exists($settings->logo)) {
                                                        echo $settings->logo ;
                                                    } else {
                                                        echo $title[0] . '<span> ' . $title[1] . '</span>';
                                                    }
                                                } else {
                                                    echo $title[0] . '<span> ' . $title[1] . '</span>';
                                                }
                                                ?>">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="<?php
                                                if (!empty($settings->logo)) {
                                                    if (file_exists($settings->logo)) {
                                                        echo $settings->logo ;
                                                    } else {
                                                        echo $title[0] . '<span> ' . $title[1] . '</span>';
                                                    }
                                                } else {
                                                    echo $title[0] . '<span> ' . $title[1] . '</span>';
                                                }
                                                ?>">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="<?php
                                                if (!empty($settings->logo)) {
                                                    if (file_exists($settings->logo)) {
                                                        echo $settings->logo ;
                                                    } else {
                                                        echo $title[0] . '<span> ' . $title[1] . '</span>';
                                                    }
                                                } else {
                                                    echo $title[0] . '<span> ' . $title[1] . '</span>';
                                                }
                                                ?>">

    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- BASE CSS -->
    <link href="common/login/css/bootstrap.min.css" rel="stylesheet">
    <link href="common/login/css/vendors.css" rel="stylesheet">
    <link href="common/login/css/style.css" rel="stylesheet">

    <!-- YOUR CUSTOM CSS -->
    <link href="common/login/css/custom.css" rel="stylesheet">
</head>

<body>
	
	<div id="preloader">
		<div data-loader="circle-side"></div>
	</div><!-- /Preload -->

	<div class="container-fluid">
	    <div class="row row-height">
	        <div class="col-lg-6 background-image p-0" data-background="url(common/login/images/medical.jpg)">
	            <div class="content-left-wrapper opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.6)">
	                <a href="#0" id="logo"><img src="<?php
                                                if (!empty($settings->logo)) {
                                                    if (file_exists($settings->logo)) {
                                                        echo $settings->logo ;
                                                    } else {
                                                        echo $title[0] . '<span> ' . $title[1] . '</span>';
                                                    }
                                                } else {
                                                    echo $title[0] . '<span> ' . $title[1] . '</span>';
                                                }
                                                ?>" alt="" width="46" height="40"></a>
	                <div id="social">
	                    <ul>
	                        <li><a href="<?php echo $settings->facebook_id; ?>"><i class="social_facebook"></i></a></li>
	                        <li><a href="<?php echo $settings->twitter_id; ?>"><i class="social_twitter"></i></a></li>
	                        <!-- <li><a href="#0"><i class="social_instagram"></i></a></li> -->
	                    </ul>
	                </div>
	                <!-- /social -->
	                <div class="text-start">
	                	<small>Enter your email to reset your password</small>
	                    <h1>Klinicx Medicare Software Solutions.</h1>
	                </div>
	            </div>
	        </div>
	        <div class="col-lg-6 d-flex flex-column content-right">
	            <div class="container my-auto py-5">
	                <div class="row">
	                    <div class="col-lg-9 col-xl-7 mx-auto position-relative">
	                        <h4 class="mb-4"><?php echo lang('forgot_password_heading'); ?></h4>
                            <p><?php echo sprintf(lang('forgot_password_subheading'), $identity_label); ?></p>
                            <div id="infoMessage"><?php echo $message; ?></div>
	                        <form class="input_style_2" method="post" action="auth/forgot_password">
	                            <div class="form-group">
	                                <label for="email_address"><?php echo (($type == 'email') ? sprintf(lang('forgot_password_email_label'), $identity_label) : sprintf(lang('forgot_password_identity_label'), $identity_label)); ?></label>
	                                <input type="text" class="form-control" placeholder="<?php echo lang('email'); ?>" value="" name="email">
	                            </div>
	                            <!-- <div class="form-group">
	                                <label for="password">Password</label>
	                                <input type="password" name="password" id="password" class="form-control" autocomplete="on">
	                            </div> -->
	                            <!-- <div class="clearfix mb-3">
	                                <div class="float-start">
	                                    <label class="container_check">Remember Me
	                                        <input type="checkbox">
	                                        <span class="checkmark"></span>
	                                    </label>
	                                </div>
	                                <div class="float-end">
	                                    <a id="forgot" href="javascript:void(0);">Forgot Password?</a>
	                                </div> 
	                            </div> -->
	                            <button type="submit" class="btn_1 full-width">Submit</button>
	                        </form>
	                        <!-- <p class="text-center mt-3 mb-0">Don't have an account? <a href="#0">Sign Up</a></p> -->
	                       
	                    </div>
	                </div>
	            </div>
	            <div class="container pb-3 copy"><?php echo $this->db->get('settings')->row()->system_vendor; ?> © <?php echo date('Y'); ?>  All Rights Reserved.</div>
	        </div>
	    </div>
	    <!-- /row -->
	</div>
	<!-- /container -->
	
	<!-- COMMON SCRIPTS -->
    <script src="common/login/js/common_scripts.js"></script>
	<script src="common/login/js/common_func.js"></script>

</body>
</html>
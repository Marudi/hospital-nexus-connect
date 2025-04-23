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
    <style>
        .background-video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }
        .content-left-wrapper {
            position: relative;
            z-index: 1;
        }
    </style>
</head>

<body>
    
    <div id="preloader">
        <div data-loader="circle-side"></div>
    </div><!-- /Preload -->

    <div class="container-fluid">
        <div class="row row-height">
            <div class="col-lg-6 p-0 position-relative">
                <video class="background-video" autoplay muted loop>
                    <source src="themes/login.mp4" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
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
                                                ?>" alt="" width="130"></a>
                    <div id="social">
                        <ul>
                            <li><a href="<?php echo $settings->facebook_id; ?>"><i class="social_facebook"></i></a></li>
                            <li><a href="<?php echo $settings->twitter_id; ?>"><i class="social_twitter"></i></a></li>
                            <!-- <li><a href="#0"><i class="social_instagram"></i></a></li> -->
                        </ul>
                    </div>
                    <!-- /social -->
                    <div class="text-start">
                        <small>Welcome back</small>
                        <h1>Klinicx Medicare Software Solutions.</h1>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 d-flex flex-column content-right">
                <div class="container my-auto py-5">
                    <div class="row">
                        <div class="col-lg-9 col-xl-7 mx-auto position-relative">
                            <h4 class="mb-4">Login</h4>
                            <form class="input_style_2" method="post" action="auth/login">
                                <div class="form-group">
                                    <label for="email_address">Email Address</label>
                                    <input type="text" name="identity" id="email_address" class="form-control" autofocus>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" id="password" class="form-control" autocomplete="on">
                                </div>
                                <div class="clearfix mb-3">
                                    <div class="float-start">
                                        <label class="container_check">Remember Me
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <input type="hidden" id="g-token" name="g-token" value=''>
                                    <div class="float-end">
                                        <a id="forgot" href="javascript:void(0);">Forgot Password?</a>
                                    </div>
                                </div>
                                <button type="submit" class="btn_1 full-width">Login</button>
                            </form>
                            <!-- <p class="text-center mt-3 mb-0">Don't have an account? <a href="#0">Sign Up</a></p> -->
                            <form class="input_style_2" method="post" action="auth/forgot_password"> 
                                <div id="forgot_pw">
                                    <h4 class="mb-4">Forgot Password</h4>
                                    <div class="form-group">
                                        <label for="email_forgot">Login email</label>
                                        <input type="text" class="form-control" name="email" id="email_forgot">
                                    </div>
                                    <p>You will receive an email containing a link allowing you to reset your password to a new preferred one.</p>
                                    <div class="text-center"><input type="submit" value="Reset Password" class="btn_1"></div>
                                </div>
                            </form>
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
<?php
$googleReCaptchaSiteKey =  $this->settings_model->getGoogleReCaptchaSettings()->site_key_login;
?>
<script src="https://www.google.com/recaptcha/api.js?render=<?php echo $googleReCaptchaSiteKey; ?>"></script>
<script>
    // function onClick(e) {
    //   e.preventDefault();
    grecaptcha.ready(function() {
        grecaptcha.execute('<?php echo $googleReCaptchaSiteKey; ?>', {
            action: 'submit'
        }).then(function(token) {
            document.getElementById("g-token").value = token;
        });
    });
    //  }
</script>
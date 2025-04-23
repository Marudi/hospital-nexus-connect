<!DOCTYPE html>
<html>

<?php
$settings = $this->frontend_model->getSettings();
$title = explode(' ', $settings->title);
?>

<head>
    <base href="<?php echo base_url(); ?>frontend">
    <meta charset="utf-8" />
    <title><?php echo $settings->title; ?></title>
    <meta name="description" content="">
    <meta name="author" content="Rizvi">
    <meta name="keyword" content="Php, Hospital, Clinic, Management, Software, Php, CodeIgniter, Hms, Accounting">
    <meta property="og:type" content="website" />
    <link href="common/css/style.css" rel="stylesheet">
    <link href="common/css/style-responsive.css" rel="stylesheet" />
    <link href="common/css/bootstrap.min.css" rel="stylesheet">
    <link href="common/css/bootstrap-reset.css" rel="stylesheet">
    <link href="common/css/package.css" rel="stylesheet">
    <link href="common/assets/fontawesome5pro/css/all.min.css" rel="stylesheet" />
    <meta content="summary_large_image" name="twitter:card" />
    <link rel="stylesheet" href="common/css/bootstrap-select.min.css">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <link href="front-end/assets/5f16ec24d8bd7908a5d24625/css/partnerstack-1-9.b8e0fab07.min.css" rel="stylesheet" type="text/css" />
    <script src="front-end/ajax/libs/webfont/1.6.26/webfont.js" type="text/javascript"></script>
    <script type="text/javascript">
        WebFont.load({
            google: {
                families: ["Inter:100,200,300,regular,500,700"]
            }
        });
    </script>
    <link href="uploads/favicon.png" rel="shortcut icon" type="image/x-icon" />
    <link href="uploads/favicon.png" rel="apple-touch-icon" />
    <link rel="stylesheet" href="common/css/bootstrap-select-country.min.css">
    <link href="common/extranal/css/frontend/front_end.css" rel="stylesheet">
</head>

<body class="body">
    <div class="w-embed w-iframe">
    </div>
    <div data-collapse="medium" data-animation="default" data-duration="400" data-doc-height="1" role="banner" class="l-nav-section _w-nav w-nav">
        <div class="navigation-banner">
            <div class="text-block-101">
                <span class="text-span-4"><?php echo lang('new'); ?> : </span> <span class="span_color"> <?php echo $settings->block_1_text_under_title; ?> →</span>
            </div>
            <?php if ($settings->google_translation_switch_in_frontend == 'yes') { ?>
                <div class="text-block-101">
                    <a id="google_translate_element"></a>
                </div>
            <?php } ?>

        </div>

        <?php if ($settings->google_translation_switch_in_frontend == 'yes') { ?>
            <div class="text-block-101 lang_top">
                <a id="google_translate_element1"></a>
            </div>
        <?php } ?>

        <div class="l-nav-section__grid w-container">
            <a href="frontend#cover" id="w-node-ebd691a6-3a22-9b70-2dae-f440aac1582d-aac15824" aria-current="page" class="c-nav-logo w-nav-brand w--current w_current_width">
                <?php
                if (!empty($settings->logo)) {
                    if (file_exists($settings->logo)) {
                        echo '<img width="200" src=' . $settings->logo . '>';
                    } else {
                        echo $title[0] . '<span> ' . $title[1] . '</span>';
                    }
                } else {
                    echo $title[0] . '<span> ' . $title[1] . '</span>';
                }
                ?></a>
            <nav role="navigation" id="w-node-ebd691a6-3a22-9b70-2dae-f440aac15826-aac15824" class="c-nav-menu w-nav-menu">
                <a href="frontend#business" class="c-nav-menu__nav-link w-nav-link"><?php echo lang('business'); ?></a>
                <a href="frontend#service" class="c-nav-menu__nav-link w-nav-link"><?php echo lang('service'); ?></a>
                <a href="frontend#package" class="c-nav-menu__nav-link w-nav-link"><?php echo lang('package'); ?></a>
                <a href="frontend#contact" class="c-nav-menu__nav-link w-nav-link"><?php echo lang('contact'); ?></a>

                <?php
                if ($this->ion_auth->logged_in() == '1') {
                    $current_user = $this->ion_auth->get_user_id();
                    $username = $this->db->get_where('users', array('id' => $current_user))->row()->username;
                    $username_explode = explode(' ', $username);
                    if (count($username_explode) > 3) {
                        $username_update = $username_explode[0] . ' ' . $username_explode[1];
                    } else {
                        $username_update = $username;
                    }
                    $link = "home";
                    $link_lang = $username_update;
                } else {
                    $link = "auth/login";
                    $link_lang = lang('login');
                }
                ?>
                <a href="<?php echo $link; ?>" target="_blank" class="c-nav-menu__nav-link mr-s is-login-button w-nav-link"><?php echo $link_lang; ?></a>
                <a href="frontend#book" class="c-button__secondary is--small w-inline-block" data-ix="button-icon">
                    <div class="c-button__text is--purple is--small"><?php echo lang('register_hospital'); ?></div><img src="front-end/assets/5f16ec24d8bd7908a5d24625/5f3d46263a5ec7752b5a63df_Arrow_purple.svg" width="32" height="32" alt="" class="c-button__icon is--small" />
                </a>
                <script type="text/javascript">
                    function googleTranslateElementInit() {
                        if ($(window).width() < 760) {
                            new google.translate.TranslateElement({
                                pageLanguage: 'en'
                            }, 'google_translate_element1');
                        } else {
                            new google.translate.TranslateElement({
                                pageLanguage: 'en'
                            }, 'google_translate_element');
                        }
                    }
                </script>
                <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
                <style>
                    .goog-te-banner-frame.skiptranslate,
                    .goog-te-gadget-icon {
                        display: none !important;
                    }

                    body {
                        top: 0px !important;
                    }

                    .goog-tooltip {
                        display: none !important;
                    }

                    .goog-tooltip:hover {
                        display: none !important;
                    }

                    .goog-text-highlight {
                        background-color: transparent !important;
                        border: none !important;
                        box-shadow: none !important;
                    }

                    .goog-te-gadget .goog-te-combo {
                        float: left;
                        margin: 0px 20px;
                    }

                    .goog-te-gadget .goog-te-combo {
                        margin-top: 2px;
                    }

                    /* .goog-logo-link,
                    .goog-logo-link:link,
                    .goog-logo-link:visited,
                    .goog-logo-link:hover,
                    .goog-logo-link:active {
                        display: none;
                    } */



                    @media screen and (max-width: 760px) {
                        .goog-te-gadget {
                            margin: 10px 0px 0px 15px;
                        }
                    }

                    @media screen and (min-width: 600px) and (max-width: 1700px) {
                        .lang_top {
                            display: none;
                            margin-top: 100px !important;
                        }


                    }
                </style>
            </nav>
            <div id="w-node-ebd691a6-3a22-9b70-2dae-f440aac15835-aac15824" class="c-nav-mobilebutton w-nav-button">
                <div class="c-button__hamburger w-icon-nav-menu"></div>
            </div>
        </div>
    </div>
    <?php
    foreach ($slides as $slide) {
    ?>
        <div class="l-section is--hero" id="cover">
            <div class="w-layout-grid c-hero"><img src="<?php echo $slide->img_url; ?>" loading="lazy" width="595" id="w-node-_0ecfaf60-79bd-5d71-c1f8-96b64e9d0db0-fd5d4922" alt="Illustration of a man sitting at a desk in front of a computer. Dotted lines connect the computer to portraits of different types of partner. " class="c-hero__image" />
                <div id="w-node-_4781c85d-0ce2-032e-fd4d-6f516a5efda1-fd5d4922" class="c-hero__copy">
                    <div id="w-node-_4e4fa717-af22-91dc-7b5b-71872c988dde-fd5d4922" class="c-hero__container w-clearfix">
                        <h1 class="c-heading-1"><?php echo $slide->text1; ?><span class="is--bold is--purple c-heading-1"></span></h1>
                        <p class="c-paragraph is--large"><?php echo $slide->text2; ?></p><a href="frontend#book" class="c-button__primary w-inline-block" data-ix="button-icon">
                            <div class="c-button__text"><?php echo lang('register_hospital'); ?> </div><img src="front-end/assets/5f16ec24d8bd7908a5d24625/5f3d419ec0cff23f8b7b1a45_Arrow_white.svg" width="48" height="48" alt="" class="c-button__icon is--large" />
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
    <div class="l-section is--condensed is--purple l-section__g2">
        <div class="l-grid__general" id="business">
            <div id="w-node-_4b4b5bc8-7f53-fd0d-b339-8472a8992f59-fd5d4922" class="image-container"><img src="<?php echo $settings->market_image; ?>" loading="lazy" class="ps-cust-logos-1 ps-cust-logos-g2" /></div>
            <div id="w-node-_4b4b5bc8-7f53-fd0d-b339-8472a8992f5b-fd5d4922" class="l-container">
                <h2 class="c-heading-2"><?php echo $settings->market_title; ?></h2>
                <p class="c-paragraph is--centermobile"><?php echo $settings->market_description; ?></p>
                <p class="c-paragraph is--centermobile"><?php echo $settings->market_button_link; ?></p>

            </div>
        </div>
        <div class="l-grid__general l-grid__g2quotes">
            <div id="contact-home" class="c-card g2-quote w-node-b0976b4d-0227-4222-d266-5fd411407afe-fd5d4922">
                <div class="w-layout-grid grid">
                    <p id="w-node-_6d3b6b66-9927-6ba5-f997-f97dd56ef33b-fd5d4922" class="c-paragraph is--centermobile">
                        <?php echo $settings->comment_1; ?>
                    </p>
                    <p id="w-node-_83b66fe7-4a72-a4be-93ae-5a569d3218d5-fd5d4922" class="c-paragraph is--small is--hidden"><span class="text-span-3">✓</span> <?php echo $settings->verified_1; ?></p><img src="<?php echo $settings->comment_logo_1; ?>" loading="lazy" id="w-node-_8f52ba6a-f2cf-0dbc-cd77-edc6e0e999cf-fd5d4922" alt="" class="g2-quote-stars" />
                </div>
            </div>
            <div id="contact-home" class="c-card g2-quote hidden-mobile w-node-_34a9e484-6736-d378-28a4-c2afe1ee68b0-fd5d4922">
                <div class="w-layout-grid grid">
                    <p id="w-node-_34a9e484-6736-d378-28a4-c2afe1ee68b2-fd5d4922" class="c-paragraph is--centermobile">
                        <?php echo $settings->comment_2; ?></p>
                    <p id="w-node-bc56b118-a6c9-8bb4-437b-44aa020473c2-fd5d4922" class="c-paragraph is--small is--hidden"><span class="text-span-3">✓</span> <?php echo $settings->verified_2; ?></p><img src="<?php echo $settings->comment_logo_2; ?>" loading="lazy" id="w-node-_34a9e484-6736-d378-28a4-c2afe1ee68b9-fd5d4922" alt="" class="g2-quote-stars" />
                </div>
            </div>
        </div>

        <div id="partnership" class="l-section l-section__features">
            <div class="l-grid__general is--header">
                <div id="w-node-_65f7d3db-7a0b-4f9d-ff9c-765262361b7c-fd5d4922" class="l-container">
                    <h2 class="c-heading-2 is--center"><?php echo $settings->partner_header_title; ?></h2>
                    <p class="c-paragraph is--center"><?php echo $settings->partner_header_description; ?></p>
                </div>
            </div>
            <div class="c-feature">
                <div id="w-node-fcb4e341-1204-6009-c631-5a47abd368ac-fd5d4922" class="l-container">
                    <h3 class="c-heading-3"><?php echo $settings->section_title_1; ?></h3>
                    <p class="c-paragraph"><?php echo $settings->section_description_1; ?></p>
                    <ul role="list" class="c-list">
                        <li class="c-list__item is--yellow">
                            <p class="c-paragraph"><?php echo $settings->section_1_text_1; ?></p>
                        </li>
                        <li class="c-list__item is--yellow">
                            <p class="c-paragraph"><?php echo $settings->section_1_text_2; ?></p>
                        </li>
                        <li class="c-list__item is--yellow">
                            <p class="c-paragraph"><?php echo $settings->section_1_text_3; ?></p>
                        </li>
                    </ul>
                </div>
                <img src="<?php echo $settings->partner_image_1; ?>" loading="lazy" alt="illustration of channel UI " data-w-id="0146308e-05a6-6206-6134-03da43d54c80" id="w-node-_0146308e-05a6-6206-6134-03da43d54c80-fd5d4922" class="c-feature__image" />
            </div>
            <div class="c-feature">
                <img src="<?php echo $settings->partner_image_2; ?>" loading="lazy" alt="illustration of partner performance UI" data-w-id="96290585-20fc-d856-5f18-33e990a296aa c_feature_image" id="w-node-_96290585-20fc-d856-5f18-33e990a296aa-fd5d4922" class="c-feature__image is--right" />
                <div id="w-node-_217040ba-6072-dc75-af0e-fccc7ea8b482-fd5d4922" class="l-container">
                    <h3 class="c-heading-3"><?php echo $settings->section_title_2; ?></h3>
                    <p class="c-paragraph"><?php echo $settings->section_description_2; ?></p>
                    <ul role="list" class="c-list">
                        <li class="c-list__item is--blue">
                            <p class="c-paragraph"><?php echo $settings->section_2_text_1; ?></p>
                        </li>
                        <li class="c-list__item is--blue">
                            <p class="c-paragraph"><?php echo $settings->section_2_text_2; ?></p>
                        </li>
                        <li class="c-list__item is--blue">
                            <p class="c-paragraph"><?php echo $settings->section_2_text_3; ?></p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="c-feature is--last">
                <div id="w-node-_99e8e674-4f4a-e3ea-3923-7b4b889e8b76-fd5d4922" class="l-container">
                    <h3 class="c-heading-3"><?php echo $settings->section_title_3; ?></h3>
                    <p class="c-paragraph"><?php echo $settings->section_description_3; ?></p>
                    <ul role="list" class="c-list">
                        <li class="c-list__item is--orange">
                            <p class="c-paragraph"><?php echo $settings->section_3_text_1; ?></p>
                        </li>
                        <li class="c-list__item is--orange">
                            <p class="c-paragraph"><?php echo $settings->section_3_text_2; ?></p>
                        </li>
                        <li class="c-list__item is--orange">
                            <p class="c-paragraph"><?php echo $settings->section_3_text_3; ?></p>
                        </li>
                    </ul>
                </div>
                <img src="<?php echo $settings->partner_image_3; ?>" loading="lazy" alt="illustration of payout&#x27;s UI" data-w-id="0c959c90-d9b0-390a-e2d2-06e1a0359692" id="w-node-_0c959c90-d9b0-390a-e2d2-06e1a0359692-fd5d4922" class="c-feature__image" />
            </div>
        </div>
        <div class="l-section is--purple" id="service">
            <div class="row service_div">
                <div class="row">
                    <div class="row">

                        <div class="l-grid__general is--header">
                            <div id="w-node-_65f7d3db-7a0b-4f9d-ff9c-765262361b7c-fd5d4922" class="l-container">
                                <h2 class="c-heading-2 is--center"> <?php echo lang('our_service'); ?></h2>
                                <p class="c-paragraph is--center"><?php echo $settings->service_block__text_under_title; ?></p>
                            </div>
                        </div>
                        <?php foreach ($services as $service) { ?>
                            <div class="col-lg-4 col-sm-6">
                                <div class="content content_div">
                                    <span class="clearfix"><img class="img_style" src="<?php
                                                                                        if (!empty($service->img_url)) {
                                                                                            echo $service->img_url;
                                                                                        } else {
                                                                                            echo 'uploads/default-image.png';
                                                                                        }
                                                                                        ?>"></span>
                                    <h3 class="title"><?php echo $service->title; ?></h3>
                                    <p><?php echo $service->description; ?></p>
                                </div>
                            </div>

                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="l-section" id="book">




            <div id="foorm">
                <h2 class="c-heading-2 is--center"> <?php echo $settings->registration_block_text; ?></h2>
                <div id="msg">
                    <?php
                    $message1 = $this->session->flashdata('feedback');
                    if (!empty($hospital_message)) {
                        //                        if ($message1 == 'yes') {
                        //                            $message = lang('new_hospital_created');
                        //                        } else {
                        //                            $message = $message1;
                        //                        }
                    ?>
                        <h2 class="c-heading-2 is--center h2_heading"> <?php echo lang($hospital_message); ?></h2>
                    <?php } ?>
                </div>
            </div>

            <div class="w-embed w-script">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <form action="frontend/addNewHospitalPayment" class="clearfix" id="addNewHospital" enctype="multipart/form-data" method="POST">
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"> <?php echo lang('hospital'); ?> <?php echo lang('name'); ?> &ast;</label>
                            <input type="text" class="form-control" name="name" value='' placeholder="" required="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"> <?php echo lang('hospital'); ?> <?php echo lang('address'); ?> &ast;</label>
                            <input type="text" class="form-control" name="address" value='' placeholder="" required="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"> <span><?php echo lang('hospital'); ?> <?php echo lang('email'); ?> &ast;</span></label>
                            <input type="email" class="form-control" name="email" value='' placeholder="" required="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"> <?php echo lang('hospital'); ?> <?php echo lang('phone'); ?> &ast;</label>
                            <input type="number" class="form-control" name="phone" value='' placeholder="" required="">
                        </div>


                        <div class="form-group col-md-6 package_select_div">
                            <label for="exampleInputEmail1"> <?php echo lang('package'); ?> &ast;</label>
                            <select class="form-control  js-example-basic-single" id="package_select" name="package" value='' required>
                                <option><?php echo lang('select'); ?></option>
                                <?php foreach ($packages as $package) { ?>
                                    <option value="<?php echo $package->id; ?>"><?php echo $package->name; ?> </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6 package_duration_div">
                            <label for="exampleInputEmail1"> <?php echo lang('package_duration'); ?> &ast;</label>
                            <select class="form-control js-example-basic-single" id="package_duration" name="package_duration" value='' required="">

                                <option value="<?php echo 'monthly'; ?>"><?php echo lang('monthly'); ?> </option>
                                <option value="<?php echo 'yearly'; ?>"><?php echo lang('yearly'); ?> </option>

                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"> <?php echo lang('language'); ?> &ast;</label>
                            <select class="form-control m-bot15" name="language" value='' required="">
                                <option value="arabic" <?php
                                                        if (!empty($settings->language)) {
                                                            if ($settings->language == 'arabic') {
                                                                echo 'selected';
                                                            }
                                                        }
                                                        ?>><?php echo lang('arabic'); ?>
                                </option>
                                <option value="english" <?php
                                                        if (!empty($settings->language)) {
                                                            if ($settings->language == 'english') {
                                                                echo 'selected';
                                                            }
                                                        }
                                                        ?>selected><?php echo lang('english'); ?>
                                </option>
                                <option value="spanish" <?php
                                                        if (!empty($settings->language)) {
                                                            if ($settings->language == 'spanish') {
                                                                echo 'selected';
                                                            }
                                                        }
                                                        ?>><?php echo lang('spanish'); ?>
                                </option>
                                <option value="french" <?php
                                                        if (!empty($settings->language)) {
                                                            if ($settings->language == 'french') {
                                                                echo 'selected';
                                                            }
                                                        }
                                                        ?>><?php echo lang('french'); ?>
                                </option>
                                <option value="italian" <?php
                                                        if (!empty($settings->language)) {
                                                            if ($settings->language == 'italian') {
                                                                echo 'selected';
                                                            }
                                                        }
                                                        ?>><?php echo lang('italian'); ?>
                                </option>
                                <option value="portuguese" <?php
                                                            if (!empty($settings->language)) {
                                                                if ($settings->language == 'portuguese') {
                                                                    echo 'selected';
                                                                }
                                                            }
                                                            ?>><?php echo lang('portuguese'); ?>
                                </option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"> <?php echo lang('price'); ?> &ast;</label>
                            <input type="text" class="form-control price-input" name="price" value='' placeholder="" readonly="" required="">
                        </div>
                        <div class="form-group col-md-12">
                            <div class="col-md-6 country_div">
                                <label for="exampleInputEmail1"> <?php echo lang('country'); ?> &ast;</label>
                                <select class="form-control selectpicker countrypicker" data-live-search="true" data-flag="true" required="" name="country"></select>
                            </div>
                            <div class="col-md-6 remark_div">
                                <label for="exampleInputEmail1"> <?php echo lang('remarks'); ?> &ast;</label>
                                <input type="text" class="form-control" name="remarks" value='' placeholder="" required="">
                            </div>
                        </div>


                        <div class="payment_div">
                            <?php
                            $payment_gateway = $settings1->payment_gateway;
                            if ($payment_gateway == 'PayPal') {
                            ?>

                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1"> <?php echo lang('card'); ?></label>
                                    <select class="form-control  js-example-basic-single" name="card_type" value=''>

                                        <option value="Mastercard"> <?php echo lang('mastercard'); ?> </option>
                                        <option value="Visa"> <?php echo lang('visa'); ?> </option>
                                        <option value="American Express"> <?php echo lang('american_express'); ?> </option>

                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1"> <?php echo lang('cardholder'); ?> <?php echo lang('name'); ?></label>
                                    <input type="text" class="form-control" name="cardholder" value='' placeholder="">
                                </div>

                            <?php } ?>
                            <?php if ($payment_gateway != 'Pay U Money' && $payment_gateway != 'Paystack') { ?>


                                <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1"> <?php echo lang('card'); ?> <?php echo lang('number'); ?></label>
                                    <input type="text" class="form-control" id="card" name="card_number" value='' placeholder="">
                                </div>


                                <div class="form-group col-md-3">
                                    <label for="exampleInputEmail1"> <?php echo lang('expire'); ?> <?php echo lang('date'); ?></label>
                                    <input type="text" class="form-control" id="expire" data-date="" data-date-format="MM YY" placeholder="Expiry (MM/YY)" name="expire_date" maxlength="7" aria-describedby="basic-addon1" value='' placeholder="" required="">
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="exampleInputEmail1"> <?php echo lang('cvv'); ?></label>
                                    <input type="text" class="form-control" id="cvv" name="cvv_number" value="" placeholder="" maxlength="3" required="">
                                </div>

                            <?php
                            }
                            ?>
                        </div>
                        <div id="token"></div>
                        <div class="col-md-12 form-group trial_version_div_div">
                            <input type="checkbox" name="trial_version" value="1" class="trial_version">
                            <label class="trial_version" for="exampleInputEmail1"><?php echo lang('do_you_want_trial_version'); ?></label>
                        </div>
                        <input type="hidden" name="request" value=''>


                        <button type="submit" value="submit" class="btn btn-info btn-group pull-center pull submit_button" id="submit-btn" <?php if ($settings1->payment_gateway == 'Stripe') {
                                                                                                                                            ?>onClick="stripePay(event);" <?php }
                                                                                                                                                                            ?>> <?php echo lang('submit'); ?></button>
                    </form>

                </div>

                <div class="col-md-2"></div>

            </div>

        </div>


        <div class="c-footercta" id="package">
            <div class="">

                <div class="l-grid__general is--header">
                    <div id="w-node-_65f7d3db-7a0b-4f9d-ff9c-765262361b7c-fd5d4922" class="l-container l_container">
                        <h2 class="c-heading-2 is--center"> <?php echo lang('our_package'); ?></h2>
                        <p class="c-paragraph is--center"><?php echo $settings->doctor_block__text_under_title; ?></p>
                    </div>
                </div>



                <div class="cd-pricing-switcher" id="fieldset_p">
                    <p class="fieldset">
                        <input type="radio" name="duration-1" class="duration" value="monthly" id="monthly-1" checked="">
                        <label class="monthly_text" for="monthly-1"><?php echo lang('monthly'); ?></label>
                        <input type="radio" name="duration-1" class="duration" value="yearly" id="yearly-1">
                        <label class="yearly_text" for="yearly-1"><?php echo lang('yearly'); ?></label>
                        <span class="cd-switch"></span>
                    </p>
                </div>

                <div class="package-container">
                    <?php
                    foreach ($packages as $package) {
                        $all_packages[] = $package;
                    }
                    $modules_list = ['accountant', 'appointment', 'lab', 'bed', 'department', 'donor', 'finance', 'pharmacy', 'laboratorist', 'medicine', 'nurse', 'patient', 'pharmacist', 'prescription', 'receptionist', 'report', 'notice', 'email', 'sms', 'file', 'payroll', 'attendance', 'leave', 'chat'];

                    //   $packages1 = ksort($all_packages);
                    if (!empty($all_packages)) {
                        foreach ($all_packages as $package1) {
                            if ($package1->show_in_frontend == 'Yes') {
                    ?>
                                <div class="col-lg-4 col-sm-4 package_div">
                                    <div class="pricing-table">
                                        <div class="pricing-head">
                                            <h1 <?php if ($package1->recommended == 'Yes') { ?> class="recommended_div" <?php } else { ?> class="recommended_div1" <?php } ?>> <?php echo $package1->name; ?> </h1>
                                            <h2 class="text1"> <span class="note"><?php echo $settings1->currency; ?></span><?php echo $package1->monthly_price; ?> </h2>
                                            <h2 class="text2 hidden"> <span class="note"><?php echo $settings1->currency; ?></span><?php echo $package1->yearly_price; ?> </h2>


                                        </div>
                                        <?php $modules = explode(',', $package1->module);
                                        ?>
                                        <ul class="list-unstyled">
                                            <?php
                                            for ($i = 0; $i < count($modules_list); $i++) {


                                                if (in_array($modules_list[$i], $modules)) {
                                            ?>

                                                    <li class="li_list"><i class="fa fa-check"></i> <?php echo $modules_list[$i]; ?> </li>
                                                <?php } else { ?>
                                                    <li class="li_list"><i class="fa fa-times"></i> <?php echo $modules_list[$i]; ?> </li>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </ul>
                                        <div class="price-actions">
                                            <a id="appointment" class="btn" href="frontend#foorm"><?php echo lang('get_now'); ?></a>
                                        </div>
                                    </div>
                                </div>
                    <?php
                            }
                        }
                    }
                    ?>
                </div>


            </div>
        </div>



        <div class="l-section is--partnerships" id="team">
            <div class="l-grid__general">
                <div id="w-node-dc6d6587-dc91-094d-f21a-04d2bc4c8090-fd5d4922" class="l-container">
                    <h2 class="c-heading-2"><?php echo $settings->team_title; ?></h2>
                    <p class="c-paragraph is--centermobile"><?php echo $settings->team_description; ?><br /></p>
                    <a href="frontend#book" class="c-button__secondary extra--space w-inline-block" data-ix="button-icon">
                        <div class="c-button__text is--purple"><?php echo lang('register_hospital'); ?> <?php echo lang('now'); ?></div><img src="front-end/assets/5f16ec24d8bd7908a5d24625/5f3d46263a5ec7752b5a63df_Arrow_purple.svg" width="32" height="32" alt="" class="c-button__icon is--large" />
                    </a>
                </div>

                <div id="w-node-_3d519ce2-0b41-21a9-a84a-aeb7e9fbb872-fd5d4922" class="cs-quote c-card c-card-mp">
                    <div>
                        <p class="c-quote__text is--center"><?php echo $settings->team_comment; ?></p>
                        <div class="g2-stars-link">
                            <p class="c-paragraph is--small is--hidden"><span class="text-span-3">✓</span> <?php echo $settings->team_verified; ?></p>
                            <img src="<?php echo $settings->team_commentator_image; ?>" loading="lazy" alt="" class="image-7" />
                        </div>
                    </div>
                </div>
                <div id="w-node-_86c0b435-72b0-dbc6-df01-3314eb98eefd-fd5d4922" class="c-quote__author__name c-quote__cs"><span class="text-span-2">
                        <?php echo $settings->team_commentator_name; ?></span>
                    <?php echo $settings->team_commentator_designation; ?>
                </div>
            </div>
        </div>



        <div class="l-section is--purple" id="contact">

            <div class="c-card has--form c-card--grid w-node-c71cea45-70e2-8624-fb11-9021034f21fa-d3ca4708">

                <h2 class="c-heading-2 is--center"> <?php echo $settings->contact_us; ?></h2>


                <div id="msg">
                    <?php
                    $message = $this->session->flashdata('feedback');
                    if (!empty($contact_message)) {
                        if ($contact_message == 'success') {
                    ?>
                            <h2 class="c-heading-2 is--center h2_heading"> <?php echo lang('request_sent_successfully'); ?></h2>
                        <?php } else {
                        ?>
                            <h2 class="c-heading-2 is--center h2_heading"> <?php echo lang('not_sent'); ?></h2>

                    <?php
                        }
                    }
                    ?>
                </div>



                <div class="w-embed w-script">
                    <div class="hbspt-form" id="hbspt-form-1623741844431-9103338542">
                        <form action="frontend/send" id="sendEmail" enctype="multipart/form-data" method="POST" class="hs-form stacked hs-form-private hsForm_93389280-7d5f-4a00-a4a2-6b177ad9e886 hs-form-93389280-7d5f-4a00-a4a2-6b177ad9e886 hs-form-93389280-7d5f-4a00-a4a2-6b177ad9e886_568798ab-3c3f-4cfe-9689-3eba2e30f0f0" data-form-id="93389280-7d5f-4a00-a4a2-6b177ad9e886" data-portal-id="7012252" data-reactid=".hbspt-forms-0">
                            <fieldset class="col-md-12">
                                <div class="col-md-6">
                                    <label id="label-lastname-93389280-7d5f-4a00-a4a2-6b177ad9e886">
                                        <span> <?php echo lang('name'); ?> &ast;</span>
                                        <span class="hs-form-required">*</span></label>
                                    <legend class="hs-field-desc hs_field_desc"></legend>
                                    <div class="input">
                                        <input class="hs-input" type="text" name="name" value="" placeholder="" inputmode="text" required="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label id="label-lastname-93389280-7d5f-4a00-a4a2-6b177ad9e886">
                                        <span> <?php echo lang('email'); ?> &ast;</span>
                                        <span class="hs-form-required">*</span></label>
                                    <legend class="hs-field-desc hs_field_desc"></legend>
                                    <div class="input">
                                        <input class="hs-input" type="email" name="other_email" value="" placeholder="" inputmode="text" required>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset class="col-md-12">
                                <div class="col-md-6">
                                    <label id="label-lastname-93389280-7d5f-4a00-a4a2-6b177ad9e886">
                                        <span> <?php echo lang('phone'); ?> &ast;</span>
                                        <span class="hs-form-required">*</span></label>
                                    <legend class="hs-field-desc hs_field_desc"></legend>
                                    <div class="input">
                                        <input class="hs-input" type="number" name="phone" value="" placeholder="" inputmode="text" required="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label id="label-lastname-93389280-7d5f-4a00-a4a2-6b177ad9e886">
                                        <span> <?php echo lang('hospital'); ?> <?php echo lang('name'); ?> &ast;</span>
                                        <span class="hs-form-required">*</span></label>
                                    <legend class="hs-field-desc hs_field_desc"></legend>
                                    <div class="input">
                                        <input class="hs-input" type="text" name="hospital_name" value="" placeholder="" inputmode="text" required="">
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset class="col-md-12">
                                <div class="col-md-12">
                                    <label id="label-lastname-93389280-7d5f-4a00-a4a2-6b177ad9e886">
                                        <span><?php echo lang('message'); ?></span>
                                        <span class="hs-form-required">*</span></label>
                                    <legend class="hs-field-desc hs_field_desc"></legend>
                                    <div class="input">
                                        <textarea class="form-control" name="msg" value="" style="height: 140px !important; width: 100%;">  </textarea>
                                    </div>
                                </div>
                            </fieldset>
                            <input type="hidden" name="request" value=''>
                            <input type="hidden" id="g-token" name="g-token" value=''>
                            <div class="form-group">
                                <button type="submit" name="submit" class="btn btn-info btn-group pull-center sub submit_button"> <?php echo lang('submit'); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        <div class="l-footer">
            <div class="l-section is--footer">
                <div class="l-grid__general">

                    <a id="w-node-_4089167e-76e8-9def-ac74-3faa82bcf21d-2df6d2bd" aria-current="page" class="c-nav-logo w-nav-brand w--current w_current_width"><?php
                                                                                                                                                                if (!empty($settings->logo)) {
                                                                                                                                                                    if (file_exists($settings->logo)) {
                                                                                                                                                                        echo '<img width="200" src=' . $settings->logo . '>';
                                                                                                                                                                    } else {
                                                                                                                                                                        echo $title[0] . '<span> ' . $title[1] . '</span>';
                                                                                                                                                                    }
                                                                                                                                                                } else {
                                                                                                                                                                    echo $title[0] . '<span> ' . $title[1] . '</span>';
                                                                                                                                                                }
                                                                                                                                                                ?>

                        <li class="c-footer-list-item">
                            <div class="footer_left"><?php echo lang('email'); ?>: <?php echo $settings->email; ?></div>
                            <div class="footer_left"><?php echo lang('phone'); ?>: <?php echo $settings->phone; ?></div>
                            <div class="footer_left"><?php echo lang('address'); ?>: <?php echo $settings->address; ?></div>
                        </li>

                    </a>




                    <ul id="w-node-_74a72201-6d63-7a78-a5cf-c130da42b5c8-2df6d2bd" role="list" class="c-footer-list w-list-unstyled">
                        <li class="c-footer-heading">
                            <div class="text-block"><?php echo lang('general'); ?></div>
                        </li>
                        <li class="c-footer-list-item">
                            <a href="frontend#business" class="c-footer-menu__nav-link"><?php echo lang('business'); ?></a>
                            <a href="frontend#service" class="c-footer-menu__nav-link"><?php echo lang('service'); ?></a>

                            <a href="frontend#package" class="c-footer-menu__nav-link"><?php echo lang('package'); ?></a>
                            <a href="frontend#contact" class="c-footer-menu__nav-link"><?php echo lang('contact'); ?> </a>
                            <a href="frontend#book" class="c-footer-menu__nav-link"><?php echo lang('register_hospital'); ?> </a>
                        </li>
                    </ul>
                    <ul id="w-node-fc700cf1-12f3-3b80-fcc9-a265950b4a6d-2df6d2bd" role="list" class="c-footer-list w-list-unstyled">
                        <li class="c-footer-heading">
                            <div class="text-block"><?php echo lang('social_media'); ?></div>
                        </li>
                        <li class="c-footer-list-item">
                            <a href="<?php echo $settings->facebook_id; ?>" target="_blank" class="c-footer-menu__nav-link"><?php echo lang('facebook'); ?></a>
                            <a href="<?php echo $settings->twitter_id; ?>" target="_blank" class="c-footer-menu__nav-link"><?php echo lang('twitter'); ?></a>
                            <a href="<?php echo $settings->youtube_id; ?>" target="_blank" class="c-footer-menu__nav-link"><?php echo lang('youtube'); ?></a>
                            <a href="<?php echo $settings->google_id; ?>" target="_blank" class="c-footer-menu__nav-link"><?php echo lang('google'); ?></a>
                            <a href="<?php echo $settings->skype_id; ?>" target="_blank" class="c-footer-menu__nav-link"><?php echo lang('skype'); ?></a>
                        </li>
                    </ul>
                    <ul id="w-node-ac13c2de-2c06-f989-2891-b3a51b6647d8-2df6d2bd" role="list" class="c-footer-list w-list-unstyled">

                        <li class="c-footer-list-item">
                            <a href="frontend#book" class="c-button__primary w-inline-block" data-ix="button-icon">
                                <div class="c-button__text"><?php echo lang('register_hospital'); ?> </div>
                                <img src="front-end/assets/5f16ec24d8bd7908a5d24625/5f3d419ec0cff23f8b7b1a45_Arrow_white.svg" width="48" height="48" alt="" class="c-button__icon is--large" />
                            </a>
                        </li>
                    </ul>

                </div>
            </div>
        </div>
        <footer class="site-footer">
            <div class="text-center">
                <?php echo date('Y'); ?> &copy; <?php echo $this->db->get('settings')->row()->system_vendor; ?>

            </div>

        </footer>

        <!-- <div data-collapse="medium" data-animation="default" data-duration="400" data-doc-height="1" role="banner" class="l-nav-section _w-nav w-nav">
            <div class="navigation-banner">
                <div class="text-block-101">
                    <span class="text-span-4"><?php echo lang('new'); ?>:</span> <span class="span_color"> <?php echo $settings->block_1_text_under_title; ?> →</span>
                </div>
                <?php if ($settings->google_translation_switch_in_frontend == 'yes') { ?>
                    <div class="text-block-101">
                        <a id="google_translate_element"></a> 
                    </div>
                <?php } ?> 

            </div>
            <div class="l-nav-section__grid w-container">
                <a href="frontend#cover" id="w-node-ebd691a6-3a22-9b70-2dae-f440aac1582d-aac15824" aria-current="page" class="c-nav-logo w-nav-brand w--current w_current_width"><?php
                                                                                                                                                                                    if (!empty($settings->logo)) {
                                                                                                                                                                                        if (file_exists($settings->logo)) {
                                                                                                                                                                                            echo '<img width="200" src=' . $settings->logo . '>';
                                                                                                                                                                                        } else {
                                                                                                                                                                                            echo $title[0] . '<span> ' . $title[1] . '</span>';
                                                                                                                                                                                        }
                                                                                                                                                                                    } else {
                                                                                                                                                                                        echo $title[0] . '<span> ' . $title[1] . '</span>';
                                                                                                                                                                                    }
                                                                                                                                                                                    ?></a>
                <nav role="navigation" id="w-node-ebd691a6-3a22-9b70-2dae-f440aac15826-aac15824" class="c-nav-menu w-nav-menu">

                    <a href="frontend#business" class="c-nav-menu__nav-link w-nav-link"><?php echo lang('business'); ?></a>
                    <a href="frontend#service" class="c-nav-menu__nav-link w-nav-link"><?php echo lang('service'); ?></a>


                    <a href="frontend#package" class="c-nav-menu__nav-link w-nav-link"><?php echo lang('package'); ?></a>
                    <a href="frontend#contact" class="c-nav-menu__nav-link w-nav-link"><?php echo lang('contact'); ?> </a>
                    <a href="<?php echo $link; ?>" target="_blank" class="c-nav-menu__nav-link mr-s is-login-button w-nav-link"><?php echo $link_lang; ?></a>
                    <a href="frontend#book" class="c-button__secondary is--small w-inline-block" data-ix="button-icon">
                        <div class="c-button__text is--purple is--small"><?php echo lang('register_hospital'); ?> </div><img src="front-end/assets/5f16ec24d8bd7908a5d24625/5f3d46263a5ec7752b5a63df_Arrow_purple.svg" width="32" height="32" alt="" class="c-button__icon is--small" />
                    </a>
                </nav>
                <div id="w-node-ebd691a6-3a22-9b70-2dae-f440aac15835-aac15824" class="c-nav-mobilebutton w-nav-button">
                    <div class="c-button__hamburger w-icon-nav-menu"></div>
                </div>
            </div>
        </div> -->
        <script src="front-end/assets/js/jquery-3.5.1.min.dc5e7f18c85de7.js?site=5f16ec24d8bd7908a5d24625" type="text/javascript" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script src="front-end/assets/5f16ec24d8bd7908a5d24625/js/partnerstack-1-9.6849d928e.js" type="text/javascript"></script>

        <script src="common/js/bootstrap.min.js"></script>
        <script src="common/js/bootstrap-select.min.js"></script>

        <script src="common/js/bootstrap-select-country.min.js"></script>

</body>

</html>

<script type="text/javascript" src="common/assets/ckeditor/ckeditor.js"></script>
<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
    var payment_gateway = "<?php echo $settings1->payment_gateway; ?>";
</script>
<script type="text/javascript">
    var publish = "<?php echo $gateway->publish; ?>";
</script>
<script src="common/extranal/js/frontend/front_end.js"></script>
<?php if (!empty($settings->chat_js)) { ?>
    <script type="text/javascript">
        var chat_js = '<?php echo trim($settings->chat_js); ?>';
    </script>
    <script src="common/extranal/js/frontend/chat_js.js"></script>
    <!--End of Tawk.to Script-->
<?php } ?>

<?php
$googleReCaptchaSiteKey =  $this->settings_model->getGoogleReCaptchaSettings()->site_key;
?>
<script src="https://www.google.com/recaptcha/api.js?render=<?php echo $googleReCaptchaSiteKey; ?>"></script>
      <script>
    // function onClick(e) {
    //   e.preventDefault();
    grecaptcha.ready(function() {
        grecaptcha.execute('<?php echo $googleReCaptchaSiteKey; ?>', {
            action: 'submit'
        }).then(function(token) {
            document.getElementById("recaptchaResponse").value = token;
        });
    });
    //  }
    </script>
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
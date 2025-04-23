<!DOCTYPE html>
<html lang="en-US" class="scheme_original">
<?php
$settings = $this->frontend_model->getSettings();
$title = explode(' ', $settings->title);
?>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="uploads/fav_icon.jpeg">
    <title><?php echo 'Klinicx medicare solution'; ?></title>
    <link href="common/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="common/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="common/css/bootstrap-select-country.min.css" type='text/css' media='all'>

    <link rel='stylesheet' href='front/assets_new/css/animations.css' type='text/css' media='all' />
    <link rel='stylesheet'
        href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700|Lora:400,400i,700,700i|Merriweather:300,300i,400,400i,700,700i,900,900i|Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i|Poppins:300,400,500,600,700|Raleway:100,200,300,400,500,600,700,800,900&amp;subset=latin-ext'
        type='text/css' media='all'>
    <link rel='stylesheet' href='front/assets_new/js/vendor/revslider/settings.css' type='text/css' media='all' />
    <link rel='stylesheet' href='front/assets_new/css/fontello/css/fontello.css' type='text/css' media='all' />
    <link rel='stylesheet' href='front/assets_new/css/style.css' type='text/css' media='all' />
    <link rel='stylesheet' href='front/assets_new/css/core.animation.css' type='text/css' media='all' />
    <link rel='stylesheet' href='front/assets_new/css/shortcodes.css' type='text/css' media='all' />
    <link rel='stylesheet' href='front/assets_new/css/skin.css' type='text/css' media='all' />
    <link rel='stylesheet' href='front/assets_new/css/custom-style.css' type='text/css' media='all' />
    <link rel='stylesheet' href='front/assets_new/css/responsive.css' type='text/css' media='all' />
    <link rel='stylesheet' href='front/assets_new/css/skin.responsive.css' type='text/css' media='all' />
    <link rel='stylesheet' href='front/assets_new/js/vendor/comp/comp.min.css' type='text/css' media='all' />
    <link rel='stylesheet' href='front/assets_new/css/custom.css' type='text/css' media='all' />
    <link rel='stylesheet' href='front/assets_new/css/core.messages.css' type='text/css' media='all' />
    <link rel='stylesheet' href='front/assets_new/js/vendor/swiper/swiper.min.css' type='text/css' media='all' />
<link rel="stylesheet" href="themes/assets/css/lightgallery.min.css" />
</head>
<style>
@media (min-width: 1200px) {
    .col-lg-4 {
        width: 32.333333% !important;
    }
}
</style>

<body
    class="home2 page body_style_wide body_filled article_style_stretch scheme_original top_panel_show top_panel_above sidebar_hide sidebar_outer_hide vc_responsive">
    <a id="toc_home" class="sc_anchor" title="Home"
        data-description="&lt;i&gt;Return to Home&lt;/i&gt; - &lt;br&gt;navigate to home page of the site"
        data-icon="icon-home" data-url="index.html" data-separator="yes"></a>
    <a id="toc_top" class="sc_anchor" title="To Top"
        data-description="&lt;i&gt;Back to top&lt;/i&gt; - &lt;br&gt;scroll to top of the page"
        data-icon="icon-double-up" data-url="" data-separator="yes"></a>
    <div class="body_wrap">
        <div class="page_wrap">
            <div class="top_panel_fixed_wrap"></div>
            <header class="top_panel_wrap top_panel_style_3 scheme_original">
                <div class="top_panel_wrap_inner top_panel_inner_style_3 top_panel_position_above">
                    <div class="top_panel_top">
                        <div class="content_wrap clearfix">
                            <div class="top_panel_top_contact_area icon-mobile-light">
                                Emergency: <strong><?php echo $settings->emergency; ?></strong>
                            </div>
                            <div class="top_panel_top_open_hours icon-calendar-light">Mn - St: <strong>8:00am -
                                    9:00pm</strong> Sn: Closed</div>
                            <div class="top_panel_top_user_area">
                                <div class="top_panel_top_socials">
                                    <div
                                        class="sc_socials sc_socials_type_icons sc_socials_shape_square sc_socials_size_tiny">
                                        <?php if(!empty($settings->twitter_id)){ ?>
                                        <div class="sc_socials_item">
                                            <a href="<?php echo $settings->twitter_id; ?>" target="_blank"
                                                class="social_icons social_twitter">
                                                <span class="icon-twitter"></span>
                                            </a>
                                        </div>
                                        <?php } ?>
                                        <?php if(!empty($settings->google_id)){ ?>
                                        <div class="sc_socials_item">
                                            <a href="<?php echo $settings->google_id; ?>" target="_blank"
                                                class="social_icons social_gplus">
                                                <span class="icon-gplus"></span>
                                            </a>
                                        </div>
                                        <?php } ?>
                                        <?php if(!empty($settings->facebook_id)){ ?>
                                        <div class="sc_socials_item">
                                            <a href="<?php echo $settings->facebook_id; ?>" target="_blank"
                                                class="social_icons social_facebook">
                                                <span class="icon-facebook"></span>
                                            </a>
                                        </div>
                                        <?php } ?>
                                        <?php if(!empty($settings->skype_id)){ ?>
                                        <div class="sc_socials_item">
                                            <a href="<?php echo $settings->skype_id; ?>" target="_blank"
                                                class="social_icons social_skype">
                                                <span class="icon-skype"></span>
                                            </a>
                                        </div>
                                        <?php } ?>
                                        <?php if(!empty($settings->youtube_id)){ ?>
                                        <div class="sc_socials_item">
                                            <a href="<?php echo $settings->youtube_id; ?>" target="_blank"
                                                class="social_icons social_youtube">
                                                <span class="icon-youtube"></span>
                                            </a>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <ul class="menu_user_nav"></ul>
                            </div>
                        </div>
                    </div>
                    <div class="top_panel_middle">
                        <div class="content_wrap">
                            <div class="contact_logo">
                                <div class="logo" style=" margin: 0.3em -1.2143em 0 0 !important;">

                                    <a href="frontend" style="padding:15px">

                                        <img src=" <?php
                                                if (!empty($settings->logo)) {
                                                    if (file_exists($settings->logo)) {
                                                        echo $settings->logo ;
                                                    } else {
                                                        echo $title[0] . '<span> ' . $title[1] . '</span>';
                                                    }
                                                } else {
                                                    echo $title[0] . '<span> ' . $title[1] . '</span>';
                                                }
                                                ?>" class="logo_main" alt="" style="height:60px; width:100px;">
                                        <img src=" <?php
                                                if (!empty($settings->logo)) {
                                                    if (file_exists($settings->logo)) {
                                                        echo $settings->logo ;
                                                    } else {
                                                        echo $title[0] . '<span> ' . $title[1] . '</span>';
                                                    }
                                                } else {
                                                    echo $title[0] . '<span> ' . $title[1] . '</span>';
                                                }
                                                ?>" class="logo_fixed" alt="" style="height:60px; width:100px;">
                                    </a>
                                </div>
                            </div>
                            <div class="search_wrap_fixed">
                                <a class="search_link icon-magnifying-glass-2" href="#"></a>
                                <div class="search_form_wrap_fixed scheme_dark">
                                    <form method="get" class="search_form" action="#">
                                        <button type="submit" class="search_submit icon-magnifying-glass-2"
                                            title=""></button>
                                        <input type="text" class="search_field" placeholder="Search" value="" name="s">
                                        <span class="search_close icon-cross"></span>
                                    </form>
                                </div>
                            </div>
                            <div class="menu_main_wrap">
                                <a href="#" class="menu_main_responsive_button icon-menu"></a>
                                <nav class="menu_main_nav_area">
                                    <ul id="menu_main" class="menu_main_nav">
                                        <li class="menu-item current-menu-ancestor current-menu-parent "><a
                                                href="#"><span>Home</span></a>

                                        </li>
                                        <!-- <li class="menu-item menu-item-has-children"><a href="#"><span>Pages</span></a>
                                            <ul class="sub-menu">
                                                <li class="menu-item"><a href="typography.html"><span>Typography</span></a></li>
                                                <li class="menu-item"><a href="shortcodes.html"><span>Shortcodes</span></a></li>
                                                <li class="menu-item"><a href="pricing.html"><span>Pricing</span></a></li>
                                                <li class="menu-item"><a href="customization.html"><span>Customization</span></a></li>
                                                <li class="menu-item"><a href="support.html"><span>Support</span></a></li>
                                                <li class="menu-item"><a href="shop.html"><span>Shop</span></a></li>
                                                <li class="menu-item"><a href="faq.html"><span>FAQ</span></a></li>
                                                <li class="menu-item"><a href="404.html"><span>Error 404</span></a></li>
                                                <li class="menu-item"><a href="contacts.html"><span>Contacts</span></a></li>
                                            </ul>
                                        </li> -->
                                        <li class="menu-item">
                                            <a href="frontend#service"><span>Services</span>
                                            </a>

                                        </li>
                                        <li class="menu-item menu-item-has-children"><a href="#"><span>About</span></a>
                                            <ul class="sub-menu">
                                                <li class="menu-item"><a href="frontend#welcome"><span>About
                                                            Us</span></a></li>

                                                <li class="menu-item"><a href="#"><span>Our Team</span></a>
                                                </li>
                                                <li class="menu-item"><a href="frontend#why_us"><span>Why Choose
                                                            Us</span></a>
                                                </li>
                                                <!-- <li class="menu-item">
                                                    <a href="single-team.html"><span>Dentist&#8217;s Profile</span></a>
                                                </li> -->
                                            </ul>
                                        </li>
                                        <li class="menu-item">
                                            <a href="frontend#register_hospital"><span>Register Hospital</span>
                                            </a>

                                        </li>
                                        <li class="menu-item">
                                            <a href="frontend#contact_us"><span>Contact Us</span>
                                            </a>

                                        </li>
                                        <!-- <li class="menu-item menu-item-has-children"><a href="#"><span>Gallery</span></a>
                                            <ul class="sub-menu">
                                                <li class="menu-item"><a href="grid.html"><span>Grid</span></a></li>
                                                <li class="menu-item"><a href="masonry.html"><span>Masonry</span></a></li>
                                                <li class="menu-item"><a href="cobbles.html"><span>Cobbles</span></a></li>
                                            </ul>
                                        </li> -->
                                        <!-- <li class="menu-item menu-item-has-children"><a href="#"><span>News</span></a>
                                            <ul class="sub-menu">
                                                <li class="menu-item"><a href="post-formats.html"><span>Post Formats</span></a></li>
                                                <li class="menu-item"><a href="classic.html"><span>Classic</span></a></li>
                                                <li class="menu-item menu-item-has-children"><a href="#"><span>Masonry</span></a>
                                                    <ul class="sub-menu">
                                                        <li class="menu-item"><a href="masonry-2-columns.html"><span>Masonry (2 columns)</span></a></li>
                                                        <li class="menu-item"><a href="masonry-3-columns.html"><span>Masonry (3 columns)</span></a></li>
                                                    </ul>
                                                </li>
                                                <li class="menu-item menu-item-has-children"><a href="#"><span>Portfolio</span></a>
                                                    <ul class="sub-menu">
                                                        <li class="menu-item"><a href="portfolio-2-columns.html"><span>Portfolio (2 columns)</span></a></li>
                                                        <li class="menu-item"><a href="portfolio-3-columns.html"><span>Portfolio (3 columns)</span></a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li> -->
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
                                            $link_lang = "Profile";
                                        } else {
                                            $link = "auth/login";
                                            $link_lang = lang('login');
                                        }
                                        ?>
                                        <li class="menu-item"> <a href="<?php echo $link; ?>" target="_blank"
                                                class=""><?php echo $link_lang; ?></a>
                                            </a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <div class="header_mobile">
                <div class="content_wrap">
                    <div class="menu_button icon-menu"></div>
                    <div class="logo" style=" margin: 0.3em -1.2143em 0 0 !important;">
                        <a href="frontend" style="padding:15px;">
                            <img src="<?php
                                                if (!empty($settings->logo)) {
                                                    if (file_exists($settings->logo)) {
                                                        echo $settings->logo ;
                                                    } else {
                                                        echo $title[0] . '<span> ' . $title[1] . '</span>';
                                                    }
                                                } else {
                                                    echo $title[0] . '<span> ' . $title[1] . '</span>';
                                                }
                                                ?>" class="logo_main" alt="" style="height:60px; width:100px;">
                        </a>
                    </div>
                </div>
                <div class="side_wrap">
                    <div class="close">Close</div>
                    <div class="panel_top">
                        <nav class="menu_main_nav_area">
                            <ul id="menu_main_mobile" class="menu_main_nav">
                                <li class="menu-item current-menu-ancestor current-menu-parent"><a
                                        href="#"><span>Home</span></a>

                                </li>
                                <!-- <li class="menu-item menu-item-has-children"><a href="#"><span>Pages</span></a>
                                    <ul class="sub-menu">
                                        <li class="menu-item"><a href="typography.html"><span>Typography</span></a></li>
                                        <li class="menu-item"><a href="shortcodes.html"><span>Shortcodes</span></a></li>
                                        <li class="menu-item"><a href="pricing.html"><span>Pricing</span></a></li>
                                        <li class="menu-item"><a href="customization.html"><span>Customization</span></a></li>
                                        <li class="menu-item"><a href="support.html"><span>Support</span></a></li>
                                        <li class="menu-item"><a href="shop.html"><span>Shop</span></a></li>
                                        <li class="menu-item"><a href="faq.html"><span>FAQ</span></a></li>
                                        <li class="menu-item"><a href="404.html"><span>Error 404</span></a></li>
                                        <li class="menu-item"><a href="contacts.html"><span>Contacts</span></a></li>
                                    </ul>
                                </li>
                                <li class="menu-item menu-item-has-children">
                                    <a href="services.html"><span>Services</span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="menu-item">
                                            <a href="single-service.html"><span>Service Single</span></a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="menu-item menu-item-has-children"><a href="#"><span>About</span></a>
                                    <ul class="sub-menu">
                                        <li class="menu-item"><a href="about.html"><span>About Us</span></a></li>

                                        <li class="menu-item"><a href="team.html"><span>Our Team</span></a>
                                        </li>
                                        <li class="menu-item">
                                            <a href="single-team.html"><span>Dentist&#8217;s Profile</span></a>
                                        </li>
                                    </ul>
                                </li> -->
                                <li class="menu-item">
                                    <a href="frontend#service"><span>Services</span>
                                    </a>

                                </li>
                                <li class="menu-item menu-item-has-children"><a href="#"><span>About</span></a>
                                    <ul class="sub-menu">
                                        <li class="menu-item"><a href="frontend#welcome"><span>About Us</span></a></li>

                                        <li class="menu-item"><a href="#"><span>Our Team</span></a>
                                        </li>
                                        <li class="menu-item"><a href="frontend#why_us"><span>Why Choose Us</span></a>
                                        </li>
                                        <!-- <li class="menu-item">
                                                    <a href="single-team.html"><span>Dentist&#8217;s Profile</span></a>
                                                </li> -->
                                    </ul>
                                </li>
                                <li class="menu-item">
                                    <a href="frontend#register_hospital"><span>Register Hospital</span>
                                    </a>

                                </li>
                                <li class="menu-item">
                                    <a href="frontend#contact_us"><span>Contact Us</span>
                                    </a>

                                </li>
                                <!-- <li class="menu-item menu-item-has-children"><a href="#"><span>Gallery</span></a>
                                    <ul class="sub-menu">
                                        <li class="menu-item"><a href="grid.html"><span>Grid</span></a></li>
                                        <li class="menu-item"><a href="masonry.html"><span>Masonry</span></a></li>
                                        <li class="menu-item"><a href="cobbles.html"><span>Cobbles</span></a></li>
                                    </ul>
                                </li> -->
                                <!-- <li class="menu-item menu-item-has-children"><a href="#"><span>News</span></a>
                                    <ul class="sub-menu">
                                        <li class="menu-item"><a href="post-formats.html"><span>Post Formats</span></a></li>
                                        <li class="menu-item"><a href="classic.html"><span>Classic</span></a></li>
                                        <li class="menu-item menu-item-has-children"><a href="#"><span>Masonry</span></a>
                                            <ul class="sub-menu">
                                                <li class="menu-item"><a href="masonry-2-columns.html"><span>Masonry (2 columns)</span></a></li>
                                                <li class="menu-item"><a href="masonry-3-columns.html"><span>Masonry (3 columns)</span></a></li>
                                            </ul>
                                        </li>
                                        <li class="menu-item menu-item-has-children"><a href="#"><span>Portfolio</span></a>
                                            <ul class="sub-menu">
                                                <li class="menu-item"><a href="portfolio-2-columns.html"><span>Portfolio (2 columns)</span></a></li>
                                                <li class="menu-item"><a href="portfolio-3-columns.html"><span>Portfolio (3 columns)</span></a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li> -->
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
                                            $link_lang = "Profile";
                                        } else {
                                            $link = "auth/login";
                                            $link_lang = lang('login');
                                        }
                                        ?>
                                <li class="menu-item"> <a href="<?php echo $link; ?>" target="_blank"
                                        class=""><?php echo $link_lang; ?></a>
                                    </a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="panel_middle">
                        <div class="top_panel_top_open_hours icon-calendar-light">Mn - St: <strong>8:00am -
                                9:00pm</strong> Sn: Closed</div>
                        <div class="top_panel_top_user_area">
                            <ul class="menu_user_nav">
                            </ul>
                        </div>
                    </div>
                    <div class="panel_bottom">
                        <div class="contact_socials">
                            <div class="sc_socials sc_socials_type_icons sc_socials_shape_square sc_socials_size_small">
                                <?php if(!empty($settings->twitter_id)){ ?>
                                <div class="sc_socials_item">
                                    <a href="<?php echo $settings->twitter_id; ?>" target="_blank"
                                        class="social_icons social_twitter">
                                        <span class="icon-twitter"></span>
                                    </a>
                                </div>
                                <?php } ?>
                                <?php if(!empty($settings->google_id)){ ?>
                                <div class="sc_socials_item">
                                    <a href="<?php echo $settings->google_id; ?>" target="_blank"
                                        class="social_icons social_gplus">
                                        <span class="icon-gplus"></span>
                                    </a>
                                </div>
                                <?php } ?>
                                <?php if(!empty($settings->facebook_id)){ ?>
                                <div class="sc_socials_item">
                                    <a href="<?php echo $settings->facebook_id; ?>" target="_blank"
                                        class="social_icons social_facebook">
                                        <span class="icon-facebook"></span>
                                    </a>
                                </div>
                                <?php } ?>
                                <?php if(!empty($settings->skype_id)){ ?>
                                <div class="sc_socials_item">
                                    <a href="<?php echo $settings->skype_id; ?>" target="_blank"
                                        class="social_icons social_skype">
                                        <span class="icon-skype"></span>
                                    </a>
                                </div>
                                <?php } ?>
                                <?php if(!empty($settings->youtube_id)){ ?>
                                <div class="sc_socials_item">
                                    <a href="<?php echo $settings->youtube_id; ?>" target="_blank"
                                        class="social_icons social_youtube">
                                        <span class="icon-youtube"></span>
                                    </a>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mask"></div>
            </div>
            <section class="slider_wrap slider_fullwide slider_engine_revo">
                <div id="rev_slider_1_1_wrapper" class="rev_slider_wrapper fullwidthbanner-container"
                    data-source="gallery">
                    <div id="rev_slider_1_1" class="rev_slider fullwidthabanner" data-version="5.4.3">
                        <ul>
                            <?php $i=0; foreach ($slides as $slide) { $i+=1; ?>
                            <li data-index="rs-<?php echo $i; ?>" data-transition="fade" data-slotamount="default"
                                data-hideafterloop="0" data-hideslideonmobile="off" data-easein="default"
                                data-easeout="default" data-masterspeed="300"
                                data-thumb="front/assets_new/images/01_slider-background-100x50.jpg" data-rotate="0"
                                data-saveperformance="off" data-title="Slide" data-param1="" data-param2=""
                                data-param3="" data-param4="" data-param5="" data-param6="" data-param7=""
                                data-param8="" data-param9="" data-param10="" data-description="">
                                <img src="front/assets_new/images/01_slider-background.jpg" alt=""
                                    title="01_slider-background" width="2340" height="1034"
                                    data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat"
                                    data-bgparallax="off" class="rev-slidebg" data-no-retina>
                                <div class="tp-caption tp-resizeme" id="slide-<?php echo $i; ?>-layer-1" data-x="587"
                                    data-y="" data-width="['none','none','none','none']"
                                    data-height="['none','none','none','none']" data-type="image"
                                    data-responsive_offset="on"
                                    data-frames='[{"from":"z:0;rX:0deg;rY:0;rZ:0;sX:2;sY:2;skX:0;skY:0;opacity:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":1500,"to":"o:1;","delay":750,"ease":"Power2.easeOut"},{"delay":4000,"speed":1500,"to":"sX:1.25;sY:1.25;opacity:0;","ease":"Power0.easeInOut"}]'
                                    data-textAlign="['left','left','left','left']" data-paddingtop="[0,0,0,0]"
                                    data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]"
                                    data-paddingleft="[0,0,0,0]">
                                    <img style="  background-image: none;" src="<?php echo $slide->img_url; ?>" alt=""
                                        data-ww="623px" data-hh="517px" width="623" height="517" data-no-retina>
                                </div>
                                <div class="tp-caption dentrarario-home1-static-text2 tp-resizeme"
                                    id="slide-<?php echo $i; ?>-layer-2" data-x="35" data-y="255" data-width="['auto']"
                                    data-height="['auto']" data-type="text" data-responsive_offset="on"
                                    data-frames='[{"from":"z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;","speed":1000,"to":"o:1;","delay":1000,"ease":"Power2.easeOut"},{"delay":4750,"speed":1000,"to":"opacity:0;","ease":"nothing"}]'
                                    data-textAlign="['left','left','left','left']" data-paddingtop="[0,0,0,0]"
                                    data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]"
                                    data-paddingleft="[0,0,0,0]">
                                    <?php 
                                         $texts=[];
                                         $texts=explode(" ",$slide->text2);
                                        
                                          $j=0;
                                          $text_con='';
                                          foreach($texts as $text){
                                            
                                            $j+=1;
                                            if($j%6 !=0){
                                                $text_con.= $text.' ';
                                            }
                                            else{
                                                $text_con.=' '.$text.'</br>';
                                                $j=0;
                                                
                                            }

                                          }
                                          echo $text_con;
                                          ?>

                                </div>
                                <div class="tp-caption dentrarario-home1-static-text tp-resizeme button"
                                    id="slide-<?php echo $i; ?>-layer-3" data-x="35" data-y="340" data-width="['auto']"
                                    data-height="['auto']" data-type="text" data-responsive_offset="on"
                                    data-frames='[{"from":"z:0;rX:0;rY:0;rZ:0;sX:0.8;sY:0.8;skX:0;skY:0;opacity:0;","speed":1500,"to":"o:1;","delay":1500,"ease":"Power4.easeOut"},{"delay":3750,"speed":1000,"to":"opacity:0;","ease":"nothing"}]'
                                    data-textAlign="['left','left','left','left']" data-paddingtop="[0,0,0,0]"
                                    data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]"
                                    data-paddingleft="[0,0,0,0]">
                                    <a href="appointment.html"
                                        class="sc_button sc_button_square sc_button_style_filled sc_button_size_medium alignleft"><?php echo lang('register_hospital'); ?></a>
                                </div>
                                <div class="tp-caption dentrarario-home1-static-header tp-resizeme"
                                    id="slide-<?php echo $i; ?>-layer-4" data-x="35" data-y="143" data-width="['auto']"
                                    data-height="['auto']" data-type="text" data-responsive_offset="on"
                                    data-frames='[{"from":"z:0;rX:0;rY:0;rZ:0;sX:0.8;sY:0.8;skX:0;skY:0;opacity:0;","speed":1500,"to":"o:1;","delay":500,"ease":"Power4.easeOut"},{"delay":4750,"speed":1000,"to":"opacity:0;","ease":"nothing"}]'
                                    data-textAlign="['left','left','left','left']" data-paddingtop="[0,0,0,0]"
                                    data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]"
                                    data-paddingleft="[0,0,0,0]">
                                    <?php echo $slide->title; ?>
                                </div>
                            </li>
                            <?php } ?>

                        </ul>
                        <div class="tp-bannertimer"></div>
                    </div>
                </div>
            </section>
            <div class="page_content_wrap page_paddings_no" id="welcome">
                <div class="content_wrap">
                    <div class="content">
                        <article class="post_item post_item_single page hentry">
                            <section class="post_content">

                                <div class="vc_row wpb_row vc_row-fluid">
                                    <div class="wpb_column vc_column_container vc_col-sm-12">
                                        <div class="vc_column-inner ">
                                            <div class="wpb_wrapper">
                                                <div class="vc_empty_space space_70p">
                                                    <span class="vc_empty_space_inner"></span>
                                                </div>
                                                <h2
                                                    class="sc_title sc_title_regular sc_align_center margin_bottom_null centext">
                                                    Welcome to Klinicx medicare solutions</h2>
                                                <h6 class="sc_services_descr sc_item_descr">We are ready to help you
                                                    anytime</h6>
                                                <div
                                                    class="columns_wrap sc_columns columns_nofluid autoheight sc_columns_count_2">
                                                    <div class="column-1_2 sc_column_item sc_column_item_1">
                                                        <div class="sc_column_item_inner">
                                                            <img src="front/assets_new/images/medical.jpg">
                                                        </div>
                                                    </div>
                                                    <div class="column-1_2 sc_column_item sc_column_item_2">
                                                        <div class="vc_empty_space space_50p">
                                                            <span class="vc_empty_space_inner"></span>
                                                        </div>
                                                        <div class="wpb_text_column wpb_content_element ">
                                                            <div class="wpb_wrapper">
                                                                <p>
                                                                    This is a complete solution for your hospital
                                                                    management system. It has all the features what a
                                                                    hospital needs
                                                                    to run including patient management, appointment
                                                                    booking and other necessary things.
                                                                </p>
                                                                <p>
                                                                    Our software solution is easy to install and
                                                                    lightweight. This software is user friendly. User
                                                                    can use this software
                                                                    with a limited technology knowledge with great
                                                                    security bridge with protected data.
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <!-- <div class="vc_custom_heading vc_custom_1455714631637">- Dr. Emma Grey</div> -->
                                                        <a href="#"
                                                            class="sc_button sc_button_square sc_button_style_filled sc_button_size_medium margin_top_small margin_bottom_small bgc_7">More
                                                            about us</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="vc_row wpb_row vc_row-fluid" id="service">
                                    <div class="wpb_column vc_column_container vc_col-sm-12">
                                        <div class="vc_column-inner ">
                                            <div class="wpb_wrapper">
                                                <div class="vc_empty_space space_45p">
                                                    <span class="vc_empty_space_inner"></span>
                                                </div>
                                                <div id="sc_services_171_wrap" class="sc_services_wrap">
                                                    <div id="sc_services_171"
                                                        class="sc_services sc_services_style_services-1 sc_services_type_icons margin_top_medium">
                                                        <h2 class="sc_services_title sc_item_title">Our Software
                                                            Services</h2>
                                                        <div class="sc_services_descr sc_item_descr">Services we provide
                                                        </div>
                                                        <div class="sc_columns columns_wrap">
                                                            <?php $j=0; foreach ($services as $service) { $j+=1; ?>
                                                            <div class="column-1_3 column_padding_bottom">
                                                                <div id="sc_services_171_<?php echo $j; ?>"
                                                                    class="sc_services_item sc_services_item_<?php echo $j; ?>">
                                                                    <a href="single-service.html">
                                                                        <span class="sc_icon icon-medic-10"></span>
                                                                    </a>
                                                                    <div class="sc_services_item_content">
                                                                        <h4 class="sc_services_item_title">
                                                                            <a
                                                                                href="single-service.html"><?php echo $service->title;?></a>
                                                                        </h4>
                                                                        <div class="sc_services_item_description">
                                                                            <p><?php echo $service->description;?></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php } ?>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="vc_empty_space space_73p">
                                                    <span class="vc_empty_space_inner"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <style>
                                .st-about-wrap {
                                    position: relative;
                                    padding: 80px 0;
                                    background: #f9f9f9;
                                }

                                .st-shape-bg img {
                                    position: absolute;
                                    top: 0;
                                    left: 0;
                                    width: 100%;
                                    height: auto;
                                    z-index: -1;
                                }

                                .st-section-heading {
                                    text-align: center;
                                    margin-bottom: 40px;
                                }

                                .st-section-heading-title {
                                    font-size: 36px;
                                    font-weight: bold;
                                    color: #333;
                                }

                                .st-seperator {
                                    display: flex;
                                    justify-content: center;
                                    align-items: center;
                                    margin: 20px 0;
                                }

                                .st-seperator-left,
                                .st-seperator-right {
                                    width: 50px;
                                    height: 2px;
                                    background: #007bff;
                                }

                                .st-seperator-center img {
                                    width: 30px;
                                    height: 30px;
                                }

                                .st-section-heading-subtitle {
                                    font-size: 18px;
                                    color: #666;
                                    max-width: 600px;
                                    margin: 0 auto;
                                }

                                .st-text-block {
                                    background: #fff;
                                    padding: 30px;
                                    border-radius: 10px;
                                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                                    transition: transform 0.3s ease;
                                }

                                .st-text-block:hover {
                                    transform: translateY(-5px);
                                }

                                .st-text-block-title {
                                    font-size: 24px;
                                    font-weight: bold;
                                    color: #333;
                                    margin-bottom: 20px;
                                }

                                .st-text-block-text p {
                                    font-size: 16px;
                                    color: #666;
                                    line-height: 1.6;
                                }

                                .st-text-block-avatar {
                                    display: flex;
                                    align-items: center;
                                    margin-top: 20px;
                                }

                                .st-avatar-img img {
                                    width: 60px;
                                    height: 60px;
                                    border-radius: 50%;
                                    margin-right: 15px;
                                }

                                .st-avatar-name {
                                    font-size: 18px;
                                    font-weight: bold;
                                    color: #333;
                                }

                                .st-shedule-wrap {
                                    background: #fff;
                                    padding: 30px;
                                    border-radius: 10px;
                                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                                }

                                .st-shedule-title {
                                    font-size: 24px;
                                    font-weight: bold;
                                    color: #333;
                                    margin-bottom: 20px;
                                }

                                .st-shedule-list {
                                    list-style: none;
                                    padding: 0;
                                    margin: 0;
                                }

                                .st-shedule-list li {
                                    display: flex;
                                    justify-content: space-between;
                                    padding: 10px 0;
                                    border-bottom: 1px solid #eee;
                                }

                                .st-shedule-left {
                                    font-size: 16px;
                                    color: #333;
                                }

                                .st-shedule-right {
                                    font-size: 16px;
                                    color: #007bff;
                                }

                                .st-call {
                                    display: flex;
                                    align-items: center;
                                    margin-top: 20px;
                                }

                                .st-call-icon svg {
                                    width: 40px;
                                    height: 40px;
                                    fill: #007bff;
                                    margin-right: 15px;
                                }

                                .st-call-title {
                                    font-size: 18px;
                                    font-weight: bold;
                                    color: #333;
                                }

                                .st-call-number {
                                    font-size: 16px;
                                    color: #007bff;
                                }

                                @media (max-width: 768px) {

                                    .st-text-block,
                                    .st-shedule-wrap {
                                        margin-bottom: 20px;
                                    }

                                    .st-section-heading-title {
                                        font-size: 28px;
                                    }

                                    .st-section-heading-subtitle {
                                        font-size: 16px;
                                    }

                                    .st-text-block-title {
                                        font-size: 20px;
                                    }

                                    .st-shedule-title {
                                        font-size: 20px;
                                    }
                                }

                                
                                </style>
                                <section class="st-about-wrap" id="about" style="background-color:#fff !important;">
                                    <div class="st-shape-bg">
                                        <img src="themes/assets/img/shape/about-bg-shape.svg" alt="shape">
                                    </div>
                                    <div class="st-height-b120 st-height-lg-b50"></div>
                                    <div class="">
                                        <div class="st-section-heading st-style1">
                                            <h2 class="st-section-heading-title">Who We Are</h2>
                                            <div class="st-seperator">
                                                <div class="st-seperator-left wow fadeInLeft" data-wow-duration="1s"
                                                    data-wow-delay="0.2s"></div>
                                                <div class="st-seperator-center"><img
                                                        src="themes/assets/img/icons/plus.webp" alt="icon"></div>
                                                <div class="st-seperator-right wow fadeInRight" data-wow-duration="1s"
                                                    data-wow-delay="0.2s"></div>
                                            </div>
                                            <?php
                                                        $text = $settings->comment_1;
                                                        $words = explode(' ', $text);
                                                        $first_six_words = array_slice($words, 0, 12);
                                                        $remaining_words = array_slice($words, 12);
                                                        $first_section = implode(' ', $first_six_words);
                                                        $second_section = implode(' ', $remaining_words);
                                                        ?>
                                            <div class="st-section-heading-subtitle"><?php echo $first_section; ?> <br>
                                                <?php echo $second_section; ?></div>
                                        </div>
                                        <div class="st-height-b40 st-height-lg-b40"></div>
                                    </div>
                                    <div class="">
                                        <div class="row">
                                            <div class="col-lg-7">
                                                <div class="st-vertical-middle">
                                                    <div class="st-vertical-middle-in">
                                                        <div class="st-text-block st-style1">
                                                            <h2 class="st-text-block-title">
                                                                <?php echo $settings->verified_1; ?></h2>
                                                            <div class="st-height-b20 st-height-lg-b20"></div>
                                                            <div class="st-text-block-text">
                                                                <p><?php echo $settings->comment_2; ?></p>
                                                            </div>
                                                            <div class="st-height-b25 st-height-lg-b25"></div>
                                                            <div class="st-text-block-avatar">
                                                                <div class="st-avatar-img"><img
                                                                        src="<?php echo $settings->comment_logo_2; ?>"
                                                                        alt="avatar"></div>
                                                                <div class="st-avatar-info">
                                                                    <h4 class="st-avatar-name">
                                                                        <?php echo $settings->verified_2; ?></h4>
                                                                    <!-- <div class="st-avatar-designation">Founder & Director</div> -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="st-height-b0 st-height-lg-b30"></div>
                                            </div><!-- .col -->
                                            <div class="col-lg-5 wow fadeInRight" data-wow-duration="0.8s"
                                                data-wow-delay="0.2s">
                                                <div class="st-shedule-wrap">
                                                    <div class="st-shedule">
                                                        <h2 class="st-shedule-title">Weekly Timetable</h2>
                                                        <ul class="st-shedule-list">
                                                            <?php foreach ($gridsections as $gridsection) { ?>
                                                            <li>
                                                                <div class="st-shedule-left">
                                                                    <?php echo $gridsection->title; ?></div>
                                                                <div class="st-shedule-right">
                                                                    <?php echo $gridsection->category; ?> </div>
                                                            </li>
                                                            <?php } ?>
                                                        </ul>
                                                        <div class="st-height-b25 st-height-lg-b25"></div>
                                                        <div class="st-call st-style1">
                                                            <div class="st-call-icon">
                                                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                                                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
                                                                    y="0px" viewBox="0 0 512 512" xml:space="preserve">
                                                                    <g>
                                                                        <path d="M492.557,400.56L392.234,300.238c-11.976-11.975-31.458-11.975-43.435,0l-26.088,26.088
                                                c-8.174,8.174-10.758,19.845-7.773,30.241l-9.843,9.843c-0.003,0.003-0.005,0.005-0.008,0.008
                                                c-6.99,6.998-50.523-3.741-103.145-56.363c-52.614-52.613-63.356-96.139-56.366-103.142c0-0.002,0.002-0.002,0.002-0.002
                                                l9.852-9.851c2.781,0.799,5.651,1.207,8.523,1.207c7.865,0,15.729-2.993,21.718-8.98l26.088-26.088
                                                c11.975-11.975,11.975-31.458,0-43.434L111.436,19.441c-5.8-5.8-13.513-8.994-21.716-8.994c-8.205,0-15.915,3.196-21.716,8.994
                                                l-26.09,26.09c-8.174,8.174-10.758,19.846-7.773,30.241c0,0-8.344,8.424-8.759,8.956c-27.753,30.849-32.96,79.418-14.561,137.487
                                                c18.017,56.857,56.857,117.088,109.367,169.595c52.508,52.508,112.739,91.348,169.596,109.367
                                                C312.624,508.414,333.991,512,353.394,512c31.813,0,58.337-9.648,77.35-28.66l5.474-5.474c2.74,0.788,5.602,1.213,8.532,1.213
                                                c8.205,0,15.917-3.196,21.716-8.994l26.09-26.09C504.531,432.02,504.531,412.536,492.557,400.56z M89.72,41.157l100.324,100.325
                                                l-26.074,26.102c0,0-0.005-0.005-0.014-0.014l-0.375-0.375l-49.787-49.787L63.631,67.247L89.72,41.157z M409.029,461.623
                                                c-0.002,0.002-0.003,0.003-0.005,0.005c-22.094,22.091-61.146,25.74-109.961,10.27c-52.252-16.558-108.065-52.714-157.156-101.806
                                                C92.814,321,56.658,265.189,40.101,212.936c-15.47-48.817-11.821-87.87,10.275-109.967l0.002-0.002l2.77-2.77l77.857,77.856
                                                l-7.141,7.141c-0.005,0.005-0.009,0.011-0.015,0.017c-29.585,29.622,5.963,96.147,56.378,146.562
                                                c37.734,37.734,84.493,67.14,118.051,67.14c11.284,0,21.076-3.325,28.528-10.778c0.003-0.003,0.005-0.005,0.008-0.008l7.133-7.133
                                                l77.857,77.856L409.029,461.623z M444.752,448.368L344.428,348.044l26.088-26.088L470.84,422.278
                                                C470.84,422.278,444.761,448.377,444.752,448.368z" />
                                                                    </g>
                                                                    <g>
                                                                        <path
                                                                            d="M388.818,123.184c-29.209-29.209-68.042-45.294-109.344-45.293c-8.481,0-15.356,6.875-15.356,15.356
                                                c0,8.481,6.876,15.356,15.356,15.356c33.1-0.002,64.219,12.89,87.628,36.297c23.406,23.406,36.295,54.525,36.294,87.624
                                                c0,8.481,6.875,15.358,15.356,15.358c8.48,0,15.356-6.875,15.356-15.354C434.109,191.224,418.023,152.393,388.818,123.184z" />
                                                                    </g>
                                                                    <g>
                                                                        <path
                                                                            d="M443.895,68.107C399.972,24.186,341.578-0.002,279.468,0c-8.481,0-15.356,6.876-15.356,15.356
                                                c0,8.481,6.876,15.356,15.356,15.356c53.907-0.002,104.588,20.992,142.709,59.111c38.118,38.118,59.111,88.799,59.11,142.706
                                                c0,8.481,6.875,15.356,15.356,15.356c8.48,0,15.356-6.875,15.356-15.354C512.001,170.419,487.813,112.027,443.895,68.107z" />
                                                                    </g>
                                                                    <g>
                                                                        <path
                                                                            d="M333.737,178.26c-14.706-14.706-33.465-22.477-54.256-22.477c0,0-0.005,0-0.006,0
                                                c-8.481,0.002-15.356,6.876-15.354,15.358c0.002,8.481,6.878,15.356,15.358,15.354c0.002,0,0.003,0,0.005,0
                                                c12.644,0,23.593,4.536,32.539,13.481c8.819,8.82,13.481,20.075,13.479,32.544c-0.002,8.481,6.875,15.356,15.354,15.358h0.002
                                                c8.481,0,15.354-6.875,15.356-15.354C356.215,211.732,348.444,192.968,333.737,178.26z" />
                                                                    </g>
                                                                </svg>
                                                            </div>
                                                            <div class="st-call-text">
                                                                <div class="st-call-title">Call Now</div>
                                                                <div class="st-call-number">
                                                                    <?php echo $settings->phone; ?></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- .col -->
                                        </div>
                                    </div>
                                </section>
<style>
    .st-tab-links {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 15px;
    margin-bottom: 30px;
}

.st-tab-title a {
    display: flex;
    align-items: center;
    padding: 15px 20px;
    border-radius: 50px;
    text-decoration: none;
    color: #fff;
    transition: background-color 0.3s ease, transform 0.3s ease;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.st-tab-title a:hover {
    background-color: rgba(255, 255, 255, 0.1);
    transform: translateY(-5px);
}

.st-icon {
    width: 24px;
    height: 24px;
    margin-right: 10px;
}

.st-blue-box {
    background-color: #007bff;
}

.st-red-box {
    background-color: #dc3545;
}

.st-green-box {
    background-color: #28a745;
}

.st-dip-blue-box {
    background-color: #17a2b8;
}

.st-orange-box {
    background-color: #fd7e14;
}

.st-gray-box {
    background-color: #6c757d;
}

.tab-content .st-tab {
    display: none;
}

.tab-content .st-tab.active {
    display: block;
}
ul, ol {
    list-style-type: none; /* Remove default list markers */
    padding-left: 0; /* Remove default padding */
}

ul li::marker, ol li::marker {
    content: none; /* Remove the marker */
}
</style>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const tabs = document.querySelectorAll(".st-tab-title");
    const tabContents = document.querySelectorAll(".st-tab");

    tabs.forEach((tab, index) => {
        tab.addEventListener("click", function(event) {
            event.preventDefault();

            tabs.forEach(t => t.classList.remove("active"));
            tabContents.forEach(tc => tc.classList.remove("active"));

            tab.classList.add("active");
            tabContents[index].classList.add("active");
        });
    });

    // Show the first tab content by default
    if (tabs.length > 0) {
        tabs[0].classList.add("active");
        tabContents[0].classList.add("active");
    }
});
</script>
<section id="department" class="st-department-section">
  <div class="st-height-b120 st-height-lg-b80"></div>
  <div class="">
    <div class="st-section-heading st-style1 text-center">
      <h2 class="st-section-heading-title">Our Crutches Program</h2>
      <div class="st-seperator">
        <div class="st-seperator-left wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.2s"></div>
        <div class="st-seperator-center"><img src="themes/assets/img/icons/plus.webp" alt="icon"></div>
        <div class="st-seperator-right wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.2s"></div>
      </div>
      <?php
          $text = $settings->block_1_text_under_title;
          $words = explode(' ', $text);
          $first_six_words = array_slice($words, 0, 12);
          $remaining_words = array_slice($words, 12);
          $first_section = implode(' ', $first_six_words);
          $second_section = implode(' ', $remaining_words);
         
          
          ?>
          <div class="st-section-heading-subtitle"><?php echo $first_section; ?><br><?php echo $second_section; ?></div>
      
    </div>
    <div class="st-height-b40 st-height-lg-b40"></div>
  </div>
  <div class="">
    <div class="st-tabs st-fade-tabs st-style1">
      <ul class="st-tab-links st-style1 st-mp0">
        <?php
        $tabs = [
          ['id' => 1, 'class' => 'st-blue-box', 'icon' => 'crutches'],
          ['id' => 2, 'class' => 'st-red-box', 'icon' => 'xray'],
          ['id' => 3, 'class' => 'st-green-box', 'icon' => 'pulmonary'],
          ['id' => 4, 'class' => 'st-dip-blue-box', 'icon' => 'cardiology'],
          ['id' => 5, 'class' => 'st-orange-box', 'icon' => 'dental'],
          ['id' => 6, 'class' => 'st-gray-box', 'icon' => 'neurology']
        ];
        foreach ($tabs as $index => $tab) {
          $details = $this->db->get_where('crutches', array('id' => $tab['id']))->row();
          $activeClass = $index === 0 ? 'active' : '';
          echo '
          <li class="st-tab-title ' . $activeClass . '">
            <a href="#' . $details->name . '" class="' . $tab['class'] . '">
              
              <span>' . $details->name . '</span>
            </a>
          </li>';
        }
        ?>
      </ul>
      <div class="st-height-b25 st-height-lg-b25"></div>
      <div class="tab-content">
        <?php
        foreach ($tabs as $index => $tab) {
          $details = $this->db->get_where('crutches', array('id' => $tab['id']))->row();
          $activeClass = $index === 0 ? 'active' : '';
          echo '
          <div id="' . $details->name . '" class="st-tab ' . $activeClass . '">
            <div class="st-imagebox st-style2">
              <div class="row">
                <div class="col-lg-6">
                  <div class="st-imagebox-img">
                    <img style="height:400px; width:505px;" src="' . $details->img . '" alt="' . $details->name . '">
                  </div>
                  <div class="st-height-b0 st-height-lg-b30"></div>
                </div>
                <div class="col-lg-6">
                  <div class="st-vertical-middle">
                    <div class="st-vertical-middle-in">
                      <div class="st-imagebox-info">
                        <h2 class="st-imagebox-title">' . $details->designation . '</h2>
                        <h4 class="st-imagebox-subtitle">' . $details->crutches . '</h4>
                        <div class="st-imagebox-text">' . $details->status . '</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>';
        }
        ?>
      </div>
    </div><!-- .st-tabs -->
  </div>
  <div class="st-height-b120 st-height-lg-b80"></div>
</section>
    <!-- End department Section -->


                                <div data-vc-full-width="true" data-vc-full-width-init="false"
                                    class="vc_row wpb_row vc_row-fluid vc_custom_1458054944279">
                                    <div class="wpb_column vc_column_container vc_col-sm-12">
                                        <div class="vc_column-inner ">
                                            <div class="wpb_wrapper">
                                                <div
                                                    class="columns_wrap sc_columns columns_nofluid autoheight sc_columns_count_2">
                                                    <div class="column-1_2 sc_column_item sc_column_item_1">
                                                        <div class="sc_column_item_inner">
                                                            <img src="front/assets_new/images/sideimage.jpg"
                                                                style="margin-top: 49px;">
                                                        </div>
                                                    </div>
                                                    <div class="column-1_2 sc_column_item sc_column_item_2">
                                                        <h3 class="sc_title sc_title_regular margin_top_huge">We
                                                            eliminate the inconvenience<br /> of multiple visits</h3>
                                                        <h6 class="sc_title sc_title_regular margin_top_null">POPULAR
                                                            INFORMATION</h6>
                                                        <div class="wpb_text_column wpb_content_element ">
                                                            <div class="wpb_wrapper">
                                                                <p>
                                                                    <?php   echo $settings->service_block__text_under_title; ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <a href="#"
                                                            class="sc_button sc_button_square sc_button_style_filled sc_button_size_medium margin_top_small margin_bottom_huge bgc_7">Read
                                                            More</a>
                                                        <div class="vc_empty_space space_20p">
                                                            <span class="vc_empty_space_inner"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="vc_row-full-width"></div>
                                <div data-vc-full-width="true" data-vc-full-width-init="false"
                                    data-vc-stretch-content="true"
                                    class="vc_row wpb_row vc_row-fluid vc_row-no-padding">
                                    <div class="wpb_column vc_column_container vc_col-sm-12">
                                        <div class="vc_column-inner ">
                                            <div class="wpb_wrapper">
                                                <div id="sc_call_to_action_700"
                                                    class="sc_call_to_action sc_call_to_action_accented sc_call_to_action_style_1 sc_call_to_action_align_center">
                                                    <div class="sc_call_to_action_info">
                                                        <h3 class="sc_call_to_action_title sc_item_title">High
                                                            Innovative Technology & Professional Software</h3>
                                                        <div class="sc_call_to_action_descr sc_item_descr">Get Software
                                                            or call <?php echo $settings1->phone;?></div>
                                                        <div class="sc_call_to_action_buttons sc_item_buttons">
                                                            <div class="sc_call_to_action_button sc_item_button">
                                                                <a href="#"
                                                                    class="sc_button sc_button_square sc_button_style_filled sc_button_size_medium">Get
                                                                    the Software</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="vc_row-full-width"></div>
                                <div data-vc-full-width="true" data-vc-full-width-init="false"
                                    class=" wpb_row vc_row-fluid" id="why_us">
                                    <div class="wpb_column vc_column_container vc_col-sm-12">
                                        <div class="vc_column-inner ">
                                            <div class="wpb_wrapper">
                                                <div
                                                    class="columns_wrap sc_columns columns_nofluid autoheight sc_columns_count_2">
                                                    <div class="column-1_2 sc_column_item sc_column_item_1">
                                                        <div class="sc_column_item_inner">
                                                            <img src="<?php echo $settings->partner_image_1; ?>"
                                                                style="margin-top: 49px;">
                                                        </div>
                                                    </div>
                                                    <div class="column-1_2 sc_column_item sc_column_item_2">
                                                        <h3 class="sc_title sc_title_regular margin_top_huge">
                                                            <?php echo $settings->section_title_1; ?></h3>
                                                        <!-- <h6 class="sc_title sc_title_regular margin_top_null"></h6> -->
                                                        <div class="wpb_text_column wpb_content_element ">
                                                            <div class="wpb_wrapper">
                                                                <p>
                                                                    <?php echo $settings->section_description_1; ?>
                                                                <ul role="list" class="c-list">
                                                                    <li class="c-list__item is--yellow">
                                                                        <p class="c-paragraph">
                                                                            <?php echo $settings->section_1_text_1; ?>
                                                                        </p>
                                                                    </li>
                                                                    <li class="c-list__item is--yellow">
                                                                        <p class="c-paragraph">
                                                                            <?php echo $settings->section_1_text_2; ?>
                                                                        </p>
                                                                    </li>
                                                                    <li class="c-list__item is--yellow">
                                                                        <p class="c-paragraph">
                                                                            <?php echo $settings->section_1_text_3; ?>
                                                                        </p>
                                                                    </li>
                                                                </ul>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <!-- <a href="#" class="sc_button sc_button_square sc_button_style_filled sc_button_size_medium margin_top_small margin_bottom_huge bgc_7">Read More</a> -->
                                                        <div class="vc_empty_space space_20p">
                                                            <span class="vc_empty_space_inner"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="vc_row wpb_row vc_row-fluid">
                                    <div class="wpb_column vc_column_container vc_col-sm-12">
                                        <div class="vc_column-inner ">
                                            <div class="wpb_wrapper">
                                                <div class="vc_empty_space space_93p">
                                                    <span class="vc_empty_space_inner"></span>
                                                </div>
                                                <div id="sc_team_910_wrap" class="sc_team_wrap type2">
                                                    <div id="sc_team_910" class="sc_team sc_team_style_team-2 ">
                                                        <h2 class="sc_team_title sc_item_title">Best specialists in one place</h2>
                                                        <div class="sc_team_descr sc_item_descr">This is optional subheading</div>
                                                        <div class="sc_columns columns_wrap">
                                                            <div class="column-1_4 column_padding_bottom">
                                                                <div id="sc_team_910_1" class="sc_team_item">
                                                                    <div class="sc_team_item_avatar">
                                                                        <img width="240" height="240" alt="" src="images/1000x1000.png">
                                                                    </div>
                                                                    <div class="sc_team_item_info">
                                                                        <h5 class="sc_team_item_title">
                                                                            <a href="single-team.html">Dr. Eleonore Grey</a>
                                                                        </h5>
                                                                        <div class="sc_team_item_position">Senior Doctor</div>
                                                                        <div class="sc_team_item_description">Types of bridges may vary, depending upon how they are fabricated.</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="column-1_4 column_padding_bottom">
                                                                <div id="sc_team_910_2" class="sc_team_item">
                                                                    <div class="sc_team_item_avatar">
                                                                        <img width="240" height="240" alt="" src="images/1000x1000.png">
                                                                    </div>
                                                                    <div class="sc_team_item_info">
                                                                        <h5 class="sc_team_item_title">
                                                                            <a href="single-team.html">Dr. Joseph Phillips</a>
                                                                        </h5>
                                                                        <div class="sc_team_item_position">Senior Doctor</div>
                                                                        <div class="sc_team_item_description">Types of bridges may vary, depending upon how they are fabricated.</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="column-1_4 column_padding_bottom">
                                                                <div id="sc_team_910_3" class="sc_team_item">
                                                                    <div class="sc_team_item_avatar">
                                                                        <img width="240" height="240" alt="" src="images/1000x1000.png">
                                                                    </div>
                                                                    <div class="sc_team_item_info">
                                                                        <h5 class="sc_team_item_title">
                                                                            <a href="single-team.html">Dr. Lisa Casey</a>
                                                                        </h5>
                                                                        <div class="sc_team_item_position">Senior Doctor</div>
                                                                        <div class="sc_team_item_description">Types of bridges may vary, depending upon how they are fabricated.</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="column-1_4 column_padding_bottom">
                                                                <div id="sc_team_910_4" class="sc_team_item">
                                                                    <div class="sc_team_item_avatar">
                                                                        <img width="240" height="240" alt="" src="images/1000x1000.png">
                                                                    </div>
                                                                    <div class="sc_team_item_info">
                                                                        <h5 class="sc_team_item_title">
                                                                            <a href="single-team.html">Dr. Nick Kelly</a>
                                                                        </h5>
                                                                        <div class="sc_team_item_position">Senior Doctor</div>
                                                                        <div class="sc_team_item_description">Types of bridges may vary, depending upon how they are fabricated.</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="vc_empty_space space_70p">
                                                    <span class="vc_empty_space_inner"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                <style>
                                .sc_form_style_form_2 .sc_form_item input[type="number"],
                                .sc_form_style_form_2 .sc_form_item input[type="email"],
                                .sc_form_style_form_2 .sc_form_item .js-example-basic-single,
                                .sc_form_style_form_2 .sc_form_item .m-bot15,
                                .sc_form_style_form_2 .sc_form_item .selectpicker,
                                .countrypicker .dropdown-toggle {
                                    margin-bottom: 0.5em;
                                    padding-left: 25px;
                                }

                                .dropdown-menu {
                                    display: none;
                                }

                                .bootstrap-select:not([class*=col-]):not([class*=form-control]):not(.input-group-btn) {
                                    width: 100% !important;
                                }

                                .countrypicker .dropdown-toggle {
                                    width: 100%;
                                    background-color: white;
                                }

                                .countrypicker span {
                                    color: black;
                                }

                                .f16 .bs-placeholder {
                                    border: none !important;
                                    border-bottom: 1px solid #eee !important;

                                }
                                </style>
                                <div data-vc-full-width="true" data-vc-full-width-init="false"
                                    data-vc-stretch-content="true"
                                    class=" wpb_row vc_row-fluid vc_custom_1458055006750 vc_row-no-padding"
                                    id="register_hospital">


                                    <div class="wpb_column vc_column_container vc_col-sm-12">
                                        <div class="vc_column-inner ">
                                            <div class="wpb_wrapper">
                                                <div class="sc_content content_wrap margin_top_huge margin_bottom_huge">
                                                    <div id="sc_form_070_wrap" class="sc_form_wrap">
                                                        <div id="sc_form_070"
                                                            class="sc_form sc_form_style_form_2 margin_top_null margin_bottom_null">
                                                            <h2 class="sc_form_title sc_item_title">Get a Software For
                                                                Your Hospital</h2>
                                                            <div class="sc_form_descr sc_item_descr">You can contact us
                                                                anytime</div>
                                                            <form id="addNewHospital" enctype="multipart/form-data"
                                                                method="post" action="frontend/addNewHospitalPayment">
                                                                <div class="sc_form_info">
                                                                    <div
                                                                        class="columns_wrap sc_columns columns_nofluid sc_columns_count_2">
                                                                        <div
                                                                            class="column-1_2 sc_column_item sc_column_item_1">
                                                                            <div
                                                                                class="wpb_text_column wpb_content_element ">
                                                                                <div class="wpb_wrapper">
                                                                                    <div
                                                                                        class="sc_form_item sc_form_field label_over">
                                                                                        <i
                                                                                            class="icon  icon-user-light"></i>
                                                                                        <label class="required"
                                                                                            for="sc_form_username"><?php echo lang('hospital'); ?>
                                                                                            <?php echo lang('name'); ?>
                                                                                            &ast;</label>
                                                                                        <input id="sc_form_username"
                                                                                            type="text" name="name"
                                                                                            placeholder="<?php echo lang('hospital'); ?> <?php echo lang('name'); ?> *"
                                                                                            required>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="column-1_2 sc_column_item sc_column_item_2">
                                                                            <div
                                                                                class="wpb_text_column wpb_content_element ">
                                                                                <div class="wpb_wrapper">
                                                                                    <div
                                                                                        class="sc_form_item sc_form_field label_over">
                                                                                        <i
                                                                                            class="icon icon-location-light"></i>
                                                                                        <label class="required"
                                                                                            for="sc_form_address">
                                                                                            <?php echo lang('hospital'); ?>
                                                                                            <?php echo lang('address'); ?></label>
                                                                                        <input id="sc_form_address"
                                                                                            type="text" name="address"
                                                                                            placeholder="<?php echo lang('hospital'); ?> <?php echo lang('address'); ?>"
                                                                                            required>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div
                                                                        class="columns_wrap sc_columns columns_nofluid sc_columns_count_2">
                                                                        <div
                                                                            class="column-1_2 sc_column_item sc_column_item_1">
                                                                            <div
                                                                                class="wpb_text_column wpb_content_element ">
                                                                                <div class="wpb_wrapper">
                                                                                    <div
                                                                                        class="sc_form_item sc_form_field label_over">
                                                                                        <i
                                                                                            class="icon icon-mail-light"></i>
                                                                                        <label class="required"
                                                                                            for="sc_form_email"><?php echo lang('hospital'); ?>
                                                                                            <?php echo lang('email'); ?></label>
                                                                                        <input id="sc_form_email"
                                                                                            type="email" name="email"
                                                                                            placeholder="<?php echo lang('hospital'); ?> <?php echo lang('email'); ?>*"
                                                                                            required>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="column-1_2 sc_column_item sc_column_item_2">
                                                                            <div
                                                                                class="wpb_text_column wpb_content_element">
                                                                                <div class="wpb_wrapper">
                                                                                    <div
                                                                                        class="sc_form_item sc_form_field label_over">
                                                                                        <i
                                                                                            class="icon icon-mobile-light"></i>
                                                                                        <label class="required"
                                                                                            for="sc_form_phone"><?php echo lang('hospital'); ?>
                                                                                            <?php echo lang('phone'); ?></label>
                                                                                        <input id="sc_form_phone"
                                                                                            type="number" name="phone"
                                                                                            placeholder="<?php echo lang('hospital'); ?> <?php echo lang('phone'); ?> (Ex. +1-234-567-890)"
                                                                                            required>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div
                                                                        class="columns_wrap sc_columns columns_nofluid sc_columns_count_2">
                                                                        <div
                                                                            class="column-1_2 sc_column_item sc_column_item_1">
                                                                            <div
                                                                                class="wpb_text_column wpb_content_element ">
                                                                                <div class="wpb_wrapper">
                                                                                    <div
                                                                                        class="sc_form_item sc_form_field label_over package_select_div">
                                                                                        <i
                                                                                            class="icon icon-magnifying-glass-2"></i>
                                                                                        <label class="required"
                                                                                            for="sc_form_email"><?php echo lang('package'); ?></label>
                                                                                        <select
                                                                                            class="js-example-basic-single"
                                                                                            id="package_select"
                                                                                            name="package" value=''
                                                                                            required
                                                                                            style="width: 100% !important;">
                                                                                            <option>
                                                                                                <?php echo lang('select'); ?>
                                                                                                <?php echo lang('package'); ?>
                                                                                            </option>
                                                                                            <?php foreach ($packages as $package) { ?>
                                                                                            <option
                                                                                                value="<?php echo $package->id; ?>">
                                                                                                <?php echo $package->name; ?>
                                                                                            </option>
                                                                                            <?php } ?>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="column-1_2 sc_column_item sc_column_item_2">
                                                                            <div
                                                                                class="wpb_text_column wpb_content_element ">
                                                                                <div class="wpb_wrapper">
                                                                                    <div
                                                                                        class="sc_form_item sc_form_field label_over package_duration_div">
                                                                                        <i class="icon icon-spin1"></i>
                                                                                        <label class="required"
                                                                                            for="sc_form_phone"><?php echo lang('package_duration'); ?></label>
                                                                                        <select
                                                                                            class="js-example-basic-single"
                                                                                            id="package_duration"
                                                                                            name="package_duration"
                                                                                            value='' required=""
                                                                                            style="width: 100% !important;">

                                                                                            <option
                                                                                                value="<?php echo 'monthly'; ?>">
                                                                                                <?php echo lang('monthly'); ?>
                                                                                            </option>
                                                                                            <option
                                                                                                value="<?php echo 'yearly'; ?>">
                                                                                                <?php echo lang('yearly'); ?>
                                                                                            </option>

                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div
                                                                        class="columns_wrap sc_columns columns_nofluid sc_columns_count_2">
                                                                        <div
                                                                            class="column-1_2 sc_column_item sc_column_item_1">
                                                                            <div
                                                                                class="wpb_text_column wpb_content_element ">
                                                                                <div class="wpb_wrapper">
                                                                                    <div
                                                                                        class="sc_form_item sc_form_field label_over">
                                                                                        <i
                                                                                            class="icon icon-globe-light"></i>
                                                                                        <label class="required"
                                                                                            for="sc_form_language"><?php echo lang('language'); ?></label>
                                                                                        <select class="m-bot15"
                                                                                            name="language" value=''
                                                                                            required=""
                                                                                            style="width: 100% !important;">
                                                                                            <option value="arabic" <?php
                                                                                                                    if (!empty($settings->language)) {
                                                                                                                        if ($settings->language == 'arabic') {
                                                                                                                            echo 'selected';
                                                                                                                        }
                                                                                                                    }
                                                                                                                    ?>>
                                                                                                <?php echo lang('arabic'); ?>
                                                                                            </option>
                                                                                            <option value="english"
                                                                                                <?php
                                                                                                                    if (!empty($settings->language)) {
                                                                                                                        if ($settings->language == 'english') {
                                                                                                                            echo 'selected';
                                                                                                                        }
                                                                                                                    }
                                                                                                                    ?>selected>
                                                                                                <?php echo lang('english'); ?>
                                                                                            </option>
                                                                                            <option value="spanish" <?php
                                                                                                                    if (!empty($settings->language)) {
                                                                                                                        if ($settings->language == 'spanish') {
                                                                                                                            echo 'selected';
                                                                                                                        }
                                                                                                                    }
                                                                                                                    ?>>
                                                                                                <?php echo lang('spanish'); ?>
                                                                                            </option>
                                                                                            <option value="french" <?php
                                                                                                                    if (!empty($settings->language)) {
                                                                                                                        if ($settings->language == 'french') {
                                                                                                                            echo 'selected';
                                                                                                                        }
                                                                                                                    }
                                                                                                                    ?>>
                                                                                                <?php echo lang('french'); ?>
                                                                                            </option>
                                                                                            <option value="italian" <?php
                                                                                                                    if (!empty($settings->language)) {
                                                                                                                        if ($settings->language == 'italian') {
                                                                                                                            echo 'selected';
                                                                                                                        }
                                                                                                                    }
                                                                                                                    ?>>
                                                                                                <?php echo lang('italian'); ?>
                                                                                            </option>
                                                                                            <option value="portuguese"
                                                                                                <?php
                                                                                                                        if (!empty($settings->language)) {
                                                                                                                            if ($settings->language == 'portuguese') {
                                                                                                                                echo 'selected';
                                                                                                                            }
                                                                                                                        }
                                                                                                                        ?>>
                                                                                                <?php echo lang('portuguese'); ?>
                                                                                            </option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="column-1_2 sc_column_item sc_column_item_2">
                                                                            <div
                                                                                class="wpb_text_column wpb_content_element">
                                                                                <div class="wpb_wrapper">
                                                                                    <div
                                                                                        class="sc_form_item sc_form_field label_over">
                                                                                        <i
                                                                                            class="icon icon-money-light"></i>
                                                                                        <label class="required"
                                                                                            for="sc_form_price">
                                                                                            <?php echo lang('price'); ?></label>
                                                                                        <input class="price-input"
                                                                                            id="sc_form_price"
                                                                                            type="text" name="price"
                                                                                            placeholder="<?php echo lang('price'); ?>"
                                                                                            readonly="" required="">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div
                                                                        class="columns_wrap sc_columns columns_nofluid sc_columns_count_2">
                                                                        <div
                                                                            class="column-1_2 sc_column_item sc_column_item_1">
                                                                            <div
                                                                                class="wpb_text_column wpb_content_element ">
                                                                                <div class="wpb_wrapper">
                                                                                    <div
                                                                                        class="sc_form_item sc_form_field label_over country_div">
                                                                                        <i
                                                                                            class="icon icon-magnifying-glass-2"></i>
                                                                                        <label class="required"
                                                                                            for="sc_form_country"><?php echo lang('country'); ?></label>
                                                                                        <select
                                                                                            class="selectpicker countrypicker"
                                                                                            data-live-search="true"
                                                                                            data-flag="true" required=""
                                                                                            name="country"
                                                                                            style="width: 100%;"></select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="column-1_2 sc_column_item sc_column_item_2">
                                                                            <div
                                                                                class="wpb_text_column wpb_content_element ">
                                                                                <div class="wpb_wrapper">
                                                                                    <div
                                                                                        class="sc_form_item sc_form_field label_over remark_div">
                                                                                        <i class="icon icon-quote"></i>
                                                                                        <label class="required"
                                                                                            for="sc_form_phone"><?php echo lang('remarks'); ?></label>
                                                                                        <input id="sc_form_remarks"
                                                                                            type="text" name="remarks"
                                                                                            placeholder="<?php echo lang('remarks'); ?>"
                                                                                            required>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                          <div
                                                                            class="column-1_2 sc_column_item sc_column_item_2">
                                                                            <div
                                                                                class="wpb_text_column wpb_content_element ">
                                                                                <div class="wpb_wrapper">
                                                                                    <div
                                                                                        class="sc_form_item sc_form_field label_over remark_div">
                                                                                        <i class="icon icon-quote"></i>
                                                                                        <label class="required"
                                                                                            for="sc_form_phone"><?php echo lang('frontend_website_link'); ?></label>
                                                                                        <input 
                                                                                            type="text" name="username" id="username"
                                                                                            placeholder="<?php echo lang('frontend_website_link'); ?>"
                                                                                            required>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <p id="web_link"></p>
                                                                        </div>
                                                                    </div>
                                                                    <style>
                                                                    .center {
                                                                        text-align: center;
                                                                    }
                                                                    </style>
                                                                    <div class="payment_div">
                                                                        <div>
                                                                            <h5 class="center">Payment Details</h5>
                                                                        </div>
                                                                        <?php
                                                                            $payment_gateway = $settings1->payment_gateway;
                                                                            if ($payment_gateway == 'PayPal') {
                                                                            ?>
                                                                        <div
                                                                            class="columns_wrap sc_columns columns_nofluid sc_columns_count_2">
                                                                            <div
                                                                                class="column-1_2 sc_column_item sc_column_item_1">
                                                                                <div
                                                                                    class="wpb_text_column wpb_content_element ">
                                                                                    <div class="wpb_wrapper">
                                                                                        <div
                                                                                            class="sc_form_item sc_form_field label_over">
                                                                                            <i class=""></i>
                                                                                            <label class="required"
                                                                                                for="sc_form_card"><?php echo lang('card'); ?></label>
                                                                                            <select
                                                                                                class="js-example-basic-single"
                                                                                                name="card_type"
                                                                                                style="width: 100%;">
                                                                                                <option
                                                                                                    value="Mastercard">
                                                                                                    <?php echo lang('mastercard'); ?>
                                                                                                </option>
                                                                                                <option value="Visa">
                                                                                                    <?php echo lang('visa'); ?>
                                                                                                </option>
                                                                                                <option
                                                                                                    value="American Express">
                                                                                                    <?php echo lang('american_express'); ?>
                                                                                                </option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div
                                                                                class="column-1_2 sc_column_item sc_column_item_2">
                                                                                <div
                                                                                    class="wpb_text_column wpb_content_element ">
                                                                                    <div class="wpb_wrapper">
                                                                                        <div
                                                                                            class="sc_form_item sc_form_field label_over">
                                                                                            <i class=""></i>
                                                                                            <label class="required"
                                                                                                for="sc_form_carholder"><?php echo lang('cardholder'); ?>
                                                                                                <?php echo lang('name'); ?></label>
                                                                                            <input type="text" class=""
                                                                                                name="cardholder"
                                                                                                value=''
                                                                                                placeholder="<?php echo lang('cardholder'); ?> <?php echo lang('name'); ?>">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>


                                                                        <?php } ?>
                                                                        <?php if ($payment_gateway != 'Pay U Money' && $payment_gateway != 'Paystack') { ?>

                                                                        <div
                                                                            class="columns_wrap sc_columns columns_nofluid sc_columns_count_2">
                                                                            <div
                                                                                class="column-1_2 sc_column_item sc_column_item_1">
                                                                                <div
                                                                                    class="wpb_text_column wpb_content_element ">
                                                                                    <div class="wpb_wrapper">
                                                                                        <div
                                                                                            class="sc_form_item sc_form_field label_over">
                                                                                            <i class=""></i>
                                                                                            <label class="required"
                                                                                                for="sc_form_card"><?php echo lang('card'); ?>
                                                                                                <?php echo lang('number'); ?></label>
                                                                                            <input type="text" class=""
                                                                                                id="card"
                                                                                                name="card_number"
                                                                                                value=''
                                                                                                placeholder="<?php echo lang('card'); ?> <?php echo lang('number'); ?>">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div
                                                                                class="column-1_2 sc_column_item sc_column_item_2 columns_wrap sc_columns columns_nofluid">
                                                                                <!-- <div class="columns_wrap sc_columns columns_nofluid sc_columns_count_2"> -->
                                                                                <div
                                                                                    class="column-1_2 sc_column_item sc_column_item_1">
                                                                                    <div
                                                                                        class="wpb_text_column wpb_content_element ">
                                                                                        <div class="wpb_wrapper">
                                                                                            <div
                                                                                                class="sc_form_item sc_form_field label_over">
                                                                                                <i class=""></i>
                                                                                                <label class="required"
                                                                                                    for="sc_form_carholder"><?php echo lang('expire'); ?>
                                                                                                    <?php echo lang('date'); ?></label>
                                                                                                <input type="text"
                                                                                                    class="" id="expire"
                                                                                                    data-date=""
                                                                                                    data-date-format="MM YY"
                                                                                                    placeholder="Expiry (MM/YY)"
                                                                                                    name="expire_date"
                                                                                                    maxlength="7"
                                                                                                    aria-describedby="basic-addon1"
                                                                                                    value=''
                                                                                                    placeholder=""
                                                                                                    required="">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div
                                                                                    class="column-1_2 sc_column_item sc_column_item_2">
                                                                                    <div
                                                                                        class="wpb_text_column wpb_content_element ">
                                                                                        <div class="wpb_wrapper">
                                                                                            <div
                                                                                                class="sc_form_item sc_form_field label_over">
                                                                                                <i class=""></i>
                                                                                                <label class="required"
                                                                                                    for="sc_form_carholder"><?php echo lang('cvv'); ?></label>
                                                                                                <input type="text"
                                                                                                    class="" id="cvv"
                                                                                                    name="cvv_number"
                                                                                                    value=""
                                                                                                    placeholder="<?php echo lang('cvv'); ?>"
                                                                                                    maxlength="3"
                                                                                                    required="">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <!-- </div> -->
                                                                            </div>
                                                                        </div>


                                                                        <?php
                                                                            }
                                                                            ?>
                                                                    </div>
                                                                    <div id="token"></div>
                                                                    <div
                                                                        class="col-md-12 form-group trial_version_div_div">
                                                                        <input type="checkbox" name="trial_version"
                                                                            value="1" class="trial_version">
                                                                        <label class="trial_version"
                                                                            for="exampleInputEmail1"><?php echo lang('do_you_want_trial_version'); ?></label>
                                                                    </div>
                                                                    <input type="hidden" name="request" value=''>
                                                                    <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
                                                                </div> <!-- normal div end-->

                                                                <div class=" ">
                                                                    <button type="submit" value="submit"
                                                                        class="aligncenter submit_button"
                                                                        id="submit-btn"
                                                                        <?php if ($settings1->payment_gateway == 'Stripe') {
                                                                                                                                            ?>onClick="stripePay(event);"
                                                                        <?php }
                                                                                                                                                                            ?>>
                                                                        <?php echo lang('submit'); ?></button>

                                                                </div>
                                                                <!-- <div class="result sc_infobox"></div> -->
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- <div class="vc_empty_space space_10p">
                                                    <span class="vc_empty_space_inner"></span>
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div data-vc-full-width="true" data-vc-full-width-init="false" id="contact_us"
                                    data-vc-stretch-content="true"
                                    class="vc_row wpb_row vc_row-fluid vc_custom_1458055006750 vc_row-no-padding">
                                    <div class="wpb_column vc_column_container vc_col-sm-12">
                                        <div class="vc_column-inner ">
                                            <div class="wpb_wrapper">
                                                <div class="sc_content content_wrap margin_top_huge margin_bottom_huge">
                                                    <div id="sc_form_070_wrap" class="sc_form_wrap">
                                                        <div id="sc_form_070"
                                                            class="sc_form sc_form_style_form_2 margin_top_null margin_bottom_null">
                                                            <h2 class="sc_form_title sc_item_title">
                                                                <?php echo $settings->contact_us; ?></h2>
                                                            <div class="sc_form_descr sc_item_descr">You can contact us
                                                                anytime</div>
                                                            <form action="frontend/send" id="sendEmail"
                                                                enctype="multipart/form-data" method="POST">
                                                                <div class="sc_form_info">
                                                                    <div
                                                                        class="columns_wrap sc_columns columns_nofluid sc_columns_count_2">
                                                                        <div
                                                                            class="column-1_2 sc_column_item sc_column_item_1">
                                                                            <div
                                                                                class="wpb_text_column wpb_content_element ">
                                                                                <div class="wpb_wrapper">
                                                                                    <div
                                                                                        class="sc_form_item sc_form_field label_over">
                                                                                        <i
                                                                                            class="icon  icon-user-light"></i>
                                                                                        <label class="required"
                                                                                            for="sc_form_username">Name</label>
                                                                                        <input id="sc_form_username"
                                                                                            type="text" name="username"
                                                                                            placeholder="Name *"
                                                                                            required>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="column-1_2 sc_column_item sc_column_item_2">
                                                                            <div
                                                                                class="wpb_text_column wpb_content_element ">
                                                                                <div class="wpb_wrapper">
                                                                                    <div
                                                                                        class="sc_form_item sc_form_field label_over">
                                                                                        <i
                                                                                            class="icon icon-mobile-light"></i>
                                                                                        <label class="required"
                                                                                            for="sc_form_phone">Phone</label>
                                                                                        <input id="sc_form_phone"
                                                                                            type="text" name="phone"
                                                                                            placeholder="Phone (Ex. +1-234-567-890)"
                                                                                            required>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div
                                                                        class="columns_wrap sc_columns columns_nofluid sc_columns_count_2">
                                                                        <div
                                                                            class="column-1_2 sc_column_item sc_column_item_1">
                                                                            <div
                                                                                class="wpb_text_column wpb_content_element ">
                                                                                <div class="wpb_wrapper">
                                                                                    <div
                                                                                        class="sc_form_item sc_form_field label_over">
                                                                                        <i
                                                                                            class="icon icon-mail-light"></i>
                                                                                        <label class="required"
                                                                                            for="sc_form_email">E-mail</label>
                                                                                        <input id="sc_form_email"
                                                                                            type="text"
                                                                                            name="other_email"
                                                                                            placeholder="E-mail *"
                                                                                            required>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="column-1_2 sc_column_item sc_column_item_2">
                                                                            <div
                                                                                class="wpb_text_column wpb_content_element ">
                                                                                <div class="wpb_wrapper">
                                                                                    <div
                                                                                        class="sc_form_item sc_form_field label_over">
                                                                                        <i
                                                                                            class="icon icon-medic-14"></i>
                                                                                        <label class="required"
                                                                                            for="sc_form_doctor"><?php echo lang('hospital'); ?>
                                                                                            <?php echo lang('name'); ?></label>
                                                                                        <input id="sc_form_doctor"
                                                                                            type="text"
                                                                                            name="hospital_name"
                                                                                            placeholder="<?php echo lang('hospital'); ?> <?php echo lang('name'); ?>"
                                                                                            required>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="sc_form_item sc_form_message label_over">
                                                                    <label class="required"
                                                                        for="sc_form_message">Message</label>
                                                                    <textarea id="sc_form_message" data-autoresize
                                                                        rows="1" name="msg"
                                                                        placeholder="Message"></textarea>
                                                                </div>
                                                                <input type="hidden" name="request" value=''>
                                                                <input type="hidden" id="g-token" name="g-token"
                                                                    value=''>
                                                                <div class="sc_form_item sc_form_button">
                                                                    <button class="aligncenter">Contact Us</button>
                                                                </div>
                                                                <div class="result sc_infobox"></div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="vc_empty_space space_10p">
                                                    <span class="vc_empty_space_inner"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="vc_row-full-width"></div>






                                <style>
                                .cd-pricing-switcher {
                                    display: flex;
                                    justify-content: center;
                                    align-items: center;
                                    margin-bottom: 20px;
                                }

                                .cd-pricing-switcher .fieldset {
                                    display: flex;
                                    align-items: center;
                                    gap: 10px;
                                }

                                .cd-pricing-switcher input[type="radio"] {
                                    display: none;
                                }

                                .cd-pricing-switcher label {
                                    padding: 10px 20px;
                                    border: 2px solid #007bff;
                                    border-radius: 30px;
                                    cursor: pointer;
                                    transition: background-color 0.3s, color 0.3s;
                                }

                                .cd-pricing-switcher input[type="radio"]:checked+label {
                                    background-color: #007bff;
                                    color: #fff;
                                }

                                .cd-pricing-switcher .cd-switch {
                                    display: none;
                                }

                                .hidden {
                                    display: none;
                                }
                                </style>

<section id="doctors">
    <div class="st-height-b120 st-height-lg-b80"></div>
    <div class="">
        <div class="st-section-heading st-style1 text-center">
            <h2 class="st-section-heading-title">Meet Our Top Doctors</h2>
            <div class="st-seperator">
                <div class="st-seperator-left wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.2s"></div>
                <div class="st-seperator-center"><img src="themes/assets/img/icons/plus.webp" alt="icon"></div>
                <div class="st-seperator-right wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.2s"></div>
            </div>
            <?php
            $text = $settings->doctor_block__text_under_title;
            $words = explode(' ', $text);
            $first_six_words = array_slice($words, 0, 12);
            $remaining_words = array_slice($words, 12);
            $first_section = implode(' ', $first_six_words);
            $second_section = implode(' ', $remaining_words);
            ?>
            <div class="st-section-heading-subtitle"><?php echo $first_section; ?> <br> <?php echo $second_section; ?></div>
        </div>
        <div class="st-height-b40 st-height-lg-b40"></div>
    </div>
    <div class="">
        <div class="st-doctors-grid">
            <?php foreach ($featureds as $featured) { ?>
            <div class="st-doctor-card">
                <div class="st-member st-style1 st-zoom">
                    <div class="st-member-img">
                        <img style="height:329px; width:255px;" src="<?php echo $featured->img_url; ?>" alt="" class="st-zoom-in">
                       
                        
                    </div>
                    <div class="st-member-meta">
                        <div class="st-member-meta-in">
                            <h3 class="st-member-name"><a href=""><?php echo $featured->name; ?></a></h3>
                            <div class="st-member-designation"><?php echo $featured->profile; ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
    <div class="st-height-b120 st-height-lg-b80"></div>
</section>

<style>
.st-doctors-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
}

.st-doctor-card {
    flex: 1 1 calc(25% - 20px);
    max-width: calc(25% - 20px);
    box-sizing: border-box;
}

@media (max-width: 1200px) {
    .st-doctor-card {
        flex: 1 1 calc(33.33% - 20px);
        max-width: calc(33.33% - 20px);
    }
}

@media (max-width: 992px) {
    .st-doctor-card {
        flex: 1 1 calc(50% - 20px);
        max-width: calc(50% - 20px);
    }
}

@media (max-width: 768px) {
    .st-doctor-card {
        flex: 1 1 100%;
        max-width: 100%;
    }
}

.st-member {
    background: #fff;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
}

.st-member:hover {
    transform: translateY(-5px);
}

.st-member-img img {
    width: 100%;
    border-radius: 10px 10px 0 0;
}

.st-member-meta {
    padding: 20px;
    text-align: center;
}

.st-member-name a {
    font-size: 20px;
    font-weight: bold;
    color: #007bff;
    text-decoration: none;
}

.st-member-name a:hover {
    color: #0056b3;
}

.st-member-designation {
    font-size: 14px;
    color: #777;
    margin-bottom: 10px;
}
</style>
        <hr>
        <!-- Start gallery Section -->
        <section id="gallery">
    <div class="st-height-b120 st-height-lg-b80"></div>
    <div class="">
        <div class="st-section-heading st-style1 text-center">
            <h2 class="st-section-heading-title">View our gallery</h2>
            <div class="st-seperator">
                <div class="st-seperator-left wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.2s"></div>
                <div class="st-seperator-center"><img src="themes/assets/img/icons/plus.webp" alt="icon"></div>
                <div class="st-seperator-right wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.2s"></div>
            </div>
            <?php
          $text = $settings->gallery_text_under_title;
          $words = explode(' ', $text);
          $first_six_words = array_slice($words, 0, 12);
          $remaining_words = array_slice($words, 12);
          $first_section = implode(' ', $first_six_words);
          $second_section = implode(' ', $remaining_words);
          
          ?>
                    <div class="st-section-heading-subtitle"><?php echo $first_section; ?> <br> <?php echo $second_section; ?></div>
        </div>
        <div class="st-height-b40 st-height-lg-b40"></div>
    </div>
    <div class="">
        <div class="st-portfolio-wrapper">
            <div class="st-isotop st-style1 st-port-col-4 st-has-gutter st-lightgallery">
                <div class="st-grid-sizer"></div>
                <?php foreach ($images as $image) { ?>
                <div class="st-isotop-item <?php echo $image->position; ?>">
                    <a href="<?php echo $image->img; ?>" class="st-project st-zoom st-lightbox-item st-link-hover-wrap">
                        <div class="st-project-img st-zoom-in"><img style="height:286px; width:100%;" src="<?php echo $image->img; ?>" alt="project1"></div>
                        <span class="st-link-hover"><i class="fas fa-arrows-alt"></i></span>
                    </a>
                </div><!-- .st-isotop-item -->
                <?php } ?>
            </div><!-- .isotop -->
        </div>
    </div>
    <div class="st-height-b120 st-height-lg-b80"></div>
</section>

<style>
.st-isotop {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
}

.st-isotop-item {
    flex: 1 1 calc(25% - 20px);
    max-width: calc(25% - 20px);
    box-sizing: border-box;
}

@media (max-width: 1200px) {
    .st-isotop-item {
        flex: 1 1 calc(33.33% - 20px);
        max-width: calc(33.33% - 20px);
    }
}

@media (max-width: 992px) {
    .st-isotop-item {
        flex: 1 1 calc(50% - 20px);
        max-width: calc(50% - 20px);
    }
}

@media (max-width: 768px) {
    .st-isotop-item {
        flex: 1 1 100%;
        max-width: 100%;
    }
}

.st-project {
    background: #fff;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
}

.st-project:hover {
    transform: translateY(-5px);
}

.st-project-img img {
    width: 100%;
    border-radius: 10px 10px 0 0;
}

.st-link-hover {
    display: flex;
    justify-content: center;
    align-items: center;
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    color: #fff;
    font-size: 24px;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.st-project:hover .st-link-hover {
    opacity: 1;
}
</style>
        <!-- End gallery Section -->

       


                                <!-- Start FAQ Section -->
                                <div class="vc_row wpb_row vc_row-fluid  vc_row-no-padding" style="margin-top:90px;">
                                    <div class="wpb_column vc_column_container vc_col-sm-12">
                                        <div class="vc_column-inner ">
                                            <div class="wpb_wrapper">

                                                <div class="">
                                                    <div class="row align-items-center">
                                                        <div class="col-lg-6 text-center">
                                                            <div class="st-faq-img">
                                                                <img src="themes/assets/img/faq-img.png" alt="Faq Image"
                                                                    class="img-fluid">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <h2 class="st-accordian-heading text-center text-lg-start">
                                                                Frequently Asked Questions (FAQs)</h2>
                                                            <div class="st-accordian-wrap">
                                                                <?php foreach ($faqs as $faq) { ?>
                                                                <div class="st-accordian">
                                                                    <div class="st-accordian-title">
                                                                        <?php echo $faq->title; ?>
                                                                        <span
                                                                            class="st-accordian-toggle fa fa-angle-down"></span>
                                                                    </div>
                                                                    <div class="st-accordian-body">
                                                                        <?php echo $faq->description; ?>
                                                                    </div>
                                                                </div>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End FAQ Section -->

                                <style>
                                .st-faq-wrap {
                                    position: relative;
                                    padding: 80px 0;
                                    background: #f9f9f9;
                                }

                                .st-accordian-wrap {
                                    max-width: 100%;
                                }

                                .st-accordian {
                                    background: #fff;
                                    border-radius: 10px;
                                    margin-bottom: 10px;
                                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                                    overflow: hidden;
                                }

                                .st-accordian-title {
                                    padding: 15px;
                                    font-size: 18px;
                                    font-weight: bold;
                                    background: #007bff;
                                    color: #fff;
                                    cursor: pointer;
                                    display: flex;
                                    justify-content: space-between;
                                    align-items: center;
                                    border-radius: 10px;
                                }

                                .st-accordian-title:hover {
                                    background: #0056b3;
                                }

                                .st-accordian-body {
                                    padding: 15px;
                                    display: none;
                                    font-size: 16px;
                                    background: #fff;
                                    color: #333;
                                    border-top: 1px solid #ddd;
                                }

                                .st-accordian-toggle {
                                    transition: transform 0.3s ease;
                                }

                                .st-accordian.active .st-accordian-toggle {
                                    transform: rotate(180deg);
                                }

                                .st-accordian.active .st-accordian-body {
                                    display: block;
                                }

                                @media (max-width: 768px) {
                                    .st-faq-img {
                                        margin-bottom: 20px;
                                    }

                                    .st-accordian-title {
                                        font-size: 16px;
                                    }

                                    .st-accordian-body {
                                        font-size: 14px;
                                    }
                                }
                                </style>

                                <script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    document.querySelectorAll(".st-accordian-title").forEach(item => {
                                        item.addEventListener("click", function() {
                                            const parent = this.parentElement;
                                            parent.classList.toggle("active");
                                        });
                                    });
                                });
                                </script>




                                <section id="blog" class="">
                                    <div class="">
                                        <div class="st-section-heading st-style1 text-center">
                                            <h2 class="st-section-heading-title">News & Updates</h2>
                                            <div class="st-seperator">
                                                <div class="st-seperator-left wow fadeInLeft" data-wow-duration="1s"
                                                    data-wow-delay="0.2s"></div>
                                                <div class="st-seperator-center"><img
                                                        src="themes/assets/img/icons/plus.webp" alt="icon"></div>
                                                <div class="st-seperator-right wow fadeInRight" data-wow-duration="1s"
                                                    data-wow-delay="0.2s"></div>
                                            </div>
                                            <?php
          $text1 = $settings->news_text_under_title;
          $words1 = explode(' ', $text1);
          $first_six_words1 = array_slice($words1, 0, 12);
          $remaining_words1 = array_slice($words1, 12);
          $first_section1 = implode(' ', $first_six_words1);
          $second_section1 = implode(' ', $remaining_words1);
          
          ?>
                    <div class="st-section-heading-subtitle">
                        <?php echo $first_section1; ?><br><?php echo $second_section1; ?></div>
                                        </div>
                                        <div class="row">
                                            <?php foreach ($blogs as $blog) { ?>
                                            <div class="col-lg-4 col-md-6">
                                                <div class="st-post st-style3">
                                                    <a href="<?php echo $blog->button_link; ?>" class="st-post-thumb st-link-hover-wrap st-zoom">
                                                        <img class="st-zoom-in" src="<?php echo $blog->img_url; ?>"
                                                            alt="blog1">

                                                    </a>
                                                    <div class="st-post-info">
                                                        <h3 class="st-post-title"><a href="#">
                                                                <?php echo $blog->title; ?> </a></h3>
                                                        <div class="st-post-meta">
                                                            <span class="st-post-date">
                                                                <?php echo date('d-m-Y', $blog->date); ?> </span>
                                                            <span> | Posted by: <a href="#" class="st-post-avatar">
                                                                    <?php echo $blog->posted_by; ?> </a> </span>
                                                        </div>
                                                        <p class="st-post-text">
                                                            <?php echo substr($blog->description, 0, 100) . '...'; ?>
                                                        </p>
                                                        <a href="blog-details-right-sidebar.html"
                                                            class="st-btn st-style2 st-color1 st-size-medium">Read
                                                            More</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </section>

                                <style>
                                .st-blog-section {
                                    padding: 80px 0;
                                    background: #f9f9f9;
                                }

                                .st-section-heading-title {
                                    font-size: 32px;
                                    font-weight: bold;
                                    margin-bottom: 20px;
                                }

                                .st-section-heading-subtitle {
                                    font-size: 18px;
                                    color: #666;
                                    max-width: 600px;
                                    margin: 0 auto 40px;
                                }

                                .st-post {
                                    background: #fff;
                                    border-radius: 10px;
                                    overflow: hidden;
                                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                                    transition: transform 0.3s ease;
                                }

                                .st-post:hover {
                                    transform: translateY(-5px);
                                }

                                .st-post-thumb img {
                                    width: 100%;
                                    border-radius: 10px 10px 0 0;
                                }

                                .st-post-info {
                                    padding: 20px;
                                    text-align: center;
                                }

                                .st-post-title a {
                                    font-size: 20px;
                                    font-weight: bold;
                                    color: #007bff;
                                    text-decoration: none;
                                }

                                .st-post-title a:hover {
                                    color: #0056b3;
                                }

                                .st-post-meta {
                                    font-size: 14px;
                                    color: #777;
                                    margin-bottom: 10px;
                                }

                                .st-post-text {
                                    font-size: 16px;
                                    color: #333;
                                }

                                .st-btn {
                                    display: inline-block;
                                    margin-top: 10px;
                                    padding: 10px 20px;
                                    background: #007bff;
                                    color: #fff;
                                    border-radius: 5px;
                                    text-decoration: none;
                                }

                                .st-btn:hover {
                                    background: #0056b3;
                                }

                                @media (max-width: 768px) {
                                    .st-post {
                                        margin-bottom: 20px;
                                    }
                                }
                                </style>


                                <section class="newsletter-section" style="background-color: #fff !important;">
                                    <div class="">
                                        <h2>Subscribe & stay updated</h2>
                                        <?php
          $text1 = $settings->subscribe_text_under_title;
          $words1 = explode(' ', $text1);
          $first_six_words1 = array_slice($words1, 0, 12);
          $remaining_words1 = array_slice($words1, 12);
          $first_section1 = implode(' ', $first_six_words1);
          $second_section1 = implode(' ', $remaining_words1);
          
          ?>
                    <div class="st-section-heading-subtitle">
                        <?php echo $first_section1; ?><br><?php echo $second_section1; ?></div>
                                        <form class="newsletter-form" action="frontend/addSubscribe" method="post">
                                            <input type="email" name="email" placeholder="Enter your email address"
                                                required>
                                                <input type="hidden" name="recaptcha_token" id="recaptchaToken">
                                            <button type="submit">Subscribe</button>
                                        </form>
                                    </div>
                                </section>
                                <style>
                                .newsletter-section {
                                    background: #f8f9fa;
                                    padding: 50px 0;
                                    text-align: center;
                                }

                                .newsletter-section h2 {
                                    font-size: 2rem;
                                    margin-bottom: 10px;
                                }

                                .newsletter-section p {
                                    font-size: 1rem;
                                    color: #666;
                                    margin-bottom: 20px;
                                }

                                .newsletter-form {
                                    display: flex;
                                    justify-content: center;
                                    gap: 10px;
                                }

                                .newsletter-form input {
                                    padding: 10px;
                                    border: 1px solid #ddd;
                                    border-radius: 5px;
                                    width: 300px;
                                }

                                .newsletter-form button {
                                    background: #007bff;
                                    color: #fff;
                                    border: none;
                                    padding: 10px 20px;
                                    border-radius: 5px;
                                    cursor: pointer;
                                    transition: background 0.3s ease;
                                }

                                .newsletter-form button:hover {
                                    background: #0056b3;
                                }
                                </style>























                                <div data-vc-full-width="true" data-vc-full-width-init="false"
                                    class="vc_row wpb_row vc_row-fluid vc_custom_1457963984421 scheme_dark">
                                    <div class="wpb_column vc_column_container vc_col-sm-12">
                                        <div class="vc_column-inner ">
                                            <div class="wpb_wrapper">
                                                <div class="vc_empty_space space_95p">
                                                    <span class="vc_empty_space_inner"></span>
                                                </div>
                                                <div id="sc_testimonials_215"
                                                    class="sc_testimonials sc_testimonials_style_testimonials-4 sc_testimonials_inverse ">
                                                    <h2 class="sc_testimonials_title sc_item_title">Our happy Clients
                                                    </h2>
                                                    <div class="sc_testimonials_descr sc_item_descr">What our Clients
                                                        say</div>
                                                    <div class="sc_slider_swiper swiper-slider-container sc_slider_pagination sc_slider_pagination_bottom sc_slider_nocontrols"
                                                        data-interval="9895" data-slides-per-view="2"
                                                        data-slides-space="20" data-slides-min-width="250">
                                                        <div class="slides swiper-wrapper">
                                                            <div class="swiper-slide" data-style="width:100%;">
                                                                <div id="sc_testimonials_215_1"
                                                                    class="sc_testimonial_item">
                                                                    <div class="sc_testimonial_content">
                                                                        <p>
                                                                            Works amazingly well for our Pharmacy and
                                                                            all our operations.
                                                                        </p>
                                                                        <div class="sc_testimonial_author">
                                                                            <span
                                                                                class="sc_testimonial_author_name">Olaitan
                                                                                Lawal</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="sc_testimonial_avatar">
                                                                        <img width="120" height="120" alt=""
                                                                            src="front/assets_new/images/ph-1000x1000.png">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="swiper-slide" data-style="width:100%;">
                                                                <div id="sc_testimonials_215_2"
                                                                    class="sc_testimonial_item">
                                                                    <div class="sc_testimonial_content">
                                                                        <p>
                                                                            The UI is easy to handle and it is user
                                                                            friendly!
                                                                        </p>
                                                                        <div class="sc_testimonial_author">
                                                                            <span class="sc_testimonial_author_name">Dr.
                                                                                Jenny Walker</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="sc_testimonial_avatar">
                                                                        <img width="120" height="120" alt=""
                                                                            src="front/assets_new/images/dr-1000x1000.png">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="sc_slider_controls_wrap">
                                                            <a class="sc_slider_prev" href="#"></a>
                                                            <a class="sc_slider_next" href="#"></a>
                                                        </div>
                                                        <div class="sc_slider_pagination_wrap"></div>
                                                    </div>
                                                </div>
                                                <div class="vc_empty_space space_100p">
                                                    <span class="vc_empty_space_inner"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="vc_row-full-width"></div>
                                <!--<div class="vc_row wpb_row vc_row-fluid">
                                    <div class="wpb_column vc_column_container vc_col-sm-12">
                                        <div class="vc_column-inner ">
                                            <div class="wpb_wrapper">
                                                <div class="vc_empty_space space_95p">
                                                    <span class="vc_empty_space_inner"></span>
                                                </div>
                                                <div id="sc_blogger_082" class="sc_blogger layout_plain template_plain margin_bottom_null sc_blogger_horizontal no_description">
                                                    <h2 class="sc_blogger_title sc_item_title">Latest Clinic News</h2>
                                                    <div class="sc_blogger_descr sc_item_descr">This is optional subheading</div>
                                                    <div class="post_item sc_blogger_item sc_plain_item sc_blogger_item_last">
                                                        <h6 class="post_title">
                                                            <a href="single-post.html">New NICE guidelines aim to improve quality of dentistry provision in the UK</a>
                                                        </h6>
                                                        <p></p>
                                                        <div class="post_info ">
                                                            <span class="post_info_item post_info_posted">
                                                                <a href="single-post.html" class="post_info_date">August 11, 2015</a>
                                                            </span>
                                                            <span class="post_info_item post_info_posted_by">by
                                                                <a href="single-post.html" class="post_info_author">John Doe</a>
                                                            </span>
                                                            <span class="post_info_item post_info_tags">in
                                                                <a class="category_link" href="#">News plain</a>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="sc_blogger_015" class="sc_blogger layout_plain template_plain margin_top_null margin_bottom_null sc_blogger_horizontal">
                                                    <div class="post_item sc_blogger_item sc_plain_item sc_blogger_item_last">
                                                        <h6 class="post_title">
                                                            <a href="single-post.html">Beyond tooth decay: why good dental hygiene is important</a>
                                                        </h6>
                                                        <p>Dentistry is the science and art of preventing, diagnosing and treating disease, injuries and malformations of the teeth, jaws and mouth. Good...</p>
                                                        <div class="post_info ">
                                                            <span class="post_info_item post_info_posted">
                                                                <a href="single-post.html" class="post_info_date">August 11, 2015</a>
                                                            </span>
                                                            <span class="post_info_item post_info_posted_by">by
                                                                <a href="single-post.html" class="post_info_author">John Doe</a>
                                                            </span>
                                                            <span class="post_info_item post_info_tags">in
                                                                <a class="category_link" href="#">News plain</a>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="sc_blogger_704" class="sc_blogger layout_plain template_plain margin_top_null sc_blogger_horizontal no_description">
                                                    <div class="post_item sc_blogger_item sc_plain_item sc_blogger_item_last">
                                                        <h6 class="post_title">
                                                            <a href="single-post.html">Stress in pregnancy may raise risk for dental caries in offspring</a>
                                                        </h6>
                                                        <p></p>
                                                        <div class="post_info ">
                                                            <span class="post_info_item post_info_posted">
                                                                <a href="single-post.html" class="post_info_date">August 11, 2015</a>
                                                            </span>
                                                            <span class="post_info_item post_info_posted_by">by
                                                                <a href="single-post.html" class="post_info_author">John Doe</a>
                                                            </span>
                                                            <span class="post_info_item post_info_tags">in
                                                                <a class="category_link" href="#">News plain</a>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="sc_blogger_button sc_item_button">
                                                        <a href="classic.html" class="sc_button sc_button_square sc_button_style_ sc_button_size_medium">More news</a>
                                                    </div>
                                                </div>
                                                <div class="vc_empty_space space_95p">
                                                    <span class="vc_empty_space_inner"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>-->
                                <style>
                                .gmap_canvas {
                                    position: relative;
                                    padding-bottom: 75%;
                                    height: 0;
                                    overflow: hidden;
                                }

                                .gmap_canvas iframe {
                                    position: absolute;
                                    top: 0;
                                    left: 0;
                                    width: 100% !important;
                                    height: 100% !important;
                                }
                                </style>

                                <div class="vc_row-full-width"></div>
                                <div data-vc-full-width="true" data-vc-full-width-init="false"
                                    data-vc-stretch-content="true"
                                    class="vc_row wpb_row vc_row-fluid vc_row-no-padding">
                                    <div class="wpb_column vc_column_container vc_col-sm-12">
                                        <div class="vc_column-inner ">
                                            <div class="wpb_wrapper">
                                                <div id="sc_googlemap_762" class="mapouter" data-zoom="16"
                                                    data-style="ultra_light">
                                                    <div class="gmap_canvas" id="sc_googlemap_762_1">

                                                        <iframe width="100%" height="257" id="gmap_canvas"
                                                            src="https://maps.google.com/maps?q=montreal,Canada&t=&z=9&ie=UTF8&iwloc=&output=embed"
                                                            frameborder="0" scrolling="no" marginheight="0"
                                                            marginwidth="0"></iframe><a
                                                            href="https://fmovies-online.net"></a><br>
                                                        <style>
                                                        .mapouter {
                                                            position: relative;
                                                            text-align: right;
                                                            height: 257px;
                                                            width: 100%;
                                                        }
                                                        </style><a href="https://www.embedgooglemap.net">google map
                                                            html</a>
                                                        <style>
                                                        .gmap_canvas {
                                                            overflow: hidden;
                                                            background: none !important;
                                                            height: 257px;
                                                            width: 100%;
                                                        }
                                                        </style>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="vc_row-full-width"></div>
                                <div data-vc-full-width="true" data-vc-full-width-init="false" data-vc-stretch-content="true" class="vc_row wpb_row vc_row-fluid vc_row-no-padding">
                                    <div class="wpb_column vc_column_container vc_col-sm-12">
                                        <div class="vc_column-inner ">
                                            <div class="wpb_wrapper">
                                                <div id="sc_googlemap_762" class="mapouter" data-zoom="16" data-style="ultra_light">
                                                    <div id="sc_googlemap_762_1" class="sc_googlemap_marker" data-title="" data-description="" data-address="Soho, New York" data-latlng="" data-point="front/assets_new/images/map_marker_small.png"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="vc_row-full-width"></div>
                                <div data-vc-full-width="true" data-vc-full-width-init="false"
                                    data-vc-stretch-content="true" class="vc_row wpb_row vc_row-fluid">
                                    <div class="wpb_column vc_column_container vc_col-sm-12">
                                        <div class="vc_column-inner ">
                                            <div class="wpb_wrapper">
                                                <div class="sc_content content_wrap">
                                                    <div id="sc_services_528_wrap" class="sc_services_wrap">
                                                        <div id="sc_services_528"
                                                            class="sc_services sc_services_style_services-2 sc_services_type_icons margin_top_small margin_bottom_small- alignleft">
                                                            <div class="sc_columns columns_wrap">
                                                                <div class="column-1_3 column_padding_bottom">
                                                                    <div id="sc_services_528_1"
                                                                        class="sc_services_item sc_services_item_1">
                                                                        <span
                                                                            class="sc_icon icon-location-light"></span>
                                                                        <div class="sc_services_item_content">
                                                                            <h4 class="sc_services_item_title">Our
                                                                                Address</h4>
                                                                            <div class="sc_services_item_description">
                                                                                <p><?php echo $settings->address; ?></p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="column-1_3 column_padding_bottom">
                                                                    <div id="sc_services_528_2"
                                                                        class="sc_services_item sc_services_item_2">
                                                                        <span class="sc_icon icon-mobile-light"></span>
                                                                        <div class="sc_services_item_content">
                                                                            <h4 class="sc_services_item_title">Phone
                                                                            </h4>
                                                                            <div class="sc_services_item_description">
                                                                                <p>Support
                                                                                    <?php echo $settings->support; ?>
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="column-1_3 column_padding_bottom">
                                                                    <div id="sc_services_528_3"
                                                                        class="sc_services_item sc_services_item_3">
                                                                        <span
                                                                            class="sc_icon icon-calendar-light"></span>
                                                                        <div class="sc_services_item_content">
                                                                            <h4 class="sc_services_item_title">Open
                                                                                Hours</h4>
                                                                            <div class="sc_services_item_description">
                                                                                <p>Mn - St: 8:00am - 9:00pm Sn: Closed
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="vc_row-full-width"></div>
                            </section>
                        </article>
                        <section class="related_wrap related_wrap_empty"></section>
                    </div>
                </div>
            </div>
            <footer class="footer_wrap widget_area scheme_dark">
                <div class="footer_wrap_inner widget_area_inner">
                    <div class="content_wrap">
                        <div class="columns_wrap">
                            <aside class="column-1_3 widget widget_socials">
                                <div class="widget_inner">
                                    <div class="logo">
                                        <a href="frontend">
                                            <img style="    margin: 0.3em -8.2143em 0 0 !important; width:200px !important; height:60px !important;" src="<?php
                                                if (!empty($settings->logo)) {
                                                    if (file_exists($settings->logo)) {
                                                        echo $settings->logo ;
                                                    } else {
                                                        echo $title[0] . '<span> ' . $title[1] . '</span>';
                                                    }
                                                } else {
                                                    echo $title[0] . '<span> ' . $title[1] . '</span>';
                                                }
                                                ?>" class="logo_main" alt="" width="168" height="42">
                                        </a>
                                    </div>
                                    <div class="logo_descr">
                                        Our focus is on your overall well being and helping you achieve optimal health
                                        and esthetics.
                                        We provide stateof the art dental care.
                                        <br />
                                        <br /> Types of bridges may vary, depending upon how they are fabricated and the
                                        way they
                                    </div>
                                    <div
                                        class="sc_socials sc_socials_type_icons sc_socials_shape_square sc_socials_size_tiny">
                                        <div class="sc_socials_item">
                                            <a href="<?php echo $settings->twitter_id; ?>" target="_blank"
                                                class="social_icons social_twitter">
                                                <span class="icon-twitter"></span>
                                            </a>
                                        </div>
                                        <div class="sc_socials_item">
                                            <a href="<?php echo $settings->google_id; ?>" target="_blank"
                                                class="social_icons social_gplus">
                                                <span class="icon-gplus"></span>
                                            </a>
                                        </div>
                                        <div class="sc_socials_item">
                                            <a href="<?php echo $settings->facebook_id; ?>" target="_blank"
                                                class="social_icons social_facebook">
                                                <span class="icon-facebook"></span>
                                            </a>
                                        </div>
                                        <div class="sc_socials_item">
                                            <a href="<?php echo $settings->skype_id; ?>" target="_blank"
                                                class="social_icons social_skype">
                                                <span class="icon-skype"></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </aside>
                            <style>
                            .footer_message {
                                color: white;
                                line-height: 2em;
                            }
                            </style>
                            <aside class="column-1_3 widget widget_recent_posts">
                                <h5 class="widget_title">Company Info</h5>
                                <article class="post_item with_thumb">
                                    <!-- <div class="post_thumb">
                                        <img width="75" height="75" alt="" src="images/1000x1000.png">
                                    </div> -->
                                    <div class="post_content">
                                        <h6 class="post_title">
                                            <span class="footer_message">Address:</span> &emsp;
                                            <?php echo $settings->address; ?>
                                        </h6>
                                        <h6 class="post_title">
                                            <span class="footer_message">Emergency:</span> &emsp;
                                            <?php echo $settings->emergency; ?>
                                        </h6>
                                        <h6 class="post_title">
                                            <span class="footer_message"> Support:</span> &emsp;
                                            <?php echo $settings->support; ?>
                                        </h6>
                                        <!-- <div class="post_info">
                                            <span class="post_info_item post_info_posted">February 2, 2016</span>
                                            <span class="post_info_item post_info_posted_by">by
                                                <a href="single-post.html" class="post_info_author">John Doe</a>
                                            </span>
                                            <span class="post_info_item post_info_posted_in">in
                                                <a href="#" rel="category tag">News</a>
                                            </span>
                                        </div> -->
                                    </div>
                                </article>
                            </aside>
                            <!-- <aside class="column-1_3 widget widget_recent_posts">
                                <h5 class="widget_title">Recent News</h5>
                                <article class="post_item with_thumb">
                                    <div class="post_thumb">
                                        <img width="75" height="75" alt="" src="images/1000x1000.png">
                                    </div>
                                    <div class="post_content">
                                        <h6 class="post_title">
                                            <a href="single-post.html">Dental patients given increased protection</a>
                                        </h6>
                                        <div class="post_info">
                                            <span class="post_info_item post_info_posted">February 2, 2016</span>
                                            <span class="post_info_item post_info_posted_by">by
                                                <a href="single-post.html" class="post_info_author">John Doe</a>
                                            </span>
                                            <span class="post_info_item post_info_posted_in">in
                                                <a href="#" rel="category tag">News</a>
                                            </span>
                                        </div>
                                    </div>
                                </article>
                                <article class="post_item with_thumb">
                                    <div class="post_thumb">
                                        <img width="75" height="75" alt="" src="images/1000x1000.png">
                                    </div>
                                    <div class="post_content">
                                        <h6 class="post_title">
                                            <a href="single-post.html">Best Wedding Day Smile with Dentistry Procedures</a>
                                        </h6>
                                        <div class="post_info">
                                            <span class="post_info_item post_info_posted">February 2, 2016</span>
                                            <span class="post_info_item post_info_posted_by">by
                                                <a href="single-post.html" class="post_info_author">John Doe</a>
                                            </span>
                                            <span class="post_info_item post_info_posted_in">in
                                                <a href="#" rel="category tag">News</a>
                                            </span>
                                        </div>
                                    </div>
                                </article>
                                <article class="post_item with_thumb">
                                    <div class="post_thumb">
                                        <img width="75" height="75" alt="" src="images/1000x1000.png">
                                    </div>
                                    <div class="post_content">
                                        <h6 class="post_title">
                                            <a href="single-post.html">Give mouth cancer sufferers a voice on World Cancer Day</a>
                                        </h6>
                                        <div class="post_info">
                                            <span class="post_info_item post_info_posted">February 2, 2016</span>
                                            <span class="post_info_item post_info_posted_by">by
                                                <a href="single-post.html" class="post_info_author">John Doe</a>
                                            </span>
                                            <span class="post_info_item post_info_posted_in">in
                                                <a href="#" rel="category tag">News</a>
                                            </span>
                                        </div>
                                    </div>
                                </article>
                            </aside> -->
                            <aside class="column-1_3 widget widget_text">
                                <h5 class="widget_title">Contact Us</h5>
                                <div class="textwidget">
                                    <div id="sc_form_044_wrap" class="sc_form_wrap">
                                        <div id="sc_form_044"
                                            class="sc_form sc_form_style_form_1 margin_top_null margin_bottom_null">
                                            <form id="sc_form_044_form" method="post" action="frontend/send"
                                                enctype="multipart/form-data">
                                                <div class="sc_form_info">
                                                    <div class="sc_form_item sc_form_field label_over">
                                                        <label class="required" for="sc_form_username">Name</label>
                                                        <input id="sc_form_username" type="text" name="username"
                                                            placeholder="Name *">
                                                    </div>
                                                    <div class="sc_form_item sc_form_field label_over">
                                                        <label class="required" for="sc_form_email">E-mail</label>
                                                        <input id="sc_form_email" type="text" name="email"
                                                            placeholder="E-mail *">
                                                    </div>
                                                </div>
                                                <div class="sc_form_item sc_form_message label_over">
                                                    <label class="required" for="sc_form_message">Message</label>
                                                    <textarea data-autoresize rows="1" id="sc_form_message"
                                                        name="message" placeholder="Message"></textarea>
                                                </div>
                                                <div class="sc_form_item sc_form_button">
                                                    <button>Send Message</button>
                                                </div>
                                                <div class="result sc_infobox"></div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </aside>
                        </div>
                    </div>
                </div>
            </footer>
            <div class="copyright_wrap copyright_style_text scheme_dark">
                <div class="copyright_wrap_inner">
                    <div class="content_wrap_outer">
                        <div class="content_wrap">
                            <div class="copyright_text"> <?php echo $this->db->get('settings')->row()->system_vendor; ?>
                                © <?php echo date('Y'); ?> All Rights Reserved.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <a href="#" class="scroll_to_top icon-up" title="Scroll to top"></a>
    <div class="custom_html_section"></div>
    <script src="common/js/codearistos.min.js"></script>
    <!-- <script type='text/javascript' src='front/assets_new/js/vendor/jquery/jquery.js'></script> -->
    <script type='text/javascript' src='front/assets_new/js/vendor/jquery/jquery-migrate.min.js'></script>
    <script type='text/javascript' src='front/assets_new/js/custom/custom.js'></script>
    <script type='text/javascript' src='front/assets_new/js/vendor/jquery/fcc8474e79.js'></script>
    <script type='text/javascript' src='front/assets_new/js/vendor/esg/jquery.themepunch.tools.min.js'></script>
    <script type='text/javascript' src='front/assets_new/js/vendor/revslider/jquery.themepunch.revolution.min.js'>
    </script>
    <script type="text/javascript"
        src="front/assets_new/js/vendor/revslider/extensions/revolution.extension.slideanims.min.js"></script>
    <script type="text/javascript"
        src="front/assets_new/js/vendor/revslider/extensions/revolution.extension.layeranimation.min.js"></script>
    <script type="text/javascript"
        src="front/assets_new/js/vendor/revslider/extensions/revolution.extension.navigation.min.js"></script>
    <script type="text/javascript"
        src="front/assets_new/js/vendor/revslider/extensions/revolution.extension.parallax.min.js"></script>
    <script type='text/javascript' src='front/assets_new/js/vendor/modernizr.min.js'></script>
    <script type='text/javascript' src='front/assets_new/js/vendor/jquery/core.min.js'></script>
    <script type='text/javascript' src='front/assets_new/js/vendor/jquery/datepicker.min.js'></script>
    <script type='text/javascript' src='front/assets_new/js/vendor/superfish.js'></script>
    <script type='text/javascript' src='front/assets_new/js/custom/jquery.slidemenu.js'></script>
    <script type='text/javascript' src='front/assets_new/js/custom/core.utils.js'></script>
    <script type='text/javascript' src='front/assets_new/js/custom/core.init.js'></script>
    <script type='text/javascript' src='front/assets_new/js/custom/init.js'></script>
    <script type='text/javascript' src='front/assets_new/js/custom/social-share.js'></script>
    <script type='text/javascript' src='front/assets_new/js/custom/embed.min.js'></script>
    <script type='text/javascript' src='front/assets_new/js/custom/shortcodes.js'></script>
    <script type='text/javascript' src='front/assets_new/js/vendor/comp/comp_front.min.js'></script>
    <script type='text/javascript' src='front/assets_new/js/custom/core.messages.js'></script>
    <script type='text/javascript' src='front/assets_new/js/vendor/swiper/swiper.min.js'></script>
    <script type='text/javascript' src='http://maps.google.com/maps/api/js?key=AIzaSyB41DRUbKWJHPxaFjMAwdrzWzbVKartNGg'>
    </script>
    <script type='text/javascript' src='front/assets_new/js/vendor/core.googlemap.js'></script>

 <script src="themes/assets/js/lightgallery.min.js"></script>

    <script src="common/js/bootstrap.min.js"></script>
    <script src="common/js/bootstrap-select.min.js"></script>

    <script src="common/js/bootstrap-select-country.min.js"></script>
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
          <script>
    // function onClick(e) {
    //   e.preventDefault();
    grecaptcha.ready(function() {
        grecaptcha.execute('<?php echo $googleReCaptchaSiteKey; ?>', {
            action: 'submit'
        }).then(function(token) {
            document.getElementById("recaptchaToken").value = token;
        });
    });
    //  }
    </script>
    <script src="common/extranal/toast.js"></script>
    <link rel="stylesheet" type="text/css" href="common/extranal/toast.css">
    <script type="text/javascript">
    <?php if (!empty($hospital_message)) {?>
    $(document).ready(function() {
        toastr.success("<?php echo lang($hospital_message); ?>");
    });
    <?php } ?>
    </script>
    <script type="text/javascript">
    <?php if (!empty($subscribe_message)) {?>
    $(document).ready(function() {
        toastr.success("Email Sent Successfully");
    });
    <?php } ?>
    </script>
    <script type="text/javascript">
    <?php if (!empty($contact_message)) {
                                        if($contact_message=='success'){ ?>
    $(document).ready(function() {
        toastr.success("<?php echo $contact_message; ?>");
    });
    <?php   } if($contact_message=='failed'){ 
                                        ?>
    $(document).ready(function() {
        toastr.warning("<?php echo $contact_message; ?>");
    });
    <?php }  } ?>
    </script>
       <script>
  $(document).ready(function() {
    // Ensure base_url is defined
    const base_url  = "<?php echo base_url(); ?>";

    // Function to update the web link
    function updateWebLink() {
        const val = $("#username").val();
       
            const url = base_url + 'site/' + val;
            const final_url = '<a style="color:#0cb8b6;" target="_blank" href="' + url + '">' + url + '</a>';
            $("#web_link").html(final_url);
      
    }

    // Initial update on page load
    updateWebLink();

    // Update on keyup event
    $("#username").on("keyup", function() {
        updateWebLink();
    });
});
    </script>
    <script>
         $("#username").keyup(function() {
        $("#web_link").html("");
        var val = $("#username").val();
        $.ajax({
            url: "frontend/checkIfUsernameAvailable?username=" + val,
            method: "GET",
            data: "",
            dataType: "json"

        }).done(function(response) {
            if (response.check == 1) {
                var url = base_url + 'site/' + val;
                var final_url = '<a style="color:#0cb8b6;" target="_blank" href="' + url + '">' + url + '</a>';
                $("#web_link").html(final_url);
            } else {
                $("#web_link").html("This link is not available!");
            }
        });
    });
    

    </script>
</body>

</html>
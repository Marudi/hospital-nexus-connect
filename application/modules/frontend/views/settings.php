<link href="common/extranal/css/frontend/settings.css" rel="stylesheet">
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0"><?php echo lang('settings'); ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item"><?php echo lang('website'); ?></li>
                                        <li class="breadcrumb-item active"><?php echo lang('settings'); ?></li>
                                       
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <!-- page start-->
        <style>
            .accordion-item{
                margin-bottom: 10px;
            }
            label{
        color: black;
    }
    .fileupload {
    margin-bottom: 9px;
}
.fileupload .thumbnail {
    display: inline-block;
    margin-bottom: 5px;
    overflow: hidden;
    text-align: center;
    vertical-align: middle;
}
.fileupload-new img{
    height: 200px;

}
        </style>
        <section class="card">
        <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-12"> <i class="fa fa-gear"></i> <?php echo lang('website'); ?> <?php echo lang('settings'); ?></h4> 
                                        
                                    </div>
          


            <div class="card-body">
                <div class="clearfix">
                    <div class="col-lg-12">
                        <section class="panel">
                            <div class="panel-body">
                                <?php echo validation_errors(); ?>
                                <form role="form" action="frontend/update" method="post" enctype="multipart/form-data">

                                <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div class="accordion-item">
                                     <h2 class="accordion-header" id="flush-headingOne">
                                                    <button class="accordion-button fw-medium" type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#flush-collapseOne" aria-expanded="true" aria-controls="flush-collapseOne">
                                                        <h4><?php echo lang('general_settings'); ?></h4>
                                                    </button>
                                   </h2>
                                   <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
                                                    data-bs-parent="#accordionFlushExample">
                                                    <div class="card-body row">
                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"><?php echo lang('title'); ?> &ast;</label>
                                                        <input type="text" class="form-control" name="title" value='<?php
                                                                                                                    if (!empty($settings->title)) {
                                                                                                                        echo $settings->title;
                                                                                                                    }
                                                                                                                    ?>' placeholder="system name" >
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"><?php echo lang('logo'); ?></label>
                                                        <input type="file" class="form-control" name="img_url" value='<?php
                                                                                                                        if (!empty($settings->invoice_logo)) {
                                                                                                                            echo $settings->invoice_logo;
                                                                                                                        }
                                                                                                                        ?>' placeholder="">
                                                        <span style="color:gray;"><?php echo lang('recommended_size'); ?>: 100x100</span><br>
                                                        <span style="color:gray;">Recommended Type: gif, jpg, png, jpeg</span>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"><?php echo lang('address'); ?> &ast;</label>
                                                        <input type="text" class="form-control" name="address" value='<?php
                                                                                                                        if (!empty($settings->address)) {
                                                                                                                            echo $settings->address;
                                                                                                                        }
                                                                                                                        ?>' placeholder="address" >
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"><?php echo lang('phone'); ?> &ast;</label>
                                                        <input type="text" class="form-control" name="phone" value='<?php
                                                                                                                        if (!empty($settings->phone)) {
                                                                                                                            echo $settings->phone;
                                                                                                                        }
                                                                                                                        ?>' placeholder="phone" >
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"><?php echo lang('emergency'); ?></label>
                                                        <input type="text" class="form-control" name="emergency" value='<?php
                                                                                                                        if (!empty($settings->emergency)) {
                                                                                                                            echo $settings->emergency;
                                                                                                                        }
                                                                                                                        ?>' placeholder="">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"><?php echo lang('support_number'); ?></label>
                                                        <input type="text" class="form-control" name="support" value='<?php
                                                                                                                        if (!empty($settings->support)) {
                                                                                                                            echo $settings->support;
                                                                                                                        }
                                                                                                                        ?>' placeholder="">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"><?php echo lang('hospital_email'); ?> &ast;</label>
                                                        <input type="email" class="form-control" name="email" value='<?php
                                                                                                                        if (!empty($settings->email)) {
                                                                                                                            echo $settings->email;
                                                                                                                        }
                                                                                                                        ?>' placeholder="email" >
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"><?php echo lang('currency'); ?> &ast;</label>
                                                        <input type="text" class="form-control" name="currency" value='<?php
                                                                                                                        if (!empty($settings->currency)) {
                                                                                                                            echo $settings->currency;
                                                                                                                        }
                                                                                                                        ?>' placeholder="currency" >
                                                    </div>

                                                    

                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1">Youtube Video Link</label>
                                                        <input type="text" class="form-control" name="video_link" value='<?php
                                                                                                                        if (!empty($settings->video_link)) {
                                                                                                                            echo $settings->video_link;
                                                                                                                        }
                                                                                                                        ?>' placeholder="Youtube Video Link">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1">Google Coordinates</label>
                                                        <input type="text" class="form-control" name="coordinates" value='<?php
                                                                                                                        if (!empty($settings->coordinates)) {
                                                                                                                            echo $settings->coordinates;
                                                                                                                        }
                                                                                                                        ?>' placeholder="Coordinates">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1">Footer Text</label>
                                                        <input type="text" class="form-control" name="footer_text" value='<?php
                                                                                                                        if (!empty($settings->footer_text)) {
                                                                                                                            echo $settings->footer_text;
                                                                                                                        }
                                                                                                                        ?>' placeholder="Footer Text">
                                                    </div>
                                                     <div class="form-group col-md-6">
                                                        <label style="color:green;">Step - 1 : Open your web browser and go to Google Maps</label>
                                                        <label style="color:green;">Step - 2 : Type the name or address of the location you want to embed (e.g., "Troy Meadows Wetlands").</label>
                                                        <label style="color:green;">Step - 3 : Once the location is displayed, click on the menu button (three horizontal lines) in the top-left corner of the screen.</label>
                                                        <label style="color:green;">Step - 4 : From the menu, click on "Share or embed map".</label>
                                                        <label style="color:green;">Step - 5 : In the pop-up window, go to the "Embed a map" tab.</label>
                                                        <label style="color:green;">Step - 6 : You'll see an 'iframe' code snippet. Copy the only "src" value.</label>
                                                        <!--<label style="color:green;">Step - 7 : Example: iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d96652.27317354927!2d-74.33557928194516!3d40.79756494697628!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c3a82f1352d0dd%3A0x81d4f72c4435aab5!2sTroy+Meadows+Wetlands!5e0!3m2!1sen!2sbd!4v1563075599994!5m2!1sen!2sbd" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe></label>-->
                                                        </div>

                                                    <?php if ($this->ion_auth->in_group(array('superadmin'))) { ?> 
                                                        <div class="form-group col-md-6">
                                                            <label for="exampleInputEmail1"> <input type="checkbox" class="" name="google_translation_switch_in_frontend" value='<?php
                                                                                                                                                                                                if (!empty($settings->google_translation_switch_in_frontend)) {
                                                                                                                                                                                                    echo $settings->google_translation_switch_in_frontend;
                                                                                                                                                                                                } else {
                                                                                                                                                                                                    echo 'yes';
                                                                                                                                                                                                }
                                                                                                                                                                                                ?>' placeholder="codec_purchase_code" <?php
                                                                                                                                                                                                    if ($settings->google_translation_switch_in_frontend == 'yes') {
                                                                                                                                                                                                        echo 'checked';
                                                                                                                                                                                                    }
                                                                                                                                                                                                    ?>> <?php echo lang('google_translation_switch_in_frontend') ?>
                                                            </label>

                                                        </div>
                                                    <?php } ?>

                                                </div>
                                   </div>
                                </div>
                                <div class="accordion-item">
                                                <h2 class="accordion-header" id="flush-headingTwo">
                                                    <button class="accordion-button fw-medium" type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#flush-collapseTwo" aria-expanded="true" aria-controls="flush-collapseTwo">
                                                        <h4><?php echo lang('block_text_settings'); ?></h4>
                                                    </button>
                                                </h2>
                                                <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo"
                                                    data-bs-parent="#accordionFlushExample">
                                                    <div class="card-body row">
                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1">Gallery Block Text Under Title </label>
                                                        <input type="text" class="form-control" name="gallery_text_under_title" value='<?php
                                                                                                                                        if (!empty($settings->gallery_text_under_title)) {
                                                                                                                                            echo $settings->gallery_text_under_title;
                                                                                                                                        }
                                                                                                                                        ?>' placeholder="">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1">Review Block Text Under Title </label>
                                                        <input type="text" class="form-control" name="review_text_under_title" value='<?php
                                                                                                                                        if (!empty($settings->review_text_under_title)) {
                                                                                                                                            echo $settings->review_text_under_title;
                                                                                                                                        }
                                                                                                                                        ?>' placeholder="">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1">Pricing Block Text Under Title </label>
                                                        <input type="text" class="form-control" name="pricing_text_under_title" value='<?php
                                                                                                                                        if (!empty($settings->pricing_text_under_title)) {
                                                                                                                                            echo $settings->pricing_text_under_title;
                                                                                                                                        }
                                                                                                                                        ?>' placeholder="">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1">News Block Text Under Title </label>
                                                        <input type="text" class="form-control" name="news_text_under_title" value='<?php
                                                                                                                                        if (!empty($settings->news_text_under_title)) {
                                                                                                                                            echo $settings->news_text_under_title;
                                                                                                                                        }
                                                                                                                                        ?>' placeholder="">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1">Subscribe Block Text Under Title </label>
                                                        <input type="text" class="form-control" name="subscribe_text_under_title" value='<?php
                                                                                                                                        if (!empty($settings->subscribe_text_under_title)) {
                                                                                                                                            echo $settings->subscribe_text_under_title;
                                                                                                                                        }
                                                                                                                                        ?>' placeholder="">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1">Crutches Block Text Under Title </label>
                                                        <input type="text" class="form-control" name="block_1_text_under_title" value='<?php
                                                                                                                                        if (!empty($settings->block_1_text_under_title)) {
                                                                                                                                            echo $settings->block_1_text_under_title;
                                                                                                                                        }
                                                                                                                                        ?>' placeholder="">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"><?php echo lang('service_block_text_under_title'); ?> </label>
                                                        <input type="text" class="form-control" name="service_block__text_under_title" value='<?php
                                                                                                                                                if (!empty($settings->service_block__text_under_title)) {
                                                                                                                                                    echo $settings->service_block__text_under_title;
                                                                                                                                                }
                                                                                                                                                ?>' placeholder="">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"><?php echo lang('doctor_block__text_under_title'); ?></label>
                                                        <input type="text" class="form-control" name="doctor_block__text_under_title" value='<?php
                                                                                                                                                if (!empty($settings->doctor_block__text_under_title)) {
                                                                                                                                                    echo $settings->doctor_block__text_under_title;
                                                                                                                                                }
                                                                                                                                                ?>' placeholder="">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1">Hospital <?php echo lang('registration_block_text'); ?> </label>
                                                        <input type="text" class="form-control" name="registration_block_text" value='<?php
                                                                                                                                        if (!empty($settings->registration_block_text)) {
                                                                                                                                            echo $settings->registration_block_text;
                                                                                                                                        }
                                                                                                                                        ?>' placeholder="">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"><?php echo lang('contact'); ?> </label>
                                                        <input type="text" class="form-control" name="contact_us" value='<?php
                                                                                                                            if (!empty($settings->contact_us)) {
                                                                                                                                echo $settings->contact_us;
                                                                                                                            }
                                                                                                                            ?>' placeholder="">
                                                    </div>

                                                </div>
                                                </div>
                                </div>
                                <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingThree">
                                                    <button class="accordion-button fw-medium" type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#flush-collapseThree" aria-expanded="true" aria-controls="flush-collapseThree">
                                                        <h4><?php echo lang('social_settings'); ?></h4>
                                                    </button>
                                                </h2>
                                                <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree"
                                                    data-bs-parent="#accordionFlushExample">
                                                       <div class="card-body row">


                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"><?php echo lang('facebook_id'); ?></label>
                                                        <input type="text" class="form-control" name="facebook_id" value='<?php
                                                                                                                            if (!empty($settings->facebook_id)) {
                                                                                                                                echo $settings->facebook_id;
                                                                                                                            }
                                                                                                                            ?>' placeholder="">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"><?php echo lang('twitter_id'); ?></label>
                                                        <input type="text" class="form-control" name="twitter_id" value='<?php
                                                                                                                            if (!empty($settings->twitter_id)) {
                                                                                                                                echo $settings->twitter_id;
                                                                                                                            }
                                                                                                                            ?>' placeholder="">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"><?php echo lang('twitter_username'); ?></label>
                                                        <input type="text" class="form-control" name="twitter_username" value='<?php
                                                                                                                                if (!empty($settings->twitter_username)) {
                                                                                                                                    echo $settings->twitter_username;
                                                                                                                                }
                                                                                                                                ?>' placeholder="">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"><?php echo lang('google_id'); ?></label>
                                                        <input type="text" class="form-control" name="google_id" value='<?php
                                                                                                                        if (!empty($settings->google_id)) {
                                                                                                                            echo $settings->google_id;
                                                                                                                        }
                                                                                                                        ?>' placeholder="">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"><?php echo lang('youtube_id'); ?></label>
                                                        <input type="text" class="form-control" name="youtube_id" value='<?php
                                                                                                                            if (!empty($settings->youtube_id)) {
                                                                                                                                echo $settings->youtube_id;
                                                                                                                            }
                                                                                                                            ?>' placeholder="">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"><?php echo lang('skype_id'); ?></label>
                                                        <input type="text" class="form-control" name="skype_id" value='<?php
                                                                                                                        if (!empty($settings->skype_id)) {
                                                                                                                            echo $settings->skype_id;
                                                                                                                        }
                                                                                                                        ?>' placeholder="">
                                                    </div>
                                                </div>
                                                </div>
                                </div>
                                <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingFour">
                                                    <button class="accordion-button fw-medium" type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#flush-collapseFour" aria-expanded="true" aria-controls="flush-collapseFour">
                                                        <h4>Procedures Section Settings</h4>
                                                    </button>
                                                </h2>
                                                <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour"
                                                    data-bs-parent="#accordionFlushExample">
                                                    <div class="card-body ">

                                                    <div class="form-group col-md-12 row">

                                                        <div class="form-group col-md-6">
                                                            <label for="exampleInputEmail1"><?php echo lang('title'); ?> </label>
                                                            <input type="text" class="form-control" name="market_title" value='<?php
                                                                                                                                if (!empty($settings->market_title)) {
                                                                                                                                    echo $settings->market_title;
                                                                                                                                }
                                                                                                                                ?>' placeholder="">
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label for="exampleInputEmail1"><?php echo lang('text_1'); ?> </label>
                                                            <input type="text" class="form-control" name="market_description" value='<?php
                                                                                                                                        if (!empty($settings->market_description)) {
                                                                                                                                            echo $settings->market_description;
                                                                                                                                        }
                                                                                                                                        ?>' placeholder="">
                                                        </div>

                                                        <!-- <div class="form-group col-md-6">
                                                            <label for="exampleInputEmail1"><?php echo lang('text_2'); ?> </label>
                                                            <input type="text" class="form-control" name="market_button_link" value='<?php
                                                                                                                                        if (!empty($settings->market_button_link)) {
                                                                                                                                            echo $settings->market_button_link;
                                                                                                                                        }
                                                                                                                                        ?>' placeholder="">
                                                        </div> -->

                                                        <div class="form-group col-md-6">
                                                            <label class="control-label">Upload Before Image</label>
                                                            <div class="">
                                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                                    <div class="fileupload-new thumbnail <?php if (!empty($settings->before_image)) { ?> img_auto <?php } else { ?> img_auto1 <?php } ?>">
                                                                        <img src="<?php
                                                                                    if (empty($settings->before_image)) {
                                                                                    } else {
                                                                                        echo $settings->before_image;
                                                                                    }
                                                                                    ?>" id="img" alt="" />
                                                                    </div>
                                                                    <div class="fileupload-preview fileupload-exists thumbnail logo_thumbnail"></div>
                                                                    <div>
                                                                        <span class="btn btn-soft-primary waves-effect waves-light btn-file">
                                                                            <span class="fileupload-new"><i class="fa fa-paper-clip"></i> <?php echo lang('select_image'); ?></span>
                                                                            <span class="fileupload-exists"><i class="fa fa-undo"></i> <?php echo lang('change'); ?></span>
                                                                            <input type="file" class="default" name="before_image" />
                                                                        </span>
                                                                        <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> <?php echo lang('remove'); ?></a>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <span style="color:gray;"><?php echo lang('recommended_size'); ?>: 740x430</span><br>
                                                            <span style="color:gray;">Recommended Type: gif, jpg, png, jpeg</span>
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label class="control-label">Upload After Image</label>
                                                            <div class="">
                                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                                    <div class="fileupload-new thumbnail <?php if (!empty($settings->after_image)) { ?> img_auto <?php } else { ?> img_auto1 <?php } ?>">
                                                                        <img src="<?php
                                                                                    if (empty($settings->after_image)) {
                                                                                    } else {
                                                                                        echo $settings->after_image;
                                                                                    }
                                                                                    ?>" id="img" alt="" />
                                                                    </div>
                                                                    <div class="fileupload-preview fileupload-exists thumbnail logo_thumbnail"></div>
                                                                    <div>
                                                                        <span class="btn btn-soft-primary waves-effect waves-light btn-file">
                                                                            <span class="fileupload-new"><i class="fa fa-paper-clip"></i> <?php echo lang('select_image'); ?></span>
                                                                            <span class="fileupload-exists"><i class="fa fa-undo"></i> <?php echo lang('change'); ?></span>
                                                                            <input type="file" class="default" name="after_image" />
                                                                        </span>
                                                                        <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> <?php echo lang('remove'); ?></a>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <span style="color:gray;"><?php echo lang('recommended_size'); ?>: 740x430</span><br>
                                                            <span style="color:gray;">Recommended Type: gif, jpg, png, jpeg</span>
                                                        </div>
                                                    </div>


                                                </div>
                                                </div>
                                </div>
                                <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingFive">
                                                    <button class="accordion-button fw-medium" type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#flush-collapseFive" aria-expanded="true" aria-controls="flush-collapseFive">
                                                        <h4>Who We Are Section Settings</h4>
                                                    </button>
                                                </h2>
                                                <div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingFive"
                                                    data-bs-parent="#accordionFlushExample">
                                                     <div class="card-body">

                                                    <div class="form-group col-md-12 row">
                                                        <div class="form-group col-md-6">
                                                            <label for="exampleInputEmail1">Header Subtitle</label>
                                                            <input type="text" class="form-control" name="comment_1" value='<?php
                                                                                                                            if (!empty($settings->comment_1)) {
                                                                                                                                echo $settings->comment_1;
                                                                                                                            }
                                                                                                                            ?>' placeholder="">
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label for="exampleInputEmail1">Title</label>
                                                            <input type="text" class="form-control" name="verified_1" value='<?php
                                                                                                                                if (!empty($settings->verified_1)) {
                                                                                                                                    echo $settings->verified_1;
                                                                                                                                }
                                                                                                                                ?>' placeholder="">
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="form-group col-md-12 row">
                                                        <div class="form-group col-md-6">
                                                            <label for="exampleInputEmail1">Description</label>
                                                            <input type="text" class="form-control" name="comment_2" value='<?php
                                                                                                                            if (!empty($settings->comment_2)) {
                                                                                                                                echo $settings->comment_2;
                                                                                                                            }
                                                                                                                            ?>' placeholder="">
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label for="exampleInputEmail1">Name</label>
                                                            <input type="text" class="form-control" name="verified_2" value='<?php
                                                                                                                                if (!empty($settings->verified_2)) {
                                                                                                                                    echo $settings->verified_2;
                                                                                                                                }
                                                                                                                                ?>' placeholder="">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label class="control-label"><?php echo lang('comment_logo_2'); ?></label>
                                                            <div class="">
                                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                                    <div class="fileupload-new thumbnail <?php if (!empty($settings->comment_logo_2)) { ?> img_auto <?php } else { ?> img_auto1 <?php } ?>">
                                                                        <img src="<?php
                                                                                    if (empty($settings->comment_logo_2)) {
                                                                                    } else {
                                                                                        echo $settings->comment_logo_2;
                                                                                    }
                                                                                    ?>" id="img" alt="" />
                                                                    </div>
                                                                    <div class="fileupload-preview fileupload-exists thumbnail logo_thumbnail"></div>
                                                                    <div>
                                                                        <span class="btn btn-soft-primary waves-effect waves-light btn-file">
                                                                            <span class="fileupload-new"><i class="fa fa-paper-clip"></i><?php echo lang('select_image'); ?> </span>
                                                                            <span class="fileupload-exists"><i class="fa fa-undo"></i><?php echo lang('change'); ?> </span>
                                                                            <input type="file" class="default" name="comment_logo_2" />
                                                                        </span>
                                                                        <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i><?php echo lang('remove'); ?> </a>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <span style="color:gray;"><?php echo lang('recommended_size'); ?>: 70x70</span><br>
                                                            <span style="color:gray;">Recommended Type: gif, jpg, png, jpeg</span>
                                                        </div>

                                                    </div>
                                                </div>
                                                </div>
                                </div>
                                <!--<div class="accordion-item">-->
                                <!--<h2 class="accordion-header" id="flush-headingSix">-->
                                <!--                    <button class="accordion-button fw-medium" type="button" data-bs-toggle="collapse"-->
                                <!--                        data-bs-target="#flush-collapseSix" aria-expanded="true" aria-controls="flush-collapseSix">-->
                                <!--                        <h4><?php echo lang('section_3_settings'); ?></h4>-->
                                <!--                    </button>-->
                                <!--                </h2>-->
                                <!--                <div id="flush-collapseSix" class="accordion-collapse collapse" aria-labelledby="flush-headingSix"-->
                                <!--                    data-bs-parent="#accordionFlushExample">-->
                                <!--                    <div class="card-body">-->
                                <!--                    <div class="form-group col-md-12 row">-->
                                <!--                        <div class="form-group col-md-12">-->
                                <!--                            <h4> <label for="exampleInputEmail1"><?php echo lang('header_section'); ?> </label></h4>-->
                                <!--                            <hr>-->
                                <!--                        </div>-->
                                <!--                        <div class="form-group col-md-6">-->
                                <!--                            <label for="exampleInputEmail1"><?php echo lang('header_title'); ?> Header Title</label>-->
                                <!--                            <input type="text" class="form-control" name="partner_header_title" value='<?php-->
                                <!--                                                                                                        if (!empty($settings->partner_header_title)) {-->
                                <!--                                                                                                            echo $settings->partner_header_title;-->
                                <!--                                                                                                        }-->
                                <!--                                                                                                        ?>' placeholder="">-->
                                <!--                        </div>-->

                                <!--                        <div class="form-group col-md-6">-->
                                <!--                            <label for="exampleInputEmail1"><?php echo lang('header_description'); ?> </label>-->
                                <!--                            <input type="text" class="form-control" name="partner_header_description" value='<?php-->
                                <!--                                                                                                                if (!empty($settings->partner_header_description)) {-->
                                <!--                                                                                                                    echo $settings->partner_header_description;-->
                                <!--                                                                                                                }-->
                                <!--                                                                                                                ?>' placeholder="">-->
                                <!--                        </div>-->
                                <!--                    </div>-->
                                <!--                    <div class="form-group col-md-12 row">-->
                                <!--                        <div class="form-group col-md-12">-->
                                <!--                            <h4> <label for="exampleInputEmail1"><?php echo lang('section_1'); ?> </label></h4>-->
                                <!--                            <hr>-->
                                <!--                        </div>-->
                                <!--                        <div class="form-group col-md-6">-->
                                <!--                            <label for="exampleInputEmail1"><?php echo lang('title'); ?> </label>-->
                                <!--                            <input type="text" class="form-control" name="section_title_1" value='<?php-->
                                <!--                                                                                                    if (!empty($settings->section_title_1)) {-->
                                <!--                                                                                                        echo $settings->section_title_1;-->
                                <!--                                                                                                    }-->
                                <!--                                                                                                    ?>' placeholder="">-->
                                <!--                        </div>-->

                                <!--                        <div class="form-group col-md-6">-->
                                <!--                            <label for="exampleInputEmail1"><?php echo lang('description'); ?> </label>-->
                                <!--                            <input type="text" class="form-control" name="section_description_1" value='<?php-->
                                <!--                                                                                                        if (!empty($settings->section_description_1)) {-->
                                <!--                                                                                                            echo $settings->section_description_1;-->
                                <!--                                                                                                        }-->
                                <!--                                                                                                        ?>' placeholder="">-->
                                <!--                        </div>-->

                                <!--                        <div class="form-group col-md-6">-->
                                <!--                            <label for="exampleInputEmail1"><?php echo lang('text_1'); ?> </label>-->
                                <!--                            <input type="text" class="form-control" name="section_1_text_1" value='<?php-->
                                <!--                                                                                                    if (!empty($settings->section_1_text_1)) {-->
                                <!--                                                                                                        echo $settings->section_1_text_1;-->
                                <!--                                                                                                    }-->
                                <!--                                                                                                    ?>' placeholder="">-->
                                <!--                        </div>-->
                                <!--                        <div class="form-group col-md-6">-->
                                <!--                            <label for="exampleInputEmail1"><?php echo lang('text_2'); ?> </label>-->
                                <!--                            <input type="text" class="form-control" name="section_1_text_2" value='<?php-->
                                <!--                                                                                                    if (!empty($settings->section_1_text_2)) {-->
                                <!--                                                                                                        echo $settings->section_1_text_2;-->
                                <!--                                                                                                    }-->
                                <!--                                                                                                    ?>' placeholder="">-->
                                <!--                        </div>-->
                                <!--                        <div class="form-group col-md-6">-->
                                <!--                            <label for="exampleInputEmail1"><?php echo lang('text_3'); ?> </label>-->
                                <!--                            <input type="text" class="form-control" name="section_1_text_3" value='<?php-->
                                <!--                                                                                                    if (!empty($settings->section_1_text_3)) {-->
                                <!--                                                                                                        echo $settings->section_1_text_3;-->
                                <!--                                                                                                    }-->
                                <!--                                                                                                    ?>' placeholder="">-->
                                <!--                        </div>-->
                                <!--                        <div class="form-group col-md-6">-->
                                <!--                            <label class="control-label"><?php echo lang('upload_image'); ?></label>-->
                                <!--                            <div class="">-->
                                <!--                                <div class="fileupload fileupload-new" data-provides="fileupload">-->
                                <!--                                    <div class="fileupload-new thumbnail <?php if (!empty($settings->partner_image_1)) { ?> img_auto <?php } else { ?> img_auto1 <?php } ?>">-->
                                <!--                                        <img src="<?php-->
                                <!--                                                    if (empty($settings->partner_image_1)) {-->
                                <!--                                                    } else {-->
                                <!--                                                        echo $settings->partner_image_1;-->
                                <!--                                                    }-->
                                <!--                                                    ?>" id="img" alt="" />-->
                                <!--                                    </div>-->
                                <!--                                    <div class="fileupload-preview fileupload-exists thumbnail logo_thumbnail"></div>-->
                                <!--                                    <div>-->
                                <!--                                        <span class="btn btn-soft-primary waves-effect waves-light btn-file">-->
                                <!--                                            <span class="fileupload-new"><i class="fa fa-paper-clip"></i> <?php echo lang('select_image'); ?> </span>-->
                                <!--                                            <span class="fileupload-exists"><i class="fa fa-undo"></i> <?php echo lang('change'); ?></span>-->
                                <!--                                            <input type="file" class="default" name="partner_image_1" />-->
                                <!--                                        </span>-->
                                <!--                                        <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> <?php echo lang('remove'); ?></a>-->
                                <!--                                    </div>-->
                                <!--                                </div>-->

                                <!--                            </div>-->
                                <!--                            <span style="color:gray;"><?php echo lang('recommended_size'); ?>: 740x430</span><br>-->
                                <!--                            <span style="color:gray;">Recommended Type: gif, jpg, png, jpeg</span>-->
                                <!--                        </div>-->
                                <!--                    </div>-->
                                <!--                    <div class="form-group col-md-12 row">-->
                                <!--                        <div class="form-group col-md-12">-->
                                <!--                            <h4> <label for="exampleInputEmail1"><?php echo lang('section_2'); ?> </label></h4>-->
                                <!--                            <hr>-->
                                <!--                        </div>-->
                                <!--                        <div class="form-group col-md-6">-->
                                <!--                            <label for="exampleInputEmail1"><?php echo lang('title'); ?> </label>-->
                                <!--                            <input type="text" class="form-control" name="section_title_2" value='<?php-->
                                <!--                                                                                                    if (!empty($settings->section_title_2)) {-->
                                <!--                                                                                                        echo $settings->section_title_2;-->
                                <!--                                                                                                    }-->
                                <!--                                                                                                    ?>' placeholder="">-->
                                <!--                        </div>-->

                                <!--                        <div class="form-group col-md-6">-->
                                <!--                            <label for="exampleInputEmail1"><?php echo lang('description'); ?> </label>-->
                                <!--                            <input type="text" class="form-control" name="section_description_2" value='<?php-->
                                <!--                                                                                                        if (!empty($settings->section_description_2)) {-->
                                <!--                                                                                                            echo $settings->section_description_2;-->
                                <!--                                                                                                        }-->
                                <!--                                                                                                        ?>' placeholder="">-->
                                <!--                        </div>-->

                                <!--                        <div class="form-group col-md-6">-->
                                <!--                            <label for="exampleInputEmail1"><?php echo lang('text_1'); ?> </label>-->
                                <!--                            <input type="text" class="form-control" name="section_2_text_1" value='<?php-->
                                <!--                                                                                                    if (!empty($settings->section_2_text_1)) {-->
                                <!--                                                                                                        echo $settings->section_2_text_1;-->
                                <!--                                                                                                    }-->
                                <!--                                                                                                    ?>' placeholder="">-->
                                <!--                        </div>-->
                                <!--                        <div class="form-group col-md-6">-->
                                <!--                            <label for="exampleInputEmail1"><?php echo lang('text_2'); ?> </label>-->
                                <!--                            <input type="text" class="form-control" name="section_2_text_2" value='<?php-->
                                <!--                                                                                                    if (!empty($settings->section_2_text_2)) {-->
                                <!--                                                                                                        echo $settings->section_2_text_2;-->
                                <!--                                                                                                    }-->
                                <!--                                                                                                    ?>' placeholder="">-->
                                <!--                        </div>-->
                                <!--                        <div class="form-group col-md-6">-->
                                <!--                            <label for="exampleInputEmail1"><?php echo lang('text_3'); ?> </label>-->
                                <!--                            <input type="text" class="form-control" name="section_2_text_3" value='<?php-->
                                <!--                                                                                                    if (!empty($settings->section_2_text_3)) {-->
                                <!--                                                                                                        echo $settings->section_2_text_3;-->
                                <!--                                                                                                    }-->
                                <!--                                                                                                    ?>' placeholder="">-->
                                <!--                        </div>-->
                                <!--                        <div class="form-group col-md-6">-->
                                <!--                            <label class="control-label"><?php echo lang('upload_image'); ?></label>-->
                                <!--                            <div class="">-->
                                <!--                                <div class="fileupload fileupload-new" data-provides="fileupload">-->
                                <!--                                    <div class="fileupload-new thumbnail <?php if (!empty($settings->partner_image_2)) { ?> img_auto <?php } else { ?> img_auto1 <?php } ?>">-->
                                <!--                                        <img src="<?php-->
                                <!--                                                    if (empty($settings->partner_image_2)) {-->
                                <!--                                                    } else {-->
                                <!--                                                        echo $settings->partner_image_2;-->
                                <!--                                                    }-->
                                <!--                                                    ?>" id="img" alt="" />-->
                                <!--                                    </div>-->
                                <!--                                    <div class="fileupload-preview fileupload-exists thumbnail logo_thumbnail"></div>-->
                                <!--                                    <div>-->
                                <!--                                        <span class="btn btn-soft-primary waves-effect waves-light btn-file">-->
                                <!--                                            <span class="fileupload-new"><i class="fa fa-paper-clip"></i> <?php echo lang('select_image'); ?></span>-->
                                <!--                                            <span class="fileupload-exists"><i class="fa fa-undo"></i> <?php echo lang('change'); ?></span>-->
                                <!--                                            <input type="file" class="default" name="partner_image_2" />-->
                                <!--                                        </span>-->
                                <!--                                        <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> <?php echo lang('remove'); ?></a>-->
                                <!--                                    </div>-->
                                <!--                                </div>-->

                                <!--                            </div>-->
                                <!--                            <span style="color:gray;"><?php echo lang('recommended_size'); ?>: 740x430</span><br>-->
                                <!--                            <span style="color:gray;">Recommended Type: gif, jpg, png, jpeg</span>-->
                                <!--                        </div>-->
                                <!--                    </div>-->

                                <!--                    <div class="form-group col-md-12 row">-->
                                <!--                        <div class="form-group col-md-12">-->
                                <!--                            <h4> <label for="exampleInputEmail1"><?php echo lang('section_3'); ?> </label></h4>-->
                                <!--                            <hr>-->
                                <!--                        </div>-->
                                <!--                        <div class="form-group col-md-6">-->
                                <!--                            <label for="exampleInputEmail1"><?php echo lang('title'); ?> </label>-->
                                <!--                            <input type="text" class="form-control" name="section_title_3" value='<?php-->
                                <!--                                                                                                    if (!empty($settings->section_title_3)) {-->
                                <!--                                                                                                        echo $settings->section_title_3;-->
                                <!--                                                                                                    }-->
                                <!--                                                                                                    ?>' placeholder="">-->
                                <!--                        </div>-->

                                <!--                        <div class="form-group col-md-6">-->
                                <!--                            <label for="exampleInputEmail1"><?php echo lang('description'); ?> </label>-->
                                <!--                            <input type="text" class="form-control" name="section_description_3" value='<?php-->
                                <!--                                                                                                        if (!empty($settings->section_description_3)) {-->
                                <!--                                                                                                            echo $settings->section_description_3;-->
                                <!--                                                                                                        }-->
                                <!--                                                                                                        ?>' placeholder="">-->
                                <!--                        </div>-->

                                <!--                        <div class="form-group col-md-6">-->
                                <!--                            <label for="exampleInputEmail1"><?php echo lang('text_1'); ?> </label>-->
                                <!--                            <input type="text" class="form-control" name="section_3_text_1" value='<?php-->
                                <!--                                                                                                    if (!empty($settings->section_3_text_1)) {-->
                                <!--                                                                                                        echo $settings->section_3_text_1;-->
                                <!--                                                                                                    }-->
                                <!--                                                                                                    ?>' placeholder="">-->
                                <!--                        </div>-->
                                <!--                        <div class="form-group col-md-6">-->
                                <!--                            <label for="exampleInputEmail1"><?php echo lang('text_2'); ?> </label>-->
                                <!--                            <input type="text" class="form-control" name="section_3_text_2" value='<?php-->
                                <!--                                                                                                    if (!empty($settings->section_3_text_2)) {-->
                                <!--                                                                                                        echo $settings->section_3_text_2;-->
                                <!--                                                                                                    }-->
                                <!--                                                                                                    ?>' placeholder="">-->
                                <!--                        </div>-->
                                <!--                        <div class="form-group col-md-6">-->
                                <!--                            <label for="exampleInputEmail1"><?php echo lang('text_3'); ?> </label>-->
                                <!--                            <input type="text" class="form-control" name="section_3_text_3" value='<?php-->
                                <!--                                                                                                    if (!empty($settings->section_3_text_3)) {-->
                                <!--                                                                                                        echo $settings->section_3_text_3;-->
                                <!--                                                                                                    }-->
                                <!--                                                                                                    ?>' placeholder="">-->
                                <!--                        </div>-->
                                <!--                        <div class="form-group col-md-6">-->
                                <!--                            <label class="control-label"><?php echo lang('upload_image'); ?></label>-->
                                <!--                            <div class="">-->
                                <!--                                <div class="fileupload fileupload-new" data-provides="fileupload">-->
                                <!--                                    <div class="fileupload-new thumbnail <?php if (!empty($settings->partner_image_3)) { ?> img_auto <?php } else { ?> img_auto1 <?php } ?>">-->
                                <!--                                        <img src="<?php-->
                                <!--                                                    if (empty($settings->partner_image_3)) {-->
                                <!--                                                    } else {-->
                                <!--                                                        echo $settings->partner_image_3;-->
                                <!--                                                    }-->
                                <!--                                                    ?>" id="img" alt="" />-->
                                <!--                                    </div>-->
                                <!--                                    <div class="fileupload-preview fileupload-exists thumbnail logo_thumbnail"></div>-->
                                <!--                                    <div>-->
                                <!--                                        <span class="btn btn-soft-primary waves-effect waves-light btn-file">-->
                                <!--                                            <span class="fileupload-new"><i class="fa fa-paper-clip"></i> <?php echo lang('select_image'); ?></span>-->
                                <!--                                            <span class="fileupload-exists"><i class="fa fa-undo"></i> <?php echo lang('change'); ?></span>-->
                                <!--                                            <input type="file" class="default" name="partner_image_3" />-->
                                <!--                                        </span>-->
                                <!--                                        <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> <?php echo lang('remove'); ?></a>-->
                                <!--                                    </div>-->
                                <!--                                </div>-->

                                <!--                            </div>-->
                                <!--                            <span style="color:gray;"><?php echo lang('recommended_size'); ?>: 740x430</span><br>-->
                                <!--                            <span style="color:gray;">Recommended Type: gif, jpg, png, jpeg</span>-->
                                <!--                        </div>-->
                                <!--                    </div>-->
                                <!--                </div>-->
                                <!--                </div>-->
                                <!--</div>-->
                                <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingSeven">
                                                    <button class="accordion-button fw-medium" type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#flush-collapseSeven" aria-expanded="true" aria-controls="flush-collapseSeven">
                                                        <h4>Video Section Settings</h4>
                                                    </button>
                                                </h2>
                                                <div id="flush-collapseSeven" class="accordion-collapse collapse" aria-labelledby="flush-headingSeven"
                                                    data-bs-parent="#accordionFlushExample">
                                                    <div class="card-body">

                                                    <div class="form-group col-md-12 row">
                                                        
                                                    <div class="form-group col-md-6">
                                                            <label for="exampleInputEmail1">Years of experience </label>
                                                            <input type="text" class="form-control" name="years_of_experience" value='<?php
                                                                                                                                    if (!empty($settings->years_of_experience)) {
                                                                                                                                        echo $settings->years_of_experience;
                                                                                                                                    }
                                                                                                                                    ?>' placeholder="">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="exampleInputEmail1">Happy Patients </label>
                                                            <input type="text" class="form-control" name="happy_patients" value='<?php
                                                                                                                                    if (!empty($settings->happy_patients)) {
                                                                                                                                        echo $settings->happy_patients;
                                                                                                                                    }
                                                                                                                                    ?>' placeholder="">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="exampleInputEmail1">Qualified Doctors </label>
                                                            <input type="text" class="form-control" name="qualified_doctors" value='<?php
                                                                                                                                    if (!empty($settings->qualified_doctors)) {
                                                                                                                                        echo $settings->qualified_doctors;
                                                                                                                                    }
                                                                                                                                    ?>' placeholder="">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="exampleInputEmail1">Hospital Rooms </label>
                                                            <input type="text" class="form-control" name="hospital_rooms" value='<?php
                                                                                                                                    if (!empty($settings->hospital_rooms)) {
                                                                                                                                        echo $settings->hospital_rooms;
                                                                                                                                    }
                                                                                                                                    ?>' placeholder="">
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label for="exampleInputEmail1">Video Link </label>
                                                            <input type="text" class="form-control" name="team_button_link" value='<?php
                                                                                                                                    if (!empty($settings->team_button_link)) {
                                                                                                                                        echo $settings->team_button_link;
                                                                                                                                    }
                                                                                                                                    ?>' placeholder="">
                                                        </div>

<code>
    <span>Go to Youtube. Click on a video</span><br>
    <span>Click on the share button. then click on the embed</span><br>
    <span>Copy 'src' value only.</span>
</code>
                                                    </div>
                                                    <div class="form-group col-md-12 row">
                                                      

                                                        <div class="form-group col-md-6">
                                                            <label class="control-label"><?php echo lang('upload_image'); ?></label>
                                                            <div class="">
                                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                                    <div class="fileupload-new thumbnail <?php if (!empty($settings->team_review_logo)) { ?> img_auto <?php } else { ?> img_auto1 <?php } ?>">
                                                                        <img src="<?php
                                                                                    if (empty($settings->team_review_logo)) {
                                                                                    } else {
                                                                                        echo $settings->team_review_logo;
                                                                                    }
                                                                                    ?>" id="img" alt="" />
                                                                    </div>
                                                                    <div class="fileupload-preview fileupload-exists thumbnail logo_thumbnail"></div>
                                                                    <div>
                                                                        <span class="btn btn-soft-primary waves-effect waves-light btn-file">
                                                                            <span class="fileupload-new"><i class="fa fa-paper-clip"></i> <?php echo lang('select_image'); ?></span>
                                                                            <span class="fileupload-exists"><i class="fa fa-undo"></i> <?php echo lang('change'); ?></span>
                                                                            <input type="file" class="default" name="team_review_logo" />
                                                                        </span>
                                                                        <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> <?php echo lang('remove'); ?></a>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <span style="color:gray;"><?php echo lang('recommended_size'); ?>: 740x430</span><br>
                                                            <span style="color:gray;">Recommended Type: gif, jpg, png, jpeg</span>
                                                        </div>

                                                     

                                                    </div>

                                                </div>
                                                </div>
                                </div>
                                <?php if ($this->ion_auth->in_group(array('superadmin'))) { ?>
                                <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingEight">
                                                    <button class="accordion-button fw-medium" type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#flush-collapseEight" aria-expanded="true" aria-controls="flush-collapseEight">
                                                        <h4><?php echo lang('tawk_to_settings'); ?></h4>
                                                    </button>
                                                </h2>
                                                <div id="flush-collapseEight" class="accordion-collapse collapse" aria-labelledby="flush-headingEight"
                                                    data-bs-parent="#accordionFlushExample">
                                                    <div class="card-body">

                                                  
                                                        <div class="form-group col-md-12">
                                                            <label for="exampleInputEmail1"><?php echo lang('tawk_Direct_Chat_Link'); ?></label> <br>
                                                            <input type="text" class="form-control" name="chat_js" id="exampleInputEmail1" value='<?php
                                                                                                                                                    if (!empty($settings->chat_js)) {
                                                                                                                                                        echo $settings->chat_js;
                                                                                                                                                    }
                                                                                                                                                    ?>' placeholder="<?php echo lang('tawk_Direct_Chat_Link'); ?>">
                                                            <code>
                                                                Login <a href="tawk.to">tawk.to</a> then go to Dashboard -> Add-ons -> Chat Widgets <br>
                                                                In the widgets code copy the value of s1.src and paste here
                                                            </code>
                                                        </div>

                                                    

                                                </div>
                                                </div>
                                </div>
                                <?php } ?>
                                </div>
                                   
                                    <input type="hidden" name="id" value='<?php
                                                                            if (!empty($settings->id)) {
                                                                                echo $settings->id;
                                                                            }
                                                                            ?>'>
                                    <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
                                </form>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </section>
        <!-- page end-->
    </div>
</div>
</div>
<!--main content end-->
<!--footer start-->

<script src="common/js/codearistos.min.js"></script>
<script src="common/extranal/js/frontend/settings.js"></script>
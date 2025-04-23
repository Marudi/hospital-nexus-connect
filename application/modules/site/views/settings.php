<!--sidebar end-->
<!--main content start-->
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
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('site'); ?></a></li>
                                        <li class="breadcrumb-item active"><?php echo lang('settings'); ?></li>
                                        
                                       
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <!-- page start-->
        <link href="common/extranal/css/frontend/settings.css" rel="stylesheet">
        <style>
    label{
        color: black;
    }
    .red{
        color: red;
    }
    .accordion-item{
        box-shadow: 14px 2px 35px #f3f2f2;
    }
    .form-group{
        padding: 2px !important;
    }
    </style>
        <section class="card">
        <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-12">     <i class="fa fa-gear"></i> <?php echo lang('website'); ?> <?php echo lang('settings'); ?> </h4> 
                                      
                                    </div>
         
            <div class="card-body">
               
                                <?php echo validation_errors(); ?>
                                <form role="form" action="site/update" method="post" enctype="multipart/form-data">

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
                                                    <div class="card-body">
                                                        <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"><?php echo lang('title'); ?> &#42;</label>
                                                        <input type="text" class="form-control" name="title" value='<?php
                                                                                                                    if (!empty($settings->title)) {
                                                                                                                        echo $settings->title;
                                                                                                                    }
                                                                                                                    ?>' placeholder="system name" >
                                                    </div>


                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"><?php echo lang('address'); ?> &#42;</label>
                                                        <input type="text" class="form-control" name="address" value='<?php
                                                                                                                        if (!empty($settings->address)) {
                                                                                                                            echo $settings->address;
                                                                                                                        }
                                                                                                                        ?>' placeholder="address" >
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"><?php echo lang('phone'); ?> &#42;</label>
                                                        <input type="number" class="form-control" name="phone" value='<?php
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
                                                        <label for="exampleInputEmail1"><?php echo lang('hospital_email'); ?> &#42;</label>
                                                        <input type="text" class="form-control" name="email" value='<?php
                                                                                                                    if (!empty($settings->email)) {
                                                                                                                        echo $settings->email;
                                                                                                                    }
                                                                                                                    ?>' placeholder="email" >
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"><?php echo lang('currency'); ?> &#42;</label>
                                                        <input type="text" class="form-control" name="currency" value='<?php
                                                                                                                        if (!empty($settings->currency)) {
                                                                                                                            echo $settings->currency;
                                                                                                                        }
                                                                                                                        ?>' placeholder="currency" >
                                                    </div>
                                                    
                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1">Footer Text</label>
                                                        <input type="text" class="form-control" name="footer_text" value='<?php
                                                                                                                        if (!empty($settings->footer_text)) {
                                                                                                                            echo $settings->footer_text;
                                                                                                                        }
                                                                                                                        ?>' placeholder="Footer Text" >
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1">Youtube Video Link</label>
                                                        <input type="text" class="form-control" name="youtube_video_link" value='<?php
                                                                                                                        if (!empty($settings->youtube_video_link)) {
                                                                                                                            echo $settings->youtube_video_link;
                                                                                                                        }
                                                                                                                        ?>' placeholder="Video Link" >
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1">Google Map Coordinates</label>
                                                        <input type="text" class="form-control" name="coordinates" value='<?php
                                                                                                                        if (!empty($settings->coordinates)) {
                                                                                                                            echo $settings->coordinates;
                                                                                                                        }
                                                                                                                        ?>' placeholder="Coordinates" >
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="control-label"><?php echo lang('upload'); ?> <?php echo lang('logo'); ?></label>
                                                        <div class="">
                                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                                <div class="fileupload-new thumbnail" style="width: 200px; height: <?php
                                                                                                                                    if (!empty($settings->logo)) {
                                                                                                                                        echo "auto";
                                                                                                                                    } else {
                                                                                                                                        echo "150px";
                                                                                                                                    }
                                                                                                                                    ?>;">
                                                                    <img src="<?php
                                                                                if (empty($settings->logo)) {
                                                                                    echo '//www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image';
                                                                                } else {
                                                                                    echo $settings->logo;
                                                                                }
                                                                                ?>" id="img" alt="" />
                                                                </div>
                                                                <div class="fileupload-preview fileupload-exists thumbnail logo_thumbnail"></div>
                                                                <div>
                                                                    <span class="btn btn-soft-info btn-file">
                                                                        <span class="fileupload-new"><i class="fa fa-paper-clip"></i> <?php echo lang('select_image'); ?></span>
                                                                        <span class="fileupload-exists"><i class="fa fa-undo"></i> <?php echo lang('change'); ?></span>
                                                                        <input type="file" class="default" name="img_url" />
                                                                    </span>
                                                                    <a href="#" class="btn btn-soft-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> <?php echo lang('remove'); ?></a>
                                                                </div>
                                                            </div>

                                                        </div>
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
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="flush-headingTwo">
                                                    <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                                         <h4>Block Text Settings </h4>
                                                    </button>
                                                </h2>
                                                <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo"
                                                    data-bs-parent="#accordionFlushExample">
                                                    <div class="card-body">
                                                    <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"><?php echo lang('footer') . " " . lang('description'); ?></label>
                                                        <input type="text" class="form-control" name="description" value='<?php
                                                                                                                            if (!empty($settings->description)) {
                                                                                                                                echo $settings->description;
                                                                                                                            }
                                                                                                                            ?>' placeholder="Footer Description">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"><?php echo lang('block_1_text_under_title'); ?></label>
                                                        <input type="text" class="form-control" name="block_1_text_under_title" value='<?php
                                                                                                                                        if (!empty($settings->block_1_text_under_title)) {
                                                                                                                                            echo $settings->block_1_text_under_title;
                                                                                                                                        }
                                                                                                                                        ?>' placeholder="">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"><?php echo lang('service_block__text_under_title'); ?></label>
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
                                                        <label for="exampleInputEmail1">Appointment block text under title</label>
                                                        <input type="text" class="form-control" name="appointment_block_text_under_title" value='<?php
                                                                                                                                                if (!empty($settings->appointment_block_text_under_title)) {
                                                                                                                                                    echo $settings->appointment_block_text_under_title;
                                                                                                                                                }
                                                                                                                                                ?>' placeholder="">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1">Gallery Block Text Under Title </label>
                                                        <input type="text" class="form-control" name="gallery_text_under_title" value='<?php
                                                                                                                                        if (!empty($settings->gallery_text_under_title)) {
                                                                                                                                            echo $settings->gallery_text_under_title;
                                                                                                                                        }
                                                                                                                                        ?>' placeholder="">
                                                    </div>
                                                </div>
                                                </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="flush-headingThree">
                                                    <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                                         <h4><?php echo lang('appointment_button_block_settings'); ?></h4>
                                                    </button>
                                                </h2>
                                                <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree"
                                                    data-bs-parent="#accordionFlushExample">
                                                    <div class="card-body">
                                                        <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"><?php echo lang('apppointment_block_title'); ?> &#42;</label>
                                                        <input type="text" class="form-control" name="appointment_title" value='<?php
                                                                                                                                if (!empty($settings->appointment_title)) {
                                                                                                                                    echo $settings->appointment_title;
                                                                                                                                }
                                                                                                                                ?>' placeholder="" >
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"><?php echo lang('apppointment_block_subtitle'); ?> &#42;</label>
                                                        <input type="text" class="form-control" name="appointment_subtitle" value='<?php
                                                                                                                                    if (!empty($settings->appointment_subtitle)) {
                                                                                                                                        echo $settings->appointment_subtitle;
                                                                                                                                    }
                                                                                                                                    ?>' placeholder="" >
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="exampleInputEmail1"><?php echo lang('apppointment_block_description'); ?> &#42;</label>
                                                        <input type="text" class="form-control" name="appointment_description" value='<?php
                                                                                                                                        if (!empty($settings->appointment_description)) {
                                                                                                                                            echo $settings->appointment_description;
                                                                                                                                        }
                                                                                                                                        ?>' placeholder="" >
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="control-label"><?php echo lang('apppointment_block_image'); ?></label>
                                                        <div class="">
                                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                                <div class="fileupload-new thumbnail" style="width: 200px; height: <?php
                                                                                                                                    if (!empty($settings->logo)) {
                                                                                                                                        echo "auto";
                                                                                                                                    } else {
                                                                                                                                        echo "150px";
                                                                                                                                    }
                                                                                                                                    ?>;">
                                                                    <img src="<?php
                                                                                if (empty($settings->appointment_img_url)) {
                                                                                    echo '//www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image';
                                                                                } else {
                                                                                    echo $settings->appointment_img_url;
                                                                                }
                                                                                ?>" id="img" alt="" />
                                                                </div>
                                                                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                                                <div>
                                                                    <span class="btn btn-soft-info btn-file">
                                                                        <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                                                                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                                                        <input type="file" class="default" name="appointment_img_url" />
                                                                    </span>
                                                                    <a href="#" class="btn btn-soft-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="flush-headingFour">
                                                    <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                                                         <h4><?php echo lang('social_settings'); ?></h4>
                                                    </button>
                                                </h2>
                                                <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour"
                                                    data-bs-parent="#accordionFlushExample">
                                                     <div class="card-body">

                                                     <div class="row">
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
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="flush-headingFive">
                                                    <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
                                                         <h4><?php echo lang('select'); ?> <?php echo lang('website'); ?> <?php echo lang('language'); ?></h4>
                                                    </button>
                                                </h2>
                                                <div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingFive"
                                                    data-bs-parent="#accordionFlushExample">
                                                    <div class="card-body">

                                                    <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <select class="form-control js-example-basic-single" name="language" value=''>
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
                                                                                    ?>><?php echo lang('english'); ?>
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


                                                </div>
                                                    </div>
                                                </div>
                                            </div>
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
                                                            <input type="text" class="form-control" name="website_video_link" value='<?php
                                                                                                                                    if (!empty($settings->website_video_link)) {
                                                                                                                                        echo $settings->website_video_link;
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
                                                                    <div class="fileupload-new thumbnail <?php if (!empty($settings->video_image)) { ?> img_auto <?php } else { ?> img_auto1 <?php } ?>">
                                                                        <img src="<?php
                                                                                    if (empty($settings->video_image)) {
                                                                                    } else {
                                                                                        echo $settings->video_image;
                                                                                    }
                                                                                    ?>" id="img" alt="" />
                                                                    </div>
                                                                    <div class="fileupload-preview fileupload-exists thumbnail logo_thumbnail"></div>
                                                                    <div>
                                                                        <span class="btn btn-soft-primary waves-effect waves-light btn-file">
                                                                            <span class="fileupload-new"><i class="fa fa-paper-clip"></i> <?php echo lang('select_image'); ?></span>
                                                                            <span class="fileupload-exists"><i class="fa fa-undo"></i> <?php echo lang('change'); ?></span>
                                                                            <input type="file" class="default" name="video_image" />
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
                                    </div>

                                    <input type="hidden" name="id" value='<?php
                                                                            if (!empty($settings->id)) {
                                                                                echo $settings->id;
                                                                            }
                                                                            ?>'>
                                      <div class="form-group col-md-12 pull-right" style="margin-top: 5px ;">
                                        <button type="submit" name="submit" class="btn btn-info pull-right"><?php echo lang('submit'); ?></button>
                                    </div>
                                </form>
                           
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

<style>
    .form-group {
        margin: 0px;
        padding: 10px;
    }
</style>
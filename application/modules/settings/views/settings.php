<link href="common/extranal/css/settings/settings.css" rel="stylesheet">
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0"><?php echo lang('settings'); ?></h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a
                                        href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                <li class="breadcrumb-item active"><?php echo lang('settings'); ?></li>


                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- page start-->
            <div class="card">
                <div class="card-header table_header">
                    <h4 class="card-title mb-0 col-lg-12"><?php echo lang('settings'); ?></h4>

                </div>

                <div class="card-body">
                    <style>
                    label {
                        color: black;
                    }

                    .red {
                        color: red;
                    }

                    .accordion-item {
                        box-shadow: 14px 2px 35px #f3f2f2;
                    }
                    </style>
                    <div class="clearfix">
                        <div class="col-lg-12">
                            <section class="card">
                                <div class="card-body">
                                    <?php echo validation_errors(); ?>
                                    <form role="form" action="settings/update" method="post"
                                        enctype="multipart/form-data">

                                        <div class="accordion accordion-flush" id="accordionFlushExample">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="flush-headingOne">
                                                    <button class="accordion-button fw-medium" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                                                        aria-expanded="true" aria-controls="flush-collapseOne">
                                                        <h4><?php echo lang('general_settings'); ?></h4>
                                                    </button>
                                                </h2>
                                                <div id="flush-collapseOne" class="accordion-collapse collapse"
                                                    aria-labelledby="flush-headingOne"
                                                    data-bs-parent="#accordionFlushExample">
                                                    <div class="card-body row">
                                                        <div class="form-group col-md-6">
                                                            <label
                                                                for="exampleInputEmail1"><?php echo lang('system_name'); ?>
                                                                &ast;</label>
                                                            <input type="text" class="form-control" name="name" value='<?php
                                                                                                                    if (!empty($settings->system_vendor)) {
                                                                                                                        echo $settings->system_vendor;
                                                                                                                    }
                                                                                                                    ?>'
                                                                placeholder="system name" required="">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="exampleInputEmail1"><?php echo lang('title'); ?>
                                                                &ast;</label>
                                                            <input type="text" class="form-control" name="title" value='<?php
                                                                                                                    if (!empty($settings->title)) {
                                                                                                                        echo $settings->title;
                                                                                                                    }
                                                                                                                    ?>'
                                                                placeholder="title" required="">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label
                                                                for="exampleInputEmail1"><?php echo lang('address'); ?>
                                                                &ast;</label>
                                                            <input type="text" class="form-control" name="address"
                                                                value='<?php
                                                                                                                        if (!empty($settings->address)) {
                                                                                                                            echo $settings->address;
                                                                                                                        }
                                                                                                                        ?>'
                                                                placeholder="address" required="">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="exampleInputEmail1"><?php echo lang('phone'); ?>
                                                                &ast;</label>
                                                            <input type="text" class="form-control" name="phone" value='<?php
                                                                                                                    if (!empty($settings->phone)) {
                                                                                                                        echo $settings->phone;
                                                                                                                    }
                                                                                                                    ?>'
                                                                placeholder="phone" required="">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label
                                                                for="exampleInputEmail1"><?php echo lang('hospital_email'); ?>
                                                                &ast;</label>
                                                            <input type="text" class="form-control" name="email" value='<?php
                                                                                                                    if (!empty($settings->email)) {
                                                                                                                        echo $settings->email;
                                                                                                                    }
                                                                                                                    ?>'
                                                                placeholder="email" required="">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label
                                                                for="exampleInputEmail1"><?php echo lang('currency'); ?>
                                                                &ast;</label>
                                                            <input type="text" class="form-control" name="currency"
                                                                value='<?php
                                                                                                                        if (!empty($settings->currency)) {
                                                                                                                            echo $settings->currency;
                                                                                                                        }
                                                                                                                        ?>'
                                                                placeholder="currency" required="">
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label
                                                                for="exampleInputEmail1"><?php echo lang('footer_message'); ?>
                                                                &ast;</label>
                                                            <input type="text" class="form-control"
                                                                name="footer_message"
                                                                value='<?php
                                                                                                                                if (!empty($settings->footer_message)) {
                                                                                                                                    echo $settings->footer_message;
                                                                                                                                }
                                                                                                                                ?>'
                                                                placeholder="ByCodearistos" required="">
                                                        </div>
                                                        <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                                        <div class="form-group col-md-6">
                                                            <label
                                                                for="exampleInputEmail1"><?php echo lang('show_odontogram_in_history'); ?>
                                                                &ast;</label>
                                                            <select name="show_odontogram_in_history"
                                                                class="form-control" id="" required>
                                                                <option value="yes" <?php if ($settings->show_odontogram_in_history == 'yes') {
                                                                                        echo 'selected';
                                                                                    } ?>><?php echo lang('yes'); ?>
                                                                </option>
                                                                <option value="no" <?php if ($settings->show_odontogram_in_history == 'no') {
                                                                                        echo 'selected';
                                                                                    } ?>><?php echo lang('no'); ?>
                                                                </option>
                                                            </select>

                                                        </div>
                                                        <style>
                                                        .img_height {
                                                            width: 100px;
                                                            height: 100px;

                                                        }
                                                        </style>
                                                        <div class="form-group col-md-6">
                                                            <label for="exampleInputEmail1">Default
                                                                <?php echo lang('vat'); ?> (%) &ast;</label>
                                                            <input type="number" min="0" max="100" class="form-control"
                                                                name="vat"
                                                                value='<?php
                                                                                                                                            if (!empty($settings->vat)) {
                                                                                                                                                echo $settings->vat;
                                                                                                                                            } else {
                                                                                                                                                echo 0;
                                                                                                                                            }
                                                                                                                                            ?>'
                                                                placeholder="vat" required="">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="exampleInputEmail1">Dafault
                                                                <?php echo lang('discount'); ?> (%) &ast;</label>
                                                            <input type="number" min="0" max="100" class="form-control"
                                                                name="discount_percent"
                                                                value='<?php
                                                                                                                                                        if (!empty($settings->discount_percent)) {
                                                                                                                                                            echo $settings->discount_percent;
                                                                                                                                                        } else {
                                                                                                                                                            echo 0;
                                                                                                                                                        }
                                                                                                                                                        ?>'
                                                                placeholder="discount" required="">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label
                                                                for="exampleInputEmail1"><?php echo lang('live_video_conference_settings'); ?>
                                                                &ast;</label>
                                                            <select name="video_type"
                                                                class="form-control" id="" required>
                                                                <option value="Jitsi" <?php if ($settings->video_type == 'Jitsi') {
                                                                                        echo 'selected';
                                                                                    } ?>><?php echo lang('jitsi'); ?>
                                                                </option>
                                                                <option value="Zoom" <?php if ($settings->video_type == 'Zoom') {
                                                                                        echo 'selected';
                                                                                    } ?>><?php echo lang('zoom'); ?>
                                                                </option>
                                                                
                                                            </select>

                                                        </div>
                                             
                                                        <div class="form-group col-md-12">
                                                            <label for="exampleInputEmail1">Footer Invoice Message
                                                                &ast;</label><br>
                                                            <textarea name="footer_invoice_message" cols="100" rows="2"
                                                                value=''
                                                                style="height: 4em !important;"><?php
                                                                                                                                                                    if (!empty($settings->footer_invoice_message)) {
                                                                                                                                                                        echo $settings->footer_invoice_message;
                                                                                                                                                                    }
                                                                                                                                                                    ?></textarea>

                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label
                                                                for="exampleInputEmail1"><?php echo lang('invoice'); ?>
                                                                Temple &ast;</label>
                                                            <div class="form-check radio-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="invoice_choose" id="inlineRadio1"
                                                                    value="invoice1"
                                                                    <?php if (empty($settings)) {
                                                                                                                                                                            echo 'checked';
                                                                                                                                                                        } else {
                                                                                                                                                                            if ($settings->invoice_choose == 'invoice1') {
                                                                                                                                                                                echo 'checked';
                                                                                                                                                                            }
                                                                                                                                                                        } ?>>
                                                                <figure>
                                                                    <a class="example-image-link"
                                                                        href="uploads/invoice_ss.jpg"
                                                                        data-lightbox="invoice-1">
                                                                        <img src="uploads/invoice_ss.jpg"
                                                                            class="form-check-label img_height"
                                                                            alt="invoice-1"></a>
                                                                    <figcaption>A4</figcaption>
                                                                </figure>

                                                            </div>
                                                            <div class="form-check radio-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="invoice_choose" id="inlineRadio2"
                                                                    value="invoice2"
                                                                    <?php
                                                                                                                                                                        if (!empty($settings)) {
                                                                                                                                                                            if ($settings->invoice_choose == 'invoice2') {
                                                                                                                                                                                echo 'checked';
                                                                                                                                                                            }
                                                                                                                                                                        }
                                                                                                                                                                        ?>>
                                                                <figure>
                                                                    <a class="example-image-link"
                                                                        href="uploads/invoice_ss.jpg"
                                                                        data-lightbox="invoice-1">
                                                                        <img src="uploads/invoice_ss.jpg"
                                                                            class="form-check-label img_height"
                                                                            alt="invoice-1"></a>
                                                                    <figcaption>A5</figcaption>
                                                                </figure>
                                                            </div>


                                                        </div>
                                                        <?php } ?>
                                                        <div class="form-group col-md-6">
                                                            <label class="control-label"><?php
                                                                                        if (!$this->ion_auth->in_group(array('superadmin'))) {
                                                                                        ?><?php echo lang('invoice_logo'); ?><?php
                                                                                                    }
                                                                                                        ?>
                                                                <?php
                                                            if ($this->ion_auth->in_group(array('superadmin'))) {
                                                            ?><?php echo lang('website_logo'); ?><?php
                                                                                                    }
                                                                                                        ?></label>
                                                            <div class="">
                                                                <div class="fileupload fileupload-new"
                                                                    data-provides="fileupload">
                                                                    <div
                                                                        class="fileupload-new thumbnail <?php if (!empty($settings->logo)) { ?> img_url <?php } else { ?> img_url1 <?php } ?>">
                                                                        <img src="<?php
                                                                                if (empty($settings->logo)) {
                                                                                    echo '';
                                                                                } else {
                                                                                    echo $settings->logo;
                                                                                }
                                                                                ?>" id="img" alt="" />
                                                                    </div>
                                                                    <div
                                                                        class="fileupload-preview fileupload-exists thumbnail img_class">
                                                                    </div>
                                                                    <div>
                                                                        <span class="btn btn-white btn-file">
                                                                            <span class="fileupload-new"><i
                                                                                    class="fa fa-paper-clip"></i>
                                                                                <?php echo lang('select_image'); ?></span>
                                                                            <span class="fileupload-exists"><i
                                                                                    class="fa fa-undo"></i>
                                                                                <?php echo lang('change'); ?></span>
                                                                            <input type="file" class="default"
                                                                                name="img_url" />
                                                                        </span>
                                                                        <a href="#"
                                                                            class="btn btn-danger fileupload-exists"
                                                                            data-dismiss="fileupload"><i
                                                                                class="fa fa-trash"></i>
                                                                            <?php echo lang('remove'); ?></a>
                                                                    </div>
                                                                </div>
                                                                <span
                                                                    class="help-block"><?php echo lang('recommended_size'); ?>
                                                                    : 200x100</span>
                                                            </div>
                                                        </div>

                                                        <div class="form-group hidden col-md-3">
                                                            <label for="exampleInputEmail1">Buyer</label>
                                                            <input type="hidden" class="form-control" name="buyer"
                                                                value='<?php
                                                                                                                        if (!empty($settings->codec_username)) {
                                                                                                                            echo $settings->buyer;
                                                                                                                        }
                                                                                                                        ?>'
                                                                placeholder="codec_username">
                                                        </div>
                                                        <div class="form-group hidden col-md-3">
                                                            <label for="exampleInputEmail1">Purchase Code</label>
                                                            <input type="hidden" class="form-control" name="p_code"
                                                                value='<?php
                                                                                                                        if (!empty($settings->codec_purchase_code)) {
                                                                                                                            echo $settings->phone;
                                                                                                                        }
                                                                                                                        ?>'
                                                                placeholder="codec_purchase_code">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="map_provider"><?php echo lang('map_provider'); ?></label>
                                                            <select class="form-control" name="map_provider" id="map_provider">
                                                                <option value="google" <?php if ($settings->map_provider == 'google') echo 'selected'; ?>>Google Places</option>
                                                                <option value="openstreetmap" <?php if ($settings->map_provider == 'openstreetmap') echo 'selected'; ?>>OpenStreetMap</option>
                                                            </select>
                                                        </div>

                                                    </div>
                                                    <!-- <div class="accordion-body text-muted">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus
                                                        terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck
                                                        quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid
                                                        single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes
                                                        anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice.</div> -->
                                                </div>
                                            </div>

                                            <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="flush-headingTheme">
                                                    <button class="accordion-button fw-medium collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#flush-collapseTheme"
                                                        aria-expanded="false" aria-controls="flush-collapseTheme">
                                                        <h4><?php echo lang('theme_settings'); ?></h4>
                                                    </button>
                                                </h2>
                                                <div id="flush-collapseTheme" class="accordion-collapse collapse"
                                                    aria-labelledby="flush-headingTheme"
                                                    data-bs-parent="#accordionFlushExample">
                                                    <div class="card-body row">
                                                        <div class="form-group col-md-6">
                                                            <label for="theme"><?php echo lang('theme'); ?>
                                                                &ast;</label>
                                                            <select class="form-control" name="theme" id="theme"
                                                                required="">
                                                                <option value="ripple"
                                                                    <?php if (!empty($settings->theme) && $settings->theme == 'ripple') { echo 'selected'; } ?>>
                                                                    Ripple</option>
                                                                <option value="gradient"
                                                                    <?php if (!empty($settings->theme) && $settings->theme == 'gradient') { echo 'selected'; } ?>>
                                                                    Gradient</option>
                                                                <option value="parallax"
                                                                    <?php if (!empty($settings->theme) && $settings->theme == 'parallax') { echo 'selected'; } ?>>
                                                                    Parallax</option>
                                                                <option value="youtube"
                                                                    <?php if (!empty($settings->theme) && $settings->theme == 'youtube') { echo 'selected'; } ?>>
                                                                    Youtube</option>
                                                                <option value="creative"
                                                                    <?php if (!empty($settings->theme) && $settings->theme == 'creative') { echo 'selected'; } ?>>
                                                                    Creative</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <a href="<?php echo site_url('admin/settings/themes'); ?>" class="btn btn-info">
                                                                <i class="fa fa-paint-brush"></i> <?php echo lang('manage_themes'); ?>
                                                            </a>
                                                            <p class="help-block"><?php echo lang('manage_themes'); ?> - <?php echo lang('upload_theme'); ?>, <?php echo lang('customize_theme'); ?>, <?php echo lang('activate'); ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php } ?>

                                            <?php if ($this->ion_auth->in_group(array('superadmin'))) { ?>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="flush-headingTwo">
                                                    <button class="accordion-button fw-medium collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo"
                                                        aria-expanded="false" aria-controls="flush-collapseTwo">
                                                        <h4><?php echo lang('cron_jobs_settings'); ?> </h4>
                                                    </button>
                                                </h2>
                                                <div id="flush-collapseTwo" class="accordion-collapse collapse"
                                                    aria-labelledby="flush-headingTwo"
                                                    data-bs-parent="#accordionFlushExample">
                                                    <div class="card-body row">
                                                        <div class="form-group col-md-6">
                                                            <label
                                                                for="exampleInputEmail1"><?php echo lang('cron_job'); ?></label>
                                                            <?php
                                                            $base_url = base_url();
                                                            $base_url_explode = explode("//", $base_url);
                                                            ?>
                                                            <input type="text" class="form-control" name="" value='<?php
                                                                                                                    echo 'wget ' . $base_url_explode[1] . 'cronjobs/appointmentRemainder -O /dev/null 2>&1'
                                                                                                                    //  echo '/usr/local/bin/ea-php' .' '. getcwd().'/index.php cronjobs appointmentRemainder >/dev/null 2>&1';
                                                                                                                    ?>'
                                                                placeholder="" readonly="">
                                                            <span
                                                                class="red"><?php echo lang('please_paste_this_code_in_cpanel_cronjob_add_command_field'); ?></span>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label
                                                                for="exampleInputEmail1"><?php echo lang('remainder_before_appointment'); ?></label>
                                                            <div class="input-group">
                                                                <input type="number" min="1" class="form-control"
                                                                    name="remainder_appointment"
                                                                    value='<?php
                                                                                                                                                        if (!empty($settings->remainder_appointment)) {
                                                                                                                                                            echo $settings->remainder_appointment;
                                                                                                                                                        }
                                                                                                                                                        ?>'
                                                                    placeholder="">
                                                                <span class="input-group-addon" id=""><?php
                                                                                                        echo lang('hours');
                                                                                                        ?></span>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <!-- <div class="accordion-body text-muted">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus
                                                        terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck
                                                        quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid
                                                        single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer raw denim
                                                        aesthetic synth nesciunt you probably haven't heard of them accusamus labore.</div> -->
                                                </div>
                                            </div>




                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="flush-headingTheme">
                                                    <button class="accordion-button fw-medium collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#flush-collapseTheme"
                                                        aria-expanded="false" aria-controls="flush-collapseTheme">
                                                        <h4><?php echo lang('theme_settings'); ?></h4>
                                                    </button>
                                                </h2>
                                                <div id="flush-collapseTheme" class="accordion-collapse collapse"
                                                    aria-labelledby="flush-headingTheme"
                                                    data-bs-parent="#accordionFlushExample">
                                                    <div class="card-body row">
                                                        <div class="form-group col-md-6">
                                                            <label for="theme"><?php echo lang('theme'); ?>
                                                                &ast;</label>
                                                            <select class="form-control" name="theme" id="theme"
                                                                required="">
                                                                <option value="default"
                                                                    <?php if (!empty($settings->theme) && $settings->theme == 'default') { echo 'selected'; } ?>>
                                                                    <?php echo lang('default'); ?></option>
                                                                <option value="nischinto_default"
                                                                    <?php if (!empty($settings->theme) && $settings->theme == 'nischinto_default') { echo 'selected'; } ?>>
                                                                    Nischinto Default</option>
                                                                <option value="youtube"
                                                                    <?php if (!empty($settings->theme) && $settings->theme == 'youtube') { echo 'selected'; } ?>>
                                                                    Youtube</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>






                                            <?php } ?>
                                            <!-- <div class="accordion-item">
                                                <h2 class="accordion-header" id="flush-headingThree">
                                                    <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                                        Accordion Item #3
                                                    </button>
                                                </h2>
                                                <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree"
                                                    data-bs-parent="#accordionFlushExample">
                                                    <div class="accordion-body text-muted">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus
                                                        terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck
                                                        quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid
                                                        single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes
                                                        anderson cred nesciunt sapiente ea proident.</div>
                                                </div>
                                            </div> -->
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="flush-headingDrugInteraction">
                                                    <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseDrugInteraction" aria-expanded="false" aria-controls="flush-collapseDrugInteraction">
                                                        <h4><?php echo lang('drug_interaction_settings'); ?></h4>
                                                    </button>
                                                </h2>
                                                <div id="flush-collapseDrugInteraction" class="accordion-collapse collapse" aria-labelledby="flush-headingDrugInteraction" data-bs-parent="#accordionFlushExample">
                                                    <div class="card-body row">
                                                        <div class="form-group col-md-12">
                                                            <h5><?php echo lang('drug_interaction_api_configuration'); ?></h5>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="drug_interaction_source"><?php echo lang('drug_interaction_source'); ?></label>
                                                            <select class="form-control" name="drug_interaction_source" id="drug_interaction_source">
                                                                <option value="openfda" <?php if (isset($settings->drug_interaction_source) && $settings->drug_interaction_source == 'openfda') echo 'selected'; ?>><?php echo lang('openfda_api'); ?> (<?php echo lang('free'); ?>)</option>
                                                                <option value="drugbank" <?php if (isset($settings->drug_interaction_source) && $settings->drug_interaction_source == 'drugbank') echo 'selected'; ?>><?php echo lang('drugbank_api'); ?> (<?php echo lang('paid'); ?>)</option>
                                                                <option value="ddinter" <?php if (isset($settings->drug_interaction_source) && $settings->drug_interaction_source == 'ddinter') echo 'selected'; ?>><?php echo lang('ddinter_api'); ?> (<?php echo lang('free'); ?>)</option>
                                                                <option value="both" <?php if (isset($settings->drug_interaction_source) && $settings->drug_interaction_source == 'both') echo 'selected'; ?>><?php echo lang('all_apis'); ?></option>
                                                            </select> 
                                                            <button type="button" id="test-ddinter-connectivity" class="btn btn-sm btn-info mt-2"><?php echo lang('test_ddinter_connectivity'); ?></button>
                                                            <div id="ddinter-connectivity-result" class="mt-2"></div>
                                                        </div>
                                                        <div class="form-group col-md-6 drugbank-api-key" <?php if (!isset($settings->drug_interaction_source) || $settings->drug_interaction_source == 'openfda') echo 'style="display:none;"'; ?>>
                                                            <label for="drugbank_api_key"><?php echo lang('drugbank_api_key'); ?></label>
                                                            <input type="password" class="form-control" name="drugbank_api_key" id="drugbank_api_key" value="<?php if (isset($settings->drugbank_api_key)) echo $settings->drugbank_api_key; ?>" placeholder="<?php echo lang('drugbank_api_key'); ?>">
                                                            <span class="help-block"><?php echo lang('drugbank_api_key_help'); ?></span>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <hr>
                                                            <p class="text-info">
                                                                <i class="fa fa-info-circle"></i> <?php echo lang('drug_interaction_api_info'); ?>
                                                            </p>
                                                            <ul>
                                                                <li><?php echo lang('openfda_description'); ?></li>
                                                                <li><?php echo lang('drugbank_description'); ?></li>
                                                                <li><?php echo lang('ddinter_description'); ?></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- end accordion -->


                                        <input type="hidden" name="id" value='<?php
                                                                            if (!empty($settings->id)) {
                                                                                echo $settings->id;
                                                                            }
                                                                            ?>'>
                                        <div class="form-group col-md-12 pull-right">
                                            <button type="submit" name="submit"
                                                class="btn btn-info pull-right"><?php echo lang('submit'); ?></button>
                                        </div>
                                    </form>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page end-->
        </div>
    </div>
</div>
<!--main content end-->
<!--footer start-->

<script src="common/js/codearistos.min.js"></script>
<script src="common/extranal/js/settings/settings.js"></script>
<script>
document.querySelector('form').addEventListener('submit', function(e) {
    console.log('Form data:', new FormData(this));
    // Let the form submit normally
});
</script>

<script>
    $(document).ready(function() {
        // Toggle DrugBank API key field based on selected option
        $('#drug_interaction_source').on('change', function() {
            var selectedSource = $(this).val();
            if (selectedSource === 'openfda' || selectedSource === 'ddinter') {
                $('.drugbank-api-key').hide();
            } else {
                $('.drugbank-api-key').show();
            }
        });
        
        // DDInter connectivity test button handler
        $('#test-ddinter-connectivity').click(function() {
            var button = $(this);
            var resultDiv = $('#ddinter-connectivity-result');
            
            // Show loading state
            button.attr('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> <?php echo lang('testing'); ?>');
            resultDiv.html('').removeClass('text-success text-danger');
            
            // Make AJAX request to test DDInter connectivity
            $.ajax({
                url: '<?php echo base_url(); ?>settings/testDDInterConnectivity',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        resultDiv.html('<i class="fa fa-check-circle"></i> ' + response.message).addClass('text-success');
                    } else {
                        resultDiv.html('<i class="fa fa-times-circle"></i> ' + response.message).addClass('text-danger');
                    }
                    button.attr('disabled', false).html('<?php echo lang('test_ddinter_connectivity'); ?>');
                },
                error: function() {
                    resultDiv.html('<i class="fa fa-times-circle"></i> <?php echo lang('ajax_request_failed'); ?>').addClass('text-danger');
                    button.attr('disabled', false).html('<?php echo lang('test_ddinter_connectivity'); ?>');
                }
            });
        });
    });
</script>

<!-- Right Sidebar -->
<div class="right-bar">
</div>
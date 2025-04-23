
<link href="common/extranal/css/hospital/add_new.css" rel="stylesheet">
<link href="common/extranal/css/additional.css" rel="stylesheet">
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0"> <?php
                if (!empty($hospital->id)) {
                    echo lang('edit_hospital');
                } else {
                    echo lang('add_new_hospital');
                }
                ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item"><?php echo lang('hospital'); ?></li>
                                        <li class="breadcrumb-item active"> <?php
                if (!empty($hospital->id)) {
                    echo lang('edit_hospital');
                } else {
                    echo lang('add_new_hospital');
                }
                ?></li>
                                       
                                       
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <!-- page start-->
        <section class="col-md-7 row">
            <div class="card">
            <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-12">  <?php
                if (!empty($hospital->id)) {
                    echo lang('edit_hospital');
                } else {
                    echo lang('add_new_hospital');
                }
                ?></h4> 

                                    </div>
          
      
            <div class="card-body">
            <div class="table-responsive adv-table">
                    <!-- <div class="col-lg-12">
                        <div class="col-lg-3"></div>
                        <div class="col-lg-6">
                            <?php echo validation_errors(); ?>
                        </div>
                        <div class="col-lg-3"></div>
                    </div> -->
                    <form role="form" id="addNewHospital" action="hospital/addNewHospital" method="post" enctype="multipart/form-data">
<div class="row">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo lang('title'); ?> &ast; </label>
                                <input type="text" class="form-control" name="name" value='<?php
                                                                                            if (!empty($hospital->name)) {
                                                                                                echo $hospital->name;
                                                                                            }
                                                                                            ?>' placeholder="" required="">

                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo lang('email'); ?> &ast; </label>
                                <input type="text" class="form-control" name="email" value='<?php
                                                                                            if (!empty($hospital->email)) {
                                                                                                echo $hospital->email;
                                                                                            }
                                                                                            ?>' placeholder="" required="">
                            </div>
                            <div class="form-group">


                                <label for="exampleInputEmail1"><?php echo lang('password'); ?> </label>
                                <input type="password" class="form-control" name="password" placeholder="********">

                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo lang('frontend_website_link'); ?> &ast; </label>
                                <input type="text" class="form-control" autocomplete="off" name="username" data-id="<?php if (!empty($hospital->id)) { echo $hospital->id; } ?>" id="username" value='<?php
                                                                                                                                                                        if (!empty($hospital->username)) {
                                                                                                                                                                            echo $hospital->username;
                                                                                                                                                                        }
                                                                                                                                                                        ?>' placeholder="" required="">
                                <p id="web_link"></p>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo lang('address'); ?> &ast; </label>
                                <input type="text" class="form-control" name="address" value='<?php
                                                                                                if (!empty($hospital->address)) {
                                                                                                    echo $hospital->address;
                                                                                                }
                                                                                                ?>' placeholder="" required="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo lang('phone'); ?> &ast; </label>
                                <input type="text" class="form-control" name="phone" value='<?php
                                                                                            if (!empty($hospital->phone)) {
                                                                                                echo $hospital->phone;
                                                                                            }
                                                                                            ?>' placeholder="" required="">
                            </div>

                            <?php
                            if (!empty($hospital->id)) {
                                $this->db->where('hospital_id', $hospital->id);
                                $settings = $this->db->get('settings')->row();
                            }
                            ?>

                            <div class="form-group">

                                <label for="exampleInputEmail1"> <?php echo lang('language'); ?></label>

                                <select class="form-control m-bot15" name="language" value=''>
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

                            <div class=" sc_form_item sc_form_field label_over country_div col-md-12">
                            <label for="exampleInputEmail1"> <?php echo lang('country'); ?></label>
                            <select class="selectpicker countrypicker" data-live-search="true" data-flag="true" required="" name="country" <?php if (!empty($hospital->id)) { ?>data-default="<?php echo $hospital->country; ?>" <?php } else { ?> data-default="United States" <?php } ?> style="width: 100%;"></select>
                            <!-- <select class="form-control selectpicker countrypicker m-bot15" data-live-search="true" data-flag="true" <?php if (!empty($hospital->id)) { ?>data-default="<?php echo $hospital->country; ?>" <?php } else { ?> data-default="United States" <?php } ?> name="country">
                            </select> -->
                        </div>

                            <div class="form-group">
                                <label for="theme"><?php echo lang('theme'); ?> &ast;</label>
                                <select class="form-control" name="theme" required>
                                    <option value="ripple" <?php
                                        if (!empty($settings->theme)) {
                                            if ($settings->theme == 'ripple') {
                                                echo 'selected';
                                            }
                                        }
                                    ?>>Ripple</option>
                                    <option value="gradient" <?php
                                        if (!empty($settings->theme)) {
                                            if ($settings->theme == 'gradient') {
                                                echo 'selected';
                                            }
                                        }
                                    ?>>Gradient</option>
                                    <option value="parallax" <?php
                                        if (!empty($settings->theme)) {
                                            if ($settings->theme == 'parallax') {
                                                echo 'selected';
                                            }
                                        }
                                    ?>>Parallax</option>
                                    <option value="youtube" <?php
                                        if (!empty($settings->theme)) {
                                            if ($settings->theme == 'youtube') {
                                                echo 'selected';
                                            }
                                        }
                                    ?>>Youtube</option>
                                    <option value="creative" <?php
                                        if (!empty($settings->theme)) {
                                            if ($settings->theme == 'creative') {
                                                echo 'selected';
                                            }
                                        }
                                    ?>>Creative</option>
                                </select>
                            </div>

                        </div>
                        <div class="col-md-6">
                        <?php if (empty($hospital->id)) { ?>
                          

                                <div class="form-group package_select_div">
                                    <label for="exampleInputEmail1"><?php echo lang('package'); ?></label>
                                    <select class="form-control js-example-basic-single pos_select" id="package_select" name="package" value='' required="">
                                        <option value=""> - - - </option>
                                       
                                        <?php foreach ($packages as $package) { ?>
                                            <option value="<?php echo $package->id; ?>" <?php
                                                                                        if (!empty($setval)) {
                                                                                            if ($package->name == set_value('package')) {
                                                                                                echo 'selected';
                                                                                            }
                                                                                        }
                                                                                        if (!empty($hospital->package)) {
                                                                                            if ($package->id == $hospital->package) {
                                                                                                echo 'selected';
                                                                                            }
                                                                                        }
                                                                                        ?>> <?php echo $package->name; ?> </option>
                                        <?php } ?>
                                    </select>
                                </div>


                                <div class="form-group row" id="modules_list" >
                                    <label for="exampleInputEmail1"><?php echo lang('permited_modules'); ?> </label>
                                </div>

                           
                            <div class="form-group col-md-12 package_duration_div">
                                <label for="exampleInputEmail1"> <?php echo lang('package_duration'); ?></label>
                                <select class="form-control m-bot15 js-example-basic-single" id="package_duration" name="package_duration" value=''>

                                    <option value="<?php echo 'monthly'; ?>" <?php
                                                                                if (!empty($hospital)) {
                                                                                    if ($hospital->package_duration == 'monthly') {
                                                                                        echo 'selected';
                                                                                    }
                                                                                }
                                                                                ?>><?php echo lang('monthly'); ?> </option>
                                    <option value="<?php echo 'yearly'; ?>" <?php
                                                                            if (!empty($hospital)) {
                                                                                if ($hospital->package_duration == 'yearly') {
                                                                                    echo 'selected';
                                                                                }
                                                                            }
                                                                            ?>><?php echo lang('yearly'); ?> </option>

                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="exampleInputEmail1"> <?php echo lang('price'); ?></label>
                                <input type="text" class="form-control price-input" name="price" value='' placeholder="">
                            </div>
                          
                        <?php } ?>
                       
                        
                        <div class="payment_div">
                            <?php if (empty($hospital->id)) { ?>
                                <div class="form-group col-md-12">
                                    <div class="">
                                        <label for="exampleInputEmail1"><?php echo lang('deposit_type'); ?></label>
                                    </div>
                                    <div class="">
                                        <select class="form-control m-bot15 js-example-basic-single selecttype" id="selecttype" name="deposit_type" value=''>

                                            <option value="Cash"> <?php echo lang('cash'); ?> </option>
                                            <option value="Card"> <?php echo lang('card'); ?> </option>


                                        </select>
                                    </div>
                                </div>

                                <?php $payment_gateway = $settings->payment_gateway; ?>
                                <div class="card1 row">
                                    <?php if ($payment_gateway == 'PayPal') {
                                    ?>

                                        <div class="form-group col-md-6">
                                            <label for="exampleInputEmail1"> <?php echo lang('card'); ?></label>
                                            <select class="form-control  js-example-basic-single" id="" name="card_type" value=''>

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
                                            <input type="text" class="form-control" id="expire" data-date="" data-date-format="MM YY" placeholder="Expiry (MM/YY)" name="expire_date" maxlength="7" aria-describedby="basic-addon1" value='' placeholder="">
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="exampleInputEmail1"> <?php echo lang('cvv'); ?></label>
                                            <input type="text" class="form-control" id="cvv" name="cvv_number" value="" placeholder="" maxlength="3">
                                        </div>

                                    <?php
                                    }
                                    ?>
                                <?php } ?>
                                </div>

                                <div id="token"></div>
                        </div>
                        </div>
                        <?php if (empty($hospital->id)) { ?>
                            <div class="col-md-12 form-group trial_version_div">
                                <input type="checkbox" name="trial_version" value="1" class="trial_version">
                                <label class="trial_msg" for="exampleInputEmail1"><?php echo lang('do_you_want_trial_version'); ?></label>
                            </div>
                        <?php } ?>
                        <input type="hidden" name="id" value='<?php
                                                                if (!empty($hospital->id)) {
                                                                    echo $hospital->id;
                                                                }
                                                                ?>'>
                                                                <input type="hidden" name="new_hospital_id" value='<?php
                                                                if (!empty($hospital->new_hospital_id)) {
                                                                    echo $hospital->new_hospital_id;
                                                                }
                                                                ?>'>

</div>                       
<div class=" cashsubmit panel col-md-12 pull-right">
                            <button type=" submit" name="submit2" id="submit1" class="btn btn-info row pull-right submit_button"> <?php echo lang('submit'); ?></button>
                        </div>
                        <div class="panel col-md-12 cardsubmit hidden pull-right">
                            <button type="submit" name="pay_now" id="submit-btn" class="btn btn-info row pull-right submit_button" <?php
                                                                                                                                    if (empty($hospital->id)) {
                                                                                                                                        if ($settings->payment_gateway == 'Stripe') {
                                                                                                                                    ?>onClick="stripePay(event);" <?php
                                                                                                                                                                }
                                                                                                                                                            }
                                                                                                                                                                    ?>> <?php echo lang('submit'); ?></button>
                        </div>



                                                                                                                                                       


                    </form>


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


<?php
if (!empty($hospital->id)) {
    $hospital_id = $hospital->id;
    $hospital_package = $hospital->package;
} else {
    $hospital_id = " ";
    $hospital_package = " ";
}
?>

<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
    var hospital_id = "<?php echo $hospital_id; ?>";
</script>
<script type="text/javascript">
    var hospital_package = "<?php echo $hospital_package; ?>";
</script>
<script type="text/javascript">
    var gateway = "<?php echo $gateway->publish; ?>";
</script>
<script type="text/javascript">
    var permited_modules = "<?php echo lang('permited_modules'); ?>";
</script>
<script type="text/javascript">
    var payment_gateway = "<?php echo $settings->payment_gateway; ?>";
</script>
<script type="text/javascript">
    var base_url = "<?php echo base_url(); ?>";
</script>
<script src="common/extranal/js/hospital/add_new.js"></script>

<script>
$(document).ready(function(){
    $('.countrypicker').countrypicker();
});
</script>

<script type="text/javascript">
    $(document).ready(function () {
        var form = $('#addNewHospital');
        var usernameInput = $('#username');
        var webLinkStatus = $('#web_link');
        var submitButtons = $('.submit_button');
        var typingTimer;
        var doneTypingInterval = 500;

        // Function to disable/enable form
        function toggleForm(disable) {
            // Disable/enable all form elements except username and hidden fields
            form.find('input:not([type="hidden"]), select, textarea').not('#username').prop('disabled', disable);
            
            // Disable/enable all submit buttons
            submitButtons.prop('disabled', disable);
            
            // Keep the username field always enabled
            usernameInput.prop('disabled', false);

            // Special handling for payment related fields
            if (disable) {
                $('.card1').find('input, select').prop('disabled', true);
                $('.trial_version').prop('disabled', true);
            } else {
                // Only enable card fields if Card is selected
                if ($('#selecttype').val() === 'Card') {
                    $('.card1').find('input, select').prop('disabled', false);
                }
                $('.trial_version').prop('disabled', false);
            }
        }

        function checkAvailability() {
            var username = usernameInput.val();
            var id = usernameInput.data('id') || '';
            
            // Clear status and enable form if username is empty or undefined
            if (!username || username === 'undefined') {
                webLinkStatus.text('');
                toggleForm(false);
                return;
            }

            if (!id || id === 'undefined') {
                id = '';
            }

            $.ajax({
                url: 'hospital/checkIfUsernameAvailable',
                type: 'GET',
                data: { username: username, id: id }, // Ensure id is empty string if undefined
                dataType: 'json',
                success: function (response) {
                    if (response.check == 1) {
                        var url = base_url + 'site/' + username;
                        // Only show URL if username is valid
                        if (username && username !== 'undefined') {
                            var final_url = '<span class="text-success">Frontend website link is available</span><br><a target="_blank" href="' + url + '">' + url + '</a>';
                            webLinkStatus.html(final_url);
                            toggleForm(false); // Enable form
                        } else {
                            webLinkStatus.html('<span class="text-warning">Please enter a valid website link</span>');
                            toggleForm(true); // Disable form
                        }
                    } else {
                        webLinkStatus.html('<span class="text-danger">Frontend website link is already taken</span>');
                        toggleForm(true); // Disable form
                    }
                },
                error: function () {
                    webLinkStatus.html('<span class="text-warning">Error checking availability</span>');
                    toggleForm(true); // Disable form
                }
            });
        }

        // Handle username input changes
        usernameInput.on('keyup', function () {
            clearTimeout(typingTimer);
            typingTimer = setTimeout(checkAvailability, doneTypingInterval);
        });

        // Check availability on page load only if there's a valid value
        if (usernameInput.val() && usernameInput.val() !== 'undefined') {
            checkAvailability();
        } else {
            webLinkStatus.text('');
            toggleForm(false);
        }

        // Handle payment type changes
        $('#selecttype').on('change', function() {
            if ($(this).val() === 'Card') {
                $('.card1').find('input, select').prop('disabled', false);
            } else {
                $('.card1').find('input, select').prop('disabled', true);
            }
        });

        // Prevent form submission if disabled
        form.on('submit', function(e) {
            if (submitButtons.prop('disabled')) {
                e.preventDefault();
                return false;
            }
        });
    });
</script>
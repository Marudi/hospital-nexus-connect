<link href="common/extranal/css/hospital/hospital.css" rel="stylesheet">
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0"> Hospital List</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item active"><?php echo lang('hospital'); ?></li>
                                       
                                       
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <!-- page start-->
        <section class="card">
        <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-8"> <?php echo lang('all_hospitals'); ?></h4> 
                                        <div class="col-lg-4 no-print pull-right"> 
                                            <a data-toggle="modal" href="hospital/addNewView">
                                                <div class="btn-group pull-right">
                                                    <button id="" class="btn btn-primary waves-effect waves-light w-xs">
                                                    <i class="fa fa-plus-circle"></i>   <?php echo lang('create_new_hospital'); ?>
                                                    </button>
                                                </div>
                                            </a>
                                                            
                                           
                                        </div>
                                    </div>
          

            <div class="card-body">
            <div class="table-responsive adv-table">
                                            <table class="table mb-0" id="editable-sample">
                        <thead> 
                            <tr>
                                <th> <?php echo lang('title'); ?></th>
                                <th> <?php echo lang('email'); ?></th>
                                <th> <?php echo lang('address'); ?></th>
                                <th> <?php echo lang('phone'); ?></th>
                                <th> <?php echo lang('country'); ?></th>
                                <th> <?php echo lang('next_renewal_date'); ?></th>
                                <th> <?php echo lang('package'); ?></th>
                                <th> <?php echo lang('theme'); ?></th>
                                <th> <?php echo lang('status'); ?></th>
                                <th class="no-print"> <?php echo lang('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody>



                            <?php
                            foreach ($hospitals as $hospital) {
                                ?>
                                <tr class="">
                                    <td> <?php echo $hospital->name; ?></td>
                                    <td><?php echo $hospital->email; ?></td>
                                    <td class="center"><?php echo $hospital->address; ?></td>
                                    <td><?php echo $hospital->phone; ?></td>
                                    <td>
                                        <?php
                                        if (!empty($hospital->country)) {
                                            echo $hospital->country;
                                        } else {
                                            echo ' ';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $hospital_payment_details = $this->db->get_where('hospital_payment', array('hospital_user_id' => $hospital->id))->row();
                                        if (!empty($hospital_payment_details)) {
                                            echo $hospital_payment_details->next_due_date;
                                        }
                                        ?>
                                    </td>
                                    <td class="packageChange">
                                        <?php
                                        if (!empty($hospital->package)) {
                                            echo $this->package_model->getPackageById($hospital->package)->name;
                                        }
                                        ?>
                                        <br>
                                        <?php if ($hospital_payment_details->next_due_date_stamp < time()) { ?>
                                            <button  type="button" data-payment-id="<?php echo $hospital->id; ?>"  data-is-free="0" class="btn btn-xs btn-soft-success waves-effect waves-light selectPackage" title="add deposit"><span class="display-big"><?php echo lang('renew'); ?></span>
                                            </button>
                                        <?php } else { ?>
                                            <button  type="button" data-payment-id="<?php echo $hospital->id; ?>"  data-is-free="0" class="btn btn-xs btn-soft-success waves-effect waves-light selectPackage" title="add deposit"><span class="display-big"><?php echo lang('change'); ?></span>
                                            </button>
                                        <?php } ?>


                                    </td>

                                    <td>
                                        <?php
                                        if (!empty($hospital->settings) && !empty($hospital->settings->theme)) {
                                            echo '<a href="site/' .$hospital->username . '" target="_blank" class="badge bg-light text-dark">' . ucfirst($hospital->settings->theme) . '</a>';
                                        } else {
                                            echo '<span class="badge bg-secondary text-white">Not Set</span>';
                                        }
                                        ?>
                                    </td>


                                    <td>
                                        <?php
                                        $status = $this->db->get_where('users', array('id' => $hospital->ion_user_id))->row()->active;
                                        if ($status == '1') {
                                            ?>
                                            <span class="badge badge-soft-info"><?php echo lang('active'); ?></span>
                                            <!-- <button type="button" class="btn btn-xs btn-soft-info waves-effect waves-light btn-xs btn_width" data-toggle="modal" data-id="<?php echo $hospital->id; ?>"><?php echo lang('active'); ?></button>  -->
                                        <?php } else { ?>
                                            <span class="badge badge-soft-danger"><?php echo lang('disabled'); ?></span>
                                            <!-- <button type="button" class="btn btn-xs btn-soft-danger waves-effect waves-light btn-xs delete_button" data-toggle="modal" data-id="<?php echo $hospital->id; ?>"><?php echo lang('disabled'); ?></button>  -->
                                            <?php
                                        }
                                        ?>
                                    </td>
                                    <td class="no-print">
                                        <?php
                                        $status = $this->db->get_where('users', array('id' => $hospital->ion_user_id))->row()->active;
                                        if ($status == '1') {
                                            ?>
                                            <a href="hospital/deactivate?hospital_id=<?php echo $hospital->ion_user_id; ?>" type="button" class="btn btn-soft-warning waves-effect waves-light btn-xs status"  data-id="<?php echo $hospital->id; ?>" onclick="return confirm('Are you sure you want to disable this hospital?');"><?php echo lang('disable'); ?></a>  

                                        <?php } else {
                                            ?>

                                            <a href="hospital/activate?hospital_id=<?php echo $hospital->ion_user_id; ?>" type="button" class="btn  btn-soft-success waves-effect waves-light btn-xs status"  data-id="<?php echo $hospital->id; ?>" onclick="return confirm('Are you sure you want to enable this hospital?');"><?php echo lang('enable'); ?></a>  
                                            <?php
                                        }
                                        ?>
                                        <a type="button" class="btn btn-soft-info waves-effect waves-light btn-xs" data-toggle="" href="hospital/editHospital?id=<?php echo $hospital->id; ?>" data-id="<?php echo $hospital->id; ?>"><i class="fa fa-edit"></i></a>   
                                        <a class="btn btn-soft-danger waves-effect waves-light btn-xs delete_button" href="hospital/delete?id=<?php echo $hospital->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <!-- page end-->
    </div>
</div>
</div>  
<!--main content end-->
<!--footer start-->






<!-- Add Event Modal-->
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">  <?php echo lang('create_new_hospital'); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               
            </div>
            <div class="modal-body">
                <form role="form" action="hospital/addNew" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('name'); ?></label>
                        <input type="text" class="form-control" name="name"  value='' placeholder="">

                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('email'); ?></label>
                        <input type="text" class="form-control" name="email"  value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('password'); ?></label>
                        <input type="password" class="form-control" name="password"  placeholder="">

                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('address'); ?></label>
                        <input type="text" class="form-control" name="address"  value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('phone'); ?></label>
                        <input type="text" class="form-control" name="phone"  value='' placeholder="">
                    </div>

                    <div class="form-group"> 

                        <label for="exampleInputEmail1"> <?php echo lang('language'); ?></label>

                        <select class="form-control m-bot15" name="language" value=''>
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


                    <input type="hidden" name="id" value=''>

                    <button type="submit" name="submit" class="btn btn-info"> <?php echo lang('submit'); ?></button>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Event Modal-->

<!-- Edit Event Modal-->
<div class="modal fade" id="myModal2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-edit"></i>  <?php echo lang('edit_hospital'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="editHospitalForm" action="hospital/addNew" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('name'); ?></label>
                        <input type="text" class="form-control" name="name"  value='' placeholder="">

                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('email'); ?></label>
                        <input type="text" class="form-control" name="email"  value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('password'); ?></label>
                        <input type="password" class="form-control" name="password"  placeholder="********">

                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('address'); ?></label>
                        <input type="text" class="form-control" name="address"  value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('phone'); ?></label>
                        <input type="text" class="form-control" name="phone"  value='' placeholder="">
                    </div>

                    <div class="form-group"> 

                        <label for="exampleInputEmail1"> <?php echo lang('language'); ?></label>

                        <select class="form-control m-bot15" name="language" value=''>
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

                    <input type="hidden" name="id" value=''>

                    <button type="submit" name="submit" class="btn btn-info"> <?php echo lang('submit'); ?></button>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Event Modal-->
<!-- Edit Event Modal-->
<div class="modal fade" id="myModal4" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">  <?php echo lang('add_deposit'); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                
            </div>
            <div class="modal-body row">
                <form role="form" id="editChangeForm" action="settings/changePlanPayment" class="clearfix" method="post" enctype="multipart/form-data">
                    <div class="row">
                    <div class="form-group col-md-6 package_select_div">
                        <label for="exampleInputEmail1"> <?php echo lang('package'); ?></label>
                        <select class="form-control m-bot15 js-example-basic-single" id="package_select" name="package" value='' required> 
                            <option><?php echo lang('select'); ?></option>
                            <?php foreach ($packages as $package) { ?>
                                <option value="<?php echo $package->id; ?>"><?php echo $package->name; ?> </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-6 package_duration_div">
                        <label for="exampleInputEmail1"> <?php echo lang('package_duration'); ?></label>
                        <select class="form-control m-bot15 js-example-basic-single" id="package_duration" name="package_type" value=''>  

                            <option value="<?php echo 'monthly'; ?>"><?php echo lang('monthly'); ?> </option>
                            <option value="<?php echo 'yearly'; ?>"><?php echo lang('yearly'); ?> </option>

                        </select>
                    </div>
                    <div class="col-md-6 panel">
                        <label for="exampleInputEmail1"> <?php echo lang('package'); ?> <?php echo lang('price'); ?></label> 
                        <input type="text" class="form-control pay_in package_price price-input" name="package_price" value=''  placeholder="" readonly="">
                    </div>

                    <div class="col-md-6 panel">
                        <label for="exampleInputEmail1"> <?php echo lang('next_due_date'); ?> </label> 
                        <input type="text" class="form-control pay_in next_due_date" name="next_due_date" value='' placeholder="" readonly="">
                    </div>
                    <div class="form-group col-md-6">
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
                    <div class = "card1 row">
                        <?php
                        $payment_gateway = $settings1->payment_gateway;
                        if ($payment_gateway == 'PayPal') {
                            ?>

                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1"> <?php echo lang('card'); ?></label>
                                <select class="form-control m-bot15 js-example-basic-single"  name="card_type" value=''>  

                                    <option value="Mastercard"> <?php echo lang('mastercard'); ?> </option>   
                                    <option value="Visa"> <?php echo lang('visa'); ?> </option>
                                    <option value="American Express" > <?php echo lang('american_express'); ?> </option>

                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1"> <?php echo lang('cardholder'); ?> <?php echo lang('name'); ?></label>
                                <input type="text" class="form-control" name="cardholder"  value='' placeholder="">
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
                    <input type="hidden" name="from"  value='hospital'>
                    <input type="hidden" name="hospital_id" id="hospital_id" value=''>
                    <input type="hidden" name="id" id="package_id" value=''>
                    <div class=" cashsubmit panel col-md-12 pull-right">
                        
                        <button type="submit" name="submit2" id="submit1"   class="btn btn-info row pull-right submit_button"> <?php echo lang('submit'); ?></button>
                    </div>
                    <div class="panel col-md-12 cardsubmit hidden pull-right">
                        <button type="submit" name="pay_now" id="submit-btn"  class="btn btn-info row pull-right submit_button" 
                                <?php
                                if ($settings1->payment_gateway == 'Stripe') {
                                    ?>onClick="stripePay(event);"<?php }
                                ?>
                                > <?php echo lang('submit'); ?></button>
                    </div>
                    </div>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Event Modal-->
<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">var language = "<?php echo $this->language; ?>";</script>
<script type="text/javascript">var gateway = "<?php echo $gateway->publish; ?>";</script>
<script src="common/extranal/js/hospital/hospital.js"></script>

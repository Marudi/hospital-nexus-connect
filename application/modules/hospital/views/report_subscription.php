<link href="common/extranal/css/hospital/report_subscription.css" rel="stylesheet">
<link href="common/extranal/css/additional.css" rel="stylesheet">
<link href="common/extranal/css/style_add.css" rel="stylesheet">
<?php
    touch('common/js/countrypicker.js');
    ?>
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0"> <?php echo lang('superadmin'); ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('report'); ?></a></li>
                                        <li class="breadcrumb-item active"><?php echo lang('subscription_report'); ?></li>
                                       
                                       
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
                        <div class="row">
        <section class="col-md-3 ">
        <div class="card">
        <div class="card-header table_header section_top_child">
                                        <h4 class="card-title mb-0 col-lg-12">  <i class="fa fa-list-alt"></i> <?php echo lang('filter_by'); ?></h4> 
                                      
                                    </div>
            <!-- <header class="panel-heading clearfix section_top_child">
                <div class="">
                    <i class="fa fa-list-alt"></i> <?php echo lang('filter_by'); ?>
                </div>
            </header> 
            -->
            <!-- <aside class="profile-nav profile-nav_aside card-body"> -->
                <section class="card-body">
                    <form role="form" class="" action="hospital/reportSubscription" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                        
                            <div class="input-group input-large" data-date="13/07/2013" data-date-format="mm/dd/yyyy">
                                <input type="text" class="form-control dpd1" name="date_from" value="<?php
                                if (!empty($from)) {
                                    echo $from;
                                }
                                ?>" placeholder="<?php echo lang('date_from'); ?>" readonly="">
                                <span class="input-group-text"><?php echo lang('to'); ?></span>
                                <input type="text" class="form-control dpd2" name="date_to" value="<?php
                                if (!empty($to)) {
                                    echo $to;
                                }
                                ?>" placeholder="<?php echo lang('date_to'); ?>" readonly="">
                            </div></div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"><?php echo lang('package'); ?></label>
                            <select class="form-control m-bot15 pos_select" id="package_select" name="package" value='' required="">
                                <option value="all" <?php
                                if ($package_select == 'all') {
                                    echo 'selected';
                                }
                                ?>><?php echo lang('all'); ?></option>

                                <?php foreach ($packages as $package) { ?>
                                    <option value="<?php echo $package->id; ?>" <?php
                                    if ($package->id == $package_select) {
                                        echo 'selected';
                                    }
                                    ?> > <?php echo $package->name; ?> </option>
                                        <?php } ?> 
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"><?php echo lang('subscription'); ?> <?php echo lang('type'); ?></label>
                            <select class="form-control m-bot15 pos_select" id="subscription" name="subscription" value='' required="">
                                <option value="all" <?php
                                if ($subscription == 'all') {
                                    echo 'selected';
                                }
                                ?>><?php echo lang('all'); ?></option>
                                <option value="new" <?php
                                if ($subscription == 'new') {
                                    echo 'selected';
                                }
                                ?>><?php   echo lang('new') . ' ' . lang('subscription'); ?></option>
                                <option value="renew" <?php
                                if ($subscription == 'renew') {
                                    echo 'selected';
                                }
                                ?>><?php echo lang('renew'); ?></option>
                               
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"> <?php echo lang('country'); ?></label>
                            <select class="form-control countrypicker selectpicker m-bot15" name="country" data-flag="true" data-live-search="true" <?php if (!empty($country_select)) { ?>data-default="<?php echo $country_select; ?>" <?php } ?>>
                                 
 </select>
         
                        </div>
                        <div class="form-group button_div pull-right">
                            <button type="submit" name="submit" value="submit"  class="btn btn-success submit_button"><?php echo lang('submit'); ?></button>
                            <button type="submit" name="submit" value="reset"  class="btn btn-danger submit_button"><?php echo lang('reset'); ?></button>
                        </div>
                    </form>
                </section>
            <!-- </aside> -->
            </div>
        </section>
        <section class="col-md-7 clearfix">
        <div class="card">
        <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-12"><?php echo lang('subscription_report'); ?></h4> 
                                        
                                    </div>

            <div class="card-body">
            <div class="table-responsive adv-table">
                                            <table class="table mb-0" id="editable-sample1">
                        <thead>
                            <tr>
                                <th> #</th>
                                <th> <?php echo lang('date'); ?></th>
                                <th> <?php echo lang('hospital'); ?> <?php echo lang('name'); ?></th>
                                <th> <?php echo lang('package'); ?></th>
                                <th> <?php echo lang('country'); ?></th>
                                <th> <?php echo lang('payment_gateway'); ?></th>

                                <th> <?php echo lang('subscription'); ?> <?php echo lang('type'); ?></th>
                                <th> <?php echo lang('amount'); ?></th>


                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            foreach ($deposits as $deposit) {
                                if ($package_select != 'all' && !empty($package_select)) {
                                    
                                    $hospital_payment_details = $this->db->get_where('hospital_payment', array('id' => $deposit->payment_id))->row();
                                  if(!empty($hospital_payment_details)){
                                    if ($package_select == $hospital_payment_details->package) {
                                        $total[] = $deposit->deposited_amount;
                                        $hospital_payment = $this->db->get_where('hospital_payment', array('hospital_user_id' => $deposit->hospital_user_id))->row();
                                        ?>
                                        <tr>
                                            <td><?php echo $i + 1; ?>
                           </td>
                                            <td><?php echo $deposit->add_date; ?></td>
                                            <td><?php echo $this->db->get_where('hospital', array('id' => $hospital_payment->hospital_user_id))->row()->name; ?></td>
                                            <td><?php
                                               
                                                $package_details = $this->db->get_where('package', array('id' => $hospital_payment->package))->row();
                                                echo $package_details->name;
                                                ?></td>
                                            <td><?php
                                                $hospital = $this->db->get_where('hospital', array('id' => $hospital_payment->hospital_user_id))->row();
                                                echo $hospital->country;
                                                ?></td>
                                            <td><?php echo $deposit->gateway; ?></td>
                                            <td><?php
                                                if ($deposit->deposited_amount_id) {
                                                    $renew[] = $deposit->deposited_amount;
                                                    echo lang('renew');
                                                } else {
                                                    $subscription_amount[] = $deposit->deposited_amount;
                                                    echo lang('new') . ' ' . lang('subscription');
                                                }
                                                ?></td>
                                            <td><?php echo $settings->currency . ' ' . $deposit->deposited_amount; ?></td>
                                        </tr>
                                        <?php
                                        $i++;
                                    }
                                }                                    
                                } else {

                                    $total[] = $deposit->deposited_amount;
                                    $hospital_payment1 = $this->db->get_where('hospital_payment', array('hospital_user_id' => $deposit->hospital_user_id))->row();
                                    if(!empty($hospital_payment1)){
                                        $hospital_payment = $this->db->get_where('hospital_payment', array('hospital_user_id' => $deposit->hospital_user_id))->row();       
                                    ?>
                                    <tr>
                                        <td><?php echo $i + 1; ?></td>
                                        <td><?php echo $deposit->add_date; ?></td>
                                        <td><?php echo $this->db->get_where('hospital', array('id' => $hospital_payment->hospital_user_id))->row()->name; ?></td>
                                        <td><?php
                                           
                                            $package_details = $this->db->get_where('package', array('id' => $hospital_payment->package))->row();
                                            echo $package_details->name;
                                            ?></td>
                                        <td><?php
                                                $hospital = $this->db->get_where('hospital', array('id' => $hospital_payment->hospital_user_id))->row();
                                               if(!empty($hospital)){
                                                echo $hospital->country;
                                               }
                                                ?></td>
                                        <td><?php echo $deposit->gateway; ?></td>
                                        <td><?php
                                            if ($deposit->deposited_amount_id) {
                                                $renew[] = $deposit->deposited_amount;
                                                echo lang('renew');
                                            } else {
                                                $subscription_amount[] = $deposit->deposited_amount;
                                                echo lang('new') . ' ' . lang('subscription');
                                            }
                                            ?></td>
                                        <td><?php echo $settings->currency . ' ' . $deposit->deposited_amount; ?></td>
                                    </tr>
                                    <?php
                                }
                                    $i++;
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
                        </div>
        </section>
        <section class="col-md-2 clearfix section_middle">
            <section class="card">
                <div class="weather-bg section_middle_child">
                    <div class="card-body section_middle_child_child">
                        <div class="row">
                            <div class="col-md-5">
                                <i class="fa fa-money-bill-alt"></i>
                                    <?php echo lang('new'); ?> <?php echo lang('subscription'); ?>
                            </div>
                            <div class="col-md-7">
                                <div class="degree">
                                    <?php echo $settings->currency; ?>
                                    <?php
                                    if (!empty($subscription_amount)) {

                                        echo array_sum($subscription_amount);
                                    } else {
                                        echo '0';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="card">
                <div class="weather-bg section_middle_child" >
                    <div class="card-body section_middle_child_child">
                        <div class="row">
                            <div class="col-md-5">
                                <i class="fa fa-money-bill-alt"></i>
                                    <?php echo lang('renew'); ?>
                            </div>
                            <div class="col-md-7">
                                <div class="degree">
                                    <?php echo $settings->currency; ?>
                                    <?php
                                    if (!empty($renew)) {

                                        echo array_sum($renew);
                                    } else {
                                        echo '0';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="card">
                <div class="weather-bg section_middle_child">
                    <div class="card-body section_middle_child_child">
                        <div class="row">
                            <div class="col-md-5">
                                <i class="fa fa-money-bill-alt"></i>
                                    <?php echo lang('total'); ?> <?php echo lang('amount'); ?>
                            </div>
                            <div class="col-md-7">
                                <div class="degree">
                                    <?php echo $settings->currency; ?>
                                    <?php
                                    if (!empty($total)) {

                                        echo array_sum($total);
                                    } else {
                                        echo '0';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </section>
                        </div>
    </div>
</div>
</div>

<script src="common/js/codearistos.min.js"></script>

<script src="common/extranal/js/hospital/report_subscription.js"></script>
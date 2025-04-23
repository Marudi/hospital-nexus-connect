<!--main content start-->

<!DOCTYPE html>
<html lang="en" <?php
if (!$this->ion_auth->in_group(array('superadmin'))) {
    $this->db->where('hospital_id', $this->hospital_id);
    $settings_lang = $this->db->get('settings')->row()->language;
    if ($settings_lang == 'arabic') {
        ?>     
              dir="rtl"
          <?php } else { ?>
              dir="ltr"
              <?php
          }
      } else {
          $this->db->where('hospital_id', 'superadmin');
          $settings_lang = $this->db->get('settings')->row()->language;
          if ($settings_lang == 'arabic') {
              ?>
              dir="rtl"     
          <?php } else { ?> 
              dir="ltr"
              <?php
          }
      }
      ?>>
    <link href="common/css/bootstrap.min.css" rel="stylesheet">
    <link href="common/css/bootstrap-reset.css" rel="stylesheet">
   
    <link href="common/assets/fontawesome5pro/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="common/assets/bootstrap-wysihtml5/bootstrap-wysihtml5.css" />
    <style>
        @import url('https://fonts.googleapis.com/css?family=Ubuntu&display=swap');
    </style>
    <link rel="stylesheet" type="text/css" href="common/assets/DataTables/DataTables-1.10.16/custom/css/datatable-responsive-cdn-version-1-0-7.css" />
  <link href="common/extranal/css/settings/invoice.css" rel="stylesheet">
   


    <!-- invoice start-->

    <section class="col-md-12">

        <div class="panel panel-primary" id="invoice">
           
            <div class="panel-body panel_class">
                <div class="row invoice-list">

                    <div class="col-md-12 invoice_head clearfix logotitle">

                        <div class="col-md-6 text-left invoice_head_left">
                            <h3>
                                <?php echo $settings->title ?>
                            </h3>
                            <h4>
                                <?php echo $settings->address ?>
                            </h4>
                            <h4>
                                Tel: <?php echo $settings->phone ?>
                            </h4>
                        </div>
                        <div class="col-md-6 text-right invoice_head_right">
                            <img class="img_logo" src="<?php echo $settings->logo; ?>" width="100">
                        </div>



                    </div>

                    <div class="col-md-12 title" >
                        <h4 class="text-center invoice_text_center">
                            <?php echo lang('payment') ?> <?php echo lang('invoice') ?>
                        </h4>
                    </div>


                    <div class="col-md-12 invoice-box">
                        <table cellpadding="0" cellspacing="0">
                            <tr>
                                <td colspan="2">
                                    <table>
                                        <tr>
                                            <td> 
                                                <div class="paragraphprint">
                                                    <?php $hospital_info = $this->db->get_where('hospital', array('id' => $deposit->hospital_user_id))->row(); ?>
                                                    <label class="control-label"><?php echo lang('hospital'); ?> <?php echo lang('name'); ?> </label>
                                                    <span class="invoice_upper"> : 
                                                        <?php
                                                        if (!empty($hospital_info)) {
                                                            echo $hospital_info->name . ' <br>';
                                                        }
                                                        ?>
                                                    </span>  
                                                </div>
                                                <div class="paragraphprint">
                                                    <label class="control-label"><?php echo lang('address'); ?>  </label>
                                                    <span class="invoice_upper"> : 
                                                        <?php
                                                        if (!empty($hospital_info)) {
                                                            echo $hospital_info->address . ' <br>';
                                                        }
                                                        ?>
                                                    </span></div>

                                                <div class="paragraphprint">
                                                    <label class="control-label"><?php echo lang('phone'); ?>  </label>
                                                    <span class="invoice_upper"> : 
                                                        <?php
                                                        if (!empty($hospital_info)) {
                                                            echo $hospital_info->phone . ' <br>';
                                                        }
                                                        ?>
                                                    </span>
                                                </div>
                                            </td>

                                            <td>

                                                <div class="paragraphprint">

                                                    <label class="control-label"><?php echo lang('date'); ?>  </label>
                                                    <span class="invoice_upper"> : 
                                                        <?php
                                                        if (!empty($deposit->add_date_stamp)) {
                                                            echo date('d-m-Y', $deposit->add_date_stamp) . ' <br>';
                                                        }
                                                        ?>
                                                    </span>

                                                </div>
                                                <div class="paragraphprint">

                                                    <label class="control-label"><?php echo lang('payment'); ?>  <?php echo lang('month'); ?></label>
                                                    <?php $hospital_payment_info = $this->db->get_where('hospital_payment', array('id' => $deposit->payment_id))->row(); ?>
                                                    <span class="invoice_upper"> : 
                                                        <?php
                                                        if (!empty($hospital_payment_info->id)) {
                                                            echo date('F', $hospital_payment_info->add_date_stamp);
                                                        }
                                                        ?>
                                                    </span>

                                                </div>
                                                <div class="paragraphprint">

                                                    <label class="control-label"><?php echo lang('package'); ?>  <?php echo lang('type'); ?></label>
                                                    <span class="invoice_upper"> : 
                                                        <?php
                                                        if (!empty($hospital_payment_info)) {
                                                            if ($hospital_payment_info->package_duration == 'monthly') {
                                                                echo lang('monthly');
                                                            } else {
                                                                echo lang('yearly');
                                                            }
                                                        }
                                                        ?>
                                                    </span>

                                                </div>
                                                <?php if ($deposit->deposited_amount == '0') { ?>
                                                    <div class="paragraphprint">

                                                        <label class="control-label"><?php echo lang('version'); ?> </label>
                                                        <span class="invoice_upper""> : 
                                                            <?php
                                                            echo lang('trial');
                                                            ?>
                                                        </span>

                                                    </div>
                                                <?php } ?>
                                                <div class="paragraphprint">

                                                    <label class="control-label"><?php echo lang('next_payment_date'); ?></label>
                                                    <span class="invoice_upper"> : 
                                                        <?php
                                                        echo $hospital_payment_info->next_due_date;
                                                        ?>
                                                    </span>

                                                </div>

                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </div>



                    <table class="table table-striped table-hover detailssale" id="customers"> 

                        <tr class="theadd">


                            <th>#</th>
                            <th><?php echo lang('package'); ?> <?php echo lang('name'); ?></th>
                            <th><?php echo lang('subscription'); ?> <?php echo lang('type'); ?></th>

                            <th><?php echo lang('amount'); ?></th>
                            <th><?php echo lang('total'); ?></th>

                        </tr>

                        <tbody>
                            <?php $package_details_name = $this->db->get_where('package', array('id' => $hospital_payment_info->package))->row(); ?>


                            <tr>
                                <td><?php echo '1'; ?> </td>
                                <td><?php echo $package_details_name->name; ?> </td>
                                <td class=""><?php
                            if (!empty($hospital_payment_info)) {
                                if ($hospital_payment_info->package_duration == 'monthly') {
                                    echo lang('monthly');
                                } else {
                                    echo lang('yearly');
                                }
                            }
                            ?></td>
                                <td class=""><?php echo $settings->currency; ?>  <?php echo $deposit->deposited_amount; ?> </td>
                                <td class=""><?php echo $settings->currency; ?> <?php echo $deposit->deposited_amount ?> </td>
                            </tr> 

                        </tbody>




                    </table>

                    <table>
                        <tr class="lasttr">
                            <td class="width1"></td>
                            <td  class="width2"></td>
                            <td  class="width3"></td>

                            <td class="font_size"><li><strong><?php echo lang('sub_total'); ?> : </li></td>
                        <td class="font_size1"></strong><?php echo $settings->currency; ?> <?php echo $deposit->deposited_amount ?></td> 
                        </tr>


                        <tr class="lasttr">
                            <td class="width1"></td>
                            <td  class="width2"></td>
                            <td  class="width3"></td>
                            <td class="font_size"><li><strong><?php echo lang('grand_total'); ?> : </strong></li></td>
                        <td class="font_size1"></strong><?php echo $settings->currency; ?> <?php echo $g = $deposit->deposited_amount ?></td> 
                        </tr>
                        <tr class="lasttr">
                            <td class="width2"></td>
                            <td  class="width2">


                            </td>
                            <td  class="width2"></td>
                            <td class="width_font"><li><strong><?php echo lang('amount_received'); ?> : </strong></li></td>
                        <td class="width_font1"></strong><?php echo $settings->currency; ?> <?php echo $r = $deposit->deposited_amount ?></td> 
                        </tr>
                        <tr class="lasttr">
                            <td class="width2"></td>
                            <td  class="width2"></td>
                            <td  class="width2"></td>
                            <td class="width_font"><li><strong><?php echo lang('amount_to_be_paid'); ?> : </strong></li></td>
                        <td class="width_font1"></strong><?php echo $settings->currency; ?> <?php echo $g - $r; ?></td> 
                        </tr>
                    </table>


                </div>
                </section>

                <link href="common/extranal/css/settings/invoice-all.css" rel="stylesheet">


                <script src="common/js/codearistos.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script>


                </section>

                </html>

              


               <script src="common/extranal/js/settings/settings.js"></script>

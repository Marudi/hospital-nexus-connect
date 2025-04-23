<!--sidebar end-->
<!--main content start-->
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0"><?php echo lang('email_settings'); ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item"><?php echo lang('email'); ?></li>
                                        <li class="breadcrumb-item active"><?php echo lang('email_settings'); ?></li>
                                       
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <!-- page start-->
        <link href="common/extranal/css/email/email.css" rel="stylesheet">
        <div class="row">
        <section class="col-md-7"> 
            <div class="card">
        <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-12"><?php echo lang('email_settings'); ?></h4> 
                                       
                                    </div>
            <div class="card-body">
            <div class="table-responsive adv-table">
            <table class="table mb-0" id="">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo lang('name'); ?></th>
                                <th><?php echo lang('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody> 
                            <?php
                            $i = 0;
                            foreach ($email as $email_setting) {

                                $i = $i + 1;
                                ?>
                                <tr class="">
                                    <td><?php echo $i; ?></td>
                                    <td><?php
                                        if (!empty($email_setting->type)) {
                                            echo $email_setting->type;
                                        }
                                        ?>
                                        <br>

                                    </td>

                                    <td>
                                        <a class="btn btn-soft-info btn-xs btn_width" href="email/settings?id=<?php echo $email_setting->id; ?>">   <?php echo lang('manage'); ?></a>
                                    </td>
                                </tr>

                            <?php }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            </div>
        </section>


        <section class="col-md-5"> 
        <div class="card">
        <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-12"> <?php echo lang('select'); ?> <?php echo lang('email'); ?> <?php echo lang('settings'); ?> </h4> 
                                       
                                    </div>
           
            <div class="card-body">
                <form role="form" id="editAppointmentForm" action="settings/selectEmailGateway" class="clearfix" method="post" enctype="multipart/form-data">


                    <?php foreach ($email as $email_setting) {
                        ?>
                        <div class="form-group">
                            <input type="radio" class=""  readonly="" name="email_gateway" id="exampleInputEmail1" value='<?php echo $email_setting->type; ?>' placeholder="" <?php
                            if (!empty($email_setting->type)) {
                                if ($settings->emailtype == $email_setting->type) {
                                    echo 'checked';
                                }
                            }
                            ?>> <?php echo $email_setting->type; ?>
                        </div>
                    <?php }
                    ?>


                    <input type="hidden" name="id" value="<?php echo $settings->id; ?>">

                    <div class="col-md-12 panel pull-right">
                        <button type="submit" name="submit" class="btn btn-info pull-right"> <?php echo lang('submit'); ?></button>
                    </div>
                </form>
            </div>
        </div>
        </section>
        </div>
        <!-- page end-->
    </div>
</div>
</div>
<!--main content end-->


<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">var language = "<?php echo $this->language; ?>";</script>

<script src="common/extranal/js/email/email_setting_option.js"></script>
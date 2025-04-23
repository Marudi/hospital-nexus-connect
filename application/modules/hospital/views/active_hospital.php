<link href="common/extranal/css/hospital/active_hospital.css" rel="stylesheet">
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <i class="fa fa-hospital-o"></i>  <?php echo lang('active_hospitals'); ?>
                <div class="col-md-4 no-print pull-right">
                    <a data-toggle="modal" class="pull-right" href="hospital/addNewView">
                        <div class="btn-group">
                            <button id="" class="btn green">
                                <i class="fa fa-plus-circle"></i>   <?php echo lang('create_new_hospital'); ?>
                            </button>
                        </div>
                    </a>
                </div>
            </header>





            <div class="panel-body">
                <div class="adv-table editable-table">
                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th> <?php echo lang('title'); ?></th>
                                <th> <?php echo lang('email'); ?></th>
                                <th> <?php echo lang('address'); ?></th>
                                <th> <?php echo lang('phone'); ?></th>
                                <th> <?php echo lang('country'); ?></th>
                                <th> <?php echo lang('next_renewal_date'); ?></th>
                                <th> <?php echo lang('package'); ?></th>
                                <th> <?php echo lang('status'); ?></th>
                                <th class="no-print"> <?php echo lang('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody>



                            <?php
                            foreach ($hospitals as $hospital) {
                                $status = $this->db->get_where('users', array('id' => $hospital->ion_user_id))->row()->active;
                                if ($status == '1') {
                                    ?>
                                    <tr class="">
                                        <td> <?php echo $hospital->name; ?></td>
                                        <td><?php echo $hospital->email; ?></td>
                                        <td class="center"><?php echo $hospital->address; ?></td>
                                        <td><?php echo $hospital->phone; ?></td>
                                        <td><?php echo $hospital->country; ?></td>
                                        <td><?php
                                            $hospital_payment_details = $this->db->get_where('hospital_payment', array('hospital_user_id' => $hospital->id))->row();
                                            echo $hospital_payment_details->next_due_date;
                                            ?></td>
                                        <td>
                                            <?php
                                            if (!empty($hospital->package)) {
                                                echo $this->package_model->getPackageById($hospital->package)->name;
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $status = $this->db->get_where('users', array('id' => $hospital->ion_user_id))->row()->active;
                                            if ($status == '1') {
                                                ?>
                                                <button type="button" class="btn btn-info btn-xs btn_width" data-toggle="modal" data-id="<?php echo $hospital->id; ?>" ><?php echo lang('active'); ?></button> 
                                            <?php } else { ?>
                                                <button type="button" class="btn btn-info btn-xs delete_button" data-toggle="modal" data-id="<?php echo $hospital->id; ?>" ><?php echo lang('disabled'); ?></button> 
                                                <?php
                                            }
                                            ?>
                                        </td>
                                        <td class="no-print">
                                            <?php
                                            $status = $this->db->get_where('users', array('id' => $hospital->ion_user_id))->row()->active;
                                            if ($status == '1') {
                                                ?>
                                                <a href="hospital/deactivate?hospital_id=<?php echo $hospital->ion_user_id; ?>&redirect=active" type="button" class="btn btn-info btn-xs status" data-toggle="modal" data-id="<?php echo $hospital->id; ?>" onclick="return confirm('Are you sure you want to disable this hospital?');"><?php echo lang('disable'); ?></a>  

                                            <?php } else {
                                                ?>

                                                <a href="hospital/activate?hospital_id=<?php echo $hospital->ion_user_id; ?>&redirect=active" type="button" class="btn btn-info btn-xs status" data-toggle="modal" data-id="<?php echo $hospital->id; ?>" onclick="return confirm('Are you sure you want to enable this hospital?');"><?php echo lang('enable'); ?></a>  
                                                <?php
                                            }
                                            ?>
                                            <a type="button" class="btn btn-info btn-xs btn_width" data-toggle="" href="hospital/editHospital?id=<?php echo $hospital->id; ?>" data-id="<?php echo $hospital->id; ?>"><i class="fa fa-edit"></i></a>   
                                            <a class="btn btn-info btn-xs btn_width delete_button" href="hospital/delete?id=<?php echo $hospital->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->






<!-- Add Event Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i>  <?php echo lang('create_new_hospital'); ?></h4>
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
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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

<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">var language = "<?php echo $this->language; ?>";</script>
<script src="common/extranal/js/hospital/active_hospital.js"></script>
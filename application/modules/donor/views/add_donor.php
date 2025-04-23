<!--sidebar end-->
<!--main content start-->
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0"> <?php
                if (!empty($donor->id))
                    echo lang('add_donor');
                else
                    echo lang('add_new_donor');
                ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('donor'); ?></a></li>
                                        <li class="breadcrumb-item active"> <?php
                if (!empty($donor->id))
                    echo lang('add_donor');
                else
                    echo lang('add_new_donor');
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
                                    <h4 class="card-title mb-0 col-lg-12"><?php
                if (!empty($donor->id))
                    echo lang('add_donor');
                else
                    echo lang('add_new_donor');
                ?></h4> 
                         </div>
           
            <div class="card-body">
            <div class="table-responsive adv-table">
                    <div class="clearfix">
                        <?php echo validation_errors(); ?>
                        <form role="form" action="donor/addDonor" class="clearfix" method="post" enctype="multipart/form-data">
                            <div class="row">
                            <div class="form-group col-md-5">
                                <label for="exampleInputEmail1"><?php echo lang('name'); ?> &ast; </label>
                                <input type="text" class="form-control" name="name"  value='<?php
                                if (!empty($setval)) {
                                    echo set_value('name');
                                }
                                if (!empty($donor->name)) {
                                    echo $donor->name;
                                }
                                ?>' placeholder="" required="">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="exampleInputEmail1"><?php echo lang('blood_group'); ?></label>
                                <select class="form-control m-bot15" name="group" value=''>
                                    <?php foreach ($groups as $group) { ?>
                                        <option value="<?php echo $group->group; ?>" <?php
                                        if (!empty($setval)) {
                                            if ($group->group == set_value('group')) {
                                                echo 'selected';
                                            }
                                        }
                                        if (!empty($donor->group)) {
                                            if ($group->group == $donor->group) {
                                                echo 'selected';
                                            }
                                        }
                                        ?> > <?php echo $group->group; ?> </option>
                                            <?php } ?> 
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="exampleInputEmail1"><?php echo lang('age'); ?> &ast; </label>
                                <input type="number" class="form-control" name="age"  value='<?php
                                if (!empty($setval)) {
                                    echo set_value('age');
                                }
                                if (!empty($donor->age)) {
                                    echo $donor->age;
                                }
                                ?>' placeholder="" required>
                            </div>
                             <div class="form-group col-md-5">
                                <label for="exampleInputEmail1"><?php echo lang('last_donation_date'); ?> &ast; </label>
                                <input class="form-control form-control-inline input-medium default-date-picker readonly" type="text" name="ldd" value="<?php
                                if (!empty($setval)) {
                                    echo set_value('ldd');
                                }
                                if (!empty($donor->ldd)) {
                                    echo $donor->ldd;
                                }
                                ?>" placeholder="" required="" autocomplete="off">
                            </div>
                            
                            <div class="form-group col-md-4">
                                <label for="exampleInputEmail1"><?php echo lang('phone'); ?> &ast; </label>
                                <input type="text" class="form-control" name="phone"  value='<?php
                                if (!empty($setval)) {
                                    echo set_value('phone');
                                }
                                if (!empty($donor->phone)) {
                                    echo $donor->phone;
                                }
                                ?>' placeholder="" required="">
                            </div>
                            
                            <div class="form-group col-md-3">
                                <label for="exampleInputEmail1"><?php echo lang('sex'); ?></label>
                                <select class="form-control m-bot15" name="sex" value=''>
                                    <option value="Male" <?php
                                    if (!empty($setval)) {
                                        if (set_value('sex') == 'Male') {
                                            echo 'selected';
                                        }
                                    }
                                    if (!empty($donor->sex)) {
                                        if ($donor->sex == 'Male') {
                                            echo 'selected';
                                        }
                                    }
                                    ?> > Male </option>
                                    <option value="Female" <?php
                                    if (!empty($setval)) {
                                        if (set_value('sex') == 'Female') {
                                            echo 'selected';
                                        }
                                    }
                                    if (!empty($donor->sex)) {
                                        if ($donor->sex == 'Female') {
                                            echo 'selected';
                                        }
                                    }
                                    ?> > Female </option>
                                </select>
                            </div>
                           
                            
                            <div class="form-group col-md-3">
                                <label for="exampleInputEmail1"><?php echo lang('email'); ?> &ast; </label>
                                <input type="email" class="form-control" name="email"  value='<?php
                                if (!empty($setval)) {
                                    echo set_value('email');
                                }
                                if (!empty($donor->email)) {
                                    echo $donor->email;
                                }
                                ?>' placeholder="" required="">
                            </div>

                            <input type="hidden" name="id" value='<?php
                            if (!empty($donor->id)) {
                                echo $donor->id;
                            }
                            ?>'>
                            
                            <div class="form-group col-md-12 pull-right">
                               <button type="submit" name="submit" class="btn btn-info pull-right"><?php echo lang('submit'); ?></button>
                            </div>
                            </div>
                        </form>
                    </div>
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

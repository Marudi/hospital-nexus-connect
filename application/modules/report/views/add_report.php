<!--sidebar end-->
<!--main content start-->
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0"> <?php
                if (!empty($report->id)) {
                    echo  lang('edit_report');
                } else {
                    echo lang('add_new_report');
                }
                ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item"><?php echo lang('report'); ?></li>
                                        <li class="breadcrumb-item active"><?php
                if (!empty($report->id)) {
                    echo  lang('edit_report');
                } else {
                    echo lang('add_new_report');
                } ?></li>
                                       
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <!-- page start-->
        <section class="card">
        <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-12"> <?php
                if (!empty($report->id)) {
                    echo '<i class="fa fa-edit"></i> ' . lang('edit_report');
                } else {
                    echo '<i class="fa fa-plus-circle"></i> ' . lang('add_new_report');
                }
                ?></h4> 
                                       
                                    </div>
          
            <div class="card-body">
                <div class="adv-table editable-table ">
                    <div class="clearfix">

                        <div class="col-lg-12">
                            <section class="panel">
                                <div class="panel-body">
                                    <?php echo validation_errors(); ?>
                                    <form role="form" action="report/addReport" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('select_type'); ?> &ast;</label>
                                            <select class="form-control m-bot15 js-example-basic-single" name="type" value='' required="">
                                                <option value="birth" <?php
                                                if (!empty($setval)) {
                                                    if (set_value('type') == 'birth') {
                                                        echo 'selected';
                                                    }
                                                }
                                                if (!empty($report->report_type)) {
                                                    if ($report->report_type == 'birth') {
                                                        echo 'selected';
                                                    }
                                                }
                                                ?>><?php echo lang('birth'); ?></option>
                                                <option value="operation" <?php
                                                if (!empty($setval)) {
                                                    if (set_value('type') == 'operation') {
                                                        echo 'selected';
                                                    }
                                                }
                                                if (!empty($report->report_type)) {
                                                    if ($report->report_type == 'operation') {
                                                        echo 'selected';
                                                    }
                                                }
                                                ?>><?php echo lang('operation'); ?></option>
                                                <option value="expire" <?php
                                                if (!empty($setval)) {
                                                    if (set_value('type') == 'expire') {
                                                        echo 'selected';
                                                    }
                                                }
                                                if (!empty($report->report_type)) {
                                                    if ($report->report_type == 'expire') {
                                                        echo 'selected';
                                                    }
                                                }
                                                ?>><?php echo lang('expire'); ?></option>
                                            </select>
                                        </div>
                                        <div class="form-group">


                                            <label for="exampleInputEmail1"><?php echo lang('description'); ?> &ast;</label>
                                            <input type="text" class="form-control" name="description"  value='<?php
                                            if (!empty($setval)) {
                                                echo set_value('description');
                                            }
                                            if (!empty($report->description)) {
                                                echo $report->description;
                                            }
                                            ?>' placeholder="" required="">

                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('patient'); ?> &ast;</label>
                                            <select class="form-control m-bot15 js-example-basic-single" name="patient" value='' required=""> 
                                                <?php foreach ($patients as $patient) { ?>
                                                    <option value="<?php echo $patient->name . '*' . $patient->ion_user_id; ?>" <?php
                                                    if (!empty($report->patient)) {
                                                        if (explode('*', $report->patient)[1] == $patient->ion_user_id) {
                                                            echo 'selected';
                                                        }
                                                    }
                                                    ?> ><?php echo $patient->name; ?> </option>
                                                        <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('doctor'); ?> &ast;</label>
                                            <select class="form-control m-bot15 js-example-basic-single" name="doctor" value='' required=""> 
                                                <?php foreach ($doctors as $doctor) { ?>
                                                    <option value="<?php echo $doctor->name; ?>" <?php
                                                    if (!empty($setval)) {
                                                        if (set_value('doctor') == $doctor->name) {
                                                            echo 'selected';
                                                        }
                                                    }
                                                    if (!empty($report->doctor)) {
                                                        if ($report->doctor == $doctor->name) {
                                                            echo 'selected';
                                                        }
                                                    }
                                                    ?> ><?php echo $doctor->name; ?> </option>
                                                        <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('date'); ?> &ast;</label>
                                            <input class="form-control form-control-inline input-medium default-date-picker readonly" name="date"  size="16" type="text" value="<?php
                                            if (!empty($setval)) {
                                                echo set_value('date');
                                            }
                                            if (!empty($report->date)) {
                                                echo $report->date;
                                            }
                                            ?>" required="" />

                                        </div>
                                        <input type="hidden" name="id" value='<?php
                                        if (!empty($report->id)) {
                                            echo $report->id;
                                        }
                                        ?>'>
                                        <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
                                    </form>
                                </div>
                            </section>
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

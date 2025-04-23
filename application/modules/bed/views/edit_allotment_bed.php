<!--sidebar end-->
<!--main content start-->
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0"><?php echo lang('edit'); ?> <?php echo lang('admission'); ?> <?php echo lang('details'); ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item"><?php echo lang('bed'); ?></li>
                                        <li class="breadcrumb-item active"><?php echo lang('edit'); ?> <?php echo lang('admission'); ?> <?php echo lang('details'); ?></li>
                                     
                                       
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <!-- page start-->
        <link href="common/extranal/css/bed/edit_alloted_bed.css" rel="stylesheet">
    <div class="row">
        <section class="col-md-9">
            <div class="card">
                <div class="card-header table_header">
                                            <h4 class="card-title mb-0 col-lg-12">  <?php echo lang('admission'); ?> <?php echo lang('details'); ?> | <?php echo $patient->name; ?></h4> 
                                        
                                        </div>
            
                <section class="card-body">
                    <!-- <header class="panel-heading tab-bg-dark-navy-blueee"> -->
                    <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" data-bs-toggle="tab" href="#checkin" role="tab">
                                                        <span class="d-block d-sm-none"><i class="fas fa-cog"></i> <?php echo lang('check_in'); ?></span>
                                                        <span class="d-none d-sm-block"><?php echo lang('check_in'); ?></span>    
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#daily_progress" role="tab">
                                                        <span class="d-block d-sm-none"><i class="fas fa-cog"> <?php echo lang('daily_progress'); ?></i></span>
                                                        <span class="d-none d-sm-block"><?php echo lang('daily_progress'); ?></span>    
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#medicines" role="tab">
                                                        <span class="d-block d-sm-none"><i class="fas fa-cog"> <?php echo lang('medicines'); ?></i></span>
                                                        <span class="d-none d-sm-block"><?php echo lang('medicines'); ?></span>    
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#services" role="tab">
                                                        <span class="d-block d-sm-none"><i class="fas fa-cog"> <?php echo lang('service'); ?></i></span>
                                                        <span class="d-none d-sm-block"><?php echo lang('service'); ?></span>    
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#diagnostic" role="tab">
                                                        <span class="d-block d-sm-none"><i class="fas fa-cog"> <?php echo lang('diagnostic'); ?> <?php echo lang('test'); ?></i></span>
                                                        <span class="d-none d-sm-block"><?php echo lang('diagnostic'); ?> <?php echo lang('test'); ?></span>    
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#bill" role="tab">
                                                        <span class="d-block d-sm-none"><i class="fas fa-cog"> <?php echo lang('bill_summary'); ?></i></span>
                                                        <span class="d-none d-sm-block"><?php echo lang('bill_summary'); ?></span>    
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#checkout" role="tab">
                                                        <span class="d-block d-sm-none"><i class="fas fa-cog"> <?php echo lang('discharge'); ?></i></span>
                                                        <span class="d-none d-sm-block"><?php echo lang('discharge'); ?></span>    
                                                    </a>
                                                </li>
                        

                        </ul>
                    <!-- </header> -->
                    <div class="panel">
                        <div class="tab-content">
                            <div id="checkin" class="tab-pane active">
                                <div class="">
                                    <form role="form" action="" id="editBedAllotment" class="clearfix" method="post" enctype="multipart/form-data">

                                        <div class="form-group col-md-12">
                                            <label for="exampleInputEmail1"><?php echo lang('alloted_time'); ?></label>
                                            <div data-date="" class="input-group date form_datetime-meridian">
                                                <div class="input-group-btn">
                                                    <button type="button" class="btn btn-info date-set"><i class="fa fa-calendar"></i></button>
                                                    <button type="button" class="btn btn-danger date-reset"><i class="fa fa-times"></i></button>
                                                </div>
                                                <input type="text" class="form-control" readonly="" name="a_time" id="alloted_time" value='<?php
                                                                                                                                            if (!empty($allotment->a_time)) {
                                                                                                                                                echo $allotment->a_time;
                                                                                                                                            }
                                                                                                                                            ?>' placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="exampleInputEmail1"><?php echo lang('bed_category'); ?></label>
                                            <select class="form-control m-bot15" id="room_no" name="category" value=''>
                                                <option><?php echo lang('select'); ?></option>
                                                <?php foreach ($room_no as $room) { ?>
                                                    <option value="<?php echo $room->category; ?>" <?php
                                                                                                    if (!empty($allotment->category)) {
                                                                                                        if ($allotment->category == $room->category) {
                                                                                                            echo 'selected';
                                                                                                        }
                                                                                                    }
                                                                                                    ?>> <?php echo $room->category; ?> </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="exampleInputEmail1"><?php echo lang('bed_id'); ?></label>
                                            <select class="form-control m-bot15" id="bed_id" name="bed_id" value=''>
                                                <option value="select"><?php echo lang('select'); ?></option>
                                                <?php
                                                if (!empty($allotment->id)) {
                                                    echo $option;
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="exampleInputEmail1"><?php echo lang('patient'); ?></label>
                                            <select class="form-control m-bot15" id="W  E313Q3q" name="patient" value=''>

                                            </select>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="exampleInputEmail1" class="label_class"><?php echo lang('category'); ?>:</label>
                                            <span></span>
                                            <?php $category_status = explode(',', $allotment->category_status);
                                            ?>
                                            <input type="checkbox" name="category_status[]" value="urgent" <?php
                                                                                                            if (in_array('urgent', $category_status)) {
                                                                                                                echo "checked";
                                                                                                            }
                                                                                                            ?>>
                                            <label class="planned_class"><?php echo lang('urgent'); ?></label>
                                            <input type="checkbox" name="category_status[]" value="planned" <?php
                                                                                                            if (in_array('planned', $category_status)) {
                                                                                                                echo "checked";
                                                                                                            }
                                                                                                            ?>>
                                            <label><?php echo lang('planned'); ?></label>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="exampleInputEmail1" class="label_class"><?php echo lang('reaksione'); ?>:</label>
                                            <textarea name="reaksione" class='form-control' <?php
                                                                                            if (!empty($allotment->d_time) && !$this->ion_auth->in_group(array('admin'))) {
                                                                                                echo 'readonly';
                                                                                            }
                                                                                            ?>><?php
                                                                                                if (!empty($allotment->reaksione)) {
                                                                                                    echo $allotment->reaksione;
                                                                                                }
                                                                                                ?> </textarea>

                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="exampleInputEmail1" class="label_class"><?php echo lang('transferred_from'); ?>:</label>
                                            <textarea name="transferred_from" class='form-control' <?php
                                                                                                    if (!empty($allotment->d_time) && !$this->ion_auth->in_group(array('admin'))) {
                                                                                                        echo 'readonly';
                                                                                                    }
                                                                                                    ?>> <?php
                                                                                                        if (!empty($allotment->transferred_from)) {
                                                                                                            echo $allotment->transferred_from;
                                                                                                        }
                                                                                                        ?></textarea>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="exampleInputEmail1"><?php echo lang('diagnoza_a_shtrimit'); ?>:</label>
                                            <textarea name="diagnoza_a_shtrimit" class='form-control' <?php
                                                                                                        if (!empty($allotment->d_time) && !$this->ion_auth->in_group(array('admin'))) {
                                                                                                            echo 'readonly';
                                                                                                        }
                                                                                                        ?>><?php
                                                                                                            if (!empty($allotment->diagnoza_a_shtrimit)) {
                                                                                                                echo $allotment->diagnoza_a_shtrimit;
                                                                                                            }
                                                                                                            ?> </textarea>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="exampleInputEmail1"><?php echo lang('doctor'); ?></label>
                                            <select class="form-control m-bot15" id="doctors" name="doctor" value=''>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="exampleInputEmail1"><?php echo lang('diagnosis'); ?>:</label>
                                            <textarea name="diagnosis" class='form-control' <?php
                                                                                            if (!empty($allotment->d_time) && !$this->ion_auth->in_group(array('admin'))) {
                                                                                                echo 'readonly';
                                                                                            }
                                                                                            ?>><?php
                                                                                                if (!empty($allotment->diagnosis)) {
                                                                                                    echo $allotment->diagnosis;
                                                                                                }
                                                                                                ?> </textarea>

                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="exampleInputEmail1"><?php echo lang('other_illnesses'); ?>:</label>
                                            <textarea name="other_illnesses" class='form-control' <?php
                                                                                                    if (!empty($allotment->d_time) && !$this->ion_auth->in_group(array('admin'))) {
                                                                                                        echo 'readonly';
                                                                                                    }
                                                                                                    ?>><?php
                                                                                                        if (!empty($allotment->other_illnesses)) {
                                                                                                            echo $allotment->other_illnesses;
                                                                                                        }
                                                                                                        ?>  </textarea>

                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="exampleInputEmail1"><?php echo lang('anamneza'); ?>:</label>
                                            <textarea name="anamneza" class='form-control' <?php
                                                                                            if (!empty($allotment->d_time) && !$this->ion_auth->in_group(array('admin'))) {
                                                                                                echo 'readonly';
                                                                                            }
                                                                                            ?>><?php
                                                                                                if (!empty($allotment->anamneza)) {
                                                                                                    echo $allotment->anamneza;
                                                                                                }
                                                                                                ?> </textarea>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="exampleInputEmail1"><?php echo lang('blood_group'); ?></label>
                                            <select class="form-control m-bot15" id="blood_group" name="blood_group" value=''>
                                                <?php foreach ($blood_group as $blood_group) {
                                                ?>
                                                    <option value="<?php echo $blood_group->id; ?>" <?php
                                                                                                    if ($blood_group->id == $allotment->blood_group) {
                                                                                                        echo 'selected';
                                                                                                    }
                                                                                                    ?>><?php echo $blood_group->bloodgroup; ?> </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="exampleInputEmail1"><?php echo lang('accepting_doctor'); ?></label>
                                            <select class="form-control m-bot15" id="accepting_doctors" name="accepting_doctor" value=''>

                                            </select>
                                        </div>
                                        <input type="hidden" name="id" value='<?php
                                                                                if (!empty($allotment->id)) {
                                                                                    echo $allotment->id;
                                                                                }
                                                                                ?>'>
                                        <div class="form-group col-md-12">
                                            <div class="col-md-6">
                                            </div>
                                            <?php if (empty($allotment->d_time) || $this->ion_auth->in_group(array('admin'))) { ?>
                                                <div class="col-md-12 pull-right">
                                                    <button type="submit" name="submit" class="btn btn-info pull-right history_back" onclick="history.back()"><?php echo lang('exit'); ?></button>
                                                    <button type="submit" name="submit2" class="btn btn-info pull-right submit_checkout"><?php echo lang('submit'); ?></button>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div id="daily_progress" class="tab-pane">
                                <div class="">
                                <div class="table-responsive adv-table">
                                            <table class="table mb-0 " id="edittable_table">
                                    
                                            <thead>
                                                <tr>
                                                    <th><?php echo lang('date'); ?></th>
                                                    <th><?php echo lang('time'); ?></th>
                                                    <th><?php echo lang('description'); ?></th>
                                                    <th><?php echo lang('nurse'); ?></th>
                                                    <th class="no-print"><?php echo lang('edit'); ?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 0;
                                                foreach ($daily_progress as $daily) {
                                                ?>
                                                    <tr id="<?php echo $daily->id; ?>">
                                                        <td data-target="date"><?php echo $daily->date; ?></td>
                                                        <td data-target="time"><?php echo $daily->time; ?></td>
                                                        <td data-target="description"><?php echo $daily->description; ?></td>
                                                        <td data-target="nurse"><?php echo $this->db->get_where('nurse', array('id' => $daily->nurse))->row()->name; ?></td>
                                                        <td class="no-print">
                                                            <button type="button" class="btn btn-soft-info btn-xs btn_width editbutton_dailyprogress" title="<?php echo lang('edit'); ?>" data-toggle="" data-id="<?php echo $daily->id; ?>"><i class="fa fa-edit"></i><?php echo lang('edit'); ?> </button>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>

                                    </div>

                                    <div>
                                        <form role="form" action="" id="editDailyProgress" class="clearfix" method="post" enctype="multipart/form-data">
                                            <div class="form-group col-md-12">
                                                <label for="exampleInputEmail1"><?php echo lang('nurse'); ?></label>
                                                <select class="form-control m-bot15" id="nurses" name="nurse" value='' required="">
                                                </select>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="exampleInputEmail1"> <?php echo lang('date'); ?></label>
                                                <input type="text" class="form-control default-date-picker" id="date1" readonly="" name="date" id="exampleInputEmail1" value='' placeholder="" required="">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="exampleInputEmail1"> <?php echo lang('time'); ?></label>

                                                <input type="text" id="date2" class="form-control timepicker-default1 rounded" readonly="" name="time" id="exampleInputEmail1" value='' placeholder="" required="">
                                            </div>
                                            <div class="form-group col-md-12">

                                                <label for="exampleInputEmail1" class="label_class"><?php echo lang('daily_description'); ?>:</label>
                                                <textarea name="daily_description" class='form-control' <?php
                                                                                                        if (!empty($allotment->d_time) && !$this->ion_auth->in_group(array('admin'))) {
                                                                                                            echo 'readonly';
                                                                                                        }
                                                                                                        ?>> </textarea>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="exampleInputEmail1" class="label_class"><?php echo lang('description'); ?>:</label>
                                                <textarea name="description" class='form-control' <?php
                                                                                                    if (!empty($allotment->d_time) && !$this->ion_auth->in_group(array('admin'))) {
                                                                                                        echo 'readonly';
                                                                                                    }
                                                                                                    ?>> </textarea>

                                            </div>
                                            <input type="hidden" name="alloted_bed_id" value="<?php echo $allotment->id; ?>">
                                            <div id="daily_id"> <input type="hidden" name="daily_progress_id" value=""></div>
                                            <?php if (empty($allotment->d_time) || $this->ion_auth->in_group(array('admin'))) { ?>
                                                <div class="form-group col-md-12">
                                                    <button type="submit" name="submit" class="btn btn-info pull-right submitdaily"><?php echo lang('save'); ?></button>
                                                </div>
                                            <?php } ?>
                                        </form>
                                    </div>

                                </div>
                            </div>

                            <div id="medicines" class="tab-pane">
                                <div class="">
                                    <div class="col-md-12 pull-right save_button_div">
                                        <button id="save_button" type="submit" name="submit" class="btn btn-xs btn-info pull-right"><i class="fa fa-save"></i> <?php echo lang('save'); ?></button>
                                    </div>
                                    <br>
                                    <div class="table-responsive adv-table">
                                            <table class="table mb-0 medicine_table" id="editable-table1">
                                  
                                            <thead>
                                                <tr>
                                                    <th><?php echo lang('date'); ?></th>
                                                    <th><?php echo lang('medicine_gen_name'); ?></th>
                                                    <th><?php echo lang('medicine'); ?> <?php lang('name'); ?></th>
                                                    <th><?php echo lang('invoice_no'); ?>
                                                    <th><?php echo lang('sales'); ?> <?php lang('price'); ?></th>
                                                    <th><?php echo lang('quantity'); ?></th>
                                                    <th><?php echo lang('total'); ?></th>
                                                    <?php if (empty($allotment->d_time) || $this->ion_auth->in_group(array('admin'))) { ?>
                                                        <th class="no-print"><?php echo lang('options'); ?></th>
                                                    <?php } ?>
                                                </tr>
                                            </thead>
                                            <tbody id="medicine_table">
                                                <?php foreach ($daily_medicine as $medicine) { ?>
                                                    <tr id="<?php echo $medicine->id; ?>">
                                                        <td><?php echo date('d-m-y h:i A', $medicine->date); ?></td>
                                                        <td><?php echo $medicine->generic_name; ?></td>
                                                        <td><?php echo $medicine->medicine_name; ?></td>
                                                        <?php
                                                        if (!empty($medicine->payment_id)) {
                                                            $invoice_id = $this->finance_model->getPaymentById($medicine->payment_id)->id;
                                                        } else {
                                                            $invoice_id = '';
                                                        }
                                                        ?>
                                                        <td><?php echo $invoice_id; ?></td>
                                                        <td><?php echo $settings->currency . $medicine->s_price; ?></td>
                                                        <td><?php echo $medicine->quantity; ?></td>
                                                        <td><?php echo $settings->currency . $medicine->total; ?></td>
                                                        <?php if ((empty($allotment->d_time)  && empty($medicine->payment_id)) || $this->ion_auth->in_group(array('admin'))) { ?>
                                                            <td class="no-print" id="delete-<?php echo $medicine->id; ?>"><button type='button' class='btn btn-soft-danger btn-xs btn_width delete_medicine' title='<?php echo lang('delete'); ?>' data-toggle='' data-id="<?php echo $medicine->id; ?>"><i class='fa fa-trash'></i></button></td>
                                                        <?php } ?>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <style>
                                        hr.new5 {
                                            border: 2px solid #3980C0;
                                            border-radius: 5px;
                                            }
                                            .text{
                                              
                                                    padding-top: 4px;
                                                    text-align: center;
                                                    font-weight: 700;
                                                    font-size: 17px;
                                                    font-family: cursive;

                                            }
                                            .btn-soft-danger{
                                                margin-bottom: 5px
                                            }
                                    </style>
                                    <?php if (empty($allotment->d_time) || $this->ion_auth->in_group(array('admin'))) { ?>
                                        <div>
                                            <div class="row"><div class="col-md-5"><hr class="new5"></div><div class="col-md-2 text"><?php echo "Select Medicine" ?>
                                            </div><div class="col-md-5"><hr class="new5"></div></div>
                                            <form role="form" action="" id="editMedicine" class="clearfix" method="post" enctype="multipart/form-data">

                                                <div class="form-group col-md-12 row">
                                                    <div class="col-md-3">
                                                        <select class="form-control m-bot15 block_content" id="generic_name" name="generic_name" value='' required="">
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <select class="form-control m-bot15 block_content" id="medicines_option" name="medicine_name" value='' required="">
                                                        </select>
                                                    </div>

                                                    <div class="col-md-1">
                                                        <input class="input-md total_med" type="text" id="sales_price" name="sales_price" value="" placeholder="<?php echo lang('sales'); ?>" readonly="">
                                                    </div>
                                                    <div class="col-md-1">
                                                        <input class="input-md total_med" id="quantity" type="number" placeholder="<?php echo lang('quantity'); ?>" name="quantity" value="">
                                                    </div>
                                                    <div class="col-md-1">
                                                        <input class="input-md total_med" type="text" id="total" name="total" value="" placeholder="<?php echo lang('total'); ?>" readonly="">
                                                    </div>
                                                    <input type="hidden" id="alloted" name="alloted_bed_id" value="<?php
                                                                                                                    if (!empty($allotment->id)) {
                                                                                                                        echo $allotment->id;
                                                                                                                    }
                                                                                                                    ?>">
                                                    <div class="col-md-2 pull-right">
                                                        <button type="submit" name="submit" class="btn btn-xs btn-soft-info pull-right" style="margin-top:0px;"><i class="fa fa-save"></i></button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div id="services" class="tab-pane">
                                <div class="">
                                    <div class="col-md-12 pull-right save_button_service_div">
                                        <button id="save_button_service" type="submit" name="submit" class="btn btn-xs btn-info pull-right"><i class="fa fa-save"></i> <?php echo lang('save'); ?></button>
                                    </div>
                                    <div class="table-responsive adv-table">
                                            <table class="table mb-0 service_table" id="editable-table2">
                                    
                                            <thead>
                                                <tr>
                                                    <th class="twenty_class"><?php echo lang('service'); ?></th>
                                                    <th class="twenty_class"><?php echo lang('date'); ?></th>
                                                    <th class="twenty_class"><?php echo lang('nurse'); ?></th>
                                                    <th class="ten_class"><?php echo lang('invoice_no'); ?></th>
                                                    <th class="ten_class"><?php echo lang('price'); ?></th>
                                                    <th class="ten_class"><?php echo lang('quantity'); ?></th>
                                                    <th class="ten_class"><?php echo lang('total'); ?></th>
                                                    <?php if (empty($allotment->d_time) || $this->ion_auth->in_group(array('admin'))) { ?>
                                                        <th class="no-print ten_class"><?php echo lang('options'); ?></th>
                                                    <?php } ?>
                                                </tr>
                                            </thead>
                                            <tbody id="paservice_table">
                                                <?php
                                                if (!empty($daily_service)) {
                                                    foreach ($daily_service as $service) {
                                                        $service_name = $this->pservice_model->getPserviceById($service->service)->name;

                                                ?>
                                                        <tr id="<?php echo $service->date; ?>-<?php echo $service->service; ?>">
                                                            <td><?php echo $service_name; ?></td>
                                                            <td><?php echo date('d-m-y h:i A', $service->date); ?></td>
                                                            <td><?php echo $nursename; ?></td>
                                                            <?php
                                                            if (!empty($service->payment_id)) {
                                                                $invoice_id = $this->finance_model->getPaymentById($service->payment_id)->id;
                                                            } else {
                                                                $invoice_id = '';
                                                            }
                                                            ?>
                                                            <td><?php echo $invoice_id; ?></td>
                                                            <td><?php echo $settings->currency; ?><?php echo $service->price; ?></td>
                                                            <td><?php echo $service->quantity ?></td>
                                                            <td><?php echo $settings->currency; ?><?php echo $service->price * $service->quantity; ?></td>
                                                            <?php if (empty($allotment->d_time) || $this->ion_auth->in_group(array('admin'))) { ?>
                                                                <td class="no-print" id="delete-service-<?php echo date('d') . '-' . $service->id; ?>"><button type='button' class='btn btn-danger btn-xs btn_width delete_service' title='<?php echo lang('delete'); ?>' data-toggle='' data-id="<?php echo $service->id . "**" . $service->service; ?>"><i class='fa fa-trash'></i></button></td>
                                                            <?php } ?>
                                                        </tr>
                                                <?php
                                                    }
                                                }

                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <?php if (empty($allotment->d_time) || $this->ion_auth->in_group(array('admin'))) { ?>
                                        <div>
                                        <div class="row"><div class="col-md-5"><hr class="new5"></div><div class="col-md-2 text"><?php echo "Services" ?>
                                            </div><div class="col-md-5"><hr class="new5"></div></div>
                                          
                                            <form role="form" action="" id="editService" class="clearfix" method="post" enctype="multipart/form-data">
                                                <div class="form-group col-md-12">
                                                    <div class="col-md-12" id="nurses_select">
                                                        <label><?php echo lang('nurse'); ?></label>
                                                        <select class="form-control m-bot15" id="nurse_service" name="nurse_service" value=''>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-12 pservice_div row" id="service_options">
                                                        <u>
                                                            <h4><?php echo lang('services'); ?></h4>
                                                        </u> <br>
                                                        <div class="col-md-5">
                                                            <select class="form-control m-bot15 block_content js-example-basic-single" id="pservice" name="pservice" required="">
                                                                <option value=""><?php echo lang('select'); ?></option>
                                                                <?php foreach ($pservice as $patient_service) { ?>
                                                                    <option value="<?php echo $patient_service->id; ?>">
                                                                        <?php echo $patient_service->name; ?>
                                                                    </option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <input class="input-md total_med" type="text" id="service_price" name="service_price" value="" placeholder="<?php echo lang('price'); ?>" readonly="">
                                                        </div>
                                                        <div class="col-md-1">
                                                            <input class="input-md total_med" id="service_quantity" type="number" placeholder="<?php echo lang('quantity'); ?>" name="service_quantity" value="1">
                                                        </div>
                                                        <div class="col-md-1">
                                                            <input class="input-md total_med" type="text" id="service_total" name="service_total" value="" placeholder="<?php echo lang('total'); ?>" readonly="">
                                                        </div>
                                                        <input type="hidden" id="alloted" name="alloted_bed_id" value="<?php
                                                                                                                        if (!empty($allotment->id)) {
                                                                                                                            echo $allotment->id;
                                                                                                                        }
                                                                                                                        ?>">
                                                        <div class="col-md-2 pull-right">
                                                            <button type="submit" name="submit" class="btn btn-xs btn-info pull-right" style="margin-top:0px;"><i class="fa fa-save"></i></button>
                                                        </div>
                                                    </div>

                                                </div>

                                            </form>
                                        </div>

                                    <?php } ?>
                                </div>
                            </div>



                            <div id="diagnostic" class="tab-pane">
                                <div class="">
                                    <div class="col-md-12 pull-right save_button_diagnostic_div">
                                        <button id="save_button_diagnostic" type="submit" name="submit" class="btn btn-xs btn-info pull-right"><i class="fa fa-save"></i> <?php echo lang('save'); ?></button>
                                    </div>
                                    <div class="table-responsive adv-table">
                                            <table class="table mb-0 diagnostic_table" id="editable-table3">
                                   
                                            <thead>
                                                <tr>
                                                    <th class="ten_class"><?php echo lang('diagnostic_test'); ?></th>
                                                    <th class="ten_class"><?php echo lang('date'); ?></th>
                                                    <th class="ten_class"><?php echo lang('nurse'); ?></th>
                                                    <th class="ten_class"><?php echo lang('invoice_no'); ?></th>
                                                    <th class="ten_class"><?php echo lang('price'); ?></th>
                                                    <th class="ten_class"><?php echo lang('quantity'); ?></th>
                                                    <th class="ten_class"><?php echo lang('total'); ?></th>
                                                    <?php if (empty($allotment->d_time) || $this->ion_auth->in_group(array('admin'))) { ?>
                                                        <th class="no-print ten_class"><?php echo lang('options'); ?></th>
                                                    <?php } ?>
                                                </tr>
                                            </thead>
                                            <tbody id="diagnostic_table">
                                                <?php
                                                if (!empty($diagnostics_alloted)) {
                                                    foreach ($diagnostics_alloted as $diagnostic_alloted) {
                                                        $diagnostic_name = $this->finance_model->getPaymentCategoryById($diagnostic_alloted->payment_procedure)->category;
                                                ?>
                                                        <tr id="<?php echo $diagnostic_alloted->date; ?>-<?php echo $diagnostic_alloted->payment_procedure; ?>">
                                                            <td><?php echo $diagnostic_name; ?></td>
                                                            <td><?php echo date('d-m-y h:i A', $diagnostic_alloted->date); ?></td>
                                                            <td><?php echo $nursename; ?></td>
                                                            <?php
                                                            if (!empty($diagnostic_alloted->payment_id)) {
                                                                $invoice_id = $this->finance_model->getPaymentById($diagnostic_alloted->payment_id)->id;
                                                            } else {
                                                                $invoice_id = '';
                                                            }
                                                            ?>
                                                            <td><?php echo $invoice_id; ?></td>
                                                            <td><?php echo $settings->currency; ?><?php echo $diagnostic_alloted->price; ?></td>
                                                            <td><?php echo $diagnostic_alloted->quantity ?></td>
                                                            <td><?php echo $settings->currency; ?><?php echo $diagnostic_alloted->price * $diagnostic_alloted->quantity; ?></td>
                                                            <?php if (empty($allotment->d_time) || $this->ion_auth->in_group(array('admin'))) { ?>
                                                                <td class="no-print" id="delete-diagnostic-<?php echo date('d') . '-' . $diagnostic_alloted->id; ?>"><button type='button' class='btn btn-soft-danger btn-xs btn_width delete_diagnostic' title='<?php echo lang('delete'); ?>' data-toggle='' data-id="<?php echo $diagnostic_alloted->id . "**" . $diagnostic_alloted->payment_procedure; ?>"><i class='fa fa-trash'></i></button></td>
                                                            <?php } ?>
                                                        </tr>
                                                <?php
                                                    }
                                                }
                                                ?>

                                            </tbody>
                                        </table>
                                    </div>
                                    <style>
                                        .table-responsive {
                                            overflow-x:clip  !important;
                                        }
                                    </style>
                                    <?php if (empty($allotment->d_time) || $this->ion_auth->in_group(array('admin'))) { ?>
                                        <div>
                                        <div class="row"><div class="col-md-5"><hr class="new5"></div><div class="col-md-2 text"><?php echo "Test" ?>
                                            </div><div class="col-md-5"><hr class="new5"></div></div>
                                            
                                            <form role="form" action="" id="editDiagnostic" class="clearfix" method="post" enctype="multipart/form-data">
                                                <div class="form-group col-md-12">

                                                    <div class="col-md-12" id="nurses_select">
                                                        <label><?php echo lang('nurse'); ?></label>

                                                        <select class="form-control m-bot15" id="nurse_diagnostic" name="nurse_diagnostic" value=''>

                                                        </select>
                                                    </div>
                                                    <div class="col-md-12 diagnostic_div row" id="diagnostic_options">
                                                        <u>
                                                            <h4><?php echo lang('diagnostic_test'); ?></h4>
                                                        </u> <br>
                                                        <div class="col-md-5">
                                                            <select class="form-control m-bot15 block_content js-example-basic-single" id="diagnostics" name="diagnostic" required="">
                                                                <option value=""><?php echo lang('select'); ?></option>
                                                                <?php foreach ($diagnostics as $diagnostic) { ?>
                                                                    <option value="<?php echo $diagnostic->id; ?>">
                                                                        <?php echo $diagnostic->category; ?>
                                                                    </option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <input class="input-md total_med" type="text" id="diagnostic_price" name="diagnostic_price" value="" placeholder="<?php echo lang('price'); ?>" readonly="">
                                                        </div>
                                                        <div class="col-md-1">
                                                            <input class="input-md total_med" id="diagnostic_quantity" type="number" placeholder="<?php echo lang('quantity'); ?>" name="diagnostic_quantity" value="1">
                                                        </div>
                                                        <div class="col-md-1">
                                                            <input class="input-md total_med" type="text" id="diagnostic_total" name="diagnostic_total" value="" placeholder="<?php echo lang('total'); ?>" readonly="">
                                                        </div>
                                                        <input type="hidden" id="alloted" name="alloted_bed_id" value="<?php
                                                                                                                        if (!empty($allotment->id)) {
                                                                                                                            echo $allotment->id;
                                                                                                                        }                                                                ?>">
                                                        <div class="col-md-2 pull-right">
                                                            <button type="submit" name="submit" class="btn btn-xs btn-info pull-right" style="margin-top:0px;"><i class="fa fa-save"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                    <?php } ?>
                                </div>
                            </div>






                            <div id="bill" class="tab-pane">
                                <div class="">
                                <div class="table-responsive adv-table">
                                            <table class="table mb-0 " id="editable-sample1">
                                  
                                            <thead>
                                                <tr>
                                                    <th class="ten_class"><?php echo lang('invoice_id'); ?></th>
                                                    <th class="ten_class"><?php echo lang('type'); ?></th>
                                                    <th class="ten_class"><?php echo lang('date'); ?></th>
                                                    <th class="ten_class"><?php echo lang('sub_total'); ?></th>
                                                    <th class="ten_class"><?php echo lang('discount'); ?></th>
                                                    <th class="ten_class"><?php echo lang('total'); ?></th>
                                                    <th class="ten_class"><?php echo lang('paid'); ?></th>
                                                    <th class="ten_class"><?php echo lang('due'); ?></th>
                                                </tr>
                                            </thead>
                                            <tbody id="bill_table">
                                                <?php


                                                if (!empty($all_payments)) {
                                                    foreach ($all_payments as $key => $value) {
                                                        $payment_details = $this->finance_model->getPaymentById($value);
                                                        $payment_deposit[] = $this->finance_model->getDepositByPaymentId($payment_details->id);
                                                ?>
                                                        <tr>
                                                            <td><a href="finance/invoice?id=<?php echo $payment_details->id; ?>" target="_blank"><?php echo $payment_details->id; ?></a></td>
                                                            <td>
                                                                <?php
                                                                if ($payment_details->payment_from == 'admitted_patient_bed_medicine') {
                                                                    echo lang('medicine');
                                                                } elseif ($payment_details->payment_from == 'admitted_patient_bed_service') {
                                                                    echo lang('service');
                                                                } elseif ($payment_details->payment_from == 'admitted_patient_bed_diagnostic') {
                                                                    echo lang('diagnostic');
                                                                }
                                                                ?>
                                                            </td>
                                                            <td><?php echo date('d-m-Y', $payment_details->date); ?></td>
                                                            <td><?php echo $settings->currency; ?><?php echo $payment_details->amount; ?></td>
                                                            <td><?php echo $settings->currency; ?><?php echo $payment_details->discount; ?></td>
                                                            <td><?php echo $settings->currency; ?><?php echo $gross_total = $payment_details->gross_total; ?></td>
                                                            <td><?php echo $settings->currency; ?><?php echo $this->finance_model->getDepositAmountByPaymentId($payment_details->id) ?></td>
                                                            <td><?php echo $settings->currency; ?><?php echo $gross_total - $this->finance_model->getDepositAmountByPaymentId($payment_details->id); ?></td>
                                                        </tr>
                                                <?php

                                                        $paid = $this->finance_model->getDepositAmountByPaymentId($payment_details->id);
                                                        if (empty($paid)) {
                                                            $paid = 0;
                                                        }
                                                        $amount[] = $payment_details->amount;
                                                        $discount[] = $payment_details->discount;
                                                        $total[] = $gross_total;
                                                        $total_paid[] = $paid;
                                                        $due[] = $payment_details->gross_total - $paid;
                                                    }
                                                }

                                                if (!empty($amount)) {
                                                    $total_amount = array_sum($amount);
                                                } else {
                                                    $total_amount = 0;
                                                }

                                                if (!empty($discount)) {
                                                    $total_discount = array_sum($discount);
                                                } else {
                                                    $total_discount = 0;
                                                }

                                                if (!empty($total)) {
                                                    $total_total = array_sum($total);
                                                } else {
                                                    $total_total = 0;
                                                }

                                                if (!empty($total_paid)) {
                                                    $total_paid = array_sum($total_paid);
                                                } else {
                                                    $total_paid = 0;
                                                }

                                                if (!empty($due)) {
                                                    $total_due = array_sum($due);
                                                } else {
                                                    $total_due = 0;
                                                }




                                                ?>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td><strong><?php echo lang('total'); ?></strong></td>
                                                    <td><strong>
                                                            <?php echo $settings->currency; ?>
                                                            <?php echo $total_amount; ?>
                                                        </strong></td>
                                                    <td><strong>
                                                            <?php echo $settings->currency; ?>
                                                            <?php echo $total_discount; ?>
                                                        </strong></td>
                                                    <td><strong>
                                                            <?php echo $settings->currency; ?>
                                                            <?php echo $total_total; ?>
                                                        </strong></td>
                                                    <td><strong>
                                                            <?php echo $settings->currency; ?>
                                                            <?php echo $total_paid ?></strong></td>
                                                    <td><strong>
                                                            <?php echo $settings->currency; ?>
                                                            <?php echo $total_due; ?></strong></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>









                            <div id="checkout" class="tab-pane">
                                <div class="">
                                    <div class="adv-table editable-table ">
                                        <div class="">
                                            <form role="form" action="" id="editCheckout" class="clearfix" method="post" enctype="multipart/form-data">
                                                <div class="form-group col-md-12">
                                                    <label for="exampleInputEmail1"><?php echo lang('checkout'); ?> <?php echo lang('date'); ?> <?php echo lang('time'); ?></label>
                                                    <div data-date="" class="input-group date form_datetime-meridian">
                                                        <div class="input-group-btn">
                                                            <button type="button" class="btn btn-info date-set"><i class="fa fa-calendar"></i></button>
                                                            <button type="button" class="btn btn-danger date-reset"><i class="fa fa-times"></i></button>
                                                        </div>
                                                        <input type="text" class="form-control" readonly="" name="d_time" id="exampleInputEmail1" value='<?php
                                                                                                                                                            if (!empty($bed_checkout->date)) {
                                                                                                                                                                echo $bed_checkout->date;
                                                                                                                                                            }
                                                                                                                                                            ?>' placeholder="" required="" <?php
                                                                                                                                                                                            if (!empty($allotment->d_time) && !$this->ion_auth->in_group(array('admin'))) {
                                                                                                                                                                                                echo 'readonly';
                                                                                                                                                                                            }
                                                                                                                                                                                            ?>>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-12">

                                                    <label for="exampleInputEmail1" class="label_class"><?php echo lang('final_diagnosis'); ?>:</label>
                                                    <textarea name="final_diagnosis" class='form-control' <?php
                                                                                                            if (!empty($allotment->d_time) && !$this->ion_auth->in_group(array('admin'))) {
                                                                                                                echo 'readonly';
                                                                                                            }
                                                                                                            ?>><?php
                                                                                                                if (!empty($bed_checkout->final_diagnosis)) {
                                                                                                                    echo $bed_checkout->final_diagnosis;
                                                                                                                }
                                                                                                                ?> </textarea>

                                                </div>
                                                <div class="form-group col-md-12">

                                                    <label for="exampleInputEmail1" class="label_class"><?php echo lang('anatomopatologic_diagnosis'); ?>:</label>
                                                    <textarea name="anatomopatologic_diagnosis" class='form-control' <?php
                                                                                                                        if (!empty($allotment->d_time) && !$this->ion_auth->in_group(array('admin'))) {
                                                                                                                            echo 'readonly';
                                                                                                                        }
                                                                                                                        ?>><?php
                                                                                                                            if (!empty($bed_checkout->anatomopatologic_diagnosis)) {
                                                                                                                                echo $bed_checkout->anatomopatologic_diagnosis;
                                                                                                                            }
                                                                                                                            ?> </textarea>

                                                </div>
                                                <!-- <div class="form-group col-md-12">

                                                    <label for="exampleInputEmail1" class="label_class"><?php echo lang('dikordance'); ?>:</label>
                                                    <textarea name="dikordance" class='form-control'<?php
                                                                                                    if (!empty($allotment->d_time) && !$this->ion_auth->in_group(array('admin'))) {
                                                                                                        echo 'readonly';
                                                                                                    }
                                                                                                    ?>><?php
                                                                                                        if (!empty($bed_checkout->dikordance)) {
                                                                                                            echo $bed_checkout->dikordance;
                                                                                                        }
                                                                                                        ?> </textarea>

                                                </div> -->
                                                <div class="form-group col-md-12">

                                                    <label for="exampleInputEmail1" class="label_class"><?php echo lang('checkout_diagnosis'); ?>:</label>
                                                    <textarea name="checkout_diagnosis" class='form-control' <?php
                                                                                                                if (!empty($allotment->d_time) && !$this->ion_auth->in_group(array('admin'))) {
                                                                                                                    echo 'readonly';
                                                                                                                }
                                                                                                                ?>><?php
                                                                                                                    if (!empty($bed_checkout->checkout_diagnosis)) {
                                                                                                                        echo $bed_checkout->checkout_diagnosis;
                                                                                                                    }
                                                                                                                    ?> </textarea>

                                                </div>
                                                <div class="form-group col-md-12">

                                                    <label for="exampleInputEmail1" class="label_class"><?php echo lang('checkout_state'); ?>:</label>
                                                    <textarea name="checkout_state" class='form-control' <?php
                                                                                                            if (!empty($allotment->d_time) && !$this->ion_auth->in_group(array('admin'))) {
                                                                                                                echo 'readonly';
                                                                                                            }
                                                                                                            ?>><?php
                                                                                                                if (!empty($bed_checkout->checkout_state)) {
                                                                                                                    echo $bed_checkout->checkout_state;
                                                                                                                }
                                                                                                                ?> </textarea>

                                                </div>
                                                <div class="form-group col-md-12">

                                                    <label for="exampleInputEmail1" class="label_class"><?php echo lang('epicrisis'); ?>:</label>
                                                    <textarea name="epicrisis" class='form-control' <?php
                                                                                                    if (!empty($allotment->d_time) && !$this->ion_auth->in_group(array('admin'))) {
                                                                                                        echo 'readonly';
                                                                                                    }
                                                                                                    ?>><?php
                                                                                                        if (!empty($bed_checkout->epicrisis)) {
                                                                                                            echo $bed_checkout->epicrisis;
                                                                                                        }
                                                                                                        ?> </textarea>

                                                </div>
                                                <div class="form-group col-md-12">

                                                    <label for="exampleInputEmail1" class="label_class"><?php echo lang('medicine_to_take'); ?>:</label>
                                                    <textarea id="editor2" name="medicine_to_take" class='form-control ckeditor' <?php
                                                                                                                                    if (!empty($allotment->d_time) && !$this->ion_auth->in_group(array('admin'))) {
                                                                                                                                        echo 'readonly';
                                                                                                                                    }
                                                                                                                                    ?>><?php
                                                                                                                                        if (!empty($bed_checkout->medicine_to_take)) {
                                                                                                                                            echo $bed_checkout->medicine_to_take;
                                                                                                                                        }
                                                                                                                                        ?> </textarea>

                                                </div>
                                                <div class="form-group col-md-12">

                                                    <label for="exampleInputEmail1" class="label_class"><?php echo lang('instruction'); ?>:</label>
                                                    <textarea id="editor1" name="instruction" class='form-control ckeditor' <?php
                                                                                                                            if (!empty($allotment->d_time) && !$this->ion_auth->in_group(array('admin'))) {
                                                                                                                                echo 'readonly';
                                                                                                                            }
                                                                                                                            ?>><?php
                                                                                                                                if (!empty($bed_checkout->instruction)) {
                                                                                                                                    echo $bed_checkout->instruction;
                                                                                                                                }
                                                                                                                                ?> </textarea>

                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="exampleInputEmail1"><?php echo lang('doctor'); ?></label>
                                                    <select class="form-control m-bot15" id="doctors_checkout" name="doctors_checkout" value=''>
                                                        <?php if (!empty($bed_checkout->doctor)) {
                                                            $doctor1 = $this->db->get_where('doctor', array('id' => $bed_checkout->doctor))->row();
                                                        ?>
                                                            <option value="<?php echo $bed_checkout->doctor; ?>" <?php
                                                                                                                    if (!empty($allotment->d_time) && !$this->ion_auth->in_group(array('admin'))) {
                                                                                                                        echo 'selected';
                                                                                                                        echo 'disabled';
                                                                                                                    }
                                                                                                                    ?>><?php echo $doctor1->name . '(Id:' . $doctor1->id . ')'; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <input type="hidden" name="id" value="<?php
                                                                                        if (!empty($bed_checkout->id)) {
                                                                                            echo $bed_checkout->id;
                                                                                        }
                                                                                        ?>">
                                                <input type="hidden" name="alloted_bed_id" value="<?php
                                                                                                    if (!empty($allotment->id)) {
                                                                                                        echo $allotment->id;
                                                                                                    }
                                                                                                    ?>">
                                                                                                  
                                                <?php if (empty($allotment->d_time) || $this->ion_auth->in_group(array('admin'))) {
                                                    if (array_sum($due ?? []) <= 0) { ?>
                                                        <div class="col-md-12 pull-right">
                                                            <button id="checkout_submit" type="submit" name="submit" class="btn btn-xs btn-info pull-right"><?php echo lang('discharge'); ?></button>
                                                        </div>
                                                    <?php } else { ?>
                                                        <div class="col-md-12 badge bg-warning"> All bill should be paid before discharge. Discharge Button will appear after payment.</div>
                                                <?php   }
                                                } ?>


                                                <!-- <?php if (empty($allotment->d_time) || $this->ion_auth->in_group(array('admin'))) { ?>

                                                    <div class="col-md-12">
                                                        <button id="checkout_submit" type="submit" name="submit" class="btn btn-xs btn-info pull-right"><?php echo lang('discharge'); ?></button>
                                                    </div>

                                                <?php   } ?> -->




                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </section>
            </div>
        </section>

        <style>
            .float_end{
                float: right;
            }
        </style>
        <section class="col-md-3 no-print">
            <div class="card">
                                    <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-12">    <?php echo lang('admission'); ?> <?php echo lang('details'); ?></h4> 
                                      
                                    </div>
          
            <section class="card-body">
                    <aside class="profile-nav">
                <section class="">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"> <?php echo lang('admission'); ?> <?php echo lang('id'); ?> <span class="label pull-right r-activity  float_end"><?php
                                                                                                                                    if (!empty($allotment->id)) {
                                                                                                                                        echo $allotment->id;
                                                                                                                                    }
                                                                                                                                    ?></span></li>
                        <li class="list-group-item"> <?php echo lang('admission'); ?> <?php echo lang('date'); ?> <span class="label pull-right r-activity  float_end"><?php
                                                                                                                                    if (!empty($allotment->a_time)) {
                                                                                                                                        echo $allotment->a_time;
                                                                                                                                    }
                                                                                                                                    ?></span></li>
                        <li class="list-group-item"> <?php echo lang('discharge'); ?> <?php echo lang('date'); ?> <span class="label pull-right r-activity  float_end"><?php
                                                                                                                                    if (!empty($allotment->d_time)) {
                                                                                                                                        echo $allotment->d_time;
                                                                                                                                    }
                                                                                                                                    ?></span></li>
                        <li class="list-group-item"> <?php echo lang('patient'); ?> <?php echo lang('name'); ?> <span class="label pull-right r-activity  float_end"><?php echo $patient->name; ?></span></li>
                        <li class="list-group-item"> <?php echo lang('patient_id'); ?> <span class="label pull-right r-activity  float_end"><?php echo $patient->hospital_patient_id; ?></span></li>
                        <li class="list-group-item"> <?php echo lang('gender'); ?><span class="label pull-right r-activity  float_end"><?php echo $patient->sex; ?></span></li>
                        <li class="list-group-item"> <?php echo lang('birth_date'); ?><span class="label pull-right r-activity  float_end"><?php echo $patient->birthdate; ?></span></li>
                        <li class="list-group-item"> <?php echo lang('phone'); ?><span class="label pull-right r-activity  float_end"><?php echo $patient->phone; ?></span></li>
                        <li class="list-group-item"> <?php echo lang('email'); ?><span class="label pull-right r-activity  float_end"><?php echo $patient->email; ?></span></li>
                        <li class="list-group-item address_bar"> <?php echo lang('address'); ?><span class="pull-right address_bar  float_end"><?php echo $patient->address; ?></span></li>
                    </ul>
                </section>
            </aside>
            </section>
            </div>
        </section>
        </div>
    </div>
    <!-- page end-->
</div>
</div>
<!--main content end-->
<!--footer start-->



<?php
$current_user = $this->ion_auth->get_user_id();
if ($this->ion_auth->in_group('Doctor')) {
    $doctor_id = $this->db->get_where('doctor', array('ion_user_id' => $current_user))->row()->id;
}
if (!$this->ion_auth->in_group(array('admin'))) {
    $admin = 'other';
} else {
    $admin = 'admin';
}
?>



<script src="common/js/codearistos.min.js"></script>

<script src="common/extranal/toast.js"></script>
<link rel="stylesheet" type="text/css" href="common/extranal/toast.css">
<script type="text/javascript">
    var select_doctor = "<?php echo lang('select_doctor'); ?>";
</script>
<script type="text/javascript">
    var select_patient = "<?php echo lang('select_patient'); ?>";
</script>
<script type="text/javascript">
    var medicine_gen_name = "<?php echo lang('medicine_gen_name'); ?>";
</script>
<script type="text/javascript">
    var select_nurse = "<?php echo lang('select_nurse'); ?>";
</script>
<script type="text/javascript">
    var delete_lang = "<?php echo lang('delete'); ?>";
</script>
<script type="text/javascript">
    var more = "<?php echo lang('more'); ?>";
</script>
<script type="text/javascript">
    var edit = "<?php echo lang('edit'); ?>";
</script>
<script type="text/javascript">
    var admin = "<?php echo $admin; ?>";
</script>
<script type="text/javascript">
    var patient_name = "<?php echo $patient->name; ?>";
</script>
<script type="text/javascript">
    var patient_id = "<?php echo $patient->id; ?>";
</script>
<script type="text/javascript">
    var doctor_name = "<?php echo $doctor->name; ?>";
</script>
<script type="text/javascript">
    var doctor_id = "<?php echo $doctor->id; ?>";
</script>
<script type="text/javascript">
    var accepting_doctor_name = "<?php echo $accepting_doctor->name; ?>";
</script>
<script type="text/javascript">
    var accepting_doctor_id = "<?php echo $accepting_doctor->id; ?>";
</script>
<script type="text/javascript">
    var language = "<?php echo $this->language; ?>";
</script>
<script type="text/javascript">
    var currency = "<?php echo $this->settings->currency; ?>"; 
</script>
<script src="common/extranal/js/bed/edit_allotment_bed.js"></script>
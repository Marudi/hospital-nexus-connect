<!--sidebar end-->
<style>
    .d-none {
        display: none;
    }

    .d-flex {
        display: flex;
    }

    .align-center {
        align-items: center
    }

    .d-flex label {
        width: 200px;
    }
</style>
<!--main content start-->
<link href="common/extranal/css/description.css" rel="stylesheet">

<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0"><?php
                                                            if (!empty($lab->id))
                                                                echo lang('edit_lab_report');
                                                            else
                                                                echo lang('add_lab_report');
                                                            ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item "><?php echo lang('lab'); ?></li>
                                        <li class="breadcrumb-item active">  <?php
                                                            if (!empty($lab->id))
                                                                echo lang('edit_lab_report');
                                                            else
                                                                echo lang('add_lab_report');
                                                            ?></li>
                                       
                                       
                                       
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
        <!-- page start-->
        <ul>
            <li class="description">If you click "Save and ready to deliver", it will appear on the delivery report section.
                <span class="close">&times;</span>
            </li>
        </ul>
        <link href="common/extranal/css/lab/add_lab_view.css" rel="stylesheet">
        <form role="form" class="labForm" id="editLabForm" class="clearfix" action="lab/addLab" method="post" enctype="multipart/form-data" style="background: none">
            <section class="card col-md-12 no-print">
            <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-12">  <?php
                    if (!empty($lab->id))
                        echo lang('edit_lab_report');
                    else
                        echo lang('add_lab_report');
                    ?></h4> 
                                    
                                    </div>
               
                <div class="card-body no-print">
                    <div class="adv-table editable-table ">
                        <div class="clearfix">


                            <!--                        <form role="form" class="labForm" id="editLabForm" class="clearfix" action="lab/addLab" method="post" enctype="multipart/form-data">-->

                            <div class="">
                                <h2 style="text-align: center"><?php
                                                                if (!empty($lab->id)) {
                                                                    $test_name = $this->db->get_where('payment_category', array('id' => $lab->category_id))->row();
                                                                    if (isset($test_name->category)) {
                                                                        echo $test_name->category;
                                                                    }
                                                                }
                                                                ?></h2>
                            <div class="row">
                                <div class="col-md-6 lab pad_bot">
                                    <div class="form-group d-flex align-center">
                                        <label for="exampleInputEmail1"> <?php echo lang('type'); ?></label>
                                        <select class="form-control m-bot15 js-example-basic-multiple type" id="type" name="type" value=''>
                                            <option value="all">All</option>
                                            <option value="<?php echo $this->ion_auth->get_user_id(); ?>">Only Mine</option>
                                        </select>
                                    </div>
                                    <div class="form-group d-flex align-center">
                                        <label for="exampleInputEmail1"> <?php echo lang('category'); ?></label>
                                        <select class="form-control m-bot15 js-example-basic-multiple category" id="category" name="category" value=''>
                                            <option value="all">All</option>
                                            <?php foreach ($categories as $category) { ?>
                                                <option value="<?php echo $category->id; ?>"><?php echo $category->category; ?> </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group d-flex align-center">
                                        <label for="exampleInputEmail1"> <?php echo lang('template'); ?></label>
                                        <select class="form-control m-bot15 js-example-basic-multiple template" id="template" name="template" value=''>
                                            <option value="">Select .....</option>
                                            <?php foreach ($templates as $template) { ?>
                                                <option value="<?php echo $template->id; ?>"><?php echo $template->name . " (" . $this->db->get_where('users', array("id" => $template->user))->row()->username . ")"; ?> </option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                </div>

                                <div class="col-md-6 lab pad_bot">
                                    <div class="form-group d-flex align-center">
                                        <label for="exampleInputEmail1"><?php echo lang('date'); ?> &ast; </label>
                                        <input type="text" class="form-control pay_in default-date-picker readonly" name="date" value='<?php
                                                                                                                                        if (!empty($lab->date)) {
                                                                                                                                            echo date('d-m-Y', $lab->date);
                                                                                                                                        } else {
                                                                                                                                            echo date('d-m-Y');
                                                                                                                                        }
                                                                                                                                        ?>' placeholder="" required="" style="pointer-events: none;">
                                    </div>

                                    <div class="form-group d-flex align-center">
                                        <label for="exampleInputEmail1"><?php echo lang('patient'); ?> &ast; </label>
                                        <select class="form-control <?php if (empty($lab->patient)) { ?> pos_select <?php } ?>" id="<?php if (empty($lab->patient)) { ?> pos_select <?php } ?>" name="patient" value='' required="" style="pointer-events: none;">
                                            <?php
                                            if (!empty($lab->patient)) {
                                                if (empty($patients->age)) {
                                                    $dateOfBirth = $patients->birthdate;
                                                    if (empty($dateOfBirth)) {
                                                        $age[0] = '0';
                                                    } else {
                                                        $today = date("Y-m-d");
                                                        $diff = date_diff(date_create($dateOfBirth), date_create($today));
                                                        $age[0] = $diff->format('%y');
                                                    }
                                                } else {
                                                    $age = explode('-', $patients->age);
                                                }
                                            ?>
                                                <option value="<?php echo $patients->id; ?>" selected="selected"><?php echo $patients->name; ?> ( <?php echo lang('id'); ?>: <?php echo $patients->id; ?> - <?php echo lang('phone'); ?>: <?php echo $patients->phone; ?> - <?php echo lang('age'); ?>: <?php echo $age[0]; ?> ) </option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="form-group d-flex align-center">
                                        <label for="exampleInputEmail1"> <?php echo lang('macro'); ?></label>
                                        <select class="form-control m-bot15 js-example-basic-multiple macro" id="macro" name="macro" value=''>
                                            <option value="">Select .....</option>
                                            <?php foreach ($macros as $macro) { ?>
                                                <option value="<?php echo $macro->id; ?>"><?php echo $macro->short_name; ?> </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                                <!--                                <div class="col-md-6 lab pad_bot">
                                    
                                </div> 

                                <div class="col-md-8 panel"> 
                                </div>-->

                                <div class="pos_client">
                                    <div class="col-md-8 lab pad_bot">
                                        <div class="col-md-3 lab_label">
                                            <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('name'); ?> &ast; </label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control pay_in" name="p_name" value='<?php
                                                                                                                if (!empty($lab->p_name)) {
                                                                                                                    echo $lab->p_name;
                                                                                                                }
                                                                                                                ?>' placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-8 lab pad_bot">
                                        <div class="col-md-3 lab_label">
                                            <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('email'); ?> &ast; </label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="email" class="form-control pay_in" name="p_email" value='<?php
                                                                                                                    if (!empty($lab->p_email)) {
                                                                                                                        echo $lab->p_email;
                                                                                                                    }
                                                                                                                    ?>' placeholder="">
                                        </div>
                                    </div>

                                    <div class="col-md-8 lab pad_bot">
                                        <div class="col-md-3 lab_label">
                                            <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('phone'); ?> &ast; </label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="number" class="form-control pay_in" name="p_phone" value='<?php
                                                                                                                    if (!empty($lab->p_phone)) {
                                                                                                                        echo $lab->p_phone;
                                                                                                                    }
                                                                                                                    ?>' placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-8 lab pad_bot">
                                        <div class="col-md-3 lab_label">
                                            <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('birth_date'); ?> &ast; </label>
                                        </div>
                                        <div class="col-md-9">
                                            <input class="form-control form-control-inline input-medium default-date-picker" type="text" name="birthdate" value="" placeholder="" onkeypress="return false;">
                                        </div>
                                    </div>
                                    <div class="col-md-8 lab pad_bot">
                                        <div class="col-md-3 lab_label">
                                            <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('age'); ?></label>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="input-group m-bot15">

                                                <input type="number" min="0" max="150" class="form-control" name="years" value='' placeholder="<?php echo lang('years'); ?>">
                                                <span class="input-group-addon"><?php echo lang('y'); ?></span>
                                                <input type="number" class="form-control input-group-addon" min="0" max="12" name="months" value='' placeholder="<?php echo lang('months'); ?>">
                                                <span class="input-group-addon"><?php echo lang('m'); ?></span>
                                                <input type="number" class="form-control input-group-addon" name="days" min="0" max="29" value='' placeholder="<?php echo lang('days'); ?>">
                                                <span class="input-group-addon"><?php echo lang('d'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8 lab pad_bot">
                                        <div class="col-md-3 lab_label">
                                            <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('gender'); ?></label>
                                        </div>
                                        <div class="col-md-9">
                                            <select class="form-control m-bot15" name="p_gender" value=''>

                                                <option value="Male" <?php
                                                                        if (!empty($patient->sex)) {
                                                                            if ($patient->sex == 'Male') {
                                                                                echo 'selected';
                                                                            }
                                                                        }
                                                                        ?>> Male </option>
                                                <option value="Female" <?php
                                                                        if (!empty($patient->sex)) {
                                                                            if ($patient->sex == 'Female') {
                                                                                echo 'selected';
                                                                            }
                                                                        }
                                                                        ?>> Female </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 lab pad_bot" style="display: none">
                                    <label for="exampleInputEmail1"> <?php echo lang('refd_by_doctor'); ?></label>
                                    <select class="form-control m-bot15 add_doctor" id="add_doctor" name="doctor" value=''>
                                        <?php if (!empty($lab->doctor)) { ?>
                                            <option value="<?php echo $doctors->id; ?>" selected="selected"><?php echo $doctors->name; ?> - <?php echo $doctors->id; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>



                                <!--                                <div class="col-md-6 lab pad_bot">
                                    
                                </div>-->
                                <input type="hidden" id="submission_type" name="submission_type">
                                <!--                                <div class="col-md-12 form-group text-right">
                                    <button type="submit" name="draft2" onclick="document.querySelector('#submission_type').value = 'draft';" class="btn btn-warning" ><?php echo lang('save_as_draft'); ?></button>
                                    <button type="submit" name="final2" onclick="document.querySelector('#submission_type').value = 'submit';" class="btn btn-info"><?php echo lang('final'); ?></button>
                                    <input type="hidden" id="submission_type" name="submission_type">
                                </div>-->

                                <!--                                <div class="col-md-6 lab pad_bot">
                                                                    <label for="exampleInputEmail1"> <?php echo lang('template'); ?></label>
                                                                    <select class="form-control m-bot15 js-example-basic-multiple template" id="template" name="template" value=''> 
                                                                        <option value="">Select .....</option>
                                <?php foreach ($templates as $template) { ?>
                                                                                <option value="<?php echo $template->id; ?>"><?php echo $template->name; ?> </option>
<?php } ?>
                                                                    </select>
                                                                </div>
                                
                                                                <div class="col-md-6 lab pad_bot">
                                                                    <label for="exampleInputEmail1"> <?php echo lang('status'); ?></label>
                                                                    <select name="status" class="form-control js-example-basic-single" id="status">
                                                                        
                                                                        <option value="pending" <?php
                                                                                                if (!empty($lab_single->id)) {
                                                                                                    if ($lab_single->status == 'pending') {
                                                                                                        echo 'selected';
                                                                                                    }
                                                                                                }
                                                                                                ?>><?php echo lang('pending'); ?></option>
                                                                        
                                                                        <option value="drafted" <?php
                                                                                                if (!empty($lab_single->id)) {
                                                                                                    if ($lab_single->status == 'drafted') {
                                                                                                        echo 'selected';
                                                                                                    }
                                                                                                }
                                                                                                ?>><?php echo lang('drafted'); ?></option>
                                                                        
                                                                        <option value="completed" <?php
                                                                                                    if (!empty($lab_single->id)) {
                                                                                                        if ($lab_single->status == 'completed') {
                                                                                                            echo 'selected';
                                                                                                        }
                                                                                                    }
                                                                                                    ?>><?php echo lang('completed'); ?></option>
                                                                        
                                                                    </select>
                                                                </div>-->



                                <div class="pos_doctor">
                                    <div class="col-md-8 lab pad_bot">
                                        <div class="col-md-3 lab_label">
                                            <label for="exampleInputEmail1"> <?php echo lang('doctor'); ?> <?php echo lang('name'); ?></label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control pay_in" name="d_name" value='<?php
                                                                                                                if (!empty($lab->p_name)) {
                                                                                                                    echo $lab->p_name;
                                                                                                                }
                                                                                                                ?>' placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-8 lab pad_bot">
                                        <div class="col-md-3 lab_label">
                                            <label for="exampleInputEmail1"> <?php echo lang('doctor'); ?> <?php echo lang('email'); ?></label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="email" class="form-control pay_in" name="d_email" value='<?php
                                                                                                                    if (!empty($lab->p_email)) {
                                                                                                                        echo $lab->p_email;
                                                                                                                    }
                                                                                                                    ?>' placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-8 lab pad_bot">
                                        <div class="col-md-3 lab_label">
                                            <label for="exampleInputEmail1"> <?php echo lang('doctor'); ?> <?php echo lang('phone'); ?></label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="number" class="form-control pay_in" name="d_phone" value='<?php
                                                                                                                    if (!empty($lab->p_phone)) {
                                                                                                                        echo $lab->p_phone;
                                                                                                                    }
                                                                                                                    ?>' placeholder="">
                                        </div>
                                    </div>
                                </div>

                             



                            </div>








                            <?php
                            if (!empty($lab->id)) {
                                $report_template = $this->db->get_where('payment_category', array('id' => $lab->category_id))->row();
                                if (isset($report_template) && $report_template->report != null) {
                                    $report_template = $report_template->report;
                                } else {
                                    $report_template = "";
                                }
                            }
                            ?>
                            <div class="col-md-12 lab pad_bot" style="margin-bottom: 20px;">
                                <div class="d-flex align-center" style="justify-content: space-between">
                                    <label for="exampleInputEmail1"> <?php echo lang('report'); ?></label>
                                    <div>
                                        <button type="submit" name="final2" onclick="document.querySelector('#submission_type').value = 'submit';" class="btn btn-info"><?php echo lang('save_and_ready_to_deliver'); ?></button>
                                        <button type="submit" name="draft2" onclick="document.querySelector('#submission_type').value = 'draft';" class="btn btn-warning"><?php echo lang('save_as_draft'); ?></button>
                                    </div>
                                </div>
                                <textarea class="ckeditor form-control" id="editor" name="report" value="" rows="10"><?php
                                                                                                                        if (!empty($setval)) {
                                                                                                                            echo set_value('report');
                                                                                                                        }
                                                                                                                        if (!empty($lab->report)) {
                                                                                                                            echo $lab->report;
                                                                                                                        } else {
                                                                                                                            echo $report_template;
                                                                                                                        }
                                                                                                                        ?>
                                </textarea>
                            </div>

                          

                            <div class="col-md-12 form-group text-right">
                                <button type="submit" name="submit" id="submit" onclick="document.querySelector('#submission_type').value = 'submit';" class="btn btn-info"><?php echo lang('save_and_ready_to_deliver'); ?></button>
                                <button type="submit" name="draft" id="draft" onclick="document.querySelector('#submission_type').value = 'draft';" class="btn btn-warning"><?php echo lang('save_as_draft'); ?></button>
                                <button type="" id="template2" class="btn btn-danger"><?php echo lang('save_as_template'); ?></button>


                            </div>

                            <div class="modal fade" id="templateModal">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Template Details</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" name="template_name" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label>Category</label>
                                                <select class="form-control" name="template_category">
                                                    <?php foreach ($categories as $category) { ?>
                                                        <option value="<?php echo $category->id; ?>"><?php echo $category->category; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" name="template" id="template3" onclick=" document.querySelector('#submission_type').value = 'template';" class="btn btn-danger"><?php echo lang('save_as_template'); ?></button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="redirect" value="lab">

                            <input type="hidden" name="id" value='<?php
                                                                    if (!empty($lab->id)) {
                                                                        echo $lab->id;
                                                                    }
                                                                    ?>'>
                            <input type="hidden" name="draft" id="draft2" value="">

                          
                        </div>
                    </div>
                </div>



            </section>

           
        </form>

        
    </section>

    </div>
</div>
</div>
<!--main content end-->
<!--footer start-->

<script src="common/js/codearistos.min.js"></script>
<script src="common/extranal/js/description.js"></script>

<script type="text/javascript">
    var select_doctor = "<?php echo lang('select_doctor'); ?>";
</script>
<script type="text/javascript">
    var select_patient = "<?php echo lang('select_patient'); ?>";
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.26.1/axios.min.js"></script>
<script src="common/extranal/js/lab/add_lab_view.js"></script>
<script>
    $('.draftSubmit').on("click", function(e) {
        e.preventDefault();
        $('.pay_in').prop('required', false)
        $('.pos_select').prop('required', false)
        $('#draft').val('1');
        return true;
        let form = document.getElementById("editLabForm");
        document.querySelected("#editLabForm").submit();
    })

    $(document).ready(function() {
        $('#template2').on('click', function(e) {
            e.preventDefault();
            $('#templateModal').modal();
        })
        "use strict";
        $(document.body).on('change', '#macro', function() {
            "use strict";
            var iid = $("select.macro option:selected").val();
            $.ajax({
                url: 'macro/getMacroByIdByJason?id=' + iid,
                method: 'GET',
                data: '',
                dataType: 'json',
                success: function(response) {
                    "use strict";
                    var data = myEditor.getData();
                    if (response.macro.description != null) {
                        //var data1 = data + response.macro.description;
                        //myEditor.insertText("Hi");
                        myEditor.model.change(writer => {
                            const insertPosition = myEditor.model.document.selection.getFirstPosition();
                            writer.insertText(response.macro.description, insertPosition);
                        });
                        data = myEditor.getData();
                        myEditor.setData(data);
                        //ClassicEditor.instances('#editor').insertText("Hi");
                    } else {
                        //var data1 = data;
                    }
                    //myEditor.setData(data1)

                }
            })
        });

        $("#editor").keypress(function() {
            console.log("Hello");
        });

        $('#category').on("change", function() {
            let id = $('#category').val();
            let user_id = $('#type').val();
            axios.get('lab/getTemplateByCategory?category_id=' + id + "&user_id=" + user_id)
                .then(response => {
                    $('#template').empty();
                    $("#template").append(response.data);
                    $('#template').trigger('change');
                })
        })

        $('#type').on("change", function() {
            let id = $('#type').val();
            let category_id = $('#category').val();
            axios.get('lab/getTemplateByUser?user_id=' + id + "&category_id=" + category_id)
                .then(response => {
                    $('#template').empty();
                    $("#template").append(response.data);
                    $('#template').trigger('change');
                })
        })
    });
</script>
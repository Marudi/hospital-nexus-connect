<?php (defined('BASEPATH')) OR exit('No direct script access allowed'); ?>
<link href="common/extranal/css/settings/language.css" rel="stylesheet">
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0"><?php echo lang('language'); ?> <?php echo lang('settings'); ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item"><?php echo lang('settings'); ?></li>
                                        <li class="breadcrumb-item active"><?php echo lang('language'); ?></li>
                                       
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
       
<div class="row">
        <section class="col-md-6">
        <div class="card">
           <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-12"> <?php echo lang('select'); ?> <?php echo lang('language'); ?></h4> 
                                        
                                    </div>
            
<div class="card-body">
                    <form role="form" class="clearfix pos form1"  id="editSaleForm" action="settings/changeLanguage" method="post" enctype="multipart/form-data">
                        <div class="form-group col-md-8"> 
                            <select class="form-control js-example-basic-single" name="language" value=''>
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

                        <input type="hidden" name="language_settings" value='language_settings'>

                        <input type="hidden" name="id" value='<?php
                        if (!empty($settings->id)) {
                            echo $settings->id;
                        }
                        ?>'>


                        <div class="col-md-12 pull-right">
                            <button type="submit" name="submit2" id="submit1" class="btn btn-info submit_button"> <?php echo lang('submit'); ?></button>
                        </div>
               
                    </form>
</div>
            </div>
        </section>
<?php     if ($this->ion_auth->in_group(array('superadmin'))) { ?>
        <section class="col-md-6 row">
        <div class="card">
           <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-12">  <?php echo lang('edit'); ?> <?php echo lang('language'); ?></h4> 
                                        
                                    </div>
           
                    <div class="card-body table_div">
                    <div class="table-responsive adv-table">
                                            <table class="table mb-0" id="editable-sample">


                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th><?php echo lang('name'); ?></th>
                                        <th><?php echo lang('options'); ?></th>
                                    </tr>
                                </thead>
                                <tbody> 

                                    <tr class="">
                                        <td><?php echo '1'; ?></td>
                                        <td><?php echo lang('arabic'); ?> </td>

                                        <td>
                                            <a class="btn btn-soft-primary waves-effect waves-light btn-xs" href="settings/languageEdit?id=arabic">   <?php echo lang('manage'); ?></a>
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <td><?php echo '2'; ?></td>
                                        <td><?php echo lang('english'); ?> </td>

                                        <td>
                                            <a class="btn btn-soft-primary waves-effect waves-light btn-xs" href="settings/languageEdit?id=english">   <?php echo lang('manage'); ?></a>
                                        </td>
                                    </tr>
                                    
                                    <tr class="">
                                        <td><?php echo '3'; ?></td>
                                        <td><?php echo lang('spanish'); ?> </td>

                                        <td>
                                            <a class="btn btn-soft-primary waves-effect waves-light btn-xs" href="settings/languageEdit?id=spanish">   <?php echo lang('manage'); ?></a>
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <td><?php echo '4'; ?></td>
                                        <td><?php echo lang('french'); ?> </td>

                                        <td>
                                            <a class="btn btn-soft-primary waves-effect waves-light btn-xs" href="settings/languageEdit?id=french">   <?php echo lang('manage'); ?></a>
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <td><?php echo '5'; ?></td>
                                        <td><?php echo lang('italian'); ?> </td>

                                        <td>
                                            <a class="btn btn-soft-primary waves-effect waves-light btn-xs" href="settings/languageEdit?id=italian">   <?php echo lang('manage'); ?></a>
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <td><?php echo '6'; ?></td>
                                        <td><?php echo lang('portuguese'); ?> </td>

                                        <td>
                                            <a class="btn btn-soft-primary waves-effect waves-light btn-xs" href="settings/languageEdit?id=portuguese">   <?php echo lang('manage'); ?></a>
                                        </td>
                                    </tr>
                                   
                                   
                                </tbody>
                        </div>

                        </table>

                    </div>
                </div>
           
        </section>
<?php } ?>
</div>
    </div>
</div>
</div>


<script src="common/js/codearistos.min.js"></script>
<script src="common/extranal/js/settings/language.js"></script>


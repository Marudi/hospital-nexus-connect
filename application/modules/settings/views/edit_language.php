<!--sidebar end-->
<!--main content start-->
<link href="common/extranal/css/settings/edit_language.css" rel="stylesheet">
<div class="main-content">
<div class="page-content">
    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0"> <?php echo lang('language'); ?> <?php echo lang('translation'); ?></h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                                        <li class="breadcrumb-item"><?php echo lang('settings'); ?></li>
                                        <li class="breadcrumb-item"><?php echo lang('language'); ?></li>
                                        <li class="breadcrumb-item active"><?php echo lang('translation'); ?></li>
                                       
                                        
                                    </ol>
                                </div>

                                </div>
                            </div>
                        </div>
    
        <div class="col-md-12 row">
            <section class="col-md-10 row">
            <div class="card">
           <div class="card-header table_header">
                                        <h4 class="card-title mb-0 col-lg-12"> <?php
                    if ($languagename == 'arabic') {
                        $language = lang('arabic');
                    }
                    if ($languagename == 'english') {
                        $language = lang('english');
                    }
                    if ($languagename == 'italian') {
                        $language = lang('italian');
                    }
                    if ($languagename == 'french') {
                        $language = lang('french');
                    }
                  
                    if ($languagename == 'spanish') {
                        $language = lang('spanish');
                    }
                    if ($languagename == 'portuguese') {
                        $language = lang('portuguese');
                    }
                   
                    ?>
                    <?php echo lang('language'); ?> <?php echo lang('translation'); ?> :  <?php echo $language; ?></h4> 
                                        
                                    </div>
              
                <div class="card-body">
                <div class="table-responsive adv-table">
                        
<?php echo validation_errors(); ?>
                            <form role="form" action="settings/addLanguageTranslation" class="clearfix" method="post" enctype="multipart/form-data" id="myForm">
                                <input type="hidden" name="language" value="<?php echo $languagename; ?>">
                                <input type="hidden" name="valueupdate" value="">
                                <input type="hidden" name="indexupdate" value="">
                                <table class="table mb-0" id="editable-sample">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th><?php echo lang('name'); ?></th>
                                            <th><?php echo lang('translation'); ?></th>
                                        </tr>
                                    </thead><tbody>
<?php
$i = 0;
foreach ($languages as $key => $value) {
    $i = $i + 1;
    ?>
                                            <tr class="table-bordered">
                                                <td><?php echo $i; ?></td>
                                                <td class="table-bordered">  
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="index[]" id="index" value='<?php
                                        echo $key;
                                        ?>' placeholder="" readonly> </div>
                                                </td>
                                                <td class="table-bordered">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="value[]" id="value" value="<?php
                                        echo $value;
                                        ?>" placeholder="">  
                                                    </div> 
                                                </td>
                                            </tr>
<?php } ?>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td style="float:right;"> <button id="submit" type="submit" name="submit" class="btn btn-info pull-right"><?php echo lang('submit'); ?></button></td>
                                        </tr>
                                    </tbody>
                                    <tfoot>




                                    </tfoot>
                                   
                                </table>
                            </form>
                        </div>
                    </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- page end-->
    </div>
</div>
</div>
<!--main content end-->
<!--footer start-->

<script src="common/js/codearistos.min.js"></script>
<script src="common/extranal/js/settings/edit_language.js"></script>
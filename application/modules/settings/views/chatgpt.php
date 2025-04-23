<!--sidebar end-->
<!--main content start-->
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0"><?php echo lang('ChatGPT API Key'); ?></h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a
                                        href="javascript: void(0);"><?php echo lang('home'); ?></a></li>

                                <li class="breadcrumb-item active"><?php echo lang('ChatGPT API Key'); ?></li>


                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- page start-->

            <div class="col-md-8 row">
                <div class="card">
                    <div class="card-header table_header">
                        <h4 class="card-title mb-0 col-lg-12"><?php echo lang('ChatGPT API Key'); ?></h4>

                    </div>

                    <style type="text/css">
                    .img_thumb,
                    .img_class {
                        height: 150px;
                        width: 150px;
                    }
                    </style>
                    <div class="card-body">
                        <div class="table-responsive adv-table">
                            <div class="clearfix">
                                <?php echo validation_errors(); ?>
                                <form role="form" action="settings/chatgptSettings" class="clearfix" method="post"
                                    enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"> ChatGPT API Key </label>

                                        <input type="text" class="form-control form-control-lg" name="api_key"
                                            id="exampleInputEmail1"
                                            value='<?php
                                                                                                                                            if (!empty($settings->chatgpt_api_key)) {
                                                                                                                                                echo $settings->chatgpt_api_key;
                                                                                                                                            }
                                                                                                                                            ?>'
                                            placeholder="">

                                    </div>


                                    <input type="hidden" name="id" value='<?php
                                                                        if (!empty($settings->id)) {
                                                                            echo $settings->id;
                                                                        }
                                                                        ?>'>


                                    <div class="form-group mb-5">
                                        <button type="submit" name="submit"
                                            class="btn btn-info float-right"><?php echo lang('submit'); ?></button>
                                    </div>
                                    <code class="mt-5">
                                    <?php echo lang('login_to_openai_com_and_then_go_to_this_page'); ?>
                                    <a target="_blank" href="https://platform.openai.com/api-keys">https://platform.openai.com/api-keys</a>
                                </code>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page end-->
        </div>
    </div>
</div>
<!--main content end-->
<!--footer start-->



<script src="common/js/codearistos.min.js"></script>
<script src="common/extranal/js/email/settings.js"></script>
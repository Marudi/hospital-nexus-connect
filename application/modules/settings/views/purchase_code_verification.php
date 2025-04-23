<?php (defined('BASEPATH')) or exit('No direct script access allowed'); ?>

<section id="main-content">
    <section class="wrapper site-min-height">
        <link href="common/extranal/css/settings/language.css" rel="stylesheet">

        <section class="content col-md-6">
            <div class="">
                <div class="block1">
                    <header class="panel-heading">
                    <h3 class="verifyTitle"> <?php echo lang('purchase_code_verification') ?> </h3>
                    </header>
                    <div class="block1">
                        <form class="form-signin" method="post" action="settings/addPurchaseCode">
                            <?php $message = $this->session->flashdata('message');
                            if (!empty($message)) { ?>
                                <div id="infoMessage"><?php echo $message; ?></div>
                            <?php } ?>
                            <div class="login-wrap">
                                
                                <input type="text" class="form-control" name="purchase_code" placeholder="Enter you purchase code" autofocus>
                                <button class="btn btn-lg btn-login btn-block" type="submit">Verify</button>
                                <?php if (!empty($verified) && $verified == 'yes') { ?>
                                    <button class="btn btn-lg btn-login btn-block" type="submit"><a href="home">Home</a></button>
                                <?php } ?>
                            </div>
                        </form>
                    </div>
        </section>
    </section>
</section>

<script src="common/js/jquery.js"></script>
<script src="common/js/bootstrap.min.js"></script>
</body>


<style>
    .form-signin {
        max-width: 500px;
    }

    .verifyTitle {
        text-align: center;
        margin: 50px;
        font-weight: bold;
    }
    .block1{
        background: #fff;
    }
</style>
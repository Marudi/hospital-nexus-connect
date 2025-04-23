<!DOCTYPE html>
<html lang="en">

<head>
    <base href="<?php echo base_url(); ?>">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Rizvi">
    <meta name="keyword" content="Php, Hospital, Clinic, Management, Software, Php, CodeIgniter, Hms, Accounting">
    <link rel="shortcut icon" href="uploads/favicon.png">

    <title>Purchase Code Verification - <?php echo $this->db->get('settings')->row()->system_vendor; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="common/css/bootstrap.min.css" rel="stylesheet">
    <link href="common/css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="common/assets/fontawesome5pro/css/all.min.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="common/css/style.css" rel="stylesheet">
    <link href="common/css/style-responsive.css" rel="stylesheet" />
    <link href="common/extranal/css/auth.css" rel="stylesheet">

</head>

<body class="login-body">
    <div class="">
        <form class="form-signin" method="post" action="frontend/verify">
            <?php $message = $this->session->flashdata('message');
            if (!empty($message)) { ?>
                <div id="infoMessage"><?php echo $message; ?></div>
            <?php } ?>
            <div class="login-wrap">
                <h3 class="verifyTitle"> <?php echo lang('purchase_code_verification') ?> </h3>
                <input type="text" class="form-control" name="purchase_code" placeholder="Enter you purchase code" autofocus>
                <button class="btn btn-lg btn-login btn-block" type="submit">Verify</button>
                <?php if (!empty($verified) && $verified == 'yes') { ?>
                    <button class="btn btn-lg btn-login btn-block" type="submit"><a href="home">Home</a></button>
                <?php } ?>
            </div>
        </form>
    </div>
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
</style>






</html>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ShoeMade4u Admin</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!--    <link rel="shortcut icon" type="image/png" href="-->
    <?php //echo base_url(); ?><!--assets/admin/img/favicon.png"/>-->
    <?php
    $this->load->view('template/admin/stylesheet');
    ?>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/js/plugins/iCheck/square/blue.css">

    <?php
    //$ip = $_SERVER['REMOTE_ADDR'];
    //$query = @unserialize(file_get_contents('http://ip-api.com/php/' . $ip));
    ?>

</head>
<body class="hold-transition login-page">
<input type="hidden" id="baseUrl" name="baseUrl" value="<?php echo base_url(); ?>">
<input type="hidden" id="adminBaseUrl" name="adminBaseUrl" value="<?php echo $this->config->item('admin_base_url'); ?>">

<div id="loading"></div>

<div class="login-box">
    <div class="login-logo" style="padding-bottom: 70px;">

    </div>


    <div class="login-box-body">
        <p class="login-box-msg" id="form-text">Reset your password!</p>

        <div id="errorDisplay"> </div>

        <form role="form" id="reset-pass-form">
        <input type="hidden" id="token" name="token" value="<?php echo $token?>">
            <div class="form-group has-feedback">
                <input type="password" id="newPassword" name="newPassword" placeholder="Password"
                       class="form-control" required autofocus>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password"
                       class="form-control">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    <a href="<?php echo base_url('admin')?>" class="btn btn-info btn-block btn-flat">Login</a>
                </div>
                <div class="col-xs-6">
                    <a id="reset" class="btn btn-primary btn-block btn-flat">Reset</a>
                </div>
            </div>
        </form>


    </div>
</div>



<?php
$this->load->view('template/admin/javascript');
$this->load->view('admin/login/js/login-js');
?>


</body>
</html>
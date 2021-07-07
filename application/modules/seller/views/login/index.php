<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>globusnexgen Admin</title>
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
<input type="hidden" id="adminBaseUrl" name="adminBaseUrl" value="<?php echo $this->config->item('seller_base_url'); ?>">

<div id="loading"></div>

<div class="login-box">
    <div class="login-logo" style="padding-bottom: 70px;">

    </div>

    <div class="login-box-body" id="login-box">
        <p class="login-box-msg" id="form-text">Sign in to start your session!</p>

        <div id="errorDisplay"></div>

        <form role="form" id="login-form">
            <div class="form-group has-feedback">
                <input type="text" id="email" name="email" placeholder="E-mail"
                       class="form-control" required autofocus="autofocus">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" id="password" name="password" placeholder="Password"
                       class="form-control">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input id="remember_me" type="checkbox" name="remember_me" value="1"/> Remember Me
                        </label>
                    </div>
                </div>
                <div class="col-xs-4">
                    <a id="login" class="btn btn-primary btn-block btn-flat">Sign In</a>
                </div>
            </div>
            <a id="forget-pass" class="pull-right" style="cursor: pointer;">Forgot Password</a><br>
        </form>


        <form role="form" id="forget-form" style="display: none;">
            <div class="form-group has-feedback">
                <input type="email" id="emailForget" name="emailForget" placeholder="E-mail"
                       class="form-control" required>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>


            <div class="row">
                <div class="col-xs-6">
                    <a id="cancel" class="btn btn-danger btn-block btn-flat">Cancel</a>
                </div>
                <!-- /.col -->
                <div class="col-xs-6">
                    <a id="resetPassword" class="btn btn-primary btn-block btn-flat">Reset Password</a>
                </div>
                <!-- /.col -->


            </div>
        </form>


    </div>


</div>



<?php
$this->load->view('template/admin/javascript');
$this->load->view('seller/login/js/login-js');
?>


</body>
</html>

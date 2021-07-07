<script src="<?php echo base_url(); ?>assets/admin/js/plugins/iCheck/icheck.min.js"></script>
<script>


    $(document).ready(function () {
        var baseUrl = $('#baseUrl').val();
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });


        $('input').on('click', function (e) {
            $('#errorDisplay').html('');
        });
        $('input').on('keypress', function (e) {
            $('#errorDisplay').html('');
        });

        /*---- Login Starts----*/
        $('#login').on('click', function () {
            var email = $("#email").val();
            var password = $("#password").val();
            if (email == '') {
                $("#errorDisplay").html("<div class='alert alert-danger alert-dismissible' style='text-align: center;'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Please Enter Email Address.</div>")
                $("#email").focus();
                return false;
            } else if (!IsEmail(email)) {
                $("#errorDisplay").html("<div class='alert alert-danger alert-dismissible' style='text-align: center;'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Please Enter Correct Email Format.</div>")
                $("#email").focus();
                return false;
            } else if (password == '') {
                $("#errorDisplay").html("<div class='alert alert-danger alert-dismissible' style='text-align: center;'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Please Enter Password.</div>")
                $("#password").focus();
                return false;
            } else {
                $('#loading').css("display", "block");
                $.ajax({
                    type: "POST",
                    data: {
                        'email': email,
                        'password': password
                    },
                    url: baseUrl + "<?php echo CommonConstants::SELLER_URL_SLUG;?>/login",
                    success: function (result) {
                        $('#loading').css("display", "none");


                        if (result == -1) {
                            $("#errorDisplay").html("<div class='alert alert-danger alert-dismissible' style='text-align: center;'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Username or Password is Incorrect.</div>");

                        } else if (result == -2) {
                            $("#errorDisplay").html("<div class='alert alert-danger alert-dismissible' style='text-align: center;'>Your account has been disabled. Please contact admin.</div>");

                        } else if (result > 0) {

                            if (result == 3) {
                                window.location.href = baseUrl + "<?php echo CommonConstants::SELLER_URL_SLUG;?>/dashboard";
                            } else {
                                $("#errorDisplay").html("<div class='alert alert-danger alert-dismissible' style='text-align: center;'>Unauthorised Access.</div>");
                            }
                        } else {

                            $("#errorDisplay").html("<div class='alert alert-danger alert-dismissible' style='text-align: center;'>Unauthorised Access.</div>");
                        }
                    }
                });
            }

        });






















        $('#email').on('keypress', function (e) {
            var code = (e.keyCode ? e.keyCode : e.which);
            if (code == 13) {
                var email = $("#email").val();
                var password = $("#password").val();
                if (email == '') {
                    $("#errorDisplay").html("<div class='alert alert-danger alert-dismissible' style='text-align: center;'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Please Enter Email Address.</div>")
                    $("#email").focus();
                    return false;
                } else if (!IsEmail(email)) {
                    $("#errorDisplay").html("<div class='alert alert-danger alert-dismissible' style='text-align: center;'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Please Enter Correct Email Format.</div>")
                    $("#email").focus();
                    return false;
                } else if (password == '') {
                    $("#errorDisplay").html("<div class='alert alert-danger alert-dismissible' style='text-align: center;'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Please Enter Password.</div>")
                    $("#password").focus();
                    return false;
                } else {
                    $('#loading').css("display", "block");
                    $.ajax({
                        type: "POST",
                        data: {
                            'email': email,
                            'password': password
                        },
                        url: baseUrl + "<?php echo CommonConstants::SELLER_URL_SLUG;?>/login",
                        success: function (result) {
                            $('#loading').css("display", "none");
                            if (result == -1) {
                                $("#errorDisplay").html("<div class='alert alert-danger alert-dismissible' style='text-align: center;'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Username or Password is Incorrect.</div>");

                            } else if (result == -2) {
                                $("#errorDisplay").html("<div class='alert alert-danger alert-dismissible' style='text-align: center;'>Your account has been disabled. Please contact admin.</div>");

                            } else if (result > 0) {

                                if (result == 1) {
                                    window.location.href = baseUrl + "<?php echo CommonConstants::SELLER_URL_SLUG;?>/product";
                                } else {
                                    $("#errorDisplay").html("<div class='alert alert-danger alert-dismissible' style='text-align: center;'>Unauthorised Access.</div>");
                                }
                            } else {

                                $("#errorDisplay").html("<div class='alert alert-danger alert-dismissible' style='text-align: center;'>Unauthorised Access.</div>");
                            }
                        }
                    });
                }
            }
        });
        $('#password').on('keypress', function (e) {
            var code = (e.keyCode ? e.keyCode : e.which);
            if (code == 13) {
                var email = $("#email").val();
                var password = $("#password").val();
                if (email == '') {
                    $("#errorDisplay").html("<div class='alert alert-danger alert-dismissible' style='text-align: center;'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Please Enter Email Address.</div>")
                    $("#email").focus();
                    return false;
                } else if (!IsEmail(email)) {
                    $("#errorDisplay").html("<div class='alert alert-danger alert-dismissible' style='text-align: center;'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Please Enter Correct Email Format.</div>")
                    $("#email").focus();
                    return false;
                } else if (password == '') {
                    $("#errorDisplay").html("<div class='alert alert-danger alert-dismissible' style='text-align: center;'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Please Enter Password.</div>")
                    $("#password").focus();
                    return false;
                } else {
                    $('#loading').css("display", "block");
                    $.ajax({
                        type: "POST",
                        data: {
                            'email': email,
                            'password': password
                        },
                        url: baseUrl + "<?php echo CommonConstants::SELLER_URL_SLUG;?>/login",
                        success: function (result) {
                            $('#loading').css("display", "none");
                            if (result == -1) {
                                $("#errorDisplay").html("<div class='alert alert-danger alert-dismissible' style='text-align: center;'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Username or Password is Incorrect.</div>");

                            } else if (result == -2) {
                                $("#errorDisplay").html("<div class='alert alert-danger alert-dismissible' style='text-align: center;'>Your account has been disabled. Please contact admin.</div>");

                            } else if (result > 0) {

                                if (result == 1) {
                                    window.location.href = baseUrl + "<?php echo CommonConstants::SELLER_URL_SLUG;?>/product";
                                } else {
                                    $("#errorDisplay").html("<div class='alert alert-danger alert-dismissible' style='text-align: center;'>Unauthorised Access.</div>");
                                }
                            } else {

                                $("#errorDisplay").html("<div class='alert alert-danger alert-dismissible' style='text-align: center;'>Unauthorised Access.</div>");
                            }
                        }
                    });
                }
            }
        });
        /*---- Login Ends----*/


        /*---- reset Password Starts----*/
        $("#forget-pass").click(function () {
            $('#form-text').text('Enter your email to get new password!');
            $('#login-form').hide();
            $('#forget-form').show();
            $('#errorDisplay').html('');
            $("#email").val('');
            $("#password").val('');
            $("#emailForget").val('');
            $("#emailForget").focus();
        });
        $("#cancel").click(function () {
            $('#form-text').text('Sign in to start your session!');
            $('#login-form').show();
            $('#forget-form').hide();
            $('#errorDisplay').html('');
            $("#email").val('');
            $("#password").val('');
            $("#emailForget").val('');
            $("#email").focus();
        });


        $('#resetPassword').on('click', function () {
            $('#errorDisplay').html('');
            var emailForget = $("#emailForget").val();
            if (emailForget == '') {
                $("#errorDisplay").html("<div class='alert alert-danger alert-dismissible' style='text-align: center;'>Please Enter Email Address.</div>")
                $("#emailForget").focus();
                return false;
            } else if (!IsEmail(emailForget)) {
                $("#errorDisplay").html("<div class='alert alert-danger alert-dismissible' style='text-align: center;'>Please Enter Correct Email Format.</div>")
                $("#emailForget").focus();
                return false;
            } else {
                $('#loading').css("display", "block");
                $.ajax({
                    type: "POST",
                    data: {
                        'email': emailForget
                    },
//                url: baseUrl + "admin/AdminLogin/sendResetPassMail",
                    url: baseUrl + "<?php echo CommonConstants::SELLER_URL_SLUG;?>/send-forgot-pass-mail",
                    success: function (result) {
//                    console.log((result));
//                    return false;
                        if (result == 1) {
                            $('#login-form').show();
                            $('#forget-form').hide();
                            $("#errorDisplay").css("display", "block");
                            $("#errorDisplay").html("<div class='alert alert-success alert-dismissible' style='text-align: center;'>A password reset link has been sent to your email.</div>")
                            setTimeout(function () {
                                $("#errorDisplay").fadeOut(3000);
                            }, 5000);

                        } else {
                            $("#errorDisplay").html("<div class='alert alert-danger alert-dismissible' style='text-align: center;'>Unauthorised Email.</div>");
                        }


                    }
                });
                $('#errorDisplay').html('');
                $('#loading').css("display", "none");
                return;


            }

        });


//    $('#emailForget').on('keypress', function (e) {
//        var code = (e.keyCode ? e.keyCode : e.which);
//        $('#errorDisplay').html('');
//        if (code == 13) {
//            var emailForget = $("#emailForget").val();
//            if (emailForget == '') {
//                $("#errorDisplay").html("<div class='alert alert-danger alert-dismissible' style='text-align: center;'>Please Enter Email Address.</div>")
//                $("#emailForget").focus();
//                return false;
//            } else if (!IsEmail(emailForget)) {
//                $("#errorDisplay").html("<div class='alert alert-danger alert-dismissible' style='text-align: center;'>Please Enter Correct Email Format.</div>")
//                $("#emailForget").focus();
//                return false;
//            } else {
//                $('#loading').css("display", "block");
//                $.ajax({
//                    type: "POST",
//                    data: {
//                        'email': emailForget
//                    },
//                    url: baseUrl + "admin/AdminLogin/sendResetPassMail",
//                    success: function (result) {
////                    console.log((result));
////                    return false;
//                        if (result == 1) {
//                            $('#login-form').show();
//                            $('#forget-form').hide();
//                            $("#errorDisplay").css("display", "block");
//                            $("#errorDisplay").html("<div class='alert alert-success alert-dismissible' style='text-align: center;'>A password reset link has been sent to your email.</div>")
//                            setTimeout(function () {
//                                $("#errorDisplay").fadeOut(3000);
//                            }, 5000);
//
//                        } else {
//                            $("#errorDisplay").html("<div class='alert alert-danger alert-dismissible' style='text-align: center;'>Unauthorised Email.</div>");
//                        }
//
//
//                    }
//                });
//                $('#errorDisplay').html('');
//                $('#loading').css("display", "none");
//                return;
//
//
//            }
//        }
//    });


        /*---- reset Password Ends----*/

        $("#reset").on('click', function () {
            var token= $('#token').val();
            var newPassword = $("#newPassword").val();
            var confirmPassword = $("#confirmPassword").val();
            if (newPassword == '') {
                $("#errorDisplay").html("<div class='alert alert-danger alert-dismissible' style='text-align: center;'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Please Enter Password.</div>");
                $("#password").focus();
                return true;
            } else if (confirmPassword == '') {
                $("#errorDisplay").html("<div class='alert alert-danger alert-dismissible' style='text-align: center;'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Please confirm password.</div>");
                $("#confirmPassword").focus();
                return true;
            } else if (confirmPassword != newPassword) {
                $("#errorDisplay").html("<div class='alert alert-danger alert-dismissible' style='text-align: center;'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Password does not match.</div>");
                $("#confirmPassword").focus();
                return true;
            } else {

                $.ajax({
                    type: "POST",
                    data: {
                        'password': newPassword,
                        'token': token
                    },
//                url: baseUrl + "admin/AdminLogin/resetPasswordByHash",
                    url: baseUrl + "<?php echo CommonConstants::SELLER_URL_SLUG;?>/resetpassword",
                    success: function (result) {
                        console.log(result);
                        //return false;
                        if (result == 1) {
                            $("#errorDisplay").html("<div class='alert alert-success alert-dismissible' style='text-align: center;'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Password changed successfully</div>");
                            setTimeout(function () {
                                $("#errorDisplay").fadeOut(3000);
                            }, 5000);

                        } else if (result == -1) {
                            $("#errorDisplay").html("<div class='alert alert-danger alert-dismissible' style='text-align: center;'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Invalid Url to Reset Password.</div>");
                        } else if (result == -2) {
                            $("#errorDisplay").html("<div class='alert alert-danger alert-dismissible' style='text-align: center;'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Unable to reset password, please try later.</div>");
                        }


                    }
                });

            }

        });


    });


    function IsEmail(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }
</script>
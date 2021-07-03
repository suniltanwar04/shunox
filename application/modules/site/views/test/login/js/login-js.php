<script>

jQuery(document).ready(function () {

    hideError('userName');
    hideError('loginPass');
    checkValidEmail('userName');


    var fullName = jQuery("#fullName").val();
    var emailId = jQuery("#emailId").val();
    var mobile = jQuery("#mobile").val();
    var password = jQuery("#password").val();
    var confirmPass = jQuery("#confirmPass").val();

    hideError('fullName');
    hideError('emailId');
    hideError('mobile');
    hideError('password');
    hideError('confirmPass');

    checkValidEmail('emailId');
    checkValidMobile('mobile');


    var redirectUrl = window.location.href;


    jQuery(document).off('click', '#modal-launcher').on('click', '#modal-launcher', function (e) {
        e.preventDefault;
        jQuery("#userName").val('');
        jQuery("#userNameError").hide().html('');
        jQuery("#loginPass").val('');
        jQuery("#loginPassError").hide().html('');

        jQuery("#fullName").val('');
        jQuery("#fullNameError").hide().html('');
        jQuery("#emailId").val('');
        jQuery("#emailIdError").hide().html('');
        jQuery("#mobile").val('');
        jQuery("#mobileError").hide().html('');
        jQuery("#password").val('');
        jQuery("#passwordError").hide().html('');
        jQuery("#confirmPass").val('');
        jQuery("#confirmPassError").hide().html('');


    });

    jQuery(document).off('click', '#loginBtn').on('click', '#loginBtn', function (e) {
        alert('hii');
        e.preventDefault;
        var userName = jQuery("#userName").val();
        var loginPass = jQuery("#loginPass").val();

        if (!userName) {
            jQuery("#userNameError").show().html('please enter username.');
            jQuery("#userName").focus();
            return false;
        } else if (!loginPass) {
            jQuery("#loginPassError").show().html('please enter password.');
            jQuery("#loginPass").focus();
            return false;
        } else {
            jQuery('#loginBtn').text('Verifying...').attr('disabled', 'disabled');
            jQuery.ajax({
                type: "POST",
                data: {
                    'email': userName,
                    'password': loginPass
                },
                url: '<?php echo base_url();?>' + 'login',
                success: function (result) {
                    jQuery('#loginBtn').text('Login').removeAttr('disabled');

                    if (result == -1) {
                        jQuery("#loginPassError").show().html('credential does not match!');
                    } else if (result == '<?php echo CommonConstants::USER_ROLE_ADMIN;?>') {
                        window.location.href = "<?php echo base_url().CommonConstants::ADMIN_URL_SLUG;?>/dashboard";
                    } else {
                        //window.location.href = redirectUrl;
                    }
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    alert("Status: " + textStatus);
                    alert("Error: " + errorThrown);
                }
            });
        }
    });


    jQuery('#userName').on('keypress', function (e) {
        var code = (e.keyCode ? e.keyCode : e.which);
        if (code == 13) {

            var userName = jQuery("#userName").val();
            var loginPass = jQuery("#loginPass").val();

            if (!userName) {
                jQuery("#userNameError").show().html('please enter username.');
                jQuery("#userName").focus();
                return false;
            } else if (!loginPass) {
                jQuery("#loginPassError").show().html('please enter password.');
                jQuery("#loginPass").focus();
                return false;
            } else {
                jQuery('#loginBtn').text('Verifying...').attr('disabled', 'disabled');
                jQuery.ajax({
                    type: "POST",
                    data: {
                        'email': userName,
                        'password': loginPass

                    },
                    url: '<?php echo base_url();?>' + 'login',
                    success: function (result) {
                        jQuery('#loginBtn').text('Login').removeAttr('disabled');

                        if (result == -1) {
                            jQuery("#loginPassError").show().html('credential does not match!');
                        } else if (result == '<?php echo CommonConstants::USER_ROLE_ADMIN;?>') {
                            window.location.href = "<?php echo base_url().CommonConstants::ADMIN_URL_SLUG;?>/dashboard";
                        } else {
                            window.location.href = redirectUrl;
                        }
                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        alert("Status: " + textStatus);
                        alert("Error: " + errorThrown);
                    }
                });
            }


        }
    });
    jQuery('#loginPass').on('keypress', function (e) {
        var code = (e.keyCode ? e.keyCode : e.which);
        if (code == 13) {

            var userName = jQuery("#userName").val();
            var loginPass = jQuery("#loginPass").val();

            if (!userName) {
                jQuery("#userNameError").show().html('please enter username.');
                jQuery("#userName").focus();
                return false;
            } else if (!loginPass) {
                jQuery("#loginPassError").show().html('please enter password.');
                jQuery("#loginPass").focus();
                return false;
            } else {
                jQuery('#loginBtn').text('Verifying...').attr('disabled', 'disabled');
                jQuery.ajax({
                    type: "POST",
                    data: {
                        'email': userName,
                        'password': loginPass

                    },
                    url: '<?php echo base_url();?>' + 'login',
                    success: function (result) {
                        jQuery('#loginBtn').text('Login').removeAttr('disabled');

                        if (result == -1) {
                            jQuery("#loginPassError").show().html('credential does not match!');
                        } else if (result == '<?php echo CommonConstants::USER_ROLE_ADMIN;?>') {
                            window.location.href = "<?php echo base_url().CommonConstants::ADMIN_URL_SLUG;?>/dashboard";
                        } else {
                            window.location.href = redirectUrl;
                        }
                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        alert("Status: " + textStatus);
                        alert("Error: " + errorThrown);
                    }
                });
            }


        }
    });


    jQuery(document).off('click', '#registerBtn').on('click', '#registerBtn', function (e) {
        e.preventDefault;
        var fullName = jQuery("#fullName").val();
        var emailId = jQuery("#emailId").val();
        var mobile = jQuery("#mobile").val();
        var password = jQuery("#password").val();
        var confirmPass = jQuery("#confirmPass").val();


        if (!fullName) {
            jQuery("#fullNameError").show().html('please enter full name.');
            jQuery("#fullName").focus();
            return false;
        } else if (!emailId) {
            jQuery("#emailIdError").show().html('please enter email.');
            jQuery("#emailId").focus();
            return false;
        } else if (!mobile) {
            jQuery("#mobileError").show().html('please enter mobile.');
            jQuery("#mobile").focus();
            return false;
        } else if (!password) {
            jQuery("#passwordError").show().html('please enter password.');
            jQuery("#password").focus();
            return false;
        } else if (!confirmPass) {
            jQuery("#confirmPassError").show().html('please confirm password.');
            jQuery("#confirmPass").focus();
            return false;
        } else if (password != confirmPass) {
            jQuery("#confirmPassError").show().html('password does not match.');
            jQuery("#confirmPass").focus();
            return false;
        } else {
            jQuery('#registerBtn').text('Register...').attr('disabled', 'disabled');
            jQuery.ajax({
                type: "POST",
                data: {
                    'fullName': fullName,
                    'emailId': emailId,
                    'mobile': mobile,
                    'password': password
                },

                url: '<?php echo base_url();?>' + 'registration',
                success: function (result) {
                    jQuery('#registerBtn').text('Register').removeAttr('disabled');
                    // console.log(result);
                    // return false;
                    if (result == -1) {
                        jQuery("#emailIdError").show().html('email already registered.');
                        return false;
                    } else if (result == -2) {
                        jQuery("#mobileError").show().html('mobile already registered.');
                    } else if (result == -3) {
                        jQuery("#RegistrationFailed").fadeIn();
                        setTimeout(function () {
                            jQuery("#RegistrationFailed").fadeOut();
                            jQuery("#registrationForm")[0].reset();
                        }, 4000);
                    } else if (result == 2) {
                      $("#login-modal").modal('hide');
                        $("#otpFormWrapper").fadeIn();
                         window.location.href = redirectUrl;
                        // jQuery("#RegistrationSuccess").fadeIn();
                        // jQuery("#userName").val(emailId);
                        // jQuery("#loginPass").focus();
                        setTimeout(function () {
                            jQuery("#RegistrationSuccess").fadeOut();
                            jQuery("#registrationForm")[0].reset();
                        }, 4000);
                    }


                }
            });
        }

    });


    jQuery(document).off('click', '#viewCart').on('click', '#viewCart', function (e) {
        alert('View Cart');
        bootbox.alert("This is the default alert!");
        jQuery('#login-modal').modal("show");


    });


    jQuery(document).off('click', '.checkUserLogin').on('click', '.checkUserLogin', function (e) {
        e.preventDefault;
        jQuery.ajax({
            url: '<?php echo base_url();?>' + 'check-user-login',
            type: 'post',
            data: {
                checkLogin: '1'
            },
            cache: false,
            success: function (result) {

                if (result == 1) {
                    window.location.href = redirectUrl;
                } else {
                    jQuery("#login-modal").modal('show');
                    jQuery("#myModalLabel").text('Please Login to your account for further access !');
                }
            }
        });
    });

    $("#contactform").on('submit', function(e){
        e.preventDefault();
        var form = $(this);
        if(validateMe('validateContact')){
            var formData = new FormData(form[0]);
            $.ajax({
                url:'<?php echo base_url();?>'+'template/sendContactUs',
                type:"POST",
                data:formData,
                contentType:false,
                processData:false,
                cache:false,
                success:function(result){
                    if(result == 1){
                        form[0].reset();
                        $("#contactUsStatus").text("Message Sent").css("color",'green');
                    }

                    if(result == 0){
                        $("#contactUsStatus").text("Something Went Wrong. Try Again Later !").css("color",'red');
                    }
                }
            });
        }else{
          return false;
        }
    });


    $("#otpForm").on('submit', function(){
        var otp = $.trim($("#otp").val());
        if(otp != ""){

          $("#completeregisteration").text('Please Wait').attr('disabled','disabled');
          $("#otpStatus").text("");
            $.ajax({
                url:"<?php echo base_url() ?>site/SiteLogin/verifyOTP",
                type:"POST",
                data:{otp:otp},
                cache:false,
                success:function(data){
                  $("#completeregisteration").text('Submit').removeAttr('disabled');
                  if(data == -1){
                    $("#otpStatus").text("Please enter the OTP").text('You have entered an incorrect OTP.').css('color','red');
                  }

                  if(data == 1){
                    $("#otpStatus").text("Please enter the OTP").text('Registration successfull').css('color','green');
                      setTimeout(function(){
                        window.location.reload();
                      },2000);
                  }
                }
            });
        }else{
          $("#otpStatus").text("Please enter the OTP");
        }

        return false;
    });


});

function showSubMenu(id) {
    jQuery('#sub-cat_'+id).css('display', 'block');
}







</script>

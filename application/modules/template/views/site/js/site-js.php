<script>

jQuery(document).ready(function () {

    hideError('userName');
    hideError('loginPass');
    


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
    //checkValidMobile('mobile');


    var redirectUrl = window.location.href;




    jQuery(document).on('click', '#loginBtn', function (e) {

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
            jQuery('#loader').css('display','block');
            jQuery.ajax({
                type: "POST",
                data: {
                    'email': userName,
                    'password': loginPass
                },
                url: '<?php echo base_url();?>' + 'login-account',
                success: function (result) {
                    jQuery('#loginBtn').text('Login').removeAttr('disabled');
                    jQuery('#loader').css('display','none');
                    if (result == -1) {
                        jQuery("#loginPassError").show().html('credential does not match!');
                    } else if (result == '<?php echo CommonConstants::USER_ROLE_ADMIN;?>') {
                        window.location.href = "<?php echo base_url().CommonConstants::ADMIN_URL_SLUG;?>/dashboard";
                    }else if(result == 3){
                            window.location.href = "<?php echo base_url()?>cart";
                    } else if(result == 4){
			 window.location.href = "<?php echo base_url()?>track-your-order";
                       
                    }else{
                    	 window.location.href = "<?php echo base_url()?>user/edit-profile";
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
                    url: '<?php echo base_url();?>' + 'login-account',
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
                        } else if(result == 3){
                            window.location.href = "<?php echo base_url()?>checkout/shipping";
                        }else{
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
        var lastName = jQuery("#lastName").val();
        var emailId = jQuery("#emailId").val();
        var mobile = jQuery("#mobile").val();
        var password = jQuery("#password").val();
        var confirmPass = jQuery("#confirmPass").val();
        var news = $("input[name='newsletter']:checked").val();
        var newsl ='';
        if(news == 1){
            var newsl = news;
        }

        if (!fullName) {
            jQuery("#error").show().html('Please enter first name.');
            jQuery("#fullName").focus();
            return false;
        } else if (!lastName) {
            jQuery("#error").show().html('Please enter last name.');
            jQuery("#lastName").focus();
            return false;
        } else if (!emailId) {
            jQuery("#error").show().html('Please enter email.');
            jQuery("#emailId").focus();
            return false;
        } else if (!mobile) {
            jQuery("#error").show().html('Please enter mobile.');
            jQuery("#mobile").focus();
            return false;
        } else if (!password) {
            jQuery("#error").show().html('Please enter password.');
            jQuery("#password").focus();
            return false;
        } else if (!confirmPass) {
            jQuery("#error").show().html('Please confirm password.');
            jQuery("#confirmPass").focus();
            return false;
        } else if (password != confirmPass) {
            jQuery("#error").show().html('Password does not match.');
            jQuery("#confirmPass").focus();
            return false;
        } else {

            jQuery('#registerBtn').text('Register...').attr('disabled', 'disabled');
            jQuery('#loader').css('display','block');
            jQuery.ajax({
                type: "POST",
                data: {
                    'fullName': fullName,
                    'lastName': lastName,
                    'emailId': emailId,
                    'mobile': mobile,
                    'password': password,
                    'news' : newsl
                },

                url: '<?php echo base_url();?>' + 'registration',
                success: function (result) {
                    jQuery('#registerBtn').text('Register').removeAttr('disabled');
                    jQuery('#loader').css('display','none');
                    // console.log(result);
                    // return false;
                    if (result == -1) {
                        jQuery("#error").show().html('email already registered.');
                        return false;
                    } else if (result == -2) {
                        jQuery("#error").show().html('mobile already registered.');
                    } else if (result == -3) {
                        jQuery("#RegistrationFailed").fadeIn();
                        setTimeout(function () {
                            jQuery("#RegistrationFailed").fadeOut();
                            jQuery("#registrationForm")[0].reset();
                        }, 4000);
                    } else if (result == 2) {


                        window.location.href = "<?php echo base_url()?>user/edit-profile";
                        // jQuery("#RegistrationSuccess").fadeIn();
                        // jQuery("#userName").val(emailId);
                        // jQuery("#loginPass").focus();
                        setTimeout(function () {
                            jQuery("#RegistrationSuccess").fadeOut();
                            jQuery("#registrationForm")[0].reset();
                        }, 4000);
                    }else if(result == 3){
                            window.location.href = "<?php echo base_url()?>checkout/shipping";
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

function newsLetter() {
    if(jQuery('#email').val()==''){
    	jQuery('#newError').css('display', 'block');
    	jQuery('#newError').css('color', 'red');
    	jQuery('#newError').html('Please enter email id');
    	return false;
    	
    }else{
    	$.ajax({
                url:"<?php echo base_url() ?>site/Site/newsLetter",
                type:"POST",
                data:{email:jQuery('#email').val()},
                cache:false,
                success:function(data){
                 
                  if(data == 1){
                    $("#newError").html("Your email has been subscribed");
                    jQuery('#newError').css('display', 'block');
    		    jQuery('#newError').css('color', 'green');
                  }else{
                  	$("#newError").html("Already subscribed");
                    jQuery('#newError').css('display', 'block');
    		    jQuery('#newError').css('color', 'red');
                  }

     
                }
            });
    }
}

function loginUrl(){
		$.ajax({
                url:"<?php echo base_url() ?>site/SitePage/setTrackOrder",
                type:"POST",
                data:{msg:1},
                cache:false,
                success:function(data){
                 
                  if(data == 1){
                   window.location.href = "<?php echo base_url()?>login";
                  }

     
                }
            });
}

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
                    url: "<?php echo base_url()?>send-forgot-pass-mail",
                    success: function (result) {
//                    console.log((result));
//                    return false;
                        if (result == 1) {
                            $('#login-form').show();
                            $('#forget-form').hide();
                            $("#errorDisplay").css("display", "block");
                            $("#errorDisplay").html("<div class='alert alert-success alert-dismissible' style='text-align: center;'>Forgot password link sent to your email.Please check it</div>")
                            setTimeout(function () {
                                $("#errorDisplay").fadeOut(3000);
                                window.location.reload();
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
        
    
    $("#resetBtn").on('click', function () {

            var newPassword = $("#newPassword").val();
            var confirmPassword = $("#confirmPassword").val();
            var token= $("#token").val();
            if (newPassword == '') {
                $("#errorDisplay").html("Please Enter Password.");
                $("#password").focus();
                return true;
            } else if (confirmPassword == '') {
                $("#errorDisplay").html("Please confirm password.");
                $("#confirmPassword").focus();
                return true;
            } else if (confirmPassword != newPassword) {
                $("#errorDisplay").html("Password does not match.");
                $("#confirmPassword").focus();
                return true;
            } else {
		 $.ajax({
                    type: "POST",
                    data: {
                        'password': newPassword,
                        'token': token
                    },
//                
                    url: "<?php echo base_url();?>/resetpassword",
                    success: function (result) {
                        console.log(result);
                        //return false;
                        if (result == 1) {
                            $("#successDisplay").html("Password changed successfully");
                            $("#errorDisplay").html("");
                            $("#newPassword").val('');
                           $("#confirmPassword").val('');
                           setTimeout(function () {
                                $("#errorDisplay").fadeOut(3000);
                                window.location.href = "<?php echo base_url()?>login";
                            }, 5000);
                        } else if (result == -1) {
                            $("#errorDisplay").html("Invalid Url to Reset Password.");
                        } else if (result == -2) {
                            $("#errorDisplay").html("Unable to reset password, please try later.");
                        }


                    }
                });
               
            }

       


    });
        function IsEmail(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }

</script>

<script>
    var baseUrl = "<?php echo base_url() ?>";
    $(document).ready(function(){
    $(function() {
            $( "#dob" ).datepicker({
               changeMonth:true,
               changeYear:true
               
            });
         });
    
   
      $(document).off('click', '#update_password').on('click', '#update_password', function(e){
         e.preventDefault();
         var msg = '<i class="fa fa-key">&nbsp; </i> Checking...';
         var error = $("#update_password_error");
            var oldPassword = $.trim($("#old_password").val());
            var newPassword = $.trim($("#new_password").val());
            var cnfNewPassword = $.trim($("#cnf_new_password").val());
            if(oldPassword == "" || newPassword == "" || cnfNewPassword == ""){
                error.text('All fields are mendatory!');
            }else if(newPassword.length < 6){
                error.text('New password should be minimum 6 characters long !');
            }else if(cnfNewPassword != newPassword){
                error.text('Both new and confirm password should be the same !');
            }else{
                $("#update_password").html('<i class="fa fa-key">&nbsp; </i> Checking...').attr('disabled','disabled');
                error.text('');
                $.ajax({
                   url:baseUrl+'site/User/updatePassword',
                   type:'post',
                    data:{
                        oldPassword:oldPassword,
                        newPassword:newPassword
                    },
                    cache:false,
                    success:function(result){
                        $("#update_password").html('<i class="fa fa-key">&nbsp; </i> Update Password').removeAttr('disabled');
                        // console.log(result);
                        // return false;
                        if(result == -1){
                            error.text('You have entered an incorrect password !');
                        }else if(result == 1){
                            $(":input").val('');
                            error.text('You have successfully updated your password !');
                            error.css('color','green');
                            setTimeout(function(){
                                error.fadeOut(1000);
                            },5000)
                        }else{
                            $(":input").val('');
                            error.text('Something went wrong. Please try again !');
                        }
                    }
                });
            }
     });

     $(document).off('click', '#update_user_profile').on('click', '#update_user_profile', function(e){
    
        e.preventDefault();
        var error =  $("#update_profile_error");
        var picture = $("#upload_picture").val();
		console.log(picture);
        var name = $.trim($("#userName").val());
         var title = $.trim($("#title").val());
        var email = $.trim($("#userEmail").val());
        var mobile = $.trim($("#userMobile").val());
         var dob = $.trim($("#dob").val());

         var country = $("#country").val();
        var state = $("#state").val();
        var city = $("#city").val();
        var pinCode = $.trim($("#userPinCode").val());
        var address = $.trim($("#userAddress").val());
         if(title == ""){
             $("#usertitleError").text("Select title !");
         }else{ $("#usertitleError").text(""); }

        if(name == ""){
            $("#userNameError").text("Enter your name !");
        }else{ $("#userNameError").text(""); }

        if(email == ""){
             $("#userEmailError").text("Enter your email !");
        }else{ $("#userEmailError").text(""); }

        if(mobile == ""){
             $("#userMobileError").text("Enter your mobile no. !");
        }else{ $("#userMobileError").text(""); }

         

         if(country == ""){
             $("#userCountryError").text("select your country. !");
         }else{ $("#userCountryError").text(""); }

         if(state == ""){
             $("#userStateError").text("select your state. !");
         }else{ $("#userStateError").text(""); }

         if(city == ""){
             $("#userCityError").text("select your city. !");
         }else{ $("#userCityError").text(""); }

         if(pinCode == ""){
             $("#userPinCodeError").text("Enter pinCode. !");
         }else{ $("#userPinCodeError").text(""); }

         if(address == ""){
             $("#userAddressError").text("Enter your Address. !");
         }else{ $("#userAddressError").text(""); }

        if(picture != ""){
            if(!checkImageExt(picture.toLowerCase())){
              error.text("Invalid image file type !");
            }else{
              error.text("");
            }
        }
        var getError = $("i[id*='Error']").text();

        if(getError == "" &&  error.text() == ""){
            $("#update_user_profile").text("Please Wait...").attr("disabled","disabled");
            var data = new FormData($("#user_profile_update")[0]);
            $.ajax({
               url:baseUrl+'site/User/updateUserProfile',
                type:'post',
                data:data,
                cache:false,
                processData:false,
                contentType:false,
                success:function(result){
					console.log(result);
                    $("#update_user_profile").text("Update Profile").removeAttr("disabled");
                    if(result == 1){
                        $(":input").val('');
                        error.text('You have successfully updated your profle !');
                        error.css('color','green')
                        setTimeout(function(){
                            window.location.href = baseUrl+"user/edit-profile";
                        },3500);
                    }else if(result == -1){
                        error.text('File size must be less than 2 mb');
                    }else if(result == -3){
                        error.text('Email You Have Entered is already exists');
                    }else{
                         $(":input").val('');
                        error.text('Something went wrong. Try again later !');
                    }
                }
            });
        }
    });


    })
    
    $(document).off('click', '.rem_wishlist').on('click', '.rem_wishlist', function(e){
		var str = $('.rem_wishlist').attr('id');
		var res = str.split("_");
		var proid = res[1];
		 $.ajax({
               url:baseUrl+'site/User/removeWishlist',
                type:'post',
                data:{proid:proid},
                cache:false,
                
                success:function(result){
                    if(result == 1){
                        $('.remove_'+res[1]).remove();
                    }else {
                        
                    }
                }
            });
		
	});
	
	$(document).off('change', '#country').on('change', '#country', function (e) {
            e.preventDefault;

            var country = $("#country").val();

            $.ajax({
                type: "POST",
                data: {
                    'country': country
                },
                url: $('#base_url').val() + "getState",
                success: function (result) {
                
                    $('#state').html(result)
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    alert("Status: " + textStatus);
                    alert("Error: " + errorThrown);
                }
            });
        });
        
        $(document).off('change', '#state').on('change', '#state', function (e) {
            e.preventDefault;

            var state = $("#state").val();

            $.ajax({
                type: "POST",
                data: {
                    'state': state
                },
                url: $('#base_url').val() + "getCity",
                success: function (result) {
                
                    $('#city').html(result)
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    alert("Status: " + textStatus);
                    alert("Error: " + errorThrown);
                }
            });
        });

</script>

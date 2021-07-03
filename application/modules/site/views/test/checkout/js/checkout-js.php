<script type="text/javascript">
 	var baseUrl = "<?php echo base_url() ?>";
	$(document).ready(function(){

		$("#onepage-guest-register-button").on("click", function(){
		
			var checkOutMethod = $("input[name='checkout_method']:checked").val();
			
                        
			if(checkOutMethod){
				if(checkOutMethod == "login"){
					window.location.href= baseUrl+"login"
				}

				if(checkOutMethod == "guest"){
					window.location.href= baseUrl+"checkout/shipping"
				}
			}else{
				$("#checkMethodError").text("Please Choose a Checkout Method !")
			}

		});

   

    $(".ChooseShipping").on('click', function(){
        var shippingAddress = $("input[name='shippingAddress']:checked").val();
         
        if(shippingAddress == 1){
          $("#newShippingAddressForm").slideDown();
        }else{
          $("#newShippingAddressForm").slideUp();
         
        }
    });

    $("#phone").on('keyup', function(){
      var mobile = $.trim($(this).val());
      if(isNaN(mobile)){
          $("#phone").val('');
          return false;
      }

      if(mobile.length == 10){
        $("#phone").blur();
      }
    });

    $(".paymentMethod").on('click', function(){
        var obj = $(this);
        $("*").removeClass("active");
        obj.addClass("active");
        var paymentOption = obj.children("input").val();
        var paymentOption = 2;
        $("#paymentOption").val(paymentOption);
    });

    $("#paymentOptionForm").on('submit', function(){
	var paymentOption = 2;
      //paymentOption = $.trim($("#paymentOption").val());
      if(paymentOption == ""){
        $("#PaymentError").slideDown();
        return false;
      }
      $("#loader").fadeIn(200);
      // return false;
      setTimeout(function(){
        return true;
      },2000);

    });

    $("#pinCode").on('keyup', function(){
        var pin = $.trim($(this).val());
        if(isNaN(pin)){
            $("#pinCode").val('');
            return false;
        }
        if(pin.length == 6){
          //fetching the state
          $.ajax({
              url:baseUrl+"site/Checkout/findState",
              type:"POST",
              data:{pin:pin},
              cache:false,
              success:function(data){
                  $("#state").html(data);
              }
          });

          //fetching the city
          $.ajax({
              url:baseUrl+"site/Checkout/findCity",
              type:"POST",
              data:{pin:pin},
              cache:false,
              success:function(data){
                $("#city").html(data);
              }
          });
        }else{
            $("#city").html('<option value="">Select Your City</option>');
              $("#state").html('<option value="">Select Your State</option>');
        }
    });


		$("form#shippingAddressForm").on("submit", function(){
      var isUserLoggedIn = "<?php echo $this->session->userdata('Id') ? : '0'; ?>";
      if(isUserLoggedIn < 1){
        shippingAddress = 1;
      }else{
        shippingAddress  = $("input[name='shippingAddress']:checked").val();
      }
      if(shippingAddress)
      {
                  
      var isUserLoggedIn = "<?php echo $this->session->userdata('Id') ? : '0'; ?>";
      
      
     
      var formData = new FormData();//0 means old address
      formData.append('shippingAddress',0);
      var status;
      if(isUserLoggedIn != '0'){
        shippingAddress = $("input[name='shippingAddress']:checked").val();
        //checking weather it is undefined or not, if so then set this back to 1
        if(!shippingAddress){
          shippingAddress = 1;
         
        }
      }

      if(shippingAddress == 1){
        //making a new form data object of shipping form
        formData = new FormData($("#shippingAddressForm")[0]);
        formData.append('shippingAddress',1);
      }

      if(shippingAddress == 1){
        //validating the shipping form
        $("#shippingAddressForm").find('.require').each(function(){
          var current = $(this), inputVal,inputType;
          inputVal = $.trim(current.val());
          inputType = current.attr('name');

          if(inputVal == ""){
            current.css('border-color','red').siblings('span.text-danger').text('Please fill out this field');
            status = false;
          }else{
              current.css('border-color','#eee').siblings('span.text-danger').text('');
              status = true;
          }
        });

      }else{
        status = true;
      }

      if(shippingAddress == 1 ){
        formData.append('loginType',isUserLoggedIn);
        $("#loader").fadeIn(200);
        $.ajax({
          url:baseUrl+"site/Checkout/verifyOrder",
          type:"POST",
          data:formData,
          processData:false,
          contentType:false,
          cache:false,
          success:function(result){
            $("#loader").fadeOut(200);
            // console.log(result);
            // console.log(shippingAddress);
            // return false;
            if(result == 1){
                window.location.href = baseUrl+"payment-option";
            }

           
            console.log(result);

          }
        });
      }
      if(shippingAddress == 2 ){
      var user_firstname = $('#user_firstname').val();
      var user_email = $('#user_email').val();
      var user_phone = $('#user_phone').val();
      var user_landmark = $('#user_landmark').val();
      var user_fullAddress = $('#user_fullAddress').val();
      var user_pinCode = $('#user_pinCode').val();
      var user_state = $('#user_state').val();
      var user_city = $('#user_city').val();
      
        $("#loader").fadeIn(200);
        $.ajax({
          url:baseUrl+"site/Checkout/verifyOrder",
          type:"POST",
          data:{user_firstname : user_firstname, user_email : user_email, user_phone : user_phone, user_landmark : user_landmark,user_fullAddress : user_fullAddress, user_pinCode : user_pinCode,user_state : user_state,user_city : user_city, shippingAddress:2, loginType : isUserLoggedIn},
          
          cache:false,
          success:function(result){
            $("#loader").fadeOut(200);
            // console.log(result);
            // console.log(shippingAddress);
            // return false;
            if(result == 1){
                window.location.href = baseUrl+"payment-option";
            }

            
   

            console.log(result);

          }
        });
      }

			return false;
			}else{
			
			if(isUserLoggedIn > 0){
			alert('Please Choose Address');
			}else{
			window.location.href = baseUrl+"payment-option";
			}
			return false;
			}
		});


    $("#checkOutOtpModal").on('submit', function(){
      var otp = $.trim($("#checkoutOtp").val());
      if(otp != ""){
        $("#loader").fadeIn(200);
        $.ajax({
          url:baseUrl+"site/Checkout/verifyCheckOutOTP",
          type:"POST",
          data:{otp:otp},
          cache:false,
          success:function(data){
            $("#loader").fadeOut(200);
              console.log(data);
              if(data == 1){
  							window.location.href = baseUrl+"payment-option";
  						}

              if(data == -1){
                $("#CheckoutOtpStatus").text("You have entered an incorrect OTP").css('color','red').fadeIn();
              }
          }
        });
      }else{
        $("#checkoutOtpError").text("Please Enter the OTP");
      }
      return false;
	});

});

</script>

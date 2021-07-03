<script type="text/javascript">
	
	$(".radio_check").on('click', function(){
		// console.log($(this).val());
		// if($(this).val() != 5){
			// $('#order_id').prop('required',true);
		// }
		// else{
			// $('#order_id').prop('required',false);
		// }
		$('#comment').removeAttr("disabled");
		$('#name').removeAttr("disabled");
		$('#email').removeAttr("disabled");
		$('#telephone').removeAttr("disabled");
		$('#address').removeAttr("disabled");
		$('#order_id').removeAttr("disabled");
	});
	function validateEmail(email) {
		var filter = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
		if (filter.test(email)) {
			return true;
		}
		else {
			return false;
		}
	}

	
$(".submitQuery").on('click', function(){
			var id = $("input[name=check_radio]:checked").val();
		
            var status = false;
            var name    = $("#name").val();
			var email    = $("#email").val();
			var phone    = $("#telephone").val();
			var address    = $("#address").val();
			var query    = $("#comment").val();
			var order_id    = $("#order_id").val();
			var radio_check    = $(".radio_check:checked").val();
			console.log(radio_check);
			if(radio_check != 5){
				if(!order_id){
					$("#response").addClass("alert-danger").text('Please enter Order Id');
					$('#response').css('display', 'block');
					$('#order_id').focus();
				   return false;
			   }
			}
           if(!query){
               $("#response").addClass("alert-danger").text('Please enter your message');
               $('#response').css('display', 'block');
               $('#comment').focus();
               return false;
           }else if(!name){
                $("#response").addClass("alert-danger").text('Please enter name');
                $('#response').css('display', 'block');
                $('#name').focus();
               return false;
           }else if(!email){
               $("#response").addClass("alert-danger").text('Please enter email');
               $('#response').css('display', 'block');
               $('#email').focus();
               return false;
           }else if(!validateEmail(email)){
           	 $("#response").addClass("alert-danger").text('Please enter valid email');
           	 $('#response').css('display', 'block');
                 $('#email').focus();
                 return false;
           }else if(!phone){
               $("#response").addClass("alert-danger").text('Please enter phone number');
               $('#response').css('display', 'block');
               $('#telephone').focus();
               return false;
           }else if(!address){
               $("#response").addClass("alert-danger").text('Please enter address');
               $('#response').css('display', 'block');
               $('#address').focus();
               return false;
           }else {
               var status = true;
               if (status === true) {
                   $("#loader").fadeIn(200);
                  $('#response').removeClass('alert-danger');
                   $.ajax({
                       url: "<?php echo base_url() ?>site/Site/sendContactUsMessage",
                       type: "POST",
                       data: {'name':name,'order_id':order_id,'email':email,'phone':phone,'query':query,'type':id, 'address':address},
                      
                       cache: false,
                       success: function (data) {
                          
                           $("#loader").fadeOut(200);
                           if (data == 1) {
                           $("#"+id)[0].reset();
                           $('#response').removeClass('alert-danger');
                               $("#response").addClass("alert-success").text('Thank you for contacting us. we will get back to u shortly').fadeIn();
                           } else {
                           $('#response').removeClass('alert-success');
                               $("#response").addClass("alert-danger").text('Something went wrong. Please try again later').fadeIn();
                           }
                       }
                   });
               }
           }
            return false;
        });
        

</script>

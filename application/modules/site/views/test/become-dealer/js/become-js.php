<script type="text/javascript">
  $(document).ready(function(){
      $("#becomeForm").on('submit', function(){
          if($('#name').val()==''){
            $('.alert-danger').html('Please enter first name');
            $('.alert-danger').css('display', 'block');
            $('#name').focus();
            return false;
          }else if($('#lname').val()==''){
              $('.alert-danger').html('Please enter last name');
              $('.alert-danger').css('display', 'block');
              $('#lname').focus();
              return false;
          }else if($('#email').val()==''){
              $('.alert-danger').html('Please enter email');
              $('.alert-danger').css('display', 'block');
              $('#email').focus();
              return false;
          }else if($('#mobile').val()==''){
              $('.alert-danger').html('Please enter mobile number');
              $('.alert-danger').css('display', 'block');
              $('#mobile').focus();
              return false;
          }else if($('#pan').val()==''){
              $('.alert-danger').html('Please enter pan number');
              $('.alert-danger').css('display', 'block');
              $('#pan').focus();
              return false;
          }
        //   else if($('#vat').val()==''){
        //       $('.alert-danger').html('Please enter vat number');
        //       $('.alert-danger').css('display', 'block');
        //       $('#vat').focus();
        //       return false;
        //   }else if($('#gst_no').val()==''){
        //       $('.alert-danger').html('Please enter GST number');
        //       $('.alert-danger').css('display', 'block');
        //       $('#gst_no').focus();
        //       return false;
        //   }
          else if($('#address').val()==''){
              $('.alert-danger').html('Please enter address');
              $('.alert-danger').css('display', 'block');
              $('#address').focus();
              return false;
          }else if($('#company').val()==''){
              $('.alert-danger').html('Please enter Company name');
              $('.alert-danger').css('display', 'block');
              $('#company').focus();
              return false;
          }else if($('#country').val()==''){
              $('.alert-danger').html('Select your country');
              $('.alert-danger').css('display', 'block');
              $('#country').focus();
              return false;
          }else if($('#state').val()==''){
              $('.alert-danger').html('Select your state');
              $('.alert-danger').css('display', 'block');
              $('#state').focus();
              return false;
          }else if($('#city').val()==''){
              $('.alert-danger').html('Select your city');
              $('.alert-danger').css('display', 'block');
              $('#city').focus();
              return false;
          }else if($('#pincode').val()==''){
              $('.alert-danger').html('Please enter pincode');
              $('.alert-danger').css('display', 'block');
              $('#pincode').focus();
              return false;
          }else if($('#comment').val()==''){
              $('.alert-danger').html('Please enter message');
              $('.alert-danger').css('display', 'block');
              $('#comment').focus();
              return false;
          }else {
              $('.alert-danger').html('');
              $('.alert-danger').css('display', 'none');
              $("#loader").fadeIn(200);
              var formData = new FormData($("#becomeForm")[0]);
              $.ajax({
                  url: "<?php echo base_url() ?>site/Site/sendBecomeDealer",
                  type: "POST",
                  data: formData,
                  contentType: false,
                  processData: false,
                  cache: false,
                  success: function (data) {
                      $("#becomeForm")[0].reset();
                      $("#loader").fadeOut(200);
                      if (data == 1) {
                          //$(".alert-success").text('Thank you for contacting us. we will get back to u shortly').fadeIn();
                          alert('Thank you for contacting us. we will get back to u shortly');
                          //$('.alert-danger').css('display', 'block');
                      } else {
                          $(".alert-danger").text('Something went wrong. Please try again later').fadeIn();
                          //$('.alert-danger').css('display', 'block');
                      }
                  }
              });
          }
          return false;
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
  });
</script>

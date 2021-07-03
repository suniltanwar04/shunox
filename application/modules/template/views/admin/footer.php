</div>
<script>
    function goBack() {
        window.history.back();
    }
    $(document).ready(function () {
        var siteUrl = '<?php echo base_url(); ?>';





        $(document).off('click', '#saveNewEmail').on('click', '#saveNewEmail', function () {
           if($('#adminemail').val()==''){
               $('#emailIdError').show().html('Please Enter email Id');
               $('#adminemail').focus();
               return false;
           }else if($('#toemail').val()==''){
                $('#toemailIdError').show().html('Please Enter email Id');
                $('#toemail').focus();
                return false;
           }else if($('#newPass').val()==''){
               $('#newPassError').show().html('Please Enter password');
               $('#newPass').focus();
               return false;
           }else{
               $('#emailIdError').show().html('');
               $.ajax({
                 type : 'POST',
                   data : {adminemail :$('#adminemail').val(), toemail : $('#toemail').val(), pass :  $('#newPass').val() },
                   url : '<?php echo base_url()?>admin/saveEmailAddress',
                   success : function(result){
                    if(result == 1){
                        $('#success').show().html('Email Id Successfully saved');
                        $('#email').val('');
                        $('#changeEmail').modal('hide');
                    }else{
                        $('#error').show().html('Error in save');
                        $('#email').val('');
                    }
                    }
               });
           }

        });

    });

</script>
</body>
</html>
<script>
    $(document).ready(function(){
        $('#selectall').change(function(){
            $('input[name="details[]"]').each(function() {
                if(!this.disabled)
                {
                    this.checked = true;
                }

            });
            if(this.checked == false){ //if this item is unchecked
                $('input[name="details[]"]').each(function() {
                    this.checked = false;
                });
            }
        });
    });

    function sendNewsletter()
    {
        if($('input[name="details[]"]:checked').length==0)
        {
            alert('please select atleast one newsletter to send email.');
        }else{
            $('#sendNewsletter').modal('show');
            var checked_id = new Array();
            $("input[name='details[]']:checked").each(function() {

                checked_id.push($(this).val());
            });
            var email_id = checked_id.toString();
            $("#sendNewsletter").click(function(){
			
		if($('#subjects').val()=="")
		{
			$("#subjecterror").text("Please enter subject.").css('color','red');
			$('#subjects').focus();
		}else if($('#messages').val()==""){
			$("#messageError").text("Please enter message.").css('color','red');
			$('#messages').focus();
		}else{
            $('#loading').css("display", "block");
            $("#messageError").text("");
            $("#subjecterror").text("");
            $.ajax({
                type: "POST",
                url: '<?php echo base_url()?>seller/send-newsletter',
                data:{email_ids:email_id, subject : $('#subjects').val(), message : $('#messages').val()},
             success: function ( msg ) {
                 $('#loading').css("display", "none");
                if(msg == 2)
                {
                    alert('error in sending mail');
                }else if(msg == 1)
                {
                $('#subjects').val('');
                $('#messages').val('');
                 $('#sendNewsletter').modal('hide');
                    alert('Email Send successfully');
                }
            }
        });
        }
        });
        }
    }
</script>
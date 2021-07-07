<script>
    $(document).ready(function () {

        hideError('addCategoryName');
        hideError('editCategoryName');


        $(document).off('click', '#addCategory').on('click', '#addCategory', function (e) {
            e.preventDefault;
            $("#addFromError").html('');
            $("#addCategoryName").val('');
            $("#addCategoryNameError").hide().html('');

        });


        $(document).off('click', '.deactivate').on('click', '.deactivate', function (e) {
            e.preventDefault;
//            alert();return false;
            var recordId = this.id;

            bootbox.confirm("Are you sure to disable this record?", function (result) {
                if (result == true) {
                    $.ajax({
                        type: "POST",
                        data: {
                            'recordId': recordId,
                            'isActive': 0
                        },
                        url: $('#baseUrl').val() + "<?php echo CommonConstants::SELLER_URL_SLUG;?>/enable-disable-users",
                        success: function (result) {
//                         console.log(result);return false;
                            if (result == -1) {

                            } else {
                                $('#table-div').html(result)
                            }
                        },
                        error: function (XMLHttpRequest, textStatus, errorThrown) {
                            alert("Status: " + textStatus);
                            alert("Error: " + errorThrown);
                        }
                    });
                } else {
                }
            });
        });
        $(document).off('click', '.activate').on('click', '.activate', function (e) {
            e.preventDefault;
            var recordId = this.id;
            bootbox.confirm("Are you sure to enable this record?", function (result) {
                if (result == true) {
                    $.ajax({
                        type: "POST",
                        data: {
                            'recordId': recordId,
                            'isActive': 1
                        },
                        url: $('#baseUrl').val() + "<?php echo CommonConstants::SELLER_URL_SLUG;?>/enable-disable-users",
                        success: function (result) {

                            if (result == -1) {

                            } else {
                                $('#table-div').html(result)
                            }
                        },
                        error: function (XMLHttpRequest, textStatus, errorThrown) {
                            alert("Status: " + textStatus);
                            alert("Error: " + errorThrown);
                        }
                    });
                } else {
                }
            });
        });


        $(document).off('click', '.glyphicon').on('click', '.glyphicon', function (e) {
            e.preventDefault;
            var recordId = this.id;

            bootbox.confirm("Are you sure want to delete this record?", function (result) {
                if (result == true) {
                    $('#loading').css("display", "block");
                    $.ajax({
                        type: "POST",
                        data: {
                            'recordId': recordId

                        },
                        url: $('#baseUrl').val() + "<?php echo CommonConstants::SELLER_URL_SLUG;?>/delete-user",
                        success: function (result) {
//console.log(result);return false;
                            $('#loading').css("display", "none");
                            if (result == -1) {

                            } else {
                                $('#table-div').html(result)
                            }
                        },
                        error: function (XMLHttpRequest, textStatus, errorThrown) {
                            alert("Status: " + textStatus);
                            alert("Error: " + errorThrown);
                        }
                    });
                } else {
                }
            });
        });

//        $(document).off('click', '.fa').on('click', '.fa', function (e) {
//            e.preventDefault;
//            var recordId = this.id;
//
//
//                if (result == true) {
//                    $('#loading').css("display", "block");
//                    $.ajax({
//                        type: "POST",
//                        data: {
//                            'recordId': recordId
//
//                        },
//                        url: $('#baseUrl').val() + "<?php //echo CommonConstants::SELLER_URL_SLUG;?>///list-user-wise-orders",
//                        success: function (result) {
////console.log(result);return false;
//                            $('#loading').css("display", "none");
//                            if (result == -1) {
//
//                            } else {
//                                $('#table-div').html(result)
//                            }
//                        },
//                        error: function (XMLHttpRequest, textStatus, errorThrown) {
//                            alert("Status: " + textStatus);
//                            alert("Error: " + errorThrown);
//                        }
//                    });
//                } else {
//                }
//
//        });

$(document).off('click', '#saveUserNewPass').on('click', '#saveUserNewPass', function () {

           if($('#newPasss').val()==''){
               $('#newPasssError').show().html('Please Enter password');
               $('#newPasss').focus();
               return false;
           }else if($('#confirmPass').val()==''){
                $('#confirmPassError').show().html('Please Enter Confirm password');
                $('#confirmPass').focus();
                return false;
           }else if($('#confirmPass').val()!= $('#newPasss').val()){
           	$('#newPasssError').show().html('Password does not match');
           	
                $('#newPasss').val('');
                $('#confirmPass').val('');
                return false;
           }else{
               $('#newPasssError').show().html('');
               $('#confirmPasssError').show().html('');
               $.ajax({
                 type : 'POST',
                   data : {password:$('#newPasss').val(), id :$('#user_id').val() },
                   url : '<?php echo base_url()?>seller/userPasswordUpdate',
                   success : function(result){
                    if(result == 1){
                        $('#successs').show().html('Password Change Successfully');
                        $('#newPasss').val('');
                        $('#confirmPass').val('');
                        $('#changePassModel').modal('hide');
                    }else{
                        $('#error').show().html('Error in change');
                        $('#newPasss').val('');
                        $('#confirmPass').val('');
                    }
                    }
               });
           }

        });


$(document).off('click', '.edit').on('click', '.edit', function (e) {
        e.preventDefault;
        
        var recordId = this.id;
	$('#user_id').val(recordId );
	$("#changePassModel").modal('show');
       

    });


    });


</script>
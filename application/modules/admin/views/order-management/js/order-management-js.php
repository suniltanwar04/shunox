<script>
    $(document).ready(function () {

        $(document).off('click', '.coupondetail').on('click', '.coupondetail', function (e) {

            e.preventDefault;
            var recordId = this.id;
            $('#loading').css("display", "block");
            $.ajax({
                type: "POST",
                data: {
                    'recordId': recordId
                },
                url: $('#baseUrl').val() + "<?php echo CommonConstants::ADMIN_URL_SLUG;?>/coupon-listing",
                success: function (result) {

                    $('#loading').css("display", "none");
                    $("#addOrderModal").modal('show');
                    $('#addOrderModal').html(result)
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    alert("Status: " + textStatus);
                    alert("Error: " + errorThrown);
                }
            });
        });

        

        $(document).off('change', '#currentstatusId').on('change', '#currentstatusId', function (e) {
            e.preventDefault;
            var str = this.value;
            var res = str.split("_");
            var currentstatusId = res[0];
            var recordId = res[1];


                $('#loading').css("display", "block");
                $.ajax({
                    type: "POST",
                    data: {
                        'currentstatusId': currentstatusId,
                        'recordId': recordId

                    },
                    url: $('#baseUrl').val() + "<?php echo CommonConstants::ADMIN_URL_SLUG;?>/current-status",
                    success: function (result) {
                      $('#loading').css("display", "none");
                      // console.log(result);return false;
                        if (result == 1) {
                          location.reload();
                        }
                    },
                    // error: function (XMLHttpRequest, textStatus, errorThrown) {
                    //     alert("Status: " + textStatus);
                    //     alert("Error: " + errorThrown);
                    // }
                });


        });
        
         $(document).off('change', '#order_status').on('change', '#order_status', function (e) {
            e.preventDefault;
            var recordId = $('#order_status').val();

  $('#loading').css("display", "block");
            $.ajax({
                type: "POST",
                data: {
                    'recordId': recordId

                },
                url: $('#baseUrl').val() + "<?php echo CommonConstants::ADMIN_URL_SLUG;?>/getstatusbyorder",
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
                        url: $('#baseUrl').val() + "<?php echo CommonConstants::ADMIN_URL_SLUG;?>/delete-order-management",
                        success: function (result) {

                            $('#loading').css("display", "none");
                            if (result == -1) {

                            } else {
                                window.location.reload();
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

        $(".changeCurrentStatus").click(function(){
            alert("Please change order status Placed to In Process.");

        });


        



    });


</script>

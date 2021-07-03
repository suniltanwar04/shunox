<script>
var adminBaseUrl = "<?php echo base_url().'admin/' ?>";
    /* API method to get paging information */
    $.fn.dataTableExt.oApi.fnPagingInfo = function (oSettings) {
        return {
            "iStart": oSettings._iDisplayStart,
            "iEnd": oSettings.fnDisplayEnd(),
            "iLength": oSettings._iDisplayLength,
            "iTotal": oSettings.fnRecordsTotal(),
            "iFilteredTotal": oSettings.fnRecordsDisplay(),
            "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
            "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
        };
    }


    $(document).ready(function () {
		    $('.datepicker').datepicker();
        hideError('addProductName');
        hideError('addCategoryId');
        hideError('addSubCatId');

        hideError('editCategoryId');
        hideError('editSubCatId');
        hideError('editCityName');


        $("#row-list").DataTable({
            "bAutoWidth": false,
            "bSort": true,
            "sScrollX": true,
            "iDisplayLength": 20,
            /* For enabling disabling sorting */
            "aoColumnDefs": [{'bSortable': false, 'aTargets': [0]}],
            /* For changing search bar text and pagination */
            "sPaginationType": "full_numbers",
            "oLanguage": {
                "sSearch": "<span>Search:</span> _INPUT_",
                "sLengthMenu": "Show _MENU_ entries",
                "sInfo": "Showing _START_ to _END_ of _TOTAL_ entries",
                "oPaginate": {"sFirst": "<<", "sLast": ">>", "sNext": ">", "sPrevious": "<"}
            },

            /* For customizing record length */
            "aLengthMenu": [[20, 30, 50, -1], [20, 30, 50, "All"]],
            /* Callback Function */
            "fnDrawCallback": function (oSettings) {
                pageIndex = this.fnPagingInfo().iPage;
//                    alert(pageIndex);

                /* Need to redo the counters if filtered or sorted */
                if (oSettings.bSorted || oSettings.bFiltered) {
                    for (var i = 0, iLen = oSettings.aiDisplay.length; i < iLen; i++) {
                        $('td:eq(0)', oSettings.aoData[oSettings.aiDisplay[i]].nTr).html(i + 1);
                    }
                }
            }
        });

    $("#itemType").on('change', function(){
        var key = $(this).val(),methodName;

        if(key != ''){
            //for all products value 1;
            if(key == 1){
                $("#item").html("<option value='0'>All Products</option>");
            }
            //for sub categories calling a method from adminCoupon
            if(key == 2){
                methodName = "subCategories";
            }
            //for sub allProducts calling a method from adminCoupon

            if(key == 3){
                methodName = "allProducts";
            }
        }else{
            $("#item").html("<option value=''>Select Item</option>");
            return false;
        }

        $.ajax({
                url:adminBaseUrl+"AdminCoupon/"+methodName,
                type:"post",
                cache:false,
                success:function(result){
                    $("#item").html(result);
                }
            });
    });

       $("#addCouponBtn").on("click", function(e){
        e.preventDefault();
        var btn  = $(this);
            if(validateMe('validate')){
                var formData = new FormData($("#couponAddForm")[0]);
                btn.text("Please Wait . . .").attr("disabled","disabled");
                $.ajax({
                    url:adminBaseUrl+"AdminCoupon/addCoupon",
                    type:"POST",
                    data:formData,
                    contentType:false,
                    processData:false,
                    cache:false,
                    success:function(result){
                    btn.text("Add Coupon").removeAttr("disabled");
                        if(result == -1){
                            $("#addCouponError").text("Coupon Already Exists !").css("color","red");
                        }else if(result == 1){
                            window.location.reload();
                        }else{
                            $("#addCouponError").text("Something went wrong. Please Try Again later !").css("color","red");
                        }
                    }
                })
            }
    });


    });


</script>

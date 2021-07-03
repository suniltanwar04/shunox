<script>
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

        // $(window).load(function(){
        //
        // $('#colorId').hide();
        //       $('#sizeId').hide();
        //       $('#lengthId').hide();
        //
        // });

        $(document).off('change', '#ProductsAttr').on('change', '#ProductsAttr', function(){
            var attrId = $(this).val();
            var subCat = $("#SubCategoryId").val();
            $.ajax({
                url: "<?php echo base_url().CommonConstants::ADMIN_URL_SLUG;?>/AdminProduct/getAttributeVals",
                type:'post',
                data:{id:attrId, subCat:subCat},
                success:function(result){
                    if(result != ""){
                        $("#SelectAttrValSection").slideDown();
                        $("#SelectAttrVal").html(result);
                    }else{
                        $("#SelectAttrValSection").slideUp();
                    }
                }
            });

        });

        checkNumeric('ProductPrice');
        $(document).off('click', '#saveProductAttr').on('click', '#saveProductAttr', function (e) {
            var message = $("#AttributeInsertionResult");
            var attr = $("#ProductsAttr").val();
            var price = parseInt($.trim($("#ProductPrice").val()));
            var discountPrice = parseInt($.trim($("#discountPrice").val()));
            if(attr == ""){
                $("#ProductsAttrError").text('Choose a product attribute');
            }else if(price == ""){
                $("#ProductsAttrError").text('');
                $("#ProductPriceError").text('Enter the price');
            }else if(discountPrice > price){
              $("#ProductPriceError").text('');
              $("#discountPriceError").text('Discount Price Can\'t be more than price !');
            }else{
                $("#discountPriceError").text('');
                var formData = new FormData($("#productAttrAddForm")[0]);
                $.ajax({
                    type: "POST",
                    data:formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    url: "<?php echo base_url().CommonConstants::ADMIN_URL_SLUG;?>/saveProductAttr",
                    success: function (result){
                        if(result == 1){
                            message.html('Attribute Added Successfully !');
                            message.removeClass('text-danger').addClass('text-success');
                            setTimeout(function(){
                                window.location.reload();
                            },3000);
                        }

                        if(result == -1){
                            message.html('Attribute With this product is already added !');
                            message.removeClass('text-success').addClass('text-danger');
                        }
                    }

                });
            }

         });
		 $(document).off('click', '#saveImageAttr').on('click', '#saveImageAttr', function (e) {
			 $('#saveImageAttr').prop("disabled", true);
            var message = $("#ImageInsertionResult");
           
                $("#discountPriceError").text('');
                var formData = new FormData($("#productImageAddForm")[0]);
                $.ajax({
                    type: "POST",
                    data:formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    url: "<?php echo base_url().CommonConstants::ADMIN_URL_SLUG;?>/saveImageAttr",
                    success: function (result){
						console.log(result);
                        if(result == "success"){
                            message.html('Images Added Successfully !');
                            message.removeClass('text-danger').addClass('text-success');
                            setTimeout(function(){
                                window.location.reload();
                            },3000);
                        }
						else{
							 message.html('Somethoing went wrong !');
						}
						
						$('#saveImageAttr').removeAttr("disabled");
						
                    }

                });

         });


        $(document).off('click', '#addProduct').on('click', '#addProduct', function (e) {
            e.preventDefault;
            $("#addFromError").html('');
            $("#addCategoryId").val('');
            $("#addSubCatId").val('');
            $("#addProductName").val('');
            $("#addPrice").val('');
            $("#addDesc").val('');
            $("#addQuantity").val('');
            $("input[name='addDiscountType']:checked").val('');
            $("#addDiscountValue").val('');

            $("#addCategoryIdError").hide().html('');
            $("#addStateIdError").hide().html('');
            $("#addCityNameError").hide().html('');

        });



        $(document).off('click', '#saveProduct').on('click', '#saveProduct', function (e) {
            e.preventDefault;

            var addCategoryId = $("#addCategoryId").val();
            var addSubcatId = $("#addSubcatId").val();
            var addProductName = $("#addProductName").val();
            var addPrice = $("#addPrice").val();
            var addDesc = $("#addDesc").val();
            var addQuantity = $("#addQuantity").val();
            var addDiscountType = $("#addDiscountType").val();
            var addDiscountValue = $("#addDiscountValue").val();

            var addimage = $("#addimage").val();
            if(addimage){
                var addimageFile = $("#addimage")[0].files;

            }

            var addThumbImage1 = $("#addThumbImage1").val();
            if(addThumbImage1){
                var addThumbImage1File = $("#addThumbImage1")[0].files;
            }
            var addThumbImage2 = $("#addThumbImage2").val();
            if(addThumbImage2){
                var addThumbImage2File = $("#addThumbImage2")[0].files;
            }
            var addThumbImage3 = $("#addThumbImage3").val();
            if(addThumbImage3){
                var addThumbImage3File = $("#addThumbImage3")[0].files;
            }
            var addThumbImage4 = $("#addThumbImage4").val();
            if(addThumbImage4){
                var addThumbImage4File = $("#addThumbImage4")[0].files;

            }
            var addThumbImage5 = $("#addThumbImage5").val();
            if(addThumbImage5){
                var addThumbImage5File = $("#addThumbImage5")[0].files;

            }
            var addThumbImage6 = $("#addThumbImage6").val();
            if(addThumbImage6){
                var addThumbImage6File = $("#addThumbImage6")[0].files;

            }
            var addThumbImage7 = $("#addThumbImage7").val();
            if(addThumbImage7){
                var addThumbImage7File = $("#addThumbImage7")[0].files;

            }


            if (!addCategoryId) {
                $("#addCategoryIdError").show().html('Please select category.');
                $("#addCategoryId").focus();
                return false;
            } else if (!addSubcatId) {

                $("#addSubCatIdError").show().html('Please select sub-category.');
                $("#addSubCatId").focus();
                return false;
            } else if (!addProductName) {
                $("#addProductNameError").show().html('Please enter product.');
                $("#addProductName").focus();
                return false;
            }else if(!addPrice){
                $("#addPriceNameError").show().html('Please enter price.');
                $("#addPrice").focus();
            }else if(!addDesc){
                $("#addProductDescError").show().html('Please enter description.');
                $("#addDesc").focus();
            }else if(!addQuantity){
                $("#addProductQuantityError").show().html('Please enter quantity.');
                $("#addQuantity").focus();
            }else if(!addDiscountType){
                $("#addProductDiscountTypeError").show().html('Please enter discount Type.');
                $("#addDiscountType").focus();
            }else if(!addimageFile){
//                ("#addProductImageError").show().html('Please Select image.');
                bootbox.alert("Please Select Image !", function(){ /* your callback code */ })
                return false;
            }else {

                $('#loading').css("display", "block");
                var formData = new FormData($("#productAddForm")[0]);
                $.ajax({
                    type: "POST",
                    data:formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    url: $('#baseUrl').val() + "<?php echo CommonConstants::ADMIN_URL_SLUG;?>/saveProduct",
                    success: function (result) {
//                        console.log(result);return false;
                        $('#loading').css("display", "none");
                        if (result == -1) {
                            $("#addCityNameError").show().html('product already existing.');
                        } else if (result == -2) {
                            $("#addFromError").show().html("<div class='col-lg-12'><div class='alert alert-danger alert-dismissible' style='text-align: center;'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>�</button>Unable to add Product; please try later.</div></div>")
                        } else {
                            $('#table-div').html(result)
                            $('#addCityModal').modal("hide");
                        }
                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        alert("Status: " + textStatus);
                        alert("Error: " + errorThrown);
                    }
                });
            }
        });


        $(document).off('click', '.edit').on('click', '.edit', function (e) {

            e.preventDefault;

            var recordId = this.id;
            $('#loading').css("display", "block");
            $.ajax({
                type: "POST",
                data: {
                    'recordId': recordId
                },
                url: $('#baseUrl').val() + "<?php echo CommonConstants::ADMIN_URL_SLUG;?>/editProduct",
                success: function (result) {
                    console.log(result);
//                return false;
                    $('#loading').css("display", "none");
                    $("#editCityModal").modal('show');
                    $('#editCityModal').html(result)
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    alert("Status: " + textStatus);
                    alert("Error: " + errorThrown);
                }
            });
        });
        $(document).off('click', '#updateProduct').on('click', '#updateProduct', function (e) {
            e.preventDefault;

            var editCategoryId = $("#editCategoryId").val();
            var editSubCatId = $("#editSubCatId").val();
            var editProductName = $("#editProductName").val();
            var editPrice = $("#editPrice").val();
            var editDesc = $("#editDesc").val();
            var editQuantity = $("#editQuantity").val();
            var addDiscountType = $("input[name='editDiscountType']:checked").val();

            var editDiscountValue = $("#editDiscountValue").val();
            var image = [];
            var previewimg = [];
            for(var i=0;i<= 7;i++){

                var editimg =$("#editThumbImage"+i).val();


                if(!editimg){
                    var previewimg = $("#hiddenimage"+i).val();

                }else{

                    var image = editimg;
                }

            }



            if (!editCategoryId) {
                $("#editCategoryIdError").show().html('Please select category.');
                $("#editCategoryId").focus();
                return false;
            } else if (!editSubCatId) {
                $("#editStateIdError").show().html('Please select sub-category.');
                $("#editSubCatId").focus();
                return false;
            } else if (!editProductName) {
                $("#editCityNameError").show().html('Please enter product.');
                $("#editCityName").focus();
                return false;
            } else {
                $('#loading').css("display", "block");

                var formEditData = new FormData($("#producteditForm")[0]);
                $.ajax({
                    type: "POST",
                    data:formEditData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    url: $('#baseUrl').val() + "<?php echo CommonConstants::ADMIN_URL_SLUG;?>/updateProduct",
                    success: function (result) {
//                    console.log(result);
//                    return false;
                        $('#loading').css("display", "none");
                        if (result == -1) {
                            $("#editCityNameError").show().html('City already existing.');
                        } else if (result == -2) {
                            $("#editFromError").show().html("<div class='col-lg-12'><div class='alert alert-danger alert-dismissible' style='text-align: center;'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>�</button>Unable to update category; please try later.</div></div>")
                        } else {
                            $('#table-div').html(result)
                            $('#editCityModal').modal("hide");
                        }
                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        alert("Status: " + textStatus);
                        alert("Error: " + errorThrown);
                    }
                });
            }
        });


        $(document).off('click', '.deactivate').on('click', '.deactivate', function (e) {
            e.preventDefault;
            var recordId = this.id;

            bootbox.confirm("Are you sure to disable this record?", function (result) {
                if (result == true) {
                    $('#loading').css("display", "block");
                    $.ajax({
                        type: "POST",
                        data: {
                            'recordId': recordId,
                            'isActive': 0
                        },
                        url: $('#baseUrl').val() + "<?php echo CommonConstants::ADMIN_URL_SLUG;?>/enableDisableProduct",
                        success: function (result) {
                            $('#loading').css("display", "none");
//                        console.log(result);
//                        return false;
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
                    $('#loading').css("display", "block");
                    $.ajax({
                        type: "POST",
                        data: {
                            'recordId': recordId,
                            'isActive': 1
                        },
                        url: $('#baseUrl').val() + "<?php echo CommonConstants::ADMIN_URL_SLUG;?>/enableDisableProduct",
                        success: function (result) {

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


        $(document).off('change', '#addCategoryId').on('change', '#addCategoryId', function (e) {
            e.preventDefault;
            var addCategoryId = $("#addCategoryId").val();

            $('#loading').css("display", "block");
            $.ajax({
                type: "POST",
                data: {
                    'addCategoryId': addCategoryId
                },
                url: $('#baseUrl').val() + "<?php echo CommonConstants::ADMIN_URL_SLUG;?>/getSubCategoryByCategory",
                success: function (result) {

                    $('#loading').css("display", "none");
                    $('#addSubcatId').html(result)
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
                        url: $('#baseUrl').val() + "<?php echo CommonConstants::ADMIN_URL_SLUG;?>/deleteProduct",
                        success: function (result) {

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


        $(document).off('keyup', '#addProductName').on('keyup', '#addProductName', function (e) {
            e.preventDefault();

            var regex = /^[A-Z a-z -]+$/;
            var fieldValue = $('#addProductName').val();

            if (!regex.test(fieldValue)) {
                $('#addProductNameError').show().html('Please enter alphabets Only.');
                $('#addProductName').focus();
                return false;
            } else {
                $('#addProductNameError').hide().html('');
                return true;
            }


        });

        $(document).off('keyup', '#addPrice').on('keyup', '#addPrice', function (e) {
            e.preventDefault();

            var regex = /^[0-9 -]+$/;
            var fieldValue = $('#addPrice').val();

            if (!regex.test(fieldValue)) {
                $('#addPriceNameError').show().html('Please enter numbers Only.');
                $('#addPrice').focus();
                return false;
            } else {
                $('#addPriceNameError').hide().html('');
                return true;
            }


        });

        $(document).off('keyup', '#addQuantity').on('keyup', '#addQuantity', function (e) {
            e.preventDefault();

            var regex = /^[0-9 -]+$/;
            var fieldValue = $('#addQuantity').val();

            if (!regex.test(fieldValue)) {
                $('#addProductQuantityError').show().html('Please enter numbers Only.');
                $('#addQuantity').focus();
                return false;
            } else {
                $('#addProductQuantityError').hide().html('');
                return true;
            }


        });

        $(document).off('keyup', '#addDiscountValue').on('keyup', '#addDiscountValue', function (e) {
            e.preventDefault();

            var regex = /^[0-9 -]+$/;
            var fieldValue = $('#addDiscountValue').val();

            if (!regex.test(fieldValue)) {
                $('#addProductDiscountValueError').show().html('Please enter numbers Only.');
                $('#addDiscountValue').focus();
                return false;
            } else {
                $('#addProductDiscountValueError').hide().html('');
                return true;
            }


        });


        $(document).off('keyup', '#editProductName').on('keyup', '#editProductName', function (e) {
            e.preventDefault();

            var regex = /^[A-Z a-z -]+$/;
            var fieldValue = $('#editProductName').val();

            if (!regex.test(fieldValue)) {
                $('#editProductNameError').show().html('Please enter alphabets Only.');
                $('#editProductName').focus();
                return false;
            } else {
                $('#editProductName').hide().html('');
                return true;
            }


        });

        $(document).off('keyup', '#editPrice').on('keyup', '#editPrice', function (e) {
            e.preventDefault();

            var regex = /^[0-9 -]+$/;
            var fieldValue = $('#editPrice').val();

            if (!regex.test(fieldValue)) {
                $('#editPriceError').show().html('Please enter numbers Only.');
                $('#editPrice').focus();
                return false;
            } else {
                $('#editPriceError').hide().html('');
                return true;
            }


        });

        $(document).off('keyup', '#editQuantity').on('keyup', '#editQuantity', function (e) {
            e.preventDefault();

            var regex = /^[0-9 -]+$/;
            var fieldValue = $('#editQuantity').val();

            if (!regex.test(fieldValue)) {
                $('#editQuantityError').show().html('Please enter numbers Only.');
                $('#editQuantity').focus();
                return false;
            } else {
                $('#editQuantityError').hide().html('');
                return true;
            }


        });

        $(document).off('keyup', '#editDiscountValue').on('keyup', '#editDiscountValue', function (e) {
            e.preventDefault();

            var regex = /^[0-9 -]+$/;
            var fieldValue = $('#editDiscountValue').val();

            if (!regex.test(fieldValue)) {
                $('#editDiscountValueError').show().html('Please enter numbers Only.');
                $('#editDiscountValue').focus();
                return false;
            } else {
                $('#editDiscountValueError').hide().html('');
                return true;
            }


        });



        var next = 1;
        $(".add-more").click(function(e){
            e.preventDefault();
            var addto = "#field" + next;
            var addRemove = "#field" + (next);
            next = next + 1;
            var newIn = '<input autocomplete="off" class="input form-control" id="field' + next + '" name="field' + next + '" type="file">';
            var newInput = $(newIn);
            var removeBtn = '<button id="remove' + (next - 1) + '" class="btn btn-danger remove-me" >-</button></div><div id="field">';
            var removeButton = $(removeBtn);
            $(addto).after(newInput);
            $(addRemove).after(removeButton);
            $("#field" + next).attr('data-source',$(addto).attr('data-source'));
            $("#count").val(next);

            $('.remove-me').click(function(e){
                e.preventDefault();
                var fieldNum = this.id.charAt(this.id.length-1);
                var fieldID = "#field" + fieldNum;
                $(this).remove();
                $(fieldID).remove();
            });
        });

        $(document).off('dblclick','.editablePrice').on('dblclick','.editablePrice', function(){
            var input = $(this);
            input.removeAttr("readonly");
            input.focus();
        });

        $(".editablePrice").on('blur', function(){
          var input = $(this);
          var price = input.val();
          var attributePriceId = input.attr("attributePriceId");
          var InProduct = parseInt(input.attr("InProduct"));
          var ProductId = parseInt(input.attr("ProductId"));
          var title = input.attr("title");
          if(isNaN(price)){
              input.focus();
              return false;
          }

          input.attr("readonly","readonly");

          $("#loading").fadeIn(200);
          $.ajax({
            url: "<?php echo base_url().CommonConstants::ADMIN_URL_SLUG;?>/AdminProduct/updateAttributePrice",
              type:"POST",
              data:{price:price,coloum:title,inProduct:InProduct, attributePriceId:attributePriceId,productId:ProductId},
              cache:false,
              success:function(data){
                $("#loading").fadeOut(200);
                // console.log(data);
              }
          })


        });

    });
	
</script>

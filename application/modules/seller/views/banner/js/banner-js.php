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

        // hideError('addCategoryId');
        checkNumeric('addPrice');
        checkNumeric('discountPrice');
        checkNumeric('addQuantity');
        $(document).off('click', '#saveBanner').on('click', '#saveBanner', function(e){
            e.preventDefault;
            var status1 = false, status2 = false;
            
           
            var addName = $.trim($("#addName").val());
           
            var addimage = $("#addimage").val();


           if (!addName){
                $("#addNameError").show().html('Please enter product.');
                $("#addName").focus();
            }else {
                status1 = true;
            }


            if(addimage != ""){
                var type = $("#addimage")[0].files[0].type;
                var ext = type.split('/').pop().toLowerCase()
                if(ext == 'jpeg' || ext == 'jpg' || ext == 'png'){
                    status2 = true;
                }else{
                    $("#addimageError").text('Only jpg, png file format is allowed');
                }
            }else{
                $("#addimageError").text('Choose an image for the product');
            }

            if(status1 === true && status2 === true){
                $('#loading').css("display", "block");
                var formData = new FormData($("#bannerAddForm")[0]);
                    $.ajax({
                        type: "POST",
                        data:formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        url: $('#baseUrl').val() + "<?php echo CommonConstants::SELLER_URL_SLUG;?>/saveBanner",
                        success: function (result) {
                            $('#loading').css("display", "none");
                            if (result == -1) {
                                //$("#addCityNameError").show().html('product already existing.');
                            } else if (result == -2) {
                                $("#addFromError").show().html("<div class='col-lg-12'><div class='alert alert-danger alert-dismissible' style='text-align: center;'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>Unable to add Product; please try later.</div></div>")
                            } else {
                                window.location.reload();
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
                url: $('#baseUrl').val() + "<?php echo CommonConstants::SELLER_URL_SLUG;?>/editProduct",
                success: function (result) {
                    $('#loading').css("display", "none");
                    $("#producteditForm").modal('show');
                    $('#editCityModal').html(result)
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    alert("Status: " + textStatus);
                    alert("Error: " + errorThrown);
                }
            });
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
                        url: $('#baseUrl').val() + "<?php echo CommonConstants::SELLER_URL_SLUG;?>/enableDisableBanner",
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
                        url: $('#baseUrl').val() + "<?php echo CommonConstants::SELLER_URL_SLUG;?>/enableDisableBanner",
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
                        url: $('#baseUrl').val() + "<?php echo CommonConstants::SELLER_URL_SLUG;?>/deleteBanner",
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


        //Shobhit Singh


        $("#AddProductAttr").on('change', function(){
           var proAttrId = $(this).val();
            var subCatId = $("#addSubcatId").val();

            if(proAttrId != "" && subCatId != ""){
                $.ajax({
                    type: "POST",
                    data:{attrId:proAttrId, subCatId:subCatId},
                    cache: false,
                    url: $('#baseUrl').val() + "<?php echo CommonConstants::SELLER_URL_SLUG;?>/AdminProduct/getAttributeValue",
                    success:function(result){
                        $("#AttributeValueSection").slideDown();
                        $("#AddProductAttrValue").append(result);
                    }
                });
            }

        });


        $("#addSubcatId").on('change', function(){
            var subCategory = $(this).val();

            $.ajax({
                url:$('#baseUrl').val()+"<?php echo CommonConstants::SELLER_URL_SLUG;?>/AdminProduct/getAttributesBysubCategory",
                type:"POST",
                data:{subCategory:subCategory},
                cache:false,
                success:function(data){
                  if(data.indexOf("No") > 0){
                    $("#AttributeValueSection").slideUp();
                    $("#AddProductAttrValue").html("");
                  }
                  $("#AddProductAttr").html(data);
                }
            });
        });

        $("#product_edit_form").on('submit', function(){
        var formData = new FormData($("#product_edit_form")[0]);
        $("#loading").fadeIn(200);
          $.ajax({
            url:$('#baseUrl').val()+"<?php echo CommonConstants::SELLER_URL_SLUG;?>/AdminProduct/updateProduct",
            type:"POST",
            data:formData,
            cache:false,
            contentType:false,
            processData:false,
            success:function(data){
              $("#loading").fadeOut(200);
              // console.log(data);
              // return false;
              if(data == 1){
                window.location.href = '<?php echo base_url().'seller/product'  ?>'
              }
            }
          });

          return false;

        });

        $(document).off('click','#generateExcel').on('click','#generateExcel', function(){
            $.ajax({
                url:'<?php echo base_url().'seller/AdminProduct/generateExcel'  ?>',
                type:"POST",
                cache:false,
                success:function(result){
                  // console.log(result);
                  // return false;
                  if(result == 1){
                    $("#generateExcel").fadeOut();
                    $("#downloadCSV").fadeIn();
                  }
                }
            });
        });

        $("#csvUpload").on('submit', function(){
            var csv = $("#productCsv").val();
            if(csv == ""){ return false; }

            var ext = csv.split(".").pop().toLowerCase();
            if(ext == "csv"){
              $("#loading").fadeIn(100);
              var formData = new FormData($("#csvUpload")[0]);
              $.ajax({
                  url:'<?php echo base_url().'seller/AdminProduct/uploadExcel'  ?>',
                  type:"POST",
                  data:formData,
                  cache:false,
                  processData:false,
                  contentType:false,
                  success:function(result){
                      $("#loading").fadeOut(100);
                      // console.log(result);
                      // return false;
                    if(result == 1){
                      window.location.reload();
                    }else{
                      $("#CSVError").text("Something went wrong. Please Try Again Later !");
                    }
                  }
              });
            }else{
              $("#CSVError").text("Choosen file is not a supported type. Please upload csv file");
            }
            return false;
        });

        $("#ProductImages").on('submit', function(){
            var images = $("#productImage").val();
            if(images == ""){ return false; }
            var ext = images.split(".").pop().toLowerCase();
            if(ext == "jpg" || ext == "png" || ext == "jpeg"){
              $("#loading").fadeIn(100);
              var formData = new FormData($("#ProductImages")[0]);
              $.ajax({
                  url:'<?php echo base_url().'seller/AdminProduct/uploadProductImages'  ?>',
                  type:"POST",
                  data:formData,
                  cache:false,
                  processData:false,
                  contentType:false,
                  success:function(result){
                      $("#loading").fadeOut(100);
                      // console.log(result);
                      // return false;
                    if(result > 0){
                      window.location.reload();
                    }else{
                      $("#CSVError").text("Something went wrong. Please Try Again Later !");
                    }
                  }
              });
            }else{
              $("#CSVError").text("Choosen file type is not allowed !");
            }
            return false;
        });

    });


</script>

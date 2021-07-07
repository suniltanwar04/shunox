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

        hideError('addProductId');
        hideError('addAttributevalueid');

        hideError('editCategoryId');
        hideError('editSubCategoryName');



        $("#row-list").DataTable({
            "bAutoWidth": false,
            "bSort": true,
            "sScrollX": true,
            "iDisplayLength": 10,
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
            "aLengthMenu": [[10, 20, 50, -1], [10, 20, 50, "All"]],
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


        $(document).off('click', '#addSubcat').on('click', '#addSubcat', function (e) {
            e.preventDefault;
            $("#addFromError").html('');

            $("#addProductId").val('');
            $("#addAttributevalueid").val('');

            $("#addSubCatIdError").hide().html('');
            $("#addAttributeIdError").hide().html('');
            $("#addattributeValueError").hide().html('');



        });
        $(document).off('click', '#saveAttributeMapping').on('click', '#saveAttributeMapping', function (e) {
            e.preventDefault;

            var addProductId = $("#addProductId").val();
            var addAttributevalueid = $("#addAttributevalueid").val();

            if (!addProductId) {
                $("#addSubCatIdError").show().html('Please select proudct.');
                $("#addSubCatId").focus();
                return false;
            } else if (!addAttributevalueid) {
                $("#addAttributeIdError").show().html('Please select attribute value.');
                $("#addAttribute").focus();
                return false;
            } else {

                $('#loading').css("display", "block");

                $.ajax({
                    type: "POST",
                    data: {
                        'addProductId': addProductId,
                        'addAttributevalueid': addAttributevalueid

                    },
                    url: $('#baseUrl').val() + "<?php echo CommonConstants::SELLER_URL_SLUG;?>/saveAttributeMapping",

                    success: function (result) {
//                        console.log(result);return false;

                        $('#loading').css("display", "none");

                        if (result == -1) {
                            $("#addSubCatNameError").show().html('attribute value already existing.');
                        } else if (result == -2) {
                            $("#addFromError").show().html("<div class='col-lg-12'><div class='alert alert-danger alert-dismissible' style='text-align: center;'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Unable to add add attribute value; please try later.</div></div>")
                        } else {
                            location.reload();
                            $('#table-div').html(result)
                            $('#addCategoryModal').modal("hide");
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

            if (recordId) {
                $('#loading').css("display", "block");
                $.ajax({
                    type: "POST",
                    data: {
                        'recordId': recordId
                    },
                    url: $('#baseUrl').val() + "<?php echo CommonConstants::SELLER_URL_SLUG;?>/editAttributeMapping",
                    success: function (result) {
//                        console.log(result);return false;
                        $('#loading').css("display", "none");



                        if (result == -1) {

                        } else {

                            $('#editAttributeMappingModel').modal('show');

                            $('#editAttributeMappingModel').html(result)
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


        $(document).off('click', '#updateAttributeMapping').on('click', '#updateAttributeMapping', function (e) {
            e.preventDefault;
            var editProductId = $("#editProductId").val();
            var editAttributeMappingId = $("#editAttributeMappingId").val();
            var recordId = $('#editRecordId').val();

            if (!editProductId) {
                $("#editProductIdError").show().html("Please select product.");
                $("#editProductId").focus();
                return false;
            } else if (!editAttributeMappingId) {
                $("#editAttributeMappingIdError").show().html("Please select attribute value.");
                $("editAttributeMappingId").focus();
                return false;
            }else {
                $('#loading').css("display", "block");
                $.ajax({
                    type: "POST",
                    data: {
                        'editProductId': editProductId,
                        'editAttributeMappingId': editAttributeMappingId,
                        'recordId': recordId
                    },
                    url: $('#baseUrl').val() + "<?php echo CommonConstants::SELLER_URL_SLUG;?>/updateAttributeMapping",
                    success: function (result) {
                        $('#loading').css("display", "none");
//                        console.log(result);
//                        return false;
                        if (result == -1) {
                            $("#editSubCatNameError").show().html('sub-category already existing.');
                        } else {
                            location.reload();
                            $('#editStateModal').modal('hide');
                            $('#table-div').html(result)
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
                        url: $('#baseUrl').val() + "<?php echo CommonConstants::SELLER_URL_SLUG;?>/enableDisableAttributeMapping",
                        success: function (result) {

                            $('#loading').css("display", "none");
//                            console.log(result);
//                            return false;
                            if (result == -1) {

                            } else {
                                location.reload();
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
                        url: $('#baseUrl').val() + "<?php echo CommonConstants::SELLER_URL_SLUG;?>/enableDisableAttributeMapping",
                        success: function (result) {
                            $('#loading').css("display", "none");
//                            console.log(result);
                            //return false;
                            if (result == -1) {

                            } else {
                                location.reload();
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


        $(document).off('keyup', '#addSubcatName').on('keyup', '#addSubcatName', function (e) {
            e.preventDefault();

            var regex = /^[A-Za-z0-9 -]+$/;
            var fieldValue = $('#addSubcatName').val();

            if (!regex.test(fieldValue)) {
                $('#addSubCatNameError').show().html('Please enter alphabets, numbers or dash.');
                $('#addCategoryNameError').focus();
                return false;
            } else {
                $('#addSubCatNameError').hide().html('');
                return true;
            }


        });

        $(document).off('keyup', '#editSubcatName').on('keyup', '#editSubcatName', function (e) {
            e.preventDefault();

            var regex = /^[A-Za-z0-9 -]+$/;
            var fieldValue = $('#editSubcatName').val();

            if (!regex.test(fieldValue)) {
                $('#editSubCatNameError').show().html('Please enter alphabets, numbers or dash.');
                $('#editSubCatNameError').focus();
                return false;
            } else {
                $('#editSubCatNameError').hide().html('');
                return true;
            }


        });




    });


</script>
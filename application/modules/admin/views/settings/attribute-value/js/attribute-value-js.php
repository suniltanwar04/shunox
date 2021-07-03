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

        hideError('addSubCategoryName');
        hideError('addCategoryId');

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


        $(document).off('click', '#addAttribute').on('click', '#addAttribute', function (e) {
            e.preventDefault;
            $("#addFromError").html('');


            $("#addSubCatId").val('');
            $("#addAttributeid").val('');
            $("#addAttributeValue").val('');
            $("#addSubCatIdError").hide().html('');
            $("#addAttributeIdError").hide().html('');
            $("#addattributeValueError").hide().html('');

            $("#addCountryIdError").hide().html('');

        });
        $(document).off('click', '#saveAttributeValue').on('click', '#saveAttributeValue', function (e) {
            e.preventDefault;
            var addSubCatId = $("#addSubCatId").val();
            var addAttributeid = $("#addAttributeid").val();
            var addAttributeValue = $("#addAttributeValue").val();

            if (!addSubCatId) {
                $("#addSubCatIdError").show().html('Please select sub category.');
                $("#addSubCatId").focus();
                return false;
            } else if (!addAttributeid) {
                $("#addAttributeIdError").show().html('Please select attribute.');
                $("#addAttribute").focus();
                return false;
            } else if (!addAttributeValue) {
                $("#addattributeValueError").show().html('Please select attribute Value.');
                $("#addAttribute").focus();
                return false;
            } else {
                $('#loading').css("display", "block");
                $.ajax({
                    type: "POST",
                    data: {
                        'addSubCatId': addSubCatId,
                        'addAttributeid': addAttributeid,
                        'addAttributeValue': addAttributeValue
                    },
                    url: $('#baseUrl').val() + "<?php echo CommonConstants::ADMIN_URL_SLUG;?>/saveAttributeValue",
                    success: function (result) {
                        //  console.log(result);return false;

                        $('#loading').css("display", "none");

                        if (result == -1) {
                            $("#addattributeValueError").show().html('attribute value already existing.');
                        } else if (result == -2) {
                            $("#addFromError").show().html("<div class='col-lg-12'><div class='alert alert-danger alert-dismissible' style='text-align: center;'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>�</button>Unable to add add attribute value; please try later.</div></div>")
                        } else {

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
                    url: $('#baseUrl').val() + "<?php echo CommonConstants::ADMIN_URL_SLUG;?>/editAttributeValue",
                    success: function (result) {
//                        console.log(result);return false;
                        $('#loading').css("display", "none");


                        if (result == -1) {

                        } else {

                            $('#editCategoryModel').modal('show');

                            $('#editCategoryModel').html(result)
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


        $(document).off('click', '#updateAttributeValue').on('click', '#updateAttributeValue', function (e) {
            e.preventDefault;
            var editSubCatValueId = $("#editSubCatValueId").val();
            var editAttributevalueId = $("#editAttributevalueId").val();
            var editAttributValue = $("#editAttributValue").val();

            var recordId = $('#editRecordId').val();
            if (!editSubCatValueId) {
                $("#editSubCatIdError").show().html("Please select sub category.");
                $("#editSubCatId").focus();
                return false;
            } else if (!editAttributevalueId) {
                $("#editAttributeIdError").show().html("Please select attribute.");
                $("editAttriuteId").focus();
                return false;
            } else if (!editAttributValue) {
                $("#editAttributeIdError").show().html("Please select attribute value.");
                $("editAttributeValueError").focus();
            } else {
                $('#loading').css("display", "block");
                $.ajax({
                    type: "POST",
                    data: {
                        'editSubCatValueId': editSubCatValueId,
                        'editAttributevalueId': editAttributevalueId,
                        'editAttributValue': editAttributValue,
                        'recordId': recordId
                    },
                    url: $('#baseUrl').val() + "<?php echo CommonConstants::ADMIN_URL_SLUG;?>/updateAttributeValue",
                    success: function (result) {
                        $('#loading').css("display", "none");
//                        console.log(result);
//                        return false;
                        if (result == -1) {
                            $("#editSubCatNameError").show().html('sub-category already existing.');
                        } else {

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
                        url: $('#baseUrl').val() + "<?php echo CommonConstants::ADMIN_URL_SLUG;?>/enableDisableAttributeValue",
                        success: function (result) {

                            $('#loading').css("display", "none");
//                            console.log(result);
//                            return false;
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
                        url: $('#baseUrl').val() + "<?php echo CommonConstants::ADMIN_URL_SLUG;?>/enableDisableAttributeValue",
                        success: function (result) {
                            $('#loading').css("display", "none");
//                            console.log(result);
                            //return false;
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


        $(document).off('keyup', '#addAttributeValue').on('keyup', '#addAttributeValue', function (e) {
            e.preventDefault();

            var regex = /^[A-Za-z0-9 -]+$/;
            var fieldValue = $('#addAttributeValue').val();

            if (!regex.test(fieldValue)) {
                $('#addattributeValueError').show().html('Please enter alphabets, numbers or dash.');
                $('#addattributeValueError').focus();
                return false;
            } else {
                $('#addattributeValueError').hide().html('');
                return true;
            }


        });

        $(document).off('keyup', '#editAttributValue').on('keyup', '#editAttributValue', function (e) {
            e.preventDefault();

            var regex = /^[A-Za-z0-9 -]+$/;
            var fieldValue = $('#editAttributValue').val();

            if (!regex.test(fieldValue)) {
                $('#editAttributeValueError').show().html('Please enter alphabets, numbers or dash.');
                $('#editAttributeValueError').focus();
                return false;
            } else {
                $('#editAttributeValueError').hide().html('');
                return true;
            }


        });


//        $(document).off('change', '#addAttributeid').on('change', '#addAttributeid', function (e) {
//            e.preventDefault();
//            var attributeName = $("#addAttributeid option:selected").text().toLowerCase();
//
//            $.ajax({
//                type: "POST",
//                data: {
//                    'attributeName': attributeName
//                },
//                url: $('#baseUrl').val() + "<?php //echo CommonConstants::ADMIN_URL_SLUG;?>///color-picker-input",
//                success: function (result) {
////                    console.log(result);
////                    return false;
//                    $('#addattributeValueInputDiv').html(result)
//                },
//                error: function (XMLHttpRequest, textStatus, errorThrown) {
//                    alert("Status: " + textStatus);
//                    alert("Error: " + errorThrown);
//                }
//            });
//
//
//        });


    });


</script>

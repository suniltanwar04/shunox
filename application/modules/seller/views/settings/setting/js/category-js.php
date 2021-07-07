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


    $(document).off('click', '#saveCategory').on('click', '#saveCategory', function (e) {
        e.preventDefault;


        var addCategoryName = $("#addCategoryName").val();


        if (!addCategoryName) {
            $("#addCategoryNameError").show().html('Please enter category name.');
            $("#addCategoryName").focus();

            return false;
        } else {
            $('#loading').css("display", "block");
            var formData = new FormData($("#categoryAddForm")[0]);
            $.ajax({
                type: 'post',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                url: $('#baseUrl').val() + "<?php echo CommonConstants::SELLER_URL_SLUG;?>/admin-save-category",
                success: function (result) {
                    $('#loading').css("display", "none");

                    if (result == -1) {
                        $("#addCategoryNameError").show().html('category already existing.');
                    } else if (result == -2) {
                        $("#addFromError").show().html("<div class='col-lg-12'><div class='alert alert-danger alert-dismissible' style='text-align: center;'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Unable to add category; please try later.</div></div>")
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
        $("#editCountryError").html('');
        $("#editCountryCodeError").html('');
        var recordId = this.id;

        if (recordId) {
            $('#loading').css("display", "block");
            $.ajax({
                type: "POST",
                data: {
                    'recordId': recordId
                },

                url: $('#baseUrl').val() + "<?php echo CommonConstants::SELLER_URL_SLUG;?>/editCategories",
                success: function (result) {
                    $('#loading').css("display", "none");
                    if (result == -1) {

                    } else {
                        $("#editCategoryModel").modal('show');
                        $("#editCategoryModel").html(result);
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

    $(document).off('click', '#updateCategory').on('click', '#updateCategory', function (e) {
        e.preventDefault;
        var editCategoryName = $("#editCategoryName").val();
        var editRecordId = $("#editRecordId").val();


        if (!editCategoryName) {
            $("#editCountryError").show().html('Please enter category.');
            $("#editCountry").focus();
            return false;
        } else {
            $('#loading').css("display", "block");
            $.ajax({
                type: "POST",
                data: {
                    'editCategoryName': editCategoryName,
                    'recordId': editRecordId
                },
                url: $('#baseUrl').val() + "<?php echo CommonConstants::SELLER_URL_SLUG;?>/updatecategory",
                success: function (result) {

                    $('#loading').css("display", "none");
                    if (result == -1) {
                            alert("Category already existing");
//                        $("#editCategoryNameError").show().html('Category already existing.');
                        return false;
                    } else if (result == -2) {
                        $("#editFromError").show().html("<div class='col-lg-12'><div class='alert alert-danger alert-dismissible' style='text-align: center;'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Unable to update country; please try later.</div></div>")
                    } else {
//                        location.reload();
                        $('#table-div').html(result)
                        $('#editCategoryModel1').modal("hide");
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
                $.ajax({
                    type: "POST",
                    data: {
                        'recordId': recordId,
                        'isActive': 0
                    },
                    url: $('#baseUrl').val() + "<?php echo CommonConstants::SELLER_URL_SLUG;?>/enableDisableCategory",
                    success: function (result) {
//                        location.reload();
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
                    url: $('#baseUrl').val() + "<?php echo CommonConstants::SELLER_URL_SLUG;?>/enableDisableCategory",
                    success: function (result) {
//                        location.reload();
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


    $(document).off('keyup', '#addCategoryName').on('keyup', '#addCategoryName', function (e) {
        e.preventDefault();

        var regex = /^[A-Za-z -]+$/;
        var fieldValue = $('#addCategoryName').val();

        if (!regex.test(fieldValue)) {
            $('#addCategoryNameError').show().html('Please enter alphabets or dash.');
            $('#addCategoryNameError').focus();
            return false;
        } else {
            $('#addCategoryNameError').hide().html('');
            return true;
        }


    });

    $(document).off('keyup', '#editCategoryName').on('keyup', '#editCategoryName', function (e) {
        e.preventDefault();

        var regex = /^[A-Za-z -]+$/;
        var fieldValue = $('#editCategoryName').val();

        if (!regex.test(fieldValue)) {
            $('#editCategoryNameError').show().html('Please enter alphabets or dash.');
            $('#editCategoryNameError').focus();
            return false;
        } else {
            $('#editCategoryNameError').hide().html('');
            return true;
        }


    });


});


</script>
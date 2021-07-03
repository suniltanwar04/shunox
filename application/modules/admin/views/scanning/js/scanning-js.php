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





        $(document).off('click', '#saveLocation').on('click', '#saveLocation', function(e){
            e.preventDefault;
            var status1 = false, status2 = false;
            
           
            var addAddress = $.trim($("#addAddress").val());
            var addCompany = $("#company").val();
            var addCountry = $("#country").val();
            var addState = $("#state").val();
            var addCity = $("#city").val();
            var addPincode = $.trim($("#pincode").val());


           if (!addCompany){
                $("#addCompanyError").show().html('Please enter Company name.');
                $("#company").focus();
               return false;
            }else if (!addAddress){
                $("#addAddressError").show().html('Please enter address.');
                $("#addAddress").focus();
                return false;
            }else if(addCountry==''){
                $("#addCountryError").show().html('Select Country.');
                $("#country").focus();
                return false;
            }else
            if(addState==''){
                $("#addStateError").show().html('Select State.');
                $("#state").focus();
                return false;
            }else if(addCity==''){
                $("#addCityError").show().html('Select City.');
                $("#city").focus();
                return false;
            }else if(!addPincode){
                $("#addPincodeError").show().html('please enter pincode.');
                $("#pincode").focus();
                return false;
            }else {


                $('#loading').css("display", "block");
                var formData = new FormData($("#locationAddForm")[0]);
                $.ajax({
                    type: "POST",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    url: $('#baseUrl').val() + "<?php echo CommonConstants::ADMIN_URL_SLUG;?>/saveLocation",
                    success: function (result) {
                        $('#loading').css("display", "none");
                        if (result == -1) {

                        } else if (result == 2) {
                            $("#addFromError").show().html("<div class='col-lg-12'><div class='alert alert-danger alert-dismissible' style='text-align: center;'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>Unable to add location; please try later.</div></div>")
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
                url: $('#baseUrl').val() + "<?php echo CommonConstants::ADMIN_URL_SLUG;?>/editProduct",
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
                        url: $('#baseUrl').val() + "<?php echo CommonConstants::ADMIN_URL_SLUG;?>/enableDisableLocation",
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
                        url: $('#baseUrl').val() + "<?php echo CommonConstants::ADMIN_URL_SLUG;?>/enableDisableLocation",
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
                        url: $('#baseUrl').val() + "<?php echo CommonConstants::ADMIN_URL_SLUG;?>/deleteLocation",
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

        $(document).off('change', '#country').on('change', '#country', function (e) {
            e.preventDefault;

            var country = $("#country").val();

            $.ajax({
                type: "POST",
                data: {
                    'country': country
                },
                url: $('#base_url').val() + "getState",
                success: function (result) {

                    $('#state').html(result)
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    alert("Status: " + textStatus);
                    alert("Error: " + errorThrown);
                }
            });
        });

        $(document).off('change', '#state').on('change', '#state', function (e) {
            e.preventDefault;

            var state = $("#state").val();

            $.ajax({
                type: "POST",
                data: {
                    'state': state
                },
                url: $('#base_url').val() + "getCity",
                success: function (result) {

                    $('#city').html(result)
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    alert("Status: " + textStatus);
                    alert("Error: " + errorThrown);
                }
            });
        });

    });


</script>

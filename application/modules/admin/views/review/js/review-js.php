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



        checkNumeric('addPrice');
        checkNumeric('discountPrice');
        checkNumeric('addQuantity');




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
                        url: $('#baseUrl').val() + "<?php echo CommonConstants::ADMIN_URL_SLUG;?>/enable-disable-review",
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
                        url: $('#baseUrl').val() + "<?php echo CommonConstants::ADMIN_URL_SLUG;?>/enable-disable-review",
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
                            url: $('#baseUrl').val() + "<?php echo CommonConstants::ADMIN_URL_SLUG;?>/delete-review",
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















    });


</script>
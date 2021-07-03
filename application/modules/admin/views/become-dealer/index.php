<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Become A Dealer
            
        </h1>
    </section>
    <section class="content">
        <div class="row" id="page-msg" style="display: none;"></div>
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">&nbsp;</h3>
            </div>
            <div class="box-body">
                <div id="table-div">
                    <?php
                    if ($becomedealers) {
                        ?>
                        <table id="row-list" class="table table-bordered table-striped custom-table-head">
                            <thead>
                            <tr>
                                <th>S.No.</th>
                               
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Company</th>
                                <th>Created Date</th>
                                <th>Update Id</th>
                                <th>Action</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i = 1;
                            foreach ($becomedealers as $becomedealer) {
                                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    
                                    <td><?php echo $becomedealer->name; ?></td>
                                    <td><?php echo $becomedealer->email; ?></td>
                                    <td><?php echo $becomedealer->mobile; ?></td>
                                    <td><?php echo $becomedealer->company; ?></td>
                                    <td><?php echo $becomedealer->created_at; ?></td>
                                    <td> <a title="Edit" class="edit" id="<?php echo $becomedealer->id ?>">
                                            <i class="fa fa-edit"></i></a></td>
                                    <td><a href="<?php echo $this->config->item('admin_base_url') . 'view-become-detail/'.$becomedealer->id; ?>" class="fa fa-eye-slash" aria-hidden="true"></a>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a class="glyphicon glyphicon-trash" title="Delete" style="cursor: pointer;" id="<?php echo $becomedealer->id?>"></a>
                                    </td>

                                </tr>
                            <?php
                                $i++;
                            }
                            ?>
                            </tbody>
                        </table>
                    <?php
                    } else {
                        ?>
                        <table class="table table-bordered table-striped">
                            <tbody>
                            <tr>
                                <td class="dataTables_empty">No Records Found.</td>
                            </tr>
                            </tbody>
                        </table>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>



</div>
<script>
$(document).off('click', '.glyphicon').on('click', '.glyphicon', function (e) {
            e.preventDefault;
            var recordId = this.id;
            redirecturl = '<?php echo base_url()?>admin/become-dealer';

            bootbox.confirm("Are you sure want to delete this record?", function (result) {
                if (result == true) {
                    $('#loading').css("display", "block");
                    $.ajax({
                        type: "POST",
                        data: {
                            'recordId': recordId

                        },
                        url: $('#baseUrl').val() + "<?php echo CommonConstants::ADMIN_URL_SLUG;?>/delete-dealer",
                        success: function (result) {

                            $('#loading').css("display", "none");
                            if (result == -1) {

                            } else {
                               window.location.href = redirecturl;
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

            url: $('#baseUrl').val() + "<?php echo CommonConstants::ADMIN_URL_SLUG;?>/editDealer",
            success: function (result) {
                $('#loading').css("display", "none");

                    $("#dealerModal").modal('show');
                    $("#dealerModal").html(result);

            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                alert("Status: " + textStatus);
                alert("Error: " + errorThrown);
            }
        });
    } else {
    }

});

$(document).off('click', '#updateDealer').on('click', '#updateDealer', function (e) {
    e.preventDefault;
    var dealerId = $("#dealer_id").val();
    var editRecordId = $("#editRecordId").val();


    if (!dealerId) {
        $("#editIdError").show().html('Please enter id.');
        $("#dealer_id").focus();
        return false;
    } else {
        $('#loading').css("display", "block");
        $.ajax({
            type: "POST",
            data: {
                'dealer_id': dealerId,
                'recordId': editRecordId
            },
            url: $('#base_url').val() + "<?php echo CommonConstants::ADMIN_URL_SLUG;?>/updateDealer",
            success: function (result) {

                $('#loading').css("display", "none");
                if (result == -1) {

                    $("#editIdError").show().html('Id already existing.');

                } else {
                      location.reload();
                    //$('#table-div').html(result)
                    //$('#dealerModal').modal("hide");
                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                alert("Status: " + textStatus);
                alert("Error: " + errorThrown);
            }
        });
    }
});

</script>
<div class="modal fade" id="dealerModal" style="display: none;padding-top: 20px;" data-backdrop="static"
     data-keyboard="false"></div>
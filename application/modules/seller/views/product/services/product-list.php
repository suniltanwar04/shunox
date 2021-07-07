<?php
if ($products) {
    ?>
    <table id="row-list" class="table table-bordered table-striped custom-table-head">
        <thead>
        <tr>
            <th>S.No.</th>
            <th>Product</th>
            <th>Sub-Category</th>
            <th>Price</th>
            <th>Discounted Price</th>
            <th>Quantity</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($products as $product) {
            $isActive = CommonHelpers::getStatus($product->IsActive);
             $sub = $this->AdminCategory_model->getSubCatById($product->SubCategoryId);
            ?>
            <tr>
                <td></td>

                <td><?php echo $product->ProductName; ?></td>
                <?php if($sub!=''){?>
                <td><?php echo $sub->SubCategoryName; ?></td>
                <?php }else{?>
                <td></td>
                <?php }?>
                <td><?php echo $product->Price; ?></td>

                <td><?php echo $product->DiscountedPrice; ?></td>
                <td><?php echo $product->Quantity; ?></td>
                <td style="color: <?php echo $isActive->Color; ?>"><?php echo $isActive->Name; ?></td>
                <td>
                  <?php if($product->ShowToUser): ?>
                    <a href='<?php echo base_url() . CommonConstants::SELLER_URL_SLUG . "/product-attributes/" . $product->Id ?>' class="edit" title="EditAttr"
                       style="cursor: pointer;"
                       id="<?php echo $product->Id ?>">
                        <i class="fa fa-bars"></i></a>
                  <?php endif; ?>
                  &nbsp;&nbsp;&nbsp;&nbsp;
                    <a title="Edit" href="<?php echo base_url().'edit-product/'.$product->Id ?>">
                        <i class="fa fa-edit"></i></a>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <?php
                    if ($product->IsActive == 1) {
                        ?>
                        <a class="deactivate text-yellow" title="Deactivate"
                           style="cursor: pointer;"
                           id="<?php echo $product->Id; ?>">
                            <i class="fa fa-times"></i></a>
                        <?php
                    } else {
                        ?>
                        <a class="activate text-green" title="Activate"
                           style="cursor: pointer;"
                           id="<?php echo $product->Id; ?>">
                            <i class="fa fa-check"></i></a>

                        <?php
                    }
                    ?>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <a class="glyphicon glyphicon-trash" title="Delete"
                       style="cursor: pointer;"
                       id="<?php echo $product->Id ?>"></a>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
    <script>
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


        });


    </script>
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

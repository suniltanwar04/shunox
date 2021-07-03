
    <div class="modal-dialog " role="document" style="width: 55%">

        <form class="form-horizontal" id="productAddForm" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="addCityModalLabel">Coupon Details</h4>
                </div>
                <div class="modal-body modal-tab-form">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab_1" data-toggle="tab" id="addGenInfo">Coupon Information</a></li>

                                </ul>
                                <div class="tab-content">
                                    <div id="table-div">

                                        <?php
                                        if ($products) {
                                            ?>
                                            <div class="box-body no-padding">
                                                <table class="table">
                                                    <tbody>
                                                    <tr>
                                                        <th style="width: 10px">#</th>
                                                        <th>Coupon Code</th>
                                                        <th>Item Type</th>
                                                        <th>Discount Type</th>
                                                        <th>Discount Value</th>

                                                    </tr>


                                                    <?php
                                                    $i = 1;
                                                    foreach ($products as $product) {

//                                    $isActive = CommonHelpers::getStatus($OrderManagement->IsActive);
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $i; ?></td>
                                                            <td><?php echo $product->CouponCode; ?></td>
                                                            <td><?php if($product->ItemType==1)
                                                                {echo "allProducts";}
                                                                elseif($product->ItemType==2){echo "Subcategory";}
                                                                else{echo "Products";}?></td>
                                                            <td><?php if($product->DiscountType==1){echo "Percentage";}else{echo "Flat";} ?></td>
                                                            <td><?php if($product->DiscountType==1){echo $product->DiscountValue.'%';}else{echo $product->DiscountValue;} ?></td>


                                                        </tr>
                                                        <?php
                                                        $i++;
                                                    }
                                                    ?>


                                                    </tbody>
                                                </table>
                                            </div>

                                            <!-- Pagination
                                                                <div class="box-footer clearfix">
                                                                    <ul class="pagination pagination-sm no-margin pull-right">
                                                                        <li><a href="#">«</a></li>
                                                                        <li><a href="#">1</a></li>
                                                                        <li><a href="#">2</a></li>
                                                                        <li><a href="#">3</a></li>
                                                                        <li><a href="#">»</a></li>
                                                                    </ul>
                                                                </div>
                                            -->






                                            <?php
                                        } else {
                                            ?>
                                            <div class="box-body no-padding">
                                                <table class="table">
                                                    <tbody>
                                                    <tr>
                                                        <td class="dataTables_empty">No Records Found.</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <?php
                                        }
                                        ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                </div>
            </div>
        </form>
    </div>

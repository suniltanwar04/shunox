
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Order Wise Product Details
            <!-- <div class="btn-group pull-right">
                 <button id="addCategory" class="btn btn-medium btn-primary" data-toggle="modal"
                         data-target="#addCategoryModal">Add Category
                 </button>
             </div>-->
        </h1>
    </section>
    <section class="content">
        <div class="row" id="page-msg" style="display: none;"></div>
        <div class="box">

            <?php
            $queryLimits = CommonHelpers::getQueryLimits();
            ?>


            <div class="box-header with-border">
                <!-- Data Limit

                <div class="col-lg-2">

                    <select class="form-control">
                        <?php
                foreach ($queryLimits as $queryLimit) {
                    ?>
                            <option
                                value="<?php echo $queryLimit['Value']; ?>"><?php echo $queryLimit['Name']; ?></option>
                        <?php
                }

                ?>
                    </select>


                </div>
-->
                <!-- Search Panel
                <div class="col-lg-3">
                    <input type="text" class="form-control">
                </div>
                <div class="col-lg-3">
                    <input type="text" class="form-control">
                </div>
                <div class="col-lg-3">
                    <select class="form-control">
                        <option>Yes</option>
                        <option>No</option>
                    </select>
                </div>
                <div class="col-lg-1">
                    <button id="addCategory" class="btn btn-medium btn-default">Search</button>
                </div>
-->

            </div>
            <div class="box-body no-padding">
                <div id="table-div">

                    <?php
                    if ($OrderWiseProducts) {
                        ?>
                        <div class="box-body no-padding">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Product Name</th>
                                    <th>Unit Price</th>

                                    <th>Discount Value</th>
                                    <th>Order Quantity</th>
                                    <th>Total Price</th>

                                </tr>


                                <?php
                                $i = 1;
                                foreach ($OrderWiseProducts as $OrderWiseProduct) {

//                                    $isActive = CommonHelpers::getStatus($OrderManagement->IsActive);
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $OrderWiseProduct->ProductName; ?></td>
                                        <td><?php echo $OrderWiseProduct->UnitPrice; ?></td>

                                        <td><?php echo $OrderWiseProduct->DiscountValue; ?></td>
                                        <td><?php echo $OrderWiseProduct->OrderQuantity; ?></td>
                                        <td><?php echo $OrderWiseProduct->TotalPrice; ?></td>

                                        <!--                                        <td style="color: --><?php //echo $isActive->Color; ?><!--">--><?php //echo $isActive->Name; ?><!--</td>-->
                                        <td>

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
                                                    <li><a href="#">�</a></li>
                                                    <li><a href="#">1</a></li>
                                                    <li><a href="#">2</a></li>
                                                    <li><a href="#">3</a></li>
                                                    <li><a href="#">�</a></li>
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
    </section>

<!--    --><?php //$this->load->view('seller/settings/category/modal/add-category-modal'); ?>




<!--    <div class="modal fade" id="editCategoryModel" style="display: none;padding-top: 20px;" data-backdrop="static"-->
<!--         data-keyboard="false"></div>-->
</div>
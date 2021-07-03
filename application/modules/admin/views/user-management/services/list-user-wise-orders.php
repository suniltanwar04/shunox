<div class="content-wrapper">
    <section class="content-header">
        <h1>
            List Of Orders
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
                    if ($userWiseOrders) {
                        ?>
                        <div class="box-body no-padding">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Order Id</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Total Price</th>
                                    <th>Payment Type</th>
                                    <th>Transcation Id</th>
                                    <th>Online Payment Status</th>
                                    <th>Paid</th>
                                    <th>ProductDetail</th>

                                </tr>


                                <?php
                                $i = 1;

                                  foreach ($userWiseOrders as $userWiseOrder) {
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $userWiseOrder->OrderHash; ?></td>
                                        <td><?php echo $userWiseOrder->FullName; ?></td>
                                        <td><?php echo $userWiseOrder->Email; ?></td>
                                        <td><?php echo $userWiseOrder->TotalPrice; ?></td>
                                        <td><?php
                                            if($userWiseOrder->PaymentType==1){
                                                echo "Online";
                                            }else{
                                                echo "COD";
                                            }

                                            ?></td>
                                        <td><?php echo $userWiseOrder->TransactionId; ?></td>
                                        <td><?php echo $userWiseOrder->OnlinePaymentStatus; ?></td>
                                        <td><?php

                                            if($userWiseOrder->IsPaid == 1){
                                                echo Yes;
                                            }else{
                                                echo "No";
                                            }

                                            ?></td>
                                        <td>
                              <a href="<?php echo $this->config->item('admin_base_url') . 'list-user-wise-order-product/'.$userWiseOrder->Id; ?>" class="fa fa-eye-slash" aria-hidden="true"></a>
                                      </td>




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
    </section>

    <?php $this->load->view('admin/settings/category/modal/add-category-modal'); ?>




    <div class="modal fade" id="editCategoryModel" style="display: none;padding-top: 20px;" data-backdrop="static"
         data-keyboard="false"></div>
</div>
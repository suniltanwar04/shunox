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
                <div class="col-lg-3">
                    Search By status
                    <select class="form-control" id="order_status" name="order_status">
                        <option value="">select status</option>
                        <option value="1">New Order</option>
                        <option value="2">In process</option>
                        <option value="3">Dispatched</option>
                        <option value="4">Delivery</option>
                        <option value="5">Cancelled</option>
                        
                    </select>
                </div>

            </div>
            <div class="box-body no-padding">
                <div id="table-div">

                    <?php
                    if ($OrderManagements) {
                        ?>
                        <div class="box-body no-padding">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Order Id</th>
                                    
                                    <th>Total Price</th>
                                    <th>Payment Status</th>
                                    <th>Payment Mode</th>

                                    <th>Has Coupon</th>
                                    <!-- <th>Paid</th> -->
                                    <th>Print Scan ID</th>
                                    <th>Order Status</th>
                                    <th>User Details</th>
                                    <th>Action</th>
                                    <th>Create Order</th>
                                </tr>


                                <?php
                                $i = 1;
                                foreach ($OrderManagements as $OrderManagement) { //print_r($OrderManagement);die;
								// echo "<pre>"; print_r($OrderManagement);
//                                    $isActive = CommonHelpers::getStatus($OrderManagement->IsActive);
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $OrderManagement->OrderHash; ?></td>
                                        
                                        <td><?php echo $OrderManagement->TotalPrice; ?></td>
                                        <td><?php 
                                                echo ucfirst($OrderManagement->PaymentStatus)
                                            ?></td>
                                            <td><?php 
                                                echo ucfirst($OrderManagement->PaymentMode)
                                            ?></td>

                                        <td><?php
                                            if($OrderManagement->HasCoupon==1){
                                                echo "<button id=' $OrderManagement->Id'  class='btn btn-medium btn-primary coupondetail' data-toggle='modal'
                        data-target='#addOrderModal'>Coupon Detail
                </button>";}
                                            else{ echo "No coupon"; } ?></td>
                                       <!-- <td><?php /* if($OrderManagement->IsPaid == 1){
                                                echo "yes";
                                            }else{
                                                echo "No";
                                            } */
                                            ?></td> -->
										
                                            <?php if($OrderManagement->orderScanID && $OrderManagement->orderScanID !="-1" && $OrderManagement->orderScanID !="-2"){?>
                                        <?php if($OrderManagement->CurrentStatus == 1){?>
                                            <td style="text-align: center;"><a href="#" class="pdf_prnt changeCurrentStatus"><i class="fa fa-print" aria-hidden="true"></i></a></td>
                                        <?php } else{?>
                                            <td style="text-align: center;"><a href="/user/pdf-download/<?php echo $OrderManagement->orderScanID; ?>" target="_blank" class="pdf_prnt"><i class="fa fa-print" aria-hidden="true"></i></a></td>
                                        <?php } } else{?>
                                            <td></td>
                                        <?php } ?>

                                        <td>
                                          <?php
                                          $orderStatus = [
                                              1 =>  "Placed",
                                              2 =>  "In Process",
                                              3 =>  "Dispatched",
                                              4 =>  "Delivered",
                                              5 =>  "Cancelled",
                                          ];
                                          ?>
                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                            <select id="currentstatusId">
                                              <?php foreach($orderStatus as $key => $value): ?>
                                                <?php if($key >= $OrderManagement->CurrentStatus): ?>
                                                <option value="<?php echo $key.'_'.$OrderManagement->Id; ?>"
                                                  <?php
                                                  if($OrderManagement->CurrentStatus == $key){
                                                    echo "selected";
                                                  }
                                                   ?>
                                                  >
                                                  <?php echo $value; ?>
                                                </option>
                                              <?php endif; ?>
                                              <?php endforeach; ?>

                                            </select>


                                        </td>
                                        <?php if($OrderManagement->UserId > 0){?>
                                        <td> <a href="<?php echo $this->config->item('admin_base_url') . 'user-details/'.$OrderManagement->UserId; ?>" class="fa fa-eye-slash" aria-hidden="true"></a></td>
                                        <?php }else{?>
                                        <td> Guest Users</td>
                                        <?php }?>

                                           <td> <a href="<?php echo $this->config->item('admin_base_url') . 'order-wise-product-details/'.$OrderManagement->OrderHash; ?>" class="fa fa-eye-slash" aria-hidden="true"></a>
                                           &nbsp;&nbsp;&nbsp;&nbsp;
                                            <a class="glyphicon glyphicon-trash" title="Delete"
                                               style="cursor: pointer;"
                                               id="<?php echo $OrderManagement->Id ?>"></a>
                                           </td>

<td><?php echo date('d-m-Y', strtotime($OrderManagement->CreatedOn)); ?></td>

                                    </tr>
                                    <?php
                                    $i++;
                                }
                                ?>


                                </tbody>
                            </table>
                        </div>


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
    <?php //$this->load->view('admin/product/model/add-product-model'); ?>
<!--    --><?php //$this->load->view('admin/order-management/services/order-wise-product-details-coupon'); ?>
    <div class="modal fade" id="addOrderModal" style="display: none;padding-top: 20px;" data-backdrop="static"></div>

</div>
<script>
	function openWindowReload(link) {
		var href = link.href;
		window.open(href,'_blank');
		document.location.reload(true)
	}
</script>	
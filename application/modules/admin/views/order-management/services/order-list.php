<?php
if ($OrderManagements) {
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

                <th>Has Coupon</th>
                <th>Paid</th>
                <th>Order Status</th>
                <th>Action</th>
            </tr>


            <?php
            $i = 1;
            foreach ($OrderManagements as $OrderManagement) { //print_r($OrderManagement);die;

//                                    $isActive = CommonHelpers::getStatus($OrderManagement->IsActive);
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $OrderManagement->OrderHash; ?></td>
                    <td><?php echo $OrderManagement->FullName; ?></td>
                    <td><?php echo $OrderManagement->Email; ?></td>
                    <td><?php echo $OrderManagement->TotalPrice; ?></td>
                    <td><?php  if($OrderManagement->PaymentType == 1){
                            echo "Online";
                        }else{
                            echo "COD";
                        }

                        ?></td>

                    <td><?php
                        if($OrderManagement->HasCoupon==1){
                            echo "<button id=' $OrderManagement->Id'  class='btn btn-medium btn-primary coupondetail' data-toggle='modal'
                        data-target='#addOrderModal'>Coupon Detail
                </button>";}
                        else{ echo "No coupon"; } ?></td>
                    <td><?php if($OrderManagement->IsPaid == 1){
                            echo "yes";
                        }else{
                            echo "No";
                        }
                        ?></td>


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

                    <td> <a href="<?php echo $this->config->item('admin_base_url') . 'order-wise-product-details/'.$OrderManagement->OrderHash; ?>" class="fa fa-eye-slash" aria-hidden="true"></a></td>



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

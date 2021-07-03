<div class="clearfix"></div>
<div class="dark-white" >
  <div class="center">
  <div class="main-container">
   <div class="por-contaner">
    <div class="grid-25 pull-left">
    <div class="dashboard_main">
     <?php require_once('services/user-dashboard-menu.php'); ?>
    </div>
    </div>
    <!--Right bar-->
    <div class="grid-75 pull-right">
    <div class="user-details">
      <table id="table">
    <thead>
      <tr>
        <th>Image</th>
        <th>Product Name</th>
        <th>Qty</th>
        <th>Total</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      <?php  if($orders): ?>
        <?php foreach ($orders as $order): ?>
         <tr>
          <td><img src="<?php echo base_url().'uploads/products/'.$order->ProductImage ?>" width="150" height="150"></td>
          <td><?php echo $order->ProductName; ?></td>
          <td><?php echo $order->OrderQuantity; ?></td>
          <td>&nbsp; &nbsp; <i class="fa fa-inr"></i> <?php echo $order->TotalPrice; ?>/-</td>
          <td>
            <?php
              $status = [1 => "Placed",2 => "In Process",3 => "Dispatched",4 => "Delivered",5 => "Cancelled"];
              foreach($status as $key => $value){
                if($order->CurrentStatus == $key){
                    echo $value;
                    break;
                }
              }
            ?>
          </td>
        </tr>
    <?php endforeach; ?>
    <?php else: ?>
      <td colspan="5" class="text-center">Sorry, You have no orders!</td>
    <?php endif; ?>
    </tbody>
  </table>
    </div>
    </div>
    <!--Right bar ends here-->
      </div>
  </div>
</div>
</div>

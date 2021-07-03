<div class="container" style="max-width:75%">
  <table border="0"  class="table" id="invoice">
    <thead>
    <tr>
      <td  class="lightgray border_lightgray"></td>
      <td colspan="7"class="darkgray"></td>
      <td colspan="2" class="darkgray"><h2>INVOICE</h2></td>
    </tr>
    <tr>
      <td class="lightgray border_lightgray"><?php echo date("d-M-Y"); ?></td>
      <td class="darkgray">&nbsp;</td>
      <td class="darkgray">&nbsp;</td>
      <td class="darkgray"><h4>&nbsp;</h4></td>

      <td colspan="3" class="darkgray"><h4>
        <?php
          echo $order->FirstName ? : $billingAddress->FirstName;
         ?>
      </h4></td>
      <td class="darkgray">&nbsp;</td>
      <td class="darkgray">&nbsp;</td>
      <td class="darkgray">&nbsp;</td>
    </tr>
    <tr>
      <td class="lightgray border_lightgray"><strong>Order ID : #</strong><?php echo $order->Id; ?></td>
      <td class="darkgray">&nbsp;</td>
      <td class="darkgray">&nbsp;</td>
      <td class="darkgray">&nbsp;</td>
      <td class="darkgray">&nbsp;</td>
      <td class="darkgray">&nbsp;</td>
      <td class="darkgray">&nbsp;</td>
      <td class="darkgray">&nbsp;</td>
      <td class="darkgray">&nbsp;</td>
      <td class="darkgray">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="10">&nbsp;</td>
    </tr>
  </thead>
    <tr class="lightgray">
      <td colspan="5"><h5>DESCRIPTION</h5></td>
      <td>&nbsp;</td>
      <td><strong>Price</strong></td>
      <td>&nbsp;</td>
      <td><strong>Quantity</strong></td>
      <td><strong>Size</strong></td>
      <td><strong>SUB TOTAL</strong></td>
    </tr>
    <?php if($orderedProducts): ?>
    <?php foreach($orderedProducts as $product): print_r($product);?>
	
    <tr>
      <td colspan="5"><strong><?php echo $product->ProductName ?></strong></td>
      <td>&nbsp;</td>
      <td><?php echo $product->UnitPrice ?>/-</td>
      <td>&nbsp;</td>
      <td><?php echo $product->OrderQuantity ?></td>
      <td class="lightgray"><strong><?php echo $product->AttributeValue ?></strong></td>

      <td class="lightgray"><strong><?php echo $product->TotalPrice ?>/-</strong></td>
    </tr>
  <?php endforeach; ?>
  <?php endif; ?>

    <tfoot>
<?php 

if($order->CouponDiscountedPrice): ?>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td class="lightgray"><strong>Coupon Discount</strong></td>
        <td class="lightgray"><strong><?php echo $order->CouponDiscountedPrice; ?>.00/-</strong></td>
      </tr>
<?php endif; ?>
    <tr>
      <td><strong>Shipping Address</strong></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td class="lightgray"><strong>GRAND TOTAL</strong></td>
      <td class="lightgray"><strong><?php echo $order->TotalPrice; ?>/-</strong></td>
    </tr>
    <tr >
      <td colspan="5" style="font-weight:bold">
        <?php if($order->NewBillingAddress > 0): ?>
          <p><?php echo $billingAddress->FirstName; ?></p>
          <p><?php echo $billingAddress->Email; ?></p>
          <p><?php echo $billingAddress->Mobile; ?></p>
          <p><?php echo $billingAddress->Address; ?></p>
          <p><?php echo $billingAddress->Landmark; ?></p>
          <p><?php echo $billingAddress->City; ?>,
          <?php echo $billingAddress->State; ?>,
          <?php echo $billingAddress->PinCode; ?></p>

        <?php else: ?>

          <p><?php echo $order->FirstName; ?></p>
          <p><?php echo $order->Email; ?></p>
          <p><?php echo $order->Mobile; ?></p>
          <p><?php echo $order->Address; ?></p>
          <p><?php echo $order->Landmark; ?></p>
          <p><?php echo $order->City; ?>,
          <?php echo $order->State; ?>,
          <?php echo $order->PinCode; ?></p>

        <?php endif; ?>
      </td>

    </tr>
    </tfoot>
  </table>
  <center><a href="<?php echo base_url(); ?>" class="btn">Continue Shopping</a></center>
</div>

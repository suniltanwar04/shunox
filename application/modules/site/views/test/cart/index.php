<style>
input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
   opacity: 1;
}
td {
    max-width: 300px;
}
.upd_btn{
    background:#4fb9a8 !important;
    font-size:11px;
    color:#fff !important;
    font-weight:600 !important;
    border:0;
    margin-top:5px !important;
    margin-right: 0px !important;
}
.upd_input, .scan_id{
    padding:6px !important;
    border-radius: 5px;
}
.cstm_crt_tbl th {
    width: 100%;
}
.data-table td {
    padding: 9px;
}
.check_dv input[type="radio"] {
    display: inline-block;
}
.check_dv {
    text-align: left;
}
.check_dv {
    display: none !important;
}
select.scan_id {
    display: none !important;
}
</style>

<div id="loader">
    <img src="<?php echo base_url().'assets/site/images/loader.gif'; ?>" alt="">
</div>
<div class="main-container col1-layout wow animated animated" style="visibility: visible;">

    <div class="main">
        <div class="cart wow  animated animated container" style="visibility: visible;">

            <div class="col-md-8 col-sm-8 col-lg-8" id="cart_body">
                <div class="table-responsive shopping-cart-tbl">
                    <form action="" method="post">
                        <input name="form_key" value="EPYwQxF6xoWcjLUr" type="hidden">
                        <fieldset>
							<span style="font-size: 20px;">Recheck Your Purchase</span>
                            <table id="shopping-cart-table" class="data-table cart-table table-striped cstm_crt_tbl">
                                <colgroup><col width="1">
                                    <col>
                                    <col width="1">
                                    <col width="1">
                                    <col width="1">
                                    <col width="1">
                                    <col width="1">
                                </colgroup>
                                <?php if($cartProducts): ?>
                                <thead>
                                <tr class="first last">
                                    <th rowspan="1">Image</th>
                                    <th rowspan="1" style="width:10px;"><span class="nobr">Product Name</span></th>
                                    <th rowspan="1">Size</th>
                                    <th class="a-center" colspan="1"><span class="nobr">Unit Price</span></th>
                                    <th rowspan="1" class="a-center">Qty</th>
                                    <th rowspan="1" class="a-center">Scan ID</th>
                                    <th class="a-center" colspan="1" >Subtotal</th>
                                    <th rowspan="1" class="a-center">Remove</th>
                                    
                                </tr>
                                </thead>
                                <!--<tfoot>
                                <tr class="first last">
                                    <td colspan="50" class="a-right last">
                                       
                                        <button type="button" title="Clear Cart"
                                        class="button btn-empty clear-cart" id="<?php echo isset($_SESSION['Id']) ? $_SESSION['Id'] : $_SESSION['GuestUser'] ?>"><span>Clear Cart</span></button>
                                    </td>
                                </tr>
                                </tfoot>-->
                                <tbody>

                                <?php
                                    $total_price = 0 ;
                                    $finalPrice = 0 ;
                                    $CouponDiscountedPrice = $this->session->userdata("AppliedCouponDiscount") ? $this->session->userdata("AppliedCouponDiscount") : 0;
                                    $productIds = "";
                                    foreach($cartProducts as $cartProduct):
                                        if($cartProduct->Price=='') {

                                            $cartProductss = $this->SiteCart_model->getCartProduct($cartProduct->ProductId);

                                            $productImage = $this->SiteProduct_model->getProductMainImage($cartProduct->ProductId);
                                            if (isset($productImage->ImageName)) {
                                                $mainImageUrl = base_url() . CommonConstants::IMAGE_URL_PRODUCT . $productImage->ImageName;

                                            } else {
                                                $mainImageUrl = base_url() . CommonConstants::IMAGE_URL_PRODUCT_PLC_HLDR;
                                            }

                                            if ($cartProductss->DiscountedPrice == 0) {

                                                if ($cartProductss->Stock):
                                                    $finalPrice = $cartProductss->Price * $cartProductss->Quantity;
                                                endif;
                                            } else {
                                                if ($cartProductss->Stock):
                                                    $finalPrice = $cartProductss->DiscountedPrice * $cartProductss->Quantity;
                                                endif;
                                            }
                                            $productIds .= $cartProductss->ProductId . ",";

                                            $total_price += $finalPrice;
                                            $unitPrice = $cartProductss->DiscountedPrice == 0 ? $cartProductss->Price : $cartProductss->DiscountedPrice;
                                        }else{
                                            $productImage = $this->SiteProduct_model->getProductMainImage($cartProduct->ProductId);
                                            if (isset($productImage->ImageName)) {
                                                $mainImageUrl = base_url() . CommonConstants::IMAGE_URL_PRODUCT . $productImage->ImageName;

                                            } else {
                                                $mainImageUrl = base_url() . CommonConstants::IMAGE_URL_PRODUCT_PLC_HLDR;
                                            }

                                            if ($cartProduct->DiscountedPrice == 0.00) {

                                                if ($cartProduct->Stock):
                                                    $finalPrice = $cartProduct->Price * $cartProduct->Quantity;
                                                endif;
                                            } else {
                                                if ($cartProduct->Stock):
                                                    $finalPrice = $cartProduct->DiscountedPrice * $cartProduct->Quantity;
                                                endif;
                                            }
                                            $productIds .= $cartProduct->ProductId . ",";

                                            $total_price += $finalPrice;
                                            $unitPrice = $cartProduct->DiscountedPrice == 0 ? $cartProduct->Price : $cartProduct->DiscountedPrice;
                                        }
                                ?>
                                <tr class="first last odd" class="warning">
                                    <td class="image hidden-table"><a href="<?php echo base_url().'detail/'.$cartProduct->ProductId ?>" title="" class="product-image"><img src="<?php echo $mainImageUrl ?>" alt="" width="75"></a></td>
                                    <td>
                                        <h5>
                                            <a href="<?php echo base_url().'detail/'.$cartProduct->ProductId ?>">
                                             <?php echo $cartProduct->ProductName; ?>
                                            </a>
                                        </h5>
                                    </td>

                                    <td>
                                        <h5>
                                             <?php if($cartProduct->ShowToUser){
                                               $productAttrs = $this->Site_model->getAttributeName($cartProduct->ProductId);
                                               $productAttribute = array();
                                               foreach($productAttrs as $attId){
            
                                                    $Attribut= $this->Site_model->getProductAttributes($cartProduct->ProductId,$attId->AttributeId);
                                                    $productAttribute[] = array("attributeName"=>$attId->AttributeName, "attributeId"=>$attId->AttributeId, $Attribut);

                                                }
                                              
//                                                echo '<pre>';
//                                                print_r($productAttribute);
//                                                echo '</pre>';
                                              
                                                echo $cartProduct->AttributeValue;
                                             } 
                                             ?>
                                        </h5>
                                    </td>
                                    <td class="a-right hidden-table">
                                        <span class="cart-price"><span class="price"><i class="fa fa-inr"></i>
                                        <?php echo $unitPrice ?></span></span>

                                    </td>
                                    <td class="a-center movewishlist text-center">
                                        <input type="number"
                                        value="<?php echo $cartProduct->Quantity; ?>" style="width:45px;" title="Qty" class="input-text qty item-cart-qantity upd_input" max="<?php echo $cartProduct->Stock; ?>" min="1">
                                        <input type="button" class="updateQuantity btn btn-default upd_btn" value="Update" id="<?php echo $cartProduct->CartId; ?>" style="color:black;background: white;font-weight: 100;margin-top: -4px;margin-right: -20px;padding: 5px;">
                                    </td>
									
									<td class="a-center movewishlist text-center" style="min-width: 213px;">
                                            <div class="check_dv">
                                                <input type="radio" name="scanradio" value="0" id="<?php echo $cartProduct->CartId;?>"" <?php if($cartProduct->scan_id != -1){ echo "checked"; } ?>> Continue with Scan <br>
                                                <!-- <input type="radio" name="scanradio" value="1" id="<?php //echo $cartProduct->CartId; ?>" <?php // if($cartProduct->scan_id == -1){ echo "checked"; } ?>> Continue without Scan <br>-->
                                            </div>
                                            <?php //echo count($scan_data['getScanningsResult']['Scans']); die(); ?>
											<?php //echo "<pre>"; print_r(end($scan_data['getScanningsResult']['Scans'])['ScanNo']); ?>
											<?php if(count($scan_data['getScanningsResult']['Scans']) > 0){ 
												echo end($scan_data['getScanningsResult']['Scans'])['ScanNo'];
											}else{
												echo "Not Available";
											} ?>
											
											
                                         <select name="scan_id" class="scan_id" id="<?php echo $cartProduct->CartId; ?>">
                                            <!-- <option value="-2" <?php //if($cartProduct->scan_id == -2){ echo "selected"; } ?>>Select</option> -->
                                            <?php 
											//foreach($scan_data['getScanningsResult']['Scans'] as $scandata){ ?>
                                                <!-- <option value="<?php //echo $scandata['ScanID']; ?>" <?php //if($cartProduct->scan_id == $scandata['ScanID']){ echo "selected"; } ?>><?php //echo $scandata['ScanNo']."Dd".$scandata['ScanDate']; ?> </option> -->
                                            <?php //} ?>
											<?php if(count($scan_data['getScanningsResult']['Scans']) > 0){ ?>
												<option value="<?php echo end($scan_data['getScanningsResult']['Scans'])['ScanID']; ?>" selected><?php echo end($scan_data['getScanningsResult']['Scans'])['ScanID']."Dd".end($scan_data['getScanningsResult']['Scans'])['ScanDate']; ?> </option>
											<?php } else{ ?>
												<option value="N/A">Not Available</option>
											<?php } ?>
                                            <!-- <input type="button" class="updateScanID btn btn-default upd_btn" value="Update" id="<?php //echo $cartProduct->CartId; ?>" style="color:black;background: white;font-weight: 100;margin-top: -4px;margin-right: -20px;padding: 5px;"> -->
										</select>
                                    </td>
									
                                    <td class="a-right movewishlist">
                                        <span class="cart-price"><span class="price"><i class="fa fa-inr"></i>
                                        <?php echo $finalPrice; ?></span></span>
                                    </td>
                                    <td class="a-center last">
                                        <a id="<?php echo $cartProduct->CartId; ?>" title="Remove item" class="button remove-item remove-cart-item"><span><span>Remove item</span></span></a>
                                    </td>
                                    
                                </tr>
                                <?php endforeach; ?>
                                <?php else: ?>
                                    <h4>Sorry, there is no item in your cart !</h4>
                                <?php endif; ?>

                                </tbody>
                            </table>
                        </fieldset>
                    </form>
                </div>
            </div>
            <!-- BEGIN CART COLLATERALS -->
            <div class="col-md-4 col-sm-4 col-lg-4">
            <?php if($cartProducts): ?>
              <?php if($total_price - $CouponDiscountedPrice > 0): ?>
                <div class="cart-collaterals" style="width:90%">
                    <!-- BEGIN COL2 SEL COL 1 -->
                    <div class="col-sm-12" style="width:100%">
                        <div class="totals discount">
                            <h3>Shopping Cart Total</h3>
                            <div class="inner">

                                <table id="shopping-cart-totals-table" class="table shopping-cart-table-total">
                                    <colgroup><col>
                                        <col width="1">
                                    </colgroup>
                                    <tbody>
                                      <?php if($this->session->userdata("AppliedCouponDiscount")): ?>
                                      <tr>
                                          <td style="" class="a-left" colspan="1">
                                              Coupon Discount    </td>
                                          <td style="" class="a-right">
                                              <span class="price"><i class="fa fa-inr"></i>
                                                <?php
                                                 echo $this->session->userdata("AppliedCouponDiscount");
                                                 ?>
                                                  </span>
                                              </td>

                                      </tr>
                                    <?php endif; ?>

                                    <tr>
                                        <td style="" class="a-left" colspan="1">
                                            Subtotal    </td>
                                        <td style="" class="a-right">
                                            <span class="price"><i class="fa fa-inr"></i><?php
                                                /*----setting the coupon discount dynamically if the coupon applied----*/

                                            echo $total_price - $CouponDiscountedPrice . ".00"; ?>
                                                </span>
                                            </td>

                                    </tr>
                                    </tbody>
                                </table>

                                <ul class="checkout">
                                    <li>
                                        <button type="button" title="Proceed to Checkout" class="button btn-proceed-checkout disabled" id="checkout-btn"  <?php if(count($scan_data['getScanningsResult']['Scans']) == 0){ echo 'disabled style="cursor: not-allowed;"';}?>>Proceed to Payment</button> 
										<?php if(count($scan_data['getScanningsResult']['Scans']) == 0){ ?><p class="cnntpurp" style="color:red;">Can not purchase without scanning report</p><?php } ?>
                                    </li><br>
                                </ul>
                            </div><!--inner-->
                        </div><!--totals-->
                    </div> <!--col-sm-4-->


                    <div class="col-sm-12">
                        <div class="discount">
                          
                            <!--<form id="discount-coupon-form" action="" method="post">
                                <label for="coupon_code">Enter your coupon code if you have one.</label>
                                <input name="products" id="products" value="<?php echo trim($productIds,","); ?>" type="hidden"><br>
                                <span id="appliedCouponResult" style="color:green">
                                    <?php if($this->session->flashdata("couponApplied")): ?>
                                        Coupon Applied !
                                    <?php endif; ?>
                                </span>
                                <input class="input-text fullwidth" id="coupon_code" name="coupon_code" value="" type="text">

                                <button type="button" title="Apply Coupon" class="button coupon " value="Apply Coupon" id="ApplyCoupon">
                                Apply Coupon</button>

                            </form>-->

                        </div> <!--discount-->
                    </div> <!--col-sm-4-->

                    

                </div> <!--cart-collaterals-->
            <?php endif; ?>
            <?php endif; ?>
            </div>


        </div>  <!--cart-->

    </div><!--main-container-->

</div>

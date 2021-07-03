<div id="loader">
    <img src="<?php echo base_url().'assets/site/images/loader.gif'; ?>" alt="">
</div>
<div class="container  main-container">
<form class="" method="post" id="shippingAddressForm" autocomplete="off">
<?php 
if(@$shippingAddress): 

$state = $this->Common_model->getStateById($shippingAddress->State);



$city = $this->Common_model->getCityById($shippingAddress->City);

?>

<div class="container shipping_form">
<div class="row">
<div class="col-sm-2">
</div>

<div class="col-sm-12" style="padding:20px 0px;">
    <div class="form-group">
     <div class="col-sm-12"> <h3>Choose Your Address</h3> </div>
     <div class="col-sm-4"> <label for="oldAddress">Deliver to this Address &nbsp;
       <input type="radio" value="2" name="shippingAddress" class="ChooseShipping" id="oldAddress"  /></label></div>
    </div>
</div>

<div class="col-sm-6"></div>

</div>
 </div>

 <div class="container" id="lastaddress">
	<div class="row">
     <div class="col-md-6">
			<div class="col-md-12 foundation">
			<input type="hidden" name="addres_id" id="addres_id" value="<?php echo $shippingAddress->Id?>">
			<input type="hidden" name="user_firstname" id="user_firstname" value="<?php echo $shippingAddress->FullName.' '.$shippingAddress->LastName?>">
			<input type="hidden" name="user_email" id="user_email" value="<?php echo $shippingAddress->Email ?>">
			<input type="hidden" name="user_phone" id="user_phone" value="<?php echo $shippingAddress->Mobile?>">
			<input type="hidden" name="user_landmark" id="user_landmark" value="<?php echo $shippingAddress->Landmark?>">
			<input type="hidden" name="user_fullAddress" id="user_fullAddress" value="<?php echo $shippingAddress->Address?>">
			<input type="hidden" name="user_pinCode" id="user_pinCode" value="<?php echo $shippingAddress->Pincode?>">
			<input type="hidden" name="user_state" id="user_state" value="<?php if($shippingAddress->State){echo $state->name;}?>">
			<input type="hidden" name="user_city" id="user_city" value="<?php if($shippingAddress->City){ echo $city->name;}?>">
			   <h3><?php echo $shippingAddress->FullName.' '.$shippingAddress->LastName ?></h3>
			  <div class="col-md-12 foundation_sm">
			     <ul>
           	 <li><i class="glyphicon glyphicon-user"> </i><?php echo $shippingAddress->FullName.' '.$shippingAddress->LastName  ?></li>
              <li><i class="glyphicon glyphicon-home"> </i><?php echo $shippingAddress->Address ?></li>
              <li><i class=""> </i><?php echo $shippingAddress->Pincode ?> </li>
	            <li><i class="glyphicon glyphicon-envelope"></i><?php echo $shippingAddress->Email ?></li>
		          <li><i class="glyphicon glyphicon-phone"></i><?php echo $shippingAddress->Mobile ?> </li>
			  	</ul>
			  </div>
			</div>
			</div>
	</div>
</div>
<?php endif; ?>

<?php
  // echo "<pre>";
  // print_r($_SESSION);
  // echo "</pre>";
 ?>
<div class="col-md-6  col-sm-12  col-xs-8 shipping_form" style="background:#fff; padding:30px;">
<?php if(@$shippingAddress): ?>
  <h4>New Shipping Address</h4>
<label for="newAddress">New Shipping Address &nbsp;
  <input type="radio" value="1" name="shippingAddress" class="ChooseShipping" id="newAddress"/>
</label>
<?php endif; ?>
<div class="col-md-12 col-sm-6 col-xs-12" id="newShippingAddressForm" style="<?php if(@$shippingAddress){ echo 'display:none'; } ?>">
    <h3 class="text-center">Billing Address</h3>
    <hr>
  <div class="col-xs-6 col-sm-6 col-md-4">
     <div class="form-group">
         <input type="text" name="fullName" id="fullName" class="form-control require input-sm" placeholder="Full Name" value="<?php echo isset($_SESSION['name']) ? $_SESSION['name'] : '' ?>">
         <span class="text-danger bg-danger"></span>
    </div>
</div>

<div class="col-xs-6 col-sm-6 col-md-4">
<div class="form-group">
<input type="email" name="email" id="email" class="form-control input-sm require" placeholder="Email"  value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : '' ?>">
<span class="text-danger bg-danger"></span>
</div>
</div>
<div class="col-xs-6 col-sm-6 col-md-4">
<div class="form-group">
    <input type="text" name="phone" id="phone" class="form-control input-sm require" placeholder="Mobile no"  value="<?php echo isset($_SESSION['phone']) ? $_SESSION['phone'] : '' ?>">
    <span class="text-danger bg-danger"></span>
</div>
</div>



<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group">
  <textarea name="fullAddress" rows="2" cols="40" class="form-control require" id="FullAddress"  placeholder="Full Address"><?php echo isset($_SESSION['fullAddress']) ? $_SESSION['fullAddress'] : '' ?></textarea>
    <span class="text-danger bg-danger"></span>
</div>
</div>

<div class="col-xs-6 col-sm-6 col-md-12">
<div class="form-group">
    <input type="text" name="landmark" id="landmark" class="form-control input-sm require" placeholder="Landmark"  value="<?php echo isset($_SESSION['landmark']) ? $_SESSION['landmark'] : '' ?>">
    <span class="text-danger bg-danger"></span>
</div>
</div>


<div class="col-xs-12 col-sm-4 col-md-4">
<div class="form-group">
<input type="text" name="pinCode" id="pinCode" class="form-control input-sm require" placeholder="Pin Code" maxlength="6"  value="<?php echo isset($_SESSION['pincode']) ? $_SESSION['pincode']: '' ?>">
<span class="text-danger bg-danger"></span>
</div>
</div>
<div class="col-xs-12 col-sm-4 col-md-4">
<div class="form-group">
<select class="form-control require" name="state" id="state">
  <option value="">Select State</option>
  <?php if(isset($_SESSION['state'])): ?>
      <option selected><?php echo $_SESSION['state']; ?></option>
  <?php endif; ?>
</select>
<span class="text-danger bg-danger"></span>
</div>
</div>
<div class="col-xs-12 col-sm-4 col-md-4">
<div class="form-group">
  <select class="form-control require" name="city" id="city">
    <option value="">Select City</option>
    <?php if(isset($_SESSION['city'])): ?>
        <option selected><?php echo $_SESSION['city']; ?></option>
    <?php endif; ?>
  </select>
    <span class="text-danger bg-danger"></span>
</div>
</div>
</div>

<div class="col-md-12">
<button class="btn" type="submit" style="background-color: #fff">Continue</button>
</div>
</div>
</form>

<div class="modal fade" id="checkOutOtpModal" tabindex="-1" role="dialog" aria-labelledby="otp-modalLabel"
     aria-hidden="true" data-backdrop="static" data-keyboard="false">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header login_modal_header">
                <button type="button" class="close" data-dismiss="modal"
                        aria-hidden="true">&times;</button>
                <h2 class="modal-title" id="myModalLabel">Enter Your OTP to Place your Order</h2>
            </div>
            <div class="modal-body login-modal">
                <br/>
                <div class="clearfix"></div>
                <form id="CheckoutOtpForm">
                    <div class="alert alert-danger text-center result" style="display:none;margin-bottom:5px;font-weight:bold;"
                         id="CheckoutOtpStatus">
                    </div>

                    <div class="form-group">
                        <input type="text" id="checkoutOtp" placeholder="ENTER YOUR OTP"
                               class="form-control login-field">
                        <i class="fa fa-lock login-field-icon"></i>
                        <span id="checkoutOtpError" style="color: red;"></span>
                    </div>
                    <button style="cursor: pointer;" class="btn btn-success modal-login-btn"
                       id="VerifyCheckoutOtpBtn">Submit</button>

                </form>

            </div>
            <div class="clearfix"></div>
            <div class="modal-footer login_modal_footer">
            </div>
        </div>
    </div>
</div>
</div>
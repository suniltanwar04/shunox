<div id="loader">
    <img src="<?php echo base_url().'assets/site/images/loader.gif'; ?>" alt="">
</div>
<div class="main-container">
<form action="<?php echo base_url().'pay-now' ?>" method="post" id="paymentOptionForm">
<div class="row">
		<div class="paymentCont">
						<div class="headingWrap">
								<h3 class="headingTop text-center">Select Your Payment Method</h3>
						</div>
						<div class="paymentWrap">
							<div class="btn-group paymentBtnGroup btn-group-justified" data-toggle="buttons">
					            <label class="btn paymentMethod active">
					            	<div class="method paypal" style="background-image:url(<?php echo base_url().'assets/site/images/' ?>Paytmlogo.jpg);"></div>
                        				<input name="paymentOption" id="paytm" value="3" class="radio" type="radio" checked>
					            </label>
					           
					        </div>
                  <div class="row" id="PaymentError" style="display:none">
                    <br>
                      <div class="col-lg-6 col-lg-offset-3">
                        <div class="alert alert-danger text-center">
                            Please Choose a payment Method
                        </div>
                      </div>
                  </div>
						</div>
						<div class="footerNavWrap text-center clearfix">
							<button class="btn btn-fyi">Pay
                <span class="glyphicon glyphicon-chevron-right"></span>
              </button>
						</div>
					</div>
	</div>
  <input type="hidden" id="paymentOption" value="">

</form>
<div style="margin-bottom: 20px;"> </div>
</div>

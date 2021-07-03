<div id="loader">
    <img src="<?php echo base_url().'assets/site/images/loader.gif'; ?>" alt="">
</div>
<div class="container" style="min-height:300px"><br>
	<div class="row">
		<div class="co-lg-4">
			<h2>Choose a Payment Option</h2>
			<form action="<?php echo base_url().'pay-now' ?>" method="post" id="paymentOptionForm">
				<ul class="form-list">
		            <li class="control">
		                <input name="paymentOption" id="COD" value="1" class="radio" type="radio">
		                <label for="COD">Cash On delivery</label>
		            </li>

		            <li class="control">
		                <input name="paymentOption" id="NB" value="2" class="radio" type="radio">
		                <label for="NB">PayU</label>
		            </li>

                <li class="control">
		                <input name="paymentOption" id="paypal" value="3" class="radio" type="radio">
		                <label for="paypal">Pay Pal</label>
		            </li>

		            <li class="control">
		                <input name="paymentOption" id="DC" value="4" class="radio" type="radio">
		                <label for="DC">Instamojo</label>
		            </li>

			           <li class="control">
		                <h5 id="paymentOptionError" style="color:#ff0000"></h5>
		            </li>
		            <li class="control">
		                <input name="pay" id="payNow" value="Pay Now" type="submit" class="btn btn-default">
		            </li>
		        </ul>
			</form>
		</div>
	</div>
</div>

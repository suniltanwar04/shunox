<?php

/*echo "<pre>";
print_r($current_billing_address);


echo "<pre>";
print_r($order_details);
exit();*/

/* 
	$live_url = "https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction";
	$testing_url = "https://test.ccavenue.com/transaction/transaction.do?command=initiateTransaction";
*/
 
if(!empty($order_details))
{
   
	
    $custname=$order_details->FirstName;
    $custaddress=$order_details->Address;
    $custcountry='India';
    $custstate=$order_details->State;
    $custcity=$order_details->City;
    $custzip=$order_details->Pincode;
    $custphone=$order_details->Mobile;
    $custemail=$order_details->Email;
    $orderid = $order_details->OrderId;
		

}
?>

<?php

$Amount =$order_details->TotalPrice;
// $Amount =1;
$Redirect_Url= base_url().'order-success';
$cancel_url  = base_url().'payment-cancel';

$CI =& get_instance();
$CI->load->model(array('site/Cc'));
var_dump($Redirect_Url,$cancel_url,$Amount,$orderid,$custname,$custaddress,$custcountry,$custstate,$custcity,$custzip,$custphone,$custemail);
$Checksum = $CI->Cc->getCCavenuesValues($Redirect_Url,$cancel_url,$Amount,$orderid,$custname,$custaddress,$custcountry,$custstate,$custcity,$custzip,$custphone,$custemail);

?>

<form id ="ccavenues_payment" method ="post" action ="https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction" >
<!--<form id ="ccavenues_payment" method ="post" action ="https://test.ccavenue.com/transaction/transaction.do?command=initiateTransaction" >-->

<?php foreach ($Checksum as $key=>$value) {
	?>
<input type="hidden" name="<?= $key; ?>" value="<?= $value; ?>">
<?php  }  ?>
</form>
<script type="text/javascript">document.getElementById("ccavenues_payment").submit();</script>
<?php
require_once(APPPATH . "libraries/paytmlib/config_paytm.php");
require_once(APPPATH . "libraries/paytmlib/encdec_paytm.php");
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
    echo "<pre>";
    print_r($order_details);die;
}

$Amount =$order_details->TotalPrice;
$Redirect_Url= base_url().'order-success';
$cancel_url  = base_url().'payment-cancel';

$paytmParams = array();
        $paytmParams['ORDER_ID']        = $orderid;
        $paytmParams['TXN_AMOUNT']      = $Amount;
        $paytmParams["CUST_ID"]         = '';
        $paytmParams["EMAIL"]           = $custemail ;

        $paytmParams["MID"]             = PAYTM_MERCHANT_MID;
        $paytmParams["CHANNEL_ID"]      = PAYTM_CHANNEL_ID;
        $paytmParams["WEBSITE"]         = PAYTM_MERCHANT_WEBSITE;
        $paytmParams["CALLBACK_URL"]    = base_url().PAYTM_CALLBACK_URL;
        $paytmParams["INDUSTRY_TYPE_ID"]= PAYTM_INDUSTRY_TYPE_ID;
        
        $paytmChecksum = getChecksumFromArray($paytmParams, PAYTM_MERCHANT_KEY);
        $paytmParams["CHECKSUMHASH"] = $paytmChecksum;
        
        $transactionURL = PAYTM_TXN_URL;
        
        ?>
        <html>
        <head>
            <title>Merchant Checkout Page</title>
        </head>
        <body>
            <center><h1>Please do not refresh this page...</h1></center>
            <form method='post' action='<?php echo $transactionURL; ?>' name='f1'>
                <?php
                    foreach($paytmParams as $name => $value) {
                        echo '<input type="hidden" name="' . $name .'" value="' . $value . '">';
                    }
                ?>
            </form>
            <script type="text/javascript">
                document.f1.submit();
            </script>
        </body>
    </html>
<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
include APPPATH . "modules/common/controllers/Common.php";
require_once(APPPATH . "libraries/paytmlib/config_paytm.php");
require_once(APPPATH . "libraries/paytmlib/encdec_paytm.php");
/**
 * Created by PhpStorm.
 * User: Amit
 * Date: 22-10-2016
 * Time: PM 08:30
 */
class SiteTest extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Site_model', 'SiteCart_model' , 'SiteProduct_model','Common_model'));
    }


    public function aboutUs()
    {
//        $data['jquery'] = 'path/to/js/file';
        $data['content'] = 'site/test/about/index';
        echo Modules::run('template/siteTemplate', $data);
    }

    public function cart()
    {
        if($this->session->userdata("IsLoggedIn")){
            $this->load->model("User_model");
            $user = $this->User_model->getProfile();
            if($user){
                $email = $user->Email;
                $mobile = $user->Mobile;
            $url = "http://webservice.shunox.in/Service1.svc/getScannings/".$email."/".$mobile."";
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            curl_close($ch);
            $response = json_decode($response, true);
            $data['scan_data'] = $response;
		
            }
            $data['checkCart'] = $this->SiteCart_model->getCart();
			
			//print_r( $data['checkCart']);exit();
			
            // if($data['checkCart']){
            //     if($data['checkCart'][0]->scan_id === null){
            //         $sel_scan_id = $response['getScanningsResult']['Scans'][0]['ScanID'];
            //         $data['changeScanId'] = $this->SiteCart_model->changeScanId($sel_scan_id);
            //     }
            // }
            $data['cartProducts'] = $this->SiteCart_model->getCart();
            $data['jquery'] = 'site/test/cart/js/cart-js';
            $data['content'] = 'site/test/cart/index';
            echo Modules::run('template/siteTemplate', $data);
        }
        else{
            redirect(base_url()."/login");
        }
        
		
    }

    public function checkout()
    {
        $data['jquery'] = 'site/test/checkout/js/checkout-js';
        $data['content'] = 'site/test/checkout/index';
        echo Modules::run('template/siteTemplate', $data);
    }

    public function billing()
    {
        $data['content'] = 'site/test/billing/index';
        echo Modules::run('template/siteTemplate', $data);
    }

    public function detail($productId)
    {
        $product = $this->Site_model->getProductById($productId);
        $data['product'] = $product;
        
        
        $data['getAtt'] = $this->Site_model->getAttributeName($productId);
         if( $data['getAtt'] ) {
             foreach ($data['getAtt'] as $attId) {

                 $Attribut = $this->Site_model->getProductAttributes($productId, $attId->AttributeId);
                 $data['productAttribute'][] = array("attributeName" => $attId->AttributeName, "attributeId" => $attId->AttributeId, $Attribut);

             }
         }else{
             $data['productAttribute'] = array();
         }
         
         $data['colors'] = $this->SiteProduct_model->getAttributeValueByName('Color');
        $data['sizes'] = $this->SiteProduct_model->getAttributeValueByName('Size');
        $data['widths'] = $this->SiteProduct_model->getAttributeValueByName('Width');
       
       
        $data['jquery'] = 'site/test/detail/js/product-detail-js';
        $data['content'] = 'site/test/detail/index';
        echo Modules::run('template/siteTemplate', $data);
    }

    public function listing()
    {
        $data['product'] = $this->Site_model->getProduct();
        //echo "<pre>";print_r($data['product'] );die;
        $data['jquery'] = 'site/test/listing/js/products-js';
        $data['content'] = 'site/test/listing/index';
        echo Modules::run('template/siteTemplate', $data);
    }

    public function password()
    {

        $data['content'] = 'site/test/password/index';
        echo Modules::run('template/siteTemplate', $data);
    }

    public function contactUs()
    {
        $order_id = 1;
        $this->start_payment($order_id);
        $data['innerBannerSubName'] = 'Contact';
        $data['jquery'] = 'site/test/contact-us/js/contact-us-js';
        $data['content'] = 'site/test/contact-us/index';
        echo Modules::run('template/siteTemplate', $data);
    }

    public function start_payment($order_id)
    {
        $paytmParams = array();
        $paytmParams['ORDER_ID']        = $order_id;
        $paytmParams['TXN_AMOUNT']      = 10;
        $paytmParams["CUST_ID"]         = 10;
        $paytmParams["EMAIL"]           = "" ;

        $paytmParams["MID"]             = PAYTM_MERCHANT_MID;
        $paytmParams["CHANNEL_ID"]      = PAYTM_CHANNEL_ID;
        $paytmParams["WEBSITE"]         = PAYTM_MERCHANT_WEBSITE;
        $paytmParams["CALLBACK_URL"]    = PAYTM_CALLBACK_URL;
        $paytmParams["INDUSTRY_TYPE_ID"]= PAYTM_INDUSTRY_TYPE_ID;
        
        $paytmChecksum = getChecksumFromArray($paytmParams, PAYTM_MERCHANT_KEY);
        $paytmParams["CHECKSUMHASH"] = $paytmChecksum;
        
        $transactionURL = PAYTM_TXN_URL;
        // p($posted);
        // p($paytmParams,1);

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
<?php

    }
    
    public function becomeDealer()
    {
       $data['countries'] = $this->Common_model->getCountries();
        //$data['innerBannerSubName'] = 'Become A Dealer';
        $data['jquery'] = 'site/test/become-dealer/js/become-js';
        $data['content'] = 'site/test/become-dealer/index';
        echo Modules::run('template/siteTemplate', $data);
    }


}

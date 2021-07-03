<?php
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;

if (!defined('BASEPATH')) exit('No direct script access allowed');
include APPPATH . "modules/common/controllers/Common.php";

include APPPATH . "third_party/paypal/vendor/autoload.php";


/**
 * Created by PhpStorm.
 * User: Amit
 * Date: 22-10-2016
 * Time: PM 08:30
 */
class Checkout extends MY_Controller
{
  protected $paypal;
    public function __construct(){
		
        parent::__construct();
       $this->load->model(array('Checkout_model','SiteCart_model','SiteLogin_model','User_model','Cc'));
       $this->paypal = new \PayPal\Rest\ApiContext(
         new \PayPal\Auth\OAuthTokenCredential(
           'AaOMf6deCkFC-6HEmQTFCFcExSaM89Jbld1SaI6-qVF7MZECOcGZo3VuPbJKDdiZNR8Lg3ruDk4N3lDb',
           'EAiKi1Y9ajS2ptzlKagV3KWBHmkFFPW_sK9imQeH3twdlXxHbfss0kc4tPp4lvnfZw0EuGxfsVQ93o4v'
         )
       );
		
        $this->pdo = $this->load->database('pdo', true);
        $this->pdoConn = $this->pdo->conn_id;
    
    }

    public function checkout(){
      if(!CommonHelpers::getLoggedUser()){
          redirect(base_url());
      }
    	//if user is logged in then update the guest user session with logged in user
    	if($this->session->userdata("Id")){
    		if($this->Checkout_model->updateGuestUserSession()){
    			redirect(base_url().'checkout/shipping');
    		}
    	}
        $data['jquery'] = 'site/checkout/js/checkout-js';
        $data['content'] = 'site/checkout/index';
        echo Modules::run('template/siteTemplate', $data);
    }

    public function shipping(){
		
        if(!CommonHelpers::getLoggedUser()){
            redirect(base_url());
        }
     
        if($this->session->userdata("Id")){
          $data['shippingAddress'] = $this->Checkout_model->getShippingAddress();
        }
        $data['jquery'] = 'site/test/checkout/js/checkout-js';
        $data['content'] = 'site/test/checkout/shipping-page';
        echo Modules::run('template/siteTemplate', $data);
    }

    public function paymentOption(){
        $data['jquery'] = 'site/test/checkout/js/checkout-js';
        //$data['content'] = 'site/test/checkout/fpayNow';
		$data['content'] = 'site/test/checkout/paymentOption2';
        echo Modules::run('template/siteTemplate', $data);
    }

    public function findState(){
      $pin = $this->input->post("pin");
      $state = $this->Checkout_model->getState($pin);
      if($state){
        echo '<option>'.$state->State.'</option>';
      }else{
        echo '<option value="">Select Your State</option>';
      }

    }

    public function findCity(){
      $pin = $this->input->post("pin");
      $city = $this->Checkout_model->getCity($pin);
      if($city){
          echo '<option>'.$city->City.'</option>';
      }else{
        echo '<option value="">Select Your City</option>';
      }

    }


    public function verifyOrder(){
      
      $loginType = $this->input->post("loginType");
     
      $shippingType = $this->input->post("shippingAddress");
     
      if($shippingType == 2){
	      $data['name'] = $this->input->post("user_firstname");
	      $data['email'] = $this->input->post("user_email");
	      $data['phone'] = $this->input->post("user_phone");
	      $data['landmark'] = $this->input->post("user_landmark");
	      $data['fullAddress'] = $this->input->post("user_fullAddress");
	      $data['pincode'] = $this->input->post("user_pinCode");
	      $data['state'] = $this->input->post("user_state");
	      $data['city'] = $this->input->post("user_city");
      }else{
	      $data['name'] = $this->input->post("fullName");
	      $data['email'] = $this->input->post("email");
	      $data['phone'] = $this->input->post("phone");
	      $data['landmark'] = $this->input->post("landmark");
	      $data['fullAddress'] = $this->input->post("fullAddress");
	      $data['pincode'] = $this->input->post("pinCode");
	      $data['state'] = $this->input->post("state");
	      $data['city'] = $this->input->post("city");
      }

      if(!$loginType){
          
        $existEmail = $this->SiteLogin_model->getUserByEmail($data['email']);
        $existMobile = $this->SiteLogin_model->getUserByMobile($data['phone']);
        $this->session->set_userdata($data);
        if($existEmail OR $existMobile){
          //means user is already registerd
           echo $this->saveOrderDetails($data);
        
        }else{
        
            echo $this->saveOrderDetails($data);
        }
      
      }else{
          if($shippingType){
         
              echo $this->saveOrderDetails($data);
          }else{
         
            echo $this->saveOrderDetails();
          }

        }
        
    }

    public function verifyCheckOutOTP(){
      sleep(2);
      $otp =  $this->input->post("otp");
      if($otp ==  $this->session->userdata("OTP")){
        //unset the OTP
        $this->session->userdata("OTP");
        //geting values from session which set in verifyOrder method
        $data['name'] = $this->session->userdata("name");
        $data['email'] = $this->session->userdata("email");
        $data['phone'] = $this->session->userdata("phone");
        $data['landmark'] = $this->session->userdata("landmark");
        $data['fullAddress'] = $this->session->userdata("fullAddress");
        $data['pincode'] = $this->session->userdata("pincode");
        $data['state'] = $this->session->userdata("state");
        $data['city'] = $this->session->userdata("city");

        if($this->Checkout_model->RegisterAndLoginOnCheckout($data)){
            echo $this->saveOrderDetails($data);
        }
      }else{
        echo -1;
      }
    }

    public function saveOrderDetails($data = null){
    
      //data = null means user has selected the old address for delivery
     if($data==null){
        	$billingAddres = $this->Checkout_model->getShippingAddress()->Id;
        }else{
       
        	$billingAddres = $this->Checkout_model->saveShippingInformation(0,$data);
        }
    
    	//if($lastOrderId = $this->Checkout_model->createOrder($billingAddres)){
		$lastOrderId = $this->Checkout_model->createOrder($billingAddres);
	//	echo $lastOrderId;exit();
        //setting the last order id to session to update the order detail from session
        $this->session->set_userdata("lastOrderId",$lastOrderId);

    		$userId = $this->session->userdata("Id");
			 // echo 'string';
             // echo $this->session->userdata("lastOrderId");exit();
    		//getting the cart items to update userOrderDetails table

    		$cartItems = $this->SiteCart_model->getCart($userId);
    		 if($this->Checkout_model->saveCreatedOrderDetails($lastOrderId,$cartItems)){
    		 	if($data != null){
            if($this->Checkout_model->updateOrderId($billingAddres)){
                return 1;
            }
    		 	}else{
              return 1;
          }

    		 }
    /*	}else{
    	
    		return 0;
    	}*/
    }

	
    //this is the main function for payment redirection
    public function payNow(){
  
        $paymentOption = $this->input->post("paymentOption");
        $this->session->set_userdata("paymentOption",$paymentOption);
        $paymentOptions = [0=>'none',1=>'cod-payment',2=>'ccAvenue'];
        foreach($paymentOptions as $key=>$value){
          
          if($key == $paymentOption){
            if($paymentOption != 0){
              $orderId = $this->session->userdata("lastOrderId");
				if(!empty($orderId) || $orderId!='' || $orderId!=null){
                $change_status = $this->Checkout_model->changeOrderStatus($orderId);
				}
            }
            redirect(base_url().$value);
            break;
          }
        }
    }

    public function changestatusPdf($orderId, $scanID){
            $order = $this->Checkout_model->notifyUser($orderId);
            //$change_status = $this->Checkout_model->changeOrderStatus($orderId);
              // $subject = 'Order Status';
              // $commonMessage = "Thanks And Regards \r\n";
              // $commonMessage .= "ShoeMade4u Team";
              // $message = "Hi, " . $order->FirstName . "\r\n";
              // $message .= "Your Order is in process\r\n";
              // $message .= $commonMessage;

              // $Common = new Common();
              // $sendStatus = $Common->sendMailNewsletter($subject, $message, $order->Email);

              redirect(base_url()."user/pdf-download/".$scanID);
            
          
    }

    public function codPayment(){
      $this->session->set_userdata("paymentStatus","initiated");
      $this->session->set_userdata("transactionId","1");
      redirect(base_url()."order-confirmation");
    }

    public function ccAvenue(){
      if(!$this->session->userdata("lastOrderId")){
        redirect(base_url());
      }

        $data['order_details']=$this->Checkout_model->getOrderdetailsid($this->session->userdata('lastOrderId'));
     
        $data['content'] = 'site/test/checkout/ccavenue';
        echo Modules::run('template/siteTemplate', $data);
      
       
    }

    public function orderSuccessCC()
    {
      $orderId = $this->session->userdata("lastOrderId");
	  $this->Checkout_model->updateOrderDetails($orderId);
      $userId = $this->session->userdata("Id");
      /*  if(!$this->session->userdata("lastOrderId")){
          redirect(base_url());
        }*/
      
      /*-----Update the order details------*/
		//print_r($_POST['encResp']);exit();
     /*if($_POST['encResp']!="")
       {*/
        // $this->Checkout_model->updateOrderDetails($orderId);
      /*}*/
    // echo $orderId;exit();
      $paymentStatus = $this->session->userdata("paymentStatus");
      $this->SiteCart_model->clearCart($userId);
      $data['result'] = $this->Checkout_model->orderSuccess($orderId);
     	unset($_SESSION['lastOrderId']);
       
        
       
        

        $data['content'] = 'site/test/checkout/order-success';
        echo Modules::run('template/siteTemplate', $data);
    }

    
    public function orderPaymentStatus(){
      if(!$this->session->userdata("lastOrderId")){
        redirect(base_url());
      }

      /*-----Update the order details------*/
      $this->Checkout_model->updateOrderDetails($this->session->userdata("lastOrderId"));

      $paymentStatus = $this->session->userdata("paymentStatus");

      if($paymentStatus == "success" OR $paymentStatus == "initiated"){
          /*-------------getting the last ordered product to update the stock-----------------*/
            $productStock = $this->Checkout_model->getOrderedProductLeftQuantity();

            /*--------------Updating the Quantity-------------*/
            if($productStock){
              foreach ($productStock as $leftStock) {
                $productId = $leftStock->ProductId;
                $quantityLeft = $leftStock->QuantityLeft;
                $orderedQuantity = $leftStock->OrderQuantity;
                $left = $quantityLeft - $orderedQuantity;
                $this->Checkout_model->updateProductQuantity($productId, $left);
              }
            }

            /*-------------Sending the placed order message-----------------*/
           
            $user = $this->User_model->getProfile();
            
      //            $message = "Hi, ".$user->FullName."\r\n";
      //            $message .= "Your Order with with order id #".$this->session->userdata("lastOrderId")." has been recived.\r\n";
      //            $message .= "Thanks and Regards \r\n";
      //            $message .= "ShoeMade4u Team";
      //            CommonSms::mobileSms($user->Mobile, $message);


            $userId = $this->session->userdata("Id");

            //if user has use coupon then map the coupon with userId, orderId in the userCouponMaping table

            if($this->session->userdata("Coupon")){
              $this->Checkout_model->mapUsedCoupon();
            }

            /*-------------clear the user cart-----------------*/
            if($this->SiteCart_model->clearCart($userId)){
                //generating invoice
                
                $lastOrder = $this->Checkout_model->getLastOrder($this->session->userdata("lastOrderId"));
                 
                $lastOrderDetail = $this->Checkout_model->getLastOrderDetail($lastOrder->Id);
                $billingAddress = "";
                if($lastOrder->NewBillingAddress > 0){
                  $billingAddress = $this->Checkout_model->getbillingAddress($lastOrder->NewBillingAddress);
                }

                $data['order'] = $lastOrder;
                $data['orderedProducts'] = $lastOrderDetail;
                $data['billingAddress'] = $billingAddress;
                $unset = $this->SiteCart_model->unsetSessions();
             
                $data['content'] = 'site/test/checkout/invoice';
                echo Modules::run('template/siteTemplate', $data);
            }
      }else{
        $data['content'] = 'site/test/checkout/payment-cancelled';
        echo Modules::run('template/siteTemplate', $data);
      }
     
      //sessions array when user logged in, not destroying these sessions if user is logged in
      $requiredSessions = ['__ci_last_regenerate','Id','Name','Email','UserRole','IsLoggedIn','FailedLogin'];
      foreach($_SESSION as $key => $value){
          if(!in_array($key, $requiredSessions)){
              unset($_SESSION[$key]);
          }
      }
    }


 public function paymentCancelled(){
      if(!$this->session->userdata("lastOrderId")){
        redirect(base_url());
      }
      $data['content'] = 'site/test/checkout/payment-cancelled';
      echo Modules::run('template/siteTemplate', $data);
    }





}

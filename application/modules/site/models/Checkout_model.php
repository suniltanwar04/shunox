<?php

/**
 * Created by PhpStorm.
 * User: Amit
 * Date: 22-10-2016
 * Time: PM 08:30
 */
class Checkout_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->pdo = $this->load->database('pdo', true);
        $this->pdoConn = $this->pdo->conn_id;
    }

    /*--this function is globaaly calling from common_models to update the cart-*/
    public function updateGuestUserSession(){
        $userId = $this->session->userdata("Id");
        $guestUserId = $this->session->userdata("GuestUser");
        /*----------Updating guest user id detail in cart table---------*/

        $stmt = $this->pdoConn->prepare("
                UPDATE ".CommonTables::CART."
                SET UserId = '$userId', UserType = '0'
                WHERE UserId = '$guestUserId'
            ");

        if($stmt->execute()){
            /*--------unsetting the guestUserSession------*/
            $this->session->unset_userdata("GuestUser");
            return true;
        }
    }


    public function getCartTotalPrice(){
        $userId = $this->session->userdata("Id") ? : $this->session->userdata("GuestUser");
         $query = "
            SELECT C.Quantity, C.ProductId,
            P.SubCategoryId, P.Quantity AS Stock,
            PAV.AttributeValue,
            PAP.Price, PAP.DiscountedPrice
            FROM ".CommonTables::CART." AS C
            LEFT JOIN ".CommonTables::CART_ATTR_VALUE." AS CAV
            ON CAV.CartId = C.Id
            LEFT JOIN ".CommonTables::PRODUCT." AS P
            ON P.Id = C.ProductId
            LEFT JOIN ".CommonTables::PRODUCT_ATTRIBUTE." AS PA
            ON PA.Id = CAV.AttributeId
            LEFT JOIN ".CommonTables::PRODUCT_ATTRIBUTE_VALUE." AS PAV
            ON PAV.Id = CAV.ValueId
            LEFT JOIN ".CommonTables::PRODUCT_ATTRIBUTE_PRICE." AS PAP
            ON PAP.PAVId = CAV.ValueId AND PAP.ProductId = C.ProductId
            WHERE C.UserId='" . $userId . "'
            GROUP BY C.Id";

        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();

        $data = $stmt->fetchAll(PDO::FETCH_OBJ);
        $finalPrice = 0;
        //getting from the session
        $CouponDiscountedPrice = $this->session->userdata("AppliedCouponDiscount") ? $this->session->userdata("AppliedCouponDiscount") : 0;
        foreach ($data as $price) {
          if($price->Stock):
            if($price->DiscountedPrice == 0){
               $finalPrice +=  $price->Price * $price->Quantity;
            }else{
                 $finalPrice +=  $price->DiscountedPrice * $price->Quantity;
            }
          endif;
        }
       return $finalPrice - $CouponDiscountedPrice;
    }

      public function RegisterAndLoginOnCheckout($data){
        $fullName = $data['name'];
        $email = $data['email'];
        $password = $data['phone'];
        $mobile = $data['phone'];
        $userRole = 2;
        $loginType = 1;
          $query = "
          INSERT INTO  " . CommonTables::USER . " SET
          UserRole='" . $userRole . "',
          LoginType='" . $loginType . "',
          FullName='" . $fullName . "',
          Email='" . $email . "',
          PassKey='" . md5($password) . "',
          PassSalt='" . md5($password) . "',
          Mobile='" . $mobile . "',
          IsActive='" . CommonConstants::YES . "',
          IsDeleted='" . CommonConstants::NO . "',
          CreatedOn=UTC_TIMESTAMP(),
          ModifiedOn=UTC_TIMESTAMP()
          ";
          $stmt = $this->pdoConn->prepare($query);
          $stmt->execute();
          $recordId = $this->pdoConn->lastInsertId();
          if($recordId){
            $session = array(
                'Id' => $recordId,
                'Name' => $fullName,
                'Email' => $email,
                'UserRole' => $userRole,
                'IsLoggedIn' => 1,
                'FailedLogin' => 0
            );
            $this->session->set_userdata($session);
            /*--------Updating guest session if user is not logged in---------*/
            if($this->updateGuestUserSession()){
              return true;
            }
          }else{
            return false;
          }
      }

    public function createOrder($NewBillingAddress){
        
        if($this->session->userdata("Id")!=''){
        	$userId = $this->session->userdata("Id");
        }else{
        	$userId = 0;
        }
        $date = date('Y-m-d');
        $orderHash = CommonHelpers::getOrderHash();
        $paymentType = 0;
        $transactionId = 0;
        $currentStatus = 1;
        $isPaid = 0;
        $onlinePaymentStatus = "initiated";
        $hasCoupon = $this->session->userdata("Coupon") ? 1 : 0;
        $totalPrice = $this->getCartTotalPrice();
        /*-----Inserting order in userOrder table-----*/
        $stmt = $this->pdoConn->prepare("
                INSERT INTO ".CommonTables::USER_ORDER."
                SET OrderHash = '".$orderHash."',
                UserId = '".$userId."',
                TotalPrice = '".$totalPrice."',
                PaymentType = '".$paymentType."',
                TransactionId = '".$transactionId."',
                OnlinePaymentStatus = '".$onlinePaymentStatus."',
                CurrentStatus = '".$currentStatus."',
                NewBillingAddress = '".$NewBillingAddress."',
                IsPaid = '".$isPaid."',
                HasCoupon = '".$hasCoupon."',
                CreatedOn = '".$date."'");
                

        if($stmt->execute()){
            return $this->pdoConn->lastInsertId();
			//echo $id;exit();
        }else{
            return false;
        }
    }

    public function saveCreatedOrderDetails($orderId,$cartItems){
        /*------ Getting order hash from last order id--------*/
        $stmt = $this->pdoConn->prepare("
        SELECT  OrderHash FROM ".CommonTables::USER_ORDER."
        WHERE Id = '$orderId'");
        $stmt->execute();
        $lastOrder = $stmt->fetchObject();
        $orderHash = $lastOrder->OrderHash;
        $totalPrice = 0;
        // $CouponDiscountedPrice = $this->session->userdata("AppliedCouponDiscount") ? $this->session->userdata("AppliedCouponDiscount") : 0;

        $stmt = $this->pdoConn->prepare("
                INSERT INTO ".CommonTables::USER_ORDER_DETAIL."
                SET OrderId = '".$orderId."',
                OrderHash = '".$orderHash."',
                ProductId =  :productId,
                UnitPrice =  :unitPrice,
                AttributeId =  :attributeId,
                AttributeValueId =  :attributeValueId,
                DiscountValue =  :discountValue,
                OrderQuantity =  :quantity,
                orderScanID =  :scan_id,
                TotalPrice =  :totalPrice
            ");

        foreach($cartItems as $cartItem){
          if($cartItem->Stock):
            $productId = $cartItem->ProductId;
            $unitPrice = $cartItem->Price;
            $attributeId = $cartItem->AttributeId;
            $attributeValueId = $cartItem->AttributeValueId;
            $discountValue = $cartItem->DiscountedPrice;
            $orderQuantity = $cartItem->Quantity;
            $orderScanID = $cartItem->scan_id;

           if($cartItem->DiscountedPrice == 0){
               $totalPrice +=  $cartItem->Price * $cartItem->Quantity;
            }else{
                 $totalPrice +=  $cartItem->DiscountedPrice * $cartItem->Quantity;
            }

            // $totalPrice -= $CouponDiscountedPrice;
            if($stmt->execute([
                    "productId"         =>      $productId,
                    "unitPrice"         =>      $unitPrice,
                    "attributeId"       =>      $attributeId,
                    "attributeValueId"  =>      $attributeValueId,
                    "discountValue"     =>      $discountValue,
                    "quantity"          =>      $orderQuantity,
                    "scan_id"          =>      $orderScanID,
                    "totalPrice"        =>      $totalPrice
                ])){
                //again setting back to 0;
                $totalPrice = 0;
            }
            endif;
        }

        return true;
    }


     public function saveShippingInformation($orderId=null,$data){
        if($this->session->userdata("Id") > 0){
          $userId = $this->session->userdata("Id");
      }else{
          $userId = 0;
      }
        $parentId = 1;
        $isShipping = 1;
        $name = $data['name'];
        $email = $data['email'];
        $mobile = $data['phone'];
        $address = $data['fullAddress'];
        $landmark = $data['landmark'];
        $state = $data['state'];
        $city = $data['city'];
        $pinCode = $data['pincode'];
        /*-----Inserting order in userOrder table-----*/
        $stmt = $this->pdoConn->prepare("
                INSERT INTO ".CommonTables::BILLINGADDRESS."
                SET ParentId = '".$parentId."',
                FirstName = '".$name."',
                Email = '".$email."',
                Mobile = '".$mobile."',
                Address = '".$address."',
                Landmark = '".$landmark."',
                City = '".$city."',
                State = '".$state."',
                Pincode = '".$pinCode."',
                IsShipping = '".$isShipping."',
                UserId = '".$userId."',
                OrderId = '".$orderId."'");

        if($stmt->execute()){
            return $this->pdoConn->lastInsertId();
        }else{
            return false;
        }
    }
    
    public function updateOrderId($Id){
    $lastOrderId = $this->session->userdata("lastOrderId");
        $stmt = $this->pdoConn->prepare("
                UPDATE ".CommonTables::BILLINGADDRESS."
                SET OrderId = '". $lastOrderId ."'
                
                WHERE Id = '".$Id."'");

            if($stmt->execute()){
                return true;
            }else{
                return false;
            }
    }
    
    public function updateOrderDetails_with_pgresp($pg_response){
        if(strtolower($pg_response['order_status']) == 'success') {
            $stmt = $this->pdoConn->prepare("
                UPDATE ".CommonTables::USER_ORDER."
                SET PaymentType = '5',
                OnlinePaymentStatus = 'success'
                IsPaid = '1'
                payment_mode = '".$pg_response['payment_mode']."'
                pg_response = '".json_encode($pg_response)."'
                WHERE Id = '".$pg_response['order_id']."'");
            
        } else {
            $stmt = $this->pdoConn->prepare("
                UPDATE ".CommonTables::USER_ORDER."
                SET PaymentType = '5',
                OnlinePaymentStatus = 'failure'
                payment_mode = '".$pg_response['payment_mode']."'
                pg_response = '".json_encode($pg_response)."'
                WHERE Id = '".$pg_response['order_id']."'");
        }

        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
            
    }

    public function updateOrderDetails($id){
        $lastOrderId = $this->session->userdata("lastOrderId");
        

        /*-Update the userOrder table info like paymentType,TransactionId,OnlinePaymentStatus,IsPaid -*/

        $stmt = $this->pdoConn->prepare("
                UPDATE ".CommonTables::USER_ORDER."
                SET PaymentType = '2',
                OnlinePaymentStatus = 'success'
                IsPaid = '1'
                
                WHERE Id = '".$lastOrderId."'");
             
                /*WHERE Id = '".$id."'");*/

            if($stmt->execute()){
                return true;
            }else{
                return false;
            }
    }

    public function mapUsedCoupon(){
        $userId = $this->session->userdata("Id");
        $coupon = $this->session->userdata("Coupon");
        $orderId = $this->session->userdata("lastOrderId");
        $stmt = $this->pdoConn->prepare("
                INSERT INTO ".CommonTables::USER_COUPON_MAPPING."
                SET UserId = '".$userId."',
                CouponCode = '".$coupon."',
                OrderId = '".$orderId."',
                UsedOn = '".time()."'
            ");

        if($stmt->execute()){
            $this->session->unset_userdata("Coupon");
        }
    }

    /*public function getShippingAddress(){
      $userId = $this->session->userdata("Id");
      $stmt = $this->pdoConn->prepare("
        SELECT BA.*, U.Mobile
        FROM ".CommonTables::BILLINGADDRESS." AS BA
        LEFT JOIN ".CommonTables::USER." AS U
        ON U.Id = BA.UserId
        WHERE BA.UserId = '".$userId."'
        ORDER BY BA.Id DESC LIMIT 0, 1
      ");
      $stmt->execute();
      return $stmt->fetch(PDO::FETCH_OBJ);
    }*/
    
    public function getShippingAddress(){
      $userId = $this->session->userdata("Id");
      $stmt = $this->pdoConn->prepare("
        SELECT U.*
        FROM ".CommonTables::USER." AS U
       
        WHERE U.Id = '".$userId."'
        ORDER BY U.Id DESC LIMIT 0, 1
      ");
      $stmt->execute();
      return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function getState($pin){
      $stmt = $this->pdoConn->prepare("
        SELECT Id, State FROM ".CommonTables::PIN_CODE."
        WHERE PinCode = '".$pin."'");
      $stmt->execute();
      return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function getCity($pin){
      $stmt = $this->pdoConn->prepare("
        SELECT Id, City FROM ".CommonTables::PIN_CODE."
        WHERE PinCode = '".$pin."'");
      $stmt->execute();
      return $stmt->fetch(PDO::FETCH_OBJ);
    }


    public function getOrderedProductLeftQuantity(){
      $orderId = $this->session->userdata("lastOrderId");
      $stmt = $this->pdoConn->prepare("
        SELECT OD.ProductId, OD.OrderQuantity,
        P.Quantity AS QuantityLeft
        FROM ".CommonTables::USER_ORDER_DETAIL." AS OD
        LEFT JOIN ".CommonTables::PRODUCT." AS P
        ON P.Id = OD.ProductId
        WHERE OD.OrderId = '".$orderId."'");
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_OBJ);

    }

    public function updateProductQuantity($productId, $qauntity){
      $stmt = $this->pdoConn->prepare("
              UPDATE ".CommonTables::PRODUCT."
              SET Quantity = '$qauntity'
              WHERE Id = '$productId'
          ");
          $stmt->execute();
    }

    public function getLastOrder($orderId){
      $userId = $this->session->userdata("Id");
      if($this->session->userdata("Id") > 0){
          $userId = $this->session->userdata("Id");
      }else{
          $userId = 0;
      }
      
      $stmt =  $this->pdoConn->prepare("
        SELECT O.Id, O.TotalPrice, O.NewBillingAddress,
        BA.FirstName,BA.Email,BA.Mobile,BA.Address,BA.Landmark,
        BA.City,BA.State,BA.PinCode,
        UC.DiscountedPrice AS CouponDiscountedPrice
        FROM ".CommonTables::USER_ORDER." AS O
        LEFT JOIN ".CommonTables::BILLINGADDRESS." AS BA
        ON BA.OrderId = O.Id
        LEFT JOIN ".CommonTables::USER_COUPON_MAPPING." AS UC
        ON UC.OrderId = O.Id AND UC.UserId = O.UserId
        WHERE O.UserId = '".$userId."' AND O.Id = '".$orderId."'
        ORDER BY O.Id DESC LIMIT 0, 1");

        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function getLastOrderDetail($orderId){
      $stmt =  $this->pdoConn->prepare("
        SELECT OD.OrderQuantity, OD.UnitPrice, OD.TotalPrice,
        P.ProductName,
        PAV.AttributeValue
        FROM ".CommonTables::USER_ORDER_DETAIL." AS OD
        LEFT JOIN ".CommonTables::PRODUCT." AS P
        ON P.Id = OD.ProductId
        LEFT JOIN ".CommonTables::PRODUCT_ATTRIBUTE_VALUE." AS PAV
        ON PAV.Id = OD.attributeValueId
        WHERE OD.OrderId = {$orderId}
        GROUP BY OD.Id DESC");

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getbillingAddress($addressId){
      $stmt =  $this->pdoConn->prepare("
        SELECT FirstName,Email,Mobile,Address,Landmark,City,State,PinCode
        FROM ".CommonTables::BILLINGADDRESS."
        WHERE Id = {$addressId} LIMIT 0, 1");

        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
    
     public function getOrderdetailsid($id){
         $stmt = $this->pdoConn->prepare("SELECT O.*, B.* 
                FROM  ".CommonTables::USER_ORDER." AS O
                INNER JOIN ".CommonTables::BILLINGADDRESS." AS B
                ON O.NewBillingAddress = B.Id WHERE O.Id = '".$id."'
            ");
         $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
         
     }
     
    public function orderSuccess($orderId)
    {
        $query = "SELECT * FROM " . CommonTables::USER_ORDER_DETAIL . " WHERE OrderId=$orderId";
        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result;
    }

    public function changeOrderStatus($orderId)
    {
        $query = "UPDATE " . CommonTables::USER_ORDER . " SET CurrentStatus='2' WHERE Id=$orderId";
        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result;
    }

    public function notifyUser($orderId){
      $stmt =  $this->pdoConn->prepare("
        SELECT O.Id,NewBillingAddress,
        BA.FirstName,BA.Email,BA.Mobile
        FROM ".CommonTables::USER_ORDER." AS O
        LEFT JOIN ".CommonTables::BILLINGADDRESS." AS BA
        ON BA.OrderId = O.Id
        WHERE O.Id = {$orderId}");

        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

}

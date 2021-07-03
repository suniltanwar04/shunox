<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: Amit
 * Date: 22-10-2016
 * Time: PM 08:30
 */
class SiteCart_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->pdo = $this->load->database('pdo', true);
        $this->pdoConn = $this->pdo->conn_id;
    }

    public function unsetSessions(){
      //sessions array when user logged in, not destroying these sessions if user is logged in
      $requiredSessions = ['__ci_last_regenerate','Id','Name','Email','UserRole','IsLoggedIn','FailedLogin'];
      foreach($_SESSION as $key => $value){
          if(!in_array($key, $requiredSessions)){
              unset($_SESSION[$key]);
          }
      }
    }

    public function getCart($userId = null){
      $user='';
      if($userId != null){
        $user = $userId;
      }else{
        if($this->session->userdata("IsLoggedIn")){
          $user = $this->session->userdata("Id");
        }

        if($this->session->userdata("GuestUser")){
          $user = $this->session->userdata("GuestUser");
        }
      }

    $query = "
            SELECT C.Id AS CartId, C.Quantity, C.scan_id, C.ProductId,
            CAV.AttributeId, CAV.ValueId AS AttributeValueId,
            P.ProductName, P.SubCategoryId, P.ShowToUser, P.Quantity AS Stock,
            PA.AttributeName,
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
            WHERE C.UserId='" . $user . "'";
        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        if(!$stmt->rowCount()){
            //unsetting the session like cartTotalPrice, appliedCouponcode if cart is empty
            $this->unsetSessions();
        }
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
		// print_r($result);
		// die();
        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }
    }

    public function getCartProduct($productId){
        $user='';

            if($this->session->userdata("Id")){
                $user = $this->session->userdata("Id");
            }

            if($this->session->userdata("GuestUser")){
                $user = $this->session->userdata("GuestUser");
            }


        $query = "
            SELECT C.Id AS CartId, C.Quantity, C.ProductId,

            P.ProductName, P.SubCategoryId, P.ShowToUser, P.Quantity AS Stock,

            P.Price, P.DiscountedPrice
            FROM ".CommonTables::CART." AS C

            LEFT JOIN ".CommonTables::PRODUCT." AS P
            ON P.Id = C.ProductId

            WHERE C.UserId='" . $user . "' AND P.Id = '".$productId."'";

        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        if(!$stmt->rowCount()){
            //unsetting the session like cartTotalPrice, appliedCouponcode if cart is empty
            $this->unsetSessions();
        }
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }
    }


    public function getProductAttrPrice($productId, $attributeId, $attributeValueId)
    {

        $query = "
                  SELECT
            IFNULL(PAP.Price, '') AS Price,
            IFNULL(PAP.DiscountedPrice, '') AS DiscountedPrice

            FROM " . CommonTables::PRODUCT_ATTRIBUTE_MAPPING . " PAM
            INNER JOIN " . CommonTables::PRODUCT_ATTRIBUTE_VALUE_MAPPING . " PAVM ON PAVM.ProAttrMappingId=PAM.Id
            INNER JOIN " . CommonTables::PRODUCT_ATTRIBUTE_PRICE . " PAP ON PAP.PAVId=PAVM.Id

            WHERE 1=1
            AND PAM.ProductId='" . $productId . "'
            AND PAM.AttributeId='" . $attributeId . "'
            AND PAVM.AttrValueId='" . $attributeValueId . "'
            AND PAP.ProductId='" . $productId . "'
            ";

        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }
    }

    public function updateCartQuantity($cartId, $quantity)
    {
        $query = "
            UPDATE " . CommonTables::CART . " SET
            Quantity='" . $quantity . "'
            WHERE Id='" . $cartId . "'";
        $stmt = $this->pdoConn->prepare($query);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
	public function updateScanId($cartId, $scan_id)
    {	
		
        $query = "
            UPDATE " . CommonTables::CART . " SET
            scan_id='" . $scan_id . "'
            WHERE Id='" . $cartId . "'";
        $stmt = $this->pdoConn->prepare($query);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function clearCart($userId = null)
    {
        if($userId != null){
             $query = "DELETE FROM " . CommonTables::CART . "
            WHERE UserId='" . $userId . "'";
        }else{
             $query = "DELETE FROM " . CommonTables::CART . "
            WHERE UserType = '1'";
        }


        $stmt = $this->pdoConn->prepare($query);
        if ($stmt->execute()) {
            //unsetting the session like cartTotalPrice, appliedCouponcode if cart is empty
          //$this->unsetSessions();
            return true;
        } else {
            return false;
        }
    }

    public function removeCartItem($cartId) {
        $stmt = $this->pdoConn->prepare("DELETE FROM " . CommonTables::CART ." WHERE Id='" . $cartId . "'");
        if ($stmt->execute()) {
            $stmt = $this->pdoConn->prepare("DELETE FROM " . CommonTables::CART_ATTR_VALUE . " WHERE CartId='" . $cartId . "'");
            if($stmt->execute()){
                return true;
            }else{
                return false;
            }
        } else {
            return false;
        }
    }

    public function removeWishList($userId, $cartId)
    {
        $query = "DELETE FROM " . CommonTables::WISHLIST . "
                  WHERE UserId='" . $userId . "'
                  AND Id='" . $cartId . "'";
        $stmt = $this->pdoConn->prepare($query);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /*-------------------------------------------------*/

    public function checkWishList($userId, $productId)
    {
        $query = "  SELECT
W.Id AS WishListId
FROM " . CommonTables::WISHLIST . " W
WHERE 1=1
AND W.UserId='" . $userId . "'
AND W.ProductId='" . $productId . "'
";
        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }
    }


    public function addWishList($userId, $productId)
    {

        $query = "
INSERT INTO " . CommonTables::WISHLIST . "  SET
UserId='" . $userId . "',
ProductId='" . $productId . "',
CreatedOn=UTC_TIMESTAMP()
";
        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        $recordId = $this->pdoConn->lastInsertId();
        if ($recordId > 0) {
            return $recordId;
        } else {
            return false;
        }

    }


    public function getCartCount($userId)
    {

        $query = "
                SELECT
                COUNT(C.Id) AS ProductCount
                FROM " . CommonTables::CART . " C
                
                WHERE 1=1
                AND C.UserId='" . $userId . "'
                ";

        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }
    }
	public function getUserName($userId)
    {
        $query = "
                SELECT
                FullName AS name
                FROM user WHERE Id='" . $userId . "'
                ";
		//echo $query; 
        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }
    }


    public function checkCart($userId, $productId, $attributeId = NULL, $attributeValueId = NULL)
    {
        $query = "
            SELECT
            C.Id AS CartId,
            IFNULL(C.Quantity,'0') AS Quantity
            FROM ".CommonTables::CART." C
            INNER JOIN ".CommonTables::CART_ATTR_VALUE." CAV ON CAV.CartId = C.Id
            WHERE 1=1
            AND C.UserId='" . $userId . "'
            AND C.ProductId='" . $productId . "'
            AND CAV.AttributeId='" . $attributeId . "'
            AND CAV.ValueId='" . $attributeValueId . "'
            ";
        
        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }
    }


    public function addToCart($userId, $productId, $quantity, $attributeId, $attributeValueId,$userType)
    {

        $query = "INSERT INTO ".CommonTables::CART."
                 (UserId,ProductId,Quantity,UserType) VALUE ('$userId', '$productId', '$quantity','$userType')";
        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        $recordId = $this->pdoConn->lastInsertId();

        if ($recordId > 0) {
            $this->setCartAttribute($recordId, $attributeId, $attributeValueId);
            return $recordId;
        } else {
            return false;
        }
    }


    public function setCartAttribute($cartId, $attributeId, $attributeValueId)
    {
        $query = "
                INSERT INTO " . CommonTables::CART_ATTR_VALUE . "  SET
                CartId='" . $cartId . "',
                AttributeId='" . $attributeId . "',
                ValueId='" . $attributeValueId . "'
                ";
        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        $recordId = $this->pdoConn->lastInsertId();
        if ($recordId > 0) {
            return $recordId;
        } else {
            return false;
        }
    }

     public function getPriceFromCart(){
        $userId = CommonHelpers::getLoggedUser();
         $query = "SELECT Id AS CartId, Price FROM ".CommonTables::CART."
            WHERE UserId='" . $userId . "' GROUP BY Id";


        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }
    }

    public function validateAndApplyCoupon($data){
        $userId = CommonHelpers::getLoggedUser();
        $coupon = $data['coupon'];
        $products = $data['products'];
        //checking wheater coupon is  applied already or not
        if(!$this->session->userdata("Coupon") == $coupon){
            $stmt = $this->pdoConn->prepare("
                    SELECT ItemType, ItemId, DiscountType, DiscountValue
                    FROM ".CommonTables::COUPON. "
                     WHERE (CouponCode = :coupon AND ValidTill >= :expiration AND IsActive = 1)");
            $stmt->execute(['coupon' =>  $coupon, "expiration" =>  time()]);
            if($stmt->rowCount()){
                $check = $this->pdoConn->prepare("
                    SELECT Id FROM ".CommonTables::USER_COUPON_MAPPING. "
                     WHERE UserId = :user AND CouponCode = :coupon");

                $check->execute(["user" =>  $userId, "coupon" =>  $coupon]);
                if($check->rowCount()){
                    return -2;
                }else{
                    $couponData = $stmt->fetchObject();

                    /*---------------Coupon Data------------------*/
                    $itemType = $couponData->ItemType;
                    $itemId = $couponData->ItemId;
                    $DiscountType = $couponData->DiscountType;
                    $DiscountValue = $couponData->DiscountValue;

                    /*---------------Current user cart data--------------------*/

                    $cartProducts = $this->getCart($userId);

                    /*---------------Query to update the cart------------------*/
                    $finalPrice = 0;
                    if($itemType == 1){
                        foreach($cartProducts as $cartProduct){
                            if($cartProduct->DiscountedPrice == 0){
                              if($cartProduct->Stock):
                               $finalPrice +=  $cartProduct->Price * $cartProduct->Quantity;
                             endif;
                            }else{
                              if($cartProduct->Stock):
                                 $finalPrice +=  $cartProduct->DiscountedPrice * $cartProduct->Quantity;
                               endif;
                            }
                        }

                        $discountedPrice = CommonHelpers::getDiscountedPrice(
                            $DiscountType, $DiscountValue, $finalPrice);

                        $priceAfterDiscount = $finalPrice - $discountedPrice;

                        /*-----Setting the coupon discount to session to get it on each page dynamically-----*/
                       $this->session->set_userdata("AppliedCouponDiscount",$discountedPrice);
                    }else if($itemType == 2){
                        foreach($cartProducts as $cartProduct){
                            if($cartProduct->SubCategoryId == $itemId){
                                if($cartProduct->DiscountedPrice == 0){
                                  if($cartProduct->Stock):
                                   $finalPrice +=  $cartProduct->Price * $cartProduct->Quantity;
                                 endif;
                                }else{
                                     $finalPrice +=  $cartProduct->DiscountedPrice * $cartProduct->Quantity;
                                }
                            }
                        }

                        $discountedPrice = CommonHelpers::getDiscountedPrice(
                            $DiscountType, $DiscountValue, $finalPrice);

                        $priceAfterDiscount = $finalPrice - $discountedPrice;
                        /*-----Setting the coupon discount to session to get it on each page dynamically-----*/
                        $this->session->set_userdata("AppliedCouponDiscount",$discountedPrice);
                    }else{
                        if($itemType == 3){
                            foreach($cartProducts as $cartProduct){
                                if($cartProduct->ProductId == $itemId){
                                    if($cartProduct->DiscountedPrice == 0){
                                      if($cartProduct->Stock):
                                       $finalPrice +=  $cartProduct->Price * $cartProduct->Quantity;
                                     endif;
                                    }else{
                                      if($cartProduct->Stock):
                                         $finalPrice +=  $cartProduct->DiscountedPrice * $cartProduct->Quantity;
                                       endif;
                                    }
                                }
                            }

                            $discountedPrice = CommonHelpers::getDiscountedPrice(
                                $DiscountType, $DiscountValue, $finalPrice);
                            $priceAfterDiscount = $finalPrice - $discountedPrice;
                            /*-----Setting the coupon discount to session to get it on each page dynamically-----*/
                             $this->session->set_userdata("AppliedCouponDiscount",$discountedPrice);
                        }
                    }
                   $this->session->set_flashdata("couponApplied",1);
                    //setting session key with coupon code to check above
                   $this->session->set_userdata("Coupon",$coupon);
                   return 1;
                }
            }else{
                return -1;
            }
        }else{
            return -2;
        }
    }

    public function productAttributes($productId){
        $stmt = $this->pdoConn->prepare("
            SELECT PAM.AttributeId,
            PAVM.AttrValueId,
            PAV.AttributeValue
            FROM  ".CommonTables::PRODUCT_ATTRIBUTE_MAPPING." AS PAM
            LEFT JOIN ".CommonTables::PRODUCT_ATTRIBUTE_VALUE_MAPPING." AS PAVM
            ON PAVM.ProAttrMappingId = PAM.Id
            LEFT JOIN ".CommonTables::PRODUCT_ATTRIBUTE_VALUE." AS PAV
            ON PAV.Id = PAVM.AttrValueId
            WHERE PAM.ProductId = ".$productId."
            GROUP BY PAVM.Id
        ");

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function changeCartAttributeValue($cart,$attrValue){
      $query = "
          UPDATE " . CommonTables::CART_ATTR_VALUE . " SET
          ValueId='" . $attrValue . "'
          WHERE CartId ='" . $cart . "'";
      $stmt = $this->pdoConn->prepare($query);
      if ($stmt->execute()) {
          return 1;
      } else {
          return 2;
      }
    }

    public function changeScanId($sel_scan_id){
        $userId = null;
        $user='';
        if($userId != null){
          $user = $userId;
        }else{
          if($this->session->userdata("IsLoggedIn")){
            $user = $this->session->userdata("Id");
          }
  
          if($this->session->userdata("GuestUser")){
            $user = $this->session->userdata("GuestUser");
          }
        }
        $query = "UPDATE " . CommonTables::CART . " SET scan_id	= $sel_scan_id WHERE UserId=$user";
      
          $stmt = $this->pdoConn->prepare($query);
          $stmt->execute();
          $result = $stmt->fetchAll(PDO::FETCH_OBJ);
          if (!empty($result)) {
              return $result;
          } else {
              return false;
          }
      }


}

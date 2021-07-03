<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
include APPPATH . "modules/common/controllers/Common.php";

/**
 * Created by PhpStorm.
 * User: Amit
 * Date: 22-10-2016
 * Time: PM 08:30
 */
class SiteCart extends MY_Controller
{

    public function __construct(){
        parent::__construct();
        $this->load->model(array('SiteCart_model','Site_model'));
    }

    public function index(){
		
        if(!CommonHelpers::getLoggedUser()){
            redirect(base_url());
        }
        $data['cartProducts'] = $this->SiteCart_model->getCart();

        $data['jquery'] = 'site/cart/js/cart-js';
        $data['content'] = 'site/cart/index';
		
        echo Modules::run('template/siteTemplate', $data);
    }


    public function addToWishlist()
    {
        $this->Common_model->siteLoginCheck();
        $productId = $this->input->post('productId');
        $attributeId = $this->input->post('attributeId');
        $attributeValueId = $this->input->post('attributeValueId');
        $userId = $this->session->userdata('Id');
        $checkWishList = $this->SiteCart_model->checkWishList($userId, $productId);

        if ($checkWishList) {
            echo -2;
        } else {
            $addWishList = $this->SiteCart_model->addWishList($userId, $productId);
            if ($addWishList) {
                echo 1;
            } else {
                echo -1;
            }
        }
    }

    public function addToCart(){
        if($this->session->userdata("IsLoggedIn")){
           $userId = $this->session->userdata("Id");
           $userType = 0;
        }else{
            if($this->session->userdata("GuestUser")){
                $userId = $this->session->userdata("GuestUser");
                $userType = 1;
            }else{
                $userId = substr(uniqid(),-6);
                $this->session->set_userdata("GuestUser",$userId);
                $this->session->set_userdata("cartvalue",$userId);
                $userType = 1;
            }
        }

        $productId = $this->input->post('productId');
        $quantity = $this->input->post('quantity');
        $attributeId = $this->input->post('attributeId');
        $attributeValueId = $this->input->post('attributeValueId');

        $checkCart = $this->SiteCart_model->checkCart($userId, $productId, $attributeId, $attributeValueId);

        if ($checkCart) {
            echo -2;
        } else {
            $addToCart = $this->SiteCart_model->addToCart($userId, $productId, $quantity, $attributeId, $attributeValueId,$userType);
            if ($addToCart) {
                echo 1;
            } else {
                echo -1;
            }
        }
    }

    public function clearCart(){
        if($this->SiteCart_model->clearCart($_POST['userId'])){
            echo 1;
        }else{
            echo 0;
        }
    }

    public function removeCartItem(){
        if($this->SiteCart_model->removeCartItem($_POST['cartId'])){
            echo 1;
        }else{
            echo 0;
        }
    }

    public function updateCartQauntity(){
        sleep(2);
        if($this->SiteCart_model->updateCartQuantity($_POST['cartId'],$_POST['qauntity'])){
            echo 1;
        }else{
            echo 0;
        }
    }
	public function updateScanID(){
        sleep(2);
        if($this->SiteCart_model->updateScanId($_POST['cartId'],$_POST['scan_id'])){
            echo 1;
        }else{
            echo 0;
        }
    }


    public function validateAndApplyCoupon(){
        echo $this->SiteCart_model->validateAndApplyCoupon($_POST);
    }

    public function changeCartAttributeValue(){
      sleep(2);
      $cart = $this->input->post("cart");
      $attrValue = $this->input->post("attrVal");
      echo $this->SiteCart_model->changeCartAttributeValue($cart,$attrValue);
    }
    
    
    

}

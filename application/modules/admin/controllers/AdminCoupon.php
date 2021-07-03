<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');
include APPPATH . "modules/common/controllers/Common.php";

/**
 * Created by PhpStorm.
 * User: Amit
 * Date: 22-10-2016
 * Time: PM 08:30
 */

class AdminCoupon extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('AdminCoupon_model'));
    }

    public function couponlist()
    {
        $this->Common_model->loginCheck();
        $data['coupons'] = $this->AdminCoupon_model->getCoupon();
        $data['jquery'] = 'admin/coupon/js/coupon-js';
        $data['content'] = 'admin/coupon/index';
        echo Modules::run('template/adminTemplate', $data);
    }

    public function subCategories(){
        $data['subCategories'] = $this->AdminCoupon_model->getSubCategory();
        $this->load->view('coupon/services/subCategories',$data);
    }

    public function allProducts(){
        $data['products'] = $this->AdminCoupon_model->getAllProducts();
        $this->load->view('coupon/services/products',$data);
    }

    public function addCoupon(){
        sleep(2);
        if($this->AdminCoupon_model->checkExistCoupon($_POST['coupon'])){
            echo $this->AdminCoupon_model->saveCoupon($_POST);
        }else{
            //means coupon already exists
            echo -1;
        }
    }


}

?>

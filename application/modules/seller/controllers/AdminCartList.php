<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');
include APPPATH . "modules/common/controllers/Common.php";

/**
 * Created by PhpStorm.
 * User: Amit
 * Date: 22-10-2016
 * Time: PM 08:30
 */

class AdminCartList extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('AdminCartList_model'));
    }

    public function index(){
        $this->Common_model->sellerLoginCheck();
        $data['items'] = $this->AdminCartList_model->getCartList();
        // echo "<pre>";
        // print_r($data['items']);
        // die;
        $data['jquery'] = 'seller/cart-list/js/cart-list-js';
        $data['content'] = 'seller/cart-list/index';
        echo Modules::run('template/adminTemplate', $data);
    }
}

?>

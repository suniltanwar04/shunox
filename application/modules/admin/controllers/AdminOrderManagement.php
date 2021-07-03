<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
include APPPATH . "modules/common/controllers/Common.php";
/**
 * Created by PhpStorm.
 * User: Amit
 * Date: 22-10-2016
 * Time: PM 08:30
 */
class AdminOrderManagement extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('AdminOrderManagement_model'));
    }

    public function index()
    {
        $this->load->view('login/index');
    }

    public function dashboard()
    {
        $this->Common_model->loginCheck();
        $data['jquery'] = 'admin/dashboard/admin/js/dashboard-js';
        $data['content'] = 'admin/dashboard/admin/index';
        echo Modules::run('template/adminTemplate', $data);
    }

    public function orderManagement(){
        $this->Common_model->loginCheck();
        $data['OrderManagements'] = $this->AdminOrderManagement_model->getOrderManagement();
        //print_r($data['OrderManagements']);
        //die;
        $data['jquery'] = 'admin/order-management/js/order-management-js';
        $data['content'] = 'admin/order-management/index';
        echo Modules::run('template/adminTemplate', $data);
    }


    public function orderCouponListing(){

        $this->Common_model->loginCheck();
        $recordId = $this->input->post('recordId');
        $data['products'] = $this->AdminOrderManagement_model->getCouponById($recordId);
        if ($data) {

            $this->load->view('admin/order-management/services/order-wise-product-details-coupon', $data);
        } else {
            echo -1;
        }
    }


    public function orderWiseProductDetails($id){
        $this->Common_model->loginCheck();
        $recordId = $id;
        $data['OrderWiseProducts'] = $this->AdminOrderManagement_model->orderWiseProductDetails($recordId);

        $data['jquery'] = 'admin/order-management/js/order-management-js';
        $data['content'] = 'admin/order-management/services/order-wise-product-details';
        echo Modules::run('template/adminTemplate', $data);
    }

    public function currentStatus(){

        $this->Common_model->loginCheck();
        $currentstatusId = $this->input->post('currentstatusId');
        $recordId = $this->input->post('recordId');
        $currentStatus = $this->AdminOrderManagement_model->currentStatus($currentstatusId,$recordId);

        if ($currentStatus) {
             $order = $this->AdminOrderManagement_model->notifyUser($recordId);
             if($order->NewBillingAddress > 0){
               $billingAddress = $this->AdminOrderManagement_model->getbillingAddress($order->NewBillingAddress);
               $order->FirstName = $billingAddress->FirstName;
               $order->Email = $billingAddress->Email;
               $order->Mobile = $billingAddress->Mobile;
             }

              $subject = 'Order Status';
              $commonMessage = "Thanks And Regards \r\n<br>";
              $commonMessage .= "Team SHUNOX";
			  //$message = "<img src='".base_url()."assets/site/images/logo.png' width='250px'>";
            if($currentstatusId == 2) {
                $message = "Hi, " . $order->FirstName . "\r\n<br>";
                $message .= "Your Order is in process\r\n<br>";
                $message .= $commonMessage;
            }
            if($currentstatusId == 3) {
                $message = "Hi, " . $order->FirstName . "\r\n<br>";
                $message .= "Your Order is Dispatched\r\n<br>";
                $message .= $commonMessage;
            }
            if($currentstatusId == 4) {
                $message = "Hi, " . $order->FirstName . "\r\n<br>";
                $message .= "Your Order is Delivered\r\n<br>";
                $message .= $commonMessage;
            }
            if($currentstatusId == 5) {
                $message = "Hi, " . $order->FirstName . "\r\n<br>";
                $message .= "Your Order is Cancelled\r\n<br>";
                $message .= $commonMessage;
            }
            $Common = new Common();
            $sendStatus = $Common->sendMailNewsletter($subject, $message, $order->Email);

            if($sendStatus) {
                echo 1;
            }
        } else {
            echo -1;
        }
    }
    
     public function getStatusByOrder(){
        $this->Common_model->loginCheck();
        $status = $this->input->post('recordId');
        $data['OrderManagements'] = $this->AdminOrderManagement_model->getStatusByOrder($status);


        $this->load->view('admin/order-management/services/order-list', $data);
    }
    
     public function deleteOrderManagement(){
     
        $recordId = $this->input->post('recordId');
        $deleteLoc = $this->AdminOrderManagement_model->deleteOrderManagement($recordId);
        if($deleteLoc){
        echo 1;
        }else{
         echo -1;
        }
    }

}

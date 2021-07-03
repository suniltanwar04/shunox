<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');
include APPPATH . "modules/common/controllers/Common.php";

/**
 * Created by PhpStorm.
 * User: Amit
 * Date: 22-10-2016
 * Time: PM 08:30
 */

class AdminNotifyList extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('AdminNotifyList_model'));
    }

    public function index(){
        $this->Common_model->loginCheck();
        $data['items'] = $this->AdminNotifyList_model->getNotifyUsers();
        // echo "<pre>";
        // print_r($data['items']);
        // die;
        $data['jquery'] = 'admin/notify-me/js/notify-list-js';
        $data['content'] = 'admin/notify-me/index';
        echo Modules::run('template/adminTemplate', $data);
    }
}

?>

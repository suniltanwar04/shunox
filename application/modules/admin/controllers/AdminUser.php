<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
include APPPATH . "modules/common/controllers/Common.php";

/**
 * Created by PhpStorm.
 * User: Amit
 * Date: 22-10-2016
 * Time: PM 08:30
 */
class AdminUser extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('AdminLogin_model', 'AdminUser_model'));
    }


    public function usersByType($userType)
    {
        $this->Common_model->loginCheck();
        $data['users'] = $this->AdminUser_model->getUsersByType($userType);
        if ($userType == CommonConstants::USER_TYPE_DRIVER) {
            $data['jquery'] = 'admin/users/driver/js/driver-js';
            $data['content'] = 'admin/users/driver/index';
            echo Modules::run('template/adminTemplate', $data);
        } else {
            echo '404';
        }


    }


}

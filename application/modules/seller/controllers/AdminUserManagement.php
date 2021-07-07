<?php

/**
 * Created by PhpStorm.
 * User: Amit
 * Date: 22-10-2016
 * Time: PM 08:30
 */
class AdminUserManagement extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('AdminUserManagement_model'));
    }

    public function index()
    {
        $this->load->view('login/index');
    }

    public function dashboard()
    {
        $this->Common_model->sellerLoginCheck();
        $data['jquery'] = 'seller/dashboard/admin/js/dashboard-js';
        $data['content'] = 'seller/dashboard/admin/index';
        echo Modules::run('template/adminTemplate', $data);
    }

    public function userManagement(){

        $this->Common_model->sellerLoginCheck();
        $data['UserManagements'] = $this->AdminUserManagement_model->getUserManagement();
//        print_r($data);die;
        $data['jquery'] = 'seller/user-management/js/user-management-js';
        $data['content'] = 'seller/user-management/index';
        echo Modules::run('template/adminTemplate', $data);
    }

    public function enableDisableUsers(){

        $this->Common_model->sellerLoginCheck();
        $recordId = $this->input->post('recordId');
        $isActive = $this->input->post('isActive');
        $activate = $this->AdminUserManagement_model->enableDisableUsers($recordId, $isActive);
        if ($activate) {
            $data['UserManagements'] = $this->AdminUserManagement_model->getUserManagement();
            $this->load->view('seller/user-management/services/user-management-list', $data);
        } else {
            echo -1;
        }
    }

    public function deleteUser(){

        $this->Common_model->sellerLoginCheck();
        $recordId = $this->input->post('recordId');
        $deleteUser = $this->AdminUserManagement_model->deleteUser($recordId);

        if ($deleteUser) {
            $data['UserManagements'] = $this->AdminUserManagement_model->getUserManagement();
            $this->load->view('seller/user-management/services/user-management-list', $data);
        } else {
            echo -1;
        }
    }

public function getUserDetailById($id){
    $this->Common_model->sellerLoginCheck();
    $recordId = $id;
    $data['userdetails'] = $this->AdminUserManagement_model->getUserDetailById($recordId);
//        print_r($data);die;
    $data['jquery'] = 'seller/user-management/js/user-management-js';
    $data['content'] = 'seller/user-management/services/user-detail';
    echo Modules::run('template/adminTemplate', $data);
}

public function getUserEditById($id){
    $this->Common_model->sellerLoginCheck();
    $recordId = $id;
    $data['userdetails'] = $this->AdminUserManagement_model->getUserDetailById($recordId);
	$data['countries'] = $this->Common_model->getCountries();
		
	$data['states'] = $this->Common_model->getState($data['userdetails']->Country);
       
        $data['cities'] = $this->Common_model->getCity($data['userdetails']->State);
    $data['jquery'] = 'seller/scanning/js/scanning-js';
    $data['content'] = 'seller/user-management/services/user-edit';
    echo Modules::run('template/adminTemplate', $data);
}
public function getListUserWiseOrderProductById($id){
    $this->Common_model->sellerLoginCheck();
    $recordId = $id;
    $data['userWiseOrdersProducts'] = $this->AdminUserManagement_model->getListUserWiseByOrderId($recordId);
    //echo "<pre>";      print_r($data['userWiseOrdersProducts']);die;
    $data['jquery'] = 'seller/user-management/js/user-management-js';
    $data['content'] = 'seller/user-management/services/list-user-wise-orders-product';
    echo Modules::run('template/adminTemplate', $data);
}

 public function userUpdate($id){
	$post = $this->input->post();
       $user= $this->AdminUserManagement_model->userUpdate($post, $id); 
       if($user){
		redirect('seller/user-management');
	}else{
		
		
	}	
}

public function userPasswordUpdate(){
	$post = $this->input->post();
	$id = $this->input->post('id');
       $user= $this->AdminUserManagement_model->userPasswordUpdate($post, $id); 
       if($user){
		echo 1;
	}else{
		echo -1;
		
	}	
}

public function editPassword()
    {

        $this->Common_model->sellerLoginCheck();
        $data['user_id'] = $this->input->post('recordId');
       
        
            $this->load->view('seller/user-management/model/change-password', $data);
      
    }

}




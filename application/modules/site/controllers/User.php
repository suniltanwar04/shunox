<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
include APPPATH . "modules/common/controllers/Common.php";

/**
 * Created by PhpStorm.
 * User: Amit
 * Date: 22-10-2016
 * Time: PM 08:30
 */
class User extends MY_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('User_model', 'Common_model'));
        if(!$this->session->userdata("Id")){
          redirect(base_url());
        }
    }

    public function userProfile(){

        $data['profile_datail'] = $this->User_model->getProfile();
        $data['jquery'] = 'site/user/js/user-js';
        $data['content'] = 'site/user/index';
        echo Modules::run('template/siteTemplate', $data);
    }

    public function changePassword(){
        $data['profile_datail'] = $this->User_model->getProfile();
        $data['jquery'] = 'site/user/js/user-js';
        $data['content'] = 'site/user/change-password';
        echo Modules::run('template/siteTemplate', $data);
    }

    public function userOrders(){
        $data['profile_datail'] = $this->User_model->getProfile();
        $data['orders'] = $this->User_model->myOrders();
        $data['jquery'] = 'site/user/js/user-js';
        $data['content'] = 'site/user/my-orders';
        echo Modules::run('template/siteTemplate', $data);
    }

    public function editProfile(){
       
        $data['profile_datail'] = $this->User_model->getProfile();
        $data['countries'] = $this->Common_model->getCountries();
        $data['states'] = $this->Common_model->getState($data['profile_datail']->Country);
       
        $data['cities'] = $this->Common_model->getCity($data['profile_datail']->State);
       
        $data['jquery'] = 'site/user/js/user-js';
        $data['content'] = 'site/user/edit-profile';
        echo Modules::run('template/siteTemplate', $data);
    }

    public function updatePassword(){
        sleep(3);
       echo $this->User_model->updateUserPassword($_POST);
    }

    public function updateUserProfile(){
        sleep(2);
        if(isset($_FILES['profile_pic']) && !empty($_FILES['profile_pic']['name'])){
            $file_name = $_FILES['profile_pic']['name'];
            $file_size = $_FILES['profile_pic']['size'];
            $tmp_name = $_FILES['profile_pic']['tmp_name'];
            if($file_size <= 2097152){
                 $ext = explode('.', $file_name);
                $file_name = substr(md5(uniqid()),0,10).'.'.end($ext);
                $path = FCPATH . 'assets/site/images/'.$file_name;
                if(move_uploaded_file($tmp_name,$path)){
                   if($this->User_model->updateUserProfilePicture($file_name)){
                       echo $this->User_model->updateUserProfile($_POST);
                   }
                }else{
                    // -2 means there are some issue in uploading the file
                   echo -2;
                }
            }else{
                // -1 means uploading file size is larger than allowed size
                echo -1;
            }
        }else{
            echo $this->User_model->updateUserProfile($_POST);
        }
	}
	
	 public function userWishlist(){
        $data['profile_datail'] = $this->User_model->getProfile();
        $data['wishlists'] = $this->User_model->myWishlist();
        $data['jquery'] = 'site/user/js/user-js';
        $data['content'] = 'site/user/my-wishlist';
        echo Modules::run('template/siteTemplate', $data);
    }
    
    public function removeWishlist(){
	
	$proid = $this->input->post("proid");
        $data['profile_datail'] = $this->User_model->getProfile();
        $wishlist = $this->User_model->removeWishlist($proid);
        if($wishlist){
            echo 1;
        }
    }
    
    public function scanning(){
       
        $data['profile_datail'] = $this->User_model->getProfile();
        $data['jquery'] = 'site/user/js/user-js';
        $data['content'] = 'site/user/scan-document';
        echo Modules::run('template/siteTemplate', $data);
    }
	public function scanning_list(){
		
        $data['profile_datail'] = $this->User_model->getProfile();
		$mobile_number = $data['profile_datail']->Mobile;
		$email = $data['profile_datail']->Email;
		// echo $email;
		// die;
		$url = "http://webservice.shunox.in/Service1.svc/getScannings/". $email."/".$mobile_number."";
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
		curl_close($ch);
		$response = json_decode($response, true);
		
		$data['lists'] = $response['getScanningsResult']['Scans'];
		//print_r($data['lists']);
		//die();
        $data['jquery'] = 'site/user/js/user-js';
        $data['content'] = 'site/user/scanning-list';
        echo Modules::run('template/siteTemplate', $data);
    }
	
	public function pdf_download(){
		
		$data_id = $this->uri->segment(3);
        $data['profile_datail'] = $this->User_model->getProfile();
		$url = "http://webservice.shunox.in/Service1.svc/getScan/".$data_id."";
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
		curl_close($ch);
		$response = json_decode($response, true);
		//echo "<pre>";
		//print_r($response['getScanResult']);exit();
		$data['lists'] = $response['getScanResult'];
        $data['jquery'] = 'site/user/js/user-js';
        $data['content'] = 'site/user/pdf-download';
        echo Modules::run('template/customTemplate', $data);
    }

}

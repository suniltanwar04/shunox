<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
include APPPATH . "modules/common/controllers/Common.php";
// require APPPATH.'third_party/facebook_login.php';

// require APPPATH.'third_party/vendor/autoload.php';

/**
 * Created by PhpStorm.
 * User: Amit
 * Date: 22-10-2016
 * Time: PM 08:30
 */
class SiteLogin extends MY_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('SiteLogin_model', 'Common/Common_model'));
    }


    public function Registration()
    {
       sleep(CommonConstants::SLEEP_TIME);

        $fullName = $this->input->post('fullName');
        $email = $this->input->post('emailId');
        $mobile = $this->input->post('mobile');
        $password = $this->input->post('password');

        $userEmail = $this->SiteLogin_model->getUserByEmail($email);
        $userMobile = $this->SiteLogin_model->getUserByMobile($mobile);

        if ($userEmail) {
            echo -1;
        } elseif ($userMobile) {
            echo -2;
        } else {
          $otp = substr(str_shuffle(time()),0,8);
          $otpHash =  md5($otp);
          //$tempUser = $this->SiteLogin_model->registerTempUser($fullName, $email, $password, $mobile, $otp, $otpHash);
          $user = $this->SiteLogin_model->registerUser($_POST);

          if($user){
                $Common = new Common();
                $subject = 'Registration Successfull';
                $message = 'You have successfully registered';
                $send = $Common->sendMailNewsletter($subject, $message, $email);
             
          	if($this->session->userdata("cartvalue")!=''){
          	$this->session->set_userdata('Id',$user);
          		echo 3;
          	}else{
              		$this->session->set_userdata('Id',$user);
            		echo 2;
           	 }
          }else{
            echo 0;
          }
        }
    }


    public function ApiRegistration()
    {	
	
		$data = json_decode(file_get_contents('php://input'),true);
        sleep(CommonConstants::SLEEP_TIME);

        $fullName = $data['name'];
        $email = $data['email'];
        $mobile = $data['mobile'];
        

        $Common = new Common();
        $subject = 'Registration Successfull';
        $message = 'You have successfully registered';
        // echo $fullName."/".$email."/".$mobile;
        // die();
        $send = $Common->sendApiMailNewsletter($fullName, $email, $mobile);
        if($send == 1){
			echo "Success";
		}
		else{
			echo "Failed";
		}
        
    }





    public function loginPage(){

        $data['facebookLoginUrl'] = $this->facebookLoginUrl();
        $data['token'] = '';
        $data['content'] = 'site/test/login/index';

        echo Modules::run('template/siteTemplate', $data);
    }
    
    public function loginsPage($token){
	
        $data['facebookLoginUrl'] = $this->facebookLoginUrl();
        $data['token'] = $token;
        $data['content'] = 'site/test/login/resetpassword';

        echo Modules::run('template/siteTemplate', $data);
    }

    public function createAccount(){
        $data['facebookLoginUrl'] = $this->facebookLoginUrl();

        $data['content'] = 'site/test/login/create';

        echo Modules::run('template/siteTemplate', $data);
    }

    public function login()
    {
        sleep(CommonConstants::SLEEP_TIME);
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $userLogin = $this->SiteLogin_model->authenticateUser($email, $password);

        if ($userLogin) {
        
        	if($this->session->userdata("cartvalue")!=''){
	            if ($userLogin->IsActive == 1) {
	                $session = array(
	                    'Id' => $userLogin->Id,
	                    'Name' => $userLogin->FullName,
	                    'Email' => $userLogin->Email,
	                    'UserRole' => $userLogin->UserRole,
	                    'IsLoggedIn' => $userLogin->Id,
	                    'FailedLogin' => 0
	                );
	                $this->session->set_userdata($session);
	                echo 3;
	            } 
           	 }else if($this->session->userdata("trackOrder")==1){
           	 if ($userLogin->IsActive == 1) {
	                $session = array(
	                    'Id' => $userLogin->Id,
	                    'Name' => $userLogin->FullName,
	                    'Email' => $userLogin->Email,
	                    'UserRole' => $userLogin->UserRole,
	                    'IsLoggedIn' => $userLogin->Id,
	                    'FailedLogin' => 0
	                );
	                $this->session->set_userdata($session);
	                echo 4;
	            } 
            
            	}else{
            		if ($userLogin->IsActive == 1) {
	                $session = array(
	                    'Id' => $userLogin->Id,
	                    'Name' => $userLogin->FullName,
	                    'Email' => $userLogin->Email,
	                    'UserRole' => $userLogin->UserRole,
	                    'IsLoggedIn' => $userLogin->Id,
	                    'FailedLogin' => 0
	                );
	                $this->session->set_userdata($session);
	                echo $userLogin->UserRole;
	            } 
            	}
        } else {
            echo -1;
        }
    }


    public function logOut()
    {
        session_destroy();
        redirect(base_url());

    }

    public function loginCheck()
    {
		
        $loginCheck = $this->Common_model->siteLoginCheck();
        if ($loginCheck) {
            echo 1;
        } else {
            echo -1;
        }
    }



    public function sendResetPassMail()
    {
        $email = $this->input->post('email');

        $userLogin = $this->SiteLogin_model->getUserByEmail($email);

        if ($userLogin) {
		$token = rand(10,100000);
		$update = $this->SiteLogin_model->updateToken($email, $token);
            $subject = 'Forgot Password';
            $message = 'Please <a href="'.base_url().'logins/'.$token.'">click here</a> to reset your password';
            $Common = new Common();
            $Common->sendMailNewsletter($subject, $message,  $email);
            echo 1;

        } else {
            echo -1;
        }


    }
    
    public function resetPassword(){
    	$token = $this->input->post('token');
    	$password = $this->input->post('password');
    	
    	$update = $this->SiteLogin_model->updatePassword($password, $token);

        if ($update ) {
		
            echo 1;

        } else {
            echo -1;
        }

    }
    
    

}

<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
include APPPATH . "modules/common/controllers/Common.php";

/**
 * Created by PhpStorm.
 * User: Amit
 * Date: 22-10-2016
 * Time: PM 08:30
 */
class AdminLogin extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('AdminLogin_model', 'AdminUser_model'));
    }


    public function login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $userLogin = $this->AdminLogin_model->authenticateUser($email, $password);
//print_r($userLogin);
//      die;
        if ($userLogin) {
            if ($userLogin->IsActive == 1) {
                $session = array(
                    'adminId' => $userLogin->Id,
                    'Name' => $userLogin->FullName,
                    'Email' => $userLogin->Email,
                    'UserRole' => $userLogin->UserRole,
                    'IsLogged' => 1,
                    'FailedLogin' => 0
                );
                $this->session->set_userdata($session);
                echo $userLogin->UserRole;
            } else {
                echo -2;
            }
        } else {
            echo -1;
        }
    }


    public function logout()
    {
        $session = array(
            'adminId' => '',
            'Email' => '',
            'Mobile' => '',
            'UserType' => '',
            'IsLogged' => 0,
            'FailedLogin' => 1
        );
        $this->session->unset_userdata($session);
        
        redirect(base_url().'admin');

    }


   

   public function sendResetPassMail()
    {
        $email = $this->input->post('email');

        $userLogin = $this->AdminUser_model->getUserByEmail($email);

        if ($userLogin) {
		$token = rand(10,100000);
		$update = $this->AdminLogin_model->updateToken($email, $token);
            $subject = 'Forgot Password';
            $message = 'Please <a href="'.base_url().'seller/logins/'.$token.'">click here</a> for forgot password';
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
    	
    	$update = $this->AdminLogin_model->updatePassword($password, $token);

        if ($update ) {
		
            echo 1;

        } else {
            echo -1;
        }

    }

}

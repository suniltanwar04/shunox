<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
include APPPATH . "modules/common/controllers/Common.php";


/**
 * Created by PhpStorm.
 * User: Amit
 * Date: 22-10-2016
 * Time: PM 08:30
 */
class Site extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Site_model', 'SiteProduct_model', 'SiteLogin_model'));
    }

    public function shoeMade()
    {
    	
      $data['blogs'] = $this->Site_model->getBlogs();
    	$data['featured'] = $this->Site_model->getFeaturedProduct();
    	//print_r($data['featured']);die;
        $data['jquery'] = 'site/test/listing/js/products-js';
        $data['content'] = 'site/home/index';
        
        echo Modules::run('template/siteTemplate', $data);
    }
    
    public function loggedInUserType(){
        if($this->session->userdata("IsLoggedIn")){
            echo 1;
        }else{
            echo 0;
        }
    }
    
    public function sendContactUsMessage(){
      sleep(2);
	$order_id = $this->input->post("order_id");
      $name = $this->input->post("name");

        if($this->input->post("type")==2){
            $type = 'Payment Related';
            $fromEmail = "support@shunox.in";
        }
        else if($this->input->post("type")==3){
            $type = 'Delivery Related';
            $fromEmail = "support@shunox.in";
        }
        else if($this->input->post("type")==4){
            $type = 'Product Related';
            $fromEmail = "support@shunox.in";
        }
        else if($this->input->post("type")==5){
            $type = 'Suggestion Related';
            $fromEmail = "suggestions@shunox.in";
        }
        else if($this->input->post("type")==6){
          $type = 'Order Cancellation Related';
          $fromEmail = "support@shunox.in";
      }
      else if($this->input->post("type")==7){
        $type = 'Order Refund Related';
        $fromEmail = "support@shunox.in";
    }
        else{
            $type = '';
        }
      $email = $this->input->post("email");
      $phone = $this->input->post("phone");
      $address = $this->input->post("address");
      $comment = $this->input->post("query");
      $post = $this->input->post();
      $save = $this->Site_model->saveContactQuery($post);
      $common = new Common;
      $subject = $name." Contacted you on site ". $type;
      $content = $name." Contacted you on site <br>";
      $content .= "For Related :".$type." <br>";
	  if($this->input->post("type")!=5){
		  $content .= "Order_id :".$order_id. " <br>";
	  }
      $content .= "Email :".$email. " <br>";
      $content .= "Mobile :".$phone. " <br>";
      $content .= "Address :".$address. " <br>";
      $content .= "Message :".$comment. " <br>";
      $content .= "Thanks and Regards  <br>";
      $content .= "Team SHUNOX";

      if($common->sendMail($subject, $content,$fromEmail)){
        echo 1;
      }else{
        echo 0;
      }
    }
    
    public function sendBecomeDealer(){
      sleep(2);
      $name = $this->input->post("name");
      $lname = $this->input->post("lname");
      $email = $this->input->post("email");
      $mobile =  $this->input->post("mobile");
      $company = $this->input->post("company");
      $comment = $this->input->post("comment");
      $gst_no = $this->input->post("gst_no");
      $full_name = $name.' ';$lname;
      $post = $this->input->post();
      $save = $this->Site_model->saveBecomeQuery($post);
      $common = new Common;
      $subject = $full_name." Become dealer";
      $content = "Name :".$full_name." <br>";
      $content .= "Email :".$email. "<br>";
      $content .= "Mobile :".$mobile. "<br>";
      $content .= "Company :".$company. "<br>";
      $content .= "Message :".$comment. "<br>";
      $content .= "Thanks and Regards<br>";
      $content .= "Team SHUNOX";

      if($common->sendMail($subject, $content)){
        echo 1;
      }else{
        echo 0;
      }
    }
    
    public function loginResult(){
      $accessToken = $this->helper->getAccessToken();
      
       if(isset($accessToken)){
         $token = $accessToken->getValue();
         $this->session->set_userdata("facebookToken",$token);
        redirect(base_url().'site/Site/validateFacebookCredentials');
      }
  	}
        
        
        public function validateFacebookCredentials(){
      $facebookToken = $this->session->userdata("facebookToken");
      if(!$facebookToken){ redirect(base_url()); }
      if($this->session->userdata("IsLoggedIn")){ redirect(base_url()); }
      $response = $this->facebook->get('/me?fields=id,name,email,picture',$facebookToken);
         
 $user = $response->getGraphUser()->asArray();
     
      if($user){
        $name = $user['name'];
        $email = $user['email'];
        $picture = $user['picture']['url'];

        //checking wheather user already exists or not
        $exists = $this->SiteLogin_model->getUserByEmail($email);
        if(!$exists){
          //registering the user if not exists with  this email;
          $userId = $this->SiteLogin_model->registerFacebookUser($name,$email,$picture);
          if($userId){
            $session = array(
                'Id' => $userId,
                'Name' => $name,
                'Email' => $email,
                'IsLoggedIn' => $userId,
                'FailedLogin' => 0
            );
            $this->session->set_userdata($session);
          }
        }else{
          $session = array(
              'Id' => $exists->Id,
              'Name' => $name,
              'Email' => $email,
              'IsLoggedIn' => $exists->Id,
              'FailedLogin' => 0
          );
          $this->session->set_userdata($session);
        }
        redirect(base_url());
      }
    }
    
    public function newsLetter(){
    	 $email = $this->input->post("email");
    	 
    	 $checkEmail = $this->Site_model->checknewsLetter($email);
    	 
    	 if($checkEmail > 0){
    	 	echo 2;
    	 }else{
    	 	 $news = $this->Site_model->newsLetter($email);
    	 	 if( $news){
    	 	 echo 1;
    	 	 }
    	 }
    }
	
    public function emailSend(){
		$to = 'amitg1370@gmail.com';
		$subject = 'Test';
		$message = 'Test';
    	$headers = "From: amitg1375@gmail.com" . "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    	$send =  mail($to,$subject,$message,$headers);
    	echo $send.'AMIT';
	}


}

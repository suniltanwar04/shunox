<?php

/**
 * Created by PhpStorm.
 * User: Amit
 * Date: 22-10-2016
 * Time: PM 08:30
 */
class Common extends My_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Common_model'));
    }

    public function sendMail($subject, $content, $attachment = NULL,$fromEmail='support@shunox.in')
    {
    $to = $this->Common_model->adminMail();
    
        $this->load->library(array('email', 'parser'));
        $this->load->library('email', array('mailtype' => 'html'));
        $data = array(
            'title' => $subject,
            'content' => $content
        );
        $message = $this->parser->parse('common/mail-template/common-mail-template', $data, TRUE);
		//echo $message;exit;
        /*$config = array(
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'priority' => '1'
        );*/
		$config = Array(
			'protocol' => 'smtp',
			'smtp_host' => 'smtp.sendgrid.net',
			'smtp_port' => 465,
			'smtp_user' => 'apikey',
			'smtp_pass' => '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',
			'mailtype'  => 'html',
			'charset'   => 'utf-8',
			'priority' => '1',
			'smtp_crypto' => 'ssl',
		);
        $this->email->initialize($config);
        $this->email->clear(TRUE);
        $this->email->from($fromEmail, "TEAM SHUNOX");
        //$this->email->from('helpglobusnexgen@gmail.com', "TEAM GLOBUSNEXGEN");

      	$this->email->to($to->to_email);
        //$this->email->to('amitg1370@gmail.com');
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->attach($attachment);
        if ($this->email->send()) {
            return true;
        } else {
            return false;
        }
    }
    
    public function findState(){
      $country = $this->input->post("country");
      $states = $this->Common_model->getState($country);
      //print_r($state);
      if($states){
      echo '<option value="">Select State</option>';
      foreach($states as $state){
        echo '<option value='.$state->id.'>'.$state->name.'</option>';
       }
         
      }else{
        echo '<option value="">Select State</option>';
      }

    }
    
    public function findCity(){
      $state = $this->input->post("state");
      $cities = $this->Common_model->getCity($state);
      //print_r($cities);
      if($cities){
      echo '<option value="">Select City</option>';
      foreach($cities as $city){
      
        echo '<option value='.$city->id.'>'.$city->name.'</option>';
       }
         
      }else{
        echo '<option value="">Select City</option>';
      }

    }

    public function sendMailNewsletter($subject, $content, $to,$attachment = NULL)
    {
    
        $this->load->library(array('email', 'parser'));
        $this->load->library('email', array('mailtype' => 'html'));
        $data = array(
            'title' => $subject,
            'content' => $content
        );
        $message = $this->parser->parse('common/mail-template/common-mail-template', $data, TRUE);
        $config = Array(
			'protocol' => 'smtp',
			'smtp_host' => 'smtp.sendgrid.net',
			'smtp_port' => 465,
			'smtp_user' => 'apikey',
			'smtp_pass' => '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',
			'mailtype'  => 'html',
			'charset'   => 'utf-8',
			'priority' => '1',
			'smtp_crypto' => 'ssl',
		);
        $this->email->initialize($config);
        $this->email->clear(TRUE);
        //$this->email->from(CommonConstants::ADMIN_EMAIL, "TEAM GLOBUSNEXGEN");
		// $this->email->from('helpglobusnexgen@gmail.com', "TEAM SHUNOX");
		$this->email->from('customercare@shunox.in', "TEAM SHUNOX");
        //$this->email->to('krishnakantyadav511@gmail.com');
		$this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->attach($attachment);
		//echo $this->email->send();exit;
        if ($this->email->send()) {
            return true;
        } else {
            return false;
        }
    }

    public function sendApiMailNewsletter($fullName, $email, $mobile,$attachment = NULL)
    {
    
        $this->load->library(array('email', 'parser'));
        $this->load->library('email', array('mailtype' => 'html'));
        $data = array(
            'title' => 'Registration Successfull',
            'fullName' => $fullName,
            'email' => $email,
            'mobile' => $mobile
        );
        $message = $this->parser->parse('common/mail-template/api-common-mail-template', $data, TRUE);
        $config = Array(
			'protocol' => 'smtp',
			'smtp_host' => 'smtp.sendgrid.net',
			'smtp_port' => 465,
			'smtp_user' => 'apikey',
			'smtp_pass' => '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',
			'mailtype'  => 'html',
			'charset'   => 'utf-8',
			'priority' => '1',
			'smtp_crypto' => 'ssl',
		);
        $this->email->initialize($config);
        $this->email->clear(TRUE);
        $this->email->from(CommonConstants::ADMIN_EMAIL, "TEAM Shunox");
        $this->email->to($email);
        $this->email->subject('Registration Successfull');
        $this->email->message($message);
        $this->email->attach($attachment);
        if ($this->email->send()) {
            return true;
        } else {
            return false;
        }
    }



}

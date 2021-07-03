<?php
include APPPATH."third_party/fbLogin/vendor/autoload.php";
/**
 * Created by PhpStorm.
 * User: amit
 * Date: 1/2/16
 * Time: 11:52 PM
 */
class MY_Controller extends MX_Controller
{

  public $facebook, $helper;
  public function __construct(){
    parent::__construct();
    $this->facebook = new \Facebook\Facebook([
      'app_id' => '178646629313998',
      'app_secret' => 'e0e3399e9e5de17eca8ee3a0cb270678',
      'default_graph_version' => 'v2.8'
      ]);

      $this->helper = $this->facebook->getRedirectLoginHelper();
  }

  public function facebookLoginUrl(){
		return $this->helper->getLoginUrl(base_url()."/site/SiteLogin/loginResult");
	}

  public function facebookHelper(){
    return $this->helper;
  }

}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminDashboard extends MY_Controller {
	
	function __construct(){
        parent::__construct();
		$this->load->model('AdminDashboard_model'); 
    }	

	public function index(){
                $this->Common_model->loginCheck();
		 $data['users'] = $this->AdminDashboard_model->countUsers();
		 
	     $data['orders'] = $this->AdminDashboard_model->countOrders();
	     
	     $data['products'] = $this->AdminDashboard_model->countProducts();
		 $data['banners'] = $this->AdminDashboard_model->countBanners();
		
		//$data['jquery'] = 'admin/dashboard/js/social-js';
                $data['content'] = 'admin/dashboard/index';

                echo Modules::run('template/adminTemplate', $data);
	}
	

	
	
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
 * Created by PhpStorm.
 * User: Amit
 * Date: 22-10-2016
 * Time: PM 08:30
 */
class Template extends My_Controller
{
    public $fb;

    public function __construct()
    {
        parent::__construct();
        $this->pdo = $this->load->database('pdo', true);
        $this->pdoConn = $this->pdo->conn_id;
        $this->load->model(array('Template_model'));
    }


    public function index()
    {
        echo 'Template Module';
    }

    public function adminTemplate($data)
    {
        $this->load->view('admin/index', $data);
    }

    public function siteTemplate($data)
    {	
		 $data['facebookLoginUrl'] = $this->facebookLoginUrl();
         $data['allbanners'] = $this->Template_model->getBanner();
       
        $data['socials'] = $this->Template_model->getSocial();
        
       $data['categories'] = $this->Template_model->getAllCategory();
       
        $this->load->view('site/index', $data);
    }
	public function customTemplate($data)
    {
        $this->load->view('custom/index', $data);
    }
}

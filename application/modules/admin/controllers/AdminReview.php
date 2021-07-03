<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');
include APPPATH . "modules/common/controllers/Common.php";

/**
 * Created by PhpStorm.
 * User: Amit
 * Date: 22-10-2016
 * Time: PM 08:30
 */

class AdminReview extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('AdminReview_model', 'AdminAttribute_model', 'AdminAttributeMapping_Model'));
		
    }


	
    public function review()
    {
        $this->Common_model->loginCheck();
        $data['reviews'] = $this->AdminReview_model->getReview();
        //echo "<pre>";print_r($data['reviews']);die;
        $data['jquery'] = 'admin/review/js/review-js';
        $data['content'] = 'admin/review/index';
        echo Modules::run('template/adminTemplate', $data);
    }
    


    public function enableDisableReview()
    {
        $this->Common_model->loginCheck();
        $recordId = $this->input->post('recordId');
        $isActive = $this->input->post('isActive');
        $activate = $this->AdminReview_model->enableDisableReview($recordId, $isActive);
        if ($activate) {
            $data['reviews'] = $this->AdminReview_model->getReview();
            $this->load->view('admin/review/services/review-list', $data);
        } else {
            echo -1;
        }
    }




    public function deleteReview(){
        $recordId = $this->input->post('recordId');
        $deleteproduct = $this->AdminReview_model->deleteReview($recordId);
        $data['reviews'] = $this->AdminReview_model->getReview();
        $this->load->view('admin/review/services/review-list', $data);


    }

}

?>
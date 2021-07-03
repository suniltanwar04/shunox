<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');
include APPPATH . "modules/common/controllers/Common.php";

/**
 * Created by PhpStorm.
 * User: Amit
 * Date: 22-10-2016
 * Time: PM 08:30
 */

class AdminBanner extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('AdminBanner_model'));
    }

    public function index(){
        $this->Common_model->loginCheck();
        $data['allbanner'] = $this->AdminBanner_model->getBanner();
       
        $data['jquery'] = 'admin/banner/js/banner-js';
        $data['content'] = 'admin/banner/index';
        echo Modules::run('template/adminTemplate', $data);
    }
    
    public function saveBanner(){
        $this->Common_model->loginCheck();
        if ($_FILES['addImage']['name'] != "") {
            $target = "uploads/banner/";
             $types = array('image/jpeg', 'image/gif', 'image/png');
            $arg['addimage'] = rand().$_FILES['addImage']['name'];
            $image1 = $arg['addimage'];

            if (in_array($_FILES['addImage']['type'], $types)) {
                 if($_FILES['addImage']['size'] <= 1000000) {
                    if (move_uploaded_file($_FILES['addImage']['tmp_name'], $target.$image1)) {

                    }
                }else{
                    echo "Your Image Should be less than 1 Mb";
                }

            }
        }
         
         $banner = $this->AdminBanner_model->addBanner($_POST, $image1);  
    }
    
    public function enableDisableBanner()
    {
       
        $this->Common_model->loginCheck();
        $recordId = $this->input->post('recordId');
        $isActive = $this->input->post('isActive');
        $activate = $this->AdminBanner_model->enableDisableBanner($recordId, $isActive);
        
        if ($activate) {
           $data['allbanner'] = $this->AdminBanner_model->getBanner();
            $this->load->view('admin/banner/services/banner-list', $data);
        } else {
            echo -1;
        }
        
    }
    
     public function deleteBanner(){
        $recordId = $this->input->post('recordId');
        $deleteBanner = $this->AdminBanner_model->deleteBanner($recordId);
        $data['allbanner'] = $this->AdminBanner_model->getBanner();
         $this->load->view('admin/banner/services/banner-list', $data);
    }
    
    public function editBanner($bannersId){
        $this->Common_model->loginCheck();
       
        $data['jquery'] = 'admin/banner/js/banner-js';
        $banner = $this->AdminBanner_model->getBannerById($bannersId);
        $data['banner'] = json_decode(json_encode($banner),true);
        $data['content'] = 'admin/banner/edit-banner';
        echo Modules::run('template/adminTemplate', $data);
    }
    public function updateBanner($bannersId){
       if(isset($_FILES['userfile']['name']) && !empty( $_FILES['userfile']['name']  ))
        {
                $image_banner = $this->AdminBanner_model->do_upload();	
                $image =  $image_banner['file_name'];

                @unlink("./uploads/banner/".$this->input->post('old_userfile'));
        }	
        else{
                $image = $this->input->post('old_userfile');				
        }
        
        $title = $this->input->post('title');
        
        $result = $this->AdminBanner_model->updateBanner($title,$image,$bannersId);
        redirect('admin/edit-banner/'.$bannersId.'');
    }
}

?>

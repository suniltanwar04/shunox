<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminSocial extends MY_Controller {
	
	function __construct(){
        parent::__construct();
		$this->load->model('AdminSocial_model'); 
    }	

	public function index(){
                $this->Common_model->sellerLoginCheck();
		
		$data['allsocial'] =  $this->AdminSocial_model->getSocial();
              
               
		$data['jquery'] = 'seller/social/js/social-js';
                $data['content'] = 'seller/social/index';

                echo Modules::run('template/adminTemplate', $data);
	}
	

//create function for add new social media -------	
	public function saveSocial(){
               $this->Common_model->sellerLoginCheck();
                if ($_FILES['addImage']['name'] != "") {
                    $target = "uploads/social/";
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

               $banner = $this->AdminSocial_model->addSocial($_POST, $image1);  
	}
	
	
public function enableDisableSocial()
    {
       
        $this->Common_model->sellerLoginCheck();
        $recordId = $this->input->post('recordId');
        $isActive = $this->input->post('isActive');
        $activate = $this->AdminSocial_model->enableDisableSocial($recordId, $isActive);
        
        if ($activate) {
           $data['allsocial'] = $this->AdminSocial_model->getSocial();
            $this->load->view('seller/social/services/social-list', $data);
        } else {
            echo -1;
        }
        
    }
    
    public function deleteSocial(){
        $recordId = $this->input->post('recordId');
        $deleteBanner = $this->AdminSocial_model->deleteSocial($recordId);
        $data['allsocial'] = $this->AdminSocial_model->getSocial();
         $this->load->view('seller/social/services/social-list', $data);
    }
    
    public function editSocial($socialId){
        $this->Common_model->sellerLoginCheck();
       
        $data['jquery'] = 'seller/social/js/social-js';
        $social = $this->AdminSocial_model->getSocialById($socialId);
        $data['social'] = json_decode(json_encode($social),true);
        $data['content'] = 'seller/social/edit-social';
        echo Modules::run('template/adminTemplate', $data);
    }
    public function updateSocial($socialId){
       if(isset($_FILES['userfile']['name']) && !empty( $_FILES['userfile']['name']  ))
        {
                $image_banner = $this->AdminSocial_model->do_upload();	
                $image =  $image_banner['file_name'];

                @unlink("./uploads/social/".$this->input->post('old_userfile'));
        }	
        else{
                $image = $this->input->post('old_userfile');				
        }
        
        $result = $this->AdminSocial_model->updateSocial($_POST,$image,$socialId);
        redirect('seller/edit-social/'.$socialId.'');
    }
	
	
	
}

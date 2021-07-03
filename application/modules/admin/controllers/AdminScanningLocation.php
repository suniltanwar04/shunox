<?php

/**
 * Created by PhpStorm.
 * User: Amit
 * Date: 22-10-2016
 * Time: PM 08:30
 */
class AdminScanningLocation extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('AdminScanningLocation_model', 'Common_model'));
    }

    public function index()
    {
        $this->Common_model->loginCheck();
        $data['alllocations'] = $this->AdminScanningLocation_model->getValue();
        $data['countries'] = $this->Common_model->getCountries();

        $data['jquery'] = 'admin/scanning/js/scanning-js';
        $data['content'] = 'admin/scanning/index';

        echo Modules::run('template/adminTemplate', $data);
    }


    public function saveLocation(){
        $post = $this->input->post();
        $save = $this->AdminScanningLocation_model->saveLocation($post);
        if($save){
            echo 1;
        }else{
            echo 2;
        }
    }

    public function enableDisableLocation()
    {

        $this->Common_model->loginCheck();
        $recordId = $this->input->post('recordId');
        $isActive = $this->input->post('isActive');
        $activate = $this->AdminScanningLocation_model->enableDisableLocation($recordId, $isActive);

        if ($activate) {
            $data['alllocations'] = $this->AdminScanningLocation_model->getValue();
            $this->load->view('admin/scanning/services/scanning-list', $data);
        } else {
            echo -1;
        }

    }

    public function deleteLocation(){
        $recordId = $this->input->post('recordId');
        $deleteLoc = $this->AdminScanningLocation_model->deleteLocation($recordId);
        $data['alllocations'] = $this->AdminScanningLocation_model->getValue();
        $this->load->view('admin/scanning/services/scanning-list', $data);
    }
    
    public function editLocationData($id){
		$data['countries'] = $this->Common_model->getCountries();
		$data['location'] = $this->AdminScanningLocation_model->getLocationById($id);
		$data['states'] = $this->Common_model->getState($data['location']->country);
       
                $data['cities'] = $this->Common_model->getCity($data['location']->state);
		$data['jquery'] = 'admin/scanning/js/scanning-js';
		$data['content'] = 'admin/scanning/edit';
        echo Modules::run('template/adminTemplate', $data);
		
     
		
		
	}
	
	public function updateLocationData($id){
		$post = $this->input->post();
               $location = $this->AdminScanningLocation_model->updateLocationData($post, $id); 
               if($location ){
			redirect('admin/location');
		}else{
			
			
		}
     
		
		
	}




}

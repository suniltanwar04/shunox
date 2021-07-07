<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH . "modules/common/controllers/Common.php";
class AdminPage extends MY_Controller {
	
	function __construct(){
        parent::__construct();
		$this->load->model('AdminPage_model'); 
    }	

	public function index(){
		$this->Common_model->sellerLoginCheck();
        $data['allpage'] = $this->AdminPage_model->getPage();
       
        $data['content'] = 'seller/page/index';
        echo Modules::run('template/adminTemplate', $data);
		
	}
	

//create function for add new page -------	
	public function addPage(){
		$data['jquery'] = 'seller/page/js/page-js';
		$data['content'] = 'seller/page/add';
        echo Modules::run('template/adminTemplate', $data);
	}
	
	public function savePageData(){
		
		$this->Common_model->sellerLoginCheck();
		$image = '';
               if ($_FILES['addImage']['name'] != "") {
					$target = "uploads/page/";
		//                $target = $target . basename($_FILES['addimage']['name'][$i]);
					$types = array('image/jpeg', 'image/gif', 'image/png');
					$image = rand().$_FILES['addImage']['name'];
					if (in_array($_FILES['addImage']['type'], $types)) {

						if (move_uploaded_file($_FILES['addImage']['tmp_name'], $target.$image)) {
		//                        echo "The file " . basename($_FILES['addimage']['name'][$i]) . " has been uploaded";
						}

					} else {
						echo "Your Image is not uploaded";
					}
				}
				$post = $this->input->post();
               $page = $this->AdminPage_model->addPageData($post, $image); 
               if($page){
					redirect('seller/pagelist');
				}else{
					
					
				}
	}
	

//create function for edit page --------	
	public function editPageData($id){
		
		$data['page'] = $this->AdminPage_model->getPageById($id);
		$data['jquery'] = 'seller/page/js/page-js';
		$data['content'] = 'seller/page/edit';
        echo Modules::run('template/adminTemplate', $data);
		
     
		
		
	}
	
	public function updatePageData($id){
	
		$this->Common_model->sellerLoginCheck();
		$image = '';
               if ($_FILES['addImage']['name'] != "") {
					$target = "uploads/page/";
		//                $target = $target . basename($_FILES['addimage']['name'][$i]);
					$types = array('image/jpeg', 'image/gif', 'image/png');
					$image = rand().$_FILES['addImage']['name'];
					if (in_array($_FILES['addImage']['type'], $types)) {

						if (move_uploaded_file($_FILES['addImage']['tmp_name'], $target.$image)) {
		//                        echo "The file " . basename($_FILES['addimage']['name'][$i]) . " has been uploaded";
						}

					} else {
						echo "Your Image is not uploaded";
					}
				}
				$post = $this->input->post();
               $page = $this->AdminPage_model->updatePageData($post, $image, $id); 
               if($page){
					redirect('seller/pagelist');
				}else{
					
					
				}
	}
	
	
//create function for delete page -----
	public function delete($id){
		$result = $this->Page_model->delete($id);
		
		if($result){
			$msg = "Deleted Successfully!!!";
			$this->session->set_flashdata('message',alert('success',$msg));
			redirect('page');
		}else{
			$msg = "Error in Deletion!!!";
			$this->session->set_flashdata('message',alert('danger',$msg));
			redirect('page');		
		}
	}	
	
	
	
	
}

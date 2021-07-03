<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminBlog extends MY_Controller {
	
	function __construct(){
        parent::__construct();
		$this->load->model('AdminBlog_model'); 
    }	
	
	public function index(){
		$data['Title'] = 'Blogs';
		$data['allblog'] = $this->AdminBlog_model->getBlog();
		//$data['jquery'] = 'admin/product-attribute/js/product-attribute-js';
        $data['content'] = 'admin/blogs/index';
        echo Modules::run('template/adminTemplate', $data);
	}
	
	
//create function for add new blog -----
	public function addBlogForm(){

        $data['content'] = 'admin/blogs/add';
        echo Modules::run('template/adminTemplate', $data);
	}

    public function addBlog(){

        $image ='';
        if ($_FILES['userfile']['name'] != "") {
            $target = "uploads/blog/";
            $types = array('image/jpeg', 'image/gif', 'image/png');
            $image  = rand().$_FILES['userfile']['name'];

            if (in_array($_FILES['userfile']['type'], $types)) {
                if($_FILES['userfile']['size'] <= 1000000) {
                    if (move_uploaded_file($_FILES['userfile']['tmp_name'], $target.$image)) {

                    }
                }else{
                    echo "Your Image Should be less than 1 Mb";
                }

            }
        }

        $blog = $this->AdminBlog_model->addBlog($_POST, $image);
        if($blog){
            redirect('admin/blogs');
        }
    }


//create function for edit blog -----
	public function editForm($id){
		$data['blog'] = $this->AdminBlog_model->getBlogById($id);


        $data['content'] = 'admin/blogs/edit';
        echo Modules::run('template/adminTemplate', $data);
	}


    public function updateBlog($id){
        if ($_FILES['userfile']['name'] != "") {
            $target = "uploads/blog/";
            $types = array('image/jpeg', 'image/gif', 'image/png');
            $image  = rand().$_FILES['userfile']['name'];

            if (in_array($_FILES['userfile']['type'], $types)) {
                if($_FILES['userfile']['size'] <= 1000000) {
                    if (move_uploaded_file($_FILES['userfile']['tmp_name'], $target.$image)) {
                        @unlink("./uploads/blog/".$this->input->post('old_userfile'));
                    }
                }else{
                    echo "Your Image Should be less than 1 Mb";
                }

            }
        }

        $blog = $this->AdminBlog_model->updateBlog($_POST, $image, $id);
        if($blog){
            redirect('admin/blogs');
        }
    }
//create function for delete page -----
	public function delete($id){
		$result = $this->AdminBlog_model->delete($id);
		
		if($result){

			redirect('admin/blogs');
		}else{

			redirect('admin/blogs');
		}
	}		
	
	
}

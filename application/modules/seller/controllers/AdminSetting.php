<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
include APPPATH . "modules/common/controllers/Common.php";

/**
 * Created by PhpStorm.
 * User: Amit
 * Date: 22-10-2016
 * Time: PM 08:30
 */
class AdminSetting extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('AdminSetting_model'));
        
    }

    /*---------------Attribute Starts ---------------*/

    public function index()
    {

        $this->Common_model->sellerLoginCheck();
        $datasetting= $this->AdminSetting_model->getValue();
      
        $data['setting']  = json_decode(json_encode($datasetting), True);

        $data['jquery'] = 'seller/settings/attribute/js/attribute-js';
        $data['content'] = 'seller/settings/setting/index';
        
        echo Modules::run('template/adminTemplate', $data);
    }
    
    public function saveSetting(){
       $RequestMethod = $this->input->server('REQUEST_METHOD');
       
        if($RequestMethod == "POST"){


                if(isset($_FILES['SITE_LOGO']['name']) && $_FILES['SITE_LOGO']['name']!='')
                {
                        $image_banner = $this->AdminSetting_model->uploadfile( 'SITE_LOGO'  );
                        $image = $image_banner['file_name'];

                        @unlink("./uploads/setting/".$this->input->post('OLD_LOGO'));

                        $this->AdminSetting_model->update($image,"SITE_LOGO");
                }
                else
                {
                        $this->AdminSetting_model->update($this->input->post('OLD_LOGO'),"SITE_LOGO");
                }		

                        $this->AdminSetting_model->update($this->input->post('SITE_TITLE'),"SITE_TITLE"); 
                        $this->AdminSetting_model->update($this->input->post('SITE_ADDRESS'),"SITE_ADDRESS");
                        $this->AdminSetting_model->update($this->input->post('SITE_MOBILE'),"SITE_MOBILE");
                        $this->AdminSetting_model->update($this->input->post('SITE_MOBILE1'),"SITE_MOBILE1");
                        $this->AdminSetting_model->update($this->input->post('SITE_MOBILE2'),"SITE_MOBILE2");
                        $this->AdminSetting_model->update($this->input->post('SITE_MOBILE3'),"SITE_MOBILE3");
                        $this->AdminSetting_model->update($this->input->post('SITE_EMAIL'),"SITE_EMAIL");
                        $this->AdminSetting_model->update($this->input->post('SUPPORT_EMAIL'),"SUPPORT_EMAIL");			
                        $this->AdminSetting_model->update($this->input->post('Currency'),"Currency");
                        $this->AdminSetting_model->update($this->input->post('Currency_Symbol'),"Currency_Symbol");
                        $this->AdminSetting_model->update($this->input->post('COPYRIGHT'),"COPYRIGHT");	
                         $this->AdminSetting_model->update($this->input->post('SITE_COMPANY'),"SITE_COMPANY");	


               redirect('seller/settings');
        }
    }

    

}

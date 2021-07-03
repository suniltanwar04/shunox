<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
include APPPATH . "modules/common/controllers/Common.php";


/**
 * Created by PhpStorm.
 * User: Amit
 * Date: 22-10-2016
 * Time: PM 08:30
 */
class SitePage extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Site_model', 'SiteProduct_model', 'SitePage_model','Common_model'));
    }

    public function footHealth()
    {
    	
      
    	$data['pagesdetails'] = $this->SitePage_model->getPageDetails('foot-health');
        $data['jquery'] = 'site/test/listing/js/products-js';
        $data['content'] = 'site/test/page/index';
        
        echo Modules::run('template/siteTemplate', $data);
    }
    
    public function shoeEssential()
    {
    	
      
    	$data['pagesdetails'] = $this->SitePage_model->getPageDetails('shoe-essentials');
        $data['jquery'] = 'site/test/listing/js/products-js';
        $data['content'] = 'site/test/page/index';
        
        echo Modules::run('template/siteTemplate', $data);
    }
    
    public function antiBacterialSocks()
    {
    	
      
    	$data['pagesdetails'] = $this->SitePage_model->getPageDetails('anti-bacterial-socks');
        $data['jquery'] = 'site/test/page/js/page-js';
        $data['content'] = 'site/test/page/index';
        
        echo Modules::run('template/siteTemplate', $data);
    }
    
    public function footSizeGuide()
    {
    	
      
    	$data['pagesdetails'] = $this->SitePage_model->getPageDetails('foot-size-guide');
        $data['jquery'] = 'site/test/listing/js/products-js';
        $data['content'] = 'site/test/page/index';
        
        echo Modules::run('template/siteTemplate', $data);
    }
    
     public function scanningLocator()
    {
    	
      
    	$data['pagesdetails'] = $this->SitePage_model->getScanningLocator();
        $data['countries'] = $this->Common_model->getCountries();
        $data['jquery'] = 'site/test/page/js/page-js';
        $data['content'] = 'site/test/page/scanning_location';
        
        echo Modules::run('template/siteTemplate', $data);
    }
	
	public function ourDoctors()
    {
    	
		
        $data['city'] = $this->Common_model->getCity1();
		
        $data['content'] = 'site/test/page/our_doctors';
        
        echo Modules::run('template/siteTemplate', $data);
    }
	
	public function searchOurDoctors()
    {
		 $pincode = $this->input->post('pincode');
	
         $city = $this->input->post('city');
		if(!empty($pincode)){
    	$url = "http://webservice.shunox.in/Service1.svc/getDoctorListByPin/".$pincode."";
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
		curl_close($ch);
		$response1 = json_encode($response);
	    
			
	    echo $response1;
		}
		else if(!empty($city)){
			
		$url = "http://webservice.shunox.in/Service1.svc/getDoctorListBycity/".$city."";
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
		curl_close($ch);
		$response1 = json_encode($response);
	    
		echo $response1;	
		}
		
	}

    public function getLocationsById()
    {
        $city_id = $this->input->post('city_id');

        $data['pagesdetails'] = $this->SitePage_model->getScanningLocatorById($city_id);
       
        $this->load->view('site/test/page/scanning_location_list', $data);
    }

     public function scannerTechnology()
    {
    	
      
    	$data['pagesdetails'] = $this->SitePage_model->getPageDetails('scanner-technology');
        $data['jquery'] = 'site/test/listing/js/products-js';
        $data['content'] = 'site/test/page/index';
        
        echo Modules::run('template/siteTemplate', $data);
    }
    
     public function howToPurchase()
    {
    	
      
    	$data['pagesdetails'] = $this->SitePage_model->getPageDetails('how-to-purchase');
        $data['jquery'] = 'site/test/listing/js/products-js';
        $data['content'] = 'site/test/page/index';
        
        echo Modules::run('template/siteTemplate', $data);
    }
     public function trackYourOrder()
    {
    	
       
    	$data['pagesdetails'] = $this->SitePage_model->getPageDetails('track-your-order');
    	
        $data['jquery'] = 'site/test/listing/js/products-js';
        $data['content'] = 'site/test/page/index';
        
        echo Modules::run('template/siteTemplate', $data);
    }
     public function warranty()
    {
    	
      
    	$data['pagesdetails'] = $this->SitePage_model->getPageDetails('warranty');
        $data['jquery'] = 'site/test/listing/js/products-js';
        $data['content'] = 'site/test/page/index';
        
        echo Modules::run('template/siteTemplate', $data);
    }
     public function privacyPolicy()
    {
    	
      
    	$data['pagesdetails'] = $this->SitePage_model->getPageDetails('privacy-policy');
        $data['jquery'] = 'site/test/listing/js/products-js';
        $data['content'] = 'site/test/page/index';
        
        echo Modules::run('template/siteTemplate', $data);
    }

    public function downloadSoftware()
    {


        $data['pagesdetails'] = $this->SitePage_model->getPageDetails('download-software');
        $data['jquery'] = 'site/test/listing/js/products-js';
        $data['content'] = 'site/test/page/index';

        echo Modules::run('template/siteTemplate', $data);
    }

    public function installationSupport()
    {


        $data['pagesdetails'] = $this->SitePage_model->getPageDetails('installation-support');
        $data['jquery'] = 'site/test/listing/js/products-js';
        $data['content'] = 'site/test/page/index';

        echo Modules::run('template/siteTemplate', $data);
    }

    public function operateScanner()
    {


        //$data['pagesdetails'] = $this->SitePage_model->getPageDetails('installation-support');
        $data['jquery'] = 'site/test/listing/js/products-js';
        $data['content'] = 'site/test/page/operate-scanner.php';

        echo Modules::run('template/siteTemplate', $data);
    }

    public function faq()
    {


        $data['pagesdetails'] = $this->SitePage_model->getPageDetails('faq');
        $data['jquery'] = 'site/test/listing/js/products-js';
        $data['content'] = 'site/test/page/index';

        echo Modules::run('template/siteTemplate', $data);
    }
    
    public function technicalFaq()
    {


        $data['pagesdetails'] = $this->SitePage_model->getPageDetails('technical-faq');
        $data['jquery'] = 'site/test/listing/js/products-js';
        $data['content'] = 'site/test/page/index';

        echo Modules::run('template/siteTemplate', $data);
    }
    public function videos()
    {


        $data['pagesdetails'] = $this->SitePage_model->getPageDetails('video');
        $data['jquery'] = 'site/test/listing/js/products-js';
        $data['content'] = 'site/test/page/index';

        echo Modules::run('template/siteTemplate', $data);
    }
    
    public function catalogue()
    {


        $data['pagesdetails'] = $this->SitePage_model->getPageDetails('catalogue');
        $data['jquery'] = 'site/test/listing/js/products-js';
        $data['content'] = 'site/test/page/index';

        echo Modules::run('template/siteTemplate', $data);
    }
    
    public function pressRoom()
    {


        $data['pagesdetails'] = $this->SitePage_model->getPageDetails('press-room');
        $data['jquery'] = 'site/test/listing/js/products-js';
        $data['content'] = 'site/test/page/index';

        echo Modules::run('template/siteTemplate', $data);
    }
    
    public function blogDetail($id)
    {


        $data['blogs'] = $this->SitePage_model->getblogDetail($id);
        $data['jquery'] = 'site/test/listing/js/products-js';
        $data['content'] = 'site/test/page/blogs';

        echo Modules::run('template/siteTemplate', $data);
    }
    
    public function setTrackOrder()
    {
    
    	$settrack = $this->session->set_userdata('trackOrder', 1);
    	
    	echo 1;
    	
    }
    
   

}

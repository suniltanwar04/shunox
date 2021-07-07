<?php
include APPPATH . "modules/common/controllers/Common.php";

/**
 * Created by PhpStorm.
 * User: Amit
 * Date: 22-10-2016
 * Time: PM 08:30
 */
class Seller extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Admin_model', 'common_model'));
    }

    public function index()
    {
        $this->load->view('login/index');
    }
    
    public function login($token)
    {
    $data['token'] = $token;
        $this->load->view('login/reset-pass', $data);
       
    }

    public function dashboard()
    {
        $this->Common_model->sellerLoginCheck();
        $data['jquery'] = 'seller/dashboard/admin/js/dashboard-js';
        $data['content'] = 'seller/dashboard/admin/index';
        echo Modules::run('template/adminTemplate', $data);
    }

    public function newsLetter()
    {
        $this->Common_model->sellerLoginCheck();
        $data['jquery'] = 'seller/newsletter/js/newsletter-js';
        $data['newletters'] = $this->Admin_model->getNewsLetter();
        $data['content'] = 'seller/newsletter/index';
        echo Modules::run('template/adminTemplate', $data);
    }

    public function becomeDealer()
    {
        $this->Common_model->sellerLoginCheck();
        $data['becomedealers'] = $this->Admin_model->getbecomeDealer();
        $data['content'] = 'seller/become-dealer/index';
        echo Modules::run('template/adminTemplate', $data);
    }

    public function becomeDetails($id)
    {
        $this->Common_model->sellerLoginCheck();
        $data['becomedealers'] = $this->Admin_model->getbecomeDealerDetailById($id);
        $data['content'] = 'seller/become-dealer/view-detail';
        echo Modules::run('template/adminTemplate', $data);
    }

    public function sendNewsletter()
    {
        $this->Common_model->sellerLoginCheck();
        $email_ids = explode(',', $_POST['email_ids']);
        $subject = addslashes($_POST['subject']);
        $message = addslashes($_POST['message']);
        $common = new Common;
        foreach($email_ids as $email_id){
            $to = $email_id;
            $send = $common->sendMailNewsletter($subject, $message, $to);
        }
        if($send){
            echo 1;
        }else{
            echo 2;
        }
    }
    public function saveEmailAddress()
    {
        $this->Common_model->sellerLoginCheck();
        $adminemail_ids =  $_POST['adminemail'];
        $toemail = $_POST['toemail'];
        $pass = $_POST['pass'];

            $send = $this->Admin_model->saveEmailAddress($adminemail_ids, $toemail, $pass);

        if($send){
            echo 1;
        }else{
            echo 2;
        }
    }
    
     public function deleteDealer(){
        $recordId = $this->input->post('recordId');
        $deletedealer = $this->Admin_model->deleteDealer($recordId);
        if($deletedealer){
         echo 1;
        }else{
         echo -1;
        }
    }

    public function editDealer()
    {

        $this->Common_model->sellerLoginCheck();
        $recordId = $this->input->post('recordId');
        $data['becomedealers'] = $this->Admin_model->getbecomeDealerDetailById($recordId);

        $this->load->view('seller/become-dealer/edit-dealer-model', $data);

    }

    public function updateDealer()
    {
        $this->Common_model->sellerLoginCheck();
        $dealer_id = $this->input->post('dealer_id');
        $recordId = $this->input->post('recordId');

        $checkId = $this->Admin_model->checkId($dealer_id);

        if ($checkId) {
            echo -1;
        } else {
            $updated = $this->Admin_model->updateDealerId($dealer_id, $recordId);

            if ($updated) {
               echo 1;
            }
        }

    }
    
    public function becomeWithDealerId()
    {
        $this->Common_model->sellerLoginCheck();
        $data['becomedealers'] = $this->Admin_model->getbecomeWithDealerId();
        $data['content'] = 'seller/become-dealer/becomewithdealerid';
        echo Modules::run('template/adminTemplate', $data);
    }

    public function becomeDetailsWithDealerId($id)
    {
        $this->Common_model->sellerLoginCheck();
        $data['becomedealers'] = $this->Admin_model->getbecomeDealerDetailById($id);
        $data['content'] = 'seller/become-dealer/view-detail-with-dealer-id';
        echo Modules::run('template/adminTemplate', $data);
    }
    
    public function dealerUsers($id)
    {
        $this->Common_model->sellerLoginCheck();
        $data['UserManagements'] = $this->Admin_model->dealerUsers($id);
        $data['content'] = 'seller/become-dealer/dealer-users';
        echo Modules::run('template/adminTemplate', $data);
    }
    
    public function editbecomeDetailsWithDealerId($id)
    {
        $this->Common_model->sellerLoginCheck();
        $data['becomedealers'] = $this->Admin_model->getbecomeDealerDetailById($id);
        $data['countries'] = $this->Common_model->getCountries();
		
	$data['states'] = $this->Common_model->getState($data['becomedealers']->country);
       $data['jquery'] = 'seller/scanning/js/scanning-js';
        $data['cities'] = $this->Common_model->getCity($data['becomedealers']->state);
        $data['content'] = 'seller/become-dealer/edit-detail-with-dealer-id';
        echo Modules::run('template/adminTemplate', $data);
    }
    
    public function updateDealerDetails($id){
		$post = $this->input->post();
               $location = $this->Admin_model->updateDealerDetails($post, $id); 
               if($location ){
			redirect('seller/become-dealer-with-id');
		}else{
			
			
		}
     
		
		
	}




}

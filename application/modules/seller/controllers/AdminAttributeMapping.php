<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
include APPPATH . "modules/common/controllers/Common.php";

/**
 * Created by PhpStorm.
 * User: Amit
 * Date: 22-10-2016
 * Time: PM 08:30
 */
class AdminAttributeMapping extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('AdminAttributeMapping_Model'));
    }

    public function AttributeMapping(){

            $this->Common_model->sellerLoginCheck();
            $data['attributeMapping'] = $this->AdminAttributeMapping_Model->getAttributeMapping();

            $data['jquery'] = 'seller/settings/attribute-mapping/js/attribute-mapping-js';
            $data['content'] = 'seller/settings/attribute-mapping/index';
            echo Modules::run('template/adminTemplate', $data);


    }

    public function saveAttributeMapping(){

        $this->Common_model->sellerLoginCheck();
        $ProductId = $this->input->post('addProductId');
        $Attributevalueid = $this->input->post('addAttributevalueid');

            $recordId = $this->AdminAttributeMapping_Model->addAttributeMapping($ProductId,$Attributevalueid);
            if ($recordId) {
                $data['attributeMapping'] = $this->AdminAttributeMapping_Model->getAttributeMapping();
                $this->load->view('seller/settings/attribute-mapping/services/attribute-mapping-list', $data);
            } else {
                echo -2;
            }


    }

    public function editAttributeMapping(){

        $recordId = $this->input->post('recordId');
        $this->Common_model->sellerLoginCheck();
        $attributeMapping = $this->AdminAttributeMapping_Model->getAttributeMappingById($recordId);

        if ($attributeMapping) {
            $data['attributeMapping'] = $attributeMapping;

            $this->load->view('seller/settings/attribute-mapping/services/edit-attribute-mapping', $data);
        } else {
            echo -1;
        }

    }

    public function updateAttributeMapping(){

        $this->Common_model->sellerLoginCheck();
        $ProductId = $this->input->post('editProductId');
        $AttributeMappingId = $this->input->post('editAttributeMappingId');
        $recordId = $this->input->post('recordId');

            $updated = $this->AdminAttributeMapping_Model->updateAttributeMapping($ProductId,$AttributeMappingId,$recordId);

            if ($updated) {
                $data['attributeMapping'] = $this->AdminAttributeMapping_Model->getAttributeMapping();

                $this->load->view('seller/settings/attribute-mapping/services/attribute-mapping-list', $data);
            } else {
                echo -2;
            }


    }

    public function enableDisableAttributeMapping(){
        $this->Common_model->sellerLoginCheck();
        $recordId = $this->input->post('recordId');
        $isActive = $this->input->post('isActive');
        $activate = $this->AdminAttributeMapping_Model->enableDisableAttributeMapping($recordId, $isActive);
        if ($activate) {
            $data['attributeMapping'] = $this->AdminAttributeMapping_Model->getAttributeMapping();
            $this->load->view('seller/settings/attribute-mapping/services/attribute-mapping-list', $data);
        } else {
            echo -1;
        }
    }
}
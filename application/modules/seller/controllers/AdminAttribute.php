<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
include APPPATH . "modules/common/controllers/Common.php";

/**
 * Created by PhpStorm.
 * User: Amit
 * Date: 22-10-2016
 * Time: PM 08:30
 */
class AdminAttribute extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('AdminAttribute_model'));
    }

    /*---------------Attribute Starts ---------------*/

    public function attributes()
    {

        $this->Common_model->sellerLoginCheck();
        $data['attributes'] = $this->AdminAttribute_model->getAttributes();

        $data['jquery'] = 'seller/settings/attribute/js/attribute-js';
        $data['content'] = 'seller/settings/attribute/index';
        echo Modules::run('template/adminTemplate', $data);
    }

    public function saveAttribute()
    {
//        print_r($_REQUEST);die;
        $this->Common_model->sellerLoginCheck();

        $AttributeName = $this->input->post('addAttributeName');

        $checkAttributeName = $this->AdminAttribute_model->checkAttributeName($AttributeName);

        if ($checkAttributeName) {
            echo -1;
        } else {

            $recordId = $this->AdminAttribute_model->addAttribute($AttributeName);
            if ($recordId) {
                $data['attributes'] = $this->AdminAttribute_model->getAttributes();
                $this->load->view('seller/settings/attribute/services/attribute-list', $data);
            } else {
                echo -2;
            }

        }
    }


    public function editAttribute()
    {

        $this->Common_model->sellerLoginCheck();
        $recordId = $this->input->post('recordId');
        $attribute = $this->AdminAttribute_model->getAttributeById($recordId);

        if ($attribute) {
            $data['attribute'] = $attribute;

            $this->load->view('seller/settings/attribute/services/edit-attribute-model', $data);
        } else {
            echo -1;
        }
    }


    public function updateAttribute()
    {
        $this->Common_model->sellerLoginCheck();
        $editAttributeName = $this->input->post('editAttributeName');
        $recordId = $this->input->post('recordId');

        $checkAttributeName = $this->AdminAttribute_model->checkAttributeName($editAttributeName);

        if ($checkAttributeName) {
            echo -1;
        } else {
            $updated = $this->AdminAttribute_model->updateAttribute($editAttributeName, $recordId);

            if ($updated) {
                $data['attributes'] = $this->AdminAttribute_model->getAttributes();

                $this->load->view('seller/settings/attribute/services/attribute-list', $data);
            } else {
                echo -2;
            }

        }

    }

    public function enableDisableAttribute()
    {
        $this->Common_model->sellerLoginCheck();
        $recordId = $this->input->post('recordId');
        $isActive = $this->input->post('isActive');
        $activate = $this->AdminAttribute_model->enableDisableAttribute($recordId, $isActive);
        if ($activate) {
            $data['attributes'] = $this->AdminAttribute_model->getAttributes();
            $this->load->view('seller/settings/attribute/services/attribute-list', $data);
        } else {
            echo -1;
        }
    }

    /*---------------Attribute End ---------------*/

    /*---------------Attribute Value Start ---------------*/

    public function attributeValues()
    {

        $this->Common_model->sellerLoginCheck();
        $data['attributes'] = $this->AdminAttribute_model->getAttributeValues();

        $data['jquery'] = 'seller/settings/attribute-value/js/attribute-value-js';
        $data['content'] = 'seller/settings/attribute-value/index';
        echo Modules::run('template/adminTemplate', $data);
    }

    public function saveAttributeValue()
    {
        $this->Common_model->sellerLoginCheck();
        $SubCatId = $this->input->post('addSubCatId');
        $Attributeid = $this->input->post('addAttributeid');
        $AttributeValue = $this->input->post('addAttributeValue');

        if ($this->AdminAttribute_model->checkAttributeValueName($SubCatId, $AttributeValue)) {
            echo -1;
        } else {

            $recordId = $this->AdminAttribute_model->addAttributeValue($SubCatId, $Attributeid, $AttributeValue);
            if ($recordId) {
                $data['attributesValues'] = $this->AdminAttribute_model->getAttributeValues();
                $this->load->view('seller/settings/attribute-value/services/attribute-value-list', $data);
            } else {
                echo -2;
            }

        }
    }

    public function editAttributeValue()
    {

        $this->Common_model->sellerLoginCheck();
        $recordId = $this->input->post('recordId');
        $attributeValue = $this->AdminAttribute_model->getAttributeValueById($recordId);

        if ($attributeValue) {
            $data['attributeValue'] = $attributeValue;

            $this->load->view('seller/settings/attribute-value/services/edit-attribute-value', $data);
        } else {
            echo -1;
        }
    }

    public function updateAttributeValue()
    {

        $this->Common_model->sellerLoginCheck();
        $editSubCatId = $this->input->post('editSubCatId');
        $editAttriuteId = $this->input->post('editAttriuteId');
        $AttributeValue = $this->input->post('editAttributValue');
        $recordId = $this->input->post('recordId');

        $checkAttributeValueName = $this->AdminAttribute_model->checkAttributeValueName($AttributeValue);
//print_r($checkAttributeValueName);die;
        if ($checkAttributeValueName) {
            echo -1;
        } else {
            $updated = $this->AdminAttribute_model->updateAttributeValue($editSubCatId, $editAttriuteId, $AttributeValue, $recordId);

            if ($updated) {
                $data['attributes'] = $this->AdminAttribute_model->getAttributes();

                $this->load->view('seller/settings/attribute/services/attribute-list', $data);
            } else {
                echo -2;
            }

        }

    }

    public function enableDisableAttributeValue()
    {

        $this->Common_model->sellerLoginCheck();
        $recordId = $this->input->post('recordId');
        $isActive = $this->input->post('isActive');
        $activate = $this->AdminAttribute_model->enableDisableAttributeValue($recordId, $isActive);

        if ($activate) {
            $data['attributesValues'] = $this->AdminAttribute_model->getAttributeValues();
            $this->load->view('seller/settings/attribute-value/services/attribute-value-list', $data);
        } else {
            echo -1;
        }
    }


    public function getColorPicker()
    {
        $this->Common_model->sellerLoginCheck();
        $data['attributeName'] = $this->input->post('attributeName');
        $this->load->view('seller/settings/attribute-value/services/color-picker', $data);
    }


}

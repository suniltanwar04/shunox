<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
include APPPATH . "modules/common/controllers/Common.php";

/**
 * Created by PhpStorm.
 * User: Amit
 * Date: 22-10-2016
 * Time: PM 08:30
 */
class AdminCategory extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('AdminCategory_model'));
    }

    /*---------------Category Starts ---------------*/
    public function categories()
    {
        $this->Common_model->loginCheck();
        $data['categories'] = $this->AdminCategory_model->getCategories();
        //print_r($data['categories']);
         //die;
        $data['jquery'] = 'admin/settings/category/js/category-js';
        $data['content'] = 'admin/settings/category/index';
        echo Modules::run('template/adminTemplate', $data);
    }


    public function saveCategory()
    {
        $this->Common_model->loginCheck();
        $categoryName = $this->input->post('addCategoryName');
        $checkCategoryName = $this->AdminCategory_model->checkCategoryName($categoryName);
        if ($checkCategoryName) {
            echo -1;
        } else {

            $recordId = $this->AdminCategory_model->addCategory($categoryName);
            if ($recordId) {
                $data['categories'] = $this->AdminCategory_model->getCategories();
                $this->load->view('admin/settings/category/services/category-list', $data);
            } else {
                echo -2;
            }

        }
    }

    public function editCategories()
    {

        $this->Common_model->loginCheck();
        $recordId = $this->input->post('recordId');
        $category = $this->AdminCategory_model->getCategoryById($recordId);
        if ($category) {
            $data['category'] = $category;

            $this->load->view('admin/settings/category/services/edit-category-model', $data);
        } else {
            echo -1;
        }
    }

    public function updateCategory()
    {
        $this->Common_model->loginCheck();
        $editCategoryName = $this->input->post('editCategoryName');
        $recordId = $this->input->post('recordId');

        $checkCategoryName = $this->AdminCategory_model->checkCategoryName($editCategoryName);

        if ($checkCategoryName) {
            echo -1;
        } else {
            $updated = $this->AdminCategory_model->updateCategory($editCategoryName, $recordId);

            if ($updated) {
                $data['categories'] = $this->AdminCategory_model->getCategories();

                $this->load->view('admin/settings/category/services/category-list', $data);
            } else {
                echo -2;
            }

        }

    }

    public function enableDisableCategory()
    {
        $this->Common_model->loginCheck();
        $recordId = $this->input->post('recordId');
        $isActive = $this->input->post('isActive');
        $activate = $this->AdminCategory_model->enableDisableCategory($recordId, $isActive);
        if ($activate) {
            $data['categories'] = $this->AdminCategory_model->getCategories();
            $this->load->view('admin/settings/category/services/category-list', $data);
        } else {
            echo -1;
        }
    }

    public function getSubCategoryByCategory()
    {
        $this->Common_model->loginCheck();
        $data['CategoryId'] = $this->input->post('addCategoryId');
        $this->load->view('common/category/category-subCategory-list', $data);
    }

    /*---------------Category Ends ---------------*/

    /*---------------Sub-Category Start ---------------*/

    public function subCategories()
    {
        $this->Common_model->loginCheck();
        $data['SubCategories'] = $this->AdminCategory_model->getSubCategory();
        $data['jquery'] = 'admin/settings/sub-category/js/sub-category-js';
        $data['content'] = 'admin/settings/sub-category/index';
        echo Modules::run('template/adminTemplate', $data);
    }

    public function saveSubCategory()
    {
//        print_r($_FILES);
//        print_r($_POST);die;

        $this->Common_model->loginCheck();
        $SubcatName = $this->input->post('addSubcatName');
        $addCatId = $this->input->post('addCatId');
        $addSubcatDesc = $this->input->post('addSubcatDesc');

        if ($_FILES['addSubcatImag']['name'] != "") {
            $target = "uploads/subcategory/";
//                $target = $target . basename($_FILES['addimage']['name'][$i]);
            $types = array('image/jpeg', 'image/gif', 'image/png');
            $image = rand().$_FILES['addSubcatImag']['name'];
            if (in_array($_FILES['addSubcatImag']['type'], $types)) {

                if (move_uploaded_file($_FILES['addSubcatImag']['tmp_name'], $target.$image)) {
//                        echo "The file " . basename($_FILES['addimage']['name'][$i]) . " has been uploaded";
                }

            } else {
                echo "Your Image is not uploaded";
            }
        }


        $checkSubcatName = $this->AdminCategory_model->checkSubcat($SubcatName, $addCatId);

        if ($checkSubcatName) {
            echo -1;
        } else {

            $recordId = $this->AdminCategory_model->addSubCategory($SubcatName,$addCatId,$addSubcatDesc,$image);


            if ($recordId) {
                $data['SubCategories'] = $this->AdminCategory_model->getSubCategory();
                $this->load->view('admin/settings/sub-category/services/sub-category-list', $data);
            } else {
                echo -2;
            }

        }
    }


    public function editSubCategory()
    {
        $this->Common_model->loginCheck();
        $recordId = $this->input->post('recordId');
        $subcategory = $this->AdminCategory_model->getSubCatById($recordId);

        if ($subcategory) {
            $data['SubCategories'] = $subcategory;

            $this->load->view('admin/settings/sub-category/services/edit-sub-category', $data);
        } else {
            echo -1;
        }
    }

    public function updateSubCategory()
    {
        // print_r($_POST);die;
        $this->Common_model->loginCheck();
        $catId = $this->input->post('editcatId');
        $SubcatName = $this->input->post('editSubcatName');
        $Description = $this->input->post('editSubcatDesc');
        $recordId = $this->input->post('recordId');

//         if ($_FILES['addimage']['name'] != "") {
//             $target = "uploads/products/";
// //                $target = $target . basename($_FILES['addimage']['name'][$i]);
//             $types = array('image/jpeg', 'image/gif', 'image/png');
//             $arg['addimage'] = rand().$_FILES['addimage']['name'][$i];
//             $arg['ImageType'] = 0;
//             if (in_array($_FILES['addimage']['type'][$i], $types)) {
//
//                 if($_FILES['addimage']['size'][$i] <= 1000000) {
//
//
//                     if (move_uploaded_file($_FILES['addimage']['tmp_name'][$i], $target.$arg['addimage'])) {
// //                        echo "The file " . basename($_FILES['addimage']['name'][$i]) . " has been uploaded";
//                     }
//                 }else{
//                     echo "Your Image Should be less than 1 Mb";
//                 }
//
//             } else {
//                 echo "Your Image is not uploaded";
//             }
//         }

        $checkSubcat = $this->AdminCategory_model->checkSubcat($catId,$SubcatName);
        if ($checkSubcat) {
            echo -1;
        } else {
            $updated = $this->AdminCategory_model->updateSubCat($catId, $SubcatName, $Description,$recordId);
            if ($updated) {
              echo 1;
                // $data['SubCategories'] = $this->AdminCategory_model->getSubCategory();
                // $this->load->view('admin/settings/sub-category/services/sub-category-list', $data);
            } else {
                echo -2;
            }

        }
    }

    public function enableDisableSubCat()
    {
        $this->Common_model->loginCheck();
        $recordId = $this->input->post('recordId');
        $isActive = $this->input->post('isActive');
        $activate = $this->AdminCategory_model->enableDisableSubCat($recordId, $isActive);
        if ($activate) {
            $data['SubCategories'] = $this->AdminCategory_model->getSubCategory();
            $this->load->view('admin/settings/sub-category/services/sub-category-list', $data);
        } else {
            echo -1;
        }
    }


    /*---------------Sub-Category Ends ---------------*/


}

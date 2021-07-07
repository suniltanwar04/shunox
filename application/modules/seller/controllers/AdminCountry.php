<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
include APPPATH . "modules/common/controllers/Common.php";

/**
 * Created by PhpStorm.
 * User: Amit
 * Date: 22-10-2016
 * Time: PM 08:30
 */
class AdminCountry extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('AdminCountry_model'));
    }

    /*---------------Country Starts ---------------*/
    public function categories()
    {
        $this->Common_model->sellerLoginCheck();
        $data['categories'] = $this->AdminCountry_model->getCategories();
        $data['jquery'] = 'seller/settings/country/js/country-js';
        $data['content'] = 'seller/settings/country/index';
        echo Modules::run('template/adminTemplate', $data);
    }

    public function saveCategory()
    {

        $this->Common_model->sellerLoginCheck();
        $categoryName = $this->input->post('addCategoryName');

        $checkcategoryName = $this->AdminCountry_model->checkCategoryName($categoryName);

        if ($checkcategoryName) {
            echo -1;
        } else {

            $recordId = $this->AdminCountry_model->addCategory($categoryName);
            if ($recordId) {
                $data['countries'] = $this->AdminCountry_model->getCategories();
                $this->load->view('seller/settings/country/services/country-list', $data);
            } else {
                echo -2;
            }

        }
    }

    public function editCategories()
    {
        $this->Common_model->sellerLoginCheck();
        $recordId = $this->input->post('recordId');
        $category = $this->AdminCountry_model->getCategoryById($recordId);
        if ($category) {
            $data['category'] = $category;
            $this->load->view('seller/settings/country/services/edit-country', $data);
        } else {
            echo -1;
        }
    }

    public function updateCategory()
    {
        $this->Common_model->sellerLoginCheck();
        $editCategoryName = $this->input->post('editCategoryName');
        $recordId = $this->input->post('recordId');

        $checkCategoryName = $this->AdminCountry_model->checkCategoryName($editCategoryName);

        if ($checkCategoryName) {
            echo -1;
        } else {
            $updated = $this->AdminCountry_model->updateCategory($editCategoryName, $recordId);

            if ($updated) {
                $data['Categories'] = $this->AdminCountry_model->getCategories();
                $this->load->view('seller/settings/country/services/country-list', $data);
            } else {
                echo -2;
            }

        }
    }

    public function enableDisableCountry()
    {
        $this->Common_model->sellerLoginCheck();
        $recordId = $this->input->post('recordId');
        $isActive = $this->input->post('isActive');
        $activate = $this->AdminCountry_model->enableDisableCountry($recordId, $isActive);
        if ($activate) {
            $data['Categories'] = $this->AdminCountry_model->getCategories();
            $this->load->view('seller/settings/country/services/country-list', $data);
        } else {
            echo -1;
        }
    }

    /*---------------Country Ends ---------------*/

    /*---------------States Starts ---------------*/
    public function subCategory()
    {
        $this->Common_model->sellerLoginCheck();
        $data['SubCategories'] = $this->AdminCountry_model->getSubCategory();

        $data['jquery'] = 'seller/settings/state/js/state-js';
        $data['content'] = 'seller/settings/state/index';
        echo Modules::run('template/adminTemplate', $data);
    }

    public function saveSubCategory()
    {
        $this->Common_model->sellerLoginCheck();
        $SubcatName = $this->input->post('addSubcatName');

        $addCatId = $this->input->post('addCatId');

        $checkSubcatName = $this->AdminCountry_model->checkSubcat($SubcatName, $addCatId);

        if ($checkSubcatName) {
            echo -1;
        } else {
            $recordId = $this->AdminCountry_model->addSubCategory($SubcatName,$addCatId);

            if ($recordId) {
                $data['SubCategories'] = $this->AdminCountry_model->getSubCategory();
                $this->load->view('seller/settings/state/services/state-list', $data);
            } else {
                echo -2;
            }

        }
    }

    public function editSubCategory()
    {
        $this->Common_model->sellerLoginCheck();
        $recordId = $this->input->post('recordId');
        $subcategory = $this->AdminCountry_model->getSubCatById($recordId);


        if ($subcategory) {
            $data['SubCategories'] = $subcategory;
            $this->load->view('seller/settings/state/services/edit-state', $data);
        } else {
            echo -1;
        }
    }

    public function updateSubCategory()
    {
        $this->Common_model->sellerLoginCheck();
        $catId = $this->input->post('editcatId');
        $SubcatName = $this->input->post('editSubcatName');
        $recordId = $this->input->post('recordId');

        $checkSubcat = $this->AdminCountry_model->checkSubcat($catId, $SubcatName);

        if ($checkSubcat) {
            echo -1;
        } else {
            $updated = $this->AdminCountry_model->updateSubCat($catId, $SubcatName, $recordId);
            if ($updated) {
                $data['SubCategories'] = $this->AdminCountry_model->getSubCategory();
                $this->load->view('seller/settings/state/services/state-list', $data);
            } else {
                echo -2;
            }

        }
    }

    public function enableDisableState()
    {
        $this->Common_model->sellerLoginCheck();
        $recordId = $this->input->post('recordId');
        $isActive = $this->input->post('isActive');
        $activate = $this->AdminCountry_model->enableDisableState($recordId, $isActive);
        if ($activate) {
            $data['SubCategories'] = $this->AdminCountry_model->getSubCategory();
            $this->load->view('seller/settings/state/services/state-list', $data);
        } else {
            echo -1;
        }
    }


    public function getSubCategoryByCategory()
    {
        $this->Common_model->sellerLoginCheck();
        $data['CategoryId'] = $this->input->post('addCategoryId');

        $this->load->view('common/country/country-states-list', $data);
    }



    /*---------------States Ends ---------------*/


    /*---------------Cities Starts ---------------*/
    public function Product()
    {
        $this->Common_model->sellerLoginCheck();
        $data['products'] = $this->AdminCountry_model->getProduct();
        $data['jquery'] = 'seller/settings/city/js/city-js';
        $data['content'] = 'seller/settings/city/index';
        echo Modules::run('template/adminTemplate', $data);
    }


    public function saveCity()
    {
        $this->Common_model->sellerLoginCheck();


        $cityName = $this->input->post('cityName');
        $stateId = $this->input->post('stateId');

        $checkCity = $this->AdminCountry_model->checkCity($cityName, $stateId);
        if ($checkCity) {
            echo -1;
        } else {
            $recordId = $this->AdminCountry_model->addCity($cityName, $stateId);
            if ($recordId) {
                $data['cities'] = $this->AdminCountry_model->getCities();
                $this->load->view('seller/settings/city/services/city-list', $data);
            } else {
                echo -2;
            }

        }
    }


    public function editCity()
    {
        $this->Common_model->sellerLoginCheck();
        $recordId = $this->input->post('recordId');
        $city = $this->AdminCountry_model->getCityById($recordId);

        if ($city) {
            $data['city'] = $city;
            $this->load->view('seller/settings/city/services/edit-city', $data);
        } else {
            echo -1;
        }
    }


    public function updateCity()
    {
        $this->Common_model->sellerLoginCheck();
        $stateId = $this->input->post('stateId');
        $cityName = $this->input->post('cityName');
        $recordId = $this->input->post('recordId');

        $checkCity = $this->AdminCountry_model->checkCity($cityName, $stateId);

        if ($checkCity) {
            echo -1;
        } else {
            $updated = $this->AdminCountry_model->updateCity($cityName, $stateId, $recordId);
            if ($updated) {
                $data['cities'] = $this->AdminCountry_model->getCities();
                $this->load->view('seller/settings/city/services/city-list', $data);
            } else {
                echo -2;
            }

        }
    }

    public function enableDisableProduct()
    {
        $this->Common_model->sellerLoginCheck();
        $recordId = $this->input->post('recordId');
        $isActive = $this->input->post('isActive');
        $activate = $this->AdminCountry_model->enableDisableProduct($recordId, $isActive);

        if ($activate) {
            $data['products'] = $this->AdminCountry_model->getProduct();
            $this->load->view('seller/settings/city/services/city-list', $data);
        } else {
            echo -1;
        }
    }


    public function getCitiesByState()
    {
        $this->Common_model->sellerLoginCheck();
        $data['stateId'] = $this->input->post('stateId');
        $this->load->view('common/country/state-cities-list', $data);

    }

    /*---------------Cities Ends ---------------*/


    /*---------------Localities Starts ---------------*/
    public function localities()
    {
        $this->Common_model->sellerLoginCheck();
        $data['localities'] = $this->AdminCountry_model->getLocalities();
        $data['jquery'] = 'seller/settings/locality/js/locality-js';
        $data['content'] = 'seller/settings/locality/index';
        echo Modules::run('template/adminTemplate', $data);
    }


    public function saveLocality()
    {
        $this->Common_model->sellerLoginCheck();
        $localityName = $this->input->post('localityName');
        $pinCode = $this->input->post('pinCode');
        $cityId = $this->input->post('cityId');
        $latitude = $this->input->post('latitude');
        $longitude = $this->input->post('longitude');

        $checkLocality = $this->AdminCountry_model->checkLocality($localityName, $cityId);
        if ($checkLocality) {
            echo -1;
        } else {
            $recordId = $this->AdminCountry_model->addLocality($localityName, $pinCode, $cityId, $latitude, $longitude);
            if ($recordId) {
                $data['localities'] = $this->AdminCountry_model->getLocalities();
                $this->load->view('seller/settings/locality/services/locality-list', $data);
            } else {
                echo -2;
            }

        }
    }

    public function editLocality()
    {
        $this->Common_model->sellerLoginCheck();
        $recordId = $this->input->post('recordId');
        $locality = $this->AdminCountry_model->getLocalityById($recordId);
        if ($locality) {
            $data['locality'] = $locality;;
            $this->load->view('seller/settings/locality/services/edit-locality', $data);
        } else {
            echo -1;
        }
    }


    public function updateLocality()
    {
        $this->Common_model->sellerLoginCheck();

        $localityName = $this->input->post('localityName');
        $pinCode = $this->input->post('pinCode');
        $cityId = $this->input->post('cityId');
        $recordId = $this->input->post('recordId');
        $latitude = $this->input->post('editLatitude');
        $longitude = $this->input->post('editLongitude');

        $checkLocality = $this->AdminCountry_model->checkLocality($localityName, $cityId);

        if ($checkLocality) {
            echo -1;
        } else {
            $recordId = $this->AdminCountry_model->updateLocality($localityName, $pinCode, $cityId, $latitude, $longitude, $recordId);
            if ($recordId) {
                $data['localities'] = $this->AdminCountry_model->getLocalities();
                $this->load->view('seller/settings/locality/services/locality-list', $data);
            } else {
                echo -2;
            }

        }
    }


    public function enableDisableLocality()
    {
        $this->Common_model->sellerLoginCheck();
        $recordId = $this->input->post('recordId');
        $isActive = $this->input->post('isActive');
        $activate = $this->AdminCountry_model->enableDisableLocality($recordId, $isActive);
        if ($activate) {
            $data['localities'] = $this->AdminCountry_model->getLocalities();
            $this->load->view('seller/settings/locality/services/locality-list', $data);
        } else {
            echo -1;
        }
    }

    /*---------------Localities Ends ---------------*/


}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/


$route['default_controller'] = 'site/shoeMade';
//$route['default_controller'] = 'site/SiteTest';

/*----------BackEnd Routes Start----------*/


$route[CommonConstants::ADMIN_URL_SLUG] = 'admin';
$route[CommonConstants::ADMIN_URL_SLUG . '/login'] = 'admin/AdminLogin/login';

$route[CommonConstants::ADMIN_URL_SLUG .'/logins/(:any)'] = 'admin/Admin/login/$1';
$route[CommonConstants::ADMIN_URL_SLUG . '/dashboard'] = 'admin/AdminDashboard';
$route[CommonConstants::ADMIN_URL_SLUG . '/logout'] = 'admin/AdminLogin/logOut';
$route[CommonConstants::ADMIN_URL_SLUG . '/categories'] = 'admin/AdminCategory/categories';
$route[CommonConstants::ADMIN_URL_SLUG . '/sub-categories'] = 'admin/AdminCategory/subCategories';
$route[CommonConstants::ADMIN_URL_SLUG . '/product'] = 'admin/AdminProduct/products';
$route[CommonConstants::ADMIN_URL_SLUG . '/banner'] = 'admin/AdminBanner';
$route[CommonConstants::ADMIN_URL_SLUG . '/product-attributes/(:any)'] = 'admin/AdminProduct/productAttributeList/$1';
$route[CommonConstants::ADMIN_URL_SLUG . '/manage-images/(:any)'] = 'admin/AdminProduct/productImagesList/$1';
$route[CommonConstants::ADMIN_URL_SLUG . '/delete-image/(:any)/(:any)'] = 'admin/AdminProduct/productImagesDelete/$1/$2';
$route[CommonConstants::ADMIN_URL_SLUG . '/saveProductAttr'] = 'admin/AdminProduct/saveProductAttribute';
$route[CommonConstants::ADMIN_URL_SLUG . '/saveImageAttr'] = 'admin/AdminProduct/saveImageAttribute';
$route[CommonConstants::ADMIN_URL_SLUG . '/user-management'] = 'admin/AdminUserManagement/userManagement';
$route[CommonConstants::ADMIN_URL_SLUG . '/user-details/(:any)'] = 'admin/AdminUserManagement/getUserDetailById/$1';
$route[CommonConstants::ADMIN_URL_SLUG . '/user-edit/(:any)'] = 'admin/AdminUserManagement/getUserEditById/$1';
$route[CommonConstants::ADMIN_URL_SLUG . '/user-update/(:any)'] = 'admin/AdminUserManagement/userUpdate/$1';
$route[CommonConstants::ADMIN_URL_SLUG . '/list-user-wise-order-product/(:any)'] = 'admin/AdminUserManagement/getListUserWiseOrderProductById/$1';
$route[CommonConstants::ADMIN_URL_SLUG . '/order-management'] = 'admin/AdminOrderManagement/orderManagement';
$route[CommonConstants::ADMIN_URL_SLUG . '/delete-order-management'] = 'admin/AdminOrderManagement/deleteOrderManagement';
$route[CommonConstants::ADMIN_URL_SLUG . '/coupon-listing'] = 'admin/AdminOrderManagement/orderCouponListing';
$route[CommonConstants::ADMIN_URL_SLUG . '/order-wise-product-details/(:any)'] = 'admin/AdminOrderManagement/orderWiseProductDetails/$1';
$route[CommonConstants::ADMIN_URL_SLUG . '/attributes'] = 'admin/AdminAttribute/attributes';
$route[CommonConstants::ADMIN_URL_SLUG . '/attribute-values'] = 'admin/AdminAttribute/attributeValues';
$route[CommonConstants::ADMIN_URL_SLUG . '/admin-Attribute-Mapping'] = 'admin/AdminAttributeMapping/AttributeMapping/';
$route[CommonConstants::ADMIN_URL_SLUG . '/admin-save-category'] = 'admin/AdminCategory/saveCategory';
$route[CommonConstants::ADMIN_URL_SLUG . '/editCategories'] = 'admin/AdminCategory/editCategories';
$route[CommonConstants::ADMIN_URL_SLUG . '/updatecategory'] = 'admin/AdminCategory/updatecategory';
$route[CommonConstants::ADMIN_URL_SLUG . '/enableDisableCategory'] = 'admin/AdminCategory/enableDisableCategory';
$route[CommonConstants::ADMIN_URL_SLUG . '/getSubCategoryByCategory'] = 'admin/AdminCategory/getSubCategoryByCategory';
$route[CommonConstants::ADMIN_URL_SLUG . '/saveSubCategory'] = 'admin/AdminCategory/saveSubCategory';
$route[CommonConstants::ADMIN_URL_SLUG . '/editSubCategory'] = 'admin/AdminCategory/editSubCategory';
$route[CommonConstants::ADMIN_URL_SLUG . '/updateSubCategory'] = 'admin/AdminCategory/updateSubCategory';
$route[CommonConstants::ADMIN_URL_SLUG . '/enableDisableSubCat'] = 'admin/AdminCategory/enableDisableSubCat';
$route[CommonConstants::ADMIN_URL_SLUG . '/saveProduct'] = 'admin/AdminProduct/saveProduct';
$route[CommonConstants::ADMIN_URL_SLUG . '/editProduct'] = 'admin/AdminProduct/editProduct';
$route[CommonConstants::ADMIN_URL_SLUG . '/updateProduct'] = 'admin/AdminProduct/updateProduct';
$route[CommonConstants::ADMIN_URL_SLUG . '/enableDisableProduct'] = 'admin/AdminProduct/enableDisableProduct';
$route[CommonConstants::ADMIN_URL_SLUG . '/deleteProduct'] = 'admin/AdminProduct/deleteProduct';
$route[CommonConstants::ADMIN_URL_SLUG . '/saveAttribute'] = 'admin/AdminAttribute/saveAttribute/';
$route[CommonConstants::ADMIN_URL_SLUG . '/editAttribute'] = 'admin/AdminAttribute/editAttribute/';
$route[CommonConstants::ADMIN_URL_SLUG . '/updateAttribute'] = 'admin/AdminAttribute/updateAttribute/';
$route[CommonConstants::ADMIN_URL_SLUG . '/enableDisableAttribute'] = 'admin/AdminAttribute/enableDisableAttribute/';
$route[CommonConstants::ADMIN_URL_SLUG . '/saveAttributeValue'] = 'admin/AdminAttribute/saveAttributeValue/';
$route[CommonConstants::ADMIN_URL_SLUG . '/editAttributeValue'] = 'admin/AdminAttribute/editAttributeValue/';
$route[CommonConstants::ADMIN_URL_SLUG . '/updateAttributeValue'] = 'admin/AdminAttribute/updateAttributeValue/';
$route[CommonConstants::ADMIN_URL_SLUG . '/enableDisableAttributeValue'] = 'admin/AdminAttribute/enableDisableAttributeValue/';
$route[CommonConstants::ADMIN_URL_SLUG . '/enable-disable-users'] = 'admin/AdminUserManagement/enableDisableUsers/';
$route[CommonConstants::ADMIN_URL_SLUG . '/delete-user'] = 'admin/AdminUserManagement/deleteUser/';
$route[CommonConstants::ADMIN_URL_SLUG . '/editPassword'] = 'admin/AdminUserManagement/editPassword/';
$route[CommonConstants::ADMIN_URL_SLUG . '/userPasswordUpdate'] = 'admin/AdminUserManagement/userPasswordUpdate/';
$route[CommonConstants::ADMIN_URL_SLUG . '/current-status'] = 'admin/AdminOrderManagement/currentStatus/';
//for review
$route[CommonConstants::ADMIN_URL_SLUG . '/review-list'] = 'admin/AdminReview/review';
$route[CommonConstants::ADMIN_URL_SLUG . '/enable-disable-review'] = 'admin/AdminReview/enableDisableReview';
$route[CommonConstants::ADMIN_URL_SLUG . '/delete-review'] = 'admin/AdminReview/deleteReview';
//for Coupon
$route[CommonConstants::ADMIN_URL_SLUG . '/coupon'] = 'admin/AdminCoupon/couponlist';
$route[CommonConstants::ADMIN_URL_SLUG . '/cart-list'] = 'admin/AdminCartList/index';
$route[CommonConstants::ADMIN_URL_SLUG . '/notify-list'] = 'admin/AdminNotifyList/index';
$route[CommonConstants::ADMIN_URL_SLUG . '/color-picker-input'] = 'admin/AdminAttribute/getColorPicker';
$route[CommonConstants::ADMIN_URL_SLUG . '/settings'] = 'admin/AdminSetting/index';
$route[CommonConstants::ADMIN_URL_SLUG . '/savesettings'] = 'admin/AdminSetting/saveSetting';
$route[CommonConstants::ADMIN_URL_SLUG . '/saveBanner'] = 'admin/AdminBanner/saveBanner';
$route[CommonConstants::ADMIN_URL_SLUG . '/enableDisableBanner'] = 'admin/AdminBanner/enableDisableBanner';
$route[CommonConstants::ADMIN_URL_SLUG . '/deleteBanner'] = 'admin/AdminBanner/deleteBanner';
$route[CommonConstants::ADMIN_URL_SLUG . '/edit-banner/(:any)'] = 'admin/AdminBanner/editBanner/$1';
$route[CommonConstants::ADMIN_URL_SLUG . '/updatebanner/(:any)'] = 'admin/AdminBanner/updateBanner/$1';
$route[CommonConstants::ADMIN_URL_SLUG . '/social'] = 'admin/AdminSocial';
$route[CommonConstants::ADMIN_URL_SLUG . '/saveSocial'] = 'admin/AdminSocial/saveSocial';
$route[CommonConstants::ADMIN_URL_SLUG . '/enableDisableSocial'] = 'admin/AdminSocial/enableDisableSocial';
$route[CommonConstants::ADMIN_URL_SLUG . '/deleteSocial'] = 'admin/AdminSocial/deleteSocial';
$route[CommonConstants::ADMIN_URL_SLUG . '/edit-social/(:any)'] = 'admin/AdminSocial/editSocial/$1';
$route[CommonConstants::ADMIN_URL_SLUG . '/updatesocial/(:any)'] = 'admin/AdminSocial/updateSocial/$1';

$route[CommonConstants::ADMIN_URL_SLUG . '/pagelist'] = 'admin/AdminPage/index';
$route[CommonConstants::ADMIN_URL_SLUG . '/addPage'] = 'admin/AdminPage/addPage';
$route[CommonConstants::ADMIN_URL_SLUG . '/savePage'] = 'admin/AdminPage/savePageData';
$route[CommonConstants::ADMIN_URL_SLUG . '/editPage/(:any)'] = 'admin/AdminPage/editPageData/$1';
$route[CommonConstants::ADMIN_URL_SLUG . '/updatePage/(:any)'] = 'admin/AdminPage/updatePageData/$1';
$route[CommonConstants::ADMIN_URL_SLUG . '/location'] = 'admin/AdminScanningLocation/index';
$route[CommonConstants::ADMIN_URL_SLUG . '/saveLocation'] = 'admin/AdminScanningLocation/saveLocation';
$route[CommonConstants::ADMIN_URL_SLUG . '/enableDisableLocation'] = 'admin/AdminScanningLocation/enableDisableLocation';
$route[CommonConstants::ADMIN_URL_SLUG . '/deleteLocation'] = 'admin/AdminScanningLocation/deleteLocation';
$route[CommonConstants::ADMIN_URL_SLUG . '/editLocation/(:any)'] = 'admin/AdminScanningLocation/editLocationData/$1';
$route[CommonConstants::ADMIN_URL_SLUG . '/updateLocation/(:any)'] = 'admin/AdminScanningLocation/updateLocationData/$1';
$route[CommonConstants::ADMIN_URL_SLUG . '/edit-become-detail-with-dealer-id/(:any)'] = 'admin/Admin/editbecomeDetailsWithDealerId/$1';
$route[CommonConstants::ADMIN_URL_SLUG . '/updatedealerdetails/(:any)'] = 'admin/Admin/updateDealerDetails/$1';

$route[CommonConstants::ADMIN_URL_SLUG . '/blogs'] = 'admin/AdminBlog/index';

$route[CommonConstants::ADMIN_URL_SLUG . '/blog/add'] = 'admin/AdminBlog/addBlogForm';

$route[CommonConstants::ADMIN_URL_SLUG . '/blog/add-blog-form'] = 'admin/AdminBlog/addBlog';

$route[CommonConstants::ADMIN_URL_SLUG . '/blog/delete/(:any)'] = 'admin/AdminBlog/delete/$1';
$route[CommonConstants::ADMIN_URL_SLUG . '/blog/edit/(:any)'] = 'admin/AdminBlog/editForm/$1';

$route[CommonConstants::ADMIN_URL_SLUG . '/blog/update-blog/(:any)'] = 'admin/AdminBlog/updateBlog/$1';
$route[CommonConstants::ADMIN_URL_SLUG . '/newsletter'] = 'admin/Admin/newsLetter';
$route[CommonConstants::ADMIN_URL_SLUG . '/send-newsletter'] = 'admin/Admin/sendNewsletter';

$route[CommonConstants::ADMIN_URL_SLUG . '/become-dealer'] = 'admin/Admin/becomeDealer';
$route[CommonConstants::ADMIN_URL_SLUG . '/become-dealer-with-id'] = 'admin/Admin/becomeWithDealerId';
$route[CommonConstants::ADMIN_URL_SLUG . '/view-become-detail/(:any)'] = 'admin/Admin/becomeDetails/$1';
$route[CommonConstants::ADMIN_URL_SLUG . '/view-become-detail-with-dealer-id/(:any)'] = 'admin/Admin/becomeDetailsWithDealerId/$1';
$route[CommonConstants::ADMIN_URL_SLUG . '/delete-dealer'] = 'admin/Admin/deleteDealer';
$route[CommonConstants::ADMIN_URL_SLUG . '/editDealer'] = 'admin/Admin/editDealer';
$route[CommonConstants::ADMIN_URL_SLUG . '/updateDealer'] = 'admin/Admin/updateDealer';
$route[CommonConstants::ADMIN_URL_SLUG . '/saveEmailAddress'] = 'admin/Admin/saveEmailAddress';
$route[CommonConstants::ADMIN_URL_SLUG . '/view-users/(:any)'] = 'admin/Admin/dealerUsers/$1';

$route[CommonConstants::ADMIN_URL_SLUG . '/send-forgot-pass-mail'] = 'admin/AdminLogin/sendResetPassMail';
$route[CommonConstants::ADMIN_URL_SLUG . '/getstatusbyorder'] = 'admin/AdminOrderManagement/getStatusByOrder';
$route[CommonConstants::ADMIN_URL_SLUG . '/send-forgot-pass-mail'] = 'admin/AdminLogin/sendResetPassMail';
$route[CommonConstants::ADMIN_URL_SLUG . '/resetpassword'] = 'admin/AdminLogin/resetPassword';


$route['reset-password/(:any)'] = 'admin/AdminLogin/resetPassPage/$1';
$route['edit-product/(:any)'] = 'admin/AdminProduct/editProduct/$1';

/*----------BackEnd Routes End----------*/


/*----------Seller Routes Start----------*/
$route[CommonConstants::SELLER_URL_SLUG] = 'seller';
$route[CommonConstants::SELLER_URL_SLUG . '/login'] = 'seller/AdminLogin/login';

$route[CommonConstants::SELLER_URL_SLUG .'/logins/(:any)'] = 'seller/seller/login/$1';
$route[CommonConstants::SELLER_URL_SLUG . '/dashboard'] = 'seller/AdminDashboard';
$route[CommonConstants::SELLER_URL_SLUG . '/logout'] = 'seller/AdminLogin/logOut';
$route[CommonConstants::SELLER_URL_SLUG . '/categories'] = 'seller/AdminCategory/categories';
$route[CommonConstants::SELLER_URL_SLUG . '/sub-categories'] = 'seller/AdminCategory/subCategories';
$route[CommonConstants::SELLER_URL_SLUG . '/product'] = 'seller/AdminProduct/products';
$route[CommonConstants::SELLER_URL_SLUG . '/banner'] = 'seller/AdminBanner';
$route[CommonConstants::SELLER_URL_SLUG . '/product-attributes/(:any)'] = 'seller/AdminProduct/productAttributeList/$1';
$route[CommonConstants::SELLER_URL_SLUG . '/manage-images/(:any)'] = 'seller/AdminProduct/productImagesList/$1';
$route[CommonConstants::SELLER_URL_SLUG . '/delete-image/(:any)/(:any)'] = 'seller/AdminProduct/productImagesDelete/$1/$2';
$route[CommonConstants::SELLER_URL_SLUG . '/saveProductAttr'] = 'seller/AdminProduct/saveProductAttribute';
$route[CommonConstants::SELLER_URL_SLUG . '/saveImageAttr'] = 'seller/AdminProduct/saveImageAttribute';
$route[CommonConstants::SELLER_URL_SLUG . '/user-management'] = 'seller/AdminUserManagement/userManagement';
$route[CommonConstants::SELLER_URL_SLUG . '/user-details/(:any)'] = 'seller/AdminUserManagement/getUserDetailById/$1';
$route[CommonConstants::SELLER_URL_SLUG . '/user-edit/(:any)'] = 'seller/AdminUserManagement/getUserEditById/$1';
$route[CommonConstants::SELLER_URL_SLUG . '/user-update/(:any)'] = 'seller/AdminUserManagement/userUpdate/$1';
$route[CommonConstants::SELLER_URL_SLUG . '/list-user-wise-order-product/(:any)'] = 'seller/AdminUserManagement/getListUserWiseOrderProductById/$1';
$route[CommonConstants::SELLER_URL_SLUG . '/order-management'] = 'seller/AdminOrderManagement/orderManagement';
$route[CommonConstants::SELLER_URL_SLUG . '/delete-order-management'] = 'seller/AdminOrderManagement/deleteOrderManagement';
$route[CommonConstants::SELLER_URL_SLUG . '/coupon-listing'] = 'seller/AdminOrderManagement/orderCouponListing';
$route[CommonConstants::SELLER_URL_SLUG . '/order-wise-product-details/(:any)'] = 'seller/AdminOrderManagement/orderWiseProductDetails/$1';
$route[CommonConstants::SELLER_URL_SLUG . '/attributes'] = 'seller/AdminAttribute/attributes';
$route[CommonConstants::SELLER_URL_SLUG . '/attribute-values'] = 'seller/AdminAttribute/attributeValues';
$route[CommonConstants::SELLER_URL_SLUG . '/admin-Attribute-Mapping'] = 'seller/AdminAttributeMapping/AttributeMapping/';
$route[CommonConstants::SELLER_URL_SLUG . '/admin-save-category'] = 'seller/AdminCategory/saveCategory';
$route[CommonConstants::SELLER_URL_SLUG . '/editCategories'] = 'seller/AdminCategory/editCategories';
$route[CommonConstants::SELLER_URL_SLUG . '/updatecategory'] = 'seller/AdminCategory/updatecategory';
$route[CommonConstants::SELLER_URL_SLUG . '/enableDisableCategory'] = 'seller/AdminCategory/enableDisableCategory';
$route[CommonConstants::SELLER_URL_SLUG . '/getSubCategoryByCategory'] = 'seller/AdminCategory/getSubCategoryByCategory';
$route[CommonConstants::SELLER_URL_SLUG . '/saveSubCategory'] = 'seller/AdminCategory/saveSubCategory';
$route[CommonConstants::SELLER_URL_SLUG . '/editSubCategory'] = 'seller/AdminCategory/editSubCategory';
$route[CommonConstants::SELLER_URL_SLUG . '/updateSubCategory'] = 'seller/AdminCategory/updateSubCategory';
$route[CommonConstants::SELLER_URL_SLUG . '/enableDisableSubCat'] = 'seller/AdminCategory/enableDisableSubCat';
$route[CommonConstants::SELLER_URL_SLUG . '/saveProduct'] = 'seller/AdminProduct/saveProduct';
$route[CommonConstants::SELLER_URL_SLUG . '/editProduct'] = 'seller/AdminProduct/editProduct';
$route[CommonConstants::SELLER_URL_SLUG . '/updateProduct'] = 'seller/AdminProduct/updateProduct';
$route[CommonConstants::SELLER_URL_SLUG . '/enableDisableProduct'] = 'seller/AdminProduct/enableDisableProduct';
$route[CommonConstants::SELLER_URL_SLUG . '/deleteProduct'] = 'seller/AdminProduct/deleteProduct';
$route[CommonConstants::SELLER_URL_SLUG . '/saveAttribute'] = 'seller/AdminAttribute/saveAttribute/';
$route[CommonConstants::SELLER_URL_SLUG . '/editAttribute'] = 'seller/AdminAttribute/editAttribute/';
$route[CommonConstants::SELLER_URL_SLUG . '/updateAttribute'] = 'seller/AdminAttribute/updateAttribute/';
$route[CommonConstants::SELLER_URL_SLUG . '/enableDisableAttribute'] = 'seller/AdminAttribute/enableDisableAttribute/';
$route[CommonConstants::SELLER_URL_SLUG . '/saveAttributeValue'] = 'seller/AdminAttribute/saveAttributeValue/';
$route[CommonConstants::SELLER_URL_SLUG . '/editAttributeValue'] = 'seller/AdminAttribute/editAttributeValue/';
$route[CommonConstants::SELLER_URL_SLUG . '/updateAttributeValue'] = 'seller/AdminAttribute/updateAttributeValue/';
$route[CommonConstants::SELLER_URL_SLUG . '/enableDisableAttributeValue'] = 'seller/AdminAttribute/enableDisableAttributeValue/';
$route[CommonConstants::SELLER_URL_SLUG . '/enable-disable-users'] = 'seller/AdminUserManagement/enableDisableUsers/';
$route[CommonConstants::SELLER_URL_SLUG . '/delete-user'] = 'seller/AdminUserManagement/deleteUser/';
$route[CommonConstants::SELLER_URL_SLUG . '/editPassword'] = 'seller/AdminUserManagement/editPassword/';
$route[CommonConstants::SELLER_URL_SLUG . '/userPasswordUpdate'] = 'seller/AdminUserManagement/userPasswordUpdate/';
$route[CommonConstants::SELLER_URL_SLUG . '/current-status'] = 'seller/AdminOrderManagement/currentStatus/';
//for review
$route[CommonConstants::SELLER_URL_SLUG . '/review-list'] = 'seller/AdminReview/review';
$route[CommonConstants::SELLER_URL_SLUG . '/enable-disable-review'] = 'seller/AdminReview/enableDisableReview';
$route[CommonConstants::SELLER_URL_SLUG . '/delete-review'] = 'seller/AdminReview/deleteReview';
//for Coupon
$route[CommonConstants::SELLER_URL_SLUG . '/coupon'] = 'seller/AdminCoupon/couponlist';
$route[CommonConstants::SELLER_URL_SLUG . '/cart-list'] = 'seller/AdminCartList/index';
$route[CommonConstants::SELLER_URL_SLUG . '/notify-list'] = 'seller/AdminNotifyList/index';
$route[CommonConstants::SELLER_URL_SLUG . '/color-picker-input'] = 'seller/AdminAttribute/getColorPicker';
$route[CommonConstants::SELLER_URL_SLUG . '/settings'] = 'seller/AdminSetting/index';
$route[CommonConstants::SELLER_URL_SLUG . '/savesettings'] = 'seller/AdminSetting/saveSetting';
$route[CommonConstants::SELLER_URL_SLUG . '/saveBanner'] = 'seller/AdminBanner/saveBanner';
$route[CommonConstants::SELLER_URL_SLUG . '/enableDisableBanner'] = 'seller/AdminBanner/enableDisableBanner';
$route[CommonConstants::SELLER_URL_SLUG . '/deleteBanner'] = 'seller/AdminBanner/deleteBanner';
$route[CommonConstants::SELLER_URL_SLUG . '/edit-banner/(:any)'] = 'seller/AdminBanner/editBanner/$1';
$route[CommonConstants::SELLER_URL_SLUG . '/updatebanner/(:any)'] = 'seller/AdminBanner/updateBanner/$1';
$route[CommonConstants::SELLER_URL_SLUG . '/social'] = 'seller/AdminSocial';
$route[CommonConstants::SELLER_URL_SLUG . '/saveSocial'] = 'seller/AdminSocial/saveSocial';
$route[CommonConstants::SELLER_URL_SLUG . '/enableDisableSocial'] = 'seller/AdminSocial/enableDisableSocial';
$route[CommonConstants::SELLER_URL_SLUG . '/deleteSocial'] = 'seller/AdminSocial/deleteSocial';
$route[CommonConstants::SELLER_URL_SLUG . '/edit-social/(:any)'] = 'seller/AdminSocial/editSocial/$1';
$route[CommonConstants::SELLER_URL_SLUG . '/updatesocial/(:any)'] = 'seller/AdminSocial/updateSocial/$1';

$route[CommonConstants::SELLER_URL_SLUG . '/pagelist'] = 'seller/AdminPage/index';
$route[CommonConstants::SELLER_URL_SLUG . '/addPage'] = 'seller/AdminPage/addPage';
$route[CommonConstants::SELLER_URL_SLUG . '/savePage'] = 'seller/AdminPage/savePageData';
$route[CommonConstants::SELLER_URL_SLUG . '/editPage/(:any)'] = 'seller/AdminPage/editPageData/$1';
$route[CommonConstants::SELLER_URL_SLUG . '/updatePage/(:any)'] = 'seller/AdminPage/updatePageData/$1';
$route[CommonConstants::SELLER_URL_SLUG . '/location'] = 'seller/AdminScanningLocation/index';
$route[CommonConstants::SELLER_URL_SLUG . '/saveLocation'] = 'seller/AdminScanningLocation/saveLocation';
$route[CommonConstants::SELLER_URL_SLUG . '/enableDisableLocation'] = 'seller/AdminScanningLocation/enableDisableLocation';
$route[CommonConstants::SELLER_URL_SLUG . '/deleteLocation'] = 'seller/AdminScanningLocation/deleteLocation';
$route[CommonConstants::SELLER_URL_SLUG . '/editLocation/(:any)'] = 'seller/AdminScanningLocation/editLocationData/$1';
$route[CommonConstants::SELLER_URL_SLUG . '/updateLocation/(:any)'] = 'seller/AdminScanningLocation/updateLocationData/$1';
$route[CommonConstants::SELLER_URL_SLUG . '/edit-become-detail-with-dealer-id/(:any)'] = 'seller/Admin/editbecomeDetailsWithDealerId/$1';
$route[CommonConstants::SELLER_URL_SLUG . '/updatedealerdetails/(:any)'] = 'seller/Admin/updateDealerDetails/$1';

$route[CommonConstants::SELLER_URL_SLUG . '/blogs'] = 'seller/AdminBlog/index';

$route[CommonConstants::SELLER_URL_SLUG . '/blog/add'] = 'seller/AdminBlog/addBlogForm';

$route[CommonConstants::SELLER_URL_SLUG . '/blog/add-blog-form'] = 'seller/AdminBlog/addBlog';

$route[CommonConstants::SELLER_URL_SLUG . '/blog/delete/(:any)'] = 'seller/AdminBlog/delete/$1';
$route[CommonConstants::SELLER_URL_SLUG . '/blog/edit/(:any)'] = 'seller/AdminBlog/editForm/$1';

$route[CommonConstants::SELLER_URL_SLUG . '/blog/update-blog/(:any)'] = 'seller/AdminBlog/updateBlog/$1';
$route[CommonConstants::SELLER_URL_SLUG . '/newsletter'] = 'seller/Admin/newsLetter';
$route[CommonConstants::SELLER_URL_SLUG . '/send-newsletter'] = 'seller/Admin/sendNewsletter';

$route[CommonConstants::SELLER_URL_SLUG . '/become-dealer'] = 'seller/Admin/becomeDealer';
$route[CommonConstants::SELLER_URL_SLUG . '/become-dealer-with-id'] = 'seller/Admin/becomeWithDealerId';
$route[CommonConstants::SELLER_URL_SLUG . '/view-become-detail/(:any)'] = 'seller/Admin/becomeDetails/$1';
$route[CommonConstants::SELLER_URL_SLUG . '/view-become-detail-with-dealer-id/(:any)'] = 'seller/Admin/becomeDetailsWithDealerId/$1';
$route[CommonConstants::SELLER_URL_SLUG . '/delete-dealer'] = 'seller/Admin/deleteDealer';
$route[CommonConstants::SELLER_URL_SLUG . '/editDealer'] = 'seller/Admin/editDealer';
$route[CommonConstants::SELLER_URL_SLUG . '/updateDealer'] = 'seller/Admin/updateDealer';
$route[CommonConstants::SELLER_URL_SLUG . '/saveEmailAddress'] = 'seller/Admin/saveEmailAddress';
$route[CommonConstants::SELLER_URL_SLUG . '/view-users/(:any)'] = 'seller/Admin/dealerUsers/$1';

$route[CommonConstants::SELLER_URL_SLUG . '/send-forgot-pass-mail'] = 'seller/AdminLogin/sendResetPassMail';
$route[CommonConstants::SELLER_URL_SLUG . '/getstatusbyorder'] = 'seller/AdminOrderManagement/getStatusByOrder';
$route[CommonConstants::SELLER_URL_SLUG . '/send-forgot-pass-mail'] = 'seller/AdminLogin/sendResetPassMail';
$route[CommonConstants::SELLER_URL_SLUG . '/resetpassword'] = 'seller/AdminLogin/resetPassword';

/*----------Seller Routes End----------*/

$route['change-status-pdf/(:any)/(:num)'] = 'site/Checkout/changestatusPdf/$1/$2';
/*----------FrontEnd Routes Start----------*/


/*----------- Test Url-----------   */
$route['about'] = 'site/SiteTest/aboutUs';
$route['cart'] = 'site/SiteTest/cart';
$route['checkout'] = 'site/SiteTest/checkOut';
$route['checkout/shipping'] = 'site/Checkout/shipping';
$route['payment-option'] = 'site/Checkout/paymentOption';
$route['pay-now'] = 'site/Checkout/payNow';
$route['billing'] = 'site/SiteTest/billing';
$route['detail/(:any)'] = 'site/SiteTest/detail/$1';
$route['listing'] = 'site/SiteTest/listing';
$route['password'] = 'site/SiteTest/password';
$route['add-to-cart'] = 'site/SiteCart/addToCart';
$route['contact-us'] = 'site/SiteTest/contactUs';
$route['order-confirmation'] = 'site/Checkout/orderPaymentStatus';
$route['become-a-dealer'] = 'site/SiteTest/becomeDealer';
$route['search/(:any)'] = 'site/SiteProduct/searchForProduct/$1';
$route['review'] = 'site/SiteProduct/review';
$route['image-change'] = 'site/SiteProduct/changeThumbImage';
$route['image-change-color'] = 'site/SiteProduct/changeThumbImageColor';

$route['registration'] = 'site/SiteLogin/Registration';
$route['api-registration'] = 'site/SiteLogin/ApiRegistration';
$route['login-account'] = 'site/SiteLogin/login';
$route['logout'] = 'site/SiteLogin/logOut';

$route['user/my-account'] = 'site/User/userProfile';
$route['user/change-password'] = 'site/User/changePassword';
$route['user/my-orders'] = 'site/User/userOrders';
$route['user/edit-profile'] = 'site/User/editProfile';
$route['user/scanning'] = 'site/User/scanning';
$route['user/scanning-list'] = 'site/User/scanning_list';
$route['user/pdf-download/(:num)'] = 'site/User/pdf_download';
$route['user/pdfd/(:num)'] = 'site/User/pdfd';



$route['send-forgot-pass-mail'] = 'site/SiteLogin/sendResetPassMail';
$route['resetpassword'] = 'site/SiteLogin/resetPassword';
$route['product-detail/(:any)'] = 'site/SiteProduct/productDetail/$1';
$route['check-user-login'] = 'site/SiteLogin/loginCheck';
$route['add-to-wishlist'] = 'site/SiteCart/addToWishlist';
$route['add-to-cart'] = 'site/SiteCart/addToCart';
$route['search/(:any)'] = 'site/SiteProduct/searchForProduct/$1/$2';
$route['category/(:any)/(:num)'] = 'site/SiteProduct/productsByCategory/$1';
$route['sub-category/(:any)/(:num)'] = 'site/SiteProduct/productsBySubCategory/$1/$2';
$route['user/my-wishlist'] = 'site/User/userWishlist';
$route['login'] = 'site/SiteLogin/loginPage';
$route['logins/(:any)'] = 'site/SiteLogin/loginsPage/$1';
$route['create-account'] = 'site/SiteLogin/createAccount';
$route['login-with-facebook'] = 'site/SiteLogin/loginWithFacebook';
$route['filter-products'] = 'site/SiteProduct/productByFilter';

$route['getState'] = 'common/Common/findState';
$route['getCity'] = 'common/Common/findCity';

/*-----------------Payment Routes-----------------------------*/

/*-----------------ccAvenue-----------------------------*/
$route['ccAvenue'] = 'site/Checkout/ccAvenue';
$route['paytm'] = 'site/Checkout/paytm';
$route['order-success'] = 'site/Checkout/orderSuccessCC';
$route['payment-cancelled'] = 'site/Checkout/paymentCancelled';
/*-----------------COD-----------------------------*/
$route['cod-payment'] = 'site/Checkout/codPayment';

/*-----------------Paypal-----------------------------*/
$route['paypal-payment'] = 'site/Checkout/paypalPayment';
$route['paypal-pay'] = 'site/Checkout/paypalPay/';

$route['payment-failed'] = 'site/Checkout/paymentFailed';

/*-----------------PayU-----------------------------*/
$route['payU-payment'] = 'site/Checkout/payUPayment';
$route['payUPaymentResponse'] = 'site/Checkout/payUResponse';


/*-----------------pages-----------------------------*/
$route['foot-health'] = 'site/SitePage/footHealth';
$route['shoe-essentials'] = 'site/SitePage/shoeEssential';
$route['anti-bacterial-socks'] = 'site/SitePage/antiBacterialSocks';
$route['foot-size-guide'] = 'site/SitePage/footSizeGuide';

$route['scanning-locator'] = 'site/SitePage/scanningLocator';
$route['our-doctors'] = 'site/SitePage/ourDoctors';
$route['search-doctors'] = 'site/SitePage/searchourDoctors';
$route['scanner-technology'] = 'site/SitePage/scannerTechnology';
$route['how-to-purchase'] = 'site/SitePage/howToPurchase';
$route['search-location'] = 'site/SitePage/getLocationsById';

$route['track-your-order'] = 'site/SitePage/trackYourOrder';
$route['warranty'] = 'site/SitePage/warranty';
$route['privacy-policy'] = 'site/SitePage/privacyPolicy';
$route['download-software'] = 'site/SitePage/downloadSoftware';
$route['installation-support'] = 'site/SitePage/installationSupport';
$route['operate-scanner'] = 'site/SitePage/operateScanner';
$route['faq'] = 'site/SitePage/faq';
$route['video'] = 'site/SitePage/videos';
$route['catalogue'] = 'site/SitePage/catalogue';
$route['press-room'] = 'site/SitePage/pressRoom';
$route['blog-detail/(:any)'] = 'site/SitePage/blogDetail/$1';
$route['emailSend'] = 'site/Site/emailSend';
$route['technical-faq'] = 'site/SitePage/technicalFaq';
/*----------FrontEnd Routes End----------*/
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

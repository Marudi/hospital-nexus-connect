<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
|	https://codeigniter.com/user_guide/general/routing.html
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
$route['default_controller'] = 'frontend';
$route['transactionLogs'] = 'logs/transactionLogs';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE; 
$route['site/(?!(?:gallery|gallery/editGalleryByJason|gallery/addNew|gallery/delete|slide|service|gridsection|settings|featured|review|slide/addNew|service/addNew|update|gridsection/addNew|featured/addNew|review/addNew|gallery/delete|slide/delete|service/delete|gridsection/delete|featured/delete|review/delete|getAvailableSlotByDoctorByDateByJason|getDoctorVisitCharges|getAvailableSlotByDoctorByDateByJason|getAvailableSlotByDoctorByDateByJason|getDoctorVisit|addNew|web|slide/editSlideByJason|featured/editFeaturedByJason|service/editServiceByJason|gridsection/editGridsectionByJason|review/editReviewByJason)$)(.+)$'] = 'site/index/(:any)';
//$route['site/(?!(?:gallery/delete|slide/delete|service/delete|gridsection/delete|featured/delete|review/delete)$)(.+)$'] = 'site/index/(:any)'; 
//$route['site/(?!(?:slide|slide/addNew|slide/delete)$)(.+)$']='site/(:any)'; 

// Admin settings routes
$route['admin/settings/themes'] = 'settings/themes/index';
$route['admin/settings/themes/install'] = 'settings/themes/install';
$route['admin/settings/themes/upload'] = 'settings/themes/upload';
$route['admin/settings/themes/customize/(:any)'] = 'settings/themes/customize/$1';
$route['admin/settings/themes/activate/(:any)'] = 'settings/themes/activate/$1';
$route['admin/settings/themes/preview/(:any)'] = 'settings/themes/preview/$1';
$route['admin/settings/themes/save_settings/(:any)'] = 'settings/themes/save_settings/$1';
$route['admin/settings/themes/reset_settings/(:any)'] = 'settings/themes/reset_settings/$1';
$route['admin/settings/themes/delete/(:any)'] = 'settings/themes/delete/$1'; 
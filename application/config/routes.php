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
$route['default_controller'] 	= 'home';

$route['admin'] 				= 'backend/dashboard/auth/login';
$route['logout'] 				= 'backend/dashboard/auth/logout';
#-------------------------------------------------
#     CUSTOMER ROUETS
$route['customer'] 				= 'customer/auth/login';
$route['log_out'] 				= 'customer/auth/logout';
#-------------------------------------------------

#-------------------------------------------------
#     WEBSITE ROUETS
$route['news'] 					= 'home/news';
$route['news/(:any)'] 			= 'home/news/$1';
$route['news/(:any)/(:any)'] 	= 'home/news/$1/$2';

$route['service'] 				= 'home/service';
$route['service/(:any)'] 		= 'home/service/$1';

$route['coin-details'] 			= 'home/price';
$route['coin-details/(:any)'] 	= 'home/price/$1';

$route['coinmarket'] 			= 'home/coinmarket';
$route['coinmarket/(:any)'] 	= 'home/coinmarket/$1';

$route['home'] 					= 'home/home';
$route['exchange'] 				= 'home/exchange';
$route['contact'] 				= 'home/contact';
$route['faq'] 					= 'home/faq';
$route['about'] 				= 'home/about';
$route['sells'] 				= 'home/sells';
$route['buy'] 					= 'home/buy';
$route['lending'] 				= 'home/lending';
$route['pricing'] 				= 'home/lending';
$route['register'] 				= 'home/register';
$route['login'] 				= 'home/login';
$route['resetPassword'] 		= 'home/resetPassword';
$route['paymentform'] 			= 'home/paymentform';
$route['(:any)'] 				= 'home/page';

$route['404_override'] 			= '';
$route['translate_uri_dashes'] 	= FALSE;
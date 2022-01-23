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
$route['default_controller'] = 'home';
$route['blog/(:any)'] = 'public/blog';
$route['blog'] = 'public/blog';
$route['login'] = 'auth';
$route['blog/tags/(:any)'] = 'public/blog/tags/$1';
$route['blog/categories/(:any)'] = 'public/blog/categories/$1';
$route['blog/detail/(:any)/(:any)'] = 'public/blog/detail/$1/$2';
$route['blog/detail/(:any)/(:any)/(:any)'] = 'public/blog/detail/$1/$2/$3';

$route['sejarah'] = 'public/pages/history';
$route['visi-misi'] = 'public/pages/visi';

$route['galeri'] = 'public/pages/galeri';

$route['registrasi'] = 'public/registrasi';
$route['lupa-password'] = 'public/registrasi/lupa_password';
$route['reset-password/(:any)'] = 'public/registrasi/reset_password/$1';
$route['404_override'] = 'my404';

// admin route
$route['user'] = 'user/user';
$route['user/add_user'] = 'user/user/add_user';
$route['user/edit_user/(:any)'] = 'user/user/edit_user/$1';
$route['user/delete_process/(:any)'] = 'user/user/delete_process/$1';
$route['translate_uri_dashes'] = FALSE;

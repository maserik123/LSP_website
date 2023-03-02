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
$route['default_controller'] = 'dashboard';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['registration'] = 'auth/registrasi';
$route['auth'] = 'auth';
$route['pintu_masuk'] = 'auth';
$route['auth/logout'] = 'auth/logout';
$route['auth/force_logout'] = 'auth/force_logout';
$route['data_diri'] = 'asesi/dataDiri';
$route['apl_01'] = 'asesi/apl_01';
$route['apl_02'] = 'asesi/apl_02_finish';
$route['asesmenMandiri'] = 'asesi/apl_02';
$route['jadwal'] = 'asesi/jadwal';
$route['daftar%20skema'] = 'asesi/skema';
$route['skema%20saya'] = 'asesi/skema_saya';
$route['home'] = 'asesi';
$route['forgotPassword'] = 'auth/forgotPassword';

// Untuk Routes Asesor
$route['Halaman%20Home'] = 'asesor';

// untuk Routes Administrator 
$route['beranda'] = 'administrator';
$route['asesi_confirmation'] = 'administrator/konfirmasi_apl01';
$route['unit_kompetensi'] = 'administrator/unit_kompetensi';
$route['unit_elemen'] = 'administrator/unit_elemen';
$route['unit_pertanyaan'] = 'administrator/unit_pertanyaan';
$route['skema'] = 'administrator/skema';

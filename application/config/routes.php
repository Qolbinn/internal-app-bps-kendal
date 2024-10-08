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
|	https://codeigniter.com/userguide3/general/routing.html
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

$route['kegiatan/distribusi'] = 'kegiatan/index/distribusi';
$route['kegiatan/sosial'] = 'kegiatan/index/sosial';
$route['kegiatan/ipds'] = 'kegiatan/index/ipds';
$route['kegiatan/neraca'] = 'kegiatan/index/neraca';
$route['kegiatan/tata-usaha'] = 'kegiatan/index/tata-usaha';
$route['kegiatan/produksi'] = 'kegiatan/index/produksi';

// $route['kegiatan/distribusi/(:any)'] = 'kegiatan/index/distribusi/$1';
// $route['kegiatan/sosial/(:any)'] = 'kegiatan/index/sosial/$1';
// $route['kegiatan/ipds/(:any)'] = 'kegiatan/index/ipds/$1';
// $route['kegiatan/neraca/(:any)'] = 'kegiatan/index/neraca/$1';
// $route['kegiatan/tata-usaha/(:any)'] = 'kegiatan/index/tata-usaha/$1';
// $route['kegiatan/produksi/(:any)'] = 'kegiatan/index/produksi/$1';

$route['tambah_anggota_tim/(:any)'] = 'TimController/tambah_anggota/$1';
$route['hapus_anggota_tim/(:any)'] = 'TimController/delete_anggota/$1';
$route['proyek/tambah/(:any)'] = 'ProyekController/tambah_proyek/$1';
$route['proyek/show/(:any)'] = 'ProyekController/get_data_proyek_by_id/$1';
$route['proyek/hapus/(:any)'] = 'ProyekController/delete_proyek/$1';
$route['kegiatan_proyek/tambah/(:any)'] = 'KegiatanController/tambah_kegiatan/$1';
$route['kegiatan_proyek/hapus/(:any)'] = 'KegiatanController/delete_kegiatan/$1';
$route['pekerjaan/tambah/(:any)'] = 'PekerjaanController/tambah_pekerjaan/$1';
$route['pekerjaan/hapus/(:any)'] = 'PekerjaanController/delete_pekerjaan/$1';
$route['pekerjaan/approve/(:any)'] = 'PekerjaanController/approve_pekerjaan/$1';
$route['pekerjaan/edit/(:any)'] = 'PekerjaanController/edit_pekerjaan/$1';

// $route['proyek/neraca/selected'] = 'kegiatan/index/neraca';
// $route['kegiatan/neraca/selected/(:any)'] = 'kegiatan/index/neraca/$1';

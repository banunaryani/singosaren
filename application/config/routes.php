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
$route['404_override'] = '';
$route['translate_uri_dashes'] = true;
$route['admin/berita'] = 'Berita_Admin';

// LAYANAN
$route['admin/layanan'] = 'Layanan_Admin';
$route['admin/layanan/(:any)'] = 'Layanan_Admin/$1';
$route['admin/layanan/(:any)/(:any)'] = 'Layanan_Admin/$1/$2';
$route['admin/layanan/(:any)/(:any)/(:any)'] = 'Layanan_Admin/$1/$2/$3';

// PROFIL
$route['admin/profil'] = 'Profil_Admin';
$route['admin/profil/(:any)'] = 'Profil_Admin/$1';
$route['admin/profil/(:any)/(:any)'] = 'Profil_Admin/$1/$2';

//BERANDA
$route['layanan'] = 'home/layanan';
$route['layanan/(:any)'] = 'home/detail_layanan/$1';
$route['berita'] = 'home/berita';
$route['berita/(:any)'] = 'home/detail_berita/$1';
$route['potensi'] = 'home/potensi';
$route['potensi/(:any)'] = 'home/detail_potensi/$1';
$route['profil'] = 'home/profil';

// BERITA
$route['admin/berita'] = 'Berita_Admin';
$route['admin/berita/(:any)'] = 'Berita_Admin/$1';
$route['admin/berita/(:any)/(:any)'] = 'Berita_Admin/$1/$2';
$route['admin/berita/(:any)/(:any)/(:any)'] = 'Berita_Admin/$1/$2/$3';

// POTENSI
$route['admin/potensi'] = 'Potensi_Admin';
$route['admin/potensi/(:any)'] = 'Potensi_Admin/$1';
$route['admin/potensi/(:any)/(:any)'] = 'Potensi_Admin/$1/$2';

// PRANALA
$route['admin/pranala'] = 'Pranala_Admin';
$route['admin/pranala/(:any)'] = 'Pranala_Admin/$1';
$route['admin/pranala/(:any)/(:any)'] = 'Pranala_Admin/$1/$2';

// NAVBAR
$route['admin/navbar'] = 'Navbar_Admin';
$route['admin/navbar/(:any)'] = 'Navbar_Admin/$1';
$route['admin/navbar/(:any)/(:any)'] = 'Navbar_Admin/$1/$2';
$route['admin/navbar/(:any)/(:any)/(:any)'] = 'Navbar_Admin/$1/$2/$3';
$route['admin/navbar/(:any)/(:any)/(:any)/(:any)'] = 'Navbar_Admin/$1/$2/$3/$4';

// kontak
$route['admin/kontak'] = 'user/kontak';

// peta
$route['admin/peta'] = 'Peta_Admin';
$route['admin/peta/(:any)'] = 'Peta_Admin/$1';
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = TRUE;

$route['cap'] = 'home/cap';

$route['articles/index'] = 'articles/index';
$route['articles/(:num)'] = 'articles/index/$2';
$route['articles/(:any)'] = 'articles/view/$2';

$route['packages/index'] = 'packages/index';
$route['packages/(:num)'] = 'packages/index/$2';
$route['packages/(:any)'] = 'packages/view/$2';

$route['shop/index'] = 'shop/index';
/*$route['shop/(:num)'] = 'shop/index/$2';
$route['shop/(:any)'] = 'shop/view/$2';*/
$route['shop/(:num)'] = 'shop/index/$3';
$route['shop/(:any)'] = 'shop/category/$2';
$route['shop/(:any)/(:num)'] = 'shop/category/$2/$3';
$route['shop/(:any)/(:any)'] = 'shop/view/$3';

$route['news/index'] = 'news/index';
$route['news/(:num)'] = 'news/index/$3';
$route['news/(:any)'] = 'news/view/$2';

$route['reviews/ajaxSend'] = 'reviews/ajaxSend';
$route['reviews/index'] = 'reviews/index';
$route['reviews/(:num)'] = 'reviews/index/$2';

/* 404 */

$route['404_override'] = IS_ADMIN_PAGE ? 'home/errors':'errors/index';

/* extra */

include(APPPATH.'config/routes_pages.php');
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* products routes */
$route['default_controller'] = 'users';
$route['register'] = 'users/register';
$route['login'] = 'users/login';
$route['logoff'] = 'users/logoff';
$route['dashboard'] = 'products/index';
$route['products/show/(:num)'] = 'products/show/$1';

/* default routes in CI */
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
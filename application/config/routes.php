<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Routes untuk halaman utama
$route[''] = 'home/index';
$route['about'] = 'home/about';
$route['faq'] = 'home/faq';
$route['pneumonia-info'] = 'home/pneumonia_info';

// Routes untuk prediksi
$route['predict'] = 'predict/index';
$route['predict/upload'] = 'predict/upload';
$route['predict/result'] = 'predict/result'; 
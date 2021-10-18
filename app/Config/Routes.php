<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}

$routes->post('/auth/api-register', 'Home::api_register');
$routes->post('/auth/api-login', 'Home::api_login');
$routes->get('/auth/login', 'Home::login');
$routes->get('/auth/register', 'Home::register');
$routes->get('/auth/logout', 'Home::logout');
$routes->get('/auth/verify-email', 'Home::verify_email');

$routes->post('/payments/api-reg-payment-by-transfer', 'Payments::api_reg_payment_by_transfer');

$routes->get('/investor/profile', 'Investors::profile');
$routes->post('/investor/api-complete-profile', 'Investors::api_complete_profile');
$routes->post('/investor/api-update-profile', 'Investors::api_update_profile');
$routes->post('/investor/api-update-nok', 'Investors::api_update_nok');
$routes->post('/investor/api-update-bank-details', 'Investors::api_update_bank_details');
$routes->get('/investor/api-get-profile', 'Investors::api_get_profile');
$routes->get('/investor/api-get-bank-detail', 'Investors::api_get_bank_detail');
$routes->get('/investor/api-get-nok', 'Investors::api_get_nok');
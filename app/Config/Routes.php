<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
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
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// Filter on single route

$routes->get('/login', 'Auth::login');
$routes->get('/forget', 'Auth::forget');


$routes->get('/', 'Home::index', ["filter" => "LoginFilter"]);
$routes->get('/user', 'User::index');
$routes->get('/menu', 'Menu::index');

// authentication
$routes->post('/login', 'Auth::login');
$routes->get('/logout', 'Auth::logout');
$routes->get('/profil', 'Auth::profil', ["filter" => "LoginFilter"]);

//contoh routes utama
$routes->post('/user/getall', 'User::getAll');
$routes->post('/user/getone', 'User::getone');
$routes->post('/user/remove', 'User::remove');
$routes->post('/user/edit', 'User::edit');
$routes->post('/user/add', 'User::add');

//---- menu
$routes->post('/menu/getall', 'Menu::getAll');
$routes->post('/menu/getone', 'Menu::getone');
$routes->post('/menu/remove', 'Menu::remove');
$routes->post('/menu/edit', 'Menu::edit');
$routes->post('/menu/add', 'Menu::add');




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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}

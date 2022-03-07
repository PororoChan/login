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
$routes->get('/login', 'Login::login');
$routes->get('/valid', 'Register::save');
$routes->get('/register', 'Register::register');

//home
$routes->get('/siswa/adv', 'Login::adv');
$routes->get('/siswa', 'Login::siswa');
$routes->get('/kelas', 'Kelas::index');
$routes->get('/home', 'Login::dashboard', ['filter' => 'auth']);

//crud-siswa
$routes->post('/siswa/add', 'Siswa::addSiswa');
$routes->get('/siswa/edit', 'Siswa::edit');
$routes->post('/siswa/update', 'Siswa::update');
$routes->delete('/siswa/delete', 'Siswa::delete');

//crud-kelas
$routes->post('/kelas/add', 'Kelas::add');
$routes->get('/kelas/edit', 'Kelas::edit');
$routes->post('/kelas/update', 'Kelas::update');
$routes->delete('/kelas/delete', 'Kelas::delete');

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

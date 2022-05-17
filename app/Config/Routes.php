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
$routes->setDefaultController('Login');
$routes->setDefaultMethod('login');
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

//load_data
// $routes->get('/loadsis', 'Dtsiswa::load');

//Login & Register
$routes->get('/login', 'Login::login');
$routes->add('/valid', 'Register::save');
$routes->get('/register', 'Register::register');

//index-page-per-controller
$routes->get('/home', 'Login::dashboard', ['filter' => 'auth']);
$routes->get('/kelas', 'Kelas::index', ['filter' => 'auth']);
$routes->get('/siswa', 'Login::siswa', ['filter' => 'auth']);
$routes->get('/dtsiswa', 'Dtsiswa::show', ['filter' => 'auth']);
$routes->add('/users', 'Users::show', ['filter' => 'auth']);
$routes->get('/files', 'Files::index', ['filter' => 'auth']);

//crud-siswa
$routes->add('/siswa/add', 'Siswa::addSiswa');
$routes->add('/siswa/edit', 'Siswa::edit');
$routes->add('/siswa/update', 'Siswa::update');
$routes->add('/siswa/delete', 'Siswa::delete');

//crud-kelas
$routes->add('/kelas/add', 'Kelas::add');
$routes->add('/kelas/edit', 'Kelas::edit');
$routes->add('/kelas/update', 'Kelas::update');
$routes->add('/kelas/delete', 'Kelas::delete');

//crud-siswa-adv
$routes->get('/dtsiswa/details', 'Dtsiswa::detail');
$routes->get('/dtsiswa/view', 'Dtsiswa::view');
$routes->add('/dtsiswa/add', 'Dtsiswa::add');
$routes->add('/dtsiswa/edit', 'Dtsiswa::edit');
$routes->add('/dtsiswa/update', 'Dtsiswa::update');
$routes->add('/dtsiswa/delete', 'Dtsiswa::delete');
$routes->add('/dtsiswa/excel', 'Dtsiswa::excel');
$routes->add('/dtsiswa/pdf', 'Dtsiswa::pdf');

//crud-users
$routes->get('/users/data', 'Users::data');
$routes->add('/users/update', 'Users::update');
$routes->add('/users/delete', 'Users::delete');

//crud-files
$routes->add('/files/add', 'Files::save');
$routes->add('/files/update', 'Files::updateFile');
$routes->add('/files/delete', 'Files::delete');

// table
$routes->add('/tbfile', 'Files::table');

// pdf
$routes->add('/files/print', 'Pdf::genPDF');
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

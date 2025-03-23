<?php

namespace Config;




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

//weapon routes
$routes->get('/weaponform', 'WeaponController::weaponform');
$routes->post('/WeaponController/SaveWeaponForm', 'WeaponController::SaveWeaponForm');
$routes->get('/WeaponController/showweapon', 'WeaponController::show');
$routes->get('/WeaponController/issueweapon', 'WeaponController::issueweapon');
$routes->get('/WeaponController/weaponoptions','WeaponController::weaponoptions');
$routes->get('wif',function(){
    return view('WeaponIssueForm');
});

//home page
$routes->get('home', function() {
    return view('index');
});

$routes->get('dashboard', 'DashboardController::index');

//issue weapon form
$routes->get('iw', function() {
    return view('IssueWeaponForm');
});

//for bullets
$routes->get('/bulletform', 'BulletsController::bulletForm');
$routes->post('/BulletsController/insert', 'BulletsController::insert');
$routes->get('/showBullets', 'BulletsController::viewBullets');



//for ajax
$routes->post('weapon/search', 'WeaponController::search');
$routes->post('BulletsController/search', 'BulletsController::search');



//for login redirect
$routes->get('login', 'LoginController::index');
//for login authentication
$routes->post('get/login', 'AuthController::login');


//for logout
$routes->get('logout', 'AuthController::logout');

//for employee
$routes->get('/employeeform', 'EmployeeController::employeeform');
$routes->post('/EmployeeController/SaveEmployeeForm', 'EmployeeController::SaveEmployeeForm');
$routes->get('/showemployee', 'EmployeeController::show');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need to override any defaults in this file. Environment based routes
 * are one such time. require() additional route files here to make
 * that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
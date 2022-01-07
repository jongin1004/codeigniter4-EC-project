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
$routes->get('/', 'MainPageController::index', ['as' => 'mainPage']);

// meeting post
$routes->group('meeting', function ($routes)
{
    $routes->get('new', 'MeetingController::createForm', ['filter' => 'auth']);
    $routes->post('new', 'MeetingController::create', ['filter' => 'auth']);
    $routes->get('(:num)', 'MeetingController::showDetail/$1');
    $routes->get('(:num)/modify', 'MeetingController::modifyForm/$1', ['filter' => 'isOwnUser']);
    $routes->post('(:num)/modify', 'MeetingController::modify/$1', ['filter' => 'isOwnUser']);
    $routes->get('(:num)/delete', 'MeetingController::delete/$1', ['filter' => 'isOwnUser']);
});

// sale post
$routes->group('sale', function ($routes)
{
    $routes->get('new', 'SaleController::createForm', ['filter' => 'auth']);
    $routes->post('new', 'SaleController::create', ['filter' => 'auth']);
    $routes->get('(:num)', 'SaleController::showDetail/$1');
    $routes->get('(:num)/modify', 'SaleController::modifyForm/$1', ['filter' => 'isOwnUser']);
    $routes->post('(:num)/modify', 'SaleController::modify/$1');
    $routes->get('(:num)/delete', 'SaleController::delete/$1');
});


// login/register 관련 
$routes->get('login', 'AuthController::index');
$routes->post('login', 'AuthController::authentication');
$routes->get('register', 'RegisterController::index');
$routes->post('register', 'RegisterController::register');
$routes->get('logout', 'AuthController::logout');

// ajax
// get More data of meeting_post 
$routes->post('fetch/meeting', 'FetchController::getMoreMeeting');
// get More data of sale_post 
$routes->post('fetch/sale', 'FetchController::getMoreSale');
// save comment
$routes->post('fetch/comment', 'FetchController::saveComment');
// crop image
$routes->post('fetch/cropImage', 'CropImageUpload::store');

// comment
$routes->post('comment', 'CommentController::save', ['filter' => 'auth']);

// dashboard
$routes->get('dashboard', 'DashboardController::index', ['filter' => 'auth']);

// avatar
$routes->get('avatar', 'DashboardController::avatar', ['filter' => 'auth']);

// shopping-cart
$routes->get('shoppingCart/(:num)', 'ShoppingCartController::addItem/$1', ['filter' => 'auth']);

// chating
$routes->get('chat/(:num)', 'ChatController::index/$1', ['filter' => 'auth']);
$routes->post('fetch/chat', 'ChatController::saveChat', ['filter' => 'auth']);


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


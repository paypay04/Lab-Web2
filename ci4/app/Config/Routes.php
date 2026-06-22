<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ========== ROUTE DEPAN ==========
$routes->get('/', 'Home::index');
$routes->get('/about', 'Page::about');
$routes->get('/contact', 'Page::contact');
$routes->get('/faqs', 'Page::faqs');

// ========== ROUTE ARTIKEL PUBLIC ==========
$routes->get('/artikel', 'Artikel::index');
$routes->get('/artikel/(:any)', 'Artikel::view/$1');

// ========== ROUTE LOGIN ==========
$routes->get('/user/login', 'User::login');
$routes->post('/user/login', 'User::proses_login');
$routes->get('/user/logout', 'User::logout');

$routes->get('/ajax', 'AjaxController::index');
$routes->get(
    '/ajax/getData',
    'AjaxController::getData'
);
$routes->delete(
    '/ajax/delete/(:num)',
    'AjaxController::delete/$1'
);
$routes->post(
    'ajax/save',
    'AjaxController::save'
);
$routes->post(
    'ajax/update/(:num)',
    'AjaxController::update/$1'
);
$routes->post('ajax/add', 'AjaxController::add');

$routes->group("admin", ["filter" => "auth"], function ($routes) {
    // Daftar artikel
    $routes->get("artikel", "Artikel::admin_index");

    // Tambah artikel (GET untuk form, POST untuk simpan)
    $routes->get("artikel/add", "Artikel::add");
    $routes->post("artikel/add", "Artikel::add");

    // Edit artikel (GET untuk form, POST untuk update)
    $routes->get("artikel/edit/(:num)", 'Artikel::edit/$1');
    $routes->post("artikel/update/(:num)", 'Artikel::update/$1');

    // Hapus artikel
    $routes->get("artikel/delete/(:num)", 'Artikel::delete/$1');
});

// $routes->get('/admin/index', 'User::admin_index');
// $routes->get('/admin/artikel', 'Artikel::admin_index');
// $routes->get('/admin/artikel/add', 'Artikel::add');
// $routes->post('/admin/artikel/save', 'Artikel::save');
// $routes->get('/admin/artikel/edit/(:any)', 'Artikel::edit/$1');
// $routes->post('/admin/artikel/update/(:any)', 'Artikel::update/$1');
// $routes->get('/admin/artikel/delete/(:any)', 'Artikel::delete/$1');


$routes->setAutoRoute(true);

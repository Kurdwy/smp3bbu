<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'UserController::index');

$routes->get('/users', 'UserController::index');
$routes->post('/users/store', 'UserController::store'); // Menambahkan guru
$routes->get('/users/get/(:num)', 'UserController::getGuru/$1'); // Ambil data guru berdasarkan ID
$routes->post('/users/update/(:num)', 'UserController::update/$1'); // Update data guru
$routes->post('/users/delete/(:num)', 'UserController::delete/$1'); // Hapus guru


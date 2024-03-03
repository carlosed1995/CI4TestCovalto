<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */ 

$routes->get('/', 'Marvel::index');
$routes->resource('marvel', ['placeholder' => '(:num)', 'except' => 'show']);
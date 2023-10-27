<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->group('api', function($routes){
    $routes->post("login", "Auth::index");

	$routes->get('category', 'Category::show');
    $routes->get('category/(:segment)', 'Category::find/$1');
    
    $routes->post('category/add', 'Category::create');
	$routes->post('category/edit/(:segment)', 'Category::update/$1');
	$routes->get('category/delete/(:segment)', 'Category::delete/$1');

    $routes->get('writer', 'Writer::show');
    $routes->get('writer/(:segment)', 'Writer::find/$1');
    $routes->post('writer/add', 'Writer::create');
	$routes->post('writer/edit/(:segment)', 'Writer::update/$1');
	$routes->get('writer/delete/(:segment)', 'Writer::delete/$1');

    $routes->get('artikel', 'Artikel::show');
    $routes->get('artikel/(:segment)', 'Artikel::find/$1');
    $routes->get('artikel/read/(:segment)', 'Artikel::findSlug/$1');
    $routes->post('artikel/add', 'Artikel::create');
	$routes->post('artikel/edit/(:segment)', 'Artikel::update/$1');
	$routes->get('artikel/delete/(:segment)', 'Artikel::delete/$1');
});

<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'frontend\Home::index');

$routes->group('denah', function ($routes) {
    $routes->get('/', 'frontend\Denah::index');

    $routes->group('toko', function ($routes) {
        $routes->get('produk/(:any)', 'frontend\Denah::detailProduk/$1');
        $routes->get('(:any)', 'frontend\Denah::detailToko/$1');
    });
});

$routes->group('post', function ($routes) {
    $routes->get('(:any)', 'frontend\Post::detail/$1');
});

$routes->group('gallery', function ($routes) {
    $routes->get('/', 'frontend\Gallery::index');
});

$routes->group('toko', function ($routes) {

    $filter = ['filter' => 'tokoAuth'];

    $routes->group('auth', function ($routes) {
        $routes->get('login', 'frontend\toko\TokoAuth::login');
        $routes->get('register', 'frontend\toko\TokoAuth::register');
        $routes->post('authenticate', 'frontend\toko\TokoAuth::authenticate');
        $routes->post('submit-register', 'frontend\toko\TokoAuth::submitRegister');
        $routes->get('success-register', 'frontend\toko\TokoAuth::successRegister');
        $routes->get('confirm-email/(:any)', 'frontend\toko\TokoAuth::confirmEmail/$1');
    });

    $routes->get('home', 'frontend\toko\Home::index', $filter);
    $routes->get('edit-profile', 'frontend\toko\Profile::editProfile', $filter);
    $routes->put('update-profile', 'frontend\toko\Profile::updateProfile', $filter);
    $routes->get('input-more-info', 'frontend\toko\Profile::addMoreInfo', $filter);
    $routes->put('submit-more-info', 'frontend\toko\Profile::submitMoreInfo', $filter);
    $routes->group('product', $filter , function ($routes) {

        
        $routes->get('add-product', 'frontend\toko\Product::addProduct');
        $routes->post('insert-product', 'frontend\toko\Product::insertProduct');
        $routes->post('upload-temp-files', 'frontend\toko\Product::uploadTempFiles');

        $routes->get('(:any)', 'frontend\toko\Product::detailProduct/$1');
    });
});

$routes->group('admin', function ($route) {
    $route->get('/', 'backend\Dashboard::index');

    $route->group('dashboard', function ($routes) {
        $routes->get('/', 'backend\Dashboard::index');
    });
    $route->group('posts', function ($routes) {
        $routes->get('/', 'backend\Posts::index');

        $routes->get('new-post', 'backend\Posts::formInsert');
        $routes->post('insert', 'backend\Posts::insert');

        $routes->get('update-post/(:any)', 'backend\Posts::formUpdate/$1');
        $routes->put('update', 'backend\Posts::update');

        $routes->delete('delete-post/(:any)', 'backend\Posts::delete/$1');
    });
});

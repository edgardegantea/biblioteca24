<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


$routes->get('/', 'Home::index');
$routes->get('/login', 'AuthController::login');
$routes->post('/login', 'AuthController::authenticate');
$routes->get('/logout', 'AuthController::logout');
$routes->get('/reset-password', 'PasswordController::requestReset');
$routes->post('/reset-password', 'PasswordController::sendResetLink');
$routes->get('/reset-password/(:any)', 'PasswordController::resetPassword/$1');
$routes->post('/reset-password/update', 'PasswordController::updatePassword');
$routes->get('/errors/access_denied', 'ErrorsController::accessDenied');


$routes->get('/complete-profile', 'ProfileController::completeProfile');
$routes->post('/update-profile', 'ProfileController::updateProfile');

$routes->get('registro', 'UserController::register');
$routes->post('storeRegister', 'UserController::storeRegister');


$routes->get('reglamento', 'Home::reglamento');
$routes->get('acercade', 'Home::acercade');
$routes->get('servicios', 'Home::servicios');


$routes->get('/resultados-busqueda', 'ArchivoController::mostrarResultados');
$routes->get('/archivos/visualizar/(:num)', 'ArchivoController::visualizar2/$1');



$routes->group('admin', ['filter' => ['auth', 'role:admin'], 'namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/', 'Admin\AdminController::index');


    $routes->resource('editoriales', ['controller' => 'Editoriales']);
    $routes->resource('autores', ['controller' => 'Autores']);
    $routes->resource('generos', ['controller' => 'Generos']);

    $routes->resource('publicaciones', ['controller' => 'PublicacionesController']);
    $routes->get('/descarga/(:num)', 'ArchivoController::descargar/$1');
    $routes->get('archivos/visualizar/(:num)', 'ArchivoController::visualizar/$1');




    $routes->get('prestamos', 'Prestamos::index');
    $routes->get('prestamos/crear', 'Prestamos::crear');
    $routes->post('prestamos/guardar', 'Prestamos::guardar');
    $routes->get('prestamos/editar/(:num)', 'Prestamos::editar/$1');
    $routes->post('prestamos/actualizar/(:num)', 'Prestamos::actualizar/$1');
    $routes->get('prestamos/eliminar/(:num)', 'Prestamos::eliminar/$1');
    $routes->get('prestamos/ver/(:num)', 'Prestamos::ver/$1');



    $routes->group('recursos', function($routes) {
        $routes->get('/', 'Recursos::index');
        $routes->get('show/(:num)', 'Recursos::show/$1');
        $routes->get('create', 'Recursos::create');
        $routes->post('store', 'Recursos::store');
        $routes->get('edit/(:num)', 'Recursos::edit/$1');
        $routes->post('update/(:num)', 'Recursos::update/$1');
        $routes->delete('delete/(:num)', 'Recursos::delete/$1');
    });


    $routes->get('recursos/step1', 'Recursos::step1_autores');
    $routes->post('recursos/step1', 'Recursos::processStep1');
    $routes->get('recursos/step2', 'Recursos::step2_categoria');
    $routes->post('recursos/step2', 'Recursos::processStep2');
    $routes->get('recursos/step3', 'Recursos::step3_tag');
    $routes->post('recursos/step3', 'Recursos::processStep3');
    $routes->get('recursos/step4', 'Recursos::step4_editorial');
    $routes->post('recursos/step4', 'Recursos::processStep4');
    $routes->get('recursos/step5', 'Recursos::step5_recurso');
    $routes->post('recursos/step5', 'Recursos::store');


    $routes->group('carousel', function ($routes) {
        $routes->get('/', 'CarouselController::index');
        $routes->get('create', 'CarouselController::create');
        $routes->post('store', 'CarouselController::store');
        $routes->get('edit/(:num)', 'CarouselController::edit/$1');
        $routes->put('update/(:num)', 'CarouselController::update/$1');
        $routes->get('delete/(:num)', 'CarouselController::delete/$1');
    });


    $routes->group('usuarios', function ($routes) {
        $routes->get('/', 'UserController::index');
        $routes->get('create', 'UserController::create');
        $routes->post('store', 'UserController::store');
        $routes->get('show/(:num)', 'UserController::show/$1');
        $routes->get('edit/(:num)', 'UserController::edit/$1');
        $routes->post('update/(:num)', 'UserController::update/$1');
        // $routes->post('/', 'UserController::update/$1');
        $routes->delete('delete/(:num)', 'UserController::delete/$1');
    });




    $routes->group('archivos', ['namespace' => 'App\Controllers'], function ($routes) {
        $routes->get('/', 'ArchivoController::index');
        $routes->get('create', 'ArchivoController::create');
        $routes->post('store', 'ArchivoController::store');
        $routes->get('show/(:num)', 'ArchivoController::show/$1');
        $routes->get('edit/(:num)', 'ArchivoController::edit/$1');
        $routes->post('update/(:num)', 'ArchivoController::update/$1');
        $routes->get('delete/(:num)', 'ArchivoController::delete/$1');
        $routes->get('descargar/(:num)', 'ArchivoController::descargar/$1');
        $routes->get('visualizar/(:num)', 'ArchivoController::visualizar/$1');
    });

});


$routes->group('docente', ['filter' => ['auth', 'role:docente']], function ($routes) {
    $routes->get('/', 'Docente\DocenteController::index');
    $routes->get('x', 'Docente\DocenteController::x');
});


$routes->group('estudiante', ['filter' => ['auth', 'role:usuario'], 'namespace' => 'App\Controllers\Estudiante'], function ($routes) {
    $routes->get('/', 'UsuarioController::index');
});






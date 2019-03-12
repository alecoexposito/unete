<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('foo', function () {
    return 'Hello World';
});

$router->group(['prefix' => 'auth'], function() use ($router) {
    $router->post('login', 'AuthController@login');
    $router->post('register', 'AuthController@register');
});


/**
 * Routes for resource business-category
 */

$router->group(['middleware' => 'auth:api'], function($router) {
    $router->post('business/has-changed', 'BusinessController@hasChanged');
    $router->get('business', 'BusinessController@all');
    $router->get('business/{id}', 'BusinessController@get');
    $router->post('business', 'BusinessController@add');
    $router->put('business/{id}', 'BusinessController@put');
    $router->delete('business/{id}', 'BusinessController@remove');

    $router->get('business-category', 'BusinessCategoryController@all');
    $router->get('business-category/{id}', 'BusinessCategoryController@get');
    $router->post('business-category', 'BusinessCategoryController@add');
    $router->put('business-category/{id}', 'BusinessCategoryController@put');
    $router->delete('business-category/{id}', 'BusinessCategoryController@remove');

    $router->get('client', 'ClientController@all');
    $router->get('client/{id}', 'ClientController@get');
    $router->post('client', 'ClientController@add');
    $router->put('client/{id}', 'ClientController@put');
    $router->delete('client/{id}', 'ClientController@remove');


});

$router->get('business-account', 'BusinessAccountController@all');
$router->get('business-account/{id}', 'BusinessAccountController@get');
$router->post('business-account', 'BusinessAccountController@add');
$router->put('business-account/{id}', 'BusinessAccountController@put');
$router->delete('business-account/{id}', 'BusinessAccountController@remove');


$router->get('client-account', 'ClientAccountController@all');
$router->get('client-account/{id}', 'ClientAccountController@get');
$router->post('client-account', 'ClientAccountController@add');
$router->put('client-account/{id}', 'ClientAccountController@put');
$router->delete('client-account/{id}', 'ClientAccountController@remove');

$router->get('dependence', 'DependenceController@all');
$router->get('dependence/{id}', 'DependenceController@get');
$router->post('dependence', 'DependenceController@add');
$router->put('dependence/{id}', 'DependenceController@put');
$router->delete('dependence/{id}', 'DependenceController@remove');

$router->get('prod-serv', 'ProdServController@all');
$router->get('prod-serv/{id}', 'ProdServController@get');
$router->post('prod-serv', 'ProdServController@add');
$router->put('prod-serv/{id}', 'ProdServController@put');
$router->delete('prod-serv/{id}', 'ProdServController@remove');

$router->get('transaction', 'TransactionController@all');
$router->get('transaction/{id}', 'TransactionController@get');
$router->post('transaction', 'TransactionController@add');
$router->put('transaction/{id}', 'TransactionController@put');
$router->delete('transaction/{id}', 'TransactionController@remove');

$router->get('user', 'UserController@all');
$router->get('user/{id}', 'UserController@get');
$router->post('user', 'UserController@add');
$router->put('user/{id}', 'UserController@put');
$router->delete('user/{id}', 'UserController@remove');




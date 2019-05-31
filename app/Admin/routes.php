<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('admin.home');
    $router->resource('posts', 'PostController');
    /*j$router->get('/posts','PostController@index')->name('admin.post');
    $router->get('/posts/{id}','PostController@show')->name('admin.postshow');
    $router->get('/posts/create','PostController@create')->name('admin.postsCreate');
    $router->get('/posts/{id}/edit','PostController@edit')->name('admin.postedit');
    $router->PUT('/posts/{id}','PostController@update')->name('admin.postUpdate');
    $router->post('/posts','PostController@store')->name('admin.postStore');
    $router->delete('/posts/{id}','PostController@destroy');
    */
});

<?php

Router::get('/', 'DashboardController@index');

Router::get('/login', 'AuthController@showLogin');
Router::post('/login', 'AuthController@authenticate');

Router::get('/logout', 'AuthController@logout');

Router::get('/users', 'UserController@index');

Router::get('/users', 'UserController@index');
Router::get('/users/create', 'UserController@create');
Router::post('/users/store', 'UserController@store');
Router::get('/users/delete', 'UserController@delete');


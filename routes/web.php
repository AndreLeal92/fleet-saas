<?php

Router::get('/', 'DashboardController@index');

Router::get('/login', 'AuthController@showLogin');
Router::post('/login', 'AuthController@authenticate');

Router::get('/logout', 'AuthController@logout');
<?php

Router::get('/', 'DashboardController@index');

// mostrar tela de login
Router::get('/login', 'AuthController@showLogin');

// processar login
Router::post('/login', 'AuthController@authenticate');

// logout
Router::get('/logout', 'AuthController@logout');

Router::get('/vehicles', 'VehicleController@index');
Router::get('/fuel', 'FuelController@index');
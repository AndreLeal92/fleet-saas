<?php

Router::get('/', 'DashboardController@index');

Router::get('/login', 'AuthController@login');
Router::post('/login', 'AuthController@authenticate');

Router::get('/vehicles', 'VehicleController@index');
Router::get('/fuel', 'FuelController@index');
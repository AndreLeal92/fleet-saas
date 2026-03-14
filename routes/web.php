<?php

// =========================
// DASHBOARD
// =========================
Router::get('/', 'DashboardController@index');


// =========================
// AUTH
// =========================
Router::get('/login', 'AuthController@showLogin');
Router::post('/login', 'AuthController@authenticate');

Router::get('/logout', 'AuthController@logout');

// troca obrigatória de senha
Router::get('/change-password', 'AuthController@showChangePassword');
Router::post('/change-password', 'AuthController@changePassword');


// =========================
// USERS
// =========================
Router::get('/users', 'UserController@index');

Router::get('/users/create', 'UserController@create');
Router::post('/users/store', 'UserController@store');

Router::get('/users/edit', 'UserController@edit');
Router::post('/users/update', 'UserController@update');

Router::get('/users/delete', 'UserController@delete');


// =========================
// VEHICLES
// =========================
Router::get('/vehicles', 'VehicleController@index');
Router::get('/vehicles/create', 'VehicleController@create');
Router::post('/vehicles/store', 'VehicleController@store');
Router::get('/vehicles/edit', 'VehicleController@edit');
Router::post('/vehicles/update', 'VehicleController@update');
Router::get('/vehicles/delete', 'VehicleController@delete');

// =========================
// DRIVERS
// =========================
Router::get('/drivers', 'DriverController@index');
Router::get('/drivers/create', 'DriverController@create');
Router::post('/drivers/store', 'DriverController@store');
Router::get('/drivers/delete', 'DriverController@delete');

// =========================
// FUEL
// =========================
Router::get('/fuel', 'FuelController@index');
Router::get('/fuel/create', 'FuelController@create');
Router::post('/fuel/store', 'FuelController@store');
Router::get('/fuel/delete', 'FuelController@delete');

// =========================
// MAINTENANCE
// =========================
Router::get('/maintenance', 'MaintenanceController@index');
Router::get('/maintenance/create', 'MaintenanceController@create');
Router::post('/maintenance/store', 'MaintenanceController@store');
Router::get('/maintenance/delete', 'MaintenanceController@delete');
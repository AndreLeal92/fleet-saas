<?php

// =========================
// AUTH (rotas públicas)
// =========================
Router::get('/login', 'AuthController@showLogin');
Router::post('/login', 'AuthController@authenticate');

Router::get('/logout', 'AuthController@logout');

Router::get('/change-password', 'AuthController@showChangePassword');
Router::post('/change-password', 'AuthController@changePassword');


// =========================
// DASHBOARD
// =========================
Router::get('/', 'DashboardController@index');


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

// EXPORTAÇÃO DE VEÍCULOS
Router::get('/vehicles/export', 'VehicleController@export');


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


// =========================
// TRIP EXPENSE
// =========================
Router::get('/trip-expenses', 'TripExpenseController@index');
Router::get('/trip-expenses/create', 'TripExpenseController@create');
Router::post('/trip-expenses/store', 'TripExpenseController@store');
Router::get('/trip-expenses/delete', 'TripExpenseController@delete');


// =========================
// TRIPS
// =========================
Router::get('/trips', 'TripController@index');
Router::get('/trips/create', 'TripController@create');
Router::post('/trips/store', 'TripController@store');
Router::get('/trips/edit', 'TripController@edit');
Router::post('/trips/update', 'TripController@update');
Router::get('/trips/delete', 'TripController@delete');


// =========================
// TRIP REPORT
// =========================
Router::get('/trip-report', 'TripController@report');

// =========================
// COMBINATION
// =========================
Router::get('/vehicle-combinations', 'VehicleCombinationController@index');
Router::get('/vehicle-combinations/create', 'VehicleCombinationController@create');
Router::post('/vehicle-combinations/store', 'VehicleCombinationController@store');
Router::get('/vehicle-combinations/detach', 'VehicleCombinationController@detach');
<?php

Router::get('/', 'DashboardController@index');
Router::get('/login', 'AuthController@login');

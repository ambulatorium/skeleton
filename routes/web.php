<?php

Route::get('/', 'WelcomeController@show')->name('welcome');

Route::get('/physical-appointment', 'PhysicalAppointmentController@index')->name('physical-appointment');
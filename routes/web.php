<?php

// home
Route::get('/', 'HomeController@home');
Route::get('/physician', 'HomeController@searchSchedule');

// Authentication default
Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::resource('doctors', 'Doctors\DoctorController');
    Route::resource('polyclinics', 'Polyclinics\PolyclinicController');
    Route::resource('schedules', 'Doctors\ScheduleController');
    Route::resource('patients', 'Patients\PatientController');
    // pending, useless feature.
    // Route::resource('counters', 'Counters\CounterController');

    Route::get('/doctors/appointments/{doctor}', 'Doctors\DoctorController@appointments');

    // appointments
    Route::get('/appointments/today', 'Appointments\AppointmentController@today');
    Route::patch('/appointments/cancel/{appointment}', 'Appointments\AppointmentController@cancelAppointment');
    Route::get('/appointments/cancel', 'Appointments\AppointmentController@cancel');
    Route::resource('appointments', 'Appointments\AppointmentController');

    Route::get('bookings', 'BookingController@appointment');
    
    Route::post('/medical-record', 'MedicalRecords\MedicalRecordController@save');

    // people, patient-owner-admin-nurse
    Route::group(['prefix' => 'people'], function () {
        Route::get('/profile', 'PeopleController@profile');
        Route::patch('/profile/{user}', 'PeopleController@updateProfile');
        Route::get('/appointments', 'PeopleController@appointment');
        Route::get('/medical-record', 'PeopleController@medicalRecord');
        Route::get('/account', 'PeopleController@account');
    });

    // settings
    Route::group(['prefix' => 'settings'], function () {
        Route::get('/', 'Settings\SettingController@website');
        Route::resource('staffs', 'Settings\Staffs\StaffController');
    });

});
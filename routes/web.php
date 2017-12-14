<?php

// home
Route::get('/', 'HomeController@home');
Route::get('/physical-appointment', 'HomeController@searchSchedule');
Route::get('/physical-appointment/{doctor}/{schedule}', 'HomeController@searchDoctor')->where('schedule', '([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))');

// Authentication default
Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::resource('doctors', 'Doctors\DoctorController');
    Route::resource('schedules', 'Doctors\ScheduleController');
    Route::resource('patients', 'Patients\PatientController');
    // pending, useless feature.
    // Route::resource('counters', 'Counters\CounterController');

    Route::get('/physical-appointment/scheduling/{doctor}', 'BookingController@schedulingAppointment');

    Route::get('/doctors/appointments/{doctor}', 'Doctors\DoctorController@appointments');

    // appointments
    Route::get('/appointments/today', 'Appointments\AppointmentController@today');
    Route::patch('/appointments/cancel/{appointment}', 'Appointments\AppointmentController@cancelAppointment');
    Route::get('/appointments/cancel', 'Appointments\AppointmentController@cancel');
    Route::resource('appointments', 'Appointments\AppointmentController');

    Route::post('/medical-record', 'MedicalRecords\MedicalRecordController@save');

    // people. patient,owner,admin,nurse
    Route::group(['prefix' => 'people'], function () {
        Route::get('/', 'PeopleController@profile');
        Route::get('/settings/profile', 'PeopleController@settingProfile');
        Route::patch('/settings/profile/{user}', 'PeopleController@updateProfile');
        Route::get('/settings/account', 'PeopleController@settingAccount');
        Route::patch('/settings/account/{user}', 'PeopleController@updateAccount');
    });

    // settings
    Route::group(['prefix' => 'settings'], function () {
        Route::resource('groups', 'Settings\Group\GroupController');
        Route::resource('specialities', 'Settings\Speciality\SpecialityController');
        Route::resource('staffs', 'Settings\Staffs\StaffController');
    });
});

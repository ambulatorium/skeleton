<?php

// home
Route::get('/', 'HomeController@home');
Route::get('/scheduling/physical-appointment', 'Appointments\PhysicalController@index');

// Authentication default
Auth::routes();

// user invitation
Route::get('/invitations/{token}', 'InvitationController@accept')->middleware('guest')->name('accept');
Route::post('/invitations/{token}', 'InvitationController@join')->middleware('guest')->name('join');

Route::group(['middleware' => 'auth'], function () {

    // scheduling physical appointment
    Route::get('/scheduling/physical-appointment/doctor/{doctor}', 'Appointments\PhysicalController@create');
    Route::post('/scheduling/physical-appointment/doctor/{doctor}', 'Appointments\PhysicalController@store');

    Route::get('/doctors', 'Doctors\DoctorController@index');
    Route::get('/doctors/{doctor}', 'Doctors\DoctorController@show');
    Route::get('/doctors/appointments/{doctor}', 'Doctors\DoctorController@appointments');

    // appointments
    Route::get('/appointments/today', 'Appointments\AppointmentController@today');
    Route::patch('/appointments/cancel/{appointment}', 'Appointments\AppointmentController@cancelAppointment');
    Route::get('/appointments/cancel', 'Appointments\AppointmentController@cancel');
    Route::resource('appointments', 'Appointments\AppointmentController');

    Route::post('/invitations', 'InvitationController@send');
    Route::delete('/invitations/{invitation}', 'InvitationController@destroy');

    // people. patient,owner,administrator,admin-group,doctor,nurse
    Route::group(['prefix' => 'people'], function () {
        Route::get('/', 'PeopleController@profile');
        Route::resource('schedules', 'Doctors\ScheduleController');
        Route::get('/appointment/{appointment}', 'PeopleController@appointment');
        Route::get('/doctor/appointments/', 'Doctors\ScheduleController@appointment');
        Route::get('/doctor/appointments/{appointment}', 'Patients\HealthHistoryController@create');
        Route::post('/doctor/appointments/{appointment}', 'Patients\HealthHistoryController@store');
        Route::get('/health-history', 'Patients\HealthHistoryController@index');
        Route::get('/health-history/{id}', 'Patients\HealthHistoryController@show');
        Route::get('/settings/patient-form', 'Patients\PatientController@index');
        Route::get('/settings/patient-form/create', 'Patients\PatientController@create');
        Route::post('/settings/patient-form', 'Patients\PatientController@store');
        Route::get('/settings/patient-form/{patient}/edit', 'Patients\PatientController@edit');
        Route::patch('/settings/patient-form/{patient}', 'Patients\PatientController@update');
        Route::get('/settings/account', 'PeopleController@settingAccount');
        Route::patch('/settings/account/{user}', 'PeopleController@updateAccount');
        Route::get('/settings/profile/doctor', 'PeopleController@SettingDoctor');
        Route::patch('/settings/profile/doctor/{doctor}', 'PeopleController@updateDoctor');
    });

    // Multiple Health Care Provider
    Route::group(['prefix' => '{group}'], function () {
        Route::get('/', 'Settings\Group\GroupController@show');
        Route::get('/appointments', 'Groups\GroupController@appointment');
        Route::get('/appointments/{appointment}', 'Groups\GroupController@showAppointment');
        Route::patch('/appointments/{appointment}', 'Groups\GroupController@confirmAppointment');
        Route::get('/doctor/{doctor}', 'Doctors\DoctorController@show');
        Route::get('/settings/profile', 'Groups\SettingController@profile');
        Route::get('/settings/staffs', 'Groups\SettingController@staff');
        Route::get('/settings/invitations', 'Groups\SettingController@invitation');
    });

    // site settings
    Route::group(['prefix' => 'settings'], function () {
        Route::get('groups', 'Settings\Group\GroupController@index');
        Route::get('groups/create', 'Settings\Group\GroupController@create');
        Route::post('groups', 'Settings\Group\GroupController@store');
        Route::patch('groups/{group}', 'Settings\Group\GroupController@update');
        Route::delete('groups/{group}', 'Settings\Group\GroupController@destroy');
        Route::resource('specialities', 'Settings\Speciality\SpecialityController');
        Route::resource('staffs', 'Settings\Staffs\StaffController');
    });
});

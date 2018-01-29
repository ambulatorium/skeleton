<?php

// home
Route::get('/', 'HomeController@home');
Route::get('/scheduling/physical-appointment', 'Appointments\PhysicalController@index');

// Authentication default
Auth::routes();

// all healthcare provider
Route::get('/{group}', 'Settings\Group\GroupController@show');

// user invitation
Route::get('/invitations/{token}', 'InvitationController@accept')->middleware('guest')->name('accept');
Route::post('/invitations/{token}', 'InvitationController@join')->middleware('guest')->name('join');

Route::group(['middleware' => 'auth'], function () {

    // scheduling physical appointment
    Route::get('/scheduling/physical-appointment/doctor/{doctor}', 'Appointments\PhysicalController@create');
    Route::post('/scheduling/physical-appointment/doctor/{doctor}', 'Appointments\PhysicalController@store');

    Route::get('/doctors', 'Doctors\DoctorController@index');

    // appointments
    Route::get('/appointments', 'Appointments\AppointmentController@index');

    Route::post('/invitations', 'InvitationController@send');
    Route::delete('/invitations/{invitation}', 'InvitationController@destroy');

    // people. patient,owner,administrator,admin-group,doctor,nurse
    Route::group(['prefix' => 'people'], function () {
        Route::get('/inbox', 'PeopleController@inbox');
        Route::get('/inbox/appointments', 'Appointments\AppointmentController@index');
        Route::get('/inbox/appointments/{appointment}', 'Appointments\AppointmentController@show');
        Route::delete('/inbox/appointments/{appointment}', 'Appointments\AppointmentController@destroy');
        Route::get('/outpatients', 'Doctors\DoctorController@outpatients');
        Route::get('/outpatients/{appointment}', 'Patients\HealthHistoryController@create');
        Route::post('/outpatients/{appointment}', 'Patients\HealthHistoryController@store');
        Route::resource('schedules', 'Doctors\ScheduleController');
        Route::get('/health-history', 'Patients\HealthHistoryController@index');
        Route::get('/health-history/{id}', 'Patients\HealthHistoryController@show');
        Route::resource('settings/patient-form', 'Patients\PatientController');
        Route::get('/settings/account', 'PeopleController@settingAccount');
        Route::patch('/settings/account/{user}', 'PeopleController@updateAccount');
        Route::get('/settings/profile/doctor', 'Doctors\DoctorController@edit');
        Route::patch('/settings/profile/doctor/{doctor}', 'Doctors\DoctorController@update');
    });

    // Multiple Health Care Provider
    Route::group(['prefix' => '{group}'], function () {
        Route::get('/appointments', 'Groups\GroupController@appointment');
        Route::get('/appointments/{appointment}', 'Groups\GroupController@showAppointment');
        Route::patch('/appointments/{appointment}', 'Groups\GroupController@checkinAppointment');
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

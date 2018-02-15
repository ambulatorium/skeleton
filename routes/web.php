<?php

// home
Route::get('/', 'HomeController@home');
Route::get('/search', 'HomeController@search')->name('search');
Route::get('/explore', 'HomeController@explore');
Route::get('/scheduling/physical-appointment', 'Schedulings\PhysicalAppointmentController@index');

// Authentication default
Auth::routes();

// all healthcare provider
Route::get('/{group}', 'Settings\Group\GroupController@show')->name('group');

// user invitation
Route::get('/invitations/{token}', 'InvitationController@accept')->middleware('guest')->name('accept');
Route::post('/invitations/{token}', 'InvitationController@join')->middleware('guest')->name('join');

Route::group(['middleware' => 'auth'], function () {

    // scheduling physical appointment
    Route::get('/scheduling/physical-appointment/{schedule}', 'Schedulings\PhysicalAppointmentController@create');
    Route::post('/scheduling/physical-appointment/{schedule}', 'Schedulings\PhysicalAppointmentController@store');

    // users
    Route::group(['prefix' => 'user'], function () {
        Route::get('/inbox', 'PeopleController@inbox');
        Route::get('/inbox/appointments/{appointment}', 'Appointments\AppointmentController@show');
        Route::delete('/inbox/appointments/{appointment}', 'Appointments\AppointmentController@destroy');
        Route::get('/outpatients', 'Doctors\DoctorController@outpatients');
        Route::get('/outpatients/{appointment}', 'Patients\HealthHistoryController@create');
        Route::post('/outpatients/{appointment}', 'Patients\HealthHistoryController@store');
        Route::resource('schedules', 'Doctors\ScheduleController');
        Route::get('/health-history', 'Patients\HealthHistoryController@index');
        Route::get('/health-history/{id}', 'Patients\HealthHistoryController@show');
        Route::resource('settings/patient-forms', 'Patients\PatientController');
        Route::get('/settings/account', 'Users\AccountController@edit');
        Route::patch('/settings/account/{user}', 'Users\AccountController@update');
        Route::get('/settings/profile/doctor', 'Doctors\DoctorController@edit');
        Route::patch('/settings/profile/doctor/{doctor}', 'Doctors\DoctorController@update')->name('profileDoctor.update');
    });

    // Multiple Health Care Provider
    Route::group(['prefix' => '{group}'], function () {
        Route::get('/appointments', 'Groups\GroupController@appointment');
        Route::get('/appointments/{appointment}', 'Groups\GroupController@showAppointment');
        Route::patch('/appointments/{appointment}', 'Groups\GroupController@checkinAppointment');
        Route::get('/settings/profile', 'Groups\SettingController@profile');
        Route::get('/settings/staffs', 'Groups\StaffController@index');
        Route::get('/settings/invitations', 'Groups\InvitationController@index');
        Route::post('/settings/invitations', 'Groups\InvitationController@store');
        Route::delete('/settings/invitations/{invitation}', 'Groups\InvitationController@destroy');
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

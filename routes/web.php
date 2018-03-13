<?php

// home
Route::get('/', 'HomeController@home');

// doctor's profile
Route::get('/doctors', 'Doctors\DoctorController@index');
Route::get('/doctors/{speciality}', 'Doctors\DoctorController@index');
Route::get('/doctors/{speciality}/{doctor}', 'Doctors\DoctorController@show');

// schedule an appointment
Route::get('/scheduling/physical-appointment', 'Schedulings\PhysicalAppointmentController@index');

// Authentication default
Auth::routes();

// all healthcare provider
Route::get('/{group}', 'Groups\ProfileController@show')->name('group');

// user invitation
Route::get('/invitations/{token}', 'InvitationController@accept')->middleware('guest')->name('accept');
Route::post('/invitations/{token}', 'InvitationController@join')->middleware('guest')->name('join');

Route::group(['middleware' => 'auth'], function () {

    // scheduling physical appointment
    Route::get('/scheduling/physical-appointment/{schedule}', 'Schedulings\PhysicalAppointmentController@create');
    Route::post('/scheduling/physical-appointment/{schedule}', 'Schedulings\PhysicalAppointmentController@store');

    // users
    Route::group(['prefix' => 'user'], function () {
        Route::get('/inbox', 'Users\InboxController@index');
        Route::get('/inbox/{appointment}', 'Users\InboxController@show');
        Route::delete('/inbox/{appointment}', 'Users\InboxController@destroy');
        Route::get('/outpatients', 'Doctors\OutpatientController@index');
        Route::get('/outpatients/{appointment}', 'Doctors\OutpatientController@create');
        Route::post('/outpatients/{appointment}', 'Doctors\OutpatientController@store');
        Route::resource('schedules', 'Doctors\ScheduleController');
        Route::get('/health-history', 'Patients\HealthHistoryController@index');
        Route::get('/health-history/{healthHistory}', 'Patients\HealthHistoryController@show');
        Route::resource('settings/patient-forms', 'Patients\PatientController');
        Route::get('/settings/account', 'Users\AccountController@edit');
        Route::patch('/settings/account/{user}', 'Users\AccountController@update');
        Route::get('/settings/profile/doctor', 'Doctors\DoctorController@edit');
        Route::patch('/settings/profile/doctor/{doctor}', 'Doctors\DoctorController@update')->name('profileDoctor.update');
    });

    // Multiple Health Care Provider
    Route::group(['prefix' => '{group}'], function () {
        Route::get('/appointments', 'Groups\AppointmentController@index');
        Route::get('/appointments/{appointment}', 'Groups\AppointmentController@show');
        Route::patch('/appointments/{appointment}', 'Groups\AppointmentController@update');
        Route::patch('/appointments/{appointment}/{patient}', 'Groups\AppointmentController@verifyPatient');
        Route::get('/settings/profile', 'Groups\ProfileController@edit');
        Route::patch('/settings/profile', 'Groups\ProfileController@update');
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
        Route::delete('groups/{group}', 'Settings\Group\GroupController@destroy');
        Route::resource('specialities', 'Settings\Speciality\SpecialityController');
        Route::resource('staffs', 'Settings\Staffs\StaffController');
    });
});

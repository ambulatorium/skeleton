<?php

// home
Route::get('/', 'HomeController@home');
Route::get('/physical-appointment', 'HomeController@searchSchedule');
Route::get('/physical-appointment/{doctor}/{schedule}', 'HomeController@searchDoctor')->where('schedule', '([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))');

// Authentication default
Auth::routes();

Route::get('/invitations/{token}', 'InvitationController@accept')->middleware('guest')->name('accept');
Route::post('/invitations/{token}', 'InvitationController@join')->middleware('guest')->name('join');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('schedules', 'Doctors\ScheduleController');

    Route::get('/physical-appointment/scheduling/{doctor}', 'BookingController@schedulingAppointment');

    Route::get('/patients', 'Patients\PatientController@index');

    Route::get('/doctors', 'Doctors\DoctorController@index');
    Route::get('/doctors/{doctor}', 'Doctors\DoctorController@show');
    Route::get('/doctors/appointments/{doctor}', 'Doctors\DoctorController@appointments');

    // appointments
    Route::get('/appointments/today', 'Appointments\AppointmentController@today');
    Route::patch('/appointments/cancel/{appointment}', 'Appointments\AppointmentController@cancelAppointment');
    Route::get('/appointments/cancel', 'Appointments\AppointmentController@cancel');
    Route::resource('appointments', 'Appointments\AppointmentController');

    Route::post('/medical-record', 'MedicalRecords\MedicalRecordController@save');

    Route::post('/invitations', 'InvitationController@send');
    Route::delete('/invitations/{invitation}', 'InvitationController@destroy');

    // people. patient,owner,administrator,admin-group,doctor,nurse
    Route::group(['prefix' => 'people'], function () {
        Route::get('/', 'PeopleController@profile');
        Route::get('/settings/profile', 'PeopleController@settingProfile');
        Route::patch('/settings/profile/{user}', 'PeopleController@updateProfile');
        Route::get('/settings/account', 'PeopleController@settingAccount');
        Route::patch('/settings/account/{user}', 'PeopleController@updateAccount');
    });

    // Multiple Health Care Provider
    Route::group(['prefix' => '{group}'], function () {
        Route::get('/', 'Settings\Group\GroupController@show');
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

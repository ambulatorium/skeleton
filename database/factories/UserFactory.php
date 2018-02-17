<?php

use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(App\User::class, function (Faker $faker) {
    static $password;

    return [
        'name'           => $faker->name,
        'email'          => $faker->unique()->safeEmail,
        'password'       => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

// doctors
$factory->define(App\Models\Doctor\Doctor::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory('App\User')->create()->id;
        },
        'group_id' => function () {
            return factory('App\Models\Setting\Group\Group')->create()->id;
        },
        'speciality_id' => function () {
            return factory('App\Models\Setting\Speciality\Speciality')->create()->id;
        },
        'full_name'            => $faker->name,
        'years_of_experience'  => '10',
        'qualification'        => 'MBBS, MS',
        'bio'                  => $faker->word,
        'is_active'            => true,
    ];
});

$factory->state(App\Models\Doctor\Doctor::class, 'notactive', function () {
    return [
        'is_active' => false,
    ];
});

// schedule
$factory->define(App\Models\Doctor\Schedule::class, function (Faker $faker) {
    $day = today()->addDays(1);

    return [
        'doctor_id' => function () {
            return factory('App\Models\Doctor\Doctor')->create()->id;
        },
        'token'                   => str_random(6),
        'day'                     => Carbon::parse($day)->format('l'),
        'start_time'              => '09:00:00',
        'end_time'                => '17:00:00',
        'estimated_service_time'  => '35',
        'estimated_price_service' => '500',
        'is_available'            => true,
    ];
});

// specialities
$factory->define(App\Models\Setting\Speciality\Speciality::class, function (Faker $faker) {
    return [
        'name'        => $faker->randomElement($array = ['Pulmonology', 'Nephrology']),
        'description' => $faker->word,
    ];
});

// health care provider
$factory->define(App\Models\Setting\Group\Group::class, function (Faker $faker) {
    $name = $faker->company;

    return [
        'name'                => $name,
        'slug'                => str_slug($name),
        'country'             => $faker->country,
        'city'                => $faker->city,
        'address'             => $faker->address,
    ];
});

// staff
$factory->define(App\Models\Setting\Staff\Staff::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory('App\User')->create()->id;
        },
        'group_id' => function () {
            return factory('App\Models\Setting\Group\Group')->create()->id;
        },
    ];
});

// invitation
$factory->define(App\Models\Invitation::class, function (Faker $faker) {
    return [
        'email' => $faker->unique()->safeEmail,
        'role'  => 'foobar',
        'token' => str_random(60),
    ];
});

// patient
$factory->define(App\Models\Patient\Patient::class, function (Faker $faker) {
    $gender = $faker->randomElement($array = ['male', 'female']);

    return [
        'user_id' => function () {
            return factory('App\User')->create()->id;
        },
        'form_name'      => 'my_parent',
        'full_name'      => $faker->name($gender),
        'dob'            => $faker->date($format = 'Y-m-d', $max = 'now'),
        'gender'         => $gender,
        'address'        => 'address',
        'city'           => $faker->city,
        'state'          => $faker->state,
        'zip_code'       => $faker->postcode,
        'home_phone'     => $faker->phoneNumber,
        'cell_phone'     => $faker->phoneNumber,
        'marital_status' => $faker->randomElement($array = ['married', 'single', 'divorced']),
        'is_verified'    => false,
    ];
});

// appointment
$factory->define(App\Models\Appointment\Appointment::class, function (Faker $faker) {
    return [
        'patient_id' => function () {
            return factory('App\Models\Patient\Patient')->create()->id;
        },
        'user_id' => function (array $appointment) {
            return App\Models\Patient\Patient::find($appointment['patient_id'])->user_id;
        },
        'schedule_id' => function () {
            return factory('App\Models\Doctor\Schedule')->create()->id;
        },
        'doctor_id' => function(array $appointment) {
            return App\Models\Doctor\Schedule::find($appointment['schedule_id'])->doctor_id;
        },
        'group_id' => function(array $appointment) {
            return App\Models\Doctor\Doctor::find($appointment['doctor_id'])->group_id;
        },

        'token'             => str_random(6),
        'date'              => today()->addDays(1),
        'preferred_time'    => '09:00:00',
        'patient_condition' => $faker->text($maxNbChars = 160),
        'status'            => 'scheduled',
    ];
});

// health history
$factory->define(App\Models\Patient\HealthHistory::class, function (Faker $faker) {
    return [
        'patient_id' => function () {
            return factory('App\Models\Patient\Patient')->create()->id;
        },
        'user_id' => function (array $healtHistory) {
            return App\Models\Patient\Patient::find($healtHistory['patient_id'])->user_id;
        },
        'doctor_id' => function () {
            return factory('App\Models\Doctor\Doctor')->create()->id;
        },
        'group_id' => function (array $healtHistory) {
            return App\Models\Doctor\Doctor::find($healtHistory['doctor_id'])->group_id;
        },
        'appointment_date' => today(),
        'appointment_time' => '09:00:00',
        'appointment_patient_condition' => $faker->text($maxNbChars = 160),
        'schedule_start_time' => '09:00:00',
        'schedule_end_time' => '17:00:00',
        'schedule_estimated_service_time' => '35',
        'schedule_estimated_price_service' => '350',
        'doctor_diagnosis' => $faker->text($maxNbChars = 160),
        'doctor_action' => $faker->text($maxNbChars = 160),
        'doctor_note' => $faker->text($maxNbChars = 160),
    ];
});
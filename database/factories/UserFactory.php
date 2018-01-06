<?php

use Faker\Generator as Faker;

$factory->define(App\User::class, function (Faker $faker) {
    static $password;

    return [
        'name'           => $faker->name,
        'email'          => $faker->unique()->safeEmail,
        'password'       => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Models\Patient\Patient::class, function () {
    return [
        'user_id' => function () {
            return factory('App\User')->create()->id;
        },
        'register_from' => 'command',
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
        'bio'    => $faker->word,
        'status' => 0,
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
    return [
        'health_care_name'    => $faker->company,
        'slug'                => $faker->slug,
        'country'             => $faker->country,
        'city'                => $faker->city,
        'address'             => $faker->address,
        'min_day_appointment' => '1',
        'max_day_appointment' => '7',
    ];
});

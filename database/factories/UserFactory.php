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

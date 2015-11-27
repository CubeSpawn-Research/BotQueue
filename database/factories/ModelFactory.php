<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    return [
        'username' => $faker->name,
        'email' => $faker->email,
        'password' => Hash::make(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Models\Bot::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'model' => $faker->word,
        'manufacturer' => $faker->word
    ];
});

$factory->define(App\Models\Queue::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'delay' => $faker->numberBetween(0, 100)
    ];
});

$factory->define(App\Models\Job::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
    ];
});

$factory->define(App\Models\File\LocalFile::class, function (Faker\Generator $faker) {
    return [
        'path' => '/tmp/path',
        'hash' => 0,
        'size' => $faker->numberBetween(0, 100),
        'type' => $faker->mimeType
    ];
});
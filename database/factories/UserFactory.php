<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Church;
use App\Religion;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    $religions = Religion::all();
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'church_id' => factory(Church::class)->create(),
        'religion_id' => $religions->count() > 0 ? array_rand($religions->toArray()) : factory(Religion::class)->create(),
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});

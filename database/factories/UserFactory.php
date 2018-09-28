<?php

use Faker\Generator as Faker;

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

$factory->define(App\User::class, function (Faker $faker) {

    return [
        'first' => "Matt",
        'last' => "Shanks",
        'role' => 'admin',
        'email' => 'matt@super.ca',
        'password' => bcrypt(env('ADMIN_CREDENTIALS', false))
    ];
 
});
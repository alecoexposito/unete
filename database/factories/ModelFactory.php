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
    $options = [
        'cost' => 11
    ];
    $pass = password_hash('secret', PASSWORD_BCRYPT, $options);
    return [
        'name' => $faker->name,
        'lastname' => $faker->lastName,
        'email' => $faker->email,
        'password' => $pass,
    ];
});

$factory->define(App\Models\Client::class, function (Faker\Generator $faker) {
    return [
        'phone' => $faker->phoneNumber,
        'birth_date' => $faker->dateTimeBetween(),
    ];
});

$factory->define(App\Models\ClientAccount::class, function (Faker\Generator $faker) {
    return [
        'account_number' => $faker->bankAccountNumber,
    ];
});

$factory->define(App\Models\BusinessCategory::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->colorName,
        'description' => $faker->sentence
    ];
});

$factory->define(App\Models\Business::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->company,
        'description' => $faker->sentence
    ];
});

$factory->define(App\Models\BusinessAccount::class, function (Faker\Generator $faker) {
    return [
        'account_number' => $faker->bankAccountNumber,
        'default_percent' => $faker->numberBetween(0, 100)
    ];
});

$factory->define(App\Models\Dependence::class, function (Faker\Generator $faker) {
    return [
        'name' => 'Dependence 1',
        'description' => 'Just a description',
        'main' => true
    ];
});

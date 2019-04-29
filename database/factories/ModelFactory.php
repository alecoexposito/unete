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
        'gender' => $faker->randomElement(array('male', 'female'));
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
    $image = $faker->image('public/uploads/business', 640, 480, null, false);
    return [
        'name' => $faker->company,
        'description' => $faker->sentence,
        'image' => $image
    ];
});

$factory->define(App\Models\BusinessAccount::class, function (Faker\Generator $faker) {
    return [
        'account_number' => $faker->bankAccountNumber,
        'default_percent' => $faker->numberBetween(0, 100)
    ];
});

$factory->define(App\Models\Dependence::class, function (Faker\Generator $faker) {
    $image = $faker->image('public/uploads/business', 640, 480, null, false);
    return [
        'description' => 'Just a description',
        'image' => $image
    ];
});

$factory->define(App\Models\Advertisement::class, function (Faker\Generator $faker) {
    $image = $faker->image('public/uploads/advertisement', 640, 480, null, false);
    return [
        'title' => $faker->company,
        'description' => $faker->sentence,
        'image' => $image
    ];
});

$factory->define(App\Models\ClientType::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->title,
        'description' => $faker->sentence,
    ];
});

$factory->define(App\Models\ClientTypeDependence::class, function (Faker\Generator $faker) {
    return [
        'global_percent' => $faker->numberBetween(0, 100),
        'local_percent' => $faker->numberBetween(0, 100),
    ];
});

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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'tipo' => rand(0, 1),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Clinica::class, function (Faker\Generator $faker) {
    return [
    		"nome" => $faker->word,
            "fantasia" => $faker->word,
            "razao_social" => $faker->word,
            "cnpj" => rand(10000000000000, 99999999999999),
            "endereco" => $faker->word,
            "numero" => rand(0, 9999),
            "bairro" => $faker->word,
            "cidade" => $faker->city,
            "estado" => $faker->state,
            "especialidade" => $faker->paragraph,
            "transporte" => rand(0, 1), 
            "tratamento" => $faker->paragraph
    ];
});

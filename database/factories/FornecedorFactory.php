<?php

use Faker\Generator as Faker;

$factory->define(App\Fornecedor::class, function (Faker $faker) {
    return [
        'nome' => $faker->name,
        'endereco' => $faker->cityName,
        'cnpj' => $faker->cnpj,
    ];
});

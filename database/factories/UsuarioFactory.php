<?php

use Faker\Generator as Faker;

$factory->define(App\Usuario::class, function (Faker $faker) {
	static $password;

    return [
        'nome' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'senha' => $password ?: $password = bcrypt('secret'),
        'acesso' => true,
        'admin' => $faker->boolean,
    ];
});

 <?php

use Faker\Generator as Faker;

$factory->define(App\Produto::class, function (Faker $faker) {
    return [
        'nome' => $faker->name,
        'descricao' => $faker->word,
        'custo' => $faker->randomNumber(2),
        'quantidade' => $faker->randomDigitNotNull,
    ];
});

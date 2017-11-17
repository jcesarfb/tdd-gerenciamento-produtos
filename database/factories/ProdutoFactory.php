 <?php

use Faker\Generator as Faker;

$factory->define(App\Usuario::class, function (Faker $faker) {
    return [
        'nome' => $faker->name,
        'descricao' => $faker->word,
        'custo' => $faker->randomNumber(2),
        'quantidade' => $faker->randomDigitNotNull,
});

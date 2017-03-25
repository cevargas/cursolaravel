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

$factory->define(Blog\Entities\User::class, function ($faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => str_random(10),
        'remember_token' => str_random(10),
    ];
});

$factory->define(Blog\Entities\Cliente::class, function ($faker) {
    return [
        'nome' => $faker->name,
        'email' => $faker->email,
        'endereco' => $faker->address,
        'telefone' => $faker->phoneNumber,
        'observacoes' => $faker->sentence,
    ];
});


$factory->define(Blog\Entities\Project::class, function ($faker) {
    return [
        'owner_id' => rand(1, 10),
        'cliente_id' =>rand(1, 10),
        'nome' => $faker->word,
        'descricao' => $faker->sentence,
        'progresso' => rand(1, 100),
        'status' => rand(1, 3),
        'data_final' => $faker->dateTime('now')
    ];
});

$factory->define(Blog\Entities\ProjectNote::class, function ($faker) {
    return [
        'project_id' => rand(1, 10),
        'titulo' => $faker->word,
        'anotacao' => $faker->paragraph
    ];
});

$factory->define(Blog\Entities\ProjectTask::class, function ($faker) {
    return [
        'project_id' => rand(1, 10),
        'name' => $faker->word,
        'start_date' => $faker->dateTime('now'),
        'due_date' => $faker->dateTime('now'),
        'status' => rand(1, 3)
    ];
});
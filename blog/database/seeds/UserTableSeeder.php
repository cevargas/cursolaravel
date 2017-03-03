<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        //Blog\Entities\User::truncate();
        factory(Blog\Entities\User::class, 10)->create();

        factory(Blog\Entities\User::class)->create([
            'name' => 'Teste',
            'email' => 'teste@teste.com',
            'password' => bcrypt('123456'),
            'remember_token' => str_random(10)
        ]);
    }
}

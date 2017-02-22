<?php

use Illuminate\Database\Seeder;

class ClienteTableSeeder extends Seeder
{
    public function run()
    {
        //Blog\Entities\Cliente::truncate();
        factory(Blog\Entities\Cliente::class, 10)->create();
    }
}

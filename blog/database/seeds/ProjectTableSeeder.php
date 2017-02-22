<?php
use Illuminate\Database\Seeder;

/**
 * Created by PhpStorm.
 * User: Carlos Eduardo
 * Date: 20/02/2017
 * Time: 11:50
 */
class ProjectTableSeeder extends Seeder
{

    public function run()
    {
        //Blog\Entities\Project::truncate();
        factory(Blog\Entities\Project::class, 10)->create();
    }
}
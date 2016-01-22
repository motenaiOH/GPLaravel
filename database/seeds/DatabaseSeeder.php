<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        Eloquent::unguard();

        /*Desativa chave etrangeira*/
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        \CodeProject\Entities\User::truncate();
        \CodeProject\Entities\Client::truncate();
        \CodeProject\Entities\Project::truncate();

        $this->call(UserTableSeeder::class);
        $this->call(ClientTableSeeder::class);
        $this->call(ProjectTableSeeder::class);

        /*ativa chave estrangeira*/
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    }
}

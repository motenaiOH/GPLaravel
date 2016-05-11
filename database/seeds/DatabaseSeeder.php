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

        \CodeProject\Entities\ProjectTask::truncate();
        \CodeProject\Entities\ProjectMember::truncate();
        \CodeProject\Entities\ProjectNote::truncate();
        \CodeProject\Entities\Project::truncate();
        \CodeProject\Entities\Client::truncate();
        \CodeProject\Entities\User::truncate();

        $this->call(UserTableSeeder::class);
        $this->call(ClientTableSeeder::class);
        $this->call(ProjectTableSeeder::class);
        $this->call(ProjectNoteTableSeeder::class);
        $this->call(ProjectMembersTableSeeder::class);
        $this->call(ProjectTasksTableSeeder::class);

        /*ativa chave estrangeira*/
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    }
}

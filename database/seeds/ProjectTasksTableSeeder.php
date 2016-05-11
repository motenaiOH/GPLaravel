<?php

use Illuminate\Database\Seeder;

class ProjectTasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \CodeProject\Entities\ProjectTask::truncate();
        factory(\CodeProject\Entities\ProjectTask::class,10)->create();
    }
}

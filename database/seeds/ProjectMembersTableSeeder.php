<?php

use Illuminate\Database\Seeder;

class ProjectMembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \CodeProject\Entities\ProjectMember::truncate();
        factory(\CodeProject\Entities\ProjectMember::class,10)->create();
    }
}

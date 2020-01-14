<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the roles table.
     *
     * @return void
     */
    public function run()
    {
         DB::table('roles')->insert([
         	['name' => 'Consumer'],
            ['name' => 'Contributor'],
            ['name' => 'Editor'],
            ['name' => 'Collaborator'],
            ['name' => 'Coordinator']

        ]);
    }
    
}



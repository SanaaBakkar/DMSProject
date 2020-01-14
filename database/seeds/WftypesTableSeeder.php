<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WftypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('wftypes')->insert([
         	['name' => 'Assign a new task to a single user'],
            ['name' => 'Group review & approve'],
            ['name' => 'Parallel review & approve'],
            ['name' => 'Pooled review & approve'],

        ]);   
    }
}

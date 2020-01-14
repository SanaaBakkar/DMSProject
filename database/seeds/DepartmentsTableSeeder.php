<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('departements')->insert([
         	['name' => 'Production'],
            ['name' => 'Research and Development (R&D)'],
            ['name' => 'Purchasing'],
            ['name' => 'Marketing '],
            ['name' => 'Human Resource Management'],
            ['name' => 'IT'],
            ['name' => 'Accounting and Finance'],

        ]);  
    }
}

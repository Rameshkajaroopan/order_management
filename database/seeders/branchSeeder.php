<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class branchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('branches')->insert([
            'name' => 'A',
            'location' =>Str::random(10), 
        ]);

        DB::table('branches')->insert([
            'name' => 'B',
            'location' =>Str::random(10), 
        ]);

        DB::table('branches')->insert([
            'name' => 'C',
            'location' =>Str::random(10), 
        ]);

        DB::table('branches')->insert([
            'name' => 'D',
            'location' =>Str::random(10), 
        ]);

        DB::table('branches')->insert([
            'name' => 'E',
            'location' =>Str::random(10), 
        ]);

        

 
    }
}

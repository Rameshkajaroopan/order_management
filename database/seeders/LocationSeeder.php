<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('locations')->insert([  
            'name' =>Str::random(8), 
            'branch_id' => 1, 
        ]);
 
        DB::table('locations')->insert([
            'name' =>Str::random(8), 
            'branch_id' => 2,
        ]);
 
        DB::table('locations')->insert([
            'name' =>Str::random(8), 
            'branch_id' => 3,
        ]);
 
        DB::table('locations')->insert([
            'name' =>Str::random(8), 
            'branch_id' => 4,
        ]);
 
        DB::table('locations')->insert([
            'name' =>Str::random(8), 
            'branch_id' => 5,
        ]);
 
    }
}

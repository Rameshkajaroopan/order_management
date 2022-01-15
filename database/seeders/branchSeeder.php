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
            'name' => 'Branch1',
            'location_id' => 1,
            'address' =>Str::random(10), 
        ]);

        DB::table('branches')->insert([
            'name' => 'Branch2',
            'location_id' => 2,
            'address' =>Str::random(10), 
        ]);

        DB::table('branches')->insert([
            'name' => 'Branch3',
            'location_id' => 3,
            'address' =>Str::random(10), 
        ]);

      
 
    }
}

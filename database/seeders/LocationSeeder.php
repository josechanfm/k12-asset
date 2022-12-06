<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            'abbr'=>'A001',
            'title'=>'Room A001',
            'status'=>1
        ]);
        DB::table('locations')->insert([
            'abbr'=>'A002',
            'title'=>'Room A002',
            'status'=>1
        ]);
        DB::table('locations')->insert([
            'abbr'=>'A003',
            'title'=>'Room A003',
            'status'=>1
        ]);
        DB::table('locations')->insert([
            'abbr'=>'B010',
            'title'=>'Room B010',
            'status'=>1
        ]);
    }
}

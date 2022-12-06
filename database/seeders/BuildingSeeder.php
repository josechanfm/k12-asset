<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BuildingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('buildings')->insert([
            'abbr'=>'B01',
            'title'=>'一號教學樓',
            'status'=>1
        ]);
        DB::table('buildings')->insert([
            'abbr'=>'B02',
            'title'=>'二號教學樓',
            'status'=>1
        ]);
        DB::table('buildings')->insert([
            'abbr'=>'B03',
            'title'=>'三號教學樓',
            'status'=>1
        ]);
    }
}

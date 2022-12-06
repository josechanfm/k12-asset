<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'abbr'=>'ICT',
            'title'=>'ICT devices',
            'status'=>1
        ]);
        DB::table('categories')->insert([
            'abbr'=>'TE02',
            'title'=>'Teaching equipment',
            'status'=>1
        ]);
        DB::table('categories')->insert([
            'abbr'=>'CO01',
            'title'=>'Comsumable',
            'status'=>1
        ]);
        DB::table('categories')->insert([
            'abbr'=>'OL11',
            'title'=>'On Loan',
            'status'=>1
        ]);
    }
}

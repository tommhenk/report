<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statuses')->insert([
            ['name'=>'new'],
            ['name'=>'in_process'],
            ['name'=>'fulfilled'],
        ]);
    }
}

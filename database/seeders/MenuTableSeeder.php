<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menus')->insert([
            ['name'=>'Main', 'path'=>'/'],
            ['name'=>'Contacts', 'path'=>'/contacts'],
        ]);
    }
}

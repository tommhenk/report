<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'title'=>'Product 1',
                'price'=>'400',
                'desc'=>'Description of first product'
            ],
            [
                'title'=>'Product 2',
                'price'=>'800',
                'desc'=>'Description of second product'
            ],
            [
                'title'=>'Product 3',
                'price'=>'1200',
                'desc'=>'Description of third product'
            ],
        ]);
    }
}

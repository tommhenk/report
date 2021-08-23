<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Str;
use DB;
class OrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $employees = \App\Models\Role::where('name','employee')->first()->users;
        $employeesId = $employees->reduce(function($returnArr, $employee){
            $returnArr[] = $employee->id;
            return $returnArr;
        },[]);
        $clients = \App\Models\Role::where('name','client')->first()->users;
        $clientsId = $clients->reduce(function($returnArr, $client){
            $returnArr[] = $client->id;
            return $returnArr;
        },[]);
        $productsId = \App\Models\Product::pluck('id')->toArray();
         

        $arrOrders = [];
        for ($i=0; $i < 1000; $i++) { 
            $rand = mt_rand(1,10);
            if ($rand > 8) {
                $order = [
                    'title'=>$faker->sentence($nbWords = mt_rand(3,8), $variableNbWords = true) ,
                    'desc'=>$faker->text(400),
                    'price'=>mt_rand(4,20).'00',
                    'status_id'=>3,
                    'product_id'=>null,
                    'client_id'=>$clientsId[array_rand($clientsId)],
                    'employee_id'=>$employeesId[array_rand($employeesId)],
                    'created_at'=>$faker->dateTimeBetween($startDate = '-5 years', $endDate = 'now', $timezone = null),
                ];
            }else {
                $order = [
                    'title'=>null ,
                    'desc'=>null,
                    'price'=>null,
                    'status_id'=>3,
                    'product_id'=>$productsId[array_rand($productsId)],
                    'client_id'=>$clientsId[array_rand($clientsId)],
                    'employee_id'=>$employeesId[array_rand($employeesId)],
                    'created_at'=>$faker->dateTimeBetween($startDate = '-5 years', $endDate = 'now', $timezone = null),
                ];
            }
            $arrOrders[] = $order;
        }

        DB::table('orders')->insert($arrOrders);
    }
}

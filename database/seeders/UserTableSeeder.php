<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Str;
use DB;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $arrUsers = [];
        for ($i=0; $i < 100; $i++) { 
            $user = [
                'login' => 'user'.$i,
                'name' => $faker->name(),
                'email' => $faker->unique()->safeEmail(),
                'birth' => $faker->dateTimeBetween($startDate = '-50 years', $endDate = '-20 years', $timezone = null),
                'get_job' => $faker->dateTimeBetween($startDate = '-10 years', $endDate = 'now', $timezone = null),
                'email_verified_at' => now(),
                'password' => bcrypt(1234), // password
                'remember_token' => Str::random(10),
            ];
            $arrUsers[] = $user;
        }
        DB::table('users')->insert($arrUsers);

        $users = \App\Models\User::get();
        $roles = \App\Models\Role::get();
        $roles = $roles->reduce(function ($returnArr, $role){
            $returnArr[$role->name] = $role->id;
            return $returnArr;
        }, []);
        foreach ($users as $user) {
            $rand = mt_rand(0, 40);
            if ($user->id == 1) {
                $user->roles()->attach($roles['admin']);
            }elseif ($rand > 33) {
                $user->roles()->attach($roles['employee']);
            }else{
                $user->roles()->attach($roles['client']);
            }
        }
    }
}

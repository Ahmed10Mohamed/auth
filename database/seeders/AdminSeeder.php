<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('admins')->insert([

            [
                'type' => '1', // store
                'full_name' => 'Ahmed M Bakri',
                'phone' => '010158918366',
                'password' => bcrypt('123456'),


            ],
            [
                'type' => '2', // admin
                'full_name' => 'Ossama Mohammed',
                'phone' => '01149671770',
                'password' => bcrypt('123456'),


            ],
            [
                'type' => '3', // user
                'full_name' => 'Eyed Ahmed',
                'phone' => '01201375568',
                'password' => bcrypt('123456'),


            ]
            ]);
            }


}

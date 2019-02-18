<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('users')->insert([
         	'role_id'=>'1',
        	'name'=>'Md. Deloar Hossain',
        	'username'=>'admin',
        	'email'=>'deloar.engr@gmail.com',
        	'password'=>bcrypt('DH90672620'),

        ]);

         DB::table('users')->insert([
         	'role_id'=>'2',
        	'name'=>'Md. Rimon Hossain',
        	'username'=>'author',
        	'email'=>'rimon.engr@gmail.com',
        	'password'=>bcrypt('dh90672620'),

        ]);
    }
}

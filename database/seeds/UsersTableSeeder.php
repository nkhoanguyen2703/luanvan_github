<?php

use Illuminate\Database\Seeder;
use App\User; //not default
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
        	'name' => 'Nguyen Khoa',
        	'email' => 'khoa@gmail.com',
        	'password' => bcrypt('123456')

        	]);
    }
}

<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	User::truncate();

        User::create([
        	'name'		=>	'Romeo Tr',
        	'email'		=>	'silentromeo94@gmail.com',
        	'password'	=>	Hash::make('123456'),
        ]);

        User::create([
        	'name'		=>	'Takshak Tiwari',
        	'email'		=>	'takshaktiwari@gmail.com',
        	'password'	=>	Hash::make('123456'),
        ]);

        User::create([
        	'name'		=>	'Mr Tiwari',
        	'email'		=>	'silentromeo95@gmail.com',
        	'password'	=>	Hash::make('123456'),
        ]);
    }
}

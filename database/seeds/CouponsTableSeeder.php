<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Coupon;

class CouponsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        Coupon::truncate();

        for($i=0; $i<=35; $i++){
        	Coupon::create([
        		'coupon'	=>	strtoupper($faker->word),
        		'percent'	=>	rand(10, 90),
        		'amount'	=>	null,
        		'min_purchase'	=>	rand(500, 1500),
        		'expires_at'	=>	date('Y-m-d H:i:s', strtotime("+3 months", strtotime(date('Y-m-d H:i:s'))))
        	]);
        }
    }
}

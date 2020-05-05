<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Country;
use App\State;
use App\Location;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
    	Country::truncate();
    	State::truncate();
    	Location::truncate();

        for($i=0; $i<=4; $i++){

        	$name = $faker->country;
        	$slug = str_replace(' ', '-', strtolower(trim($name)));
        	$slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug);

        	$country = Country::create([
        						'country'	=>	$name,
        						'slug'		=>	$slug,
        					]);

        	for($j=0; $j<=rand(4, 6); $j++){
        		$name = $faker->state;
        		$slug = str_replace(' ', '-', strtolower(trim($name)));
        		$slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug);
        		$state = State::create([
        						'state'		=>	$name,
        						'country_id'=>	$country->id,
        						'slug'		=>	$slug
        					]);

        		for($k=0; $k<=rand(4, 8); $k++){
        			$name = $faker->city;
        			$slug = str_replace(' ', '-', strtolower(trim($name)));
        			$slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug);
        			Location::create([
        						'location'	=>	$name,
        						'pincode'	=>	rand(100000, 999999),
        						'state_id'	=>	$state->id,
        						'country_id'=>	$country->id,
        						'slug'		=>	$slug
        					]);
        		}
        	}
        }
    }
}

<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Country;
use App\State;
use App\District;
use App\Pincode;
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
    	District::truncate();
        Pincode::truncate();
        Location::truncate();

        for($i=0; $i<=4; $i++){

        	$name = $faker->country;
        	$slug = str_replace(' ', '-', strtolower(trim($name)));
        	$slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug);

        	$country = Country::create([
        						'country'	=>	$name,
        						'slug'		=>	$slug,
        					]);

        	for($j=0; $j<=rand(3, 6); $j++){
        		$name = $faker->state;
        		$slug = str_replace(' ', '-', strtolower(trim($name)));
        		$slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug);
        		$state = State::create([
        						'state'		=>	$name,
        						'country_id'=>	$country->id,
        						'slug'		=>	$slug
        					]);

        		for($k=0; $k<=rand(3, 6); $k++){
        			$name = $faker->city;
        			$slug = str_replace(' ', '-', strtolower(trim($name)));
        			$slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug);
        			$district = District::create([
            						'district'	=>	$name,
            						'state_id'	=>	$state->id,
            						'country_id'=>	$country->id,
            						'slug'		=>	$slug
            					]);

                    for($l=0; $l<=rand(3, 6); $l++){
                        $pincode = Pincode::create([
                                        'pincode'  =>  rand(100000, 999999),
                                        'district_id'  =>  $district->id,
                                        'state_id'  =>  $state->id,
                                        'country_id'=>  $country->id,
                                    ]);

                        for($m=0; $m<=rand(3, 6); $m++){
                            $name = $faker->city;
                            $slug = str_replace(' ', '-', strtolower(trim($name)));
                            $slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug);
                            Location::create([
                                        'location'  =>  $name,
                                        'pincode_id'  =>  $pincode->id,
                                        'district_id'  =>  $district->id,
                                        'state_id'  =>  $state->id,
                                        'country_id'=>  $country->id,
                                        'slug'      =>  $slug
                                    ]);
                        }
                    }
        		}
        	}
        }
    }
}

<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Brand;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        Brand::truncate();

        for($i=1; $i<=40; $i++){
        	$name = $faker->company;

        	$slug = str_replace(' ', '-', strtolower(trim($name)));
        	$slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug);

        	Brand::create([
        		'brand'	        => 	$name,
        		'slug'	        => 	$slug,
                'm_title'       =>  $faker->sentence($nbWords = 8, $asText = false),
                'm_keywords'    =>  $faker->sentence($nbWords = 12, $asText = false),
                'm_description' =>  $faker->sentence($nbWords = 15, $asText = false),
        	]);
        }
    }
}

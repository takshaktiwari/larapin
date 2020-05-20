<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
    	Category::truncate();
        $cntries = \App\Country::with('states')->with('locations')->get()->all();

        $countries  = [];
        $states     = [];
        $locations  = [];
        foreach ($cntries as $country) {
            array_push($countries, $country->id);
            $states = array_merge($states, $country->states->pluck('id')->toArray());
            $locations = array_merge($locations, $country->locations->pluck('id')->toArray());
        }


        $attributes = [];
        $attrs = \App\Attribute::get()->all();
        foreach ($attrs as $attribute) {
            array_push($attributes, $attribute->id);
        }


    	for($i=1; $i<=10; $i++){

	    	$image = '/dump_products/category/category-'.rand(1, 20).'.jpg';
	    	$name = $faker->company;

	    	$slug = str_replace(' ', '-', strtolower(trim($name)));
	    	$slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug);

	    	$object = [ 'image_sm' 		=> $image,
	                    'image_md' 		=> $image,
	                    'image_lg' 		=> $image,
	                    'category' 		=> $name,
	                    'slug' 			=> $slug,
	                    'parent' 		=> null,
	                    'status' 		=> rand(0, 1),
	                    'featured' 		=> rand(0, 1),
	                    'm_title' 		=> $faker->sentence($nbWords = 8, $asText = false),
	                    'm_keywords' 	=> $faker->sentence($nbWords = 12, $asText = false),
	                    'm_description' => $faker->sentence($nbWords = 15, $asText = false),
	                ];
	        
	        $category = Category::create($object);

            $category->countries()->sync($countries);
            $category->states()->sync($states);
            $category->locations()->sync($locations);
            $category->attributes()->sync($attributes);

	        for($j=1; $j<=rand(4,6); $j++){
        		$image = '/dump_products/category/category-'.rand(1, 20).'.jpg';
        		$name = $faker->company;

        		$slug = str_replace(' ', '-', strtolower(trim($name)));
        		$slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug);

        		$object = [ 'image_sm' 		=> $image,
        	                'image_md' 		=> $image,
        	                'image_lg' 		=> $image,
        	                'category' 		=> $name,
        	                'slug' 			=> $slug,
        	                'parent' 		=> $category->id,
        	                'status' 		=> rand(0, 1),
        	                'featured' 		=> rand(0, 1),
        	                'm_title' 		=> $faker->sentence($nbWords = 8, $asText = false),
        	                'm_keywords' 	=> $faker->sentence($nbWords = 12, $asText = false),
        	                'm_description' => $faker->sentence($nbWords = 15, $asText = false),
        	            ];
        	    
        	    $child_cat = Category::create($object);

                $child_cat->countries()->sync($countries);
                $child_cat->states()->sync($states);
                $child_cat->locations()->sync($locations);
                $child_cat->attributes()->sync($attributes);
	        }
        }
    }
}

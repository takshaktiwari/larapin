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
    	for($i=1; $i<=8; $i++){
	    	$image = '/dump_images/image-'.rand(1, 13).'.jpg';
	    	$name = $faker->company;

	    	$slug = str_replace(' ', '-', strtolower(trim($name)));
	    	$slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug);

	    	$object = [ 'image_sm' 		=> $image,
	                    'image_md' 		=> $image,
	                    'image_lg' 		=> $image,
	                    'category' 		=> $name,
	                    'slug' 			=> $slug,
	                    'parent' 		=> null,
	                    'status' 		=> $faker->boolean($chanceOfGettingTrue = 10),
	                    'featured' 		=> $faker->boolean($chanceOfGettingTrue = 5),
	                    'm_title' 		=> $faker->sentence($nbWords = 8, $asText = false),
	                    'm_keywords' 	=> $faker->sentence($nbWords = 12, $asText = false),
	                    'm_description' => $faker->sentence($nbWords = 15, $asText = false),
	                ];
	        
	        $category = Category::create($object);

	        for($i=1; $i<=rand(4,8); $i++){
        		$image = '/dump_images/image-'.rand(1, 13).'.jpg';
        		$name = $faker->company;

        		$slug = str_replace(' ', '-', strtolower(trim($name)));
        		$slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug);

        		$object = [ 'image_sm' 		=> $image,
        	                'image_md' 		=> $image,
        	                'image_lg' 		=> $image,
        	                'category' 		=> $name,
        	                'slug' 			=> $slug,
        	                'parent' 		=> $category->id,
        	                'status' 		=> $faker->boolean($chanceOfGettingTrue = 10),
        	                'featured' 		=> $faker->boolean($chanceOfGettingTrue = 5),
        	                'm_title' 		=> $faker->sentence($nbWords = 8, $asText = false),
        	                'm_keywords' 	=> $faker->sentence($nbWords = 12, $asText = false),
        	                'm_description' => $faker->sentence($nbWords = 15, $asText = false),
        	            ];
        	    
        	    Category::create($object);
	        }
        }
    }
}

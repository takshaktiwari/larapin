<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Product_review;
use App\Product;
use App\User;
class ProductReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        Product_review::truncate();

        $users = User::get()->all();
        $products = Product::get()->all();
        foreach ($users as $user) {
        	foreach ($products as $product) {
        		Product_review::create([
        			'product_id'	=>	$product->id,
                    'rating'        =>  rand(1, 5),
        			'user_id'		=>	$user->id,
        			'title'			=>	$faker->sentence($nbWords = rand(5, 10), $variableNbWords = true),
        			'review'		=>	$faker->sentence($nbWords = rand(12, 20), $variableNbWords = true)
        		]);
        	}
        }
    }
}

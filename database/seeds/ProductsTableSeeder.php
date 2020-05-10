<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Attribute;
use App\Category;
use App\Product;
use App\Product_detail;
use App\Product_attr;
use App\Product_option;
use App\Product_image;
use App\Discount_product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $categories = Category::get()->all();

        Product::truncate();
        Product_detail::truncate();
        Product_attr::truncate();
        Product_option::truncate();
        Product_image::truncate();
        Discount_product::truncate();

        #	products in all categories
        foreach ($categories as $category) {

        	for($i=0; $i<=rand(6, 10); $i++){
	        	$name = $faker->sentence($nbWords = rand(3, 6), $variableNbWords = true);
	        	$slug = str_replace(' ', '-', strtolower(trim($name)));
	        	$slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug);

	        	$product = Product::create([
	        					'product_name'	=>	$name,
	        					'subtitle'		=>	$faker->sentence($nbWords = rand(9, 12), $variableNbWords = true),
	        					'base_price'	=>	number_format(rand(400, 600), 2),
	        					'base_stock'	=>	rand(80, 150),
	        					'short_description'	=>	$faker->paragraph($nbSentences = rand(3, 7), $variableNbSentences = true),
	        					'product_tags'	=>	str_replace(' ', ',', $faker->paragraph($nbSentences = rand(3, 7), $variableNbSentences = true)),
	        					'slug'			=>	$slug,
	        					'featured'		=>	rand(0, 1),
	        					'status'		=>	rand(0, 1),
	        				]);

	        	#	sync some categories with this product
	        	$category_ids = [];
	        	$categories = Category::inRandomOrder()->limit(rand(6, 12))->get()->all();
	        	foreach ($categories as $category) {
	        		array_push($category_ids, $category->id);
	        	}
	        	$product->categories()->sync($category_ids);
	        	
	        	#	Add product detail
	        	Product_detail::create([
	        		'product_id'	=>	$product->id,
	        		'sku_code'		=>	'LAR'.time().rand(10, 99),
	        		'ship_charge'	=>	number_format(rand(20, 150), 2),
	        		'ship_time'		=>	rand(1, 10),
	        		'description'	=>	$faker->paragraph($nbSentences = rand(10, 20), $variableNbSentences = true),
	        		'm_title'		=>	$name,
	        		'm_keywords'	=>	$faker->sentence($nbWords = rand(8, 20), $variableNbWords = true),
	        		'm_description'	=>	$faker->sentence($nbWords = rand(8, 20), $variableNbWords = true),
	        	]);

	        	# add some variants to product
	        	$attributes = Attribute::with(['attr_options' => function($query){
	        		$query->inRandomOrder();
	        		$query->limit(rand(4, 8));
	        	}])->inRandomOrder()->limit(rand(0, 3))->get()->all();
	        	foreach ($attributes as $attribute) {

	        		$product_attr = Product_attr::create([
	        			'product_id'	=>	$product->id,
	        			'attribute_id'	=>	$attribute->id,
	        		]);

	        		foreach ($attribute->attr_options as $attr_option) {
	        			Product_option::create([
	        				'product_id'		=>	$product->id,
	        				'attribute_id'	   	=>	$attr_option->attribute_id,
	        				'product_attr_id' 	=>	$product_attr->id,
	        				'attr_option_id' 	=>	$attr_option->id,
	        				'price'			   	=>	rand(-100, 100),
	        				'stock'		       	=>	rand(50, 100),
	        			]);
	        		}
	        	}

	        	#	adding some images
	        	for($i=0; $i<=rand(3, 6); $i++){
	        		$image = '/dump_products/product-'.rand(1, 44).'.jpg';

	        		Product_image::create([
	        			'product_id'	=>	$product->id,
	        			'image_lg'		=>	$image,
	        			'image_md'		=>	$image,
	        			'image_sm'		=>	$image,
	        			'title'			=>	$name,
	        			'primary_img'	=>	false
	        		]);
	        	}
	        	# make an image as primary
	        	Product_image::where('product_id', $product->id)
	        					->first()
	        					->update(['primary_img' => true]);

	        	Discount_product::create(['product_id' => $product->id]);
        	}
        }
    }
}

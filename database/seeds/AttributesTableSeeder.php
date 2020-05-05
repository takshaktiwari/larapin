<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Attribute;
use App\Attr_option;

class AttributesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        Attribute::truncate();
        Attr_option::truncate();

        $name = 'Colors';
        $slug = str_replace(' ', '-', strtolower(trim($name)));
        $slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug);
        $attribute = Attribute::create([
						        	'attribute'	=>	$name,
						        	'slug'		=>	$slug
						        ]);

        for($i=0; $i<=10; $i++){
        	$name = $faker->colorName;
        	$slug = str_replace(' ', '-', strtolower(trim($name)));
        	$slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug);
        	Attr_option::create([
        		'attr_option'	=>	$name,
        		'attribute_id'	=>	$attribute->id,
        		'slug'			=>	$slug
        	]);
        }

        #	2nd attribute and options
        $name = 'Size';
        $slug = str_replace(' ', '-', strtolower(trim($name)));
        $slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug);
        $attribute = Attribute::create([
						        	'attribute'	=>	$name,
						        	'slug'		=>	$slug
						        ]);
        $attrs = ['Extra Small', 'Small', 'Medium', 'Large', 'Extra Large'];
        foreach($attrs as $attr){
        	$name = $attr;
        	$slug = str_replace(' ', '-', strtolower(trim($name)));
        	$slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug);
        	Attr_option::create([
        		'attr_option'	=>	$name,
        		'attribute_id'	=>	$attribute->id,
        		'slug'			=>	$slug
        	]);
        }


        #	3rd attribute and options
        $name = 'Lenght';
        $slug = str_replace(' ', '-', strtolower(trim($name)));
        $slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug);
        $attribute = Attribute::create([
						        	'attribute'	=>	$name,
						        	'slug'		=>	$slug
						        ]);
        for($i=0; $i<=10; $i++){
        	$name = rand(1, 20).' Ft. - '.rand(1, 12).' In.';
        	$slug = str_replace(' ', '-', strtolower(trim($name)));
        	$slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug);
        	Attr_option::create([
        		'attr_option'	=>	$name,
        		'attribute_id'	=>	$attribute->id,
        		'slug'			=>	$slug
        	]);
        }


        #	4rd attribute and options
        $name = 'Material';
        $slug = str_replace(' ', '-', strtolower(trim($name)));
        $slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug);
        $attribute = Attribute::create([
						        	'attribute'	=>	$name,
						        	'slug'		=>	$slug
						        ]);
        for($i=0; $i<=10; $i++){
        	$name = $faker->sentence($nbWords = rand(1, 3), $variableNbWords = true);
        	$slug = str_replace(' ', '-', strtolower(trim($name)));
        	$slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug);
        	Attr_option::create([
        		'attr_option'	=>	$name,
        		'attribute_id'	=>	$attribute->id,
        		'slug'			=>	$slug
        	]);
        }
    }
}

<?php

namespace App\Imports;

use Exception;
use App\Brand;
use App\Product;
use App\Product_detail;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProductsImport implements ToModel, WithBatchInserts, WithHeadingRow, ShouldQueue
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        echo "<pre>";
        print_r ($row);
        echo "</pre>";
        die();
        
        $product_name = $row['product_name'];
        $slug = str_replace(' ', '-', strtolower(trim($product_name)));
        $slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug);

        $brand_id   = null;
        $in_offer   = false;
        $featured   = false;
        $status     = false;

        if (!empty(trim($row['brand']))) {
            if (is_numeric(trim($row['brand']))) {
                $brand_id = $row['brand'];
            }else{
                $brand = Brand::where('brand', trim($row['brand']))->first();
                if ($brand) {
                    $brand_id = $brand->id;
                }
            }
        }

        if (strtolower(trim($row['in_offer'])) == 'yes') {
            $in_offer = true;
        }
        if (strtolower(trim($row['featured'])) == 'yes') {
            $in_offer = true;
        }
        if (strtolower(trim($row['status'])) == 'active') {
            $in_offer = true;
        }


        $product =  Product::updateOrcreate(
                        ['product_name'     =>  $product_name],

                        ['subtitle'         =>  $row['subtitle'],
                        'base_price'        =>  $row['price'],
                        'base_stock'        =>  $row['stock'],
                        'product_tags'      =>  $row['product_tags'],
                        'brand_id'          =>  $brand_id,
                        'in_offer'          =>  $in_offer,
                        'featured'          =>  $featured,
                        'status'            =>  $status,
                        'slug'              =>  $slug,
                        'short_description' =>  $row['short_description'] ]
                    );
     
        Product_detail::updateOrcreate(
            ['product_id'   =>  $product->id],

            ['sku_code'     =>  $row['sku_code'],
            'ship_charge'   =>  $row['ship_charge'],
            'ship_time'     =>  $row['ship_time'],
            'description'   =>  $row['description'],
            'm_title'       =>  $row['meta_title'],
            'm_keywords'    =>  $row['meta_keywords'],
            'm_description' =>  $row['meta_description'] ]
        );
    }

    public function batchSize(): int
    {
        return 100;
    }
    
}

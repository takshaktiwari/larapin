<?php

namespace App\Exports;

use Date;
use App\Product;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProductsExport implements FromQuery, WithMapping, WithHeadings, ShouldQueue
{
    use Exportable;

    public function headings(): array
    {
        return [
            'Product Name',
            'Categories',
            'Base Price',
            'Base Stock',
            'Brand',
            'In Offer',
            'Featured',
            'Status',
            'Created At',
            'Updated At',
            'SKU Code',
            'Ship Charge',
            'Ship Time',
            'Subtitle',
            'Short Description',
            'Description',
            'Meta title',
            'Meta keywords',
            'Meta description',
            'Product Tags',
            'Product Images',
            'Product Options'
        ];
    }

    public function query()
    {
        return Product::query();
    }

    public function map($product): array
    {
        $categories = '';
        foreach ($product->categories as $category) {
            $categories .= $category->category.' | ';
        }

    	$brand = '';
    	if (isset($product->brand->brand)) {
    		$brand = $product->brand->brand;
    	}

    	$product_images = '';
    	foreach ($product->images as $image) {
    		$product_images .= $image->image_lg.' | ';
    	}

    	$product_options = '';
    	foreach ($product->product_options as $option) {
    		$product_options .= ' ('.$option->attr_option->attr_option;
    		$product_options .= '-Qty:'.$option->stock.'-Price:'.$option->price.') ';
    	}

        return  [
            $product->product_name,
            $categories,
            $product->base_price,
            $product->base_stock,
            $brand,
            $product->in_offer,
            $product->featured,
            $product->status,
            date('d-M-Y h:i A', strtotime($product->created_at)),
            date('d-M-Y h:i A', strtotime($product->created_at)),
            $product->details->sku_code,
            $product->details->ship_charge,
            $product->details->ship_time,
            $product->subtitle,
            $product->short_description,
            $product->details->description,
            $product->details->m_title,
            $product->details->m_keywords,
            $product->details->m_description,
            $product->product_tags,
            $product_images,
            $product_options,
        ];

    }

}

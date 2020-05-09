<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ProductImageResource;
use App\Http\Resources\ProductDetailResource;
use App\Http\Resources\ProductAttrResource;
use App\Http\Resources\ProductReviewResource;
use App\Http\Resources\DiscountResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'            =>  $this->id,
            'product_name'  =>  $this->product_name,
            'subtitle'      =>  $this->subtitle,
            'base_price'    =>  $this->base_price,
            'base_stock'    =>  $this->base_stock,
            'discount'      =>  new DiscountResource($this->discount),
            'rating'        =>  number_format($this->reviews->avg('rating'), 1),
            'reviews'       =>  $this->reviews->count(),
            'featured'      =>  $this->featured,
            'slug'          =>  $this->slug,
            'product_tags'  =>  $this->product_tags,
            'short_description' =>  $this->short_description,
            'product_detail'    =>  new ProductDetailResource($this->details),
            'product_variants'  =>  ProductAttrResource::collection($this->product_attrs),
            'product_images'    =>  ProductImageResource::collection($this->images),
        ];
    }
}

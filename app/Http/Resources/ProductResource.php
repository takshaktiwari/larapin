<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ProductImageResource;
use App\Http\Resources\ProductDetailResource;
use App\Http\Resources\ProductVariantResource;
use App\Http\Resources\ProductReviewResource;

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
            'base_discount' =>  $this->base_discount,
            'base_stock'    =>  $this->base_stock,
            'rating'        =>  number_format($this->reviews->avg('rating'), 1),
            'reviews'       =>  $this->reviews->count(),
            'featured'      =>  $this->featured,
            'slug'          =>  $this->slug,
            'product_tags'  =>  $this->product_tags,
            'short_description' =>  $this->short_description,
            'product_detail'    =>  new ProductDetailResource($this->details),
            'product_variants'  =>  ProductVariantResource::collection($this->variants),
            'product_images'    =>  ProductImageResource::collection($this->images)
        ];
    }
}

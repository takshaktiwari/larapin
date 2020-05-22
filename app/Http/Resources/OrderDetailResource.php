<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\OrderProductsResource;
use App\Http\Resources\OrderHistoryResource;
use App\Http\Resources\ShippingSlotResource;

class OrderDetailResource extends JsonResource
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
            'id'                =>  $this->id,
            'user_id'           =>  $this->user_id,
            'user_address_id'   =>  $this->user_address_id,
            'subtotal_price'    =>  $this->subtotal_price,
            'discount_price'    =>  $this->discount_price,
            'shipping_charge'   =>  $this->shipping_charge,
            'total_products'    =>  $this->order_products->count(),
            'coupon_id'         =>  $this->coupon_id,
            'order_note'        =>  $this->order_note,
            'payment_method'    =>  $this->payment_method,
            'payment_status'    =>  $this->payment_status,
            'order_status'      =>  $this->order_status,
            'addr_name'         =>  $this->addr_name,
            'addr_email'        =>  $this->addr_email,
            'addr_mobile'       =>  $this->addr_mobile,
            'addr_landmark'     =>  $this->addr_landmark,
            'addr_line1'        =>  $this->addr_line1,
            'addr_line2'        =>  $this->addr_line2,
            'addr_country'      =>  $this->addr_country,
            'addr_state'        =>  $this->addr_state,
            'addr_district'     =>  $this->addr_district,
            'addr_pincode'      =>  $this->addr_pincode,
            'addr_location'     =>  $this->addr_location,
            'pincode_id'        =>  $this->pincode_id,
            'created_at'        =>  $this->created_at,
            'order_products'    =>  OrderProductsResource::collection($this->order_products),
            'order_history'     =>  OrderHistoryResource::collection($this->order_histories),
            'shipping_slot'     =>  new ShippingSlotResource($this->shipping_slot)
        ];
    }
}

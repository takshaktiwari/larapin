<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SliderResource extends JsonResource
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
            'id'        =>  $this->id,
            'image_sm'  =>  url('storage').$this->image_sm,
            'image_md'  =>  url('storage').$this->image_md,
            'image_lg'  =>  url('storage').$this->image_lg,
            'title'     =>  $this->title,
            'caption'   =>  $this->caption,
            'set_order' =>  $this->set_order,
            'status'    =>  $this->status,
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

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
//        return array_merge(parent::toArray($request), [
//        	'price' => $this->formattedPrice,
//            'variations' => ProductVariationResource::collection(
//				$this->variations
//			)->collection->groupBy('type.name')
//        ]);
    }
}

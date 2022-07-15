<?php

namespace App\Http\Resources;

use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * @param Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'barcode' => $this->barcode,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'category' => $this->category->name,
            'unit' => $this->unit->name,
            'price' => [
                'raw' => $this->price,
                'formatted' => 'Rp. ' . Helper::rupiahFormat($this->price) . ',-',
            ],
            'stock' => $this->stock,
            'picture' => $this->picture ? $this->product_picture : null,
        ];
    }
}

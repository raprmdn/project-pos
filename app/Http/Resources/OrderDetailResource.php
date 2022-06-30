<?php

namespace App\Http\Resources;

use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderDetailResource extends JsonResource
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
            'supplier' => $this->whenLoaded('supplier', function () {
                return $this->supplier->name ?? null;
            }),
            'invoice' => $this->invoice,
            'total_items' => $this->total_items,
            'total' => [
                'raw' => $this->total,
                'formatted' => Helper::rupiahFormat($this->total)
            ],
            'notes' => $this->notes,
            'status' => $this->status,
            'order_date' => $this->created_at->format('d F Y, H:i'),
        ];
    }
}

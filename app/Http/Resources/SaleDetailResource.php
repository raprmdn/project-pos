<?php

namespace App\Http\Resources;

use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SaleDetailResource extends JsonResource
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
            'cashier' => $this->whenLoaded('user', function () {
                return $this->user->name;
            }),
            'invoice' => $this->invoice,
            'total_items' => $this->total_items,
            'subtotal' => [
                'raw' => $this->subtotal,
                'formatted' => Helper::rupiahFormat($this->subtotal)
            ],
            'discount' => $this->discount,
            'saved' => [
                'raw' => $this->saved,
                'formatted' => Helper::rupiahFormat($this->saved)
            ],
            'total' => [
                'raw' => $this->total,
                'formatted' => Helper::rupiahFormat($this->total)
            ],
            'received' => [
                'raw' => $this->received,
                'formatted' => Helper::rupiahFormat($this->received)
            ],
            'change' => [
                'raw' => $this->change,
                'formatted' => Helper::rupiahFormat($this->change)
            ],
            'notes' => $this->notes,
            'status' => $this->status,
            'transaction_date' => $this->created_at->format('d F Y, H:i'),
        ];
    }
}

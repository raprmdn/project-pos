<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TransactionService
{
    public function createTransaction(): \Illuminate\Database\Eloquent\Model
    {
        $invoice = 'TRX' . date('Ymd') . Str::upper(Str::random(4));
        $uuid = Str::uuid();
        return auth()->user()->sales()->create([
            'invoice' => $invoice,
            'uuid' => $uuid,
        ]);
    }

    public function saveTransaction($sale, $notes)
    {
        return tap($sale)->update([
            'notes' => $notes,
            'status' => 'completed',
        ]);
    }

    public function addProduct($sale, $product): void
    {
        DB::transaction(function () use ($sale, $product){
            // Check if product already exist in sale_details
            if ($sale->sale_details()->where('product_id', $product->id)->exists()) {
                $sale->sale_details()->where('product_id', $product->id)->increment('qty', + 1);
                $sale->sale_details()->where('product_id', $product->id)->update([
                    'total' => $product->price * $sale->sale_details()->where('product_id', $product->id)->first()->qty,
                ]);
            } else {
                $sale->sale_details()->create([
                    'product_id' => $product->id,
                    'unit_price' => $product->price,
                    'qty' => 1,
                    'total' => $product->price,
                ]);
            }

            $this->_extracted($sale);

            $product->update([
                'stock' => $product->stock - 1,
            ]);
        });
    }

    public function updateProduct($sale, $product, $saleDetail, $qtyRequest): void
    {
        DB::transaction(function () use ($sale, $product, $saleDetail, $qtyRequest) {
            if ($qtyRequest < $saleDetail->qty) {
                $product->update([
                    'stock' => $product->stock + ($saleDetail->qty - $qtyRequest),
                ]);
            } else {
                $diffQty = $qtyRequest - $saleDetail->qty;
                $product->update([
                    'stock' => $product->stock - $diffQty,
                ]);
            }

            $saleDetail->update([
                'qty' => $qtyRequest,
                'total' => $product->price * $qtyRequest,
            ]);

            $this->_extracted($sale);
        });
    }

    public function deleteProduct($sale, $product, $saleDetail): void
    {
        DB::transaction(function () use ($sale, $product, $saleDetail) {
            $product->update([
                'stock' => $product->stock + $saleDetail->qty,
            ]);

            $saleDetail->delete();

            $this->_extracted($sale);
        });
    }

    public function applyDiscount($sale, $discount): void
    {
        $saving = $sale->subtotal * $discount / 100;
        $total = $sale->subtotal - $saving;
        $change = $sale->received ? $sale->received - $total : 0;

        $sale->update([
            'discount' => $discount,
            'total' => $total,
            'saved' => $saving,
            'change' => $change,
        ]);
    }

    public function applyCash($sale, $cash): void
    {
        $change = $cash - $sale->total;
        $sale->update([
            'received' => $cash,
            'change' => $change,
        ]);
    }

    public function resetTransaction($sale): void
    {
        $sale->sale_details()->get()->each(function ($saleDetail) {
            $product = Product::find($saleDetail->product_id);
            $product->update([
                'stock' => $product->stock + $saleDetail->qty,
            ]);
        });

        $sale->update([
            'total_items' => 0,
            'subtotal' => 0,
            'discount' => 0,
            'saved' => 0,
            'total' => 0,
            'received' => 0,
            'change' => 0,
        ]);

        $sale->sale_details()->delete();
    }

    public function cancelTransaction($sale): void
    {
        $sale->sale_details()->get()->each(function ($saleDetail) {
            $product = Product::find($saleDetail->product_id);
            $product->update([
                'stock' => $product->stock + $saleDetail->qty,
            ]);
        });

        $sale->sale_details()->delete();
        $sale->delete();
    }

    private function _extracted($sale): void
    {
        $totalPriceInSaleDetails = $sale->sale_details()->sum('total');
        $totalQtyInSaleDetails = $sale->sale_details()->sum('qty');
        $discount = $sale->discount;
        $saving = $totalPriceInSaleDetails * $discount / 100;
        $total = $totalPriceInSaleDetails - $saving;
        $change = $sale->received ? $sale->received - $total : 0;

        $sale->update([
            'total_items' => $totalQtyInSaleDetails,
            'subtotal' => $totalPriceInSaleDetails,
            'total' => $total,
            'saved' => $saving,
            'change' => $change
        ]);
    }
}

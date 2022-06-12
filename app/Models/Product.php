<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function sale_details()
    {
        return $this->hasMany(SaleDetail::class);
    }
    public function order_product_details()
    {
        return $this->hasMany(OrderProductDetail::class);
    }
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

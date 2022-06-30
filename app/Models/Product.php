<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    use HasFactory;
    protected $guarded = ['id'];
    protected $appends = ['product_picture'];

    public function getProductPictureAttribute(): string
    {
        return "/storage/" . $this->picture;
    }

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

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];
    public function order_product()
    {
        return $this->hasMany(OrderProduct::class);
    }
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}

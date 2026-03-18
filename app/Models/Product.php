<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable = 
    ['name',
    'slug',
    'category_id',
    'short_description',
    'description',
    'image',
    'regular_price',
    'sale_price',
    'SKU',
    'quantity',
    'stock_status',
    'featured',
    'style_id',
    'sla_days',
    'supplier_cost',
    'weight',
    'hsn_code',
    'gst_percentage',
     ];



    public function categoryRel(): BelongsTo // ફંક્શનનું નામ અને relationship() નું નામ સરખું હોવું જોઈએ
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            if (empty($product->SKU)) {
                $product->SKU = 'RS-' . strtoupper(uniqid());
            }
        });
    }
}

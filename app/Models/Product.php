<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;
    protected $primaryKey = 'product_id';
    public $incrementing = true;

    protected $fillable = [
        'category_id',
        'manufacturer_id',
        'product_name',
        'product_image',
        'product_price',
        'warranty_period',
        'product_quantity'   
    ];
    public function categories()
{
    return $this->belongsToMany(Category::class, 'category_product');
}
    public function manufacturer() : BelongsTo 
    {
        return $this->belongsTo(Manufacturer::class);
    }
}

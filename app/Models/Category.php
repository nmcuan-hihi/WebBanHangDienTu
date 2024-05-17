<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    
    protected $table = 'category';
    protected $primaryKey = 'category_id';
    public $incrementing = true;

    protected $fillable = [
        'category_name',    
    ];
    public function products()
    {
        return $this->belongsToMany(Product::class, 'category_product');
    }
}

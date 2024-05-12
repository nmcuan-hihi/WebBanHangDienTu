<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Manufacturer extends Model
{
    use HasFactory;

    protected $table = 'manufacturer';
    protected $primaryKey = 'manufacturer_id';
    public $incrementing = true;

    protected $fillable = [
        'manufacturer_name',
        'manufacturer_phone',
        'manufacturer_email',        
    ];
     /**
     * Relationship
     * @return HasMany
     */
    public function product() : HasMany 
    {
        return $this->hasMany(product::class, 'manufacturer_id', 'manufacturer_id');
    }
}

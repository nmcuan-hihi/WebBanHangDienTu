<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InvoiceDetail extends Model
{
    use HasFactory;
    protected $primaryKey = 'invoice_details_id';
    public $incrementing = true;

    protected $fillable = [
        'invoice_id',
        'product_id',        
        'invoice_details_quantity',  
    ];

    public function invoice() : BelongsTo 
    {
        return $this->belongsTo(Invoice::class);
    }
    public function product()
{
    return $this->belongsTo(Product::class, 'product_id'); // Giả sử 'product_id' là khóa ngoại trong InvoiceDetail
}
}

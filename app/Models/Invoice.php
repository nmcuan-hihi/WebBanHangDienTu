<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{
    use HasFactory;
    protected $primaryKey = 'invoice_id';
    public $incrementing = true;
    protected $table = 'invoice';
    protected $fillable = [
        'user_id',
        'total_amount',
        'invoice_payment',  
    ];
    public function user() : BelongsTo 
    {
        return $this->belongsTo(User::class);
    }
    public function invoiceDetail(): HasMany
    {
        return $this->hasMany(InvoiceDetail::class, 'invoice_id', 'invoice_id');
    }
}

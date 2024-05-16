<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{
    use HasFactory;
    protected $table = 'invoice';
    protected $primaryKey = 'invoice_id';
    public $incrementing = true;

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
    public function userProfile()
    {
        return $this->hasOne(UserProfile::class, 'user_id');
    }
}

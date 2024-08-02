<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;

    protected $fillable = ['order_no', 'order_id', 'purchaseorder_date'];

    protected $casts = [
        'purchaseorder_date' => 'datetime',
    ];

    public function details()
    {
        return $this->belongsTo(PurchaseDetails::class, 'order_id');
    }
    public function purchaseDetails()
    {
        return $this->hasMany(PurchaseDetails::class, 'order_id');
    }
}

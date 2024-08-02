<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'address', 'phone'];

    public function purchaseDetails()
    {
        return $this->hasMany(PurchaseDetails::class, 'provider_id');
    }
}

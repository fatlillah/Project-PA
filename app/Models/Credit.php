<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function creditOrder()
    {
        return $this->belongsTo(Completed_order::class, 'credit_order_id');
    }

    public function tenor()
    {
        return $this->belongsTo(Tenor::class, 'tenor_id');
    }

    public function creditPay()
    {
        return $this->hasMany(Credit_payment::class, 'credit_id');
    }
}

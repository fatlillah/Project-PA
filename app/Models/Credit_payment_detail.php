<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credit_payment_detail extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function creditPay()
    {
        return $this->belongsTo(Credit_payment::class, 'credit_pay_id');
    }
}

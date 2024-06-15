<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credit_payment extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function credit()
    {
        return $this->belongsTo(Credit::class, 'credit_id');
    }

    public function creditPayDetail()
    {
        return $this->hasMany(Credit_payment_detail::class, 'credit_pay_id');
    }
}

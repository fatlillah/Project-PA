<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cash_payment extends Model
{
    use HasFactory;
    public function cashOrder()
    {
        return $this->belongsTo(Completed_order::class, 'cash_order_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

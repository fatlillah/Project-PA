<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Completed_order extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function order()
    {
        return $this->belongsTo(Order::class, 'completed_order_id');
    }

    public function credit()
    {
        return $this->hasOne(Credit::class, 'credit_order_id');
    }
}

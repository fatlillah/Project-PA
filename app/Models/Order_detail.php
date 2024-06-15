<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_detail extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function detail_size()
    {
        return $this->belongsTo(Order_detail_size::class, 'order_detail_size_id');
    }
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}

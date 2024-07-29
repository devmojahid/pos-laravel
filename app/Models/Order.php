<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['order_number', 'total', 'sub_total', 'tax_amount', 'discount', 'item_count'];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariationAttribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'variation_id',
        'name',
        'value',
    ];

    public function variation()
    {
        return $this->belongsTo(ProductVariation::class);
    }
}

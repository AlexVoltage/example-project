<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    use HasFactory;

    protected $table = 'product_types';

    protected $fillable = ['name', 'goods_types_id'];

    public function sparePartType()
    {
        return $this->hasMany(SparePartType::class, 'product_types_id');
    }
}

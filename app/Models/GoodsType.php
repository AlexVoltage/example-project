<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoodsType extends Model
{
    use HasFactory;

    protected $table = 'goods_types';

    protected $fillable = ['name'];

    public function productType()
    {
        return $this->hasMany(ProductType::class, 'goods_types_id');
    }
}

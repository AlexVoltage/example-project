<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryRelation extends Model
{
    use HasFactory;

    protected $table = 'avito_category_relations';

    protected $fillable = ['menuId', 'GoodsType', 'ProductType', 'SparePartType', 'TransmissionSparePartType', 'TechnicSparePartType', 'EngineSparePartType', 'BodySparePartType', 'DeviceType'];
}

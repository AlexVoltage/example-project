<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CategoryRelation;

class CityCategory extends Model
{
    use HasFactory;

    protected $table = 'avito_city_categories';

    protected $fillable = ['city_id', 'menuId', 'name'];

    public function menuRelations()
    {
        return $this->hasMany(CategoryRelation::class, 'menuId', 'menuId');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MenuRelation;

class CityMenu extends Model
{
    use HasFactory;

    protected $fillable = ['city_id', 'menuId', 'name'];
    public function menuRelations()
    {
        return $this->hasMany(MenuRelation::class, 'menuId', 'menuId');
    }
}

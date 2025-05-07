<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CityMenu;

class City extends Model
{
    use HasFactory;

    protected $table = 'city_list';

    protected $fillable = ['region', 'token', 'phone', 'address', 'prefix'];

    public function cityMenus()
    {
        return $this->hasMany(CityMenu::class, 'city_id', 'id');
    }
}

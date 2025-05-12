<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CityCategory;

class City extends Model
{
    use HasFactory;

    protected $table = 'avito_city_list';

    protected $fillable = ['region', 'token', 'phone', 'address', 'prefix', 'counterparty'];

    public function cityMenus()
    {
        return $this->hasMany(CityCategory::class, 'city_id', 'id');
    }
}

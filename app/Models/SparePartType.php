<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SparePartType extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'product_types_id'];
}

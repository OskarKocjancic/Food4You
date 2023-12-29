<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;
    protected $table = "restaurants";
    protected $fillable = [
        'api_id',
        'name',
        'address',
        'phone',
        'rating',
        'price',
        'vegan',
        'vegetarian',
        'halal',
        'kosher',
        'glutenFree',
        'studentDiscount'
    ];
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

}
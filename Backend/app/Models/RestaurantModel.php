<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RestaurantModel extends Model
{
    protected $table = 'restaurants';
    protected $primaryKey = 'restaurant_id';
    protected $fillable = [
        'restaurant_name',
        'restaurant_description',
        'restaurant_cuisine',
        'restaurant_address',
        'restaurant_phone',
        'restaurant_image',
    ];
    public function menus()
    {
        return $this->hasMany(MenuModel::class, 'restaurant_id', 'restaurant_id');
    }
    public function reviews()
    {
        return $this->hasMany(ReviewModel::class, 'restaurant_id', 'restaurant_id');
    }
}

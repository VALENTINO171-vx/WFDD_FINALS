<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuModel extends Model
{
    protected $table = 'menus';    
    protected $primaryKey = 'menu_id';
    protected $fillable = [
        'restaurant_id',
        'name',
        'description',
        'price',
    ];
    public function restaurant()
    {
        return $this->belongsTo(RestaurantModel::class, 'restaurant_id', 'restaurant_id');
    }
}

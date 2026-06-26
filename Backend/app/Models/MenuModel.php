<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuModel extends Model
{
    protected $table = 'menu_items';
    protected $primaryKey = 'menu_item_id';
    protected $fillable = [
        'restaurant_id',
        'menu_item_name',
        'menu_item_description',
        'menu_item_price',
        'menu_item_available',
        'menu_item_category',
    ];

    public function restaurant()
    {
        return $this->belongsTo(RestaurantModel::class, 'restaurant_id', 'restaurant_id');
    }
}

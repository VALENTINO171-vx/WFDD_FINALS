<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReviewModel extends Model
{
    protected $table = 'reviews';
    protected $primaryKey = 'review_id';
    protected $fillable = [
        'user_id',
        'restaurant_id',
        'review_rating',
        'review_comment',
    ];
    public function user()
    {
        return $this->belongsTo(UserModel::class, 'user_id', 'user_id');
    }
    public function restaurant()
    {
        return $this->belongsTo(RestaurantModel::class, 'restaurant_id', 'restaurant_id');
    }
}

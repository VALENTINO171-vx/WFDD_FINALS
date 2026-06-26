<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    //
    protected $table = 'users';
    protected $primaryKey = 'user_id';
    protected $fillable = [
        'user_name',
        'user_email',
        'user_password',
        'user_role',
        'blacklist',
    ];
    public function reviews()
    {
        return $this->hasMany(ReviewModel::class, 'user_id', 'user_id');
    }
}

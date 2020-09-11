<?php

namespace App\Models;

use App\Traits\CanFetchDatatable;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use CanFetchDatatable;

    protected static $validFields = ['id', 'code', 'phone', 'birth', 'gender', 'user_id'];
    protected static $bothLikeFields = ['code', 'phone'];
    protected static $numberFields = ['id'];
    protected static $withRelationships = ['user'];
    protected static $relationSearchField = [
        'user' => ['image', 'name', 'email'],
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function classes()
    {
        return $this->hasMany(Classes::class);
    }
}

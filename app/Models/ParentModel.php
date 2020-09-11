<?php

namespace App\Models;

use App\Traits\CanFetchDatatable;
use App\User;
use Illuminate\Database\Eloquent\Model;

class ParentModel extends Model
{
    protected $table = 'parents';
    use CanFetchDatatable;

    protected static $validFields = ['id', 'code', 'phone', 'email', 'user_id'];
    protected static $bothLikeFields = ['code', 'phone', 'email'];
    protected static $numberFields = ['id'];
    protected static $withRelationships = ['user'];
    protected static $relationSearchField = [
        'user' => ['image', 'name', 'email'],
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function student()
    {
        return $this->hasOne(Student::class, 'parent_id', 'id');
    }
}

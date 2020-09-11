<?php

namespace App\Models;

use App\Traits\CanFetchDatatable;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use CanFetchDatatable;

    protected static $validFields = ['id', 'name', 'birth', 'parent_id', 'gender'];
    protected static $bothLikeFields = ['code', 'name', 'birth'];
    protected static $numberFields = ['id', 'parent_id'];
    protected static $withRelationships = ['parent'];
    protected static $relationSearchField = [
        'parent' => ['email'],
    ];

    public function parent()
    {
        return $this->belongsTo(ParentModel::class,'parent_id');
    }

    public function classes()
    {
        return $this->belongsToMany(Classes::class, 'class_students', 'student_id','class_id');
    }
}

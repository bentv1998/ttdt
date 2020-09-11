<?php

namespace App\Models;

use App\Traits\CanFetchDatatable;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use CanFetchDatatable;

    protected $table = "classes";

    protected static $validFields = ['id', 'code', 'name', 'schedule_id', 'teacher_id', 'tuition'];
    protected static $bothLikeFields = ['code', 'name'];
    protected static $exactMatchFields = ['schedule.name', 'teacher.name'];
    protected static $numberFields = ['id'];
    protected static $withRelationships = ['schedule', 'teacher'];
    protected static $relationSearchField = [
        'schedule' => ['name'],
        'teacher' => ['name'],
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'class_students');
    }

//    public function tests()
//    {
//        return $this->HasMany(Test::class, 'class_id', 'id')->orderByDesc('id');
//    }

}

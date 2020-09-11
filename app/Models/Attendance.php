<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id','id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'attendance_id','id');
    }
}

<?php

namespace App\Models;

use App\Models\Classes;
use App\Traits\CanFetchDatatable;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use CanFetchDatatable;

    protected static $validFields = ['id', 'time', 'name', 'day'];
    protected static $bothLikeFields = ['code', 'name'];
    protected static $exactMatchFields = ['schedule.name', 'teacher.name'];
    protected static $numberFields = ['id'];

    const DAY_OF_WEEK = [
        -1 => 'Chủ nhật',
        0 => 'Thứ 2',
        1 => 'Thứ 3',
        2 => 'Thứ 4',
        3 => 'Thứ 5',
        4 => 'Thứ 6',
        5 => 'Thứ 7'
    ];

    public function classes()
    {
        return $this->hasMany(Classes::class);
    }
}

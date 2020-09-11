<?php

namespace App\Models;

use App\Traits\CanFetchDatatable;
use Illuminate\Database\Eloquent\Model;

class Mail extends Model
{
    use CanFetchDatatable;

    protected static $validFields = ['id', 'key', 'header', 'body'];
    protected static $bothLikeFields = ['key'];
    protected static $numberFields = ['id'];
}

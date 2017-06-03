<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TNDepartment extends Model
{
    protected $fillable = [
        "department", "description", "keywords", "name", "seq", "title",
    ];
}

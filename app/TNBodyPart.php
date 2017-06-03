<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TNBodyPart extends Model
{
    protected $fillable = [
        "place", "description", "keywords", "name", "seq", "title",
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TNHostpital extends Model
{
//    protected $table = "diaries";
    protected $fillable = [
        'name', 'address', 'area', 'level', 'mtype', 'url','x', 'y', 'zipcode', 'fax', 'gobus', 'img',
        'mail', 'nature', 'rcount', 'tel', 'fcount', 'count', 'message',
    ];

}

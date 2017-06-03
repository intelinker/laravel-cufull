<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TNMedicine extends Model
{
    protected $fillable = [
        'name', 'description', 'price', 'keywords', 'type', 'url','tag', 'status', 'img',
        'rcount', 'fcount', 'count', 'message',
    ];
}

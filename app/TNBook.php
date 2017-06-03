<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TNBook extends Model
{
    protected $fillable = [
        'author', 'name', 'bookclass', 'img', 'count', 'fcount', 'rcount', 'status', 'summary',
    ];
}

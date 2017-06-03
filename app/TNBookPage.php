<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TNBookPage extends Model
{
    protected $fillable = [
        'book', 'message', 'seq', 'title',
    ];
}

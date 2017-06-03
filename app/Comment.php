<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'diary_id', 'published', 'content', 'created_by', 'updated_by',
    ];

    public function user() {
        return $this->belongsTo('App\User', 'created_by');
    }

    public function diary() {
        return $this->belongsTo('App\Diary', 'diary_id');
    }

}

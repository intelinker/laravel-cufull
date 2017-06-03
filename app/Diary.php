<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Diary extends Model
{
    use Notifiable;

//    protected $table = "diaries";

    protected $fillable = [
        'title', 'description', 'content', 'avatar', 'created_by', 'updated_by',
    ];

//    public function lists() {
//        return Diary::all();
//    }

    public function user() {
        return $this->belongsTo('App\User', 'created_by');
    }

    public function comments() {
        return $this->hasMany('App\Comment');
    }
}

<?php

namespace App\Notes;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $with = ['user'];
    protected $visible = ['id', 'title', 'content', 'created_at'];
    protected $excerptLength = 10;

    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }
}

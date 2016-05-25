<?php

namespace App\Notes;

use App\Tags\Tag;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $with = ['user', 'tags'];
    protected $visible = ['id', 'title', 'content', 'created_at'];
    protected $excerptLength = 10;

    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}

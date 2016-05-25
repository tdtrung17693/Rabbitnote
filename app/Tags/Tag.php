<?php

namespace App\Tags;

use App\Notes\Note;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $with = ['notes'];
    protected $visible = ['id', 'slug', 'data'];

    public function notes()
    {
        return $this->belongsToMany(Note::class);
    }
}

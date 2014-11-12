<?php

class Album extends BaseModel
{
    protected $fillable = ['title', 'description'];

    public function photos()
    {
        return $this->hasMany('Photo');
    }

    public function getSearchableUri()
    {
        return route('albums_show', [$this->id], false);
    }
}

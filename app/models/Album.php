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
        return route('photos_index', [$this->id], false);
    }
}

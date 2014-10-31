<?php

class Album extends Eloquent
{
    protected $fillable = ['title', 'description'];

    public function photos()
    {
        return $this->hasMany('Photo');
    }
}

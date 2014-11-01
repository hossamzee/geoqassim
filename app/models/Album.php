<?php

class Album extends Eloquent
{
    protected $fillable = ['title', 'description'];

    public function photos()
    {
        return $this->hasMany('Photo');
    }

    // TODO: Delete every photo related to the desired album to be deleted.
}

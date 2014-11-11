<?php

class Album extends BaseModel
{
    protected $fillable = ['title', 'description'];

    public function photos()
    {
        return $this->hasMany('Photo');
    }

    // TODO: Delete every photo related to the desired album to be deleted.
}

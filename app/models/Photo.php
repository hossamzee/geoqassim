<?php

class Photo extends Eloquent
{
    protected $fillable = ['title', 'description'];

    public function album()
    {
        return $this->belongsTo('Album');
    }
}

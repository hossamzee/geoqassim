<?php

class Photo extends BaseModel
{
    const PHOTOS_PER_PAGE = 6;

    protected $fillable = ['title', 'description'];

    public function album()
    {
        return $this->belongsTo('Album');
    }
}

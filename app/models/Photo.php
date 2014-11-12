<?php

class Photo extends BaseModel
{
    const PHOTOS_PER_PAGE = 6;

    protected $fillable = ['title', 'description'];

    public function album()
    {
        return $this->belongsTo('Album');
    }

    public function getSearchableUrl()
    {
        return route('photos_show', [$this->album_id, $this->id]);
    }
}

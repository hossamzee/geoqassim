<?php

class Photo extends BaseModel
{
    const PHOTO_WIDTH = 165;

    const PHOTOS_PER_PAGE = 6;

    protected $fillable = ['title', 'description'];

    public function album()
    {
        return $this->belongsTo('Album');
    }

    public function getSearchableUri()
    {
        return route('photos_show', [$this->album_id, $this->id], false);
    }
}

<?php

class Research extends BaseModel
{
    const PHOTO_WIDTH = 100;

    protected $fillable = ['title', 'author'];

    public function getSearchableUri()
    {
        return route('researches_show', [$this->id], false);
    }
}

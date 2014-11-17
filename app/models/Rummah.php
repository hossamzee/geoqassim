<?php

class Rummah extends BaseModel
{
    const PHOTO_WIDTH = 100;

    protected $fillable = ['title', 'description'];

    public function getSearchableUri()
    {
        return route('rummahs_show', [$this->id], false);
    }
}

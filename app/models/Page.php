<?php

class Page extends BaseModel
{
    protected $fillable = ['title', 'content'];

    public function getSearchableUri()
    {
        return route('pages_show', [$this->id], false);
    }
}

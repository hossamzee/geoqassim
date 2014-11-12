<?php

class Page extends BaseModel
{
    protected $fillable = ['title', 'content'];

    public function getSearchableUrl()
    {
        return route('pages_show', [$this->id]);
    }
}

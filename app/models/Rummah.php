<?php

class Rummah extends BaseModel
{
    protected $fillable = ['title', 'description'];

    public function getSearchableUrl()
    {
        return route('rummahs_show', [$this->id]);
    }
}

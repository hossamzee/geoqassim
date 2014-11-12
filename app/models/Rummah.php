<?php

class Rummah extends BaseModel
{
    protected $fillable = ['title', 'description'];

    public function getSearchableUri()
    {
        return route('rummahs_show', [$this->id], false);
    }
}

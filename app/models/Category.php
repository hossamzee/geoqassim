<?php

class Category extends BaseModel
{
    protected $fillable = ['title', 'description'];

    public function researches()
    {
        return $this->hasMany('Research');
    }

    public function getSearchableUri()
    {
        return route('researches_index', [$this->id], false);
    }
}

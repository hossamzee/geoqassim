<?php

class BaseModel extends Eloquent
{
    protected $searchable = true;

    public function getReadableCreatedAtAttribute()
    {
        return $this->created_at->diffForHumans();
    }
}

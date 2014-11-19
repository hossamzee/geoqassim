<?php

class Album extends BaseModel
{
    protected $fillable = ['title', 'description'];

    protected $appends = ['last_photo'];

    public function photos()
    {
        return $this->hasMany('Photo');
    }

    public function getSearchableUri()
    {
        return route('photos_index', [$this->id], false);
    }

    public function getLastPhotoAttribute()
    {
        return $this->photos()->orderBy('created_at', 'DESC')->first();
    }
}

<?php

class Document extends BaseModel
{
    protected $searchable = false;

    protected $fillable = ['title', 'content'];

    public static function boot()
    {
        //
    }
}

<?php

class Document extends BaseModel
{
    protected $searchable = false;

    protected $fillable = ['uri', 'title', 'content'];

    protected $appends = ['snippet', 'url'];

    public static function boot()
    {
        //
    }

    public function getSnippetAttribute()
    {
        return Str::words($this->content, 30);
    }

    public function getUrlAttribute()
    {
        return url($this->uri);
    }

    // TODO:  Create a static method and call it 'sanitize'.
    //        It would be used to clean the field to be added to be searchable.
}

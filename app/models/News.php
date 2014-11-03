<?php

class News extends Eloquent
{
    protected $fillable = ['title', 'content'];

    protected $appends = ['snippet'];

    public function getSnippetAttribute()
    {
      return Str::words($this->content);
    }
}

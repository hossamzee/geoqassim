<?php

class News extends BaseModel
{
    protected $fillable = ['title', 'content'];

    protected $appends = ['snippet'];

    public function getSnippetAttribute()
    {
      return Str::words($this->content);
    }
}

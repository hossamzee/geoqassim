<?php

class Page extends BaseModel
{
    protected $fillable = ['title', 'content'];

    public function getSearchableUri()
    {
        return route('pages_show', [$this->id], false);
    }

    public function getSnippetAttribute()
    {
      return Str::words(preg_replace(array_keys(self::$markdowns), '', $this->content), 68);
    }

}

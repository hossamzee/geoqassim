<?php

class News extends BaseModel
{
    protected $fillable = ['title', 'content'];

    protected $appends = ['snippet'];

    public function getSnippetAttribute()
    {
      return Str::words(preg_replace(array_keys(self::$markdowns), '', $this->content), 66);
    }

    public function getSearchableUri()
    {
        return route('news_show', [$this->id], false);
    }

    public function getParsedContentAttribute()
    {
        return preg_replace(array_keys(self::$markdowns), array_values(self::$markdowns), $this->content);
    }

    public function getPlainContentAttribute()
    {

    }
}

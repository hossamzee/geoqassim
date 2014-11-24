<?php

class News extends BaseModel
{
    protected $fillable = ['title', 'content'];

    protected $appends = ['snippet'];

    public static $markdowns = [
      '/= صورة وسطى ([^$\s\n]*)/' => '<center><img src="$1" class="img-responsive img-spacing" /></center>',
      '/= صورة يمنى ([^$\s\n]*)/' => '<img src="$1" class="img-responsive pull-right img-spacing" />',
      '/= صورة يسرى ([^$\s\n]*)/' => '<img src="$1" class="img-responsive pull-left img-spacing" />',
    ];

    public function getSnippetAttribute()
    {
      return Str::words(preg_replace(array_keys(self::$markdowns), '', $this->content), 72);
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

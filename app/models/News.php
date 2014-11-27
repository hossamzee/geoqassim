<?php

class News extends BaseModel
{
    protected $fillable = ['title', 'content'];

    protected $appends = ['snippet'];

    public function getSnippetAttribute()
    {
      return Str::words(preg_replace(array_keys(self::$markdowns), '', $this->content), 60);
    }

    public function getSearchableUri()
    {
        return route('news_show', [$this->id], false);
    }

    public function getParsedContentAttribute()
    {
        $content = preg_replace(array_keys(self::$markdowns), array_values(self::$markdowns), $this->content);
        $content = preg_replace('/(\\r\\n)+</', "\r\n<", $content);
        return $content;
    }

    public function getMainPhotoAttribute()
    {
        for ($markdown=0; $markdown<count(self::$markdowns); $markdown++)
        {
          try
          {
            preg_match(array_keys(self::$markdowns)[$markdown], $this->content, $match);
            return str_replace('/large/', '/thumb/', $match[1]);
          }
          catch (Exception $e)
          {
             // Let it pass.
          }
        }

        // Otherwise, just return null.
    }
}

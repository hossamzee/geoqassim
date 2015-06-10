<?php

class Ad extends BaseModel
{
    protected $fillable = ['title', 'content'];

    public function getSearchableUri()
    {
        return route('ads_show', [$this->id], false);
    }

    public function getParsedContentAttribute()
    {
        $content = preg_replace(array_keys(self::$markdowns), array_values(self::$markdowns), $this->content);
        $content = preg_replace('/(\\r\\n)+</', "\r\n<", $content);
        return $content;
    }
}

<?php

class Video extends BaseModel
{
    protected $fillable = ['title', 'description'];

    protected $appends = ['youtube_id'];

    public function getYoutubeIdAttribute()
    {
        // Extract the Youtube video id from the URL.
        parse_str(parse_url($this->url, PHP_URL_QUERY), $querystrings);
        return array_key_exists("v", $querystrings) ? $querystrings["v"] : null;
    }
}

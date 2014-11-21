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

    public static function sanitize($string)
    {
        // Remove every non-Arabic and non-English characters.
        $string = preg_replace('/[^a-zA-Z أبتثجحخدذرزسشصضطظعغفقكلمنهويىؤءئآةاإ١٢٣٤٥٦٧٨٩٠]/u', '', $string);

        // Smallize the string.
        $string = strtolower($string);

        // Remove the extra spacing.
        $string = preg_replace('/\s+/', ' ', $string);

        return $string;
    }

    public function getHighlightedTitle($keywords = [])
    {
        return self::highlight($this->title, $keywords);
    }

    public function getHighlightedSnippet($keywords = [])
    {
        return self::highlight($this->snippet, $keywords);
    }

    public static function highlight($string, $keywords = [])
    {
        foreach ($keywords as $keyword)
        {
            $string = preg_replace('/' . $keyword . '/', '<mark>' . $keyword . '</mark>', $string);
        }

        return $string;
    }
}

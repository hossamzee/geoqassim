<?php

class BaseModel extends Eloquent
{
    protected $searchable = true;

    public static function boot()
    {
        // Listen when the user created a new model.
        static::created(function($model)
        {
            if ($model->searchable == true)
            {
                // Create a new document to be used for searching.
                Document::create([
                    'url' => $model->getSearchableUrl(),
                    'title' => $model->getSearchableTitle(),
                    'content' => $model->getSearchableContent(),
                ]);
            }
        });
    }

    public function getReadableCreatedAtAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    // This method is to be used for searching, and could be overridden.
    public function getSearchableTitle()
    {
        return $this->title;
    }

    // This method is to be used for searching, and could be overridden.
    public function getSearchableContent()
    {
        $content = '';

        foreach ($this->fillable as $fillable)
        {
            $content .= $this->$fillable . ' ';
        }

        return $content;
    }

    public function getSearchableUrl()
    {
        //
    }
}

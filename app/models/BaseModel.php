<?php

class BaseModel extends Eloquent
{
    protected $searchable = true;

    public static function boot()
    {
        Lang::setLocale('ar');

        // Listen when the user created a new model.
        static::created(function($model)
        {
            if ($model->searchable == true)
            {
                // Create a new document to be used for searching.
                Document::create([
                    'uri' => $model->getSearchableUri(),
                    'title' => $model->getSearchableTitle(),
                    'content' => strip_tags($model->getSearchableContent()),
                ]);
            }
        });

        // Listen when the user updated a model.
        static::updated(function($model)
        {
            if ($model->searchable == true)
            {
                // Update the document to be used for searching.
                $affected_rows = Document::where('uri', '=', $model->getSearchableUri())->update([
                    'title' => $model->getSearchableTitle(),
                    'content' => strip_tags($model->getSearchableContent()),
                ]);
            }
        });

        // Listen when the user deleted a model.
        static::deleted(function($model)
        {
            if ($model->searchable == true)
            {
                // Update the document to be used for searching.
                $affected_rows = Document::where('uri', '=', $model->getSearchableUri())->delete();
            }
        });
    }

    public function getReadableCreatedAtAttribute()
    {
        return Date::parse($this->created_at->diffForHumans())->diffForHumans();
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

    public function getSearchableUri()
    {
        //
    }
}

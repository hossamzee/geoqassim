<?php

class BaseModel extends Eloquent
{
    protected $searchable = true;

    public static $markdowns = [
      '/= صورة وسطى ([^$\s\n]*)/' => '<center><img src="$1" class="img-responsive img-spacing" /></center>',
      '/= صورة يمنى ([^$\s\n]*)/' => '<img src="$1" class="img-responsive pull-right img-spacing" />',
      '/= صورة يسرى ([^$\s\n]*)/' => '<img src="$1" class="img-responsive pull-left img-spacing" />',
      '/= رابط \((.*)\) \((.*)\)/' => '<a href="$2">$1</a>',
    ];

    public static function boot()
    {
        Lang::setLocale('ar');

        // Whenever we are about to create a new row.
        static::creating(
            function ($model) {
                $max_position = static::max('position');
                $model->position = $max_position + 1;
            }
        );

        // Listen when the user created a new model.
        static::created(function($model)
        {
            if ($model->searchable == true)
            {
                // Create a new document to be used for searching.
                Document::create([
                    'uri' => $model->getSearchableUri(),
                    'title' => Document::sanitize($model->getSearchableTitle()),
                    'content' => Document::sanitize($model->getSearchableContent()),
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
                    'title' => Document::sanitize($model->getSearchableTitle()),
                    'content' => Document::sanitize($model->getSearchableContent()),
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

    public function moveUp()
    {
        if (static::count() == 1 || static::max('position') == $this->position)
        {
            return null;
        }

        $up = static::where('position', '>', $this->position)->orderBy('position', 'ASC')->first();

        // Do the sorting, the current entity should go up and the up one should come down.
        $previous_position = $this->position;

        $this->position = $up->position;
        $this->save();

        $up->position = $previous_position;
        $up->save();

        return $this;
    }

    public function moveDown()
    {
        if (static::count() == 1 || static::min('position') == $this->position)
        {
            return null;
        }

        $down = static::where('position', '<', $this->position)->orderBy('position', 'DESC')->first();

        // Do the sorting, the current entity should go down and the down one should come up.
        $previous_position = $this->position;

        $this->position = $down->position;
        $this->save();

        $down->position = $previous_position;
        $down->save();

        return $this;
    }
}

<?php

class Research extends BaseModel
{
    protected $fillable = ['title', 'author'];

    public function category()
    {
        return $this->belongsTo('Category');
    }

    public function getSearchableUri()
    {
        return route('researches_show', [$this->category_id, $this->id], false);
    }

    public function moveUp()
    {
        if (static::count() == 1 || static::where('category_id', '=', $this->category_id)->max('position') == $this->position)
        {
            return null;
        }

        $up = static::where('category_id', '=', $this->category_id)->where('position', '>', $this->position)->orderBy('position', 'ASC')->first();

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
        if (static::count() == 1 || static::where('category_id', '=', $this->category_id)->min('position') == $this->position)
        {
            return null;
        }

        $down = static::where('category_id', '=', $this->category_id)->where('position', '<', $this->position)->orderBy('position', 'DESC')->first();

        // Do the sorting, the current entity should go down and the down one should come up.
        $previous_position = $this->position;

        $this->position = $down->position;
        $this->save();

        $down->position = $previous_position;
        $down->save();

        return $this;
    }
}

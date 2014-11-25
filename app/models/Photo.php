<?php

class Photo extends BaseModel
{
    const PHOTO_LARGE_WIDTH = 800;
    const PHOTO_THUMB_WIDTH = 100;
    const PHOTOS_PER_PAGE = 6;

    protected $fillable = ['title', 'description'];

    public function album()
    {
        return $this->belongsTo('Album');
    }

    public function getSearchableUri()
    {
        return route('photos_show', [$this->album_id, $this->id], false);
    }

    public function moveUp()
    {
        if (static::count() == 1 || static::where('album_id', '=', $this->album_id)->max('position') == $this->position)
        {
            return null;
        }

        $up = static::where('album_id', '=', $this->album_id)->where('position', '>', $this->position)->orderBy('position', 'ASC')->first();

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
        if (static::count() == 1 || static::where('album_id', '=', $this->album_id)->min('position') == $this->position)
        {
            return null;
        }

        $down = static::where('album_id', '=', $this->album_id)->where('position', '<', $this->position)->orderBy('position', 'DESC')->first();

        // Do the sorting, the current entity should go down and the down one should come up.
        $previous_position = $this->position;

        $this->position = $down->position;
        $this->save();

        $down->position = $previous_position;
        $down->save();

        return $this;
    }
}

<?php

class Subscriber extends Eloquent
{
    protected $fillable = ['email'];

    protected $appends = ['readable_is_active'];

    public function getReadableIsActiveAttribute()
    {
        return $this->is_active ? 'نشط' : 'غير نشط';
    }
}

<?php

class Student extends BaseModel
{
    const PHOTO_WIDTH = 100;

    protected $fillable = ['name', 'major', 'interests', 'email'];

    public static $genders = [
      'male'    => 'ذكر',
      'female'  => 'أنثى',
    ];

    public function getSearchableTitle()
    {
        return $this->name;
    }

    public function getSearchableUri()
    {
        return route('students_show', [$this->id], false);
    }
}

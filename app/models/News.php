<?php

class News extends Eloquent
{
    protected $fillable = ['title', 'content'];

    public static $rules = ['title' => 'required', 'content' => 'required'];
}
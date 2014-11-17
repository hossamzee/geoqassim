<?php

class Member extends BaseModel
{
    const PHOTO_WIDTH = 100;

    protected $fillable = ['name', 'bio', 'cv'];

    protected $appends = ['readable_role', 'twitter_account_url', 'htmlized_cv'];

    public static $roles = [
      'member'  => 'عضو',
      'head'    => 'رئيس',
    ];

    public function getReadableRoleAttribute()
    {
      return self::$roles[$this->role];
    }

    public function getTwitterAccountUrlAttribute()
    {
      return 'https://twitter.com/' . $this->twitter_account;
    }

    public function getSearchableTitle()
    {
        return $this->name;
    }

    public function getSearchableUri()
    {
        return route('members_show', [$this->id], false);
    }

    public function getHtmlizedCvAttribute()
    {
        // TODO: This should be done.
    }
}

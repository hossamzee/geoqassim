<?php

class Member extends Eloquent
{
    protected $fillable = ['name', 'role', 'bio', 'cv'];

    protected $appends = ['readable_role', 'twitter_account_url'];

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
}

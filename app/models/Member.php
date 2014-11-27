<?php

class Member extends BaseModel
{
    const PHOTO_WIDTH = 100;

    protected $fillable = ['name', 'bio', 'cv'];

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

    public function getSearchableTitle()
    {
        return $this->name;
    }

    public function getSearchableUri()
    {
        return route('members_show', [$this->id], false);
    }

    public function getParsedCvAttribute()
    {
        // Define some variables.
        $parsed_cv = [];
        $cv = $this->cv;

        // Try to get the lists out of the cv.
        preg_match_all('/\= ([^\\n]*)\\n(.*?(?=\= |$))/is', $cv, $matches);

        $headings = $matches[1];
        $lists_as_string = $matches[2];

        for ($heading_index=0; $heading_index<count($headings); $heading_index++)
        {
            $list_items_as_string_without_leading_dash = ltrim($lists_as_string[$heading_index], '- ');
            $list_items = explode(PHP_EOL . '- ', $list_items_as_string_without_leading_dash);

            // Add a new heading.
            $parsed_cv[$heading_index]["heading"] = $headings[$heading_index];

            for ($list_item_index=0; $list_item_index<count($list_items); $list_item_index++)
            {
                $parsed_cv[$heading_index]["items"][$list_item_index] = trim($list_items[$list_item_index]);
            }
        }

        return $parsed_cv;
    }
}

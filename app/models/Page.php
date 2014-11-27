<?php

class Page extends BaseModel
{
    protected $fillable = ['title', 'content'];

    public function getSearchableUri()
    {
        return route('pages_show', [$this->id], false);
    }

    public function getSnippetAttribute()
    {
      return Str::words(preg_replace(array_keys(self::$markdowns), '', $this->content), 68);
    }

    private function parseTables($content)
    {
        preg_match_all('/(\= جدول)\\r\\n- (.*?(?=$|\\r\\n\\r\\n))/is', $content, $matches);

        $tables = $matches[2];

        for ($table=0; $table<count($tables); $table++)
        {
              try
              {
                  $replacement = '<table class="table table-striped">';

                  // Try to get the rows of the table.
                  $rows = explode("\n- ", $tables[$table]);

                  // Start with the head of the table.
                  $head = $rows[0];

                  $replacement .= '<thead><tr>';

                  $head_columns = explode("\t", $head);

                  foreach ($head_columns as $head_column)
                  {
                      $replacement .= '<th>' . trim($head_column) . '</th>';
                  }

                  $replacement .= '</tr></thead><tbody>';

                  // Then the body of the table.
                  for ($row=1; $row<count($rows); $row++)
                  {
                      $row_columns = explode("\t", $rows[$row]);

                      $replacement .= '<tr>';

                      foreach ($row_columns as $row_column)
                      {
                          $replacement .= '<td>' . trim($row_column) . '</td>';
                      }

                      $replacement .= '</tr>';
                  }

                  $replacement .= '</tbody></table>';

                  $content = str_replace($matches[0][$table], $replacement, $content);
              }
              catch (Exception $e)
              {
                  // Pass.
              }
        }

        return $content;
    }

    private function parseLists($content)
    {
        preg_match_all('/(\= قائمة)\\r\\n- (.*?(?=$|\\r\\n\\r\\n))/is', $content, $matches);

        $lists = $matches[2];

        for ($list=0; $list<count($lists); $list++)
        {
              try
              {
                  $replacement = '<ul>';

                  // Try to get the rows of the table.
                  $items = explode("\n- ", $lists[$list]);

                  foreach ($items as $item)
                  {
                      $replacement .= '<li>' . trim($item) . '</li>';
                  }

                  $replacement .= '</ul>';

                  $content = str_replace($matches[0][$list], $replacement, $content);
              }
              catch (Exception $e)
              {
                  // Pass.
              }
        }

        return $content;
    }

    public function getParsedContentAttribute()
    {
        $content = $this->content;
        $content = $this->parseTables($content);
        $content = $this->parseLists($content);
        $content = preg_replace(array_keys(self::$markdowns), array_values(self::$markdowns), $content);
        $content = preg_replace('/(\\r\\n)+</', "\r\n<", $content);

        return $content;
    }

}

<?php
class Tag
{

  protected $dbh;
  protected $table = 'notes';
  protected $fields = ['id', 'title', 'tags', 'user_id', 'resume', 'content'];
  protected $tags = [];

  public function __construct(PDO $dbh)
  {
    $this->dbh = $dbh;
  }

  public function fetch() : array
  {
    $r = $this->dbh->query('SELECT tags FROM ' . $this->table);
    if(!$r)
    {
      return [];
    }
    $res = $r->fetchAll(PDO::FETCH_ASSOC);
    foreach($res as $tagList)
    {
      foreach($tagList as $tags)
      {
        $tags = explode(',', $tags);
        foreach($tags as $tag)
        {
          if(!in_array(ucfirst(strtolower($tag)), $this->tags))
          {
            $this->tags[] = ucfirst($tag);
          }
        }
      }
    }
    sort($this->tags);
    return $this->tags;
  }

  public function fetch_notes(string $tag) : array
  {
    if(empty($tag))
    {
      return [];
    }
    $c = 0;
    $toSelect = '';
    foreach($this->fields as $column)
    {
      $toSelect .= $column;
      $c++;
      if($c && isset($this->fields[$c]))
        $toSelect .= ', ';
    }
    $r = $this->dbh->prepare('SELECT ' . $toSelect . ' FROM ' . $this->table . ' WHERE tags LIKE :tag');
    $r->bindValue(':tag', '%' . $tag . '%', PDO::PARAM_STR);
    $r->execute();
    if(!$r)
    {
      return [];
    }
    $res = $r->fetchAll(PDO::FETCH_ASSOC);
    $r->closeCursor();
    return $res;
  }
}
// EOF

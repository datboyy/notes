<?php
/* +-----------+--------------+------+-----+---------+----------------+
  | Field     | Type         | Null | Key | Default | Extra          |
  +-----------+--------------+------+-----+---------+----------------+
  | id        | int(11)      | NO   | PRI | NULL    | auto_increment |
  | title     | varchar(255) | YES  |     | NULL    |                |
  | tags      | varchar(255) | NO   |     | NULL    |                |
  | content   | text         | NO   |     | NULL    |                |
  | timestamp | int(11)      | NO   |     | NULL    |                |
  +-----------+--------------+------+-----+---------+----------------+*/
class Slide
{

  protected $dbh;
  protected $table = 'slides';

  protected $id;
  protected $title;
  protected $tags;
  protected $content;
  protected $timestamp;
  protected $setterAllowedValues = ['id', 'title', 'tags', 'content', 'timestamp'];

  public function __construct(PDO $dbh)
  {
    $this->dbh = $dbh;
  }

  public function set($argk, $argv = null) : object
  {
    if(is_array($argk))
    {
      foreach($argk as $k => $v)
      {
        $this->set($k, $v); // recursion
      }
    }
    else
    {
      if(in_array($argk, $this->setterAllowedValues))
      {
        $this->{$argk} = $argv; // store value
      }
      else
      {
        throw new Exception(__METHOD__ . ' : invalid arg name `' . $argk . '`'); // invalid $argk
      }
    }
    return $this;
  }

  public function reset() : object
  {
    $this->id = 0;
    $this->title = NULL;
    $this->tags = NULL;
    $this->content = NULL;
    $this->timestamp = NULL;
    return $this;
  }

  public function save() : int
  {
    if(empty($this->id))
    {
      $r = $this->dbh->prepare('INSERT INTO ' . $this->table . ' VALUES(NULL, :title, :tags, :content, :timestamp)');
      $r->bindValue(':title', $this->title, PDO::PARAM_STR);
      $r->bindValue(':tags', $this->tags, PDO::PARAM_STR);
      $r->bindValue(':content', $this->content, PDO::PARAM_STR);
      $r->bindValue(':timestamp', time());
      return (int) $r->execute();
    }
    else
    {
      $r = $this->dbh->prepare('UPDATE ' . $this->table . ' SET title = :title, tags = :tags, content = :content WHERE id = :id');
      $r->bindValue(':title', $this->title, PDO::PARAM_STR);
      $r->bindValue(':tags', $this->tags, PDO::PARAM_STR);
      $r->bindValue(':content', $this->content, PDO::PARAM_STR);
      $r->bindValue(':id', $this->id, PDO::PARAM_STR);
      return (int) $r->execute();
    }
  }

  public function count() : int
  {
    $r = $this->dbh->query('SELECT COUNT(id) as nbr FROM ' . $this->table);
    $res = $r->fetch(PDO::FETCH_ASSOC)['nbr'];
    $r->closeCursor();
    return $res;
  }

  public function get_last_column_id() : int
  {
    $r = $this->dbh->query('SELECT id FROM ' . $this->table . ' ORDER BY id DESC');
    $res = $r->fetch(PDO::FETCH_ASSOC);
    $r->closeCursor();
    return $res['id'];
  }

  public function fetch() : array
  {
    // Columns that has to be selected are stored as a class' property
    $c = 0;
    $toSelect = '';
    foreach($this->setterAllowedValues as $column)
    {
      $toSelect .= $column;
      $c++;
      if($c && isset($this->setterAllowedValues[$c]))
        $toSelect .= ', ';
    }
    if(!empty($this->id))
    {
      $r = $this->dbh->prepare('SELECT ' . $toSelect . ' FROM ' . $this->table . ' WHERE id = :id ');
      $r->bindValue(':id', $this->id, PDO::PARAM_INT);
      if(!$r->execute())
      {
        $r->closeCursor();
        return [];
      }
      $res = $r->fetch(PDO::FETCH_ASSOC);
      $res["content"] = Utils::parse_code_blocks($res['content']);
      $r->closeCursor();
      return $res;
    }
    else
    {
      $r = $this->dbh->query('SELECT ' . $toSelect . ' FROM ' . $this->table . ' ORDER BY id DESC');
      if(!$r)
      {
        return [];
      }
      $res = $r->fetchAll(PDO::FETCH_ASSOC);
      $r->closeCursor();
      return $res;
    }
  }

  public function fetch_rand() : array
  {

    $res = NULL;
    while(empty($res))
    {
      $rand = rand(1, $this->get_last_column_id());
      $r = $this->dbh->query('SELECT * FROM ' . $this->table . ' WHERE id = ' . $rand);
      if(!$r)
      {
        // continue;
      }
      $res = $r->fetch();
      $r->closeCursor();
    }
    if(!$rand == 1 && empty($res))
    {
      return [];
    }
    return $res;
  }

  public function delete() : int
  {
    if(!empty($this->id))
    {
      $r = $this->dbh->prepare('DELETE FROM ' . $this->table . ' WHERE id = :id');
      $r->bindValue(':id', $this->id, PDO::PARAM_INT);
      return (int) $r->execute();
    }
    return 0;
  }
}
// EOF

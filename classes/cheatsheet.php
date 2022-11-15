<?php
/* +-----------+--------------+------+-----+---------+----------------+
  | Field     | Type         | Null | Key | Default | Extra          |
  +-----------+--------------+------+-----+---------+----------------+
  | id        | int(11)      | NO   | PRI | NULL    | auto_increment |
  | tags      | varchar(255) | NO   |     | NULL    |                |
  | content   | text         | NO   |     | NULL    |                |
  | timestamp | int(11)      | NO   |     | NULL    |                |
  +-----------+--------------+------+-----+---------+----------------+ */
class Cheatsheet
{

  protected $dbh;
  protected $table = 'cheatsheets';

  protected $id;
  protected $tags;
  protected $content;
  protected $timestamp;
  protected $setterAllowedValues = ['id', 'tags', 'content'];

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

  public function save() : int
  {
    if(empty($_GET['id']))
    {
      $r = $this->dbh->prepare('INSERT INTO ' . $this->table . ' VALUES(NULL, :tags, :content, :timestamp)');
      $r->bindValue(':tags', $this->tags, PDO::PARAM_STR);
      $r->bindValue(':content', $this->content, PDO::PARAM_STR);
      $r->bindValue(':timestamp', time());
      return $d = $r->execute();
    }
    else
    {
      $r = $this->dbh->prepare('UPDATE ' . $this->table . ' SET tags = :tags, content = :content WHERE id = :id');
      $r->bindValue(':tags', $this->tags, PDO::PARAM_STR);
      $r->bindValue(':content', $this->content, PDO::PARAM_STR);
      $r->bindValue(':id', $this->id, PDO::PARAM_STR);
      return (int) $r->execute();
    }
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
      $r = $this->prepare('SELECT ' . $toSelect . ' FROM ' . $this->table . ' WHERE id = :id ');
      $r->bindValue(':id', $this->id, PDO::PARAM_INT);
      if(!$r->execute())
      {
        $r->closeCursor();
        return [];
      }
      $res = $r->fetchAll(PDO::FETCH_ASSOC);
      $r->closeCursor();
      return $res;
    }
    else
    {
      $r = $this->dbh->query('SELECT ' . $toSelect . ' FROM ' . $this->table);
      if(!$r)
      {
        return [];
      }
      $res = $r->fetch(PDO::FETCH_ASSOC);
      $r->closeCursor();
      return $res;
    }
  }

  public function delete()
  {

  }
}
// EF

<?php
/*+---------+--------------+------+-----+---------+----------------+
 | Field   | Type         | Null | Key | Default | Extra          |
 +---------+--------------+------+-----+---------+----------------+
 | id      | int(11)      | NO   | PRI | NULL    | auto_increment |
 | title   | varchar(255) | NO   |     | NULL    |                |
 | tags    | varchar(255) | YES  |     | NULL    |                |
 | user_id | int(11)      | NO   |     | NULL    |                |
 | resume  | text         | NO   |     | NULL    |                |
 | content | text         | NO   |     | NULL    |                |
 | time    | int(11)      | NO   |     | NULL    |                |
 +---------+--------------+------+-----+---------+----------------+ */
class Note
{
  protected $dbh;
  protected $table = 'notes';

  protected $setterAllowedValues = ['id', 'title', 'tags', 'user_id', 'resume', 'content', 'time'];

  protected $id;
  protected $title;
  protected $tags;
  protected $user_id;
  protected $resume;
  protected $content;
  protected $timestamp;

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

  public function fetch(int $id = 0) : array
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
    // Select a record using its id
    if($id)
    {
      $r = $this->dbh->prepare('SELECT ' . $toSelect . ' FROM ' . $this->table . ' WHERE id = :id');
      $r->bindValue(':id', $id, PDO::PARAM_INT);
      if($r->execute())
      {
        $res = $r->fetch(PDO::FETCH_ASSOC);
        $r->closeCursor();
        $res['content'] = $this->parse($res['content']);
        return $res;
      }
      {
        $r->closeCursor();
        return [];
      }
    }
    // Select all records
    else
    {
      $r = $this->dbh->query('SELECT ' . $toSelect . ' FROM ' . $this->table . ' ORDER BY id DESC');
      if($r)
      {
        $res = $r->fetchAll(PDO::FETCH_ASSOC);
        $r->closeCursor();
        return $res;
      }
      else {
        return [];
      }
    }
  }

  public function parse(string $text) : string
  {
    $text = preg_replace_callback('#<code>(.+)</code>#isU', function($matches)
    {
      return '<code>' . trim(htmlentities($matches[1])) . '</code>';
    }, $text);
    return  $text;
  }

  public function save()
  {
    if(!empty($this->title) && !empty($this->user_id) && !empty($this->resume) && !empty($this->content))
    {
      if(empty((int) $this->id))
      {
        // INSERT
        $r = $this->dbh->prepare('INSERT INTO ' . $this->table . ' VALUES(NULL, :title, :tags, :user_id, :resume, :content, :time)');
        $r->bindValue(':title', $this->title, PDO::PARAM_STR);
        $r->bindValue(':tags', $this->tags, PDO::PARAM_STR);
        $r->bindValue(':user_id', $this->user_id, PDO::PARAM_INT);
        $r->bindValue(':resume', $this->resume, PDO::PARAM_STR);
        $r->bindValue(':content', $this->content, PDO::PARAM_STR);
        $r->bindValue(':time', time(), PDO::PARAM_INT);
        return $r->execute() ? $this:0;
      }
      else
      {
        // UPDATE
        $r = $this->dbh->prepare('UPDATE ' . $this->table . ' SET title = :title, tags = :tags, resume = :resume, content = :content WHERE id = :id');
        $r->bindValue(':title', $this->title, PDO::PARAM_STR);
        $r->bindValue(':tags', $this->tags, PDO::PARAM_STR);
        $r->bindValue(':resume', $this->resume, PDO::PARAM_STR);
        $r->bindValue('content', $this->content, PDO::PARAM_STR);
        $r->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $r->execute() ? $this:0;
      }
    }
  }

  public function delete()
  {

  }
}

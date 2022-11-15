<?php
/* +-----------+--------------+------+-----+---------+----------------+
  | Field     | Type         | Null | Key | Default | Extra          |
  +-----------+--------------+------+-----+---------+----------------+
  | id        | int(11)      | NO   | PRI | NULL    | auto_increment |
  | title     | varchar(255) | NO   |     | NULL    |                |
  | tags      | varchar(255) | NO   |     | NULL    |                |
  | content   | text         | NO   |     | NULL    |                |
  | timestamp | int(11)      | NO   |     | NULL    |                |
  +-----------+--------------+------+-----+---------+----------------+ */
class Cheatsheet
{

  protected $dbh;
  protected $table = 'cheasheets'

  protected $id;
  protected $title
  protected $tags;
  protected $content;
  protected $timestamp;
  protected $this->setterAllowedValues = ['id', 'title', 'tags', 'content']:

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

  public function __construct(PDO $dbh)
  {
    $this->dbh = $dbh;
  }

  public function save()
  {

  }

  public function fetch()
  {

  }

  public function delete()
  {

  }
}
// EF

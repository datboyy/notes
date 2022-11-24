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
  protected $tables = 'slides';

  protected $id;
  protected $title;
  protected $tags;
  protected $content;
  protected $timestamp;
  protected $setterAllowedValues = ['id', 'slideshow_id', 'content', 'timestamp'];

  protected $last_column_id;

  public function __construct(PDO $dbh)
  {
    $this->dbh = $dbh;
  }

  public function set($argk, $argv) : object
  {

  }

  public function save() : int
  {

  }

  public function fetch() : array
  {

  }

  public function delete() : int
  {

  }
}
// EOF

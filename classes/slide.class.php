<?php
/* +--------------+---------+------+-----+---------+----------------+
   | Field        | Type    | Null | Key | Default | Extra          |
   +--------------+---------+------+-----+---------+----------------+
  | id           | int(11) | NO   | PRI | NULL    | auto_increment |
  | slideshow_id | int(11) | NO   |     | NULL    |                |
  | content      | text    | NO   |     | NULL    |                |
  | timestamp    | int(11) | NO   |     | NULL    |                |
  +--------------+---------+------+-----+---------+----------------+
*/
class Slide
{
  protected $dbh;
  protected $table = 'slides';

  protected $id;
  protected $slideshow_id;
  protected $content;
  protected $timestamp;

  protected $setterAllowedValues = ['id', 'slideshow_id', 'content', 'timestamp'];

  protected $last_column_id;

  public function __construct(PDO $dbh)
  {
    $this->dbh = $dbh;
  }

  /**
   * General setter
   *
   * @param $argk  The param name
   * @param $argv  The argv value
   *
   * @return object The object itself
  */
  public function set($argk, $argv) : object
  {
    if(in_array($argk, $this->setterAllowedValues))
    {
      $this->{$argk} = $argv;
    }
    else
    {
      throw new Exception(__METJOD__ . ' : invalid argument ' . $argk . '.');
    }
    return $this;
  }

  /**
   * Save a slide record to the database
   * @return int
  */
  public function save() : int
  {
    if(empty($this->id))
    {
      // CREATE
      $r = $this->dbh->prepare('INSERT INTO ' . $this->table . ' VALUES(NULL, :slideshow_id, :content, :timestamp)');
      $r->bindValue(':slideshow_id', $this->slideshow_id, PDO::PARAM_INT);
      $r->bindValue(':content', $this->content, PDO::PARAM_STR);
      $r->bindValue(':timestamp', time(), PDO::PARAM_INT);
      $d = $r->execute();
      return (int) $d;
    }
    else
    {
      // UPDATE
      $r = $this->dbh->prepare('UPDATE ' . $this->table . ' SET :content = :content WHERE id = :id');
      $r->bindValue(':content', $this->content);
      $r->bindValue(':id', $this->id);
      return (int) $r->execute();
    }
  }

  public function fetch() : array
  {

  }

  public function delete() : int
  {

  }
}
// EOF

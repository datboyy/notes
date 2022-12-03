<?php
/* +-----------+--------------+------+-----+---------+----------------+
  | Field     | Type         | Null | Key | Default | Extra          |
  +-----------+--------------+------+-----+---------+----------------+
  | id        | int(11)      | NO   | PRI | NULL    | auto_increment |
  | title     | varchar(255) | NO   |     | NULL    |                |
  | tags      | varchar(255) | NO   |     | NULL    |                |
  | timestamp | int(11)      | NO   |     | NULL    |                |
  +-----------+--------------+------+-----+---------+----------------+
*/
class Slideshow
{

  protected $dbh;
  protected $table = 'slideshows';
  protected $table_slides = 'slides';
  protected $setterAllowedValues = ['id', 'title', 'tags', 'timestamp'];

  protected $id;
  protected $title;
  protected $tags;


  /**
   * Class constructor
   *
   * @param PDO $dbh A PDO instance
   */
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
   * General getter
   *
   * @param mixed $argk The param name
   * @return mixed The param value
  */
  public function get($argk)
  {
    if(in_array($argk, $this->setterAllowedValues))
    {
      return $this->{$argk};
    }
    else
    {
      throw new Exception(__METJOD__ . ' : invalid argument ' . $argk . '.');
    }
  }

  /**
   * INSERT or UPDATE a slideshow entry
   *
   * @return int success or error
  */
  public function save() : int
  {
    if(empty($this->id))
    {
      $r = $this->dbh->prepare('INSERT INTO ' . $this->table . ' VALUES(NULL, :title, :tags, :time)');
      $r->bindvalue(':title', $this->title, PDO::PARAM_STR);
      $r->bindValue(':tags', $this->tags, PDO::PARAM_STR);
      $r->bindValue(':time', time(), PDO::PARAM_STR);
      $d = (int) $r->execute();
      $this->id = $this->dbh->lastInsertId();
      return $d;
    }
    else
    {
      echo 'UPDATE';
      $r = $this->dbh->prepare('UPDATE FROM ' . $this->table . ' SET title = :title, tags = :tags WHERE id = :id');
      $r->bindValue(':title', $this->title, PDO::PARAM_STR);
      $r->bindValue(':tags', $this->tags, PDO::PARAM_STR);
      $r->bindValue(':id', $this->id, PDO::PARAM_INT);
      return (int) $r->execute();
    }
  }

  /**
   * Fetch a slideshow & its slides from the database
   *
   * @return array A slideshow dataset
  */
  public function fetch() : array
  {
    // Query with a join on the slides table to get the slideshow and its slides
    $SQL = 'SELECT slideshows.id, slideshows.title, slideshows.title, slideshows.tags, slideshows.timestamp, slides.id AS slide_id, slides.content AS slide_content, slides.timestamp AS slide_timestamp '
                  . ' FROM '. $this->table . ' JOIN slides ON ' . $this->table . '.id = slides.slideshow_id';
    $r = $this->dbh->query($SQL);
    if(!$r)
    {
      $r->closeCursor();
      return [];
    }
    $res = $r->fetchAll(PDO::FETCH_ASSOC);
    //
    // Datas post-sorting
    $sorted = [];
    foreach($res as $k => $row)
    {
      if(!isset($sorted[$row['id']]))
      {
        $sorted[$row['id']] = [
          'id'         =>  $row['id'],
          'title'      =>  $row['title'],
          'tags'       =>  $row['tags'],
          'timestamp'  =>  $row['timestamp'],
          'slides'     =>  []
        ];
      }
      if(!empty($row['slide_id']))
      {
        $sorted[$row['id']]['slides'][] = [
          'id'          =>   $row['slide_id'],
          'content'     =>   $row['slide_content'],
          'timestamp'   =>   $row['slide_timestamp']
        ];
      }
    }
    $r->closeCursor();
    return array_merge($sorted);                                                // array indexes reset using array_merge 
  }

  public function delete() : int
  {

  }

}
// EOF

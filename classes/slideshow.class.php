<?php
class Slideshow
{

  protected $dbh;
  protected $table = 'slideshows';
  protected $setterAllowedValues = ['id', 'title', 'tags' 'slides_id', 'timestamp'];

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

<?php
class Note
{

  protected $title;
  protected $author_id;
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
        throw new Exception(__METHOD__ . ' : invalid arg key `' . $argk . '`'); // invalid $argk
      }
    }
    return $this;
  }

  public function fetch()
  {

  }

  public function save()
  {

  }

  public function delete()
  {

  }
}

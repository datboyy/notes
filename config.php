<?php
$prefix = defined('ADMIN') && ADMIN ? '../':'';

require  $prefix . 'classes/utils.class.php';
require  $prefix . 'classes/user.class.php';
require  $prefix . 'classes/note.class.php';
require  $prefix . 'classes/tag.class.php';
require  $prefix . 'classes/slide.class.php';
require  $prefix . 'classes/slideshow.class.php';

session_start();

define('REGISTRATION_ENABLED', 1);

$username = 'root';
$password = '';
$database = 'dummy';
try
{
  $dbh = new PDO("mysql:host=localhost;dbname=$database", "$username", "$password");
}
catch(PDOException $e)
{
  echo $e->getMessage();
}

$UserObj = new User($dbh);
// EOF

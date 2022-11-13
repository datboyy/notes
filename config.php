<?php
require 'classes/user.php';
require 'classes/note.php';
require 'classes/tag.php';

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

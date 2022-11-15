<?php
require '../config.php';

if(!$UserObj->isLoggedIn())
{
  header('Location: ../user.php');
  exit();
}
// Temporary permissions workaround, only the first created user may write notes
if($_SESSION['id'] > 1)
{
  echo 'Access denied.';
  exit();
}
// A Note object to handle CRUD operations
$NoteObj = new Note($dbh);

require 'templates/cheatsheets.tpl.php';

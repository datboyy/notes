<?php
define('ADMIN', 1);
define('PREFIX', '../');
define('MODULE', 'cheatsheet');

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
// A Cheatsheet object to handle CRUD operations
$CheatsheetObj = new Cheatsheet($dbh);

if(!empty($_POST['tags']) &&  !empty($_POST['content']))
{
  if(!empty($_POST['id']))
  {
    $CheatsheetObj->set('id', $_POST['id']);
  }
  $templateVars['add_cheatsheet_success'] = $CheatsheetObj->set('tags', $_POST['tags'])
                                                          ->set('content', $_POST['content'])
                                                          ->save();
}
require 'templates/cheatsheets.tpl.php';

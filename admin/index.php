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
// CREATE
if(isset($_POST['title'],  $_POST['content']))
{
    if(isset($_GET['id']))
    {
      $NoteObj->set('id', $_POST['id']);
    }
    $NoteObj->set('title', $_POST['title'])
            ->set('user_id', $_SESSION['id'])
            ->set('resume', implode(' ', array_slice(explode(' ', $_POST['content']), 0, 50)))
            ->set('content', $_POST['content'])
            ->save();
}
// READ all entries to make a list of notes
$templateVars['note'] = $NoteObj->fetch();
// As UPDATE required to get the data stored in the database
if(isset($_GET['id']))
{
  $templateVars['selected_note'] = $NoteObj->fetch($_GET['id']);
  if(empty($templateVars['selected_note']))
  {
    unset($_GET['id']); // no result found
  }
}
require 'templates/index.tpl.php';
// EOF
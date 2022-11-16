<?php
define('ADMIN', 1);
define('MODULE', 'notes');
require '../config.php';

$templateVars = [];

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
// DELETE
if(!empty($_POST['delete']))
{
  $templateVars['delete_success'] = $NoteObj->set('id', $_POST['delete'])
                                            ->delete();
}
elseif(!empty($_POST['title']) &&  !empty($_POST['tags']) &&  !empty($_POST['content']))
{
    // CREATE, UPDATE
    $templateVars['save_note_success'] = $NoteObj->set('id', !empty($_GET['id']) ? $_GET['id']:0) // handle UPDATE case
                                                 ->set('title', $_POST['title'])
                                                 ->set('tags', $_POST['tags'])
                                                 ->set('user_id', $_SESSION['id'])
                                                 ->set('resume', implode(' ', array_slice(explode(' ', $_POST['content']), 0, 50)))
                                                 ->set('content', $_POST['content'])
                                                 ->save();
}
// Some data is missing, an error message is shown
elseif(!empty($_POST))
{
  $templateVars['missing_datas'] = 1;
}
// READ
if(isset($_GET['id'])) // Note specified by id
{
  $templateVars['selected_note'] = $NoteObj->fetch($_GET['id']);
  if(empty($templateVars['selected_note']))
  {
    unset($_GET['id']); // no result found
  }
}
// All notes
$templateVars['notes_list'] = $NoteObj->fetch();

require 'templates/index.tpl.php';
// EOF

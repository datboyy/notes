<?php
define('ADMIN', 1);
define('PREFIX', '../');
define('MODULE', 'slides');

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
$SlideObj = new Slide($dbh);
// DELETE
if(!empty($_POST['delete']))
{
  $templateVars['delete_success'] = $SlideObj->set('id', $_POST['delete'])
                                             ->delete();
}
if(!empty($_POST['title']) && !empty($_POST['tags']) &&  !empty($_POST['content']))
{
  // UPDATE
  if(!empty($_POST['id']))
  {
    $SlideObj->set('id', $_POST['id']);
  }
  // CREATE
  $templateVars['add_slide_success'] = $SlideObj->set('title', $_POST['title'])
                                                ->set('tags', $_POST['tags'])
                                                ->set('content', $_POST['content'])
                                                ->save();
}
// READ
$templateVars['slides_list'] = $SlideObj->reset()
                                        ->fetch();
// Select one entry
if(isset($_GET['id']))
{
  $templateVars['selected_slide'] = $SlideObj->reset()
                                             ->set('id', $_GET['id'])
                                             ->fetch();
  if(empty($templateVars['selected_slide']))
  {
    unset($_GET['id']); // no entry found
  }
}

require 'templates/slides.tpl.php';

// EOF

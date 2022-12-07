<?php
define('ADMIN', 1);
define('PREFIX', '../');
define('MODULE', 'slides');
require '../config.php';
//
// User has to be logged in
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
//
// Slideshow & slides objects
$Slideshow = new Slideshow($dbh);
$Slide = new Slide($dbh);
// Insert a new slideshow
if(!empty($_POST['title']) && !empty($_POST['tags']))
{
  //
  // SAVE SLIDESHOWS TO THE DATABASE
  //
  $success = 1;
  //
  // CREATE
  $Slideshow->set('title', $_POST['title'])
            ->set('tags', $_POST['tags']);

  if(isset($_POST['slideshow_id']))
  {
    //
    // UPDATE
    $Slideshow->set('id', $_POST['slideshow_id']);
  }
  $success = $Slideshow->save(); // saving slideshow metadatas such as title, tags etc..
  //
  //
  // Save slides themselves
  foreach($_POST as $key => $value)
  {
    if(preg_match('#^slide_[0-9]+#', $key))
    {
        $success = $Slide = (new Slide($dbh))
                                ->set('slideshow_id', $Slideshow->get('id'))
                                ->set('content', $value)
                                ->save();
    }
  }
  $templateVars['slideshow_save_success'] = $success;
}
//
// READ
if(isset($_GET['id']))
{
  // Selected slideshow
  $templateVars['selected_slideshow'] = $Slideshow->set('id', $_GET['id'])
                                                  ->fetch();
 if(empty($templateVars['selected_slideshow']))
 {
   unset($_GET['id'], $templateVars['selected_slideshow']);
 }
}

// Slideshows list
$templateVars['slideshows_list'] = $Slideshow->reset()
                                             ->fetch();

require 'templates/slides.tpl.php';
// EOF

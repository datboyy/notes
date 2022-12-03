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
//
// Slideshow & slides objects
$Slideshow = new Slideshow($dbh);
$Slide = new Slide($dbh);
// Insert a new slideshow
if(!empty($_POST['title']) && !empty($_POST['tags']))
{
  //
  // Save slideshow metadatas
  //
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
  $Slideshow->save();
  //
  // Save slides themselves
  echo '<pre>';
  foreach($_POST as $key => $value)
  {
    if(preg_match('#^slide_[0-9]+#', $key))
    {
        echo 'Slide found !';
        $Slide = (new Slide($dbh))
                            ->set('slideshow_id', $Slideshow->get('id'))
                            ->set('content', $value)
                            ->save();
    }
  }
  echo '</pre>';
}

echo '<pre>';
var_dump($_POST);
echo '</pre>';

//
// Fetching slideshows
echo '<pre>';
var_dump($Slideshow->fetch());
echo '</pre>';

exit();

// Temporary permissions workaround, only the first created user may write notes
if($_SESSION['id'] > 1)
{
  echo 'Access denied.';
  exit();
}

require 'templates/slides.tpl.php';

// EOF

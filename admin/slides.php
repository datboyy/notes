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

if(!empty($_POST['title']) && !empty($_POST['tags']))
{
  //
  // Save slideshow metadatas
  $Slideshow = (new Slideshow($dbh))
                  ->set('title', $_POST['title'])
                  ->set('tags', $_POST['tags']);

  $Slideshow->save();
  //
  // Save slides themselves
  foreach($_POST as $key => $value)
  {
    if(preg_match('#^slide_[0-9]+#', $key))
    {
        echo '<pre>Slide found</pre>';
        $Slide = (new Slide($dbh))
                            ->set('slideshow_id', $Slideshow->get('id'))
                            ->set('content', $value)
                            ->save();
    }
  }
}

echo '<pre>';
var_dump($_POST);
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

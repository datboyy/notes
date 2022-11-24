<?php
require 'config.php';

$NoteObj = new Note($dbh);
$TagObj = new Tag($dbh);
$SlideObj = new Slide($dbh);

$templateVars = [];

$templateVars['slide'] = $SlideObj->fetch_rand(isset($_SESSION['last_slide_id']) ? $_SESSION['last_slide_id']:NULL);

if(empty($templateVars['slide']))
{
   echo 'Fatal error.';
   exit();
}

$_SESSION['last_slide_id'] = $templateVars['slide']['id'];

require 'templates/slides.tpl.php';

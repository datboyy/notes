<?php
require 'config.php';

$NoteObj = new Note($dbh);
$TagObj = new Tag($dbh);
$SlideObj = new Slide($dbh);

$templateVars = [];

$templateVars['slide'] = $SlideObj->fetch_rand();

require 'templates/slides.tpl.php';

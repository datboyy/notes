<?php
require '../config.php';

if(!$UserObj->isLoggedIn())
{
  header('Location: ../user.php');
  exit();
}

if($_SESSION['id'] > 1)
{
  echo 'Access denied.';
  exit();
}

$NoteObj = new Note($dbh);

if(isset($_POST['title'],  $_POST['content']))
{
    $NoteObj->set('title', $_POST['title'])
            ->set('user_id', $_SESSION['id'])
            ->set('resume', implode(' ', array_slice(explode(' ', $_POST['content']), 0, 50)))
            ->set('content', $_POST['content'])
            ->save();
}

$templateVars['notes_list'] = $NoteObj->fetch(); 

require 'templates/index.tpl.php';

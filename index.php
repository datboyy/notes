<?php
require 'config.php';

$NoteObj = new Note($dbh);

if(!empty($_GET['id']))
{
  $templateVars['note'] = $NoteObj->fetch($_GET['id']);
  $templateVars['perm_may_edit'] = ($UserObj->isLoggedIn() && !($_SESSION['id'] > 1));
  require 'templates/view_note.tpl.php';
}
else
{
  $templateVars['notes_list'] = $NoteObj->fetch();
  require 'templates/index.tpl.php';
}

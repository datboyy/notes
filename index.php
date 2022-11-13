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
  $notesList = $NoteObj->fetch();
  // Explode tags list to retrieve an array of strings
  foreach($notesList as $k => $v)
  {
      $notesList[$k]['tags'] = explode(',', $notesList[$k]['tags']);
  }
  // Pass notes list to the template
  $templateVars['notes_list'] = $notesList;
  require 'templates/index.tpl.php';
}

<?php
require 'config.php';

$NoteObj = new Note($dbh);
$TagObj = new Tag($dbh);

$templateVars = [];

if(!empty($_GET['id']))
{
  // A note has been selected
  $templateVars['note'] = $NoteObj->fetch($_GET['id']);
  $templateVars['perm_may_edit'] = ($UserObj->isLoggedIn() && !($_SESSION['id'] > 1));
  require 'templates/view_note.tpl.php';
}
else
{
  // Display list of notes
  $notesList = $NoteObj->fetch();
  // Pass tags list to the template
  $templateVars['tags_list'] = $TagObj->fetch();
  // Pass notes list to the template
  if(empty($_GET['tag']))
  {
    // Explode tags list to retrieve an array of strings
    foreach($notesList as $k => $v)
    {
        $notesList[$k]['tags'] = explode(',', $notesList[$k]['tags']);
    }
    // A tag has been specified
    $templateVars['notes_list'] = $notesList;
  }
  else
  {
    // No tag has been specified
    $notesListFilteredByTags = $TagObj->fetch_notes($_GET['tag']);
    foreach($notesListFilteredByTags as $k => $v)
    {
        $notesListFilteredByTags[$k]['tags'] = explode(',', $notesListFilteredByTags[$k]['tags']);
    }
    $templateVars['notes_list'] = $notesListFilteredByTags;
  }
  require 'templates/index.tpl.php';
}

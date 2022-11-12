<?php
require 'config.php';

$NoteObj = new Note($dbh);
$templateVars['notes_list'] = $NoteObj->fetch();

require 'templates/index.tpl.php';

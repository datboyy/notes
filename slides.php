<?php
require 'config.php';

$NoteObj = new Note($dbh);
$TagObj = new Tag($dbh);
$CheatsheetObj = new Cheatsheet($dbh);

$templateVars = [];

require 'templates/cheatsheets.tpl.php';

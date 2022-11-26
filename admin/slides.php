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
// Temporary permissions workaround, only the first created user may write notes
if($_SESSION['id'] > 1)
{
  echo 'Access denied.';
  exit();
}

require 'templates/slides.tpl.php';

// EOF

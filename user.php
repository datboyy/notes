<?php
require 'config.php';
// Template variables
$templateVars = [];
// User already logged in
if((new User($dbh))->isLoggedIn())
{
  if(isset($_POST['logout']))
  {
    session_destroy();
    header('Location: index.php');
    exit();
  }
  require 'templates/logout.php';
}
// Register controller process
elseif(isset($_GET['register']))
{
  if(!REGISTRATION_ENABLED)
  {
    if(isset($_POST['email'], $_POST['username'], $_POST['password'], $_POST['password_confirmation']))
    {
      if($_POST['password'] == $_POST['password_confirmation'])
      {
        unset($_POST['password_confirmation']);
        $templateVars[] = ['password_missmatch', 0];
        $templateVars[] = ['register_success', (new User($dbh))->set($_POST)->register()]; // register new user, pass result as template variable
      }
      else
      {
        $templateVars[] = ['password_missmatch', 1];
      }
    }
  }
  require 'templates/register.php';
}
// Login controller process
else
{
  if(isset($_POST['username'], $_POST['password']))
  {
    $templateVars[] = ['login_success', (new User($dbh))->set($_POST)->login()];
    //
    //
    // @NOTE : Any redirection must be written here to prevent the end-user to be redirected to the logout page.
    //
    //
    header('Location: index.php');
    exit();
  }
  require 'templates/login.php';
}
// EOF

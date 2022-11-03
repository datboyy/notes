<!DOCTYPE html>
<html>
  <head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;1,300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css" />
  </head>
  <body>
    <div class="container">
      <h2>Logout</h2>
      <p class="logout-message">You are already logged in and you are able to use the registered users features. Maybe you want leave us ?
      You'll need to log in again to get your registered user's privileges back.</p>
      <form method="POST">
        <input type="hidden" name="logout" />
        <input type="submit" value="Goodbye !" />
      </form>
    </div> <!-- /.container -->
  </body>
</html>

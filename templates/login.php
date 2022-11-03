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
      <h2>Login</h2>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
         Vivamus vehicula magna tortor, vitae porttitor ante dictum in. Quisque diam sapien.</p>
      <!-- Login form -->
      <form method="POST">
        <label>Username :</label>
        <input type="text" name="username" placeholder="Username or e-mail address.." />
        <label>Password :</label>
        <input type="password" name="password" placeholder="Your password.." />
        <input type="submit" value="Login" />
      </form>
      <p class="create_account">
        <a href="?register">I don't have an account yet</a>
      </p>
    </div> <!-- /.container -->
  </body>
</html>

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
      <h2>Register</h2>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
         Vivamus vehicula magna tortor, vitae porttitor ante dictum in. Quisque diam sapien.</p>

      <!-- Login form -->
      <form method="POST">
        <label>Email address :</label>
        <input type="email" name="email" placeholder="Email address.." <?= !REGISTRATION_ENABLED ? 'disabled':'' ?>  />
        <label>Username :</label>
        <input type="text" name="username" placeholder="Username.." <?= !REGISTRATION_ENABLED ? 'disabled':'' ?>  />
        <label>Password :</label>
        <input type="password" name="password" placeholder="Strong password.." <?= !REGISTRATION_ENABLED ? 'disabled':'' ?> />
        <label>Password confirmation :</label>
        <input type="password" name="password_confirmation" placeholder="Strong password again.." <?= !REGISTRATION_ENABLED ? 'disabled':'' ?>  />
        <input type="submit" value="Register" <?= !REGISTRATION_ENABLED ? 'disabled':'' ?> />
        <p class="create_account">
          <a href="index.php">Already have an account ?</a>
        </p>
      </form>
    </div>
  </body>
</html>

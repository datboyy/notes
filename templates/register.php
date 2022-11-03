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

      <?php
      if(!empty($templateVars['register_success']) && $templateVars['register_success'] > 0)
      {
      ?>
        <!-- Account has been created success -->
        <div class="alert">
          <div class="alert--success">
            <span class="medium">Your account has been created, you can now login using the login form.</span>
          </div> <!--/ .success -->
        </div> <!-- ./alert -->

      <?php
      }
      elseif(!empty($templateVars['register_success']) && $templateVars['register_success'] == -1)
      {
      ?>
        <!-- Username already in use -->
        <div class="alert">
          <div class="alert--error">
            <span class="medium">Username already in use, please pick another one.</span>
          </div> <!-- /.error -->
        </div> <!-- /.alert -->
      <?php
      }
      elseif(!empty($templateVars['password_missmatch']) && $templateVars['password_missmatch'])
      {
      ?>
        <!-- Password missmatch -->
        <div class="alert">
          <div class="alert--error">
            <span class="medium">Password & password confirmation missmatch.</span>
          </div> <!-- /.error -->
        </div> <!-- /.alert -->
      <?php
      }
      ?>
      <!-- Register form -->
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

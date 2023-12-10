<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style><?php include 'style.css'; ?></style>
    <script src="scripts.js" defer></script>
  </head>
  <body>
    <?php 
      require 'main.php';

      $username = $password = "";
      $usernameError = $passwordError = "";
      $redirect = true;

      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["username"])) {
          $usernameError = "Missing";
          $redirect = false;
        } 
        else {
          $username = test_input($_POST["username"]);
          if ($username != $user->getUsername()) {
            $usernameError = "Invalid";
            $redirect = false;
          }
        }

        if (empty($_POST["password"])) {
          $passwordError = "Missing";
          $redirect = false;
        } 
        else {
          $password = test_input($_POST["password"]);
          if ($password != $user->getPassword()) {
            $passwordError = "Wrong password";
            $redirect = false;
          } 
        }

        if ($redirect) {
          echo "<script> window.location.href = 'home.php';</script>";
          exit;
        }
      }
    ?>
    <h1 style="margin-top: 90px;">Read With Us</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <div class="div_login">
        <label for="username" style="margin-top: 30px;">Username<br></label><br>
        <input type="text" name="username" value="<?php echo $username;?>" size="62">
        <span class="error"><?php echo $usernameError;?></span><br>
        <label for="password" style="margin-top: 30px;">Password<br></label><br>
        <input type="password" name="password" value="<?php echo $password;?>" size="62">
        <span class="error"><?php echo $passwordError;?></span>
        <p class="p_forgot">Forgot password?</p>
        <button type="submit" class="btn_login">Login</button>
        <p class="p_signup">New user? <span class="signup">Sign up</span></p>
      </div>
    </form>
    
  </body>
</html>

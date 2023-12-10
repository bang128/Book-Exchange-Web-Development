
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Checkout Information</title>
    <style><?php include 'style.css'; ?></style>
    <script src="scripts.js" defer></script>
  </head>
  <body>
  <?php 
      require 'main.php';
      $fname = $lname = $email = $phone = $address = $city = $state = $zip_deli = $card = $exp = $security = $zip_pay = "";
      $fnameError = $lnameError = $emailError = $phoneError = $addressError = $cityError = $stateError = $zip_deliError = $cardError = $expError = $securityError = $zip_payError = "";

      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $redirect=true;

        list($fname, $fnameError, $redirect) = check_text_input(($_POST["fname"]), $fname, $fnameError, $redirect);
        list($lname, $lnameError, $redirect) = check_text_input(($_POST["lname"]), $lname, $lnameError, $redirect);
        list($address, $addressError, $redirect) = check_text_input(($_POST["address"]), $address, $addressError, $redirect);
        list($city, $cityError, $redirect) = check_text_input(($_POST["city"]), $city, $cityError, $redirect);
        list($state, $stateError, $redirect) = check_text_input(($_POST["state"]), $state, $stateError, $redirect);
        list($exp, $expError, $redirect) = check_text_input(($_POST["exp"]), $exp, $expError, $redirect);

        if (empty($_POST["email"])) {
          $emailError = "Missing";
          $redirect = false;
        } else {
          $email = test_input($_POST["email"]);
          if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailError = "Invalid";
            $redirect = false;
          }
        }

        if (empty($_POST["phone"])) {
          $phoneError = "Missing";
          $redirect = false;
        } else {
          $phone = test_input($_POST["phone"]);
          if (!filter_var($phone, FILTER_SANITIZE_NUMBER_INT)) {
            $phoneError = "Invalid";
            $redirect = false;
          }
        }

        if (empty($_POST["zip_deli"])) {
          $zip_deliError = "Missing";
          $redirect = false;
        } else {
          $zip_deli = test_input($_POST["zip_deli"]);
          if (!preg_match("/^[0-9]{5}?$/", $zip_deli)) {
            $zip_deliError = "Invalid";
            $redirect = false;
          }
        }

        if (empty($_POST["zip_pay"])) {
          $zip_payError = "Missing";
          $redirect = false;
        } else {
          $zip_pay = test_input($_POST["zip_pay"]);
          if (!preg_match("/^[0-9]{5}?$/", $zip_pay)) {
            $zip_payError = "Invalid";
            $redirect = false;
          }
        }

        if (empty($_POST["card"])) {
          $cardError = "Missing";
          $redirect = false;
        } else {
          $card = test_input($_POST["card"]);
          if (!preg_match("/^4[0-9]{12}?$/", $card)) {
            $cardError = "Invalid";
            $redirect = false;
            echo "Card Error";
          }
        }

        if (empty($_POST["security"])) {
          $securityError = "Missing";
          $redirect = false;
        } else {
          $security = test_input($_POST["security"]);
          if (!preg_match("/^[0-9]{3}?$/", $security)) {
            $securityError = "Invalid";
            $redirect = false;
          }
        }

        if($redirect) {
          echo "<script> window.location.href='confirmed.php' </script>";
          exit;
        }


      }
    ?>
    <button type="button" class="btn_back" onclick="go('searching.php')"><img class="img_back" src="img/back.png" alt="back_button"></button><br>
    <h4>Delivery Information</h4>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <div class="div_2">
        <div class="div_2_left">
          <label for="fname">First Name <span class="error"><?php echo $fnameError;?></span><br></label>
          <input type="text" id="fname" name="fname" value="<?php echo $fname;?>" size="50"><br>
          <label for="email">Email <span class="error"><?php echo $emailError;?></span><br></label>
          <input type="text" id="email" name="email" value="<?php echo $email;?>" size="50">
        </div>
        <div class="div_2_right">
          <label for="lname">Last Name <span class="error"><?php echo $lnameError;?></span><br></label>
          <input type="text" id="lname" name="lname" value="<?php echo $lname;?>" size="50"><br>
          <label for="phone">Phone <span class="error"><?php echo $phoneError;?></span><br></label>
          <input type="text" id="phone" name="phone" value="<?php echo $phone;?>" size="50">
        </div>
      </div>

      <div class="div_checkout">
        <label for="address">Address <span class="error"><?php echo $addressError;?></span><br></label>
        <input type="text" id="address" name="address" value="<?php echo $address;?>" size="115">
      </div>

      <div class="div_3" style="width: 90%;">
        <div class="div_3_left">
          <label for="city">City <span class="error"><?php echo $cityError;?></span><br></label>
          <input type="text" id="city" name="city" value="<?php echo $city;?>" size="25">
        </div>
        <div class="div_3_middle">
          <label for="state">State <span class="error"><?php echo $stateError;?></span><br></label>
          <input type="text" id="state" name="state" value="<?php echo $state;?>" size="25">
        </div>
        <div class="div_3_right">
          <label for="zip_deli">Zip Code <span class="error"><?php echo $zip_deliError;?></span><br></label>
          <input type="text" id="zip_deli" name="zip_deli" value="<?php echo $zip_deli;?>" size="25">        
        </div>
      </div>

      <br><hr class="hr_dashed">

      <h4>Payment Information</h4>

      <div class="div_checkout">
        <label for="card">Card Number <span class="error"><?php echo $cardError;?></span><br></label>
        <input type="text" id="card" name="card" value="<?php echo $card;?>" size="115">
      </div>

      <div class="div_3" style="width: 90%;">
        <div class="div_3_left">
          <label for="exp">Expiration Date <span class="error"><?php echo $expError;?></span><br></label>
          <input type="month" id="exp" name="exp" size="25" placeholder="yyyy-mm" value="<?php echo $exp;?>">
        </div>
        <div class="div_3_middle">
          <label for="security">Security Code <span class="error"><?php echo $securityError;?></span><br></label>
          <input type="text" id="security" name="security"  value="<?php echo $security;?>" size="25">
        </div>
        <div class="div_3_right" >
          <label for="zip_pay">Zip Code <span class="error"><?php echo $zip_payError;?></span><br></label>
          <input type="text" id="zip_pay" name="zip_pay" value="<?php echo $zip_pay;?>" size="25">
        </div>
      </div>
      <button type="submit" class="btn_checkout">Checkout</button><br>
    </form>
  </body>
</html>
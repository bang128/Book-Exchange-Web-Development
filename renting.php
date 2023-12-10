<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Renting Duration</title>
    <style><?php include 'style.css'; ?></style>
    <script src="scripts.js" defer></script>
  </head>
  <body>
    <?php 
      $start = $end = "";
      $startError = $endError = "";

      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $redirect = true;
        if (empty($_POST["start"])) {
          $startError = "Missing";
          $redirect = false;
        }
        else {
          $start = $_POST["start"];
        }
        
        if (empty($_POST["end"])) {
          $endError = "Missing";
          $redirect = false;
        }
        else {
          $end = $_POST["end"];
        }

        if ($redirect) {
          if ($start < $end) {
            $startError = $endError = "";
            echo "<script> window.location.href= 'checkout.php'; </script>";
            exit;
          
          }
          else {
            $startError = "Invalid";
            $endError = "Invalid";
            $start = $end = date('mm-dd-YYYY');
          }
        }
      }
    ?>
    <button type="button" class="btn_back" onclick="go('searching.php')"><img class="img_back" src="img/back.png" alt="back_button"></button><br>
    <h3 class="h3_rent">Renting Duration</h3>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <div class="div_rent">
        <label for="start">Start Date</label>
        <input type="date" id="start" name="start" value="<?php echo $start;?>">
        <span class="error"><?php echo $startError;?></span><br><br>
        <label for="end">End Date&nbsp;</label>
        <input type="date" id="end" name="end" value="<?php echo $end;?>">
        <span class="error"><?php echo $endError;?></span><br>
      </div>
      <button type="submit" class="btn_next">Next</button><br>
    </form>
  </body>
</html>
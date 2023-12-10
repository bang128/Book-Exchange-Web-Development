<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Adding Book</title>
    <style><?php include 'style.css'; ?></style>
    <script src="scripts.js" defer></script>
  </head>
  <body>
    <?php 
      require 'main.php';
      $name = $author = $year = $new = $photo = $sell = $rent = "";
      $nameError = $authorError = $yearError = $newError = $photoError = $sellError = $rentError = "";

      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        list($photo, $photoError, $redirect) = check_text_input(($_POST["photo"]), $photo, $photoError, true);
        $redirect=true;
        list($name, $nameError, $redirect) = check_text_input(($_POST["name"]), $name, $nameError, $redirect);
        list($author, $authorError, $redirect) = check_text_input(($_POST["author"]), $author, $authorError, $redirect);
        list($year, $yearError, $redirect) = check_text_input(($_POST["year"]), $year, $yearError, $redirect);
        list($new, $newError, $redirect) = check_text_input(($_POST["new"]), $new, $newError, $redirect);
        list($sell, $sellError, $redirect) = check_text_input(($_POST["sell"]), $sell, $sellError, $redirect);
        list($rent, $rentError, $redirect) = check_text_input(($_POST["rent"]), $rent, $rentError, $redirect);

        if ($redirect) {
          $book = new Book($name, $author, $year, $new, $photo, $sell, $rent, $user->getUsername());
          echo "<script>alert('The book is successfully added');</script>";
          echo "<script> location.href='home.php'; </script>";
          exit;
        }
      }
    ?>
    <button type="button" class="btn_back" data-inline="true" onclick="go('home.php')"><img class="img_back" src="img/back.png" alt="back_button"></button><br>
    <button type="button" class="btn_logout" data-inline="true" onclick="go('index.php')"><img class="img_logout" src="img/logout.png" alt="logout_button"></button>
    <button type="button" class="btn_personal_page" data-inline="true" onclick="go('personal.php')"><img class="img_personal_page" src="img/avt.png" alt="personal_page_button"></button>
    <h2>Adding Book</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <div class="div_add_name">
        <label for="name">Name <span class="error"><?php echo $nameError;?></span><br></label>
        <input type="text" id="name" name="name" value="<?php echo $name;?>" size="115">
        <br><br>
      </div>
      <div class="div_2">
        <div class="div_2_left">
            <label for="author">Author <span class="error"><?php echo $authorError;?></span><br></label>
            <input type="text" id="author" name="author" value="<?php echo $author;?>" size="50">
            <br><br>
            <label for="year">Publish Year <span class="error"><?php echo $yearError;?></span><br></label>
            <input type="number" id="year" name="year" min="1000" max="2023" step="1"  value="<?php echo $year;?>" class="input_number" size="51">
            <br><br>
            <label for="new">New Percentage <span class="error"><?php echo $newError;?></span><br></label>
            <input type="number" id="new" name="new" min="0" max="100" class="input_number" value="<?php echo $new;?>" size="51">
            <br><br>
        </div>
        <div class="div_2_right">
            <label for="photo">Photo <span class="error"><?php echo $photoError;?></span><br></label>
            <input type="file" id="photo" name="photo" class="btn_upload" value="<?php echo $photo;?>">
            <br><br>
            <label for="sell">Selling Price <span class="error"><?php echo $rentError;?></span><br></label>
            <input type="number" id="sell" name="sell" min="0.00" max="10000.00" step="0.01" class="input_number" value="<?php echo $sell;?>" size="51">
            <br><br>
            <label for="rent">Renting Price <span class="error"><?php echo $rentError;?></span><br></label>
            <input type="number" id="rent" name="rent" min="0.00" max="10000.00" step="0.01" class="input_number"  value="<?php echo $rent;?>" size="51">
            <br><br>
        </div>
      </div>
      <br><button type="submit" class="btn_add">Add</button><br>
    </form>
  </body>
</html>
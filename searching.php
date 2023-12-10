<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Searching Book</title>
    <style><?php include 'style.css'; ?></style>
    <script src="scripts.js" defer></script>
  </head>
  <body>
    <?php
                
      $query = "";
      $book_arr = array();
      $books= glob('books/*.txt');
      foreach ($books as $book) {
        array_push($book_arr, $book);
      }
      
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!empty($_POST["query"])) {
          $query = $_POST["query"];
          $query_lower= strtolower(trim($query));
          $book_arr = search($query_lower);
        }
      }
    

      function search($query) {
        $result = array();
        $books= glob('books/*.txt');
        foreach ($books as $book) {
          $b = str_replace("books/", "", $book);
          $b = str_replace(".txt", "", $b);
          $arr = explode('|', $b);
          $b = strtolower($arr[1]);
          if (strpos($b, $query) !== false) {
            array_push($result, $book);
          }         
        }
        return $result;

      }
      
    ?>
    <button type="button" class="btn_back" data-inline="true" onclick="go('home.php')"><img class="img_back" src="img/back.png" alt="back_button"></button><br>
    <button type="button" class="btn_logout" data-inline="true" onclick="go('index.php')"><img class="img_logout" src="img/logout.png" alt="logout_button"></button>
    <button type="button" class="btn_personal_page" data-inline="true" onclick="go('personal.php')"><img class="img_personal_page" src="img/avt.png" alt="personal_page_button"></button>
    <h2>Searching Book</h2>
    <form  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <div class="div_search" style="display: flex;">
        <input type="text" id="query" name="query" size="103" placeholder="Book Name">
        <button type="submit" class="btn_search">Search</button> 
      </div>
    </form>

    <div class="div_sort">
      
      <label for="sort">Sorted by:</label>
      <select name="" id="sort">
      <option value="none">None</option>
        <option value="new">New percentage</option>
        <option value="new_d">New percentage (desc)</option>
        <option value="year">Published year</option>
        <option value="year_d">Published year (desc)</option>
        <option value="sell_price">Selling price</option>
        <option value="sell_price_d">Selling price (desc)</option>
        <option value="rent_price">Renting price</option>
        <option value="rent_price_d">Renting price (desc)</option>
      </select>
      
    </div>

    <?php 
      foreach ($book_arr as $book) {
        $lines = file($book, FILE_SKIP_EMPTY_LINES|FILE_IGNORE_NEW_LINES);
    ?>

    <div class="div_searching">
    <img class="book_img" src="<?php echo $lines[4];?>" alt="book_image">
    <div style="margin-left: 40px;">
      <p style="margin-bottom:0px;"><b><?php echo $lines[0];?></b></p>
      <div class="div_3">
        <div class="div_3_book_left">
          <p style="margin-top:5px;">Author: <?php echo $lines[1];?></p>
          <p>New percentage: <?php echo $lines[3]."%";?></p>
          <p>Selling price: $<?php echo $lines[5];?></p>
        </div>
        <div class="div_3_book_middle">
          <p style="margin-top:5px;">Owner: <?php echo $lines[7];?></p>
          <p>Published year: <?php echo $lines[2];?></p>
          <p>Renting price (per day): $<?php echo $lines[6];?></p>
        </div>
        <div class="div_3_book_right">
          <button type="button" class="btn_rent" onclick="go('renting.php')">Rent</button><br>
          <button type="button" class="btn_buy" onclick="go('checkout.php')">Buy</button><br>
        </div>
      </div>   
    </div>
    </div>

    <?php }?>

  </body>
</html>
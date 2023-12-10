<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Personal Home Page</title>
    <style><?php include 'style.css'; ?></style>
    <script src="scripts.js" defer></script>
  </head>
  <body>
    <button type="button" class="btn_back" data-inline="true" onclick="go('home.php')"><img class="img_back" src="img/back.png" alt="back_button"></button>
    <button type="button" class="btn_logout" data-inline="true" onclick="go('index.php')"><img class="img_logout" src="img/logout.png" alt="logout_button"></button> <br>
    <img class="img_avt" src="img/avt.png" alt="avatar">
    <?php
      require 'main.php';
      $lines = file($user->getUserFile());
    ?>
    <h4 class="h4_username"><?php echo $lines[0]; ?></h4>
    <p class="p_email"><?php echo $lines[2]; ?></p>
    <div class="div_book_list">
      <p>List of books for sale/rent:</p>
      <?php       
        $books= glob('books/*.txt');
        foreach ($books as $book) {
          $b = str_replace("books/", "", $book);
          $b = str_replace(".txt", "", $b);
          $arr = explode('|', $b);
          if (trim($arr[0]) == trim($lines[0])) {     
      ?>
      <div class="div_book">
        <p data-inline="true"> <?php echo $arr[1];?></p>
        <form method="post">
          <button type="submit" name="delete" value="<?php echo $book;?>" class="btn_delete" data-inline="true"><img class="img_forbook" src="img/delete.png" alt="delete_button"></button>
          <button type="button" class="btn_edit" data-inline="true"><img class="img_forbook" src="img/edit.png" alt="edit_button"></button>
        </form>
      </div>
      <?php } } ?>
    </div>

    <?php
    if(isset($_POST['delete']))
    {
      unlink($_POST['delete']);
      echo "<script> window.location.href = 'personal.php';</script>";
      exit;
    }
    ?>

  </body>
</html>
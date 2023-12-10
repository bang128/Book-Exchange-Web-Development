<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Home</title>
    <style><?php include 'style.css'; ?></style>
    <script src="scripts.js" defer></script>
  </head>
  <body>
    <button type="button" class="btn_logout" data-inline="true" onclick="go('index.php')"><img class="img_logout" src="img/logout.png" alt="logout_button"></button>
    <button type="button" class="btn_personal_page" data-inline="true" onclick="go('personal.php')"><img class="img_personal_page" src="img/avt.png" alt="personal_page_button"></button>
    <br>
    <h3 class="h3_home">What do you want to do?</h3>
    <button type="button" class="btn_add_book" onclick="go('adding.php')">Add Book</button><br>
    <button type="button" class="btn_search_book" onclick="go('searching.php')">Search Book</button>
  </body>
</html>
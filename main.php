<?php 
class Book {
    private $name, $author, $year, $new, $photo, $sell_price, $rent_price, $owner, $bookFile;
    function __construct($name, $author, $year, $new, $photo, $sell_price, $rent_price, $owner) {
        $this->name = $name;
        $this->author = $author;
        $this->year = $year;
        $this->new = $new;
        $this->photo = "books/img/".$photo;
        $this->sell_price = $sell_price;
        $this->rent_price = $rent_price;
        $this->owner = $owner;
        $this->bookFile = "books/".$owner."|".$name.".txt";
        $file = fopen($this->bookFile, "w");
        fwrite($file, 
        $name."\n".
        $author."\n".
        $year."\n".
        $new."\n".
        "books/img/".$photo."\n".
        $sell_price."\n".
        $rent_price."\n".
        $owner
        );
        fclose($file);
    }
    function setName($name) {$this->name = $name;}
    function setAuthor($author) {$this->author = $author;}
    function setYear($year) {$this->year = $year;}
    function setNew($new) {$this->new = $new;}
    function setSellPrice($sell_price) {$this->sell_price = $sell_price;}
    function setRentPrice($rent_price) {$this->rent_price = $rent_price;}

    function getName() {return $this->name;}
    function getAuthor() {return $this->author;}
    function getYear() {return $this->name;}
    function getNew() {return $this->new;}
    function getSellPrice() {return $this->sell_price;}
    function getRentPrice() {return $this->rent_price;}
    function getBookFile() {return $this->bookFile;}
}
class User{
    private $username, $password, $email, $userFile;

    function __construct($username, $password, $email) {
        $this->username = $username;
        $this->password=$password;
        $this->email=$email;
        $this->userFile = "users/".$username.".txt";
        $file = fopen($this->userFile, "w") or die("Fail to open");
        fwrite($file, 
        $this->username."\n".
        $this->password."\n".
        $this->email."\n");
        fclose($file);
    }

    function setUsername($username) {$this->username=$username;}
    function getUsername() {return $this->username;}
    function setPassword($password) {$this->password=$password;}
    function getPassword() {return $this->password;}
    function setEmail($email) {$this->email=$email;}
    function getEmail() {return $this->email;}
    function getUserFile() {return $this->userFile;}
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function check_text_input($post, $input, $error, $redirect) {
    if (empty($post)) {
        $error = "Missing";
        $redirect=false;
      } 
    else {
        $input = test_input($post);
      }
    return array($input, $error, $redirect);
} 

function extract_data($files, $key) {
    $result = array();
    foreach ($files as $file) {
        $lines = file($file);
        array_push($result, array($file, $lines[$key]));
    }

    return result;
}

$user = new User("uop_student", "123456789", "uop_student@gmail.com");

?>


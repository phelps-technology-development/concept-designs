<?php
session_start();
include_once("connect.php");
include_once("database.php");

if (isset($_SESSION['user_id'])) {

  if (isset($_GET['getUserbyUserName'])) {
    $query = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $query->bindValue(1, $_GET['getUserbyUserName']);
    $query->execute();
    
    $num = $query->rowCount();
    
    if ($num == 1) {
      ?>
      Add User
      <?php
    } else {
      ?>
      No Such User
      <?php
    }
  } else {
      echo "failed request";
  }

} else {
    echo "USER NOT LOGGED IN";
}
?>

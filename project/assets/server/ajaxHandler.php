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
  }
  if (isset($_GET['getUserbyUserNameINPUT'])) {
    $query = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $query->bindValue(1, $_GET['getUserbyUserNameINPUT']);
    $query->execute();

    $num = $query->rowCount();

    if ($num == 1) {

      $result = $query->fetch(PDO::FETCH_ASSOC);

      ?>
      <input type="hidden" name="members[]" value="<?php echo $result['id']; ?>">
      <input type="text" value="<?php echo $result['fname'] . ' ' . $result['lname']; ?>" class="container-5 font-size-10" disabled>
      <?php
    } else {
      ?>
      No Such User
      <?php
    }
  }

} else {
    echo "USER NOT LOGGED IN";
}
?>

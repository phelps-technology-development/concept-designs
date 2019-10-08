<?php
session_start();
include_once("../assets/server/connect.php");
include_once("../assets/server/database.php");

$database = new Database;

if (isset($_SESSION['user_id'])) {

  $user = $database->getUser($_SESSION['user_id']);

  ?>

<html>
<head>
  <title>Opus Dashboard</title>
  <link rel="stylesheet" href="../../concept-designs/styles/version0.1.0/scss/main.css">
</head>
<body class="font-trebuchet bg-dark text-light">
  <div class="heroImage heroImage-full height-100" style="background-image: url('../assets/images/coast.jpg');">
    <div class="row">
      <div class="columns-2 text-dark">
        <div class="card bg-light box-shadow-dark-60">
          <div class="container-30">
            <h1>Welcome, <?php echo $user['fname'] . " " . $user['lname']; ?>!</h1>
          </div>
        </div>
        <div class="card bg-light box-shadow-dark-60">
          <div class="container-30">
            <h1>Welcome, <?php echo $user['fname']; ?>!</h1>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>

  <?php
} else {
  echo "FAIL";
}
?>

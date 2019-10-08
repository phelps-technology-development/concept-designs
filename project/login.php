<?php
session_start();
include_once("assets/server/connect.php");
include_once("assets/server/database.php");

$database = new Database;

if (isset($_POST['login'])) {
  $message = $database->login($_POST['username'], md5($_POST['password']));
  if ($message == "Login Successful") {
    header("Location: app/index.php");
    exit();
  } else {
    echo $message;
  }
}

?>
<html>
<head>
  <title>Opus</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../concept-designs/styles/version0.1.0/scss/main.css">
</head>
<body class="font-trebuchet bg-light text-dark">
  <div class="row bg-dark text-light">
    <div class="columns-2 text-dark">
      <div class="column bg-dark text-light height-100 container-30">
        <h1>Log In</h1>
        <form action="login.php" method="post" class="container-30 text-light">
          <b><?php if (isset($message)) { echo $message; } ?></b>
          <b>Username</b><br><br>
          <input type="text" name="username" placeholder="Username..." class="bg-light text-dark"><br><br>
          <b>Password</b><br><br>
          <input type="password" name="password" placeholder="Password..." class="bg-light text-dark"><br><br>
          <input type="submit" name="login" class="btn bg-light text-dark">
        </form>
      </div>
      <div class="column mobile-hidden height-100" style="background-image: url('assets/images/desk.jpg'); background-size: cover;">
      </div>
    </div>
  </div>
</body>
</html>

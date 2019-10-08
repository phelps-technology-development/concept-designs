<?php
session_start();
include_once("assets/server/connect.php");
include_once("assets/server/database.php");

$database = new Database;

if (isset($_POST['signup'])) {
  $message = $database->createUser($_POST['username'], md5($_POST['password']), md5($_POST['cpassword']), $_POST['fname'], $_POST['lname'], strtotime($_POST['bday']), $_POST['email'], $_POST['phone']);
  if ($message == "User Created Successfully") {
    header("Location: login.php");
    exit();
  }
}

?>
<html>
<head>
  <title>Opus</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://www.phelpstechdev.com/v2/assets/plugin/styles/version0.1.0/scss/main.css">
</head>
<body class="font-trebuchet bg-light text-dark">
  <div class="row bg-dark text-light">
    <div class="columns-2 text-dark">
      <div class="column bg-dark text-light height-100 container-30">
        <h1>Sign Up</h1>
        <form action="signup.php" method="post" class="container-30 text-light">
          <b><?php if (isset($message)) { echo $message; } ?></b>
          <b>Username</b><br><br>
          <input type="text" name="username" placeholder="Username..." class="bg-light text-dark"><br><br>
          <b>Password</b><br><br>
          <input type="password" name="password" placeholder="Password..." class="bg-light text-dark"><br><br>
          <b>Confirm Password</b><br><br>
          <input type="password" name="cpassword" placeholder="Confirm Password..." class="bg-light text-dark"><br><br>
          <b>First Name</b><br><br>
          <input type="text" name="fname" placeholder="First Name..." class="bg-light text-dark"><br><br>
          <b>Last Name</b><br><br>
          <input type="text" name="lname" placeholder="Last Name..." class="bg-light text-dark"><br><br>
          <b>Birthday</b><br><br>
          <input type="date" name="bday" class="text-dark" class="bg-light text-dark"><br><br>
          <b>Email Address</b><br><br>
          <input type="email" name="email" placeholder="Email Address..." class="bg-light text-dark"><br><br>
          <b>Phone Number</b><br><br>
          <input type="text" name="phone" placeholder="Phone Number..." class="bg-light text-dark"><br><br>
          <input type="submit" name="signup" class="btn bg-light text-dark">
        </form>
      </div>
      <div class="column mobile-hidden height-100" style="background-image: url('assets/images/desk.jpg'); background-size: cover;">
      </div>
    </div>
  </div>
</body>
</html>

<?php
include_once("../../assets/connect.php");
include_once("../../assets/database.php");


?>
<html>
<head>
  <title>Opus | Create Team</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://www.phelpstechdev.com/v2/assets/plugin/styles/version0.1.0/scss/main.css">
</head>
<body class="font-trebuchet bg-light text-dark">
  <div class="row bg-dark text-light">
    <div class="columns-2 text-dark">
      <div class="column bg-dark text-light height-100 container-30">
        <h1>Create a Team</h1>
        <form action="team.php" method="post" class="container-30 text-light">
          <b><?php if (isset($message)) { echo $message; } ?></b>
          <b>Name Your Team</b><br><br>
          <input type="text" name="name" placeholder="Name of Team..." class="bg-light text-dark"><br><br>
          <b>Password (leave blank for no password)</b><br><br>
          <input type="password" name="password" placeholder="Team Password..." class="bg-light text-dark"><br><br>
          <input type="submit" name="login" class="btn bg-light text-dark">
        </form>
      </div>
      <div class="column mobile-hidden height-100" style="background-image: url('../../assets/images/desk.jpg');">
      </div>
    </div>
  </div>
</body>
</html>

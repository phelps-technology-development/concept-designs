<?php
session_start();
include_once("../../assets/server/connect.php");
include_once("../../assets/server/database.php");
$database = new Database;
if (isset($_SESSION['user_id'])) {
  $user = $database->getUser($_SESSION['user_id']);
  $friends = explode(", ", $user['friends']);

  if (isset($_POST['createTeam'])) {

    if (empty($_POST['members'])) {
      $members = array($user['id']);
    } else {
      $members = $_POST['members'];
      $isIn = in_array($user['id'], $members);
      if (!$isIn) {
        array_push($members, $user['id']);
      }
    }

   $message = $database->createTeam($_POST['name'], md5($_POST['password']), md5($_POST['cpassword']), implode(", ", $members), "user", $user['id']);
  }

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
        <form action="team.php" method="post" class="container-30 text-light" autocomplete="off">
          <b><?php if (isset($message)) { echo $message; } ?></b>
          <b>Name Your Team</b><br><br>
          <input type="text" name="name" placeholder="Name of Team..." class="bg-light text-dark"><br><br>
          <b>Password (leave blank for no password)</b><br><br>
          <input type="password" name="password" placeholder="Team Password..." class="bg-light text-dark"><br><br>
          <b>Confirm Password (leave blank for no password)</b><br><br>
          <input type="password" name="cpassword" placeholder="Confirm Team Password..." class="bg-light text-dark"><br><br>
          <b>Add Friends to Team</b><br><br>
          <div class="row">
            <div class="columns-3">
              <div class="column2">
                <input type="text" id="userNameAuto" placeholder="Type Username of Friend Here..." oninput="autoDetectUser()" autocomplete="off">
              </div>
              <div class="column">
                <button type="button" class="btn bg-green text-light container-11 font-size-16" style="width: 100%;" id="userButton" onclick="addUser()">Add User</button>
              </div>
            </div>
          </div>
          <br>
          <div id="userHolder">
          </div>
          <br>
          <input type="submit" name="createTeam" class="btn bg-light text-dark">
        </form>
      </div>
      <div class="column mobile-hidden height-100" style="background-image: url('../../assets/images/desk.jpg');">
      </div>
    </div>
  </div>
  <script>

    function addUser() {
      var input = document.getElementById("userNameAuto").value;
      var holder = document.getElementById("userHolder");

      var xmlt = new XMLHttpRequest();

      xmlt.onreadystatechange = function() {
       if (this.readyState == 4 && this.status == 200) {
         holder.innerHTML += xmlt.responseText;
       }
      }

      xmlt.open("GET", "../../assets/server/ajaxHandler.php?getUserbyUserNameINPUT=" + input, true);
      xmlt.send();
    }

    function autoDetectUser() {

      var input = document.getElementById("userNameAuto").value;
      var btn = document.getElementById("userButton");

      var xmlt = new XMLHttpRequest();

      xmlt.onreadystatechange = function() {
       if (this.readyState == 4 && this.status == 200) {
         btn.innerText = xmlt.responseText;
         btn.classList.replace("bg-red", "bg-green");
         btn.disabled = false;
         if (btn.innerText.includes("No Such User")) {
          btn.disabled = true;
          btn.classList.replace("bg-green", "bg-red");
         }
       }
      }

      xmlt.open("GET", "../../assets/server/ajaxHandler.php?getUserbyUserName=" + input, true);
      xmlt.send();

    }
  </script>
</body>
</html>

<?php

} else {
  header("Location: ../../login.php");
  exit();
}
?>

<?php
session_start();
include_once("../../assets/server/connect.php");
include_once("../../assets/server/database.php");
$database = new Database;
if (isset($_SESSION['user_id'])) {
  $user = $database->getUser($_SESSION['user_id']);
  $friends = explode(", ", $user['friends']);
  
  if (isset($_POST['createTeam'])) {
   $message = $database->createTeam($_POST['name'], md5($_POST['password']), md5($_POST['cpassword']), implode(", ", $_POST['members']), "team", "0"); 
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
        <form action="team.php" method="post" class="container-30 text-light">
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
                <input type="text" id="userNameAuto" placeholder="Type Username of Friend Here..." oninput="autoDetectUser()">
              </div>
              <div class="column">
                <button type="button" class="btn bg-green text-dark container-4 font-size-10" id="userButton" onclick="AddUser">Add User</button>
              </div>
            </div>
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
    function autoDetectUser() {
      
      var input = document.getElementById("userNameAuto").value;
      var btn = document.getElementById("userButton");
      
      var xmlt = new XMLHttpRequest();
      
      xmlt.onreadystatechange = function() {
       if (this.readyState == 4 && this.status == 200) {
         btn.innerHTML = xmlt.responseText;
         btn.classList.replace("bg-red", "bg-green");
         if (xmlt.responseText == "No Such User") {
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

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
          <b>Add Friends to Team (make sure to check yourself)</b><br><br>
          <?php
            foreach ($friends as $friend) {
              $data = $database->getUser($friend);
              ?>
              <input type="checkbox" name="members[]" value="<?php echo $friend; ?>" id="<?php echo $friend; ?>"><label for="<?php echo $friend; ?>"><?php echo $data['fname'] . " " . $data['lname']; ?> <br><br></label>
          <?php
            }
          ?>
          <input type="submit" name="createTeam" class="btn bg-light text-dark">
        </form>
      </div>
      <div class="column mobile-hidden height-100" style="background-image: url('../../assets/images/desk.jpg');">
      </div>
    </div>
  </div>
</body>
</html>

<?php
  
} else {
  header("Location: ../../login.php");
  exit();
}  
?>

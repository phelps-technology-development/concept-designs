<?php

class Database {
  
  public function createTeam($name, $password, $cpassword, $members, $type, $parent) {
    global $pdo;
    
    if (empty($name) || empty($members) || empty($type) || empty($parent)) {
      $response = "All fields must be filled.";
    } else if ($password != $cpassword) {
      $response = "Passwords must match. ";
    } else {
      $query = $pdo->prepare("INSERT INTO teams (name, password, members, type, parent) VALUES (?, ?, ?, ?, ?)");
      $query->bindValue(1, $name);
      $query->bindValue(2, $password);
      $query->bindValue(3, $members);
      $query->bindValue(4, $type);
      $query->bindValue(5, $parent);
      $query->execute();
    }
  }

  public function getUser($id) {

    global $pdo;

    $query = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $query->bindValue(1, $id);
    $query->execute();

    return $query->fetch();

  }

  public function createUser($username, $password, $cpassword, $fname, $lname, $bday, $email, $phone) {

    global $pdo;

    if (empty($username) || empty($password) || empty($fname) || empty($lname) || empty($bday) || empty($email) || empty($phone)) {
      $response = "All fields must be filled.";
    } else if ($password != $cpassword) {
      $response = "Both passwords provided must match.";
    } else {

      $query = $pdo->prepare("INSERT INTO users (username, password, fname, lname, bday, email, phone, friends) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
      $query->bindValue(1, $username);
      $query->bindValue(2, $password);
      $query->bindValue(3, $fname);
      $query->bindValue(4, $lname);
      $query->bindValue(5, $bday);
      $query->bindValue(6, $email);
      $query->bindValue(7, $phone);
      $query->bindValue(8, "0");
      $query->execute();

      $result = $this->checkCreateUserSuccess($username, $password, $fname, $lname, $bday, $email, $phone);

      if ($result) {
        $response = "User Succesfully Created";
      } else {
        $response = "User Not Created";
      }

    }
    return $response;
  }

  private function checkCreateUserSuccess($username, $password, $fname, $lname, $bday, $email, $phone) {

    global $pdo;

    $query = $pdo->prepare("SELECT * FROM users WHERE username = ? AND password = ? AND fname = ? AND lname = ? AND bday = ? AND email = ? AND phone = ?");
    $query->bindValue(1, $username);
    $query->bindValue(2, $password);
    $query->bindValue(3, $fname);
    $query->bindValue(4, $lname);
    $query->bindValue(5, $bday);
    $query->bindValue(6, $email);
    $query->bindValue(7, $phone);
    $query->execute();

    $rows = $query->rowCount();

    if ($rows == 1) {
      return true;
    } else {
      return false;
    }

  }

  public function login($username, $password) {

    global $pdo;

    $query = $pdo->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $query->bindValue(1, $username);
    $query->bindValue(2, $password);
    $query->execute();

    $num = $query->rowCount();
    $user = $query->fetch(PDO::FETCH_ASSOC);

    if ($num != 1) {
      $response = "Incorrect Username or Password";
    } else {
      $_SESSION['user_id'] = $user['id'];
      $response = "Login Successful";
    }

    return $response;

  }

}

?>

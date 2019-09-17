<?php

if (isset($_POST['signup-submit'])) {

  require 'dbhand.php';

  $username = $_POST['userid'];
  $email = $_POST['email'];
  $pwd = $_POST['password'];
  $pwdRepeat = $_POST['repeat-password'];

  if (empty($username) || empty($username) || empty($email) || empty($pwd) || empty($pwdRepeat)) {
    header("Location: ./signup.php?error=emptyfields&=".$username."&mail=".$email);
    exit();
  }
  elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
    header("Location: signup.php?error=invalidemailid=");
    exit();
  }
  elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: signup.php?error=invalidemail&userid=".$username);
    exit();
  }
  elseif (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
    header("Location: signup.php?error=invalidemail&userid=".$email);
    exit();
  }
  elseif ($pwd !== $pwdRepeat) {
    header("Location: signup.php?error=passwordcheckuid=".$username."&email=".$email);
    exit();
  }
  else {
      $sql = "SELECT userUID FROM users WHERE userUID=?";
      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: signup.php?error=sqlerror");
        exit();
      }
      else {
      mysqli_stmt_bind_param($stmt, "s", $username);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_store_result($stmt);
      $resultCheck = mysqli_stmt_num_rows($stmt);
      if ($resultCheck > 0) {
        header("Location: ../signup.php?error=usertaken&mail=".$email);
        exit();
      }
      else {

        $sql = "INSERT INTO users (userUID, userEmail, userPwd) VALUES (?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
          header("Location: signup.php?error=sqlerror");
          exit();
        }
        else {
          mysqli_stmt_bind_param($stmt, "sss", $username, $emai, $pwd);
          mysqli_stmt_execute($stmt);
          mysqli_stmt_store_result($stmt);
        }
    }
  }

}

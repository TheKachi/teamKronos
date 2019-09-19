<?php

if (isset($_POST['signup-submit'])) {

  require 'dbhand.php';

  $username = $_POST['userid'];
  $email    = $_POST['email'];
  $pwd      = $_POST['password'];
  $pwdRepeat = $_POST['repeat-password'];

  if (empty($username) || empty($email) || empty($pwd)) {
    header("Location: ../signup.php?error=true&message=Fields cannot be empty!&username=$username&email=$email");
    exit();
  }
  elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
    header("Location:  ../signup.php?error=true&message=Email format is not allowed!&username=$username&email=$email");
    exit();
  }
  elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location:  ../signup.php?error=true&message=Email is invalid, please check mail and try again!&username=$username&email=$email");
    exit();
  }
  elseif (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
    header("Location:  ../signup.php?error=true&message=Username format is not allowed, pleas use only (a-zA-Z0-9)!&username=$username&email=$email");
    exit();
  }
  elseif ($pwd !== $pwdRepeat) {
    header("Location:  ../signup.php?error=true&message=Password does not match!&username=$username&email=$email");
    exit();
  }
  else {
      $sql = "SELECT * FROM users WHERE username=?";
      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location:  ../signup.php?error=true&message=An unexpected error occured, please try again!&username=$username&email=$email");
        exit();
      }
      else {
      mysqli_stmt_bind_param($stmt, "s", $username);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_store_result($stmt);
      $resultCheck = mysqli_stmt_num_rows($stmt);
      if ($resultCheck > 0) {
        header("Location: ../signup.php?error=true&message=Username or email has been taken, please use another!&username=$username&email=$email");
        exit();
      }
      else {

        $sql = "INSERT INTO users (username, email, pwd) VALUES (?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
          header("Location:  ../signup.php?error=true&message=An unexpected error occured, please try again!&username=$username&email=$email");
          exit();
        }
        else {
          $hash_pass = password_hash($pwd, PASSWORD_DEFAULT);
          mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hash_pass);
          mysqli_stmt_execute($stmt);
          mysqli_stmt_store_result($stmt);
          header("Location:  ../signin.php?success=true&message=Account Created succesfully!&process=Sign in to continue!");
          exit();
        }
    }
  }
}

}

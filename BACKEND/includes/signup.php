<?php

  require 'dbhand.php';

  $fullname  = $_POST['fullname'];
  $username = $_POST['username'];
  $email    = $_POST['email'];
  $pwd      = $_POST['password'];
  $pwdRepeat = $_POST['repeat_password'];

  $message = '';
  
  $ok = false;
  if (empty($fullname) || empty($username)  || empty($email) || empty($pwd)) {
    $statusCode = http_response_code(422);
    $message .= 'Fields cannot be empty!';
  }
  elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
    $statusCode = http_response_code(422);
    $message .= 'Email format is not allowed!';
  }
  elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $statusCode = http_response_code(422);
    $message .= 'Email is invalid, please check mail and try again!';
  }
  elseif (!preg_match("/^[a-zA-Z ]*$/", $fullname)) {
    $statusCode = http_response_code(422);
    $message .= 'Name format is not allowed please use only (a-zA-Z0-9)!';
  }
  elseif (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
    $statusCode = http_response_code(422);
    $message .= 'Username format is not allowed, please use only (a-zA-Z0-9)!';
  }
  elseif ($pwd !== $pwdRepeat) {
    $statusCode = http_response_code(422);
    $message .= 'Password does not match!';
  }
  else {
      $sql = "SELECT * FROM users WHERE username=?";
      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        $statusCode = http_response_code(500);
        $message .= 'An unexpected error occured, please try again!';
      }
      else {
      mysqli_stmt_bind_param($stmt, "s", $username);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_store_result($stmt);
      $resultCheck = mysqli_stmt_num_rows($stmt);
      if ($resultCheck > 0) {
        $statusCode = http_response_code(401);
        $message .= 'Username or email has been taken, please use another!';
      }
      else {

        $sql = "INSERT INTO users (fullname, username, email, pwd, token, created) VALUES (?, ?, ?, ?, ?, NOW())";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
          $statusCode = http_response_code(500);
          $message .= 'An unexpected error occured, please try again!';
        }
        else {
          $hash_pass = password_hash($pwd, PASSWORD_DEFAULT);
          //generate token for user permit
          $token = crypt($fullname.$username.$email, '$5$rofgfgs3%*%45090$uwdfefhsd8543m3d3o78dj8salt$');
          mysqli_stmt_bind_param($stmt, "sssss", $fullname, $username, $email, $hash_pass, $token);
          mysqli_stmt_execute($stmt);
          mysqli_stmt_store_result($stmt);
          // set response code
          $ok = true;
          $statusCode = http_response_code(201);
          $message .= 'Account Created succesfully!';
        }
    }
  }
}

echo json_encode(array(
  "ok" => $ok,
  "statusCode" => $statusCode,
  "message" => $message
));


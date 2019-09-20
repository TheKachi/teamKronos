<?php

    require 'dbhand.php';

    $prermit = $_POST['user_permit'];
    $pwd      = $_POST['password'];

    $message = '';
    
    $ok = false;
    $user = null;

    if (empty($prermit) || empty($pwd)) {
        $statusCode = http_response_code(422);
        $message .= 'Fields cannot be empty!';
    }else {
        $sql = "SELECT * FROM users WHERE username=? OR email=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            $statusCode = http_response_code(500);
            $message .= 'An unexpected error occured, please try again!';
        }else {
            mysqli_stmt_bind_param($stmt, "ss", $prermit, $prermit);
            mysqli_stmt_execute($stmt);
            $result_set = mysqli_stmt_get_result($stmt);
            $num_rows = mysqli_num_rows($result_set);
            $result = $result_set->fetch_assoc();
            if($result != null) {
                if(password_verify($pwd, $result['pwd'])){
                    $ok = true;
                    $statusCode = http_response_code(200);
                    $message .= 'Successfully logged in!';
                    unset($result['pwd']);
                    $user = $result;
                }else {
                    $statusCode = http_response_code(401);
                    $message .= 'Invalid credential details!';
                }
            }else {
                $statusCode = http_response_code(404);
                $message .= 'User not found!';
            }
        }
    }

// output a response
echo json_encode(array(
    "ok" => $ok,
    "statusCode" => $statusCode,
    "message" => $message,
    "user" => $user
  ));
  
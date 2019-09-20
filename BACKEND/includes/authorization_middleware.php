<?php
//require the connection
require 'dbhand.php';

$headers = apache_request_headers();
if($headers["key"] == "verifying_user") {
    //Get the bearer token and check if the user is part of use
    $bearer_token =  $headers["Authourization"];
    //explode the bearer tpken to an arrray to get the token 
    $filter_token = explode(" ", $bearer_token);
    $token = $filter_token[1];
    //checkthe database if the user exit using the token

    $sql = "SELECT * FROM users WHERE token=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $statusCode = http_response_code(500);
        $message .= 'An unexpected error occured, please try again!';
    }else {
        mysqli_stmt_bind_param($stmt, "s", $token);
        mysqli_stmt_execute($stmt);
        $result_set = mysqli_stmt_get_result($stmt);
        $num_rows = mysqli_num_rows($result_set);
        $result = $result_set->fetch_assoc();
        if($result != null) {
            $ok = true;
            $statusCode = http_response_code(200);
            $message .= 'Authourization Successfull!';
            unset($result['pwd']);
            $user = $result;
        }else {
            $statusCode = http_response_code(401);
            $message .= 'Unauthorize Acess or Invalid Token!';
            // output a response
            echo json_encode(array(
                "ok" => $ok,
                "statusCode" => $statusCode,
                "message" => $message,
                "key" => 'verifying_user',
                "user" => $user
            ));
            exit();
        }
    }
}

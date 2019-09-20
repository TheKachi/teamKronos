<?php


 $message = '';
 $ok = false;
 $user = null;
//Check if the user is part of us using from Berear token
require 'authorization_middleware.php';



// output a response
echo json_encode(array(
    "ok" => $ok,
    "statusCode" => $statusCode,
    "message" => $message,
    "user" => $user
  ));
  
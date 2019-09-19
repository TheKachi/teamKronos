<?php
session_start();
    if($_SESSION['username']){
        $username = $_SESSION['username'];
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
</head>
<body>
    <p>This is the dashboard and <span style="color: green;"><?php echo $username ?></span> is login ...kudos</p>
</body>
</html>
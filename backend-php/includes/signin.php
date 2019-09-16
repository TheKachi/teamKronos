<?php
session_start();
if (isset($_POST['signin-submit'])) {

    require 'dbhand.php';

    $prermit = $_POST['userpermit'];
    $pwd      = $_POST['pwd'];

    if (empty($prermit) || empty($pwd)) {
        header("Location: ../signin.php?error=true&message=Fields cannot be empty!&prermit= $prermit");
        exit();
    }
    else {
        $sql = "SELECT * FROM users WHERE username=? OR email=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location:  ../signin.php?error=true&message=An unexpected error occured, please try again!&username=$prermit");
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt, "ss", $prermit, $prermit);
            mysqli_stmt_execute($stmt);
            $result_set = mysqli_stmt_get_result($stmt);
            $num_rows = mysqli_num_rows($result_set);
            $result = $result_set->fetch_all();
            $user = $result[0];
            if($user != null) {
                var_dump($pwd, $result[0][3]);
                if(password_verify($pwd, $result[0][3])){
                    $_SESSION['username'] = $result[0][1];
                    header("Location:  ../dashboard.php?success=true");
                    exit();
                }else {
                    header("Location:  ../signin.php?error=true&message=Invalid credential details!&permit=$prermit");
                    exit();
                }
            }
        }
    }

}

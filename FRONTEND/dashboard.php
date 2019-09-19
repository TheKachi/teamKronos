<?php
session_start();
 error_reporting(0);
  require "header.php";
    if($_SESSION['username']){
        $id = $_SESSION['id'];
        $fullname = $_SESSION['fullname'];
        $username = $_SESSION['username'];
        $email = $_SESSION['email'];
    }

?>
    <div class="dashbord">
      <p style="text-align:center;">This is the dashboard and <span style="color: brown;"><?php echo $fullname ?></span> with username: <span style="color: green;"><?php echo $username ?></span> and email: <span style="color: hotpink;"><?php echo $email ?></span> is <span style="color:dodgerblue;">logged in</span> ...hurray</p>
    </div>
</body>
</html>
<?php
error_reporting(0);
  require "header.php";
  if($_GET['error']) {
    $message = $_GET['message'];
    $username = $_GET['username'];
    $email = $_GET['email'];
    $error =  "<div class='error_field'> $message </div>";
  }else {
    $message = '';
    $username = '';
    $email = '';
    $error = '';
  }
?>

  <main class="wrapper">
    <div class="section-default">
      <?php
       echo $error;
      ?>
      <h1>Sign Up</h1>
      <form class="signup-form" action="includes/signup.php" method="post">
        <input type="text" name="userid" placeholder="Username" value="<?php if(!$username == ''){echo $username; } ?>"> <br><br>
        <input type="text" name="email" placeholder="Email" value="<?php  if(!$email == ''){ echo $email; } ?>"> <br><br>
        <input type="password" name="password" placeholder="Password"> <br><br>
        <input type="password" name="repeat-password" placeholder="Confirm Password"> <br><br>
        <button type="submit" name="signup-submit">SIGN UP</button>
      </form>
      <br>
        <a href="signin.php">Already have an account? SignIn</a>
  </main>

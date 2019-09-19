
<?php
require "header.php";
 error_reporting(0);
 if($_GET['error'])   {
    $message = $_GET['message'];
    $permit = $_GET['permit'];
    $error =  "<div class='error_field'> $message </div>";
 }
?>
<main class="wrapper">
    <div class="section-default">
      <?php
       echo $error;
      ?>
      <h1>Sign In</h1>
      <form action="includes/signin.php" method="post">
        <input type="text" name="userpermit" placeholder="Username/Email.." value="<?php if(!$permit == ''){echo $permit; }?>"> <br><br>
        <input type="password" name="pwd" placeholder="Password.."> <br><br>
        <button type="submit" name="signin-submit">Signin</button>
     </form><br>
        <a href="signup.php">Don't have an account? SignUp</a>
  </main>
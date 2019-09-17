<?php
  require "header.php";
?>

  <main class="wrapper">
    <div class="section-default">
      <h1>Sign Up</h1>
      <form class="signup-form" action="includes/signup.php" method="post">
        <input type="text" name="userid" placeholder="Username">
        <input type="text" name="email" placeholder="Email">
        <input type="password" name="password" placeholder="Password">
        <input type="password" name="repeat-password" placeholder="Confirm Password">
        <button type="submit" name="signup-submit">SIGN UP</button>
      </form>
  </main>

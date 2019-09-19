<?php
error_reporting(0);
  require "header.php";
  if($_GET['error']) {
    $message = $_GET['message']; 
    $fullname = $_GET['fullname'];
    $username = $_GET['username'];
    $email = $_GET['email'];
    $error =  "<div class='error_field'><br> $message </div>";
  }else {
    $message = '';
    $username = '';
    $email = '';
    $error = '';
  }
?>
        <div class="intro">
        <h1 style="text-align:center;">Sign Up</h1>  
              <?php
                echo $error;
              ?> 
        </div>
        <div id="signup-box">
            <div class="reg-content">
                <div class="Reg-box-content">
                        <img class="ellipse-image2" src="images/Ellipse.png" alt="ellipse image">
                        <img class="ellipse-image2 B-image2" src="images/B.png" alt="letter B-image">
                        <img class="ellipse-image2 L-image2" src="images/L.png" alt="Letter L-image">
                    <h1 id="regname">BitLender</h1>
                    <P id="paragraph3">The best, online, peer-to-peer lending platform that<br> offers the most affordable interest rate.</P>
                    <form class="signup-form" action="../BACKEND/includes/signup.php" method="post">
                        <input type="text" name="fullname" placeholder="Firstname Lastname" value="<?php  if(!$fullname == ''){ echo $fullname; } ?>" required >
                        <input type="text" name="userid" placeholder="Username" minlength="4" maxlength="6"  value="<?php  if(!$username == ''){ echo $username; } ?>" required >
                        <input type="email" name="email" placeholder="Email" value="<?php  if(!$email == ''){ echo $email; } ?>" required>
                        <input type="password"  name="password" placeholder="Enter password" required >
                        <input type="password"  name="repeat-password" placeholder="Retype password" required >

                        <input type="submit" class="submit-btn" name="signup-submit" value="Sign Up">
                        <a class="access_link" href="signin.php">Already have an account? SignIn</a>
                    </form>
                </div>
            </div>
        </div><br>
    </body>
  </html>
 
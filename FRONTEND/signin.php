
<?php
require "header.php";
 error_reporting(0);
 if($_GET['error'])   {
    $message = $_GET['message'];
    $permit = $_GET['permit'];
    $error =  "<div class='error_field'> <br> $message </div>";
 }
?>
        <div class="intro" style="margin-bottom:-30px; margin-top:10px;">
              <?php
                echo $error;
              ?> 
        </div>
 <div id="login-box">
                <div class="left-box">
                    <div class="left-box-content">
                        <h1 id="loginname">BitLender</h1>
                        <P id="paragraph1">The best, online, peer-to-peer lending platform that <br>offers the most affordable interest rate.</P>
        
                        <a href="signup.php" ><button class="Reg-button">Register</button></a>
                    </div>    
                </div>

                <div class="right-box">
                    <div class="right-box-content">
                            <img class="ellipse-image" src="images/Ellipse.png" alt="ellipse image">
                            <img class="ellipse-image B-image" src="images/B.png" alt="letter B-image">
                            <img class="ellipse-image L-image" src="images/L.png" alt="Letter L-image">
                            <P id="paragraph2">Welcome back, BitLender!<br> Kindly login to access your account.</P>
                            <form action="../BACKEND/includes/signin.php" method="post">
                              <input type="text" id="user1" name="userpermit" placeholder="Username/Email.." value="<?php if(!$permit == ''){echo $permit; }?>" required >
                              <input type="password" id="psw1"  name="pwd" placeholder="Password" required >                          
                              <button class="submit-btn" type="submit" name="signin-submit">Signin</button>
                            </form> 
                            <button class="signin-facebook">Login via Facebook</button>

                            <h5 id="forgotpassword" >Forgot password</h5>
                    </div>
                </div>
        </div>
</body>
</html>
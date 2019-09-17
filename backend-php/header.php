<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width-device-width", initial-scale="1">
    <title>Header</title>
    <link rel="stylesheet" href="styles/style.css">
  </head>
  <body>

    <header>

        <nav class="nav=header-main">
            <a class="header-logo" href="#">
              <img src="#" alt="logo">
            </a>
            <ul>
              <li><a href="index.php">Home</li>
              <li><a href="#">About</li>
              <li><a href="#">Contact Us</li>
            </ul>

            <div class="header-login">
              <form action="includes/login.php" method="post">
                <input type="text" name="mailuid" placeholder="Username/Email..">
                <input type="password" name="passwd" placeholder="Password..">
                <button type="submit" name="login-submit">LOGIN</button>
              </form>
              <a href="signup.php">SignUp</a>

              <form action="includes/logout.php" method="post">
                <button type="submit" name="logout-submit">LOGOUT</button>
              </form>

            </div>
        </nav>

    </header>

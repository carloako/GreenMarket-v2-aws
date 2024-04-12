<?php include $_SERVER['DOCUMENT_ROOT'] . "/php/connections/session/session.php" ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/php/components/head.php' ?>
  <!-- Custom Stylesheets -->
  <link href="/css/user-access.css" rel="stylesheet" />
</head>

<body>
  <?php
  if (isset($_GET['error']))
    $error = $_GET['error'];
  ?>
  <div id="page-container">
    <div id="content-wrap">
      <header>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/php/components/header.php' ?>
      </header>
      <!-- Common header section ends here -->
      <!-- P5: Login section starts here -->
      <div>
      <!-- login box part -->
      <form method="post" action="/pages/login-page/login-procedure.php" style="border: 1px">
        <h2>User Login page</h2>
        <div class="container">
          <label for="username"><b>Username</b></label>
          <input type="text" placeholder="Enter username" name="username" id="username" required />
          <label for="password"><b>Password</b></label>
          <input type="password" placeholder="Enter password" name="password" id="password" required />
          <?php
          if (isset($error)) {
            echo "<div class='bg-danger warning'><p>$error</p></div>";
          }
          ?>
          <p>
            <a href="/extra/forgotpassword.html" style="font-size:80%; float: right;">Forgot your password?</a>
          </p>
          <input id="loginBtn" class="loginBtn" type="submit" value="Log in" name="login">
        </div>
        <!-- create an account link -->
        <div class="container signin">
          <p style="font-size:90%;">
            Not a member yet?
            <a href="/sign-up" id="signin"> Create an account</a>
          </p>
        </div>
      </form>
      </div>
      <!-- common footer section starts  -->
      <?php include $_SERVER['DOCUMENT_ROOT'] . '/php/components/footer.php' ?>
    </div>
    <!-- Install JavaScrip plugins and Popper -->
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/php/javascripts/js.php' ?>
</body>

</html>
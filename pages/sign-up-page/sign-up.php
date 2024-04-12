<?php
$errorVisibility = "display:none;";
if (isset($_GET['error'])) {
  $errorVisibility = "display:block;";
}
include $_SERVER['DOCUMENT_ROOT'] . "/php/connections/session/session.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/php/components/head.php' ?>
  <!-- Custom Stylesheets -->
  <link href="/css/stylesheet.css" rel="stylesheet" />
  <link href="/css/user-access.css" rel="stylesheet" />
</head>

<body>
  <div id="page-container">
    <div id="content-wrap">
      <header>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/php/components/header.php' ?>
      </header>
      <p><br /></p>
      <p><br /></p>
      <div style=<?php echo $errorVisibility ?>>
        <p>Error:
          <?php echo $_GET['error'] ?>
        </p>
      </div>
      <h2>Sign up</h2>
      <form id="signup-form" method="post" action="/pages/sign-up-page/sign-up-procedure.php"
        onsubmit="return checkPassword();" style="border: 1px">
        <?php
        if (isset($errors) && count($errors) > 0) {
          echo '<ul>';
          foreach ($errors as $e) {
            echo '<li>' . $e . '</li>';
          }
        }
        ?>
        <div class="container">
          <input class="btn btn-outline-secondary btn-small" type="reset" value="Reset" />

          <h3>Account information</h3>
          <p><br /></p>
          <label for="e-mail"><b>E-mail</b></label>
          <input type="text" placeholder="Enter e-mail" name="email" id="email" required />

          <label for="username"><b>Username</b></label>
          <input type="text" placeholder="Enter username" name="username" id="username" required />
          <p id="username-error"></p>

          <label for="Password"><b>Password (8 characters minimum)</b></label>
          <input type="password" placeholder="Enter password" name="password" id="password" minlength="8" required />

          <label for="Repeat-password"><b>Repeat password</b></label>
          <input type="password" placeholder="Repeat password" name="repeatpassword" id="repeatpassword" required />
          <p id="password-error"></p>
          <hr />
          <h3>Delivery Information</h3>
          <p><br /></p>
          <label for="first-name"><b>First name</b></label>
          <input type="text" placeholder="Enter your first name" name="firstname" id="firstname" required />

          <label for="last-name"><b>Last name</b></label>
          <input type="text" placeholder="Enter your last name" name="lastname" id="lastname" required />

          <label for="Home-address"><b>Address</b></label>
          <input type="text" placeholder="Enter your address" name="homeaddress" id="homeaddress" required />

          <label for="City"><b>City</b></label>
          <input type="text" placeholder="Enter your city" name="city" id="city" required />

          <div>
            <p id="pc-error"></p>
          </div>

          <label for="Postal-code"><b>Postal code</b></label>
          <input type="text" placeholder="Enter your postal code" name="postalcode" id="postalcode" required />
          <p><br /></p>

          <p>
            <br />
            By creating an account you agree to our
            <a href="#">Terms & Privacy</a>.
          </p>
          <br />
          <input type="submit" value="Sign up" />
        </div>

        <div class="container signin">
          <p>
            Already have an account?
            <a href="/login" id="signin">Sign in</a>.
          </p>
        </div>
      </form>
    </div>
    <!-- common footer section starts  -->
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/php/components/footer.php' ?>
  </div>
  <!-- Install JavaScrip plugins and Popper -->
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/php/javascripts/js.php' ?>
  <script>
    // check postal code
    var pcTextField = document.getElementById('postalcode');
    var errorPC = document.getElementById('pc-error');
    pcTextField.addEventListener("change", checkPC);

    function checkPC() {
      var postalCode = pcTextField.value;
      var result = postalCode.search(/[A-Z][0-9][A-Z]-[0-9][A-Z][0-9]/i)
      if (result == -1) {
        pcTextField.value = "";
        errorPC.innerHTML = "Invalid postal code. Format should be like A1A-1B1";
      } else {
        pcTextField.value = postalCode.toUpperCase();
        errorPC.innerHTML = "";
      }
    }

    // check password for change and submit;
    let passwordTF = document.getElementById('password');
    let repeatpasswordTF = document.getElementById('repeatpassword');
    let errorPassword = document.getElementById('password-error');
    passwordTF.addEventListener("change", checkPassword);
    repeatpasswordTF.addEventListener("change", checkPassword);

    function checkPassword() {
      var password = passwordTF.value;
      var rpassword = repeatpasswordTF.value;
      let passwordString = password.toString();
      let rpasswordString = rpassword.toString();
      let result = passwordString.localeCompare(rpasswordString);
      if (result != 0) {
        errorPassword.innerHTML = "not matching";
        return false;
      } else {
        errorPassword.innerHTML = "matching";
      }
    }
  </script>
</body>

</html>
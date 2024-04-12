<?php
include $_SERVER['DOCUMENT_ROOT'] . "/php/connections/session/session.php";
include $_SERVER['DOCUMENT_ROOT'] . "/php/connections/sql/mysqlconnect.php";
if (isset($_GET['error'])) {
  $error = "";
  $errorMsg = "Order failed!";
} else {
  $error = "visually-hidden";
  $errorMsg = "";
}
if (isset($_GET['success'])) {
  $sucess = "";
  $successMsg = "Item ordered!";
} else {
  $success = "visually-hidden";
  $successMsg = "";
}
$overviewBox = "";
if (!isset($_SESSION['username'])) {
  $overviewBox = "visually-hidden";
} else {
  if (!$conn) {
    header("Location: ../error.php?error=Datasdabase connection error.");
  } else {
    $username = $_SESSION['username'];
    $sql = "SELECT * FROM Shopping_Cart WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 0) {
      $overviewBox = "visually-hidden";
    }
  }
}
// mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php include $_SERVER['DOCUMENT_ROOT'] . "/php/components/head.php" ?>
  <!-- Custom Stylesheets -->
  <link href="/css/shopping-cart.css" rel="stylesheet" />
</head>

<body>
  <div>
    <div>

      <?php include $_SERVER['DOCUMENT_ROOT'] . "/php/components/header.php" ?>

      <!-- P4 shopping cart section starts -->
      <div class="alert alert-warning d-flex align-items-center <?php echo $error ?>" role="alert">
        <div class="">
          <?php echo $errorMsg ?>
        </div>
      </div>
      <div class="alert alert-success <?php echo $success ?>" role="alert">
        <?php echo $successMsg ?>
      </div>
      <div>
        <h1 class="hr-text">Shopping Cart</h2>
      </div>
      <div class="container-fluid">
        <section class="product" id="product">
          <div class="box-container-sc">
            <p class="sc-empty" id="sc-empty-text">Shopping cart empty!</p>
            <form id="scform" class="scform" method="post" action="/pages/shopping-cart-page/delete-item.php">
              <!-- read cart -->
              <?php include "read-cart-sql.php" ?>
            </form>
            <!-- <input type="button" id="btn-save-changes" value="Save Changes"> -->
          </div>
          <div class="overviewprice-box <?php echo $overviewBox ?>" id="overviewprice-box">
            <div class="overviewprice">
              <form id="form-payment" action="/pages/shopping-cart-page/add-order-sql.php" method="post">
                <p><b>Total(w/o tax):</b> <span id="totalwotax"></span></p>
                <p><b>GST/HST:</b> <span id="gst"></span></p>
                <hr />
                <p><b>Total:</b> <span id="total"></span></p>
                <input type="hidden" name="totalinput" id="totalinput">
                <input id="subbut" type="submit" value="Order" disabled>
              </form>
            </div>
          </div>
        </section>
      </div>
    </div>
    <!-- shopping cart section ends -->

    <!-- common footer section starts-->
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/php/components/footer.php" ?>
  </div>

  <!-- Install JavaScrip plugins and Popper -->
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/php/javascripts/js.php' ?>
  <script src="P4.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', calculateTotalOnLoad, false);
    window.addEventListener("load", function() {
  document.getElementById("subbut").disabled=false; // or removeAttribute("disabled")
})
    // check user and cart
    function checkUser() {
      <?php
      if (session_id() == "0") {
        echo "alert(\"You must be logged in to place an order\")";
      } else if (count($_SESSION) == 0) {
        echo "alert(\"Cart Empty\");";
      } else {
        echo "document.getElementById(\"form-payment\").submit();";
      }
      ?>
    }

    // calculate total on load
function calculateTotalOnLoad() {
    var totalWOTax = 0;
    var tax = 0;
    var total = 0;
    if (document.getElementsByName("productq[]").length != 0) {
        var product = document.getElementsByName("productq[]");
        var price = document.getElementsByName("price[]");
        for (var i = 0; i < product.length; i++) {
            totalWOTax += product[i].value * price[i].value;
        }
        tax = totalWOTax * 0.05;
        total = tax + totalWOTax;
        document.getElementById("totalwotax").innerHTML = "$" + totalWOTax.toFixed(2);
        document.getElementById("gst").innerHTML = "$" + tax.toFixed(2);
        document.getElementById("total").innerHTML = "$" + total.toFixed(2);
        document.getElementById("totalinput").value = total.toFixed(2);
        document.getElementById("btn-save-changes").style.display = "block";
        document.getElementById("overviewprice-box").style.display = "block";
    } else {
        document.getElementById("totalwotax").innerHTML = "$0.00";
        document.getElementById("gst").innerHTML = "$0.00";
        document.getElementById("total").innerHTML = "$0.00";
        document.getElementById("totalinput").value = 0;
        document.getElementById("sc-empty-text").style.display = "block";
    }
}

    // make event handlers for plus buttons with php
    var plusButtons = document.getElementsByName("plus");
    <?php
    for ($i = 0; $i < count($_SESSION); $i++) {
      echo "plusButtons[$i].onclick = function (){qButtons[$i].value = parseInt(qButtons[$i].value) + 1;calculateTotal()};";
    }
    ?>

    // make event handlers for minus buttons with php
    var minusButtons = document.getElementsByName("minus");
    <?php
    for ($i = 0; $i < count($_SESSION); $i++) {
      echo "minusButtons[$i].onclick = function (){if(qButtons[$i].value != 1){qButtons[$i].value = parseInt(qButtons[$i].value) - 1;calculateTotal()}};";
    }
    ?>
  </script>
</body>

</html>
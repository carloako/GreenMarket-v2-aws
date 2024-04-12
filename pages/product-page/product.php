<?php
include $_SERVER['DOCUMENT_ROOT'] . "/php/connections/session/session.php";
if (!isset($_GET['productID'])) {
  header("Location: ../error.php?error=productID is not set");
}

include $_SERVER['DOCUMENT_ROOT'] . '/php/connections/sql/mysqlconnect.php';
if (!$conn) {
  header("Location: ../error.php?error=database connection error");
} else {
  $productID = $_GET['productID'];
  $sql = "SELECT name, price, onsale_price, onsale FROM Products Where id = $productID;";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    if ($row = mysqli_fetch_assoc($result)) {
      $productName = ucfirst($row['name']);
      $imageName = strtolower($productName);
      $isOnSale = $row['onsale'] == 1 ? true : false;
      $price = $isOnSale ? $row['onsale_price'] : $row['price'];
      // $description = isset($row['description'])
      $description = '';
      $desc2 = '';
    }
  }
}
// if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
//   $url = "https://";
// else
//   $url = "http://";
// // Append the host(domain name, ip) to the URL.   
// $url .= $_SERVER['HTTP_HOST'];

// // Append the requested resource location to the URL   
// $url .= $_SERVER['REQUEST_URI'];

// echo $url;

// print_r($_GET);
if (isset($_GET['error'])) {
  $error = "";
  $errorMsg = "You need to login to add items to cart!";
} else {
  $error = "visually-hidden";
  $errorMsg = "";
}
if (isset($_GET['success'])) {
  $sucess = "";
  $successMsg = "Successfully added to cart!";
} else {
  $success = "visually-hidden";
  $successMsg = "";
}
$quantity = 1;
$total = $price;
if (isset($_SESSION['username'])) {
  $username = $_SESSION['username'];
  $productID = $_GET['productID'];
  $sql = "SELECT quantity FROM Shopping_Cart WHERE username = '$username' AND productID = '$productID'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    if ($row = mysqli_fetch_assoc($result)) {
      $quantity = $row['quantity'];
      $total = $quantity * $price;
    }
  }
}
include $_SERVER['DOCUMENT_ROOT'] . '/php/connections/sql/mysqldisconnect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php include $_SERVER['DOCUMENT_ROOT'] . "/php/components/head.php" ?>
  <link href="/css/stylesheet.css" rel="stylesheet" />
  <link href="/css/product.css" rel="stylesheet" />
  <script src="/pages/product-page/P3.js" async></script>
</head>

<body id="body">
  <?php include $_SERVER['DOCUMENT_ROOT'] . "/php/components/header.php" ?>
  <div class="background">
    <div class="content">
      <div class="alert alert-warning d-flex align-items-center <?php echo $error ?>" role="alert">
        <div class="">
          <?php echo $errorMsg ?>
        </div>
      </div>
      <div class="alert alert-success <?php echo $success ?>" role="alert">
        <?php echo $successMsg ?>
      </div>
      <div class="row grid-container whitebg whole-bd">
        <div class="item1">
          <?php echo "<img src=\"/images/product-images/$imageName.jpg\" width=\"200\" height=\"200\"></br>"; ?>
          <?php echo "<h3>$productName</h3>"; ?>
          <hr style="width:200px;" align="left" />
          <?php printf("%s%.2f%s", "<p class = \"description\">\$", $price, "</p>"); ?>
        </div>
        <div class="item2">
          <h3>Product Description</h3>
          <?php
          echo "<p id = \"description\">$description<span id = \"dots\">...</span><span id = \"more\">$desc2</span></p>";
          ?>
          <button type="button" onclick="readMore();" id="readmore">More Description</button>
        </div>
        <div class="item3">
          <form action="/pages/product-page/put-in-cart-sql.php" method="post">
            <div class="atc"><label for="quantity">Quantity: </label>
              <input class="plus-minus-button" type="button" value="-" id="minus">
              <input type="text" style="text-align:center;padding:2px;border:none;" size="5" name="quantity"
                id="quantity" value="<?php echo "$quantity"; ?>" readonly />
              <input class="plus-minus-button" type="button" value="+" id="plus">
            </div>
            <div class="atc"><label for="subtotal">Total: </label><input type="text" style="" id="subtotal"
                name="subtotal" value="<?php printf("\$%.2f", $total) ?>" readonly></div>
            <div class="atc"><input type="submit" id="submit" value="Add to Cart" /></div>
            <?php
            echo "<input type = \"hidden\" id = \"productID\" name = \"productID\" value = \"$productID\" readonly>";
            echo "<input type = \"hidden\" id = \"hidden-price\" name = \"hidden-price\" value = \"$price\" readonly>";
            ?>
          </form>
        </div>
      </div>
    </div>
    <!-- common footer section starts  -->
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/php/components/footer.php" ?>
  </div>
  <!-- Install JavaScrip plugins and Popper -->
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/php/javascripts/js.php' ?>
</body>

</html>
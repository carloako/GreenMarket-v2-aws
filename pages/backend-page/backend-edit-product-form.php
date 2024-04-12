<?php
include $_SERVER['DOCUMENT_ROOT'] . '/php/connections/sql/mysqlconnect.php';
if (!$conn) {
    header("Location: /error.php?error=database connection error");
} else {
    $productID = $_GET['productID'];
    $sql = "SELECT name, price, onsale, onsale_price, product_type FROM Products Where id = $productID;";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $productName = $row['name'];
            $price = $row['price'];
            $onsale = $row['onsale'] ? true : false;
            if($onsale) {
                $readonly = "";
                $onsalePrice = $row['onsale_price'];
                $decimalPos2 = strpos($onsalePrice, '.');
                $onsaleWholeNumPrice = substr($onsalePrice, 0, $decimalPos2);
                $onsaleDecimalNumPrice = substr($onsalePrice, $decimalPos2 + 1);
            } else {
                $readonly = "readonly";
                $onsaleWholeNumPrice = 0;
                $onsaleDecimalNumPrice = 0;
            }
            $decimalPos = strpos($price, '.');
            $wholeNumPrice = substr($price, 0, $decimalPos);
            $decimalNumPrice = substr($price, $decimalPos + 1);
            $productType = $row['product_type'];
            echo "<div class=\"w-50 mx-auto my-4\">\n";
            echo "  <form id=\"myForm\" class=\"row g-3 needs-validation\" action=\"/pages/backend-page/edit-product.php\" method=\"get\" novalidate>";
            echo "      <div class=\"col-3\">";
            echo "          <label for=\"productID\" class=\"form-label\">Product ID</label>";
            echo "          <input type=\"text\" class=\"form-control disabled\" id=\"productID\" name=\"productID\" value=\"$productID\" readonly>";
            echo "      </div>";
            echo "      <div class=\"col-9\">";
            echo "          <label for=\"productName\" class=\"form-label\">Product Name</label>";
            echo "          <input type=\"text\" class=\"form-control\" id=\"productName\" name=\"productName\" value=\"$productName\" required>";
            echo "      </div>";
            echo "      <div class=\"col-4\">";
            echo "          <label for=\"price\" class=\"form-label\">Price</label>";
            echo "          <div class=\"input-group mb-3\">";
            echo "          <input type=\"text\" class=\"form-control\" id=\"price\" name=\"price\" maxlength=\"5\" value=\"$wholeNumPrice\" required>";
            echo "          <span class=\"input-group-text\">.</span>";
            echo "          <input type=\"text\" class=\"form-control\" id=\"decimalPrice\" name=\"decimalPrice\" maxlength=\"2\" value=\"$decimalNumPrice\">";
            echo "          </div>";
            echo "      </div>";
            echo "      <div class=\"col-4\">";
            echo "          <label for=\"onsale\" class=\"form-label\">Onsale</label>";
            echo "          <input type=\"checkbox\" onchange=\"changeOnsaleBox(this)\" class=\"form-check\" id=\"onsale\" name=\"onsale\" value=\"\">";
            echo "          <input type=\"hidden\" id=\"onsaleValue\" name=\"onsaleValue\" value=\"$onsale\">";
            echo "      </div>";
            echo "      <div class=\"col-4\">";
            echo "          <label for=\"onsalePrice\" class=\"form-label\">Onsale Price</label>";
            echo "          <div class=\"input-group mb-3\">";
            echo "          <input type=\"text\" class=\"form-control\" id=\"onsalePrice\" name=\"onsalePrice\" maxlength=\"5\" value=\"$onsaleWholeNumPrice\" $readonly>";
            echo "          <span class=\"input-group-text\">.</span>";
            echo "          <input type=\"text\" class=\"form-control\" id=\"decimalOnsalePrice\" name=\"decimalOnsalePrice\" maxlength=\"2\" value=\"$onsaleDecimalNumPrice\" $readonly>";
            echo "          </div>";
            echo "      </div>";
            echo "      <div class=\"col-12\">";
            echo "          <input type=\"submit\" value=\"Submit\">";
            echo "      </div>";
            echo "  </form>";
            echo "</div>";
        }
    }
}
include $_SERVER['DOCUMENT_ROOT'] . '/php/connections/sql/mysqldisconnect.php';
?>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/php/connections/sql/mysqlconnect.php';
if (!$conn) {
    header("Location: /error.php?error=database connection error");
} else {
    $sql = "SELECT id, name, price, onsale, onsale_price, product_type FROM Products ORDER BY product_type, id";
    $result = mysqli_query($conn, $sql);
    echo '<div class="m-4 p-4 border border-4 rounded-3 bg-white">' . "\n";
    echo "<a href=\"backend/add-product\" class=\"btn mb-2\">Add Product</a>";
    if (mysqli_num_rows($result) > 0) {
        $productType = "";
        while ($row = mysqli_fetch_assoc($result)) {
            $isSame = strcmp($productType, $row['product_type']) == 0 ? true : false;
            if (strlen($productType) == 0 or !$isSame) {
                $productType = $row['product_type'];
                echo "<div class=\"row mb-3\">";
                echo '<div class="col-12">';
                echo "  <h1 class=\"\">" . strtoupper($productType) . "</h1>";
                echo '</div>';
                echo "</div>";
                echo "<div class=\"row text-center mb-3\">";
                echo "<div class=\"col-1 fs-2 fw-bolder\">ID</div>\n";
                echo "<div class=\"col-3 fs-2 fw-bolder\">Name</div>\n";
                echo "<div class=\"col-2 fs-2 fw-bolder\">Price</div>\n";
                echo "<div class=\"col-2 fs-2 fw-bolder\">Onsale</div>\n";
                echo "<div class=\"col-2 fs-2 fw-bolder\">Onsale Price</div>\n";
                echo "</div>";
            }
            $productID = $row['id'];
            $productName = $row['name'];
            $price = $row['price'];
            $onsale = $row['onsale'] == true ? "Yes" : "No";
            $onsalePrice = $row['onsale_price'] ? "" . $row['onsale_price'] : "N/A";
            echo '<div class="row text-center mb-3">' . "\n";
            echo "<div class=\"col-1 fs-2\">$productID</div>\n";
            echo "<div class=\"col-3 fs-2\">$productName</div>\n";
            echo "<div class=\"col-2 fs-2\">$price</div>\n";
            echo "<div class=\"col-2 fs-2\">$onsale</div>\n";
            echo "<div class=\"col-2 fs-2\">$onsalePrice</div>\n";
            echo "<div class=\"col-1\"><a class=\"fa-solid fa-pencil fa-xl\" href=\"backend/edit/$productID\"></a></div>\n";
            echo "<div class=\"col-1\"><a class=\"fa-solid fa-trash-can fa-xl\" href=\"/pages/backend-page/delete-product.php?productID=$productID\"></a></div>\n";
            echo '</div>' . "\n";
        }
    }
    echo '</div>' . "\n";
}
include $_SERVER['DOCUMENT_ROOT'] . '/php/connections/sql/mysqldisconnect.php';
?>
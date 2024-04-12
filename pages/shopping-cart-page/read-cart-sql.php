<?php
if (!$conn) {
    header("Location: /error.php?error=read-cart-sql");
} else {
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        $sql = "SELECT Shopping_Cart.username, Shopping_Cart.productID, Shopping_Cart.quantity, Products.name, Products.price, Products.onsale, Products.onsale_price
            FROM Shopping_Cart
            INNER JOIN Products ON Shopping_Cart.productID = Products.ID
            WHERE Shopping_Cart.username = '$username'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) { 
            $name = $row['name'];
            $key = $row['productID'];
            $picturename = strtolower($name);
            $quantity = $row['quantity'];
            $price = 0;
            if ($row['onsale']) {
                $price = $row['onsale_price'];
            } else {
                $price = $row['price'];
            }
            echo "<div class=\"box-sc\">";
            echo "<img src=\"/images/product-images/$picturename.jpg\" alt=\"$name\" width = \"200\" height = \"200\" style = 'border-radius:10px;'>";
            echo "<h3>$name</h3>";
            echo "<div class=\"$quantity\">";
            echo "<div><span style = \"font-size:19px;\">Quantity: </span>
            <input class=\"plus-minus-button\" type=\"button\" value=\"-\" name = \"minus\" id=\"\">
            <input type=\"number\" value=\"$quantity\" size = \"3\" name = \"productq[]\" id = \"$key\" min = \"0\" readonly>
            <input class=\"plus-minus-button\" type=\"button\" value=\"+\" id=\"\" name = \"plus\"></div>";
            echo "<input type = \"hidden\" name = \"productID\" value = \"$key\">";
            echo "<input type = \"hidden\" name = \"price[]\" value = \"$price\">";
            echo "</div>";
            echo "<div class=\"price\"><span>Price: </span> \$$price</div>";
            echo "<button type = \"submit\" name = \"$key\" class=\"btn dlt\">Delete item</button>";
            echo "<a href=\"/home\" class=\"btn\">Continue shopping</a>";
            echo "</div>";
            }
        }
    }
}
mysqli_close($conn);
?>

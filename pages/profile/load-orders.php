<?php
if (!$conn) {
    header("Location: ../error.php?error=Database connection error.");
} else {
    $username = $_SESSION['username'];
    $sql = "SELECT order_ID, total_price FROM Orders WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class=\"row text-center border border-2 py-2 rounded-2\">";
            echo "  <div class=\"col-3\">Order ID</div>";
            echo "  <div class=\"col-3\">Total Price</div>";
            echo "  <div class=\"col-6\"></div>";
            $orderID = $row['order_ID'];
            $totalPrice = $row['total_price'];
            echo "  <div class=\"col-3\">$orderID</div>";
            echo "  <div class=\"col-3\">$totalPrice</div>";
            echo "  <div class=\"col-6\"></div>";
            $sql = "SELECT name, quantity FROM Order_Items INNER JOIN Products WHERE order_ID = $orderID AND productID = id";
            $result2 = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result2) > 0) {
                echo "  <div class=\"col-3\">Product Name</div>";
                echo "  <div class=\"col-3\">Quantity</div>";
                echo "  <div class=\"col-6\"></div>";
                while ($row = mysqli_fetch_assoc($result2)) {
                    $productName = $row['name'];
                    $quantity = $row['quantity'];
                    echo "  <div class=\"col-3\">$productName</div>";
                    echo "  <div class=\"col-3\">$quantity</div>";
                    echo "  <div class=\"col-6\"></div>";
                }
            }
            echo "</div>";
        }
    }
}
?>
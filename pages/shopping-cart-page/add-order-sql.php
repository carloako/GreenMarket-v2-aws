<?php
include $_SERVER['DOCUMENT_ROOT'] . "/php/connections/session/session.php";
include $_SERVER['DOCUMENT_ROOT'] . "/php/connections/sql/mysqlconnect.php";
if (!$conn)
    header("Location: ../error.php?error=Database connection error.");

// insert
$username = $_SESSION['username'];
$totalPrice = $_POST['totalinput'];
$insertSQL = "INSERT INTO Orders ( username, total_price) VALUES ('$username', $totalPrice)";
if (!mysqli_query($conn, $insertSQL)) {
    header("Location: /shopping-cart/error");
}

// get order id
$orderID = mysqli_insert_id($conn);

// get cart
$sql = "SELECT productID, quantity FROM Shopping_Cart WHERE username = '$username'";
$result2 = mysqli_query($conn, $sql);
if (mysqli_num_rows($result2) === 0)
    header("Location: /shopping-cart/error");

// insert cart items to order items
while ($row = mysqli_fetch_assoc($result2)) {
    $productID = $row['productID'];
    $quantity = $row['quantity'];
    $insertSQL = "INSERT INTO Order_Items (order_ID, productID, quantity) VALUES ($orderID, $productID, $quantity)";
    if (!mysqli_query($conn, $insertSQL))
        header("Location: /shopping-cart/error");
}

// remove shopping cart
$deleteSQL = "DELETE FROM Shopping_Cart WHERE username = '$username'";
if (!mysqli_query($conn, $deleteSQL)) 
    header("Location: /shopping-cart/error");

// redirect to shopping_cart
header("Location: /shopping-cart/success");

include $_SERVER['DOCUMENT_ROOT'] . "/php/connections/sql/mysqldisconnect.php";
?>
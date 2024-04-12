<?php
include $_SERVER['DOCUMENT_ROOT'] . "/php/connections/session/session.php";
include $_SERVER['DOCUMENT_ROOT'] . "/php/connections/sql/mysqlconnect.php";
echo "asdasdsa";
if (!$conn) {
    header("Location: ../error.php?error=database connection error");
} else {
    echo "2";
    $productID = $_POST['productID'];
    echo "3";
    if (!isset($_SESSION['username'])) {
        header("Location: /product/$productID/loginerror");
    } else {
        echo "4";
        $username = $_SESSION['username'];
        $quantity = $_POST['quantity'];
        $sql = "INSERT INTO Shopping_Cart (username, productID, quantity) VALUES ('$username', $productID, $quantity)";
        if (mysqli_query($conn, $sql)) {
            header("Location: /product/$productID/successful");
        } else {
            header("Location: ../error.php?error=Insert data to database error.");
        }
        echo "6";
    }
}
include $_SERVER['DOCUMENT_ROOT'] . "/php/connections/sql/mysqldisconnect.php";
?>
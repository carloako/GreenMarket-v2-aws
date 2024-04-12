<?php
include $_SERVER['DOCUMENT_ROOT'] . "/php/connections/session/session.php";
include $_SERVER['DOCUMENT_ROOT'] . "/php/connections/sql/mysqlconnect.php";

if (!$conn) {
    header("Location: /error.php?error=Database connection error.");
} else {
    $username = $_SESSION['username'];
    $productID = $_POST['productID'];
    $sql = "DELETE FROM Shopping_Cart WHERE username = '$username' AND productID = $productID";

    if (mysqli_query($conn, $sql)) {
        header("Location: /shopping-cart/success");
    } else {
        header("Location: /shopping-cart/error");
    }
}

include $_SERVER['DOCUMENT_ROOT'] . "/php/connections/sql/mysqldisconnect.php";
?>
<?php

include $_SERVER['DOCUMENT_ROOT'] . "/php/connections/sql/mysqlconnect.php";

if (!$conn) {
    header("Location: /home");
} else {
    $productName = $_GET['productName'];
    $priceString = $_GET['price'] . "." . $_GET['decimalPrice'];
    $price = floatval($priceString);
    $productType = $_GET['productType'];
    $onsale = $_GET['onsaleValue'];
    if ($onsale) {
        $onsalePriceString = $_GET['onsalePrice'] . "." . $_GET['decimalOnsalePrice'];
        $onsalePrice = floatval($onsalePriceString);
        $sql = "INSERT INTO Products (name, price, product_type, onsale, onsale_price) VALUES (?, ?, ?, ?, ?)";
        $varType = "sdsid";
        $insertArray = [$productName, $price, $productType, $onsale, $onsalePrice];
    } else {
        $sql = "INSERT INTO Products (name, price, product_type) VALUES (?, ?, ?)";
        $varType = "sds";
        $insertArray = [$productName, $price, $productType];
    }
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, $varType, ...$insertArray);
    if (mysqli_stmt_execute($stmt)) {
        header("Location: /backend?success=Item added successfully in the database.");
    } else {
        header("Location: /backend?error=Item not added in the database.");
    }
}

include $_SERVER['DOCUMENT_ROOT'] . '/php/connections/sql/mysqldisconnect.php';
?>
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/php/connections/sql/mysqlconnect.php';

if (!$conn) {
    header("Location: /home");
} else {
    $productID = $_GET['productID'];
    $sql = "SELECT name, price, onsale, onsale_price, product_type FROM Products WHERE id = $productID;";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $productName = $_GET['productName'];
    $productNameChanged = strcmp($productName, $row['name']) == 0 ? false : true;
    $updateSQL = "UPDATE Products  SET ";
    $varType = "";
    $anythingChanged = false;
    // $count = 0;
    if ($productNameChanged) {
        $updateSQL .= " name = ?";
        $updateArray = [$productName];
        $varType .= "s";
        // $count++;
    }
    $priceString = $_GET['price'] . "." . $_GET['decimalPrice'];
    $price = floatval($priceString);
    $priceChanged = $price != $row['price'];
    if ($priceChanged) {
        if (isset($updateArray)) {
            $updateSQL .= ",";
            array_push($updateArray, $priceString);
        } else
            $updateArray = [$price];
        $updateSQL .= " price = ?";
        $varType .= "d";
        // $count++;
    }
    $onsale = $_GET['onsaleValue'] ? 1 : 0;
    $onsaleChanged = $onsale != $row['onsale'];
    $onsalePriceChanged = false;
    if ($onsaleChanged) {
        if ($onsale) {
            if (isset($updateArray)) {
                $updateSQL .= ",";
                array_push($updateArray, $onsale, NULL);
            } else
                $updateArray = [$onsale, NULL];
            $updateSQL .= " onsale = ?";
            $varType .= "i";
            $updateSQL .= "," . " onsale_price = ?";
            $varType .= "s";
        } else {
            $onsalePriceString = $_GET['onsalePrice'] . "." . $_GET['decimalOnsalePrice'];
            $onsalePrice = floatval($onsalePriceString);
            if (isset($updateArray)) {
                $updateSQL .= ",";
                array_push($updateArray, $onsale, $onsalePrice);
            } else
                $updateArray = [$onsale, $onsalePrice];
            $updateSQL .= " onsale = ?";
            $varType .= "i";
            $updateSQL .= "," . " onsale_price = ?";
            $varType .= "d";
        }
    } else {
        $onsalePriceString = $_GET['onsalePrice'] . "." . $_GET['decimalOnsalePrice'];
        $onsalePrice = floatval($onsalePriceString);
        $onsalePriceChanged = $onsalePrice != $row['onsale_price'];
        if ($onsalePriceChanged) {
            if (isset($updateArray)) {
                $updateSQL .= ",";
                array_push($updateArray, $onsalePrice);
            } else
                $updateArray = [$onsalePrice];
            $updateSQL .= " onsale_price = ?";
            $varType .= "d";
        }
    }
    $updateSQL .= " WHERE id = $productID";
    if ($productNameChanged || $priceChanged || $onsaleChanged || $onsalePriceChanged) {
        $anythingChanged = true;
    }
    if ($anythingChanged) {
        $stmt = mysqli_prepare($conn, $updateSQL);
        mysqli_stmt_bind_param($stmt, $varType, ...$updateArray);
        if (mysqli_stmt_execute($stmt)) {
            echo "update success";
        } else {
            echo "update failed";
        }
    }
    header("Location: /backend");
}
include $_SERVER['DOCUMENT_ROOT'] . '/php/connections/sql/mysqldisconnect.php';
?>
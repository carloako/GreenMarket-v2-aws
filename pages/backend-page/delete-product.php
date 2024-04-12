<?php
include $_SERVER['DOCUMENT_ROOT'] . '/php/connections/sql/mysqlconnect.php';

if (!$conn) {
  echo 'Delete product. No db connection.';
} else {
  $productID = $_GET['productID'];
  $sql = "DELETE FROM Products WHERE id = $productID ";
  if (mysqli_query($conn, $sql)) {
    header("Location: /backend?success=Item deleted successfully in the database.");
  } else {
    header("Location: /backend?error=Item not added in the database.");
  }
}

include $_SERVER['DOCUMENT_ROOT'] . '/php/connections/sql/mysqldisconnect.php';
?>
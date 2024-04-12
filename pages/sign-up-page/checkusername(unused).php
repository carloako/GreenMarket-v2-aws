<?php
include $_SERVER['DOCUMENT_ROOT'] . '/php/connections/sql/mysqlconnect.php';

if (!$conn) {
    echo "Connection failed";
} else {
    $username = $_POST['username'];
    $sql = "SELECT user FROM users WHERE user = '$username'";
    $result = mysqli_query($conn, $sql);

    echo 'number of elements in POST: ' . count($_POST) . " \n";
    if (isset($_POST))
        echo "post  set \n";
    foreach ($_POST as $key => $value) {
        echo "$key: $value \n";
    }

    if (mysqli_num_rows($result) == 0) {
    } else {
        header("Location: ../error.php?error=Sql query is false.");
    }
}

include '/php/connections/sql/mysqldisconnect.php';
?>
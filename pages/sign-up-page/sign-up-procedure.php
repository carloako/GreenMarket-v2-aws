<?php
include $_SERVER['DOCUMENT_ROOT'] . '/php/connections/sql/mysqlconnect.php';

if (!$conn) {
    echo "Connection failed";
} else {
    session_start();
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
    } else {
        header("Location: ../error.php?error=Email is not set.");
    }

    if (isset($_POST['username'])) {
        $user = $_POST['username'];
        $sql = "SELECT user FROM users WHERE user ='$user'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 1) {
            header("Location: /sign-up?error=Username already exists.");
        }
    } else {
        header("Location: /error.php?error=Username is not set.");
    }

    if (isset($_POST['password'])) {
        $password = $_POST['password'];
    } else {
        header("Location: ../error.php?error=Password is not set.");
    }

    if (isset($_POST['firstname'])) {
        $firstname = $_POST['firstname'];
    } else {
        header("Location: ../error.php?error=Firstname is not set.");
    }

    if (isset($_POST['lastname'])) {
        $lastname = $_POST['lastname'];
    } else {
        header("Location: ../error.php?error=Lastname is not set.");
    }

    if (isset($_POST['homeaddress'])) {
        $homeaddress = $_POST['homeaddress'];
    } else {
        header("Location: ../error.php?error=Homeaddress is not set.");
    }

    if (isset($_POST['city'])) {
        $city = $_POST['city'];
    } else {
        header("Location: ../error.php?error=City is not set.");
    }

    if (isset($_POST['postalcode'])) {
        $postalcode = $_POST['postalcode'];
    } else {
        header("Location: ../error.php?error=Postalcode is not set.");
    }

    $password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (user, password, email, first_name, last_name, address, city, postal_code)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $array = [$user, $password, $email, $firstname, $lastname, $homeaddress, $city, $postalcode];
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssssssss", ...$array);
    $temp = mysqli_stmt_execute($stmt);
    if ($temp === TRUE) {
        session_regenerate_id();
        $_SESSION['loggedin'] = TRUE;
        $_SESSION['username'] = $user;
        $id = mysqli_insert_id($conn);
        $_SESSION['id'] = $id;
        $_SESSION['login_time'] = time();
        header("Location: /welcome");
    } else {
        header("Location: ../error.php?error=Sql query is false.");
    }
}

$conn->close();
?>
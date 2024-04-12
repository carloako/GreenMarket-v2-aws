<?php
include $_SERVER['DOCUMENT_ROOT'] . '/php/connections/sql/mysqlconnect.php';
if (!$conn) {
    header("Location: /index.php");
} else {
    session_start();
    if (isset($_POST['username']) && isset($_POST['password'])) {
        function validate($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
    }
    
    $username = validate($_POST['username']);
    $password = validate($_POST['password']);

    if (empty($username)) {
        header("Location: /login?error=username is required");
    } else if (empty($password)) {
        header("Location: /login?error=password is required");
    } else {
        $sql = "SELECT * FROM users WHERE user = ?";

        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $_POST['username']);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $frontPage = '/home';
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row['password'])) {
                echo "Logged in!";
                session_regenerate_id();
                $_SESSION['loggedin'] = TRUE;
                $_SESSION['username'] = $username;
                $_SESSION['id'] = $row['id'];
                $_SESSION['login_time'] = time();
                header("Location: $frontPage");
            } else {
                header("Location: /login?error=Incorrect username or password.");
            }
        } else {
            header("Location: /login?error=Incorrect username or password.");
        }
    }
}
?>
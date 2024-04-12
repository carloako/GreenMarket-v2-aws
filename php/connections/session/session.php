<?php
session_start();
$duration = 600;
$time = $_SERVER['REQUEST_TIME'];
if(isset($_SESSION['login_time']) && ($time - $_SESSION['login_time']) > $duration) {
  header('Location: /pages/login-page/logout.php');
}
$_SESSION['login_time'] = $time;
?>
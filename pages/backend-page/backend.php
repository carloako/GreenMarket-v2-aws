<?php
include $_SERVER['DOCUMENT_ROOT'] . "/php/connections/session/session.php";

if (isset($_GET['error'])) {
    $error = "";
    $errorMsg = $_GET['error'];
} else {
    $error = "visually-hidden";
    $errorMsg = "";
}

if (isset($_GET['success'])) {
    $success = "";
    $successMsg = $_GET['success'];
} else {
    $success = "visually-hidden";
    $successMsg = "";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/php/components/head.php" ?>
    <!-- Custom Stylesheets -->
    <link href="/css/stylesheet.css" rel="stylesheet" />
    <link href="/css/P1-style.css" rel="stylesheet" />
    <link href="/css/P1_P2-style.css" rel="stylesheet" />
</head>

<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/php/components/header.php" ?>
    <div class="alert alert-warning d-flex align-items-center <?php echo $error ?>" role="alert">
        <div class="">
            <?php echo $errorMsg ?>
        </div>
    </div>
    <div class="alert alert-success <?php echo $success ?>" role="alert">
        <?php echo $successMsg ?>
    </div>
    <?php include "product-list.php" ?>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/php/components/footer.php" ?>
</body>
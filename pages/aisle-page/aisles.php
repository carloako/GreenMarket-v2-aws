<?php include $_SERVER['DOCUMENT_ROOT'] . "/php/connections/session/session.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php include $_SERVER['DOCUMENT_ROOT'] . "/php/components/head.php" ?>
  <!-- Custom Stylesheets -->

  <!-- JS file -->
  <script type="text/javascript" src="/home.js"></script>
</head>

<body>
  <div>
    <header>
      <?php
      include $_SERVER['DOCUMENT_ROOT'] . "/php/components/header.php" ?>
    </header>
    <?php include $_SERVER['DOCUMENT_ROOT'] . "/php/components/aisle-items.php" ?>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/php/components/footer.php' ?>
  </div>
  <!-- Install JavaScrip plugins and Popper -->
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/php/javascripts/js.php' ?>
</body>

</html>
<?php include $_SERVER['DOCUMENT_ROOT'] . "/php/connections/session/session.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/php/components/head.php' ?>
  <!-- Custom Stylesheets -->
  <link href="/css/stylesheet.css" rel="stylesheet" />
  <link href="/css/user-access.css" rel="stylesheet" />
</head>

<body>
  <div id="page-container">
    <div id="content-wrap">
      <header>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/php/components/header.php' ?>
      </header>
      <p><br /></p>
      <p><br /></p>

      <div class="welcome">
        <p style="text-align: center; font-size:2rem; padding-top: 4%;">Welcome aboard! <a href="/home">Click
            here</a> to start shopping.</p>
      </div>

      <p><br /></p>
      <p><br /></p>
    </div>
    <!-- common footer section starts  -->
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/php/components/footer.php' ?>
  </div>
  <!-- Install JavaScrip plugins and Popper -->
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/php/javascripts/js.php' ?>

</body>

</html>
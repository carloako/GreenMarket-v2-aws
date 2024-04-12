<?php include $_SERVER['DOCUMENT_ROOT'] . "/php/connections/session/session.php" ?>

<!DOCTYPE html>
<html lang="en">

<head>
	<?php include $_SERVER['DOCUMENT_ROOT'] . '/php/components/head.php' ?>
	<!-- Custom Stylesheets -->
	<link href="/css/stylesheet.css" rel="stylesheet" />

	<!-- JS file -->
	<script type="text/javascript" src="/home.js"></script>
</head>

<body>
	<div id="page-container">
		<div id="content-wrap">
			<header>
				<?php include $_SERVER['DOCUMENT_ROOT'] . "/php/components/header.php" ?>
			</header>
			<div class="m-4">
				<?php include $_SERVER['DOCUMENT_ROOT'] . "/php/components/fetch-products.php" ?>
			</div>
		</div>
		<!-- common footer section starts  -->
		<?php include $_SERVER['DOCUMENT_ROOT'] . "/php/components/footer.php" ?>
	</div>
	<!-- Install JavaScrip plugins and Popper -->
	<?php include $_SERVER['DOCUMENT_ROOT'] . '/php/javascripts/js.php' ?>
</body>

</html>
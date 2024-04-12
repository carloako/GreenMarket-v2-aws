<?php
include $_SERVER['DOCUMENT_ROOT'] . "/php/connections/session/session.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<?php include $_SERVER['DOCUMENT_ROOT'] . "/php/components/head.php" ?>
	<!-- Custom Stylesheets -->
	<link href="/css/mainpage.css" rel="stylesheet" />

	<!-- JS file -->
	<script type="text/javascript" src="/home.js"></script>
</head>

<body>
	<?php include $_SERVER['DOCUMENT_ROOT'] . "/php/components/header.php" ?>
	<section class="home">
		<div class="image">
			<img src="/images/index-images/homepage-img.jpg">
		</div>
		<div class="content">
			<h2>Montreal's best selection</h2>
			<br />
			<a href="/aisle" class="btn">Start shopping</a>
		</div>
	</section>
	</div>

	<div class="container-fluid container-custom">
		<!-- <div class="position-relative shadow mb-3">
			<a href="/pages/extra/deals.html" class="disabled-anchor">
				<img src="/images/index-images/truck.jpg" class="w-100 rounded-3" alt="Truck">
				<div class="position-absolute bottom-0 start-0">
					<p class="p-0 m-0" style="font-size: 3vw;font-weight:800;color:white;"><br />MORE
						DEALS!<br /><br /></p>
				</div>
			</a>
		</div> -->
		<?php include $_SERVER['DOCUMENT_ROOT'] . "/php/components/fetch-products.php" ?>
		<!-- aisle section -->
		<div style="display:block;">
        <h1 class="hr-text">AISLES</h1>
    </div>";
		<?php include $_SERVER['DOCUMENT_ROOT'] . "/php/components/aisle-items.php" ?>
		<!-- end of aisle section -->
		<?php include $_SERVER['DOCUMENT_ROOT'] . "/php/components/footer.php" ?>
	</div>
	<?php include $_SERVER['DOCUMENT_ROOT'] . '/php/javascripts/js.php' ?>
</body>

</html>

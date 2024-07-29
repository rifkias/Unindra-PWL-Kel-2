<?php 
	include 'dbconnect.php';
	include 'helper.php';

	$uri = getUri();
?>

<!doctype html>
<html class="no-js" lang="en">
	<head>
		<title>PERGUDANGAN</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?php	 
			include './partials/_assetsHref.php';
		?>
	</head>
	<body>

		<!-- <div id="preloader">
			<div class="loader"></div>
		</div> -->
		<div class="page-container">
			<?php include './partials/_sidebar.php' ?>

			<div class="main-content">
				
			</div>

			<?php include './partials/_footer.php' ?>
		</div>

		
	</body>
</html>
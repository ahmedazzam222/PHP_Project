<?php
include("layout.php");
include("dataBaseConnect.php");
$sql = "SELECT COUNT(id) AS categoryNumber FROM categories";
$result = $conn->query($sql);
$numberOfCategories;
if ($result->num_rows > 0) {
	$numberOfCategories = $result->fetch_assoc();
}
$sql2 = "SELECT COUNT(id) AS storeNumber FROM stores";
$result2 = $conn->query($sql2);
$numberOfStores;
if ($result2->num_rows > 0) {
	$numberOfStores = $result2->fetch_assoc();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>

<body>
	<div class="main-header">
		<!-- Logo Header -->
		<div class="logo-header" data-background-color="blue">

			<a href="index.html" class="logo">
				<img src="../assets/img/logo.svg" alt="navbar brand" class="navbar-brand">
			</a>
			<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse"
				data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon">
					<i class="icon-menu"></i>
				</span>
			</button>
			<button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
			<div class="nav-toggle">
				<button class="btn btn-toggle toggle-sidebar">
					<i class="icon-menu"></i>
				</button>
			</div>
		</div>
		<!-- End Logo Header -->

		<!-- Navbar Header -->
		<nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">
			<h2 class="text-white pb-2 fw-bold mt-3">Home</h2>
		</nav>
		<!-- End Navbar -->
	</div>
	<div class="main-panel">
		<div class="content">
			<div class="page-inner ">
				<div class="row">
					<div class="col-sm-6 col-md-3 " style="margin-right: 290px;">
						<div class="card card-stats card-primary card-round " style="width: 580px;">
							<div class="card-body ">
								<div class="row">
									<div class="col-5">
										<div class="icon-big text-center">
											<i class="fa fa-list-alt"></i>
										</div>
									</div>
									<div class="col-7 col-stats">
										<div class="numbers">
											<h3 class="card-category">categories</h3>
											<h4 class="card-title" style="text-align: center;">
												<?php echo $numberOfCategories['categoryNumber']; ?>
											</h4>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-md-3 ">
						<div class="card card-stats card-primary card-round " style="width: 580px;">
							<div class="card-body">
								<div class="row">
									<div class="col-5">
										<div class="icon-big text-center">
											<i class="fa fa-store"></i>
										</div>
									</div>
									<div class="col-7 col-stats">
										<div class="numbers">
											<h3 class="card-category">Stores</h3>
											<h4 class="card-title" style="text-align: center;">
												<?php echo $numberOfStores['storeNumber']; ?>
											</h4>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
			<hr>
			<h1 class="ml-3">Stores Rating Trend</h1>
			<div class="row">
				<?php
				$sql4 = "SELECT  * FROM rating";
				$result4 = $conn->query($sql4);
				if ($result4->num_rows > 0) {
					while ($row4 = $result4->fetch_assoc()) {
						$sql3 = "SELECT  * FROM stores WHERE id = $row4[storeId]";
						$result3 = $conn->query($sql3);
						$row = $result3->fetch_assoc();
						?>
						<div class="col-6 col-sm-4 col-lg-2 m-3">
							<div class="card">
								<div class="card-body p-3 text-center">
									<div class="text-muted mb-3">
										<?php echo $row['name']; ?>
									</div>
									<?php
									$numOfStar = isset($row4['storeRating']) ? $row4['storeRating'] : null;
									$total = 0;
									if (!empty($numOfStar)) {
										$total = $numOfStar;
									}
									$range = ($total * 2) / 10;
									if ($range >= 0.5) {
										?>
										<div class="text-center text-success">
											<?php
											echo $range . "%";
											?>
											<i class="fa fa-arrow-up"></i>
											<?php
									} else {
										?>
											<div class="text-center text-danger">
												<?php
												echo $range . "%";
												?>
												<i class="fa fa-arrow-down"></i>
												<?php
									}
									?>

										</div>
									</div>
								</div>
							</div>
							<?php

					}

				}
				?>
				</div>


</body>

</html>
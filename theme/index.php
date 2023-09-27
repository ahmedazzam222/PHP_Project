<?php
include "header.php";
include "../demo1/dataBaseConnect.php";
$sql1 = "SELECT id,categoryName FROM categories";
$result1 = $conn->query($sql1);
$category = array();
$categoryid = array();
while ($row = $result1->fetch_assoc()) {
	$category[$row['id']] = $row['categoryName'];
	$categoryid[$row['id']] = $row['id'];
}




?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Rating</title>

</head>


<body>


	<section class=" section">
		<!-- Container Start -->
		<div class="container">
			<form class="input-group md-form form-sm form-2 pl-0  ml-3" action="index.php?id=1&& page = 1">
				<input type="hidden" name="id" value="1">
				<input type="hidden" name="page" value="1">
				<input class="form-control" list="datalistOptions" placeholder="Search with store name"
					class="form-control my-0 py-1 red-border" aria-label="Search" name="Store">
				<datalist id="datalistOptions">
					<?php
					$ssql = "SELECT id, image, name, phone, address, categoryId FROM stores";
					$rresult = $conn->query($ssql);
					while ($rrow = $rresult->fetch_assoc()) {
						echo "<option value='$rrow[name]'>";
					}
					?>
				</datalist>
				<div class="input-group-append mr-3">
					<input class="btn btn-primary" type="submit" name="search" value="Search">
				</div>
			</form>
			<div>
				<div class="col-12 ">

					<div class="row ">
						<!-- Category list -->
						<div class="col-lg-3 offset-lg-0 col-md-5 offset-md-1 col-sm-6">
							<div class="category-block">
								<div class="header">
									<h4 id="categoryh">Category</h4>
									<style>
										#categoryh {
											text-align: left;
										}
									</style>
								</div>
								<ul class="category-list">
									<?php
									$sql = "SELECT COUNT(categoryId) FROM Stores";
									$result = $conn->query($sql);
									$row = $result->fetch_row();
									$count = $row[0];
									echo "<li><a href='index.php?id=1&& page = 1'>All<span>" . $count . "</span></a></li>";
									$sql1 = "SELECT id,categoryName FROM categories";
									$result1 = $conn->query($sql1);
									if ($result1->num_rows > 0) {
										while ($row1 = $result1->fetch_assoc()) {
											$id = $row1['id'];
											$sql2 = "SELECT COUNT(categoryId) FROM Stores WHERE categoryId =$id ";
											$result2 = $conn->query($sql2);
											$row2 = $result2->fetch_row();
											$count1 = $row2[0];
											echo "<li><a href='index.php?id=" . $row1['id'] . "&& page = 1'>" . $row1['categoryName'] . "<span>" . $count1 . "</span></a></li>";
										}
									}
									?>
								</ul>
							</div>
						</div> <!-- /Category List -->
						<div class="d-flex col-lg-3">
							<?php
							$page = isset($_GET['page']) ? $_GET['page'] : 1;
							$offset = ($page - 1) * 3; // 3 is the number of cards per page
							$id = $_GET['id'];
							if (empty($_GET['Store'])) {
								if ($id == 1) {
									$sql3 = "SELECT id, image, name, phone, address, categoryId FROM stores LIMIT $offset, 3";
								} elseif ($id == $categoryid[$id]) {
									$sql3 = "SELECT id, image, name, phone, address, categoryId FROM stores WHERE categoryId = $id LIMIT $offset, 3";
								} else {
									$sql3 = "SELECT id, image, name, phone, address, categoryId FROM stores LIMIT $offset, 3";
								}
							} else {
								if (isset($_GET['search']))
									$sql3 = "SELECT id, image, name, phone, address, categoryId FROM stores WHERE name ='$_GET[Store]'";
							}
							$result3 = $conn->query($sql3);
							if ($result3->num_rows > 0) {
								while ($row3 = $result3->fetch_assoc()) {
									$path = $row3['image'];
									$counter = 0;
									if ($counter < 3) {
										?>
										<div class="row m-4">
											<div class="row">
												<div class="card">
													<div class="thumb-content">
														<!-- <div class="price">$200</div> -->
														<a href="<?php echo "RatingForStore.php?id=$row3[id]"; ?>">
															<img src="../demo1/<?php echo $path; ?> " alt="Card image cap"
																width="270" height="200">
														</a>

													</div>
													<div class="card-body">
														<h4 class="card-title"><a
																href="<?php echo "RatingForStore.php?id=$row3[id]"; ?>">
																<?php echo $row3['name']; ?>
															</a></h4>
														<ul class="list-inline product-meta">
															<li class="list-inline-item">
																<a href="<?php echo "RatingForStore.php?id=$row3[id]"; ?>"><i
																		class="fa fa-folder-open-o"></i>
																	<?php echo $category[$row3['categoryId']]; ?>
																</a>
															</li>
														</ul>
														<p class="card-text">Phone:
															<?php echo $row3['phone']; ?>
														</p>
														<p class="card-text">Address:
															<?php echo $row3['address']; ?>
														</p>
														<div class="product-ratings">
															<style>
																#star {
																	color: yellow;
																}

															</style>
															<ul class="list-inline">
																<?php
																$sql4 = "SELECT  storeRating FROM rating WHERE storeId = $row3[id]";
																$result4 = $conn->query($sql4);
																$row4 = $result4->fetch_assoc();
																$numOfStar = isset($row4['storeRating']) ? $row4['storeRating'] : null;
																if (!empty($numOfStar)) {
																	for ($i = 0; $i < $numOfStar; $i++) {
																		?>
																		<li class="list-inline-item selected"><i id="star"
																				class="fa fa-star"></i>
																		</li>
																		<?php
																	}
																	for ($ii = $numOfStar; $ii < 5; $ii++) {
																		?>
																		<li class="list-inline-item"><i class="fa fa-star" style="color:gray;"></i></li>
																		<?php
																	}
																} else {
																	for ($iii = 0; $iii < 5; $iii++) {
																		?>
																		<li class="list-inline-item"><i class="fa fa-star" style="color:gray;"></i></li>
																		<?php
																	}
																}
																?>
															</ul>
														</div>
													</div>
												</div>
											</div>
										</div>

										<?php

										$counter++;
									}
								}
							}
							?>
						</div>
					</div>
					<div class="pagination justify-content-center">
						<nav aria-label="Page navigation example">
							<ul class="pagination">

								<?php
								$prev = $page;
								if ($prev != 1) {
									$prev -= 1;
								}
								$next = $page;
								if ($next != 3) {
									$next += 1;
								}
								?>


								<?php
								if ($id == 1) {
									?>
									<li class="page-item">
										<a class="page-link" href="<?php echo "index.php?page=$prev&id=1"; ?>"
											aria-label="Previous">
											<span aria-hidden="true">&laquo;</span>
											<span class="sr-only">Previous</span>
										</a>
									</li>
									<?php
									$sqll = "SELECT COUNT(id) AS NumOfStore FROM stores";
									$resultt = $conn->query($sqll);
									$roww = $resultt->fetch_row();
									$countt = $roww[0];
									$pagee = ceil($countt / 3);
									for ($s = 1; $s <= $pagee; $s++) {
										?>
										<li class="page-item <?php if ($page == $s)
											echo 'active'; ?>"><a class="page-link" href="<?php echo "index.php?page=$s&id=1"; ?>"><?php echo $s; ?></a>
										</li>
										<?php
									}
									?>

									<li class="page-item">
										<a class="page-link" href="<?php echo "index.php?page=$next&id=1"; ?>"
											aria-label="Next">
											<span aria-hidden="true">&raquo;</span>
											<span class="sr-only">Next</span>
										</a>
									</li>
									<?php
								} else {
									?>
									<li class="page-item">
										<a class="page-link" href="<?php echo "index.php?page=$prev&id=$_GET[id]"; ?>"
											aria-label="Previous">
											<span aria-hidden="true">&laquo;</span>
											<span class="sr-only">Previous</span>
										</a>
									</li>
									<?php
									$sqll2 = "SELECT COUNT(id) AS NumOfStore FROM stores WHERE categoryId = $id";
									$resultt2 = $conn->query($sqll2);
									$roww2 = $resultt2->fetch_row();
									$counttt = $roww2[0];
									$pageee = ceil($counttt / 3);
									for ($s = 1; $s <= $pageee; $s++) {
										?>
										<li class="page-item <?php if ($page == $s)
											echo 'active'; ?>"><a class="page-link" href="<?php echo "index.php?page=$s&id=$_GET[id]"; ?>"><?php echo $s; ?></a></li>
										<?php
									}
									?>
									<li class="page-item">
										<a class="page-link" href="<?php echo "index.php?page=$next&id=$_GET[id]"; ?>"
											aria-label="Next">
											<span aria-hidden="true">&raquo;</span>
											<span class="sr-only">Next</span>
										</a>
									</li>
									<?php
								}
								?>



							</ul>
						</nav>
					</div>
				</div>
				<!-- Container End -->
	</section>



	<!-- 
Essential Scripts
=====================================-->
	<script src="plugins/jquery/jquery.min.js"></script>
	<script src="plugins/bootstrap/popper.min.js"></script>
	<script src="plugins/bootstrap/bootstrap.min.js"></script>
	<script src="plugins/bootstrap/bootstrap-slider.js"></script>
	<script src="plugins/tether/js/tether.min.js"></script>
	<script src="plugins/raty/jquery.raty-fa.js"></script>
	<script src="plugins/slick/slick.min.js"></script>
	<script src="plugins/jquery-nice-select/js/jquery.nice-select.min.js"></script>
	<!-- google map -->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcABaamniA6OL5YvYSpB3pFMNrXwXnLwU" defer></script>
	<script src="plugins/google-map/map.js" defer></script>

	<script src="js/script.js"></script>

</body>

</html>
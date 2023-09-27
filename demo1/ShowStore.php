<?php
include "dataBaseConnect.php";
include "layout.php";
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
			<h2 class="text-white pb-2 fw-bold mt-3">Show Store</h2>
		</nav>
		<!-- End Navbar -->
	</div>
	<div class="main-panel">
		<div class="content">
			<table class="table table-hover m-5">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Image</th>
						<th scope="col">Name</th>
						<th scope="col">Phone</th>
						<th scope="col">Address</th>
						<th scope="col">Category</th>
						<th scope="col">Actions</th>

					</tr>
				</thead>
				<tbody>
					<?php
					$sql = "SELECT id, image, name, phone, address, categoryId FROM stores";
					$sql1 = "SELECT id,categoryName FROM categories";
					$result1 = $conn->query($sql1);
					$category = array();
					while ($row = $result1->fetch_assoc()) {
						$category[$row['id']] = $row['categoryName'];
					}
					$num = 1;
					$result = $conn->query($sql);
					if ($result->num_rows > 0) {
						while ($row = $result->fetch_assoc()) {
							echo "<tr><td>" . $num . "</td><td><img src='" . $row['image'] . "' width='70' height='60'></td>";
							echo "<td>" . $row['name'] . "</td><td>" . $row['phone'] . "</td>";
							echo "<td>" . $row['address'] . "</td><td>" . $category[$row['categoryId']] . "</td><td>"; ?>
							<a href="EditStore.php?id=<?php echo $row["id"] ?>" class="btn btn-primary" name="edit">Edit</a>
							<button class="btn btn-danger delete-category" data-id="<?php echo $row["id"] ?>" onclick="confirmDelete(<?php echo $row['id'] ?>)">Delete</button>
							<?php
							echo "</td></tr>";
							$num++;
						}
					}

					?>
				</tbody>
			</table>

		</div>
	</div>
	<script>
    function confirmDelete(storeId) {
        swal({
            title: 'Are you sure?',
            text: 'Once deleted, you will not be able to recover this store!',
            icon: 'warning',
            buttons: {
                cancel: {
                    text: 'Cancel',
                    value: false,
                    visible: true,
                    className: 'btn btn-secondary',
                    closeModal: true
                },
                confirm: {
                    text: 'Delete',
                    value: true,
                    visible: true,
                    className: 'btn btn-danger',
                    closeModal: true
                }
            }
        }).then(function (confirmed) {
            if (confirmed) {
                // Redirect to DeleteStore.php with the store ID
                window.location.href = 'DeleteStore.php?id=' + storeId;
            }
        });
    }
</script>
</body>

</html>
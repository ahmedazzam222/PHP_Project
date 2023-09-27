<?php
include("layout.php");
include("dataBaseConnect.php");
?>
<!DOCTYPE html>
<html>

<head>
  <title>Categories</title>
</head>

<body>
  <div class="main-header">
    <!-- Logo Header -->
    <div class="logo-header" data-background-color="blue">

      <a href="index.html" class="logo">
        <img src="../assets/img/logo.svg" alt="navbar brand" class="navbar-brand">
      </a>
      <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse"
        aria-expanded="false" aria-label="Toggle navigation">
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
      <h2 class="text-white pb-2 fw-bold mt-3">Show Category</h2>
    </nav>
    <!-- End Navbar -->
  </div>

  <div class="main-panel">
    <div class="content">
      <table class="table table-hover m-5">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Category Name</th>
            <th scope="col">Actions</th>

          </tr>
        </thead>
        <tbody>
          <?php
          $sql = "SELECT id,categoryName FROM categories";
          $result = $conn->query($sql);
          $num = 1;
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              echo "<tr><td>" . $num . "</td><td>" . $row['categoryName'] . "</td><td>"; ?>
              <form action="#" class="d-flex col-lg-3">
                <a href="EditCategory.php?id=<?php echo $row["id"] ?>" class="btn btn-primary" name="edit">Edit</a>
                <button class="btn btn-danger delete-category" data-id="<?php echo $row["id"] ?>" onclick="confirmDelete(<?php echo $row['id'] ?>)">Delete</button>
              </form>
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
    function confirmDelete(categoryId) {
        swal({
            title: 'Are you sure?',
            text: 'Once deleted, you will not be able to recover this category!',
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
                // Redirect to DeleteCategory.php with the category ID
                window.location.href = 'DeleteCategory.php?id=' + categoryId;
            }
        });
    }
</script>


</body>

</html>
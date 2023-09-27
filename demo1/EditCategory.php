<?php
include("layout.php");
include("dataBaseConnect.php");
$id = $_GET['id'];
$sql1 = "SELECT categoryName FROM categories WHERE id = $id";

$result = $conn->query($sql1);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Edit Category</title>
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
            <h2 class="text-white pb-2 fw-bold mt-3">Edit Category</h2>
        </nav>
        <!-- End Navbar -->
    </div>

    <div class="main-panel">
        <div class="content">
            <form class="m-5" method="POST">
                <div class="mb-3">
                    <label for="categoryName" class="form-label">Category Name :</label>
                    <input type="text" class="form-control" id="categoryName" name="categoryName"
                    <?php
                    if (isset($_POST['editCategory'])) {
                        ?>
                        value="<?php echo $_POST['categoryName']; ?>">
                        <?php
                    }else{
                        ?>
                        value="<?php echo $row['categoryName']; ?>">
                        <?php
                    }
                    ?>
                    
                    
                </div>
                <input type="submit" name="editCategory" class="btn btn-primary" value="Save">
            </form>

        </div>
    </div>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (isset($_POST['editCategory'])) {
            $value = $_POST['categoryName'];
            if (!(empty($value))) {
                $sql = "UPDATE categories SET categoryName='$value' WHERE id = '$id'";
                $conn->query($sql);
                ?>
                <script>
                    swal({

                        title: "Good job!",
                        text: "You clicked the button!",
                        icon: "success",
                        buttons: {
                            confirm: {
                                text: "Confirm Me",
                                value: true,
                                visible: true,
                                className: "btn btn-success",
                                closeModal: true
                            }
                        }
                    });
                </script>
                <?php

            }
        }
    }
    ?>



</body>

</html>
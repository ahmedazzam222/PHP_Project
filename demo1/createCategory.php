<?php
include("layout.php");
include("dataBaseConnect.php");
?>
<!DOCTYPE html>
<html>

<head>
    <title>Add Category</title>
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
            <h2 class="text-white pb-2 fw-bold mt-3">Create Category</h2>
        </nav>
        <!-- End Navbar -->
    </div>

    <div class="main-panel">
        <div class="content">
            <form class="m-5" method="POST">
                <?php
                if (isset($_POST['addCategory'])) {
                    $value = $_POST['categoryName'];
                    if ((empty($value))) {

                        ?>
                        <div class="alert alert-danger" role="alert">
                            Category name is required.
                        </div>
                        <?php

                    }

                }
                ?>

                <div class="mb-3">
                    <label for="categoryName" class="form-label">Category Name :</label>
                    <input type="text" class="form-control" id="categoryName" name="categoryName">
                </div>
                <input type="submit" name="addCategory" class="btn btn-primary" value="Add Category">
            </form>

        </div>
    </div>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (isset($_POST['addCategory'])) {
            $value = $_POST['categoryName'];
            if (!(empty($value))) {
                $sql = "INSERT INTO categories (categoryName) VALUES ('$value')";
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

    </div>
    </div>
</body>

</html>
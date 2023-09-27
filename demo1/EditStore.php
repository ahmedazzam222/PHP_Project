<?php
include("layout.php");
include("dataBaseConnect.php");
$id = $_GET['id'];
$sql1 = "SELECT id, image, name, phone, address, categoryId FROM stores WHERE id = $id";

$result = $conn->query($sql1);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Edit Store</title>
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
            <h2 class="text-white pb-2 fw-bold mt-3">Edit Story</h2>
        </nav>
        <!-- End Navbar -->
    </div>

    <div class="main-panel">
        <div class="content">
            <form class="m-5" action="" method="post" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="formGroupExampleInput">Name</label>
                    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Enter store name"
                        name="storeName" 
                        value="<?php echo $row['name']; ?>">
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Phone</label>
                    <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Enter store phone"
                        name="storePhone" value="<?php echo $row['phone']; ?>">
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput">Address</label>
                    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Enter store address"
                        name="storeAddress" value="<?php echo $row['address']; ?>">
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">Category</label>
                    <Select class="form-control" id="formGroupExampleInput2" name="categoryId">
                        <?php
                        $sql = "SELECT id,categoryName FROM categories";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row1 = $result->fetch_assoc()) {
                                if ($row1['id'] === $row['categoryId']) {
                                    echo "<option value = '$row1[id]' selected>" . $row1['categoryName'] . "</option>";
                                }
                                echo "<option value = '$row1[id]' >" . $row1['categoryName'] . "</option>";
                            }
                        }
                        ?>
                    </Select>

                </div>
                <div class="form-group">
                    <label for="fileToUpload" class="form-label">Image :</label>
                    <input type="file" name="fileToUpload" id="fileToUpload">
                    <br>
                    <img src="<?php echo $row['image']; ?>" width="100" height="70">
                </div>
                <input type="submit" class="btn btn-primary ml-2" value="Save" name="EditStore">

            </form>


        </div>
    </div>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (isset($_POST['EditStore'])) {
            $storeName = $_POST['storeName'];
            $storePhone = $_POST['storePhone'];
            $storeAddress = $_POST['storeAddress'];
            $categoryId = $_POST['categoryId'];
            if ($_FILES["fileToUpload"]["error"] == UPLOAD_ERR_NO_FILE) {
                $imageWithNotUpload = "'" . $row['image'] . "'";
                $sql7 = "UPDATE stores SET image = $imageWithNotUpload ,name='$storeName',phone='$storePhone',address='$storeAddress',categoryId='$categoryId' WHERE id = '$id'";
                $conn->query($sql7);
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
            } else {
                $target_dir = "image/";
                $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                // Check if image file is a actual image or fake image
                $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                if ($check === false) {
                    echo "File is not an image.";
                    $uploadOk = 0;
                }

                // Check if file already exists
                if (file_exists($target_file)) {
                    $imagepath = $target_file;
                    $sql4 = "UPDATE stores SET image= '$imagepath',name='$storeName',phone='$storePhone',address='$storeAddress',categoryId='$categoryId' WHERE id = '$id'";
                    $conn->query($sql4);
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
                    $uploadOk = 0;

                }

                // Check file size
                if ($_FILES["fileToUpload"]["size"] > 500000) {
                    echo "Sorry, your file is too large.";
                    $uploadOk = 0;
                }

                // Allow certain file formats
                if (
                    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif"
                ) {
                    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                }

                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    echo "Sorry, your file was not uploaded.";
                    // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                        $imagepath = $target_file;
                        $sql5 = "UPDATE stores SET image= '$imagepath',name='$storeName',phone='$storePhone',address='$storeAddress',categoryId='$categoryId' WHERE id = '$id'";
                        $conn->query($sql5);
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
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                }
            }
        }
    }
    ?>





</body>

</html>
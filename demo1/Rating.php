<?php
include "dataBaseConnect.php";
include "layout.php";
error_reporting(E_ERROR | E_PARSE);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rating</title>

    <!-- Include necessary CSS files for MDB -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.12.0/mdb.min.css"
        integrity="sha512-fpNNpTdyq0XdZ0I4E2ZbzSNSFPCfqkLrR6SzvJYRyUg/uPVxwo0f5d7Q+1j7dbd9EjDsjgY/V9jOM1EPHtOFgA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


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
            <h2 class="text-white pb-2 fw-bold mt-3">Rating</h2>
        </nav>
        <!-- End Navbar -->
    </div>

    <div class="main-panel">
        <div class="content">
            <form class="input-group md-form form-sm form-2 pl-0  mt-3 ml-3">

                <input class="form-control" list="datalistOptions" placeholder="Search with store name"
                    class="form-control my-0 py-1 red-border" aria-label="Search" name="Store">
                <datalist id="datalistOptions">
                    <?php
                    $sql = "SELECT id, image, name, phone, address, categoryId FROM stores";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='$row[name]'>";
                    }
                    ?>
                </datalist>
                <div class="input-group-append mr-3">
                    <button class="btn btn-primary" type="submit" name="search">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </form>
            <table class="table table-hover m-5">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Image</th>
                        <th scope="col">Store Name</th>
                        <th scope="col">Total Rating</th>
                        <th scope="col">Number Of Ratings</th>
                        <th scope="col">Store Rating</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $page = isset($_GET['page']) ? $_GET['page'] : 1;
                    $offset = ($page - 1) * 5; // 3 is the number of cards per page
                    if (empty($_GET['Store'])) {
                        $sql = "SELECT id, image, name, phone, address, categoryId FROM stores LIMIT $offset, 5";
                    } else {
                        if (isset($_GET['search']))
                            $sql = "SELECT id, image, name, phone, address, categoryId FROM stores WHERE name ='$_GET[Store]'LIMIT $offset, 5 ";
                    }

                    $result = $conn->query($sql);
                    $num = 1;
                    if ($result->num_rows > 0) {
                        while ($row1 = $result->fetch_assoc()) {

                            $sql1 = "SELECT id, total, numberOfRating, storeRating, storeId FROM rating WHERE storeId = $row1[id]";
                            $result1 = $conn->query($sql1);
                            $row = $result1->fetch_assoc();
                            echo "<tr><td>" . $num . "</td><td><img src='" . $row1['image'] . "' width='70' height='60'></td>";
                            echo "<td>" . $row1['name'] . "</td><td>" . $row['total'] . "</td>";
                            echo "<td>" . $row['numberOfRating'] . "</td><td>" . $row['storeRating'];

                            echo "</td></tr>";
                            $num++;
                        }
                    }

                    ?>
                </tbody>
            </table>
            <?php 
            if (!empty($_GET['Store'])) {
            
                if (isset($_GET['search'])){

                }

            }else{

            
            ?>
            <div class="pagination justify-content-center">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item">
                            <?php
                            $prev = $page;
                            if ($prev != 1) {
                                $prev -= 1;
                            }
                            ?>
                            <a class="page-link" href="<?php echo "Rating.php?page=$prev"; ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        </li>
                        <?php
                        $sqll2 = "SELECT COUNT(id) AS NumOfStore FROM stores";
                        $resultt2 = $conn->query($sqll2);
                        $roww2 = $resultt2->fetch_row();
                        $counttt = $roww2[0];
                        $pageee = ceil($counttt / 5);
                        for ($s = 1; $s <= $pageee; $s++) {
                            ?>
                            <li class="page-item <?php if ($page == $s)
                                echo 'active'; ?>"><a class="page-link"
                                    href="<?php echo "Rating.php?page=$s"; ?>"><?php echo $s; ?></a></li>
                            <?php
                        }

                        $next = $page;
                        if ($next != 3) {
                            $next += 1;
                        }
                        ?>


                        <li class="page-item">
                            <a class="page-link" href="<?php echo "Rating.php?page=$next"; ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <?php
                    }
            ?>
        </div>
    </div>
</body>

</html>
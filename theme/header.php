<?php
include "../demo1/dataBaseConnect.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <!-- ** Basic Page Needs ** -->
    <meta charset="utf-8">
    <title>Classimax | Classified Marketplace Template</title>

    <!-- ** Mobile Specific Metas ** -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Agency HTML Template">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="author" content="Themefisher">
    <meta name="generator" content="Themefisher Classified Marketplace Template v1.0">

    <!-- theme meta -->
    <meta name="theme-name" content="classimax" />

    <!-- favicon -->
    <link href="images/favicon.png" rel="shortcut icon">

    <!-- 
  Essential stylesheets
  =====================================-->
    <link href="plugins/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="plugins/bootstrap/bootstrap-slider.css" rel="stylesheet">
    <link href="plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="plugins/slick/slick.css" rel="stylesheet">
    <link href="plugins/slick/slick-theme.css" rel="stylesheet">
    <link href="plugins/jquery-nice-select/css/nice-select.css" rel="stylesheet">

    <link href="css/style.css" rel="stylesheet">

</head>

<body class="body-wrapper">


    <header>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav class="navbar navbar-expand-lg navbar-light navigation">
                        <a class="navbar-brand" href="index.html">
                            <img src="images/logo.png" alt="">
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto main-nav ">
                                <li class="nav-item active">
                                    <a class="nav-link" href="index.php?id=1&&page =1 ">Home</a>
                                </li>
                                <li class="nav-item dropdown dropdown-slide @@dashboard">
                                    <a class="nav-link dropdown-toggle" data-toggle="dropdown"
                                        href="#!">Category<span><i class="fa fa-angle-down"></i></span>
                                    </a>
                                    <ul class="dropdown-menu">

                                        <?php
                                        $sql = "SELECT categoryName FROM categories";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<li class='dropdown-item @@dashboardPage'>" . $row['categoryName'] . "</li>";

                                            }
                                        }
                                        ?>
                                    </ul>
                                </li>

                            </ul>
                            <ul class="navbar-nav ml-auto mt-10">
                                <li class="nav-item">
                                    <a class="nav-link login-button" href="login.php">Login</a>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
</body>

</html>
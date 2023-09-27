<?php
include "../demo1/dataBaseConnect.php";
include "header.php";
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM user WHERE id=1";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    if ($row['username'] == $username && $row['password'] == $password) {
      $_SESSION['user_id'] = $row['id'];
      header("Location: ../demo1/Home.php");
    } else if($row['username'] != $username || $row['password'] != $password){
    }else{
      header("Location: login.php");

    }
  }
}

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




  <section class="login py-5 border-top-1">
    <div class="container">
      <?php
      if(isset($_POST['login'])){
        if ($row['username'] ==null) {
          ?>
          <div class="alert alert-danger" role="alert">
            Username is error...
          </div>
          <?php
  
        }else if($row['password'] == null) {
          ?>
          <div class="alert alert-danger" role="alert">
            Password is error...
          </div>
          <?php
        }else{
            ?>
            <div class="alert alert-danger" role="alert">
              Username or Password is error...
            </div>
            <?php
    
        }
      }
      
      ?>
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-8 align-item-center">
          <div class="border">
            <h3 class="bg-gray p-4">Login Now</h3>
            <form action="" method="post">
              <fieldset class="p-4">
                <input class="form-control mb-3" type="text" placeholder="Username" required name="username">
                <input class="form-control mb-3" type="password" placeholder="Password" required name="password">
                <input type="submit" class="btn btn-primary font-weight-bold mt-3" value="Login" name="login">
              </fieldset>
            </form>
          </div>
        </div>
      </div>
    </div>
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
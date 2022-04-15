<?php
//making sure that a session started when the user login on all pages
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>E-commerce Website</title>
  <!--link for the cart icon-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!--link for the css style-->
  <link rel="stylesheet" href="./css/style2.css">
  <script src="./js/nav.js" defer></script>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</head>

<body>
  <header>
    <nav class="navbar">
      <div class="brand-title font-x3">YBM Store
      </div>
      <a href="#" class="toggle-button">
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
      </a>
      <div class="navbar-links">
        <ul><?php
            if (isset($_SESSION['adminId'])) {
              echo '<li><a href="addProduct.php">Products</a></li>
              <li><a href="orders.php">Orders</a></li>
              <li><a href="users.php">Users</a></li>';
            } else {
              echo '<li><a href="index.php">Home</a></li>
                    <li><a href="shop.php">Shop</a></li>
                    <li><a href="faq.php">FAQ</a></li>
                    <li><a href="aboutUs.php">About US</a></li>';
            }

            if (isset($_SESSION['userId'])) {
              echo '<li><a href="userSettings.php"><u>' . $_SESSION['userUsername'] . '</u></a></li>';
            }
            if (isset($_SESSION['userId']) || isset($_SESSION['adminId'])) {

              echo '<li><a href="./includes/logout.inc.php"><em>Logout</em></a></li>';
            } else {
              echo '<li><a href="login.php"><em>Login</em></a></li>
                    <li><a href="signUp.php"><em>Sign up</em></a></li>';
            }
            $count = 0;
            if (isset($_SESSION['cart'])) {
              $count = count($_SESSION['cart']);
            }
            ?>
          <li><a href="cart.php"><i class="fa fa-shopping-cart" style="  font-size: 36px;color: rgb(80, 80, 80);"></i>(<span id="cart-count"><?php echo $count ?></span>)</a>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <!--Yannick Makwenge - E-Commerce-Website-->
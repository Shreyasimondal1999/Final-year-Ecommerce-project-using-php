  <!-- connecting connect.php file to this file, to use $con -->
  <?php
  include('./includes/connect.php');
  include('./functions/commonfunction.php');
  session_start();
  ?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title> ECOMMERCE PROJECT </title>
      <!-- BOOTSTRAP CSS LINK -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  
      <!-- FONT AWESOME LINK -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      
      <!-- css file -->
      <link rel="stylesheet" href="STYLE.css">
      </head>
  <body>

  <!-- navigation bar ,  bootstrap class = div.container fluid  - it will take entire width  -->
  <div class="container-fluid p-0 ">
    <!-- first child inside div class , i.e nav bar -->
    <nav class="navbar navbar-expand-lg" style="background-color: #d63384;">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"><i class="fa-solid fa-shirt"></i></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="INDEX.php">HOME</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="display_all_products.php">PRODUCTS</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="user_profile.php">MY ACCOUNT</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">CONTACT</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="cart.php"><i class="fa-solid fa-cart-shopping"></i><sup><?php cart_item_number()?></sup></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">TOTAL PRICE : <?php total_cart_price()?>/- </a>
          </li>
        </ul>
        <form class="d-flex" role="search" action="" method="get" >
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search_data" >
          <input type="submit" value="search" class="btn btn-outline-light" name="search_data_product" >
        </form>
      </div>
    </div>
  </nav>
  <!-- end of nav bar -->

  <!-- calling cart function -->
  <?php
  cart();
  ?>

<!-- start of nav bar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
    <ul class="navbar-nav me-autO">

  <?php

if(!isset($_SESSION['username'])){
  echo "<li class='nav-item'>
  <a class='nav-link' href='#'>WELCOME GUEST</a>
</li>";
}
else{
  echo "<li class='nav-item'>
  <a class='nav-link' href='user_profile.php'>WELCOME ".$_SESSION['username']."</a>
</li>";
}

    if(!isset($_SESSION['username'])){
        echo "<li class='nav-item'>
        <a class='nav-link' href='user_login1.php'>Login</a>
    </li>";
    }
    else{
        echo "<li class='nav-item'>
        <a class='nav-link' href='user_logout.php'>Logout</a>
    </li>";
    }
    ?>
    </ul>
 </nav>
  <!-- third child -->
  <div class="thirdpara mb-0 p-0">
    <h3 class="text-center">THRIFT SHOPPING</h3>
    <p  class="text-center" >
    GET YOUR FASHION AT CHEAPER PRICES 
    </p>
  </div>

 <!-- forth child -->
 <div class="row m-0">
    <div class="col-md-2 p-0">
<u1 class="navbar-nav bg-secondary text-center" style="height: 100vh" >
<li class="nav-item">
            <a class="nav-link text-light" href="user_profile.php" style="background-color: #d63384;"><h4>Your Profile</h4> </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-light" href="user_profile.php">Pending Orders</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-light" href="user_profile.php?edit_account">Edit Account</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-light" href="user_profile.php?my_orders">My Orders</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-light" href="user_profile.php?delete_account">Delete Account</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-light" href="user_logout.php">Logout</a>
          </li>
</u1>
    </div>
    <div class="col-md-10">
    <?php
        get_user_order_details();
        if(isset($_GET['my_orders'])){
          include('user_orders.php');
        }
        ?>
    </div>
 </div>

  <!-- last child - footer -->
  <div style="color: #d63384;" class="footer">
  <p> Ecommerce site - Designed by SHREYASI SUVRONEEL ISHIKA </p>
  </div>
  </div>



  <!-- BOOTSTRAP JS LINK -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
  </body>
  </html>

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
          <?php
          if(isset($_SESSION['username'])){
            echo "<li class='nav-item'>
            <a class='nav-link' href='user_profile.php'>MY PROFILE</a>
          </li>";
          }
          else{
            echo "<li class='nav-item'>
            <a class='nav-link' href='user_registration.php'>REGISTER</a>
          </li>";
          }
          ?>
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
  <div class="thirdpara">
    <h3 class="text-center">THRIFT SHOPPING</h3>
    <p  class="text-center" >
    GET YOUR FASHION AT CHEAPER PRICES 
    </p>
  </div>

  <!-- FOURTH CHILD -->
  <div class="row p-3" >
    <div class="col-md-10 ">
      <!-- products -->
      <div class="row" >

  <!-- fetching database for products  -->
  <?php
  //  to search products
  if(isset($_GET['search_data_product'])){
    search_product();
  }
  else{
    //calling selfmade function from function folder to fetch all products 
    getproducts();
  }
  //  $select_query = " select * from `products`  order by rand() limit 0,9";
  // //  select all rows from products table
  //  $result_query = mysqli_query($con , $select_query);
  // // $row_data = mysqli_fetch_assoc($result_query); --> fetch data from rows, but at a time only , that is why while loop is needed
  // // echo $row_data['product_title'];
  // while($row_data = mysqli_fetch_assoc($result_query)){
  //   $product_id = $row_data['product_id'];
  //   $product_title= $row_data['product_title'];
  //   $product_description = $row_data['product_description'];
  //   $product_image = $row_data['product_image'];
  //   $product_price = $row_data['product_price'];
  // //  this two data will not be shown in front page , but needed to fetch data according to brand and category
  //   $category_id = $row_data['category_id'];
  //   $category_id = $row_data['category_id'];
  //   echo "      <div class='col-md-4'>
  //   <div class= 'card' style='width: 18rem;'>
  //   <img src='./admin/product_images/$product_image' class='card-img-top' alt='$product_title'>
  //   <div class='card-body'>
  //   <h5 class='card-title'>$product_title</h5>
  //   <p class='card-text'>$product_description.</p>
  //   <p class='card-text'>Rs $product_price /-</p>
  //   <a href='#' class='btn btn-primary'>Add to Cart</a>
  //   </div>
  //   </div>
  //   </div> ";
  // }

  ?>
    

      <!-- static card start 
      <div class="col-md-4 ">
      <div class="card" style="width: 18rem;">
      <img src="./images/img5.jpg" class="card-img-top" alt="...">
      <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
      <a href="#" class="btn btn-primary">Go somewhere</a>
      </div>
      </div>
      </div>
      card end -->

    </div>
    <!-- row end  -->
    </div>
    <!-- column end -->

    <div class="col-md-2 bg-secondary p-0" >
  <!-- side nav -->
  <!-- BRANDS TO BE DISPLAYED -->
  <ul class="nav-bar">
    <li class="nav-item " >
      <a href="#" class="nav-link">
        DELIVERY BRANDS
      </a>
    </li>
    <!-- running sql queries to connect brands table with delivery brand section -->
    <!--  <a href = 'INDEX.php?BRAND=$brand_id' class='nav-link'> INDEX.php?BRAND=$brand_id this line shows brand id on page link  -->
    <?php 
    $select_brands = "select * from `brands` ";
    $result_brands = mysqli_query($con,$select_brands);
    // $row_data = mysqli_fetch_assoc($result_brands);
    // echo $row_data['brand_title'];
    while($row_data = mysqli_fetch_assoc($result_brands)){
      $brand_title = $row_data['brand_title'];
      $brand_id =  $row_data['brandid'];
      echo  "<li class='nav-item1' >
      <a href = 'INDEX.php?BRAND=$brand_id' class='nav-link'> 
        $brand_title
      </a>
    </li>";
    }
    ?> 
  </ul>
  <!-- CATEGORIES TO BE DISPLAYED -->
  <ul class="nav-bar">
    <li class="nav-item " >
      <a href="#" class="nav-link">
        CATEGORIES
      </a>
    </li>

      <!-- running sql queries to connect category table with categories section -->
    <?php
    // select category table 
    $select_categories = "select * from `category` ";
    // select all rows of category table
    $result_categories = mysqli_query($con,$select_categories);
    // $row_data = mysqli_fetch_assoc($result_categories); --> fetch data from rows
    // echo $row_data['category_name']; ->> shows category name 
    while($row_data = mysqli_fetch_assoc($result_categories)){
      $category_names = $row_data['category_name'];
      $category_id =  $row_data['category_id'];
      echo  "<li class='nav-item1' >
      <a href = 'INDEX.php?CATEGORY=$category_id' class='nav-link'>
        $category_names
      </a>
    </li>";
    }
    ?>
  </ul>
    </DIV>
  </div>


  <!-- last child - footer -->
  <div style="background-color: #d63384;" class="footer">
  <p> Ecommerce site - Designed by SHREYASI </p>
  </div>
  </div>



  <!-- BOOTSTRAP JS LINK -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
  </body>
  </html>

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
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Cart details</title>
      <!--bootstrap CSS link-->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
      <!--font awesome link-->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <!-- css file -->
      <link rel="stylesheet" href="STYLE.css">
      <style>
    .cart_image{
        height: 80px;
        width: 80px;
        object-fit: contain;
    }
      </style>
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
              <a class="nav-link" href="cart.php"><i class="fa-solid fa-cart-shopping"></i><sup><?php cart_item_number()?></sup></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">TOTAL PRICE : <?php total_cart_price()?>/- </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- end of nav bar -->
    <!-- calling cart function -->
    <?php
    cart();
    ?>

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
    <!--Third child-->
    <div class="bg-light">
        <h3 class="text-center p-2">THRIFT STORE</h3>
    </div>

    <!--Forth child table-->
    <div class="container">
        <div class="row">
          <form action="" method="post" >
          <table class="table table-bordered text-center">
            <thead>
              <tr>
                <th>PRODUCT TITLE</th>
                <th>PRODUCT IMAGE</th>
                <th>TOTAL PRICE</th>
                <th>REMOVE</th>
                <th col-span = "1">OPERATIONS</th>
              </tr>
            </thead>
            <tbody>
              <!-- php code to display cart data -->
              <?php
              global $con;
              $user_id = $_SESSION['userid'];
              $total_price = 0;
              $select_query = "select * from `cart_details` where user_id = $user_id"; //change done
              // according to the logged in user id, this query will fetch rows from cart_details database
              $result_query = mysqli_query($con, $select_query);
              // according to fetched rows, this "$row=mysqli_fetch_array($result_query)" will fetch data of each row
              while($row=mysqli_fetch_array($result_query)){
                // " $product_id = $row['product_id']" -->this query will fetch only product_id
                $product_id = $row['product_id'];
                $select_products = "select * from `products` where product_id = $product_id ";
                // according to the $product_id, this query will fetch rows from products database
                $result_products = mysqli_query($con, $select_products);
                // according to fetched rows, this "$row_of_product_table =mysqli_fetch_array($result_products)" will fetch data of each row 
                while($row_of_product_table =mysqli_fetch_array($result_products)){
                  // " $row_of_product_table['product_price']" -->this query will fetch only product_price
                  // array($row_of_product_table['product_price'] --> fetched product price will be stored in an array named $product_price
                  $product_price = array($row_of_product_table['product_price']);
                  $product_title = $row_of_product_table['product_title'];
                  $product_image = $row_of_product_table['product_image'];
                  $products_price = $row_of_product_table['product_price'];
                  //array_sum() Calculate the sum of values in an array , Returns the sum of values as an integer or float.
                  $product_values_sum = array_sum($product_price);
                  $total_price += $product_values_sum;
              ?>
              <tr>
                <td><?php echo "$product_title"?></td>
                <td><img src="./admin/product_images/<?php echo $product_image?>" alt="" class= "cart_image"></td>
                <td><?php echo $products_price?></td>
                <td> <input type="checkbox" name="removeitem[]" value="<?php echo $product_id?>" > </td>
                <td>
                  <input type="submit" value = "Remove" class="btn btn-info px-3 border-0 m-2" name = "remove_cart"
                  style="background-color: #d63384; ">

                </td>
              </tr>
              <?php
              }
              }
              ?>
            </tbody>
          </table>
          <!-- SUBTOTAL -->
          <div class="d-flex">
            <h4 class="px-3">SUBTOTAL : <strong><?php echo $total_price?></strong></h4>
            <button class="btn btn-info px-3vborder-0 m-2" name = "checkout" style="background-color: #d63384; ">CHECK OUT</button>
          </div>
          </form>
          <?php
          if(isset($_POST['checkout'])){
            echo "<script>window.open('checkout.php','_self')</script>";
          }
          ?>
        <!--Function to remove item"-->
        <?php

        function remove_cartitem(){
          $user_id = $_SESSION['userid'];
            global $con;
            if(isset($_POST['remove_cart'])){
                foreach($_POST['removeitem'] as $remove_id){
                    echo $remove_id;
                    $delete_query="Delete from `cart_details` where product_id = $remove_id and user_id = $user_id";
                    $run_delete=mysqli_query($con,$delete_query);
                    if($run_delete){
                        echo "<script>window.open('cart.php','_self')</script>";
                    }
                }
            }
        }
        echo  remove_cartitem();
        ?>
        </div>
    </div>
    <div style="background-color: #d63384;" class="footer">
    <p> Ecommerce site - Designed by SHREYASI SUVRONEEL ISHIKA  </p>
    </div>
    </div>
    </body>
    </html>
  <?php
  include('../includes/connect.php');
  // if button is clicked then only if condition will be true
  // in "$product_title = $_POST['product_title'];" --> product_title is name of the input code
  // in "$_POST['insert_product'])" --> 'insert_product' is name of (insert product) button
  if(isset($_POST['insert_product'])){
    $product_title = $_POST['product_title'];
    $product_description = $_POST['product_description'];
    $product_keyword = $_POST['product_keyword'];
    $product_categories = $_POST['product_categories'];
    $product_brands = $_POST['product_brands'];
    $product_price = $_POST['product_price'];
    // accessing images 
    $product_image = $_FILES['product_image']['name'];
    // accessing image temperary name
    $temp_image = $_FILES['product_image']['tmp_name'];

    // checking empty fields of form
    if($product_title == ' ' or $product_description == ' ' or $product_keyword == ' ' or $product_categories == ' ' 
    or $product_brands == ' ' or $product_price == ' 'or $product_image == ' ' ){
      echo "<script>alert('please all the fields')</script>";
      exit();
    }else{
      
      // have to create a image folder separately that has all the product image used in database
      //images which admin will insert in form , will be automatically stored in that folder
      move_uploaded_file($temp_image,"./product_images/$product_image");
      
      
      // query to insert in the product database
      $insert_products = "insert into `products` (product_title, product_description, product_keywords, category_id, brandid, product_image, product_price, date) values('$product_title', '$product_description', '$product_keyword', $product_categories, $product_brands, '$product_image', '$product_price', NOW())";
      
      $result_query = mysqli_query($con, $insert_products);
      // echo "<script>alert('please all the fields')</script>";
      if ($result_query) {
          echo "<script>alert('Product successfully inserted in the database.')</script>";
          echo "<script>window.open('insert_product.php', '_self')</script>";
      } else {
          echo "<script>alert('Error: Unable to insert the product into the database.')</script>";
      }
    }

  }
  ?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>INSERT_PRODUCTS-ADMIN-DASHBOARD</title>
      <!-- BOOTSTRAP CSS LINK -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
      <link rel="stylesheet" href="style.css">
      <!-- font awesome link -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  </head>
  <body class= "bg-light">
      <div class="container">
          <h1 class="text-center m-3">INSERT PRODUCTS </h1>
          <!-- form  , enctype to insert image in form-->
          <form action="" method="post" enctype="multipart/form-data" >
              <!-- product title -->
            <div class="form-outline mb-4 w-50 m-auto">
              <label for="product_title" class="form-label">Product Title</label>
              <input type="text" name="product_title" id="product_title " class="form-control" 
              placeholder="ENTER PRODUCT TITLE" autocomplete="Off " required = "required" >
            </div>

            <!-- product description -->
            <div class="form-outline mb-4 w-50 m-auto">
              <label for="product_description" class="form-label">Product Description</label>
              <input type="text" name="product_description" id="product_description " class="form-control" 
              placeholder="ENTER PRODUCT DESCRIPTION" autocomplete="Off " required = "required" >
            </div>
            <!-- PRODUCT KEYWORD FOR SEARCHING -->
            <div class="form-outline mb-4 w-50 m-auto">
              <label for="product_keyword" class="form-label">Product Keywords</label>
              <input type="text" name="product_keyword" id="product_keyword " class="form-control" 
              placeholder="ENTER PRODUCT KEYWORD" autocomplete="Off " required = "required" >
            </div>
    <!-- CATEGORIES -->
    <div class="form-outline mb-4 w-50 m-auto">
    <select name="product_categories" class="form-control" id="">
    <option value="">SELECT A CATEGORY</option>
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
      echo  " <option value='$category_id'>$category_names</option>";
    }
  ?>
  </select>
  </div>
            <!-- select brands -->
            <div class="form-outline mb-4 w-50 m-auto">
              <select name="product_brands" class="form-control" id="">
                  <option value="">SELECT A BRAND</option>
                  <?php 
    $select_brands = "select * from `brands` ";
    $result_brands = mysqli_query($con,$select_brands);
    // $row_data = mysqli_fetch_assoc($result_brands);
    // echo $row_data['brand_title'];
    while($row_data = mysqli_fetch_assoc($result_brands)){
      $brand_title = $row_data['brand_title'];
      $brand_id =  $row_data['brandid'];
      echo  "<option value='$brand_id'>$brand_title</option>";
    }
    ?>
  </select>
  </div>
            <!-- PRODUCT IAMGE -->
            <div class="form-outline mb-4 w-50 m-auto">
              <label for="product_image" class="form-label">PRODUCT IMAGE</label>
              <input type="FILE" name="product_image" id="product_image " class="form-control" 
              placeholder="ENTER PRODUCT IMAGE"  required = "required" >
            </div>

  <!-- PRODUCT PRICE -->
            <div class="form-outline mb-4 w-50 m-auto">
              <label for="product_price" class="form-label">PRODUCT PRICE</label>
              <input type="text" name="product_price" id="product_price " class="form-control" 
              placeholder="ENTER PRODUCT PRICE" autocomplete="Off " required = "required" >
            </div>
  <!-- submit form -->

            <div class="form-outline mb-4 w-50 m-auto">
              <input type="submit" name = "insert_product" class="btn btn-info" value="Insert Products" >
            </div>


          </form>
      </div>


      <!-- BOOTSRAP JS LINK -->
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
      
      
  </body>
  </html>
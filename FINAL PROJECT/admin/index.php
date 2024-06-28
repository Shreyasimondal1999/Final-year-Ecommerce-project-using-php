  <!DOCTYPE html>
  <html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>ADMIN DASHBOARD</title>
      <!-- BOOTSTRAP CSS LINK -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
      <link rel="stylesheet" href="style.css">
      <!-- font awesome link -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      
  </head>
  <body>
  <div class="container-fluid p-0">
      <!-- first child -->
  <!-- nav bar -->
  <nav class="navbar navbar-expand-lg" style="background-color: #d63384;">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"><i class="fa-solid fa-shirt"></i></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">WELCOME ADMIN</a>
          </li>

        </ul>
        
      </div>
    </div>
  </nav>
  <!-- second child -->
  <div class="bg-light p-3">
      <h3 class="taskmanager"  > ADMIN TASK </h3>
  </div>
  <!-- THIRD CHILD -->
  <div class = "row"  >
      <div class="col-md-12 p-1 d-flex align-items-center" >
        <div class="button text center">
          <button class="btn"><a href="insert_product.php" class="nav-link text-light" >Insert Products</a></button>
          <button class="btn"><a href="" class="nav-link text-light" >View Products</a></button>
          <button class="btn"><a href="index.php?Insert_Category" class="nav-link text-light" >Insert Categories</a></button>
          <button class="btn"><a href="" class="nav-link text-light" >View Categories</a></button>
          <button class="btn"><a href="index.php?Insert_Brand" class="nav-link text-light" >Insert Brands</a></button>
          <button class="btn"><a href="" class="nav-link text-light" >View Brands</a></button>
          <button class="btn"><a href="" class="nav-link text-light" >All Orders</a></button>
          <button class="btn"><a href="" class="nav-link text-light" >All payments</a></button>
          <button class="btn"><a href="" class="nav-link text-light" >List Users</a></button>
          <button class="btn"><a href="" class="nav-link text-light" >Logout</a></button>
        </div>
      </div>
  </div>
  <!-- forth child -->
  <div class="container my-3">
    <?php
    // if get variable insert_category active then include insert_categories.php
    if(isset($_GET['Insert_Category'])){
      include('insert_categories.php');
    }
    ?>
  </div>
  <!-- fifth child -->
  <div class="container my-5">
    <?php
    // if get variable insert_brand active then include insert_brands.php
    if(isset($_GET['Insert_Brand'])){
      include('insert_brands.php');
    }
    ?>
  </div>
    <!-- last child - footer -->
    <div style="background-color: #d63384;" class="footer">
  <p> Ecommerce site - Designed by SHREYASI SUVRONEEL ISHIKA </p>
  </div>
  </div>








      <!-- BOOTSRAP JS LINK -->
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>

      
  </body>
  </html>
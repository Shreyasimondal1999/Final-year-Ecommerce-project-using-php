  <!-- database connection with insert_brands.php page, now if we inserrt brands , then database will be updated  -->
  <!-- connecting connect.php file to this file, to use $con -->
  <?php
  include('../includes/connect.php');
  // passing this form with post method , after clicking button, value of button will be passed
  if(isset($_POST['insert_brand'])){
    
    $brand_name = $_POST['brands_title'];
    //  SELECT DATA FROM DATABASE QUERY ,existing brand name will be selected with this query
    $select_query = " select * from `brands` where brand_title = '$brand_name' ";
  // existing rows with particular brandname  will be selected
    $result_select = mysqli_query($con, $select_query);
    // number of rows of existing category name will be saved in $number
    $number = mysqli_num_rows($result_select);
    if($number>0){
      echo "<script> alert('brand name is present inside database') </script>";

    }else{
    $insert_Query = "insert into `brands` (brand_title) values ('$brand_name') ";
    $result = mysqli_query($con,$insert_Query);
    if($result){
    echo "<script> alert('brand has been inserted successfully') </script>";
    }
    }
  }
  ?>

  <h2 class="text-center">INSERT BRANDS</h2>

  <form action="" method="post" class = "mb-2">
  <div class="input-group w-90 mb-3">
    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa receipt"></i></span>
    <input type="text" class="form-control" placeholder="Insert Brands"  name="brands_title" aria-label="Brands"
    aria-describedby="basic-addon1">
  </div>

  <div class="input-group w-10 mb-2">
    
    <input type="submit" class="form-control bg-info"   name="insert_brand" 
    value="Insert Brands" aria-label="username" aria-describedby="basic-addon1">
  </div>
  </form>
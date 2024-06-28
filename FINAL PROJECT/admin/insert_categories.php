  <!-- database connection with insert_catagories.php page, now if we inserrt catagories , then database will be updated  -->
  <!-- connecting connect.php file to this file, to use $con -->
  <?php
  include('../includes/connect.php');
  // passing this form with post method , after clicking button, value of button will be passed
  if(isset($_POST['insert_cat'])){
    
    $category_title = $_POST['cat_title'];
    //  SELECT DATA FROM DATABASE QUERY , // existing category name will be selected with this query
    $select_query = " select * from `category` where category_name = '$category_title' ";
  //   // existing rows with particular category name  will be selected
    $result_select = mysqli_query($con, $select_query);
    // number of rows of existing category name will be saved in $number
    $number = mysqli_num_rows($result_select);
    if($number>0){
      echo "<script> alert('Category name is present inside database') </script>";

    }else{
    $insert_Query = "insert into `category` (category_name) values ('$category_title') ";
    $result = mysqli_query($con,$insert_Query);
    if($result){
    echo "<script> alert('Category has been inserted successfully') </script>";
    }
    }
  }
  ?>
  <h2 class="text-center">INSERT CATEGORIES</h2>
  <form action="" method="post" class = "mb-2">
  <div class="input-group w-90 mb-3">
    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
    <input type="text" class="form-control" name="cat_title" placeholder="Insert Categories" aria-label="Categories"
    aria-describedby="basic-addon1">
  </div>

  <div class="input-group w-10 mb-2">
    
    <input type="submit" class="form-control bg-info"   name="insert_cat" 
    value="Insert Categories" aria-label="username" aria-describedby="basic-addon1">
  </div>
  </form>
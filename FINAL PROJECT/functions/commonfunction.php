  <?php
  include('./includes/connect.php');
  //getting products
  function getproducts(){
      global $con;
      $select_query = " select * from `products`  order by rand() limit 0,9";
      //  select all rows from products table
      $result_query = mysqli_query($con , $select_query);
      // $row_data = mysqli_fetch_assoc($result_query); --> fetch data from rows, but at a time only , that is why while loop is needed
      // echo $row_data['product_title'];
      while($row_data = mysqli_fetch_assoc($result_query)){
        $product_id = $row_data['product_id'];
        $product_title= $row_data['product_title'];
        $product_description = $row_data['product_description'];
        $product_image = $row_data['product_image'];
        $product_price = $row_data['product_price'];
      //  this two data will not be shown in front page , but needed to fetch data according to brand and category
        $category_id = $row_data['category_id'];
        echo "      <div class='col-md-4'>
        <div class= 'card' style='width: 18rem;'>
        <img src='./admin/product_images/$product_image' class='card-img-top' alt='$product_title'>
        <div class='card-body'>
        <h5 class='card-title'>$product_title</h5>
        <p class='card-text'>$product_description.</p>
        <p class='card-text'>Rs $product_price /-</p>
        <a href='INDEX.php?add_to_cart=$product_id' class='btn btn-primary'>Add to Cart</a>
        </div>
        </div>
        </div> ";
      }
  }

  function getallproducts(){
    global $con;
    $select_query = " select * from `products`  order by rand()";
    //  select all rows from products table
    $result_query = mysqli_query($con , $select_query);
    // $row_data = mysqli_fetch_assoc($result_query); --> fetch data from rows, but at a time only , that is why while loop is needed
    // echo $row_data['product_title']; --> $row_data is an array
    while($row_data = mysqli_fetch_assoc($result_query)){
      $product_id = $row_data['product_id'];
      $product_title= $row_data['product_title'];
      $product_description = $row_data['product_description'];
      $product_image = $row_data['product_image'];
      $product_price = $row_data['product_price'];
    //  this two data will not be shown in front page , but needed to fetch data according to brand and category
      $category_id = $row_data['category_id'];
      echo "      <div class='col-md-4'>
      <div class= 'card' style='width: 18rem;'>
      <img src='./admin/product_images/$product_image' class='card-img-top' alt='$product_title'>
      <div class='card-body'>
      <h5 class='card-title'>$product_title</h5>
      <p class='card-text'>$product_description.</p>
      <p class='card-text'>Rs $product_price /-</p>
      <a href='INDEX.php?add_to_cart=$product_id' class='btn btn-primary'>Add to Cart</a>
      </div>
      </div>
      </div> ";
    }
  }


  // function to get searched product
  function search_product(){  
    global $con;
      if(isset($_GET['search_data_product'])){
        $search_data_value = $_GET['search_data'];
      $search_query = " select * from `products`  where product_keywords like '%$search_data_value%' ";
      //  select all rows from products table
      $result_query = mysqli_query($con , $search_query);
      // $row_data = mysqli_fetch_assoc($result_query); --> fetch data from rows, but at a time only , that is why while loop is needed
      // echo $row_data['product_title'];
      //$num_of_rows = mysqli_num_rows($result_query); -> this query checks number of rows in $result_query
      $num_of_rows = mysqli_num_rows($result_query);
    if($num_of_rows == 0)
    echo "<h2 class = 'text-center text-danger' > SORRY , THIS PRODUCT IS NOT AVAILABLE AT THIS MOMENT. </h2>";
      while($row_data = mysqli_fetch_assoc($result_query)){
        $product_id = $row_data['product_id'];
        $product_title= $row_data['product_title'];
        $product_description = $row_data['product_description'];
        $product_image = $row_data['product_image'];
        $product_price = $row_data['product_price'];
      //  this two data will not be shown in front page , but needed to fetch data according to brand and category
        $category_id = $row_data['category_id'];
        echo "      <div class='col-md-4'>
        <div class= 'card' style='width: 18rem;'>
        <img src='./admin/product_images/$product_image' class='card-img-top' alt='$product_title'>
        <div class='card-body'>
        <h5 class='card-title'>$product_title</h5>
        <p class='card-text'>$product_description.</p>
        <p class='card-text'>Rs $product_price /-</p>
        <a href='INDEX.php?add_to_cart=$product_id' class='btn btn-primary'>Add to Cart</a>
        </div>
        </div>
        </div> ";
      }
  }
  }
 

  // cart function 
  function cart(){
    // if $_GET variable 'add_to_cart' is active then only this if condition is true
  if(isset($_GET['add_to_cart'])){
    global $con; // because $con variable is in separate file
    $user_id = $_SESSION['userid'];
    $get_product_id = $_GET['add_to_cart']; // getting product id from 'add_to_cart' -->  which is present in url of add to cart button
    // checking if product with particular user ip exists in the cart 
    $select_query= "select * from `cart_details` where product_id=$get_product_id and user_id = $user_id";
    $result_query= mysqli_query($con, $select_query);
    $num_of_rows = mysqli_num_rows($result_query);
    if($num_of_rows > 0){
    echo "<script>alert('THIS ITEM IS ALREADY PRESENT IN  CART')</script>";
    echo "<script>window.open('INDEX.php','_self')</script>";
    }
    else{
      // if product with particular user ip does not exist in the cart then insert that product with user ip in the cart database
      $insert_query = " insert into `cart_details` (product_id,user_id) values('$get_product_id','$user_id')"; //CHANGE NEEDED
      $result_query = mysqli_query($con,$insert_query);
      echo "<script>alert('ITEM ADDED IN THE CART')</script>";
      echo "<script>window.open('INDEX.php','_self')</script>";
    }
  }
  }

  // FUNCTION TO GET CART ITEM NUMBERS
  function cart_item_number(){
    $user_id = $_SESSION['userid'];
    // if $_GET variable 'add_to_cart' is active then only this if condition is true
    if(isset($_GET['add_to_cart'])){
      global $con;
      //$ip = getIPAddress();
      // checking if product with particular  userid exists in the cart , because cart item number for particular user will only be visible in the webpage
      $select_query= "select * from `cart_details` where  user_id = $user_id "; //change done
      $result_query= mysqli_query($con, $select_query);
      $count_cart_items = mysqli_num_rows($result_query);
    }
      else{
        global $con; // because $con variable is in separate file
        //$ip = getIPAddress();
        // checking if product with particular user id exists in the cart 
        $select_query= "select * from `cart_details` where user_id = $user_id "; // change done
        $result_query= mysqli_query($con, $select_query);
        $count_cart_items = mysqli_num_rows($result_query);
      }
  echo $count_cart_items;
    }
    // total cart item price function
    function total_cart_price(){
      $user_id = $_SESSION['userid'];
      global $con;
      $total_price = 0;
      $select_query = "select * from `cart_details` where  user_id = $user_id";//change done
      // according to the logged in user ip, this query will fetch rows from cart_details database
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
          // " $row_of_product_table['product_price']" -->this query will fetch only one product_price
          // array($row_of_product_table['product_price'] --> fetched product price will be stored in an array named $product_price
          $product_price = array($row_of_product_table['product_price']);
          //array_sum() Calculate the sum of values in an array , Returns the sum of values as an integer or float.
          $product_values_sum = array_sum($product_price);
          $total_price += $product_values_sum;
        }
      }
      echo $total_price;
    }

    // get user order details
function get_user_order_details(){
  global $con;
$username= $_SESSION['username'];
$get_details = "select * from `user_table` where username = '$username'";

$result_query = mysqli_query($con, $get_details);
while($row_query=mysqli_fetch_array($result_query)){
   //here $row_query is an array
  //going to fetch user id
      $user_id=$row_query['user_id'];
      //edit_account,my_orders,delete_account are variables passed in href links in user_profile
      //if they are not clicked or set, then pending orders will be showed
      if(!isset($_GET['edit_account'])){
        if(!isset($_GET['my_orders'])){
          if(!isset($_GET['delete_account'])){
//access data from user order table,how many orders particular user having
            $get_orders="Select * from `user_orders` where user_id=$user_id and order_status='pending'";
            //only if order is pending , this will be accessed
            $result_orders_query=mysqli_query($con,$get_orders);
            //counting no of rows, orders done by a particular user
            $row_count=mysqli_num_rows($result_orders_query);
            //in case of pending orders
            if($row_count>0){
              echo"<h3 class='text-center text-success'>You have <span class='text-danger mt-5 mb-2'>$row_count
              </span> pending order(s)</h3>
             <p class='text-center text-success'><a href='user_profile.php?my_orders' class='text-dark'>Order Details</a></p>"; 
            }else{
              echo"<h3 class='text-center text-success'>You have zero pending order(s)</h3>
             <p class='text-center text-success'><a href='INDEX.php' class='text-dark'>Explore Products</a></p>";
            }
          }
        }
      }
    }
}


  ?>

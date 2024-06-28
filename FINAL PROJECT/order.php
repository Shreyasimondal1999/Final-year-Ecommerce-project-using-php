<?php 
include('./includes/connect.php');
include('./functions/commonfunction.php');

if (isset($_GET['userid'])){
    $user_id = $_GET['userid']; //getting user id from userid set in payment page in href link , if someone clicks payment then user id get saved in order.php link
    
}
//getting total prices and total price of all items
//$get_ip_address=getIPAddress();//if a user orders 4 items then , those 4 item in cart tabel has same user ip
$total_price = 0;
$cart_query= "Select * from `cart_details` 
where user_id = $user_id ";//change
$result_cart=mysqli_query($con,$cart_query);
$count_products = mysqli_num_rows($result_cart);
while($row_data=mysqli_fetch_array($result_cart)){
    $product_id=$row_data['product_id'];
    $select_product= "Select * from `products` 
    where product_id =$product_id";
    $run_product=mysqli_query($con, $select_product);
    while($row_product=mysqli_fetch_array($run_product)){//fetching price
        $product_price=array($row_product['product_price']);//storing product price in array named $product_price
        $product_values=array_sum($product_price);//storing sum of all elements of $product_price array in $product_values, note-$product_price array  will only contain one element, as product id is unique
        $total_price+=$product_values;
    }
    }
$invoice_number=mt_rand();//random number going to be stored as invoice
$status='pending';//pending
    //insert query
    $insert_orders="Insert into`user_orders` (user_id,amount_due,invoice_number,total_products,order_date,order_status) 
    values
    ($user_id,$total_price,$invoice_number,$count_products,NOW(),'$status')";//now() current time
    $result_query=mysqli_query($con,$insert_orders);
    if($result_query){
        echo"<script>alert('Orders submitted successfully')</script>";
        //since we are not creating profile.php 
        echo"<script>window.open('user_profile.php','_self')</script>";//self changes path instead of a new window ,original
    }
    //pending orders
$insert_pending_orders="Insert into `orders_pending` (user_id,invoice_number,product_id,order_status) 
values
($user_id,$invoice_number,$product_id,'$status')";//now() current time
$result_pending_orders=mysqli_query($con,$insert_pending_orders);
//delete from cart
//order given with same ip are deleted
$empty_cart="Delete from `cart_details` where user_id = $user_id";//change
$result_delete=mysqli_query($con,$empty_cart);
?>

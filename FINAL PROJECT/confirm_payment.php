<?php
  include('./includes/connect.php');
  session_start();
  $user_id = $_SESSION['userid'];
  if(isset($_GET['order_id'])){
    $order_id = $_GET['order_id'];
    $select_data="select * from `user_orders` where order_id = $order_id";
    $result_query = mysqli_query($con,$select_data);
    $row_fetch=mysqli_fetch_assoc($result_query);
    $invoice_number=$row_fetch['invoice_number'];
    $amount_due=$row_fetch['amount_due'];

  }
if(isset($_POST['confirm_payment'])){
  $invoice_number = $_POST['invoice_number'];
  $amount = $_POST['amount'];
  $payment_mode = $_POST['payment_mode'];
  echo "<script>$payment_mode</script>";
  if($payment_mode != 'CASH ON DELIVERY'){
    $insert_query = "insert into `user_payments` (order_id,user_id,invoice_number,amount,payment_mode,date) 
    values($order_id,$user_id,$invoice_number,$amount,'$payment_mode',NOW())";
    $Result_query = mysqli_query($con,$insert_query);
    if($Result_query){
     echo "<script>alert('PAYMENT DONE SUCCESSFULLY')</script>";
     echo "<script>window.open('user_profile.php?my_orders','_self')</script>";
    }
    //after payment updating order details
    $update_user_order = "update `user_orders` set order_status = 'complete' where order_id = $order_id" ;
    $result = mysqli_query($con,$update_user_order);
     //after payment updating orders_pending table in data base
   $empty_pending_order="Delete from `orders_pending` where order_id = $order_id";//change
   $result_delete=mysqli_query($con,$empty_pending_order);
  }else{
    $insert_query = "insert into `user_payments` (order_id,user_id,invoice_number,amount,payment_mode,date) 
    values($order_id,$user_id,$invoice_number,$amount,'cash on delivery',NOW())";
    $Result_query = mysqli_query($con,$insert_query);
    if($Result_query){
     echo "<script>alert('PAYMENT WILL BE DONE on cash on delivery mode')</script>";
     echo "<script>window.open('user_profile.php?my_orders','_self')</script>";
    }
    //after payment updating order details
    $update_user_order = "update `user_orders` set order_status = 'Cash on delivery' where order_id = $order_id" ;
    $result = mysqli_query($con,$update_user_order);
     //after payment updating orders_pending table in data base
   $empty_pending_order="Delete from `orders_pending` where order_id = $order_id";//change
   $result_delete=mysqli_query($con,$empty_pending_order);
  }
}

  ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Payment page</title>
  <!-- bootstrap link -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
      <link rel="stylesheet" href="style.css">
</head>
<body class="bg-secondary">
  <div class="container my-5">
  <h1 class="text-center text-light" >Confirm Payment</h1>
    <form action="" method="post" >
      <div class="form-outline my-4 text-center">
        <input type="text" class="form-control w-50 m-auto" name="invoice_number" value="<?php echo $invoice_number?>" >
      </div>
      <div class="form-outline my-4 text-center">
        <label for="" class="text-light">Amount</label>
        <input type="text" class="form-control w-50 m-auto" name="amount" value="<?php echo $amount_due?>">
      </div>
      <div class="form-outline my-4 text-center">
        <select name="payment_mode" class="form-select w-50 m-auto" >
          <option value="SELECT PAYMENT MODE">SELECT PAYMENT MODE</option>
          <option value="UPI">UPI</option>
          <option value="NET-BANKING">NET-BANKING</option>
          <option value="CASH ON DELIVERY">CASH ON DELIVERY</option>
        </select>
      </div>
      <div class="form-outline my-4 text-center">
        <!-- clicking on confirm , data reflect to database table - user_payments -->
        <input type="submit" class="btn py-2 px-3 border-0"  style="background-color: #d63384;" value="confirm" name="confirm_payment">
      </div>
    </form>
  </div>
  
</body>
</html>
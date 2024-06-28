
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!--php-->
    <?php  
    $username=$_SESSION['username'];//username stored
    $user_id = $_SESSION['userid'];
    // $get_user="Select * from `user_table` where username='$username'";
    // $result=mysqli_query($con,$get_user);
    // $row_fetch=mysqli_fetch_assoc($result);
    // $user_id=$row_fetch['user_id'];
    ?>
    <h2 class=" text-success text-center mt-4">All my order(s)</h2>
    <!--showing  table-->
    <table class="table table-bordered mt-5 text-center" >
    <thead class="" style="background-color: #d63384">
        <tr>       
            <th>SI no</th>
            <th>Amount Due</th>
            <th>Total Products</th>
            <th>Invoice Number</th>
            <th>Date</th>
            <th>Complete/incomplete</th>
            <th>Status</th>
        </tr>       
    </thead>
    <tbody>
<!--php-->
        <?php 
        $get_order_details="Select * from `user_orders` where user_id=$user_id"; 
        $result_orders=mysqli_query($con,$get_order_details);
        $number=1;//for serial no
            //random numbers
        while ($row_orders=mysqli_fetch_assoc($result_orders)) {
            $order_id=$row_orders['order_id'];
            $amount_due=$row_orders['amount_due'];
            $total_orders=$row_orders['total_products'];
            $invoice_number=$row_orders['invoice_number'];
            $order_status=$row_orders['order_status'];
            if($order_status=='pending'){
                $order_status='Incomplete';  
            }elseif ($order_status=='Cash on delivery') {
                $order_status='cash on delivery to be done';
            }
            else{
                $order_status='Complete';
            }
            $order_date=$row_orders['order_date'];
            echo"
            <tr>
                <td>$number</td>
                <td>$amount_due</td>
                <td>$total_orders</td>
                <td>$invoice_number</td>
                <td>$order_date</td>
                <td>$order_status</td>";
                ?>
                <?php
                if($order_status=='Complete'){
                    echo "<td>Paid</td>";
                }elseif ($order_status=='cash on delivery to be done') {
                    echo "<td>Cash on delivery to be done</td>";
                }
                else{
                    echo "<td><a href='confirm_payment.php?order_id=$order_id' class='text-info' style='text-decoration:none;'>Confirm</td>
                    </tr>";
                }
            $number++;
        }  
        ?>
    </tbody>
    </table>
</body>
</html>
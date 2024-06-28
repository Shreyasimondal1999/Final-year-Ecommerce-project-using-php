<?php
    include('./includes/connect.php');
    include('./functions/commonfunction.php');
 ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Payment</title>
            <!-- BOOTSTRAP CSS LINK -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" 
        rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ"
        crossorigin="anonymous">
        <style>
img{
    width: 20%;
    border-bottom: black;
    margin: auto;
    display: block;

}
        </style>

    </head>
    <body>
        <!-- php code to acces user id -->
        <?php
        //$user_ip=getIPAddress();
        $user_id = $_SESSION['userid'];
        // $get_user = "select * from  `user_table` where user_id = $user_id";//change done
        // $result_query=mysqli_query($con,$get_user);
        // // fetching user ip from user table
        
        // $fetch_user_id = mysqli_fetch_assoc($result_query);
        // $users_id = $fetch_user_id['user_id'];

        ?>
        <div class="container">
            <h2 class="text-center ">PAYMENT</h2>
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-md-6">
                <a href="https://www.paypal.com" target="_blank"><img src="./images/PayPal_Logo_2007.png" alt=""></a>
                </div>
                <div class="col-md-6">
                <a href="order.php?userid=<?php echo $user_id?>" ><h2>Do payment</h2></a>
                </div>
                
            </div>

        </div>
    </body>
    </html>
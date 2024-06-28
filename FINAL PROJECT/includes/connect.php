    <!-- database connection with rootfile is done  -->
    <!-- connection successful message hide -->
    <?php
    $con=mysqli_connect('localhost','root','', 'thrift_store');
    if($con){
    // echo "connection successfully done"; 
    }else{
        die(mysqli_error($con));
    }

    ?>
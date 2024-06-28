<?php 
include('./includes/connect.php');
include('./functions/commonfunction.php');

@session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
        <!-- BOOTSTRAP CSS LINK -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ"
     crossorigin="anonymous">  
</head>
<style>
    body
    {
        overflow-x: hidden;
    }
</style>
<body>
    <div class="container-fluid my-3">
        <h2 class="text-center">User Login</h2>
        <div class="row d-flex align-items-center justify-content-center mt-5"> <!--d flex = display flex-->
            <div class="col-lg-12 col-xl-6"> <!--xl extra large-->
                <form action="" method="post" >
                 <!---user name-->
                    <div class="form-outline mb-4"> 
                    <label for="user_username" class ="form-label">Username</label>
                    <input type="text" id="user_username" class="form-control" placeholder="Enter your username" 
                    autocomplete="off" required="required" name = "user_username"/>              
                    </div>
                    <!--password-->
                <div class="form-outline mb-4"> 
                    <label for="user_password" class ="form-label">Password</label>
                    <input type="password" id="user_password" class="form-control" placeholder="Enter your password" 
                    autocomplete="off" required="required" name = "user_password"/>
                </div>
                <div class="mt-4 pt-2"><!--mt/md = margin top/margin botom same for padding -->
                    <input type="submit" value="Login" class = "py-2 px-3 border-0" style="background-color: #d63384;"
                    name ="user_login" ><!--px = padding at x axis-->
                <!--fw = font weight-->
                    <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account?<a href="user_registration.php" class="text-danger">Register</a></p>
                </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<?php 
if(isset($_POST['user_login']))
{
    $user_username=$_POST['user_username'];
    $user_password=$_POST['user_password'];
// matches username and password with existing username in database , note ->  username and user email is unique
    $select_query="Select * from `user_table` where username = '$user_username' and user_password='$user_password'";
    $result=mysqli_query($con,$select_query);

    $row_count=mysqli_num_rows($result);
    $row_data=mysqli_fetch_assoc($result);
    //getting user id of logged in user
    $select_query_userid="Select * from `user_table` where username = '$user_username' and user_password='$user_password'";
            $result_user_id=mysqli_query($con,$select_query_userid);
            $row_data1=mysqli_fetch_array($result_user_id);

    if($row_count > 0)
    {
            $user_id = $row_data1['user_id'];
            $_SESSION['username']=$user_username;
            $_SESSION['userid']=$user_id;
            echo "<script>alert('Login Succcesful')</script>";//checked
            echo "<script>window.open('INDEX.php','_self')</script>";
    }
    else
    {
        echo "<script>alert('Invalid Credentials')</script>";//checked
    }
}
?>
    <?php 
    include('./includes/connect.php');
    //include('./functions/commonfunction.php');
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Registration</title>
            <!-- BOOTSTRAP CSS LINK -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" 
        rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ"
        crossorigin="anonymous">
    </head>
    <body>
        <div class="container-fluid my-3">
            <h2 class="text-center">New User Registration</h2>
            <div class="row d-flex align-items-center justify-content-center"> <!--d flex = display flex-->
                <div class="col-lg-12 col-xl-6"> <!--xl extra large-->
                    <form action="" method="post" enctype="multipart/form-data"><!--enctype="multipart/form-data for inserting  images of user in the database-->
                    <!---user name-->
                        <div class="form-outline mb-4"> 
                        <label for="user_username" class ="form-label">Username</label>
                        <input type="text" id="user_username" class="form-control" placeholder="Enter your username" 
                        autocomplete="off" required="required" name = "user_username"/>                       
                        </div>                  
                    <!--email-->
                        <div class="form-outline mb-4"> 
                        <label for="user_email" class ="form-label">Email</label>
                        <input type="email" id="user_email" class="form-control" placeholder="Enter your email" 
                        autocomplete="off" required="required" name = "user_email"/>                       
                        </div>                        
                        <!--password-->
                    <div class="form-outline mb-4"> 
                        <label for="user_password" class ="form-label">Password</label>
                        <input type="password" id="user_password" class="form-control" placeholder="Enter your password" 
                        autocomplete="off" required="required" name = "user_password"/>
                    </div>
                        <!--confirm password-->
                    <div class="form-outline mb-4"> 
                        <label for="conf_user_password" class ="form-label">Confirm Password</label>
                        <input type="password" id="conf_user_password" class="form-control" placeholder="Confirm  password" 
                        autocomplete="off" required="required" name = "conf_user_password"/>
                    </div>
                        <!--Address -->
                    <div class="form-outline mb-4"> 
                        <label for="user_address" class ="form-label">Address</label>
                        <input type="text" id="user_address" class="form-control" placeholder="Enter your address" 
                        autocomplete="off" required="required" name = "user_address"/>
                    </div>
                        <!--Contact -->
                    <div class="form-outline mb-4"> 
                        <label for="user_contact" class ="form-label">Contact</label>
                        <input type="text" id="user_contact" class="form-control" placeholder="Enter your Mobile Number" 
                        autocomplete="off" required="required" name = "user_contact"/>
                    </div>
                    <div class="text-center mt-4 pt-2"><!--mt/md = margin top/margin botom same for padding -->
                        <input type="submit" value="Register" class = "py-2 px-3 border-0" style="background-color: #d63384;" name ="user_register" ><!--px = padding at x axis-->
                    <!--fw = font weight-->
                        <p class="small fw-bold mt-2 pt-1 mb-0" > Already have an account ? <a href="user_login1.php" class="text-danger">Login</a></p>                                   
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
    </html>
    <!--php code-->
    <!-- post method passes data to database -->
    <?php 
        if(isset($_POST['user_register'])){
            $user_username=$_POST['user_username'];
            $user_email=$_POST['user_email'];
            $user_password=$_POST['user_password'];
            $conf_user_password=$_POST['conf_user_password'];//not storing in database
            $user_address=$_POST['user_address'];
            $user_contact=$_POST['user_contact'];
            $select_query="Select * from `user_table` where username = '$user_username' or user_email='$user_email'";
            $result=mysqli_query($con,$select_query);       
            //checking no of rows im getting
            $rows_count=mysqli_num_rows($result);
            if($rows_count > 0) //if now of row of username/email more than 0
{
// username and user email is unique
                echo "<script>alert('Username or Email already exists')</script>";
            }    
            else if($user_password!=$conf_user_password) //matching passwords
            {
                echo "<script>alert('Paswords do not match')</script>";
            }  
            else
            {
            //insert query
            $insert_query="insert into `user_table`(username,user_email,user_password,
            user_address,user_mobile) values ('$user_username','$user_email',
            '$user_password','$user_address','$user_contact')";
            //executing query
            $sql_execute=mysqli_query($con,$insert_query);
            echo "<script>window.open('user_login1.php','_self')</script>";
            }
   }
    ?>
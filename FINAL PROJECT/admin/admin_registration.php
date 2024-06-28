    <?php 

    include('./includes/connect.php');
    


    ?>


    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Registration</title>


            <!-- BOOTSTRAP CSS LINK -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" 
        rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ"
        crossorigin="anonymous">

    
    <style>

        body
        {
            overflow: hidden;
        }
    </style>
    </head>
    <body>

        <div class="container-fluid m-3">

            <h2 class="text-center">Admin registration</h2>

            <div class="row d-flex  justify-content-center"> <!--d flex = display flex-->

            <div class="col-lg-6 col-xl-5">
                        <img src="registration.jpg" alt="Admin Registration" class="img-fluid"-- ><!--bg coming brown dont know why-->
                    </div>    
            
            <div class="col-lg-6 col-xl-4 m-3"> <!--xl extra large-->

                    <form action="" method="post" enctype="multipart/form-data"><!--enctype="multipart/form-data for storing images of user-->


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


                        
                    <div class="mt-4 pt-2"><!--mt/md = margin top/margin botom same for padding -->

                        <input type="submit" value="Register" class = "bg-info py-2 px-3 border-0" name ="user_register" ><!--px = padding at x axis-->
                    <!--fw = font weight-->

                        
                    
                    
                    </div>

                    </form>
                </div>


            </div>

        </div>


    </body>
    </html>


    <!--php code-->
    <?php 
        if(isset($_POST['user_register']))
        {

            $user_username=$_POST['user_username'];
            $user_email=$_POST['user_email'];

            $user_password=$_POST['user_password'];
            $conf_user_password=$_POST['conf_user_password'];//not storing in database



        


            //select query

            $select_query="Select * from `admin_table` where admin_name = '$user_username' or admin_email='$user_email'";
            $result=mysqli_query($con,$select_query);
            
            //checking no of rows im getting
            $rows_count=mysqli_num_rows($result);

            if($rows_count > 0) //if now of row of username/email more than 0
            {

                echo "<script>alert('Username or Email already exists')</script>";//no echo comng

            }    
            
            else if($user_password!=$conf_user_password) //if now of row of username/email more than 0
            {

                echo "<script>alert('Paswords do not match')</script>";

            }  
        
            else
            {

            //insert query,like sql insert 

            //move_uploaded_file($user_image_temp,"./user_images/$user_image");//moving images to user_image folder
            
            $insert_query="insert into `admin_table`(admin_name,admin_email,admin_password) values ('$user_username','$user_email',
            '$user_password')";//'$user_image',

            //executing sql
            $sql_execute=mysqli_query($con,$insert_query);

        }
            
        }


    ?>
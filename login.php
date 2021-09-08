<?php include('config/constants.php'); ?>   
<html>
    <head>
        <title>Login - WOW Food</title>
        <link rel="stylesheet" href="style/admin.css"/>
    </head>

    <body>
            
        <div class="login text-center">
            <h1 >Customer Login</h1>
            <br/>

            <?php 
              if(isset($_SESSION['login'])){
                  echo $_SESSION['login'];
                  unset($_SESSION['login']);
              }
               if(isset($_SESSION['no-login-message'])){
                   echo $_SESSION['no-login-message'];
                   unset($_SESSION['no-login-message']);
               }
            ?>
            <br/><br/>
            <!-- Login form starts here -->

            <form action="" method="POST">
                Username: <input type="text" name="username"><br/><br/>
                Password: <input type="password" name="password"><br/><br/>
                <input type="submit" name="submit" value="Login" class="btn-primary loginbtn-size"><br/><br/>
            </form>
            <br/><br/>
            <h4>
                Don't have an Account? &nbsp; &nbsp; <a href="<?php echo SITEURL; ?>signup.php" class="btn-danger">SignUp Here</a>
            </h4>
            
            <br/><br/>
            <!-- Login form ends here -->
            <p>Created By - <a href="#" style="text-decoration:none">Surbhi B</a></p>
        </div>


    </body>
</html>

<?php
     //check  login button click or not
     if(isset($_POST['submit'])){

        //1. fetch data from login form
        // old way-> $username = $_POST['username'];  $password = md5($_POST['password']);
        //new way-> to escape special characters in string in sql statement
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, md5($_POST['password']));

        //2. sql check whether user with username and pwd exist or not
        $sql = "SELECT * FROM tbl_customer WHERE username = '$username' AND password = '$password'";

        //3.execute query
        $res = mysqli_query($conn, $sql);

        //4. count rows to check user exist or not
        $count = mysqli_num_rows($res);
        if($count == 1){
            $_SESSION['login'] = "<div class='success'>Login Successfull.</div>";

            $_SESSION['user'] = $username; //check whether user logged in or not $ logout will unset it
            // this is used in login-check
            header('location:'.SITEURL);

              
        }
        else{
            // user not exist
            $_SESSION['login'] = "<div class='lerror text-center'>Username or Password not Exist.</div>";
            header('location:'.SITEURL.'login.php');
        }
     }
?>
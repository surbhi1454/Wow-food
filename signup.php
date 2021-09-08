<?php include('config/constants.php'); ?>   
<html>
    <head>
        <title>Login - WOW Food</title>
        <link rel="stylesheet" href="style/admin.css"/>
    </head>

    <body>
            
        <div class="login text-center">
            <h1 >Customer SignUp</h1>
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
                Full Name: <input type="text" name="full_name"><br/><br/>
                Username: <input type="text" name="username"><br/><br/>
                Password: <input type="password" name="password"><br/><br/>
                <input type="submit" name="submit" value="Create Account" class="btn-danger loginbtn-size"><br/><br/>
            </form>
             
            <br/><br/>
            <h4>
                Have an Account? &nbsp; &nbsp; <a href="<?php echo SITEURL; ?>login.php" class="btn-primary">Login Here</a>
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
        $full_name = $_POST['full_name'];
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, md5($_POST['password']));

        //2. sql insert
        
        $sql = "INSERT INTO tbl_customer SET
                full_name = '$full_name',
                username = '$username',
                password = '$password'
        ";

        //3.execute query
        $res = mysqli_query($conn, $sql);
        
        if($res == TRUE){
            $_SESSION['login'] = "<div class='lsuccess'>Signup Successfull.</div>";
            $_SESSION['user'] = $username; //check whether user logged in or not $ logout will unset it
            // this is used in login-check
            header('location:'.SITEURL);
        }
        else{
             // sign up again
             $_SESSION['login'] = "<div class='error text-center'>SignUp Again.</div>";
             header('location:'.SITEURL.'signup.php');
        }
     }
?>
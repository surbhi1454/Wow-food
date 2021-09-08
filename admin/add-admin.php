<?php include('partials/menu.php'); ?>

<div class = "main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br/>

        <!-- display session message -->

        <?php 

           if(isset($_SESSION['add'])){  // checking session set or not
             echo "<font color='green'>".$_SESSION['add']."</font>";  // display session msg
             unset($_SESSION['add']); // removeing session msg
           }
           ?>
           <br/><br/>
        <!-- post for hide form values in browser and get for display that -->
        <form action="#" method="POST">
            <table class="tbl-50">
                <tr>
                    <td>Full Name:</td>
                    <td><input type = "text" name="full_name"/></td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td><input type = "text" name="username"/></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type = "password" name="password" placeholder="Enter password"/></td>
                </tr>
                <tr>
                    <td colspan="2"><input type = "submit" name="submit" value="Add Admin" class="btn-secondary"/></td>
                </tr>
            </table>
        </form>  
    </div>
</div> 


<?php include('partials/footer.php'); ?>

<?php 
//    process the value from Form and save in databse
//    check whether submit btn clicked or not
      if(isset($_POST['submit'])){
          
        // btn clicked
        //  echo "Button Clicked";

        //1. get data from form
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']);  /* md5 for encrypt password*/


        //2. sql query to save data in database  (left side me sql ka col and rt side me form ke values)
        $sql = "INSERT INTO tbl_admin SET 
             full_name = '$full_name',
             userName = '$username',
             password = '$password'
        ";

        //3. executing query nd saving data in db
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        //4. check whether (query executed) data is inserted or not nd display appropriate msg
        if($res == TRUE){
            //data inserted
            // now create session variable to display message
            $_SESSION['add'] = "<div class='success'>Admin Added Succesfully.</div>";

            // Redirect page Tto manage admin page
            header("location:".SITEURL.'admin/manage-admin.php'); // siteurl has home page url

        }
        else{
            // fail to insert
            // now create session variable to display message
            $_SESSION['add'] = "<div class='error'>Failed to add admin.</div>";

            // Redirect page Tto manage admin page
            header("location:".SITEURL.'admin/add-admin.php'); // siteurl has home page url
        }
      }
?>
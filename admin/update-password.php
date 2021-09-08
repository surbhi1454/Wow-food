<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br/> <br/>
        
        <?php

          if(isset($_GET['id'])){
              $id = $_GET['id'];
          }

        ?>


        <form action="" method="POST">
            <table class="tbl-50">
                <tr>
                    <td>Current Password: </td>
                    <td>
                        <input type="password" name="old_password">
                    </td>
                </tr>
                <tr>
                    <td>New Password: </td>
                    <td>
                        <input type="password" name="new_password">
                    </td>
                </tr>
                <tr>
                    <td>Confirm Password: </td>
                    <td>
                        <input type="password" name="confirm_password">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<!-- change password when button clicked -->

<?php

    if(isset($_POST['submit'])){

        //1.get data from form
        $id = $_POST['id'];
        $current_password = md5($_POST['old_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);

        //2.check whether user with current id and current password exists or not
        $sql = "SELECT * FROM tbl_admin WHERE id = $id AND password = '$current_password'";

        //3.execute query
        $res = mysqli_query($conn, $sql);

        if($res == TRUE){
             $count = mysqli_num_rows($res);
             if($count == 1){
                 //echo "USER FOUND";
                 // check whether new pass nd confrm pass match or not
                 if($new_password == $confirm_password){
                     // update pwd
                     // create sql query for that
                     $sql2 = "UPDATE tbl_admin SET password = '$new_password'
                              WHERE id = $id";
                    $res2 = mysqli_query($conn, $sql2);
                    if($res2 == TRUE){
                        $_SESSION['change-pwd'] = "<div class='success'>Password Changed Successfully.</div>";
                        // redirect
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                    else{
                        $_SESSION['change-pwd'] = "<div class='error'>Failed to change Password.</div>";
                        // redirect
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                     
                 }
                 else{
                    $_SESSION['pwd-not-match'] = "<div class='error'>Password Not Match.</div>";
                     // redirect
                     header('location:'.SITEURL.'admin/manage-admin.php');
                 }
                 
             }
             else{
                 $_SESSION['user-not-found'] = "<div class='error'>User Not Found.</div>";
                 //redirect
                 header('location:'.SITEURL.'admin/manage-admin.php');
             }
        }
        
    }
?>


<?php include('partials/footer.php'); ?>

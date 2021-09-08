<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
         <br/> <br/>


         <?php
            
            //1. get id of selected 
            $id = $_GET['id'];
            //2. sql query
            $sql = "SELECT * FROM tbl_admin WHERE id = $id";
            $res = mysqli_query($conn, $sql);

            if($res == TRUE){
               // check if data is available or not
               $count = mysqli_num_rows($res);
               if($count == 1){
                 // get details of that admin
                 //echo "Admin available";
                 $row = mysqli_fetch_assoc($res);
                 $full_name = $row['full_name'];
                 $username = $row['userName'];
               }
               else{
                   // redirect to manage-admin page
                   header('location:'.SITEURL.'admin/manage-admin.php');
               }
            }
         ?>


        <form action="" method="POST">
            <table class="tbl-50">
                <tr>
                    <td>Full Name: </td>
                    <td><input type="text" name="full_name" value="<?php echo $full_name; ?>"></td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td><input type="text" name="username" value="<?php echo $username; ?>"></td>
                </tr>
                <tr>
                    <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="submit" name="submit" value="Update Admin" class="btn-secondary"></td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php  

     // check whether submit button clicked or not
     if(isset($_POST['submit'])){
        // echo "button clicked";
        // get values from form
        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];  // post ke sq box me whi naam daalo jo form ke name me h

        // update on DB
        $sql = "UPDATE tbl_admin SET
                full_name = '$full_name',
                userName = '$username'
                WHERE id = '$id'
        ";
        $res = mysqli_query($conn, $sql);
        if($res == TRUE){
            $_SESSION['update'] = "<div class='success'>Admin Updated Successfully.</div>";
            // redirect
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
        else{
            $_SESSION['update'] = "<div class='error'>Failed to Update Admin.</div>";
            // redirect
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
     } 
?>

<?php include('partials/footer.php'); ?>
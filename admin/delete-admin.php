<?php
 
  include('../config/constants.php'); // to get conn
  //1. get id from manage-admin page to get the row deleted
  $id = $_GET['id'];

  //2.write sql query
   $sql = "DELETE FROM tbl_admin WHERE id = $id";

   //3. execute query in DB
   $res = mysqli_query($conn, $sql) or die(mysqli_error());

   //4. check if query successfully executed or not
   if($res == TRUE){
       // create session variable to display msg about success
       $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully.</div>";

       // redirect to manage-admin page
       header('location:'.SITEURL.'admin/manage-admin.php');
   }
   else{
       // create session variable to display msg about failure
       $_SESSION['delete'] = "<div class='error'>Failed to Delete Admin.</div>";

       // redirect to manage-admin page
       header('location:'.SITEURL.'admin/manage-admin.php');
   } 
?>
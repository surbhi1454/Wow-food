<?php 
   include('../config/constants.php');  // for siteurl
  // destroy session
   session_destroy();  // unsets $_SESSION['user']
 // redirect to login page
   header('location:'.SITEURL.'admin/login.php');

?>
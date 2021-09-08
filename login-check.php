<?php 
    // authorization or access control
    // include this in menu so we can access all pages only after login-check success as menu is included to all pages
    // check user logged in or not
    if(!isset($_SESSION['user'])){
        //user not log in
        // redirect to login page 
        $_SESSION['no-login-message'] = "<div class='lerror text-center'>Please Login to Access Customer Panel.</div>";
        header('location:'.SITEURL.'login.php');
    }

?>
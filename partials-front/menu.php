<?php 
include('config/constants.php');
include('login-check.php');  // authorization
 ?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mirax Restaurant</title>

    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/front.css">
</head>
<body>
    <!-- Navbar Section Starts Here -->
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="#" title="Logo">
                    <img src="images/logo.png" alt="Restaurant Logo" class="img-responsive">
                </a>
            </div>
            
            <div class="flex-container">
                <div><a href="<?php echo SITEURL; ?>">Home</a></div>
                <div><a href="<?php echo SITEURL; ?>category.php">Categories</a></div>
                <div><a href="<?php echo SITEURL; ?>food.php">Food</a></div> 
                <div><a href="<?php echo SITEURL; ?>contact.php">Contact</a></div> 
                <div><a href="<?php echo SITEURL; ?>logout.php">Logout</a></div> 
                <div><a href="<?php echo SITEURL; ?>admin/login.php">SignIn as Admin</a></div> 
            </div>


            <!-- <div class="clearfix"></div> -->
        </div>
    </section>
    <!-- Navbar Section Ends Here -->

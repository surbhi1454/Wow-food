<?php 
   include('../config/constants.php');
   include('login-check.php');  // authorization

?>

<html>
  <head>
     <title>Mirax Restaurant Website - Home Page</title>
     <link rel="stylesheet" href="../style/admin.css"/>
  </head>

  <body>
       <!-- Menu Section Starts -->
       <div class = "menu text-center">
          <div class = "wrapper">
          <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="manage-admin.php">Admin</a></li>
                <li><a href="manage-offer.php">Offer</a></li>
                <li><a href="manage-category.php">Category</a></li>
                <li><a href="manage-food.php">Food</a></li>
                <li><a href="manage-order.php">Order</a></li>
                <li><a href="logout.php">Logout</a></li>
                <li><a href="<?php echo SITEURL; ?>login.php">SignIn as Customer</a></li>
            </ul>
          </div>
       </div>
       <!-- Menu Section Ends -->
<?php include('partials-front/menu.php'); ?>
<!-- Navbar Section Ends Here -->

<!-- to show selected food -->
<?php
   if(isset($_GET['food_id'])){
           
       $food_id = $_GET['food_id'];

       $sql = "SELECT * FROM tbl_food WHERE id = $food_id";
       $res = mysqli_query($conn, $sql);

       $count = mysqli_num_rows($res);
       if($count == 1){
          $row = mysqli_fetch_assoc($res);

          $title = $row['title'];
          $price = $row['price'];
          $image_name = $row['image_name'];
       }
       else{
           //food not found for that id
           header('location:'.SITEURL);
       }

   } 
   else{
       header('location:'.SITEURL);
   }
?>
<!-- Food-Order Section starts Here -->
<section class="food-search">
    <div class="container">
        <h2 class = "text-white text-center">Fill this form to confirm your order.</h2>
        <form action="" method="POST" class="order">
            <fieldset>
                <legend>Selected Food</legend>
                <div class="food-menu-img">

                    <?php
                        //check if image available or not
                        if($image_name != ""){
                            ?>
                           <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                           <?php
                        }  
                        else{
                            echo "<div class='lerror'>Image Not Available.</div>";
                        }
                    ?>
                              
                </div>
                <div class="food-menu-desc">
                    <h3><?php echo $title; ?></h3>
                    <!-- adding this line to get value of title on submit -->
                    <input type="hidden" name="food" value="<?php echo $title; ?>"> 

                    <p class="food-price">Rs. <?php echo $price; ?></p>
                    <input type="hidden" name="price" value="<?php echo $price; ?>"> 

                    <div class="order-label">Quantity</div>
                    <input type="number" name="qty" class="input-responsive" value="1" required>

                </div>
            </fieldset>
            <fieldset>
                <legend>Delivery Details</legend>
                <div class="order-label">Full Name</div>
                <input type="text" name="full-name" class="input-responsive" required>

                <div class="order-label">Phone Number</div>
                <input type="tel" name="contact" class="input-responsive" required>

                <div class="order-label">Email</div>
                <input type="email" name="email" class="input-responsive" required>

                <div class="order-label">Address</div>
                <textarea name="address"  rows="10" placeholder="E.g street, city, country" class="input-responsive" required></textarea>

                <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
            </fieldset>
        </form>


        <!-- submit button click -->
          <?php

            if(isset($_POST['submit'])){

                //get values from form
                $food = $_POST['food'];
                $price = $_POST['price'];
                $qty = $_POST['qty'];
                $total = $price * $qty;
                $order_date = date("Y-m-d h:i:s:a");
                $status = "Ordered";   //4 options ordered, on delivery, delivered, cancelled..last 3 manage by admin
                $customer_name = $_POST['full-name'];
                $customer_contact = $_POST['contact'];
                $customer_email = $_POST['email'];
                $customer_address = $_POST['address'];


                //sql to insert data in DB
                $sql2 = "INSERT INTO tbl_order SET
                        food = '$food',
                        price = $price,
                        qty = $qty,
                        total = $total,
                        order_date = '$order_date',
                        status = '$status',
                        customer_name = '$customer_name',
                        customer_contact = '$customer_contact',
                        customer_email = '$customer_email',
                        customer_address = '$customer_address'
                ";
                $res2 = mysqli_query($conn, $sql2);

                if($res2 == TRUE){
                    $_SESSION['order'] = "<div class='success text-center'>Food Ordered Successfully.</div>";
                    header('location:'.SITEURL);
                }
                else{
                    $_SESSION['order'] = "<div class='error text-center'>Failed to order Food.</div>";
                    header('location:'.SITEURL);
                }
            }

          ?>
                  
    </div>
</section>
     <!-- Food-Order Section ends Here -->

     <!-- social Section starts Here -->
     
     <?php include('partials-front/footer.php'); ?>
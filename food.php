<?php include('partials-front/menu.php'); ?>


    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary" >
            </form>
          
        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->
     
    <!-- Food menu section Starts here -->

    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            
            <?php
 
              $sql = "SELECT * FROM tbl_food WHERE active = 'Yes'";
              $res = mysqli_query($conn, $sql);
              $count = mysqli_num_rows($res);

              if($count > 0){
                 while($row = mysqli_fetch_assoc($res)){
                     $id = $row['id'];
                     $title = $row['title'];
                     $price = $row['price'];
                     $description = $row['description'];
                     $image_name = $row['image_name'];

                     ?>
                        <div class="food-menu-box">
                            <div class="food-menu-img">

                            <?php
                               if($image_name != ""){
                                   ?>
                                     <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                                   <?php
                               }
                               else{
                                 echo "<div class='lerror'>No Image Available.</div>";
                               }
                            ?>
                                
                            </div>
            
                            <div class="food-menu-desc">
                                <h4><b><?php echo $title; ?></b></h4>
                                <p class="food-price">Rs <?php echo $price; ?></p>
                                <p class="food-price">Size: Medium</p>
                                <p class="food-detail"><?php echo $description; ?></p>
                                <br>
            
                                <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>

                     <?php
                 }
              }
              else{
                echo "<div class='lerror'>No Food Available.</div>";
              }

            ?>

            
            <div class="clearfix"></div>
        </div>
        
    </section>

    <!-- Food menu section ends here -->

    
    <?php include('partials-front/footer.php'); ?>
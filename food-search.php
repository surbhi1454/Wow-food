<?php include('partials-front/menu.php'); ?>


    <!-- Navbar Section Ends Here -->

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <?php
               //get search keyword
              //this is old method->  $search = $_POST['search'];
               //this is new method-> escapes special characters in a string for use in sql statement like burger"
                 $search = mysqli_real_escape_string($conn, $_POST['search']);
                 
            ?>
            <h1>Foods on your search <a href="#" class = "text-white">"<?php echo $search; ?>"</a></h1>
          
        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->
     
    <!-- Food menu section Starts here -->

    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            
            <?php
             
             $sql = "SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";
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
                echo "<div class='error'>No search result Found.</div>";
             }

            ?> 
            
            <div class="clearfix"></div>
        </div>
        
    </section>

    <!-- Food menu section ends here -->

    
    <?php include('partials-front/footer.php'); ?>
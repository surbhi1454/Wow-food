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

<?php
   if(isset($_SESSION['order'])){
       echo $_SESSION['order'];
       unset($_SESSION['order']);
   }
   if(isset($_SESSION['contact'])){
    echo $_SESSION['contact'];
    unset($_SESSION['contact']);
   }
   if(isset($_SESSION['login'])){
    echo $_SESSION['login'];
    unset($_SESSION['login']);
   }
?>

     <!-- Explore Offer Starts here -->

     <section class="offers">
        <h1 class = "text-center">Offers</h1>
         <div class="container">
             
             <div id = "myCarousel" class = "carousel slide" data-ride = "carousel">
                 <!-- INDICATORS -->
                 <ol class="carousel-indicators">
                 <?php
                    $sql3 = "SELECT * FROM tbl_offers";
                    $res3 = mysqli_query($conn, $sql3);

                    $count3 = mysqli_num_rows($res3);

                    if($count3 > 0){
                        $sn = 0;
                       while($sn < $count3){
                           if($sn == 0){
                               ?>
                                <li data-target = "#myCarousel" data-slide-to="<?php echo $sn; ?>" class="active"></li>
                               <?php
                           }
                           else{
                               ?>
                                <li data-target = "#myCarousel" data-slide-to="<?php echo $sn; ?>"></li>
                              <?php
                           }
                           $sn++;
                       }
                    }
                    else{
                        // no offer available
                    }

                 ?>
                 </ol>

                 <!-- Wrapper for slides -->
                 <div class="carousel-inner" role = "listbox">
                 <?php
                     if($count3 > 0){
                         $n = 1;
                        while($row3 = mysqli_fetch_assoc($res3)){
                            $offer_name = $row3['offer_name'];
                            $offer_image = $row3['image_name'];

                            if($n == 1){
                               ?>
                                <div class="carousel-item active ">
                                    <?php
                                        if($offer_image != ""){
                                            ?>
                                              <img src="<?php echo SITEURL; ?>images/offer/<?php echo $offer_image; ?>" alt="" style="width:100%;" class = "img-responsive img-curve">
                                            <?php
                                        }
                                        else{
                                              //image not available
                                        }
                                    ?>
                                      
                                </div>
                               <?php
                            }
                            else{
                                ?>
                                <div class="carousel-item">
                                <?php
                                        if($offer_image != ""){
                                          ?>
                                            <img src="<?php echo SITEURL; ?>images/offer/<?php echo $offer_image; ?>" alt="" style="width:100%;" class = "img-responsive img-curve">
                                          <?php
                                          }
                                        else{
                                              //image not available
                                        }
                                       ?>
                                </div>

                                <?php
                            }
                            $n++;

                        }
                     }
                     else{
                         // no offer available
                     }
                 ?>
                 </div>

                 <!-- Left and right controls -->
                 <a class="carousel-control-prev" href="#myCarousel" data-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                  </a>
                  <a class="carousel-control-next" href="#myCarousel" data-slide="next">
                    <span class="carousel-control-next-icon"></span>
                  </a>
             </div>
         </div>
     </section>
      
     <!-- Explore Offer Ends here -->
     
    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
 
            <?php
               //sql to display catgeories
               $sql = "SELECT * FROM tbl_category WHERE featured = 'Yes' AND active = 'Yes' LIMIT 3";
               $res = mysqli_query($conn, $sql);

               $count = mysqli_num_rows($res);
               if($count > 0){
                   while($row = mysqli_fetch_assoc($res)){
                       $id = $row['id'];
                       $title = $row['title'];
                       $image_name = $row['image_name'];

                       ?>
                         <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                            <div class="box-3 float-container">
                                <?php
                                //    <!-- check if image avaiable or not -->
                                   if($image_name != ""){
                                      ?>
                                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve" height="300px">
                                      <?php
                                   }
                                   else{
                                    echo "<div class='lerror'>No Image Available.</div>"; 
                                   }

                                ?>
                                
                                <h3 class="float-text text-white"><?php echo $title; ?></h3>
                            </div>
                            </a>
 
                       <?php
                   }
               }
               else{
                   echo "<div class='lerror'>No Category Added.</div>";
               }
            ?>
            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->
    <!-- Food menu section Starts here -->

    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            
            <?php

              //to show food menu
              $sql2 = "SELECT * FROM tbl_food WHERE featured = 'Yes' AND active = 'Yes' LIMIT 6";
              $res2 = mysqli_query($conn, $sql2);
              $count2 = mysqli_num_rows($res2);

              if($count2 > 0){
                 while($row2 = mysqli_fetch_assoc($res2)){
                     $id = $row2['id'];
                     $title = $row2['title'];
                     $price = $row2['price'];
                     $description = $row2['description'];
                     $image_name = $row2['image_name'];

                     ?>
                      <div class="food-menu-box">
                        <div class="food-menu-img">

                            <?php
                              //check image available
                              if($image_name != ""){
                                 ?>
                                   <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve" height="150px">
                                 <?php
                              }
                              else{
                                echo "<div class='lerror'>Image not Available.</div>";
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
        <p class="text-center">
            <a href="<?php echo SITEURL; ?>food.php"> See All Foods</a>
        </p>
    </section>

    <!-- Food menu section ends here -->
    
    <?php include('partials-front/footer.php'); ?>
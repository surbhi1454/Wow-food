<?php include('partials-front/menu.php'); ?>


<!-- to display foods of passed category id -->
<?php
    
    if(isset($_GET['category_id'])){

        $category_id = $_GET['category_id'];

        //get category title 
        $sql = "SELECT title FROM tbl_category WHERE id = $category_id";
        $res = mysqli_query($conn, $sql);

        //get value from DB
        $row = mysqli_fetch_assoc($res);

        $category_title = $row['title'];
    }
    else{
        header('location:'.SITEURL);
    }
?>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>
          
        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->
     
    <!-- Food menu section Starts here -->

    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            
            <?php

               $sql2 = "SELECT * FROM tbl_food WHERE category_id = $category_id";
               $res2 = mysqli_query($conn, $sql2);

               $count = mysqli_num_rows($res2);
               if($count > 0){
                  
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
            
                                <a href="order.html" class="btn btn-primary">Order Now</a>
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
        </div>
        <p class="text-center">
            <a href="category.html"> See All Foods</a>
        </p>
    </section>

    <!-- Food menu section ends here -->

    
    <?php include('partials-front/footer.php'); ?>
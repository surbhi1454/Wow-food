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
     
    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
            
            <?php
             
             //display all categories that are active
             $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
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
                                //check if image available or not
                                if($image_name != ""){
                                   ?>
                                     <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve" height="300px">
                                   <?php
                                }
                                else{
                                    echo "<div class='lerror'>Image Not Available.</div>";
                                }
                             ?>
                             
             
                             <h3 class="float-text text-white"><?php echo $title; ?></h3>
                         </div>
                        </a>
                    <?php
                }
             }
             else{
                 echo "<div class='lerror'>No Category Available.</div>";
             }

            ?>
            
            
           
            <div class="clearfix"></div>
        </div>
        
    </section>
    <!-- Categories Section Ends Here -->
    
    <?php include('partials-front/footer.php'); ?>
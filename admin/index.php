<?php include('partials/menu.php'); ?>
       
       <!-- Main Content Starts -->
       <div class = "main-content">
          <div class = "wrapper">
            <h1>Dashboard</h1>
            <br/><br/>
            <?php 
              if(isset($_SESSION['login'])){
                  echo $_SESSION['login'];
                  unset($_SESSION['login']);
              }
            
            ?> <br/><br/>
            <div class="col-4 text-center">
                <?php
                   //sql query to get total categories
                   $sql = "SELECT * FROM tbl_category";
                   $res = mysqli_query($conn, $sql);

                   $count = mysqli_num_rows($res);
                ?>
                <h1><?php echo $count; ?></h1> <br />
                Categories
            </div> 

            <div class="col-4 text-center">
                <?php
                   //sql query to get total food
                   $sql2 = "SELECT * FROM tbl_food";
                   $res2 = mysqli_query($conn, $sql2);

                   $count2 = mysqli_num_rows($res2);
                ?>
                <h1><?php echo $count2; ?></h1> <br />
                Foods
            </div> 

            <div class="col-4 text-center">
                <?php
                   //sql query to get total orders
                   $sql3 = "SELECT * FROM tbl_order";
                   $res3 = mysqli_query($conn, $sql3);

                   $count3 = mysqli_num_rows($res3);
                ?>
                <h1><?php echo $count3; ?></h1> <br />
                Total Orders
            </div> 

            <div class="col-4 text-center">
                <?php
                   //sql query to check if delivered order is avilable or not
                   $sql4 = "SELECT * FROM tbl_order WHERE status = 'Delivered'";
                   $res4 = mysqli_query($conn, $sql4);

                   $count4 = mysqli_num_rows($res4);
                   if($count4 == 0){
                       //if delivered order not available then 
                       $total_revenue = 0;
                   }
                   else{
                       // delivered order is available so total it
                    $sql5 = "SELECT SUM(total) AS Total FROM tbl_order WHERE status = 'Delivered'";
                    $res5 = mysqli_query($conn, $sql5);
                    
                     $row = mysqli_fetch_assoc($res5);
                     $total_revenue = $row['Total'];
                   }
                    
                ?>
                <h1>Rs. <?php echo $total_revenue; ?></h1> <br />
                Revenue Generated
            </div> 
            
            <div class="clearfix"></div>

          </div>
       </div>
       <!-- Main Content Ends -->
       
<?php include('partials/footer.php'); ?>
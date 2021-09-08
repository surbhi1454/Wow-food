<?php include('partials/menu.php'); ?>
       
       <!-- Main Content Starts -->
       <div class = "main-content">
          <div class = "wrapper">
            <h1>Manage Category</h1>
            <br/><br/>
            

            <!-- show session msgs -->
            <?php
              
              if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
              }
              if(isset($_SESSION['remove'])){
                echo $_SESSION['remove'];
                unset($_SESSION['remove']);
              }
              if(isset($_SESSION['delete'])){
                  echo $_SESSION['delete'];
                 unset($_SESSION['delete']);
              }
              if(isset($_SESSION['no-category-found'])){
                echo $_SESSION['no-category-found'];
                unset($_SESSION['no-category-found']);
              }
              if(isset( $_SESSION['update'])){
                echo  $_SESSION['update'];
                unset( $_SESSION['update']);
              }
              if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
              }
              if(isset($_SESSION['failed-remove'])){
                echo $_SESSION['failed-remove'];
                unset($_SESSION['failed-remove']);
              }
              
            ?>
            <br/><br/>
            <!-- Button to add admin -->
            <a href="<?php echo SITEURL; ?>admin/add-category.php" class = "btn-primary">Add Category</a>
            <br/><br/><br/>


            <table class="tbl-full">
              <tr>
                <th>S.N</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
              </tr>
              
              <?php
                 
                 $sql = "SELECT * FROM tbl_category";
                 $res = mysqli_query($conn, $sql);

                 if($res == TRUE){
                   $count = mysqli_num_rows($res);
                   $sn = 1;
                   if($count > 0){
                      while($rows = mysqli_fetch_assoc($res)){
                        $id = $rows['id'];
                        $title = $rows['title'];
                        $image_name = $rows['image_name'];
                        $featured = $rows['featured'];
                        $active = $rows['active'];

                        // display values in table
                        ?>
                          <tr>
                             <td><?php echo $sn++; ?>.</td>
                             <td><?php echo $title; ?></td>
                             <td>
                               <?php 
                                   if($image_name == ""){
                                       echo "<div class='lerror'>Image Not Added.</div>";
                                   }
                                   else{
                                      ?>
                                      <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="70px">

                                      <?php
                                   }
                               ?>
                             </td>
                             <td><?php echo $featured; ?></td>
                             <td><?php echo $active; ?></td>
                             <td>
                               <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class = "btn-secondary btn-size">Update Category</a>
                               <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class = "btn-danger btn-size">Delete Category</a>
                                    <!-- here we r passing image name along with id to delete image from image folder also -->
                              </td>
                          </tr>

                        <?php

                 
                      }
                   }
                   else{
                     // have no data
                      ?>
                       <tr>
                         <td colspan="6"><div class="error">No Category Added.</div></td>
                       </tr>
                      <?php
                   }
                  }

              ?> 
            </table>

          </div>
       </div>
       <!-- Main Content Ends -->

<?php include('partials/footer.php'); ?>

<br/><br/><br/><br/>
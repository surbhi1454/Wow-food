<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Offers</h1>
        <br/><br/>

        <!-- show session msgs -->
        <?php
              
              if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
              }
              if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
              }
              if(isset($_SESSION['remove'])){
                echo $_SESSION['remove'];
                unset($_SESSION['remove']);
              }
              if(isset($_SESSION['delete'])){
                  echo $_SESSION['delete'];
                 unset($_SESSION['delete']);
              }
              if(isset($_SESSION['no-offer-found'])){
                echo $_SESSION['no-offer-found'];
                unset($_SESSION['no-offer-found']);
              }
              if(isset( $_SESSION['update'])){
                echo  $_SESSION['update'];
                unset( $_SESSION['update']);
              }
              if(isset($_SESSION['failed-remove'])){
                echo $_SESSION['failed-remove'];
                unset($_SESSION['failed-remove']);
              }
        ?>
        <br/><br/>

        <!-- Button to add offer -->
        <a href="<?php echo SITEURL; ?>admin/add-offer.php" class = "btn-primary">Add Offer</a>
            <br/><br/><br/>
        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Offer Name</th>
                <th>Image</th>
                <th>Actions</th>
            </tr> 
            
            <?php
               $sql = "SELECT * FROM tbl_offers";
               $res = mysqli_query($conn, $sql);

               $count = mysqli_num_rows($res);
               $sn = 1;

               if($count > 0){
                  while($row = mysqli_fetch_assoc($res)){
                      $id = $row['id'];
                      $offer_name = $row['offer_name'];
                      $image_name = $row['image_name'];

                      ?>
                        <tr>
                          <td><?php echo $sn++; ?>.</td>
                          <td><?php echo $offer_name; ?></td>
                          <td>
                              <?php
                                if($image_name != ""){
                                    ?>
                                      <img src="<?php echo SITEURL;?>images/offer/<?php echo $image_name; ?>" width="200px">
                                    <?php
                                }
                                else{
                                    echo "<div class='lerror'>Image Not Added.</div>";
                                }
                              ?>
                          </td>
                          <td>
                              <a href="<?php echo SITEURL; ?>admin/update-offer.php?id=<?php echo $id; ?>" class="btn-secondary">Update Offer</a>
                              <a href="<?php echo SITEURL; ?>admin/delete-offer.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Offer</a>
                          </td>
                        </tr>
                      <?php
                  }
               }
               else{
                   echo "<tr><td class='lerror'>No Offer Added.</td></tr>";
               }
            ?>
            
        </table>
        
    </div>
</div>



<?php include('partials/footer.php'); ?>
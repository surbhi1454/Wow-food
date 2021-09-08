<?php include('partials/menu.php'); ?>
       
       <!-- Main Content Starts -->
       <div class = "main-content">
          <div class = "wrapper">
            <h1>Manage Admin</h1>
            <br/>


            <!-- display session message -->

            <?php 
            // Add admin msg display

            if(isset($_SESSION['add'])){ // checking session set or not
              echo $_SESSION['add']; // display session msg
              unset($_SESSION['add']); // removing session msg
            }
            // delete admin msg display
            if(isset($_SESSION['delete'])){
              echo $_SESSION['delete'];  
              unset($_SESSION['delete']);
            }
            // update admin msg display
            if(isset($_SESSION['update'])){
              echo $_SESSION['update'];
              unset($_SESSION['update']);
            }
            // change pwd user not found
            if(isset($_SESSION['user-not-found'])){
              echo $_SESSION['user-not-found'];
              unset($_SESSION['user-not-found']);
            }
            // change pwd new nd confrm not match
            if(isset($_SESSION['pwd-not-match'])){
              echo $_SESSION['pwd-not-match'];
              unset($_SESSION['pwd-not-match']);
            }
            // change pwd 
            if(isset($_SESSION['change-pwd'])){
              echo $_SESSION['change-pwd'];
              unset($_SESSION['change-pwd']);
            }
            ?>
            <br/><br/>

            <!-- Button to add admin -->
            <a href="add-admin.php" class = "btn-primary">Add Admin</a>
            <br/><br/><br/>
            <table class="tbl-full">
              <tr>
                <th>S.N</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
              </tr>
              
              <?php 
                  // query to get all admin
                  $sql = "SELECT * FROM tbl_admin";
                  // execute query
                  $res = mysqli_query($conn, $sql);

                  //check whether is executed or not
                  if($res == TRUE){

                    //count rows to check whether we have data in database or not
                    $count = mysqli_num_rows($res);
                    $sn = 1; // for serial no.
                    // check no of rows
                    if($count > 0){
                       // we have data in DB
                       while($rows = mysqli_fetch_assoc($res)){  // get all rows nd store in $rows
                          //get individual data
                          
                          $id = $rows['id'];
                          $full_name = $rows['full_name'];
                          $username = $rows['userName'];

                          // display values in table
                          ?>

                              <tr>
                                 <td><?php echo $sn++; ?>.</td>
                                 <td><?php echo $full_name; ?></td>
                                 <td><?php echo $username; ?></td>
                                 <td>
                                   <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary btn-size">Change Password</a>
                                   <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class = "btn-secondary btn-size">Update Admin</a>
                                   <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class = "btn-danger btn-size">Delete Admin</a>
                                 </td>
                              </tr>
                         <?php
                       }
                    } 
                    else{

                    }
                  }
              ?>
            </table>

          </div>
       </div>
       <!-- Main Content Ends -->

<?php include('partials/footer.php'); ?>
<br/><br/>
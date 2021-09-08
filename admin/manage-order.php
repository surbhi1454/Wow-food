<?php include('partials/menu.php'); ?>
       
       <!-- Main Content Starts -->
       <div class = "main-content">
          <div class = "wrapper">
            <h1>Manage Order</h1>
            
            <br/><br/>

            <?php
              if(isset($_SESSION['update'])){
                echo $_SESSION['update'];
                unset($_SESSION['update']);
              }
            ?>
            <br/><br/>
            <table class="tbl-full size">
              <tr>
                <th>S.N</th>
                <th>Food</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Total</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Customer Name</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Address</th>
                <th>Actions</th>
              </tr>
              
              <?php
                
                 $sql = "SELECT * FROM tbl_order ORDER BY id DESC"; //using order by to show latest order at top
                 $res = mysqli_query($conn, $sql);
                 $count = mysqli_num_rows($res);

                 $sn = 1;
                 if($count > 0){

                  while($row = mysqli_fetch_assoc($res)){
                    $id = $row['id'];
                    $food = $row['food'];
                    $price = $row['price'];
                    $qty = $row['qty'];
                    $total = $row['total'];
                    $order_date = $row['order_date'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $contact = $row['customer_contact'];
                    $email = $row['customer_email'];
                    $address = $row['customer_address'];

                    ?>
                    <tr>
                      <td><?php echo $sn++;?>.</td>
                      <td><?php echo $food;?></td>
                      <td><?php echo $price;?></td>
                      <td><?php echo $qty;?></td>
                      <td><?php echo $total;?></td>
                      <td><?php echo $order_date;?></td>

                      <!-- change color of status -->
                      <td>
                        <?php
                            if($status == "Ordered"){
                              echo "<label  style='color: blue;'>$status</label>";
                            }
                            elseif($status == "On Delivery"){
                              echo "<label style='color: orange;'>$status</label>";
                            }
                            elseif($status == "Delivered"){
                              echo "<label style='color: lightgreen;'>$status</label>";
                            }
                            elseif($status == "Cancelled"){
                              echo "<label style='color: red;'>$status</label>";
                            }
                            
                        ?>
                      </td>


                      <td><?php echo $customer_name;?></td>
                      <td><?php echo $contact;?></td>
                      <td><?php echo $email;?></td>
                      <td><?php echo $address;?></td>
                      
                      <td>
                        <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class = "btn-secondary">Update Order</a>
                      </td>
                    </tr>

                    <?php
                    
                  }
                 }
                 else{
                   echo "<tr><td colspan='12' class='lerror'>Orders Not Available.</td></tr>";
                 }

              ?>
              
            
            </table>

          </div>
       </div>
       <!-- Main Content Ends -->

<?php include('partials/footer.php'); ?>
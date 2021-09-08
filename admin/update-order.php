<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Upadte Order</h1>
        <br/><br/>
        
        <?php
           
           //check id set or not
           if(isset($_GET['id'])){
              
             $id = $_GET['id'];

             $sql = "SELECT * FROM tbl_order WHERE id = $id";
             $res = mysqli_query($conn, $sql);
             $count = mysqli_num_rows($res);

             if($count == 1){
                 $row = mysqli_fetch_assoc($res);

                 $food = $row['food'];
                 $price = $row['price'];
                 $qty = $row['qty'];
                 $status = $row['status'];
                 $customer_name = $row['customer_name'];
                 $contact = $row['customer_contact'];
                 $email = $row['customer_email'];
                 $address = $row['customer_address'];
             }
             else{
                 //id not exist
                //  $_SESSION['no-order-found'] = "<div class='lerror'>Order Not Found</div>";
                 header('location:'.SITEURL.'admin/manage-order.php');
             }
           }
           else{
               //no id is passed
               header('location:'.SITEURL.'admin/manage-order.php');
           }
        ?>
        <form action="" method="POST">
            <table class="tbl-50">
                <tr>
                    <td>Food Name: </td>
                    <td><h3><?php echo $food; ?></h3></td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td><h3>Rs. <?php echo $price; ?></h3></td>
                </tr>
                <tr>
                    <td>Qty: </td>
                    <td><input type="number" name="qty" value="<?php echo $qty; ?>"></td>
                </tr>
                <tr>
                    <td>Status: </td>
                    <td>
                        <select name="status">
                            <option <?php if($status == "Ordered"){echo "selected";} ?>  value="Ordered">Ordered</option>
                            <option <?php if($status == "On Delivery"){echo "selected";} ?>  value="On Delivery">On Delivery</option>
                            <option <?php if($status == "Delivered"){echo "selected";} ?>  value="Delivered">Delivered</option>
                            <option <?php if($status == "Cancelled"){echo "selected";} ?>  value="Cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Customer Name: </td>
                    <td><input type="text" name="customer_name" value="<?php echo $customer_name; ?>"></td>
                </tr>
                <tr>
                    <td>Customer Contact: </td>
                    <td><input type="text" name="customer_contact" value="<?php echo $contact; ?>"></td>
                </tr>
                <tr>
                    <td>Customer Email: </td>
                    <td><input type="text" name="customer_email" value="<?php echo $email; ?>"></td>
                </tr>
                <tr>
                    <td>Customer Address: </td>
                    <td><textarea name="customer_address" cols="22" rows="5"><?php echo $address; ?></textarea></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <!-- hidden price to calculate total -->
                        <input type="hidden" name="price" value="<?php echo $price; ?>"> 
                        <input type="submit" name="submit" value="Update Order" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
          
          if(isset($_POST['submit'])){
              
            //get all values from form
            $id = $_POST['id'];
            $price = $_POST['price'];
            $qty = $_POST['qty'];

            $total = $price * $qty;

            $status = $_POST['status'];

            $customer_name = $_POST['customer_name'];
            $contact = $_POST['customer_contact'];
            $email = $_POST['customer_email'];
            $address = $_POST['customer_address'];

            $sql2 = "UPDATE tbl_order SET
                     qty = $qty,
                     total = $total,
                     status = '$status',
                     customer_name = '$customer_name',
                     customer_contact = '$contact',
                     customer_email = '$email',
                     customer_address = '$address'
                     WHERE id = $id
            ";
            $res2 = mysqli_query($conn, $sql2);

            if($res2 == TRUE){
                $_SESSION['update'] = "<div class='success'>Order Updated Successfully.</div>";
                header('location:'.SITEURL.'admin/manage-order.php');
            }
            else{
                $_SESSION['update'] = "<div class='lerror'>Failed to Update Order.</div>";
                header('location:'.SITEURL.'admin/manage-order.php');
            }

          }
        ?>
    </div>
</div>



<?php include('partials/footer.php'); ?>
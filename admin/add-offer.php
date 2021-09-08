<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Offer</h1>
        <br/><br/>

        <form action="" method="POST" enctype="multipart/form-data"> 
            <table class="tbl-50">
                <tr>
                    <td>Offer Name: </td>
                    <td><input type="text" name="offer_name"></td>
                </tr>
                <tr>
                    <td>Select Image: </td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Offer" class="btn-secondary"></td>
                </tr>
            </table>
        </form>

        <?php
           if(isset($_POST['submit'])){

            $offer_name = $_POST['offer_name'];

            if(isset($_FILES['image']['name'])){
                // upload image
                // we need image name, src path, dest path
                $image_name = $_FILES['image']['name'];
               
                if($image_name != ""){
                   // rename image
                   
                   //get extension of image to rename i.e jpg, png etc using end function below
                   $ext = end(explode('.',$image_name));
                   // now rename
                   $image_name = "Offer_".rand(000, 999).'.'.$ext;
  
  
  
                   $source_path = $_FILES['image']['tmp_name'];
                   $destination_path = "../images/offer/".$image_name;
  
                   // finally upload
                   $upload = move_uploaded_file($source_path, $destination_path);
  
                   // check whether image upload or not
                   // if image not uploaded then stop process nd redirect with error msg
                   if($upload == FALSE){
                       $_SESSION['upload'] = "<div class='error'>Failed to Upload Image</div>";
                       header('location:'.SITEURL.'admin/add-category.php');
  
                       // stop process
                       die();
                   }
               }
            }
            else{
                // dont upload
                $image_name = "";
            }

            //2.sql query
            $sql = "INSERT INTO tbl_offers SET
                    offer_name = '$offer_name', 
                    image_name = '$image_name'
                     ";
           
           $res = mysqli_query($conn, $sql);
           if($res == TRUE){
                $_SESSION['add'] = "<div class='success'>Offer Added Successfully.</div>";
                header('location:'.SITEURL.'admin/manage-offer.php');
           }
           else{
               $_SESSION['add'] = "<div class='error'>Failed to Add Offer.</div>";
               header('location:'.SITEURL.'admin/manage-offer.php');
           }

           }
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>
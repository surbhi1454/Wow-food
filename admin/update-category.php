<?php include('partials/menu.php'); ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>

        <br/><br/>

        <?php
            // check id set or not
            if(isset($_GET['id'])){
                //get id
               $id = $_GET['id'];
               $sql = "SELECT * FROM tbl_category WHERE id=$id";
               $res = mysqli_query($conn, $sql);

               $count = mysqli_num_rows($res);
               if($count == 1){

                 $row = mysqli_fetch_assoc($res);
                 $title = $row['title'];
                 $current_image = $row['image_name'];
                 $featured = $row['featured'];
                 $active = $row['active'];

               }
               else{
                   //id not exist
                   $_SESSION['no-category-found'] = "<div class='lerror'>Category Not Found</div>";
                  header('location:'.SITEURL.'admin/manage-category.php');
               }
            }
            else{
                //no id is passed
                header('location:'.SITEURL.'admin/manage-category.php');
            }
        ?>
        
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td><input type="text" name="title" value="<?php echo $title; ?>"></td>
                </tr>
                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                             if($current_image != ""){
                                 ?>

                                 <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="100px">
                                 <?php
                             }
                             else{
                                 echo "<div class='lerror'>Image Not Added.</div>";
                             }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image: </td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes
                        <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes"> Yes
                        <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
            
           if(isset($_POST['submit'])){
               
              //1.get values from form
              $id = $_POST['id'];
              $title = $_POST['title'];
              $current_image = $_POST['current_image'];
              $featured = $_POST['featured'];
              $active = $_POST['active'];

              //2.updating image if selected
              //check image selected or not
              if(isset($_FILES['image']['name'])){

                 //get image details
                 $image_name = $_FILES['image']['name'];

                 // check image available
                 if($image_name != ""){
                     //A.upload new image

                     //get extension of image to rename i.e jpg, png etc using end function below
                    $ext = end(explode('.',$image_name));
                    // now rename
                    $image_name = "Food_Category_".rand(000, 999).'.'.$ext;
   
   
   
                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../images/category/".$image_name;
   
                    // finally upload
                    $upload = move_uploaded_file($source_path, $destination_path);
   
                    // check whether image upload or not
                    // if image not uploaded then stop process nd redirect with error msg
                    if($upload == FALSE){
                        $_SESSION['upload'] = "<div class='lerror'>Failed to Upload Image</div>";
                        header('location:'.SITEURL.'admin/manage-category.php');
   
                        // stop process
                        die();
                    }
                     //B.remove current image if available
                      
                     if($current_image != ""){
                          
                        $remove_path = "../images/category/".$current_image;
                        $remove = unlink($remove_path);
  
                        //check image removed or not
                        //if failed to remove then display msg nd stop process
                        if($remove == false){
                            $_SESSION['failed-remove'] = "<div class='lerror'>Failed to Remove Current Image.</div>";
                            header('location:'.SITEURL.'admin/manage-category.php');
                            die(); // stop process
                        }
                     }
                      
                      
                 }
                 else{
                     // we have clicked select file but not selected any image instead we have clicked cancel button
                     // image not available
                    $image_name = $current_image;
                 }
              }
              else{
                  $image_name = $current_image;
              }

              //3.updata database
              $sql2 = "UPDATE tbl_category SET
                        title = '$title',
                        image_name = '$image_name',
                        featured = '$featured',
                        active = '$active'
                        WHERE id = $id
              ";
              $res2 = mysqli_query($conn, $sql2);

              //4.redirect to manage category page with msg
              if($res2 == TRUE){
                  $_SESSION['update'] = "<div class='success'>Category Updated Successfully.</div>";
                  header('location:'.SITEURL.'admin/manage-category.php');
              }
              else{
                $_SESSION['update'] = "<div class='lerror'>Failed to Update Category.</div>";
                header('location:'.SITEURL.'admin/manage-category.php');
              }
           }

        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>
<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
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
            ?>
            <br/><br/>
        
        <!-- Add category starts here -->
        <!-- enctype for upload image -->
        <form action="" method="POST" enctype="multipart/form-data"> 
            <table class="tbl-50">
                <tr>
                    <td>Title: </td>
                    <td><input type="text" name="title"></td>
                </tr>
                <tr>
                    <td>Select Image: </td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary"></td>
                </tr>
            </table>
        </form>
        <!-- Add category ends here -->

        <!-- display data in table -->
        <?php
          
          if(isset($_POST['submit'])){
              
              //1. get data from form
              $title = $_POST['title'];

              if(isset($_POST['featured'])){
                 $featured = $_POST['featured'];
              }
              else{
                $featured = "No";
              }
              if(isset($_POST['active'])){
                $active = $_POST['active'];
             }
             else{
                $active = "No";
             }
             // check image selected or not nd set image name accordingly
             //print_r($_FILES['image']); // to get information about chosen image file 
             // i.e name, src path
             //die();  // to break code here

             if(isset($_FILES['image']['name'])){
                 // upload image
                 // we need image name, src path, dest path
                 $image_name = $_FILES['image']['name'];
                
                 if($image_name != ""){
                    // rename image
                    
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
             $sql = "INSERT INTO tbl_category SET
                     title = '$title', 
                     image_name = '$image_name',
                     featured = '$featured', 
                     active = '$active'
                      ";
            $res = mysqli_query($conn, $sql);
            if($res == TRUE){
                 $_SESSION['add'] = "<div class='success'>Category Added Successfully.</div>";
                 header('location:'.SITEURL.'admin/manage-category.php');
            }
            else{
                $_SESSION['add'] = "<div class='error'>Failed to Add category.</div>";
                header('location:'.SITEURL.'admin/add-category.php');
            }
          }

       ?>
    </div>
</div>





<?php include('partials/footer.php'); ?>
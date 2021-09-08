<?php include('partials/menu.php'); ?>

<?php
      //check id set or not
      if(isset($_GET['id'])){

          $id = $_GET['id'];

          //sql to get selected food
          $sql2 = "SELECT * FROM tbl_food WHERE id = $id";
          $res2 = mysqli_query($conn, $sql2);

          $row2 = mysqli_fetch_assoc($res2);

          $title = $row2['title'];
          $description = $row2['description'];
          $price = $row2['price'];
          $current_image = $row2['image_name'];
          $current_category = $row2['category_id'];
          $featured = $row2['featured'];
          $active = $row2['active'];

      }
      else{
          header('location:'.SITEURL.'admin/manage-food.php');
      }
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br/><br/>

        <form action=""method="POST" enctype="multipart/form-data">
          
          <table class="tbl-30">
              <tr>
                  <td>Title: </td>
                  <td><input type="text" name="title" value="<?php echo $title; ?>"></td>
              </tr>
              <tr>
                  <td>Description: </td>
                  <td><textarea name="description" cols="22" rows="5"><?php echo $description; ?></textarea></td>
              </tr>
              <tr>
                  <td>Price: </td>
                  <td><input type="number" name="price" value="<?php echo $price; ?>"></td>
              </tr>
              <tr>
                  <td>Current Image: </td>
                  <td>
                     <?php
                         if($current_image != ""){
                             ?>
                               <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width="70px">
                             <?php
                         }
                         else{
                             echo "<div class='lerror'>Image Not Available.</div>";
                         }
                     ?>
                  </td>
              </tr>
              <tr>
                  <td>Category: </td>
                  <td>
                  <select name="category">   
                         <!-- Select categories from category page -->
                           <?php
                            $sql = "SELECT * FROM tbl_category WHERE active = 'Yes'";
                            $res = mysqli_query($conn, $sql);
  
                            $count = mysqli_num_rows($res);
                            if($count > 0){
                               while($row = mysqli_fetch_assoc($res)){
                                   $category_id = $row['id'];
                                   $category_title = $row['title'];

                                   ?>
                                    <option <?php if($current_category==$category_id){echo "selected";} ?>  value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                   <?php
                               }
                            }
                            else{
                                ?>
                                <option value="0">No Category Food</option>
                                <?php
                            }

                          ?> 

                        </select>
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
                      <input type="hidden" name="id" value="<?php echo $id; ?>">
                      <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">

                      <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                  </td>
              </tr>
          </table>      

        </form>
         
        <!-- to save updated values in DB -->
        <?php
          
           if(isset($_POST['submit'])){

               //1.get all data from form
               $id = $_POST['id']; 
               $title = $_POST['title'];
               $description = $_POST['description'];
               $price = $_POST['price'];
               $current_image = $_POST['current_image'];
               $category = $_POST['category'];
               $featured = $_POST['featured'];
               $active = $_POST['active'];

               //2.upload image if selected
                  //check upload button clicked or not
                  if(isset($_FILES['image']['name'])){
                     
                    $image_name = $_FILES['image']['name'];
                    if($image_name != ""){
                       
                        $ext = end(explode('.',$image_name));
                        $image_name = "Food_Name_".rand(000, 999).'.'.$ext;

                        $src = $_FILES['image']['tmp_name'];
                        $dest = "../images/food/".$image_name;

                        $upload = move_uploaded_file($src, $dest);

                        if($upload == false){
                            $_SESSION['upload'] = "<div class='lerror'>Failed to Upload Image</div>";
                            header('location:'.SITEURL.'admin/manage-food.php');
   
                            // stop process
                            die();
                        }
                        if($current_image != ""){
                          
                            $remove_path = "../images/category/".$current_image;
                            $remove = unlink($remove_path);
      
                            //check image removed or not
                            //if failed to remove then display msg nd stop process
                            if($remove == false){
                                $_SESSION['failed-remove'] = "<div class='lerror'>Failed to Remove Current Image.</div>";
                                header('location:'.SITEURL.'admin/manage-food.php');
                                die(); // stop process
                            }
                         }
                    }
                    else{
                        $image_name = $current_image;
                    }
                    //3.remove current image if available
                    
                }
                  else{
                      $image_name = $current_image;
                  }

               
               //4.update DB
               $sql3 = "UPDATE tbl_food SET
                        title = '$title',
                        description = '$description',
                        price = $price,
                        image_name = '$image_name',
                        category_id = '$category',
                        featured = '$featured',
                        active = '$active'
                        WHERE id = $id
               ";

               $res3 = mysqli_query($conn, $sql3);
               if($res3 == TRUE){
                $_SESSION['update'] = "<div class='success'>Food Updated Successfully.</div>";
                 header('location:'.SITEURL.'admin/manage-food.php');
               }
               else{
                $_SESSION['update'] = "<div class='lerror'>Failed to Update Food.</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
               }
            // 

           }

        ?>
    </div>
</div>


<?php include('partials/footer.php'); ?>
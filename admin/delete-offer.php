<?php
   
   include('../config/constants.php');
 
   //check id nd image name set or not
   if(isset($_GET['id']) AND isset($_GET['image_name'])){
         $id = $_GET['id'];
         $image_name = $_GET['image_name'];


         //1. remove image file if available
         if($image_name != ""){
             $path = "../images/offer/".$image_name;
             $remove = unlink($path);  // remove image
             
             if($remove == FALSE){
                 $_SESSION['remove'] = "<div class='lerror'>Failed to remove Offer Image.</div>";
                 header('location:'.SITEURL.'admin/manage-offer.php');
                 die();
             }

         }
         //2. delete data from DB
         $sql = "DELETE FROM tbl_offers WHERE id = $id";
         $res = mysqli_query($conn, $sql);
         if($res == TRUE){
            $_SESSION['delete'] = "<div class='success'>Offer Deleted Sucessfully.</div>";
            header('location:'.SITEURL.'admin/manage-offer.php');
         }
         else{
            $_SESSION['delete'] = "<div class='lerror'>Failed to Delete Offer.</div>";
            header('location:'.SITEURL.'admin/manage-offer.php');
         }
   } 
   else{
       header('location:'.SITEURL.'admin/manage-offer.php');
   }



?>
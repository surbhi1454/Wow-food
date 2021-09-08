<?php include('partials-front/menu.php'); ?>

<section class="food-search">
    <div class="container">
    <h2 class = "text-white text-center">Fill this form to Contact.</h2>
    <form action="" method="POST" class="order">
        <fieldset>
            <legend>Contact Details: </legend>

            <div class="order-label">Full Name</div>
            <input type="text" name="name" class="input-responsive" required>

            <div class="order-label">Phone Number</div>
            <input type="tel" name="contact" class="input-responsive" required>

            <div class="order-label">Email</div>
            <input type="email" name="email" class="input-responsive" required>

            <div class="order-label">Comments</div>
            <textarea name="comment"  rows="10" placeholder="Add Comments Here..." class="input-responsive" required></textarea>
            
            <input type="submit" name="submit" value="Submit" class="btn btn-primary">
            
        </fieldset>
    </form>

    <?php
         if(isset($_POST['submit'])){
             
            //get values from form
            $name = $_POST['name'];
            $contact = $_POST['contact'];
            $email = $_POST['email'];
            $comment = $_POST['comment'];

            //sql query to insert in DB
            $sql = "INSERT INTO contact SET
                    name = '$name',
                    contact = '$contact',
                    email = '$email',
                    comment = '$comment'
            ";
            $res = mysqli_query($conn, $sql);

            if($res == TRUE){
                $_SESSION['contact'] = "<div class='success text-center'>Contacted Successfully.</div>";
                header('location:'.SITEURL);
            }
            else{
                $_SESSION['contact'] = "<div class='error text-center'>Failed to Contact.</div>";
                header('location:'.SITEURL);
            }
         }
    ?>

    </div>
</section>

<?php include('partials-front/footer.php'); ?>
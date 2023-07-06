<?php include('partials-front/menu.php'); ?>
<?php
//check whether the food id is or not
if (isset($_GET['film_id'])) {
    //get the details of the food
    $food_id = $_GET['film_id'];
    //get the details of selected food
    $sql = "SELECT * FROM tbl_film WHERE  id=$food_id";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);
    if ($count == 1) {
        //we have the data
        //gethe data from the database
        $row = mysqli_fetch_assoc($res);
        $title = $row['title'];
        $price = $row['price'];
        $description = $row['description'];
        $image_name = $row['image_name'];

    } else {
        //film not available
        header('location:' . SITEURL);


    }

} else {
    //redirect to the homepage
    header('location:' . SITEURL);
}

?>
<!-- film sEARCH Section Starts Here -->
<section class="food-search">
    <div class="container">

        <h2 class="text-center text-white">Fill this form to confirm your Download.</h2>

        <form action="" method="POST" class="order">
            <fieldset>
                <legend>Selected Film</legend>

                <div class="film-menu-img">
                    <?php
                    //check whether the image is avilable or not
                    if ($image_name == "") {
                        //image not avilable
                        echo "<div class='error'>Image not available..</div>";

                    } else {
                        ?>
                        <img src="<?php echo SITEURL; ?>images/film/<?php echo $image_name; ?>" alt="a"
                            class="img-responsive img-curve">
                        <?php


                    }


                    ?>

                </div>

                <div class="food-menu-desc">
                    <h3>
                        <?php echo $title; ?>
                    </h3>
                    <input type="hidden" name="food" value="<?php echo $title; ?>">
                    <p class="food-price">
                        <?php echo $price; ?>
                    </p>
                    <input type="hidden" name="price" value="<?php echo $price; ?>">
                    <p class="food-detail">
                        <?php echo $description; ?>
                    </p>
                    <br><br><br>
                    <input type="submit" name="submit" value="            Download             "
                        class="btn btn-primary">
                    <!-- <div class="order-label">Quantity</div>
                    <input type="number" name="qty" class="input-responsive" value="1" required> -->

                </div>

            </fieldset>
          

        </form>

        <?php
        //check whethter the submit button is clicked or not
        if (isset($_POST['submit'])) {
            //get allthe details from the form
            $food = $_POST['film'];
            $price = $_POST['price'];
          
            $order_date = date("Y-m-d h:i:sa");
            $status = "Ordered"; //ordered,on delivery,cancelled
           
            $sql2 = "INSERT INTO tbl_order SET
            film='$film',
            price='$price',
            order_date='$order_date',
            status='$status'
            ";
         
            //execute the query
            $res2 = mysqli_query($conn, $sql2);

            if ($res2 == true) {
                //oreder is execute
                $_SESSION['order'] = "<div class='success text-center'>Film Downloaded successfully..</div>";
                header('location:' . SITEURL);


            } else {
                //failed
                $_SESSION['order'] = "<div class='error text-center'>Film download Failed!.</div>";
                header('location:' . SITEURL);
            }



        }



        ?>



    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->
<?php include('partials-front/footer.php'); ?>

<?php include('partials-front/menu.php'); ?>
<?php
//check whether the food id is or not
if (isset($_GET['food_id'])) {
    //get the details of the food
    $food_id = $_GET['food_id'];
    //get the details of selected food
    $sql = "SELECT * FROM tbl_food WHERE  id=$food_id";
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
        //food not available
        header('location:' . SITEURL);


    }

} else {
    //redirect to the homepage
    header('location:' . SITEURL);
}

?>
<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search">
    <div class="container">

        <h2 class="text-center text-white">Fill this form to confirm your Download.</h2>

        <form action="" method="POST" class="order">
            <fieldset>
                <legend>Selected Film</legend>

                <div class="food-menu-img">
                    <?php
                    //check whether the image is avilable or not
                    if ($image_name == "") {
                        //image not avilable
                        echo "<div class='error'>Image not available..</div>";

                    } else {
                        ?>
                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza"
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
            <!-- 
            <fieldset>
                <legend>Delivery Details</legend>
                <div class="order-label">Full Name</div>
                <input type="text" name="full-name" placeholder="E.g. Vijay Thapa" class="input-responsive" required>

                <div class="order-label">Phone Number</div>
                <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                <div class="order-label">Email</div>
                <input type="email" name="email" placeholder="E.g. hi@vijaythapa.com" class="input-responsive" required>

                <div class="order-label">Address</div>
                <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive"
                    required></textarea>

                <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
            </fieldset> -->

        </form>

        <?php
        //check whethter the submit button is clicked or not
        if (isset($_POST['submit'])) {
            //get allthe details from the form
            $food = $_POST['food'];
            $price = $_POST['price'];
            // $qty = $_POST['qty'];
            // $total = $price * $qty; //total =pricex qty
            $order_date = date("Y-m-d h:i:sa");
            $status = "Ordered"; //ordered,on delivery,cancelled
            // $customer_name = $_POST['full-name'];
            // $customer_contact = $_POST['contact'];
            // $customer_email = $_POST['email'];
            // $customer_address = $_POST['address'];
            //save the order in the database
            $sql2 = "INSERT INTO tbl_order SET
            food='$food',
            price='$price',
            order_date='$order_date',
            status='$status'
            ";
            // total='$total',
            //  customer_name='$customer_name',
            //  customer_contact='$customer_contact',
            //  customer_email='$customer_email',
            //  customer_address='$customer_address'
            //   -- qty='$qty',
            // echo "$sql2";
            // die();
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
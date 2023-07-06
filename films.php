<?php include('partials-front/menu.php'); ?>

<!-- film sEARCH Section Starts Here -->
<section class="film-search text-center">
    <div class="container">

        <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
            <input type="search" name="search" placeholder="Search for film">
            <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>

    </div>
</section>
<!-- film sEARCH Section Ends Here -->



<!-- film MEnu Section Starts Here -->
<section class="film-menu">
    <div class="container">
        <h2 class="text-center">Add on Menu</h2>
        <?php
        $sql = "SELECT * FROM tbl_film WHERE active='Yes'";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);
        if ($count > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $id = $row['id'];
                $title = $row['title'];
                $description = $row['description'];
                $price = $row['price'];
                $image_name = $row['image_name'];
                ?>
                <div class="film-menu-box">
                    <div class="film-menu-img">
                        <?php
                        if ($image_name == "") {
                            echo "<div class='error'>Image Not Available..</div>";
                        } else {
                            ?>
                            <img src="<?php echo SITEURL; ?>images/film/<?php echo $image_name; ?>" alt="Googly"
                                class="img-responsive img-curve">
                            <?php
                        }


                        ?>

                    </div>

                    <div class="film-menu-desc">
                        <h4>
                            <?php echo $title; ?>
                        </h4>
                        <p class="film-price">
                            <?php echo $price; ?>
                        </p>
                        <p class="film-detail">
                            <?php echo $description; ?>
                        </p>
                        <br>

                        <a href="<?php echo SITEURL; ?>order.php?film_id=<?php echo $id; ?>" class="btn btn-primary">Download
                            Now</a>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "<div class='error'>Film Not Found..</div>";
        }

        ?>








        <div class="clearfix"></div>



    </div>

</section>
<!-- film Menu Section Ends Here -->








<?php include('partials-front/footer.php'); ?>

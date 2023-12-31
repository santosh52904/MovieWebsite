<?php include('partials-front/menu.php'); ?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="film-search text-center">
    <div class="container">
        <?php
        // geth the search keyword
        // $search = mysqli_real_escape_string($_POST['search']);
        $search = mysqli_real_escape_string($conn, $_POST['search']);
        ?>

        <h2>Filmss on Your Search <a href="#" class="text-white">"
                <?php echo $search; ?>"
            </a></h2>

    </div>
</section>
<!-- film sEARCH Section Ends Here -->



<!-- film MEnu Section Starts Here -->
<section class="film-menu">
    <div class="container">
        <h2 class="text-center">Add On Menu</h2>
        <?php

        //sql query to get the film by seach
        //$search =burger' ; DROP database name;
        //"SELECT * FROM tbl_food WHERE title LIKE '%burger'%' OR description LIKE '%burger'%'";
        $sql = "SELECT * FROM tbl_film WHERE title LIKE '%$search%' OR description LIKE '%$search%'";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);
        if ($count > 0) {
            while ($row = mysqli_fetch_assoc($res)) {


                $id = $row['id'];
                $title = $row['title'];
                $price = $row['price'];
                $description = $row['description'];
                $image_name = $row['image_name'];
                ?>


                <div class="film-menu-box">
                    <div class="film-menu-img">
                        <?php

                        if ($image_name == "") {

                            echo "<div class='error'>Image Not Available..</div>";
                        } else {
                            ?>
                            <img src="<?php echo SITEURL; ?>images/film/<?php echo $image_name; ?>" alt=""
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
            echo "<div class='error'>Film Not Found</div>";
        }
        ?>



        <div class="clearfix"></div>



    </div>

</section>
<!-- film Menu Section Ends Here -->
<?php include('partials-front/footer.php'); ?>

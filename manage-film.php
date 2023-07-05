<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Film</h1>
        <br /> <br />
        <!-- button to add admin -->
        <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add Film</a>
        <br /> <br /> <br />
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);

        }
        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);

        }
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);

        }

        if (isset($_SESSION['unauthorize'])) {
            echo $_SESSION['unauthorize'];
            unset($_SESSION['unauthorize']);

        }
        if (isset($_SESSION['done'])) {
            echo $_SESSION['done'];
            unset($_SESSION['done']);

        }


        ?>
        <table class="tbl-full">
            <tr>
                <th>S.NO.</th>
                <th>Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php
            //create the sql query to get all the food
            $sql = "SELECT * FROM tbl_food";
            //execute the query
            $res = mysqli_query($conn, $sql);
            //count the num of rows
            $count = mysqli_num_rows($res);
            $sn = 1;
            if ($count > 0) {

                //we have food in the database
                //get the food from the database
                while ($row = mysqli_fetch_assoc($res)) {
                    //get the from individual columns
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $image_name = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                    ?>
                    <tr>
                        <td>
                            <?php echo $sn++; ?>
                        </td>
                        <td>
                            <?php echo $title; ?>
                        </td>
                        <td>
                            <?php echo $price . "rs"; ?>
                        </td>
                        <td>
                            <?php
                            // echo $image_name
                            if ($image_name == "") {
                                //we do not have the image
                    
                                echo "<div class='error'>Image not added..</div>";
                            } else {
                                //we have the image
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="100px">

                                <?php
                            }

                            ?>
                        </td>
                        <td>
                            <?php echo $featured; ?>
                        </td>
                        <td>
                            <?php echo $active; ?>
                        </td>
                        <td>
                            <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>"
                                class="btn-secondary">Update Film</a>
                            <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>"
                                class="btn-danger">Delete
                                Film</a>
                        </td>
                    </tr>




                    <?php

                }

            } else {
                //food not added inthe database
                echo "<tr><td colspan='7' class='error'>Food Not Added</td></tr>";

            }
            ?>



        </table>
    </div>

</div>


<?php include('partials/footer.php'); ?>
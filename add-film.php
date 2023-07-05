<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Film</h1>
        <br><br>
        <?php
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>
        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-thirty">
                <tr>
                    <td>Title</td>
                    <td>
                        <input type="text" name="title" placeholder="Enter the title">
                    </td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" cols="30" rows="10" placeholder="description of food"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>
                <tr>
                    <td>Select Image</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category">
                            <?php
                            //create php code to dis[lay from the datase
                            //1.create sql to get all active categoris from the dataabse
                            $sql = "SELECT *FROM tbl_category WHERE active='Yes'";
                            $res = mysqli_query($conn, $sql);
                            //count he rows whether we have categories or not
                            $count = mysqli_num_rows($res);
                            if ($count > 0) {
                                //have categories
                                while ($row = mysqli_fetch_assoc($res)) {
                                    //get the value of categories
                                    $id = $row['id'];
                                    $title = $row['title'];
                                    ?>

                                    <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

                                    <?php

                                }
                            } else {
                                //we do not have the actegories
                                ?>
                            <option value="0">No Categories Found</option>
                            <?php

                            }
                            //2.display on dropdown
                            ?>

                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>
        <?php
        //check whether the button is clicked
        if (isset($_POST['submit'])) {
            //    add the food in the database
            // echo "clicked";
            //1.get the dat from the form
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];
            //check whether the radio button is clicked or bnot 
            if (isset($_POST['featured'])) {
                $featured = $_POST['featured'];

            } else {
                $featured = "No"; //setting the default value
            }
            if (isset($_POST['active'])) {
                $active = $_POST['active'];

            } else {
                $active = "No"; //setting the default value
            }



            //2.upload the image if selected
            //check whether the image is seleced or not
            if (isset($_FILES['image']['name'])) {
                //sected get the details of selected image
                $image_name = $_FILES['image']['name'];
                //check whether the image is selected or not
                if ($image_name != "") {
                    //image name is selected
                    //a.rename the image
                    //get the ext of selected image
                    $temp = (explode('.', $image_name));
                    $ext = end($temp);
                    //create the new for the image
                    $image_name = "Food_Name_" . rand(0000, 9999) . "." . $ext;

                    // b.upload the image
                    //get the src path and the destinanation path
        
                    //source path is the current location
                    $src = $_FILES['image']['tmp_name'];
                    //destination path
                    $dst = "../images/food/" . $image_name;
                    //finally upload the iage
                    $upload = move_uploaded_file($src, $dst);

                    //check whether the image is uploaded or not
                    if ($upload == false) {
                        //failed to upload the image
                        //redirection
                        $_SESSION['upload'] = "<div class='error'>Failed to upload Image</div>";
                        header('location:' . SITEURL . 'admin/add-food.php');
                        //stop the process
                        die(); //if failed then this will appear
                    }
                }

            } else {
                $image_name = "";
            }

            //3.insert into database
            //create the sql query to add food
            //for the numerical value we do noy need the cots for string it is compulasry
        
            $sql2 = "INSERT INTO tbl_food SET 
            title='$title',
            description='$description',
            price=$price,
             image_name='$image_name',
             category_id=$category,
             featured='$featured',
             active='$active'
             ";
            //execute the query
            $res2 = mysqli_query($conn, $sql2);
            //check whether the data inserted successfully
            if ($res2 == true) {
                //data inserted 
                $_SESSION['add'] = "<div class='success'>Film Added Successfully.</div>";
                header('location:' . SITEURL . 'admin/manage-food.php');

            } else {
                //no
                $_SESSION['add'] = "<div class='error'>Failed to add film.</div>";
                header('location:' . SITEURL . 'admin/manage-food.php');
            }

            //4.rediection
        
        }
        ?>
    </div>
</div>


<?php include('partials/footer.php'); ?>
<?php include('partials/menu.php'); ?>
<?php
//check whether the id is set or not
if (isset($_GET['id'])) {
    //get all the details
    $id = $_GET['id'];
    //sql query to get 
    $sql2 = "SELECT * FROM tbl_film WHERE id=$id";
    // execute the query
    $res2 = mysqli_query($conn, $sql2);
    //get the value based on query executed
    $row2 = mysqli_fetch_assoc($res2);
    //get the values of selected food
    $title = $row2['title'];
    $description = $row2['description'];
    $price = $row2['price'];
    $current_image = $row2['image_name'];
    $current_category = $row2['category_id'];
    $featured = $row2['featured'];
    $active = $row2['active'];


} else {
    //redirection
    header('location:' . SITEURL . 'admin/manage-film.php');

}
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Film</h1>
        <br><br>


        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-thirty">
                <tr>
                    <td>Title</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td> <textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea></td>

                </tr>
                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Current Image</td>
                    <td>
                        <?php
                        if ($current_image == "") {
                            //not available
                            echo "<div class='error'>Image not available.</div>";
                        } else {
                            //image avilable
                            ?>

                            <img src="<?php echo SITEURL; ?>images/film/<?php echo $current_image; ?>" width="100px">
                            <?php
                        }

                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Select image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category">

                            <?php
                            //query tothe active category
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                            //execute the category
                            $res = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($res);
                            if ($count > 0) {
                                //categoyr available
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $category_title = $row['title'];
                                    $category_id = $row['id'];
                                    // echo "<option value='$category_id'>$category_title</option>";
                                    ?>
                                    <option <?php if ($current_category == $category_id) {
                                        echo "selected";
                                    } ?>
                                        value="<?php echo $category_id; ?>">
                                        <?php echo $category_title; ?>
                                    </option>

                                    <?php

                                }

                            } else {
                                //category not available
                                echo "<option value='0'>Category Not Available..</option>";


                            }
                            ?>

                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?php if ($featured == "Yes") {
                            echo "checked";
                        } ?> type="radio" name="featured"
                            value="Yes">Yes
                        <input <?php if ($featured == "No") {
                            echo "checked";
                        } ?> type="radio" name="featured"
                            value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input <?php if ($active == "Yes") {
                            echo "checked";
                        } ?> type="radio" name="active"
                            value="Yes">Yes
                        <input <?php if ($active == "No") {
                            echo "checked";
                        } ?> type="radio" name="active" value="No">No
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
        <?php
        //check whether the button is clicked or not
        if (isset($_POST['submit'])) {
            // echo "Button is clicked";
            //1.get the all the details
            //from the form 
            $id = $_POST['id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $current_image = $_POST['current_image'];
            $category = $_POST['category'];

            $featured = $_POST['featured'];
            $active = $_POST['active'];

            //2. upload the imge
            //check whether the uload button is clicked or nor
            if (isset($_FILES['image']['name'])) {
                //upload button clicked
                $image_name = $_FILES['image']['name'];
                //A.uploading the new image
                //3.remove the image if th e if the new image is selected
                //check whether the file is available or nor not
                if ($image_name != "") {
                    //image is available
                    //rename the image
                    $temp = explode('.', $image_name);
                    $ext = end($temp);
                    $image_name = "Food-Name-" . rand(0000, 9999) . '.' . $ext;
                    //get the source path and the destination path
                    $src_path = $_FILES['image']['tmp_name'];
                    $dest_path = "../images/food/" . $image_name;
                    //upload the image
                    $upload = move_uploaded_file($src_path, $dest_path);
                    if ($upload == false) {
                        $_SESSION['upload'] = "<div class='error'>Failed to upload new image..</div>";
                        header('location:' . SITEURL . 'admin/manage-film.php');
                        //stop the proccess
                        die();

                    }
                    //B.remov the current image
                    if ($current_image != "") {
                        //current image is available
                        $remove_path = "../images/food/" . $current_image;
                        $remove = unlink($remove_path);
                        if ($remove == false) {
                            //failedd to remove the image
                            $_SESSION['remove-failed'] = "<div class='error'>Failed to remove the image..</div>";
                            //redirection
                            header('location:' . SITEURL . 'admin/manage-film.php');
                            die();
                        }

                    }
                } else {
                    $image_name = $current_image; //default image when image is not selected;
                }
            } else {
                $image_name = $current_image; //default image when buton is not clicked
        
            }

            //4.update the food in the database
            $sql3 = "UPDATE tbl_food SET
                       title='$title',
                       description='$description',
                       price='$price',
                       image_name='$image_name',
                       category_id='$category',
                       featured='$featured',
                       active='$active'
                       WHERE id=$id
                       ";
            //execution
            $res3 = mysqli_query($conn, $sql3);
            if ($res3 == true) {
                //uplodedd data suuceecfully
                $_SESSION['done'] = "<div class='success'>Film Updated Successfully..</div>";
                header('location:' . SITEURL . 'admin/manage-food.php');


            } else {
                //failed
                $_SESSION['done'] = "<div class='success'>Failed to update..</div>";
                header('location:' . SITEURL . 'admin/manage-food.php');

            }



        }

        ?>
    </div>
</div>


<?php include('partials/footer.php'); ?>

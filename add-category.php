<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>
        <br><br>
        <!-- Add category form starts here -->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-thirty">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Category title">
                    </td>
                </tr>
                <tr>
                    <td> Select Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured:
                    </td>
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
                        <input type="submit" name="submit" value="Add Category" class="btn-primary">
                    </td>
                </tr>
            </table>
        </form>

        <!-- Add category ends here -->
        <?php
        //check whether the submit button is clicked or not
        if (isset($_POST['submit'])) {
            echo "clicked";

            //1.get the value from the category from form
            $title = $_POST['title'];
            //2.for radio input type we need to check whether button selected or not
            $featured = (isset($_POST['featured'])) ? $_POST['featured'] : "No";
            $active = (isset($_POST['active'])) ? $_POST['active'] : "No";
            //check whether image is selrcted or not
            // print_r($_FILES['image']);
            // die(); //
            //**************** */
            if (isset($_FILES['image']['name'])) {
                //upload the image
                //to uplioad the image we need image name source path and destination path
                $image_name = $_FILES['image']['name'];
                //upload the image if only image is selected
                if ($image_name != "") {
                    //auto rename
                    //get the extension of img (jpg,png, gif) eg==splecial.food1.jpg
                    $ext = end(explode('.', $image_name));
                    //raname the image
                    $image_name = "Food_Category_" . rand(000, 999) . "." . $ext;
                    // $image_name = "Food-Name-" . rand(0000, 9999) . "." . $ext;
                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../images/category/" . $image_name;
                    //finaly upload the image
                    $upload = move_uploaded_file($source_path, $destination_path);
                    //check image is uploaded
                    //if not rediect with error message
                    if ($upload == false) {
                        //set message
                        $_SESSION['upload'] = "<div class='error'>Failed to upload the image</div>";
                        //redirection
                        header('location:' . SITEURL . 'admin/add-category.php');
                        //stop the process because we don't want upload the image in to the database
                        die();
                    }

                }


            } else {
                //don't uploade
                $image_name = "";
            }

            //3.sql query to insert into database
            $sql = "INSERT INTO tbl_category SET
            title='$title',
            image_name='$image_name',
            featured='$featured',
            active='$active'
            ";
            //4.execute the query and save in the database
            $res = mysqli_query($conn, $sql);
            //5.checking the query
            if ($res == true) {
                //query execuetded
                $_SESSION['add'] = "<div class='success'>Category Added Successfully.</div>";
                //redirection
                header('location:' . SITEURL . 'admin/manage-category.php');

            } else {

                //failed to add category
                //query execuetded
                $_SESSION['add'] = "<div class='error'>Category Adding Failed.</div>";
                //redirection
                header('location:' . SITEURL . 'admin/add-category.php');

            }
        }

        ?>

    </div>
</div>





<?php include('partials/footer.php'); ?>
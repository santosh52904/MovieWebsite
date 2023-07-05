<?php
// echo "UPdate category";
include('partials/menu.php');

?>


<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br><br>
        <?php
        //check whether the id is set or not
        if (isset($_GET['id'])) {
            //get the id and the deatails
            // echo "Getting the data";
            $id = $_GET['id'];
            //create the query to get the other details
            $sql = "SELECT * FROM tbl_category WHERE id =$id";
            $res = mysqli_query($conn, $sql);
            //count the num of rows
            $count = mysqli_num_rows($res);
            if ($count == 1) {
                //get the the dat
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $current_image = $row['image_name'];
                $featured = $row['featured'];
                $active = $row['active'];

            } else {
                //rediection with the message
                $_SESSION['no-category-found'] = "<div class='error'>Category Not Found.</div>";
                header('location:' . SITEURL . 'admin/manage-category.php');
            }

        } else {
            //rediect
            header('location:' . SITEURL . 'admin/manage-category.php');
        }
        ?>
        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-thirty">


                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">

                    </td>
                </tr>

                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php
                        if ($current_image != "") {
                            //display the image
                            ?>
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $currnt_image; ?>" width="100px "
                                alt="Current image">
                            <!-- video no 66 -->
                            <?php


                        } else {
                            //display the mesage
                            echo "<div class='error'>Image Not Added.</div>";


                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image Name:</td>
                    <td>
                        <input type="file" name="image">
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
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                    </td>

                </tr>
            </table>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            // echo "clicked";
            //get the values from the form
            $id = $_POST['id'];
            $title = $_POST['title'];
            $current_image = $_POST['current_image'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];

            //updating new image
            //check whetherbthe image is selected or not 
            if (isset($_FILES['image']['name'])) {
                $image_name = $_FILES['image']['name'];
                if ($image_name != "") {
                    //image avilable
                    //upload the new image
                    //a.auto rename
                    //get the extension of img (jpg,png, gif) eg==splecial.food1.jpg
                    $ext = end(explode('.', $image_name));
                    //raname the image
                    $image_name = "Food_Category_" . rand(000, 999) . '.' . $ext; //eg=Food_Category_864.jpg
        
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
                        header('location:' . SITEURL . 'admin/manage-category.php');
                        //stop the process because we don't want upload the image in to the database
                        die();
                    }
                    //b.remove the current image if available
                    if ($current_image != "") {
                        $remove_path = "../images/category/" . $current_image;
                        $remove = unlink($remove_path);
                        //check whether the image removed or not
        
                        if ($remove == false) {
                            $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current image..</div>";
                            header('location:' . SITEURL . 'admin/manage-category.php');
                            die(); //stop the process
                        }
                    }


                } else {
                    $image_name = $current_image;
                }
            } else {
                $image_name = $current_image;
            }
            //yupdate the database
            $sql2 = "UPDATE tbl_category SET
            title='$title',
            image_name='$image_name',
            featured='$featured',
            active='$active'
            WHERE id=$id"; //execute the query
            $res2 = mysqli_query($conn, $sql2);
            if ($res2 == true) {
                //update
                $_SESSION['update'] = "<div class='success'>Category Updated Successfully.</div>";
                header('location:' . SITEURL . 'admin/manage-category.php');

            } else {
                $_SESSION['update'] = "<div class='error'>Faild To Update the category.</div>";
                header('location:' . SITEURL . 'admin/manage-category.php');

            }

            //redirect the manage category with message
        


        }
        ?>

    </div>
</div>










<?php
// echo "UPdate category";
include('partials/footer.php');

?>
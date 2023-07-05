<?php
// including the constants file
include('../config/constants.php');


// echo "DELETE CATEGORY";
//check whether the id and image name value is set
if (isset($_GET['id']) and isset($_GET['image_name'])) {
    //get the value
    // echo "get the value";
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];


    //first remove the physical then only we will delete the data and redirect to the manage -category page
    if ($image_name != "") {
        //available so remove
        $path = "../images/category/" . $image_name;
        //remove the image
        $remove = unlink($path);
        //remove is having the boolean value
        if ($remove == false) {
            //set the session message and redirection the 
            $_SESSION['remove'] = "<div class='error'>Failed to delete the image</div>";
            //redirection
            header('location:' . SITEURL . 'admin/manage-category.php');
            //stop the session
            die();

        }
    }
    //delete the data from the database
    //sql query to delete the data
    $sql = "DELETE FROM tbl_category WHERE id=$id";
    //execute the query
    $res = mysqli_query($conn, $sql);
    //check whether the data is deete dfrom the databse
    if ($res == true) {
        //set the success message and redirect 
        $_SESSION['delete'] = "<div class='success'>Category deleted successfully.</div>";
        header('location:' . SITEURL . 'admin/manage-category.php');


    } else {
        $_SESSION['delete'] = "<div class='error'>Failed to delete the category.</div>";
        header('location:' . SITEURL . 'admin/manage-category.php');


    }


} else {
    //redict to manage category
    header('location:' . SITEURL . 'admin/manage-category.php');
}




?>
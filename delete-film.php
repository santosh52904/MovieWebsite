<?php
//we need to include conststs file
include('../config/constants.php');
// echo "Process to delete";
if (isset($_GET['id']) && isset($_GET['image_name'])) {
    //process the deletion
    // echo "Process to delete";
    //1.get the id and image name
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];
    //2.remove the image if available


    //check wheter the image is available or not 
    if ($image_name != "") {
        //there is image we need to remove it
        //get the path
        $path = "../images/food/" . $image_name;
        //remove image file from folder
        $remove = unlink($path);
        //check whether the image is removed or not
        if ($remove == false) {
            //failed to remove
            $_SESSION['upload'] = "<div class='error'>Failed to remove</div>";
            //redirection to manage film 
            header('location:' . SITEURL . 'admin/manage-film.php');
            //stop the process
            die();
        }

    }
    //3.delete film from the thdatabase
    $sql = "DELETE FROM tbl_film WHERE id=$id";
    //execute the query
    $res = mysqli_query($conn, $sql);

    //4.redirection to manage film
    if ($res == true) {
        //food deleted
        $_SESSION['delete'] = "<div class='success'>film Deleted Successfully..</div>";
        header('location:' . SITEURL . 'admin/manage-film.php');

    } else {
        // failed to delete 
        $_SESSION['delete'] = "<div class='error'>Failed Delete..</div>";
        header('location:' . SITEURL . 'admin/manage-film.php');
    }


} else {
    //redirection to film manage pafe

    // echo "Redirection";
    $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access.</div>";
    header('location:' . SITEURL > 'admin/manage-film.php');

}



?>

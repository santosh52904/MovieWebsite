<?php

//including the constants file as $conn is there in the const
include('../config/constants.php');
//get the id of admin to be deleted 
$id = $_GET['id'];
//this above id is from the table 
//create sql query to delete admin
$sql = "DELETE FROM tbl_admin WHERE id =$id";
//the above id is from get variable


//executing the query
$res = mysqli_query($conn, $sql);

//check wheteher the query is executed or not
if ($res == true) {
    //query is executed
    // echo "admin deleted";
    //crete the session variable to display the message

    $_SESSION['delete'] = "<div class='success'>Admin deleted successfully</div>";
    //redirecting to the admin page
    header('location:' . SITEURL . 'admin/manage-admin.php');
} else {
    //failed to delete the asmin
    // echo "failed to delete the admin"
    $_SESSION['delete'] = "<div class='error'>failed to delete the admin. try agin later. </div>";
    header('location:' . SITEURL . 'admin/manage-admin.php');
}

//Redirect it the admin page to show that it is deleted


?>
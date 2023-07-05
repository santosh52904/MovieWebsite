<?php
include('../config/constants.php');
// include('login-check.php');


?>
<?php
// //check whether the user is logged in or not
// //authorisation access control
// if (isset($_SESSION['user'])) {
//     // user is not logged in
// //redirect it to loguin page
//     $_SESSION['no-login-message'] = "<div class='error'>Please login to access Admin PAnel</div>";
//     header('location:' . SITEURL . 'admin/login.php');



// }


?>

<html>

<head>
    <title>
        Film website--home page
    </title>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <!-- menu section starts -->
    <div class="menu text-center">
        <div class="wrapper">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="manage-admin.php">Admin</a></li>
                <li><a href="manage-category.php">Category</a></li>
                <li><a href="manage-food.php">Film</a></li>
                <li><a href="manage-order.php">Order</a></li>
                <li><a href="logout.php">LogOut</a></li>
            </ul>
        </div>

    </div>
    <!-- menu section ends -->
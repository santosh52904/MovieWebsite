<?php
//check whether the user is logged in or not
//authorisation access control
if (isset($_SESSION['user'])) {
    // user is not logged in
//redirect it to loguin page
    $_SESSION['no-login-message'] = "<div class='error'>Please login to access Admin PAnel</div>";
    header('location:' . SITEURL . 'admin/login.php');



}


?>
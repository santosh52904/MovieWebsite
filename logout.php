<?php
include('../config/constants.php');
//1.dastroy the session
session_destroy();
//on set the session gets destroyed

//2.redict it to login page
header('location:' . SITEURL . 'admin/login.php');




?>
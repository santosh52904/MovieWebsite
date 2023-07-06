<?php include('../config/constants.php'); ?>



<html>

<head>
    <title>Login - film Order System</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <div class="login">
        <h1 class="text-center">Login</h1>
        <br> <br>
        <?php
        if (isset($_SESSION['login'])) {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }

        if (isset($_SESSION['no-login-message'])) {
            echo $_SESSION['no-login-message'];
            unset($_SESSION['no-login-message']);
        }
        ?>
        <br> <br>

        <!-- login form starts here -->
        <form action="" method="POST" class="text-center">
            Username:
            <input type="text" name="username" placeholder="Enter Username">
            <br> <br>
            Password:
            <input type="password" name="password" placeholder="Enter Password">
            <br> <br>
            <input type="submit" name="submit" value="Login" class="btn-primary">
            <br> <br>

        </form>
        <!-- login form ends here -->
        <p class="text-center">Created By - <a href="www.santod.com">SANTOSH</a> </p>
    </div>

</body>


</html>
<?php
//whether the submit button is clicked
if (isset($_POST['submit'])) {
    //process the login page
    //.get the data from the login form
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $raw_password = md5($_POST['password']);
    $password = mysqli_real_escape_string($conn, $raw_password);

    //2.check sql to check the username and paassword exists or not

    $sql = "SELECT * FROM tbl_admin WHERE user_name='$username' AND password='$password'";

    //3/execute the query
    $res = mysqli_query($conn, $sql);
    //4.count rows for the user to exist
    $count = mysqli_num_rows($res);
    if ($count == 1) {
        //user available
        $_SESSION['login'] = "<div class='success'>Login Successfully..</div>";
        $_SESSION['user'] = $username; //check whether the user is logged in or nott
        //to redict to admin
        header('location:' . SITEURL . 'admin/');

    } else {
        //user not available
        $_SESSION['login'] = "<div class='error text-center'>Username and Password are not matched</div>";
        //to redict to login page
        header('location:' . SITEURL . 'admin/login.php');

    }


}

?>

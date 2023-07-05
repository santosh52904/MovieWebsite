<?php include("partials/menu.php"); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br> <br>


        <?php
        if (isset($_SESSION['add'])) //checking the whether the session is set or not
        {
            echo $_SESSION['add']; //displaying the session message if set
            unset($_SESSION['add']); //removing the session message
        }
        //lot to know about the SESSION
        ?>
        <br /> <br />

        <form action="" method="POST">
            <table class="tbl-thirty">
                <tr>
                    <td>Full Name</td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter Your Name">
                    </td>
                </tr>

                <tr>
                    <td>Username</td>
                    <td>
                        <input type="text" name="username" placeholder="Enter Your username">
                    </td>
                </tr>

                <tr>
                    <td>Password</td>
                    <td>
                        <input type="password" name="password" placeholder="Enter Your Password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>

                </tr>

            </table>
        </form>

    </div>
</div>





<?php include("partials/footer.php"); ?>

<?php
//process the value from the post and in the database
//check whether the button is clicked or not 

if (isset($_POST['submit'])) {
    //button clicked if value is submitted and submit is clicked
    // echo "Button Clicked";


    //proceessing the data from the form

    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); //encrypt the password we cantn decrypt by using md5

    //sql query to database
    $sql = "INSERT INTO tbl_admin SET 
    full_name='$full_name',
    user_name='$username',
    password='$password'
    ";
    // $sql="INSERT INTO `tbl_admin` SET ( `full_name`, `user_name`, `password`) VALUES ('', '', '');"
    //execueting the query and saving the the data
    $res = mysqli_query($conn, $sql) or die("could not insert the data");

    //check whether the (query is executed ) data is inserted or not and display appropriate message
    if ($res == true) {
        //data inserted
        // echo "data inserted ";
        // this message is not appearing the web page
        //creating the session variable
        $_SESSION['add'] = "Admin Added Sucessfully";
        //redirecting the function
        //this below function redirects to the the main page
        header("location:" . SITEURL . 'admin/manage-admin.php');
        //this for the redirection
        //redirecting the page to manage admin url


    } else {
        //failed to  insetr the data
        // echo "failed to  insert the data ";
        //creating the session variable
        $_SESSION['add'] = " failed to  add admin";
        //redirecting the function
        //this below function redirects to the the main page
        header("location:" . SITEURL . 'admin/manage-admin.php');
        //redirecting the page to manage admin url

    }





}
?>
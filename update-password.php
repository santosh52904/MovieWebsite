<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br> <br>
        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }
        ?>

        <form action="" method="POST">

            <table class="tbl-thirty">
                <tr>
                    <td>Current Password:</td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current Password">
                    </td>
                </tr>
                <tr>
                    <td>New Password:</td>
                    <td>

                        <input type="password" name="new_password" placeholder="New Password">
                    </td>
                </tr>
                <tr>
                    <td>
                        Confirm Password:
                    </td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm Password">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-primary">
                    </td>
                </tr>

            </table>


        </form>

    </div>
</div>
<?php
//check whether the submit button is clicked or not
if (isset($_POST['submit'])) {
    //1. get the data from the form
    $id = $_POST['id'];
    $current_password = md5($_POST['current_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);


    //2.check wthre the user with current id and current password exists or not
    $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";
    //execute the query
    $res = mysqli_query($conn, $sql);

    if ($res == true) {
        //check whether the data is available or not
        $count = mysqli_num_rows($res);
        if ($count == 1) {
            //user exists and the password can be changed
            // echo "user found";

            //check wether new pass word and current password match
            if ($new_password == $confirm_password) {
                //update the password
                // echo "this matches";
                $sql2 = "UPDATE tbl_admin SET
                password='$new_password'
                WHERE id=$id";

                //execute the query
                $res2 = mysqli_query($conn, $sql2);
                //check whether the query executed or not
                if ($res2 == true) {
                    //display  success message
                    $_SESSION['change-password'] = "<div class='success'>Password changed successfully. </div>";
                    //redirect  the user
                    header('location:' . SITEURL . 'admin/manage-admin.php');
                } else {
                    $_SESSION['change-password'] = "<div class='error'>Failed to change the password. </div>";
                    //redirect  the user
                    header('location:' . SITEURL . 'admin/manage-admin.php');
                }

            } else {
                //redict to to the manage admin page with an error
                $_SESSION['password-not-match'] = "<div class='error'>Password did not match. </div>";
                //redirect  the user
                header('location:' . SITEURL . 'admin/manage-admin.php');

            }

        } else {
            //user does not exists. set message and redirect
            $_SESSION['user-not-found'] = "<div class='error'>User not found. </div>";
            //redirect  the user
            header('location:' . SITEURL . 'admin/manage-admin.php');

        }
    }
    //3.check whether the new password and old password match or not


    //4.change password if all above is true






}

?>




<?php include('partials/footer.php'); ?>
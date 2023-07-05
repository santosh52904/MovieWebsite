<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br> <br>
        <?php
        //get the id of selected admin
        $id = $_GET['id'];
        //create the sql query
        $sql = "SELECT * FROM tbl_admin WHERE id=$id";

        // execute the query 
        $res = mysqli_query($conn, $sql);
        //check whether the query is executed
        if ($res == true) {
            //check whether the data is avalable or not
            $count = mysqli_num_rows($res);
            //check whether we have admin data or not
            if ($count == 1) {
                //get the details
                // echo "Admin Available";
                $row = mysqli_fetch_assoc($res);
                $full_name = $row['full_name'];
                $username = $row['user_name'];

            } else {
                //redirect to manage admin page
                header('location:' . SITEURL . 'admin/manage-admin.php');

            }

        } else {

        }

        ?>
        <form action="" method="POST">

            <table class="tbl-thirty">
                <tr>
                    <td>Full Name</td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Username</td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>

    </div>
</div>
<?php
//check whether the submit button is clicked
if (isset($_POST['submit'])) {
    // echo "Button is clicked";
    //get all the values from the form
    $id = $_POST['id'];
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];


    //now we are creatig thre sql query
    $sql = "UPDATE tbl_admin SET
     full_name='$full_name',
     user_name='$username'
     WHERE id='$id'
     ";

    //executing the query

    $res = mysqli_query($conn, $sql);
    //check whether query executed successfully
    if ($res == true) {
        //query executed
        $_SESSION['update'] = "<div class='success'>Admin successfully updated.</div>";
        //to redirect to the admin page
        header('location:' . SITEURL . 'admin/manage-admin.php');

    } else {
        //failed query
        $_SESSION['update'] = "<div class='error'>Admin update failed.</div>";
        //to redirect to the admin page
        header('location:' . SITEURL . 'admin/manage-admin.php');
    }


}

?>



<?php include('partials/footer.php'); ?>
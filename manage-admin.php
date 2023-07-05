<?php include("partials/menu.php"); ?>


<!-- main content section starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>MANAGE ADMIN</h1>
        <br /> <br />

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']); //removing the session message
        }
        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        if (isset($_SESSION['user-not-found'])) {
            echo $_SESSION['user-not-found'];
            unset($_SESSION['user-not-found']);

        }
        if (isset($_SESSION['password-not-match'])) {
            echo $_SESSION['password-not-match'];
            unset($_SESSION['password-not-match']);

        }
        if (isset($_SESSION['change-password'])) {
            echo $_SESSION['change-password'];
            unset($_SESSION['change-password']);

        }
        ?>
        <br /> <br />
        <!-- button to add admin -->
        <a href="add-admin.php" class="btn-primary">Add Admin</a>
        <br /> <br /> <br />
        <table class="tbl-full">
            <tr>
                <th>S.NO.</th>
                <th>Full Name</th>
                <th>User Name</th>
                <th>Actions</th>
            </tr>
            <?php
            //query to get all the admin table in page
            $sql = "SELECT * FROM tbl_admin";
            //executing the query
            $res = mysqli_query($conn, $sql);

            //checking the query is executed or not
            if ($res == TRUE) {
                //count the no. rows in the database
                $count = mysqli_num_rows($res); //function get all the rows in the database
                $sn = 1; // creating the value assigning the value
            

                //check the no. of rows
                if ($count > 0) {
                    //we have data in the database
                    while ($rows = mysqli_fetch_assoc($res)) {
                        //using the while loop to get all the data which is in database
            
                        //get individual data
                        $id = $rows['id'];
                        $full_name = $rows['full_name'];
                        $username = $rows['user_name'];

                        //display the values in table
                        ?>
                        <tr>
                            <td>
                                <?php echo $sn++; ?>
                            </td>
                            <td>
                                <?php echo $full_name; ?>
                            </td>
                            <td>
                                <?php echo $username; ?>
                            </td>
                            <td><a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>"
                                    class="btn-primary">Change Password</a>
                                <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>"
                                    class="btn-secondary">Update Admin</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>"
                                    class="btn-danger">Delete Admin</a>


                                <!-- passing the variable in url is get method where the pasing the value in the form is post method -->
                            </td>
                        </tr>



                        <?php
                    }

                    //display the values in table
            
                } else {

                }

            }


            ?>






        </table>

    </div>

</div>
<!-- main content ends -->

<!-- footer section starts -->
<div class="footer">
    <div class="wrapper">
        <p class="text-center">ALL RIGHTS RESERVED GOOGLY RESTURANT, <a href="#">SANTOSH GOOGLY</a></p>
    </div>

</div>
<!-- footer section ends -->
</body>

</html>
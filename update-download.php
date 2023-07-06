<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Oreder</h1>
        <br><br>
        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            //sql to query get the data 
            $sql = "SELECT * FROM tbl_order WHERE id=$id";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            if ($count == 1) {
                //details available
                $row = mysqli_fetch_assoc($res);
                $film = $row['film'];
               
                $status = $row['status'];
                $customer_name = $row['customer_name'];
                $customer_contact = $row['customer_contact'];
                $customer_email = $row['customer_email'];
                $customer_address = $row['customer_address'];


            } else {
                //details not avilable
                header(('location:' . SITEURL . 'admin/manage-order.php'));
            }

        } else {
            header('location:' . SITEURL . 'admin/manage-order.php');
        }


        ?>
        <form action="" method="POST">
            <table class="tbl-thirty">
                <tr>
                    <td>Food Name</td>
                    <td><b>
                            <?php echo $film; ?>
                        </b></td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td><b>$
                            <?php echo $price; ?>
                        </b></td>
                </tr>
                <tr>
                    <td>Qty</td>
                    <td>
                        <input type="number" name="qty" value="<?php echo $qty; ?>">
                    </td>

                </tr>
                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status">
                            <option <?php if ($status == "Ordered") {
                                echo "selected";
                            } ?>value="Ordered">Ordered</option>
                            <option <?php if ($status == "On Delivery") {
                                echo "selected";
                            } ?> value="On Delivery">On
                                Delivery</option>
                            <option <?php if ($status == "Delivered") {
                                echo "selected";
                            } ?> value="Delivered">Delivered
                            </option>
                            <option <?php if ($status == "Cancelled") {
                                echo "selected";
                            } ?> value="Cancelled">Cancelled
                            </option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Customer Name</td>
                    <td>
                        <input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Customer Contact</td>
                    <td>
                        <input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Customer Email</td>
                    <td>
                        <input type="text" name="customer_email" value="<?php echo $customer_email; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Customer Address</td>
                    <td>
                        <textarea name="customer_address" id="" cols="30"
                            rows="5"><?php echo $customer_address; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">
                        <input type="submit" name="submit" value="Update Order" class="btn-seconadary">
                    </td>
                </tr>
            </table>
        </form>
        <?php
        //check whether the update button is clicked or not
        if (isset($_POST['submit'])) {
            //get the values
            $id = $_POST['id'];
            $price = $_POST['price'];
          
            $status = $_POST['status'];
            $customer_name = $_POST['customer_name'];
            $custome_contact = $_POST['custome_contact'];
            $customer_email = $_POST['customer_email'];
            $customer_address = $_POST['customer_address'];
            //update values
            $sql2 = "UPDATE tbl_order SET
         
            status = '$status',
            customer_name = '$customer_name',
            custome_contact = '$custome_contact',
            customer_email = '$customer_email',
            customer_address = '$customer_address'
            WHERE id=$id
            ";
            //and redirection
            $res2 = mysqli_query($conn, $sql2);
            if ($res2 == true) {
                $_SESSION['update'] = "<div class='success' >Film updated successfully..</div>";
                header('location:' . SITEURL . 'admin/manage-order.php');
            } else {
                $_SESSION['update'] = "<div class='error' >Failed update film..</div>";
                header('location:' . SITEURL . 'admin/manage-order.php');

            }
        }



        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>

<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Order</h1>
        <br /> <br />
        <!-- button to add admin -->
        <?php
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }

        ?>

        <br /> <br /> <br />
        <table class="tbl-full">
            <tr>
                <th>S.NO.</th>
                <th>film</th>
               
              
                <th>Order Date</th>
                <th>Status</th>
                <th>Customer Name</th>
                <th>Customer Contact</th>
                <th>Email</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>
            <?php
            //get the alldetails from the $sql
            $sql = "SELECT * FROM tbl_order ORDER BY id DESC";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            $sn = 1;
            if ($count < 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    //get the all order details
                    $id = $row['id'];
                   
                    $total = $row['total'];
                    $order_date = $row['order_date'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_email = $row['customer_email'];
                    $customer_address = $row['customer_address'];
                    ?>
                    <tr>
                        <td>
                            <?php echo $sn++; ?>
                        </td>
                        <td>
                            <?php echo $film; ?>
                        </td>
                        <td>
                            <?php echo $price; ?>
                        </td>
                        <td>
                            <?php echo $qty; ?>
                        </td>
                        <td>
                            <?php echo $total; ?>
                        </td>
                        <td>
                            <?php echo $order_date; ?>
                        </td>
                        <td>
                            <?php
                            if ($status == "Ordered") {
                                echo "<label>$status</label>";
                            } else if ($status == "On Delivery") {
                                echo "<label style='color:orange;'>$status</label>";
                            } else if ($status == "Delivered") {
                                echo "<label style='color:green;'>$status</label>";
                            } else if ($status == "Cancelled") {
                                echo "<label style='color:red;'>$status</label>";
                            }
                            ?>
                        </td>
                        <td>
                            <?php echo $customer_name; ?>
                        </td>
                        <td>
                            <?php echo $customer_contact; ?>
                        </td>
                        <td>
                            <?php echo $customer_email; ?>
                        </td>
                        <td>
                            <?php echo $customer_address; ?>
                        </td>

                        <td>
                            <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>"
                                class="btn-secondary">Update Film</a>
                            <a href="#" class="btn-danger">Delete Film</a>
                        </td>
                    </tr>
                    <?php
                }

            } else {
                echo "<tr><td colspan='12' class=''error>Film not Available...</td></tr>";
            }
            ?>





        </table>
    </div>

</div>


<?php include('partials/footer.php'); ?>

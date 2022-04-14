<?php
require "header2.php";
if (isset($_SESSION['adminId'])) {
?>

    <main class="enri">
        <div class="font-xs">
            <div class="row">
                <div class=col-lg-12>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Order Id</th>
                                <th scope="col">Customer name</th>
                                <th scope="col">Phone Number</th>
                                <th scope="col">Address</th>
                                <th scope="col">Payment method</th>
                                <th scope="col">Orders</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include_once 'includes/dbh.inc.php';
                            $sql = "SELECT * FROM `order_manager`";
                            $stmt = mysqli_stmt_init($conn);
                            if (!mysqli_stmt_prepare($stmt, $sql)) {
                                header("Location: shop2.php?error=sqlerror");
                                exit();
                            } else {
                                mysqli_stmt_execute($stmt);
                                $result = mysqli_stmt_get_result($stmt);
                                while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                    <tr>
                                        <th><?php echo $row['orderId']; ?></th>
                                        <td><?php echo $row['fName']; ?></td>
                                        <td><?php echo $row['deliveryTel']; ?></td>
                                        <td><?php echo $row['deliveryAddress']; ?></td>
                                        <td><?php echo $row['pay_method']; ?></td>
                                        <td>
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Item Name</th>
                                                        <th scope="col">Size</th>
                                                        <th scope="col">Price</th>
                                                        <th scope="col">Quantity</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $sql1 = "SELECT * FROM `customer_orders` WHERE `orderId`='$row[orderId]'";
                                                    $stmt1 = mysqli_stmt_init($conn);
                                                    if (!mysqli_stmt_prepare($stmt1, $sql1)) {
                                                        header("Location: shop2.php?error=sqlerror");
                                                        exit();
                                                    } else {
                                                        mysqli_stmt_execute($stmt1);
                                                        $result1 = mysqli_stmt_get_result($stmt1);
                                                        while ($row1 = mysqli_fetch_assoc($result1)) {
                                                    ?>
                                                            <tr>
                                                                <td><?php echo $row1['itemName']; ?></td>
                                                                <td><?php echo $row1['size']; ?></td>
                                                                <td><?php echo $row1['price']; ?>$</td>
                                                                <td><?php echo $row1['quantity']; ?></td>
                                                            </tr>
                                                        <?php
                                                        }
                                                        ?>
                                                </tbody>
                                            </table>
                                        </td>
                                        <td>
                                            <form action="./includes/deleteOrders.php" method="post">
                                                <input type="hidden" name="hidden-orderId" value="<?php echo $row['orderId'] ?>">
                                                <button type="submit" class="button w-70" name="delete-order">Delete</button>
                                            </form>

                                        </td>


                                    </tr>
                        <?php

                                                    }
                                                }
                                            }
                        ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
<?php
}
require "footer.php";
?>
<!--Yannick Makwenge - E-Commerce-Website-->
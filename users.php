<?php
require "header2.php";
if (isset($_SESSION['adminId'])) {
?>

    <main class="enri">
        <div class="font-xs">
            <?php
            if (isset($_GET['error'])) {
                if ($_GET['error'] == 'mainAccount') {
                    echo '<p class="signup-error">This is the main account, it cannot be deleted!</p>';
                } else if ($_GET['error'] == 'wrongUsertype') {
                    echo '<p class="signup-error">This is the main account, it cannot be changed! </p>';
                }
            }
            ?>
            <div class="row">
                <div class=col-lg-12>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Customer Id</th>
                                <th scope="col">Customer name</th>
                                <th scope="col">Username</th>
                                <th scope="col">Phone Number</th>
                                <th scope="col">email</th>
                                <th scope="col">Type of user</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include_once 'includes/dbh.inc.php';
                            $sql = "SELECT * FROM `customer`";
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
                                        <th><?php echo $row['customerNo']; ?></th>
                                        <td><?php echo $row['firstName'] . " " . $row['lastName']; ?></td>
                                        <td><?php echo $row['username']; ?></td>
                                        <td><?php echo $row['tel']; ?></td>
                                        <td><?php echo $row['email']; ?></td>
                                        <td><?php echo $row['usertype']; ?></td>
                                        <td>
                                            <form action="./includes/manageUser.php" method="post">
                                                <input type="hidden" name="hidden-userId" value="<?php echo $row['customerNo'] ?>">
                                                <input type="hidden" name="hidden-userType" value="<?php echo $row['usertype'] ?>">
                                                <button type="submit" class="button w-70" name="change-userType">User/Admin</button>
                                                <button type="submit" class="button w-70" name="delete-user">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                            <?php

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
<?php

if (isset($_POST['delete-order'])) {
    include_once "dbh.inc.php";

    $orderId = $_POST['hidden-orderId'];
    $sql = "DELETE FROM `order_manager` WHERE `order_manager`.`orderId` = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../addProduct.php?error=sqlerror1");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "s", $orderId);
        mysqli_stmt_execute($stmt);

        $sql1 = "DELETE FROM `customer_orders` WHERE `customer_orders`.`orderId` = ?";
        $stmt1 = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt1, $sql1)) {
            header("Location: ../orders.php?error=sqlerror2");
            exit();
        } else {

            mysqli_stmt_bind_param($stmt1, "s", $orderId);
            mysqli_stmt_execute($stmt1);

            header("Location: ../orders.php?delete=success");
            exit();
        }
    }
} else {
    //redirect the admin to the index page delete order is not set 
    header("Location: ../index.php");
    exit();
}

//Yannick Makwenge - E-Commerce-Website
<?php

if (isset($_POST['delete-user'])) {
    include_once "dbh.inc.php";
    if ($_POST['hidden-userType'] != "mainAdmin") {
        $userType = "user";

        $userId = $_POST['hidden-userId'];
        $sql = "DELETE FROM `customer` WHERE `customer`.`customerNo` = ?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../users.php?error=sqlerror1");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $userId);
            mysqli_stmt_execute($stmt);
            header("Location: ../users.php?delete=success");
            exit();
        }
    } else {
        header("Location: ../users.php?error=mainAccount");
        exit();
    }
} elseif (isset($_POST['change-userType'])) {
    include_once "dbh.inc.php";

    if ($_POST['hidden-userType'] == "admin") {
        $userType = "user";
    } elseif ($_POST['hidden-userType'] == "user") {
        $userType = "admin";
    } else {
        header("Location: ../users.php?error=wrongUsertype");
        exit();
    }

    $sql = "UPDATE customer SET userType=? WHERE customerNo = '" . $_POST['hidden-userId'] . "'";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../users.php?error=sqlerror");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "s", $userType);
        mysqli_stmt_execute($stmt);
        header("Location: ../users.php?change=success");
        exit();
    }
} else {
    //redirect the admin to the index page add product is not set 
    header("Location: ../index.php");
    exit();
}

//Yannick Makwenge - E-Commerce-Website
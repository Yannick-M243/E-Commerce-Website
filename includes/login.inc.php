<?php

//verify if the user clicked on the login button to access this page and not in another way
if (isset($_POST['login-submit'])) {

    //requiring connection to the database
    require 'dbh.inc.php';

    //Get the username or the email address, and the password entered by the user
    $mailUsername = $_POST['mailuid'];
    $password = $_POST['pwd'];


    // verifying if there are empty fields
    if (empty($mailUsername) || empty($password)) {
        header(("Location: ../login.php?error=emptyfields"));
    } else {

        $sql = "SELECT * FROM `customer` WHERE `username`=? OR `email`=?;";
        $stmt = mysqli_stmt_init($conn);

        //checking if the sql statment created has an error
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../login.php?error=sqlerror1");
            exit();
        } else {

            //sending the data entered email/username and password to the database for comparison
            mysqli_stmt_bind_param($stmt, "ss", $mailUsername, $mailUsername);
            mysqli_stmt_execute($stmt);

            //getting the result of the comparison 
            $result = mysqli_stmt_get_result($stmt);

            //checking if there is a result from the database
            if ($row = mysqli_fetch_assoc($result)) {
                //check if the password entered match the password in the database
                $pwdcheck = password_verify($password, $row['uPassword']);
                if ($pwdcheck == false) {
                    header("Location: ../login.php?error=wrongpassword");
                    exit();
                } else if ($pwdcheck == true) {

                    if ($row['usertype'] == "admin" || $row['usertype'] == "mainAdmin") {
                        session_start();
                        $_SESSION['adminId'] = $row['customerNo'];
                        $_SESSION['adminUsername'] = $row['username'];
                        $_SESSION['adminFirstname'] = $row['firstName'];
                        $_SESSION['adminLastname'] = $row['lastName'];
                        $_SESSION['adminEmail'] = $row['email'];
                        $_SESSION['adminTel'] = $row['tel'];
                    } else if ($row['usertype'] == "user") {
                        session_start();
                        $_SESSION['userId'] = $row['customerNo'];
                        $_SESSION['userUsername'] = $row['username'];
                        $_SESSION['userFirstname'] = $row['firstName'];
                        $_SESSION['userLastname'] = $row['lastName'];
                        $_SESSION['userEmail'] = $row['email'];
                        $_SESSION['userTel'] = $row['tel'];
                    }

                    header("Location: ../index.php?login=success");
                    exit();
                } else {
                    header("Location: ../login.php?error=wrongpassword");
                    exit();
                }
            } else {
                header("Location: ../login.php?error=nouserfound");
                exit();
            }
        }
    }
} else {
    //redirect the user to the index page if the login is successful
    header("Location: ../index.php");
    exit();
}

//Yannick Makwenge - E-Commerce-Website
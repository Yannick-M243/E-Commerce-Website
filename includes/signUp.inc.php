<?php

//checking if the user clicked on the button "sign up" to get access to this page
if (isset($_POST['signup-submit'])) {

    require 'dbh.inc.php';

    //fetch the information from the sign up form
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];


    // check if there is an empty field
    if (empty($firstname) || empty($lastname) || empty($email) || empty($tel) || empty($username) || empty($password) || empty($cpassword)) {
        //sending back the user to the sign up page with the error "emptyfields"
        header("Location:../signUp.php?error=emptyfields");
        exit(); //stop any other operation if fields are empty
    }

    //verify if the username and the email are valid
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../signUp.php?error=invalidusernamemail&email=" . $username . "&email=" . $email);
        exit();
    }
    //verify if the email address is valid 
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../signUp.php?error=invalidemail&username=" . $username);
        exit();
    }

    //verify if the username is valid
    elseif (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../signUp.php?error=invalidusername&email=" . $email);
        exit();
    }
    //verify if the two password match
    elseif ($password !== $cpassword) {
        header("Location: ../signUp.php?error=passwordcheck&username=" . $username . "&email=" . $email);
        exit();
    }

    //check if there is no existing users with the same username
    else {
        $sql = "SELECT `username` FROM `customer` WHERE `username`=?";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../signUp.php?error=sqlerror1");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultcheck = mysqli_stmt_num_rows($stmt);
            if ($resultcheck > 0) {
                header("Location: ../signUp.php?error=usertaken&email=" . $email);
                exit();
            }
        }

        $sql = "SELECT `email` FROM `customer` WHERE `email`=?";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../signUp.php?error=sqlerror1");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultcheck = mysqli_stmt_num_rows($stmt);
            if ($resultcheck > 0) {
                header("Location: ../signUp.php?error=emailtaken&username=" . $username);
                exit();
            }

            //store the user details into the database
            else {
                $sql = "INSERT INTO `customer` (`firstname`, `lastname`, `email`, `tel`, `username`,`uPassword`) VALUES (?,?,?,?,?,?)";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../signUp.php?error=sqlerror2");
                    exit();
                } else {

                    //hash the password inside the database for security pupose
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                    mysqli_stmt_bind_param($stmt, "ssssss", $firstname, $lastname, $email, $tel, $username, $hashedPassword);
                    mysqli_stmt_execute($stmt);
                    header("Location:../index.php?signUp=success");
                    exit();
                }
            }
        }
    }

    mysqli_stmt_close($stmt); //closing the statement
    mysqli_close($conn);
} else {
    //redirect the user to the index page if the sign up is successful
    header("Location: ../index.php");
    exit();
}

//Yannick Makwenge - E-Commerce-Website
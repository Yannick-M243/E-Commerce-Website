<?php


if (isset($_POST["reset-pwd-submit"])) {
    $selector = $_POST["selector"];
    $validator = $_POST["validator"];
    $password = $_POST["pwd"];
    $confirmPassword = $_POST["cpwd"];

    //checking if there are empty fields
    if (empty($password) || empty($confirmPassword)) {
        header("Location: ../create-password.php?newpwd=empty");
        exit();
    } else if ($password != $confirmPassword) {
        header("Location: ../create-password.php?newpwd=pwdnotsame");
        exit();
    }

    $currentDate = date("U");

    require 'dbh.inc.php';

    $sql = "SELECT * FROM `pwdReset` WHERE `pwdResetSelector`=? AND `pwdResetExpires` >=?";
    $stmt = mysqli_stmt_init($conn);

    //checking if the statement can be run
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "there was an error!";
        exit();
    } else {
        //replacing the "?" from the sql statement with the selector
        mysqli_stmt_bind_param($stmt, "ss", $selector, $currentDate);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        //fetching the token row from the database
        if (!$row = mysqli_fetch_assoc($result)) {
            //creating an errror message if there is no row available for the user
            echo 'You need to re-submit your reset request.';
            exit();
        } else {

            //covert validator token into binary
            $tokenBin = hex2bin($validator);

            $tokenCheck = password_verify($tokenBin, $row["pwdResetToken"]);

            //checking if the validator is the same with the token from the database
            if ($tokenCheck === false) {
                echo "You need to re-submit your reset request";
                exit();
            } elseif ($tokenCheck === true) {

                $tokenEmail = $row['pwdResetEmail'];

                $sql = "SELECT * FROM `customer` WHERE `email`=?;";
                $stmt = mysqli_stmt_init($conn);

                //checking if the statement can be run
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    echo "there was an error!";
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                    mysqli_stmt_execute($stmt);

                    $result = mysqli_stmt_get_result($stmt);

                    if (!$row = mysqli_fetch_assoc($result)) {
                        echo 'There was an error.';
                        exit();
                    } else {
                        //statement for updating new password to the database
                        $sql = "UPDATE `customer` SET `uPassword`=? WHERE `email`=?;";
                        $stmt = mysqli_stmt_init($conn);

                        //checking if the statement can be run
                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                            echo "there was an error!";
                            exit();
                        } else {
                            //hash the new password for security purpose
                            $newPwdHash = password_hash($password, PASSWORD_DEFAULT);
                            mysqli_stmt_bind_param($stmt, "ss", $newPwdHash, $tokenEmail);
                            mysqli_stmt_execute($stmt);

                            //statement form deleting the user email from pwd reset table 
                            $sql = "DELETE FROM `pwdReset` WHERE `pwdResetEmail`=?;";
                            $stmt = mysqli_stmt_init($conn);

                            //checking if the statement can be run
                            if (!mysqli_stmt_prepare($stmt, $sql)) {
                                echo "there was an error!";
                                exit();
                            } else {
                                mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                                mysqli_stmt_execute($stmt);
                                header("Location: ../login.php?newpwd=passwordupdated");
                            }
                        }
                    }
                }
            }
        }
    }
} else {
    header("Location: ../index.php");
}

//Yannick Makwenge - E-Commerce-Website
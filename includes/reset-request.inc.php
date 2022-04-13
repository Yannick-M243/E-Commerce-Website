<?php

if (isset($_POST['pwdreset-submit'])) {

    //generating a random token number with 8 bytes and convert it to hexadecimal
    $selector = bin2hex(random_bytes(8));
    //generating a second token of 32 bytes that will help to authenticate the user
    $token = random_bytes(32);

    //create a link to the website
    $url = "http://localhost//E-Commerce-Website/create-password.php?selector=" . $selector . "&validator=" . bin2hex($token);

    //creating an expiring date for the token
    $expires = date("U") + 1800;

    require 'dbh.inc.php';

    $userEmail = $_POST["mail"];

    //access the database to see if there is no existing token for a specific user
    $sql = "DELETE FROM `pwdReset` WHERE `pwdResetEmail`=?";
    $stmt = mysqli_stmt_init($conn);

    //checking if the statement can be run
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "there was an error!";
        exit();
    } else {
        //replacing the "?" from the sql statement with the user email
        mysqli_stmt_bind_param($stmt, "s", $userEmail);
        mysqli_stmt_execute($stmt);
    }

    $sql = "INSERT INTO `pwdReset` (`pwdResetEmail`, `pwdResetSelector`,`pwdResetToken`,`pwdResetExpires`) VALUES (?,?,?,?);";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "there was an error!";
        exit();
    } else {
        //hash  the token for security purpose
        $hashedToken = password_hash($token, PASSWORD_DEFAULT);
        //storing the new token to the database
        mysqli_stmt_bind_param($stmt, "ssss", $userEmail, $selector, $hashedToken, $expires);
        mysqli_stmt_execute($stmt);
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    require_once 'php_mailer/PHPMailerAutoload.php';
    $to = $userEmail;
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'ssl';
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = '465';
    $mail->isHTML();
    //Gmail account only
    $mail->Username = 'email@gmail.com';
    $mail->Password = '*****';
    $mail->SetFrom('email@gmail.com');
    $mail->Subject = 'Password Reset';
    $mail->Body = '<p> We recieved a password reset request. The link to reset your password is below, if you did not make this request, plese ignore this email</p>';
    $mail->Body .= '<p>Here is your password reset link: </br>';
    $mail->Body .= '<a href ="' . $url . '">' . $url . '</a></p>';
    $mail->AddAddress($to);
    $mail->Send();

    header("Location: ../reset-password.php?reset=success");
} else {
    header("Location: ../index.php");
}

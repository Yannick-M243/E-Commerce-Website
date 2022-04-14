<?php


// Check if the user clicked the submit button.

if (isset($_POST['updateAccountSubmit'])) {

    require 'dbh.inc.php';

    // Initialising the variables with the data from the database.
    // $profilePicture = $_POST['profilePicture'];
    $username = $_POST['username'];
    $firstName = $_POST['firstName'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phoneNumber'];

    // Error handlers or checkers.
    // Always check errors first when creating PHP codes.
    // Check if both the email and username are valid.
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../userSettings.php?error=invalidmailuid&fname=" . $firstName . "&sname=" . $surname .
            "&phone=" . $phone);
        exit();
    }

    // Check if the email is valid.
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../userSettings.php?error=invalidmail&fname=" . $firstName . "&sname=" . $surname .
            "&phone=" . $phone . "&uid=" . $username);
        exit();
    }

    // Check if the username is valid with a search pattern.
    else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../userSettings.php?error=invaliduid&fname=" . $firstName . "&sname=" . $surname .
            "&mail=" . $email . "&phone=" . $phone);
        exit();
    }
    // After checking all the possible error handlers we can proceed.
    // Update the data from the form on the database.
    else {
        // The placeholders (?) are a safer way of inserting data into the database.
        $sql = "UPDATE customer SET firstName=?, lastName=?, email=?, tel=?, username=? WHERE customerNo = '"
            // When making queries with the user logged in,
            // the user's primary key is used as the condition.
            . $_SESSION['userId'] . "'";
        $stmt = mysqli_stmt_init($conn);

        // Check if the SQL statement and the connection above work.
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../userSettings.php?error=sqlerror");
            exit();
        }
        // Updating the data from the form on the database.
        else {
            // Mysqli functions executing the query above.
            mysqli_stmt_bind_param($stmt, "sssss", $firstName, $surname, $email, $phoneNumber, $username);
            mysqli_stmt_execute($stmt);
            // Giving the user a successfull account update message.
            header("Location: ../userSettings.php?accountUpdate=success");
            exit();
        }
    }

    //Closing the statements and the connection to the database to save PHP and MySQL resources.
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
// Send the user back to the index if they try to access this PHP page without clicking on the account settings of the dashboard.
else {
    header("Location: ../index.php");
    exit();
}

//Yannick Makwenge - E-Commerce-Website
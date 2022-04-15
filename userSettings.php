<?php
require "header2.php";
if (isset($_SESSION['userId'])) {
?>
    <main class="enri">
        <section class="container">
        <div class="signup-login">
            <h2 >Account Settings</h2>
            <?php
            // Input Validation.
            if (isset($_GET['error'])) {
                if ($_GET['error'] == "invalidmailuid") {
                    echo '<p class="signup-error">Invalid username or e-mail!</p>';
                } else if ($_GET['error'] == "invaliduid") {
                    echo '<p class="signup-error">Invalid username!</p>';
                } else if ($_GET['error'] == "invalidmail") {
                    echo '<p class="signup-error">Invalid e-mail!</p>';
                }
            } else
                // Confirmation of the account info update.
                if (isset($_GET['accountUpdate'])) {
                    if ($_GET['accountUpdate'] == "success") {
                        echo '<p class="success">Account information successfully updated!</p>';
                    }
                }
            ?>
            <!-- Displaying the data from the customer database table into the form. -->
            <form action="includes/userSettings.inc.php" method="post">

                <table class="table table-btn">
                    <tr>
                        <td>Username:</td>
                        <td> <input class="w-50" type="text" name="username" value="<?php echo $_SESSION['userUsername']; ?>"></td>
                    </tr>
                    <tr>
                        <td>First name:</td>
                        <td><input class="w-50" type="text" name="firstName" value="<?php echo $_SESSION['userFirstname']; ?>"></td>
                    </tr>
                    <tr>
                        <td>Surname:</td>
                        <td><input class="w-50" type="text" name="surname" value="<?php echo $_SESSION['userLastname']; ?>"></td>
                    </tr>
                    <tr>
                        <td>E-mail address:</td>
                        <td><input class="w-50" type="text" name="email" value="<?php echo $_SESSION['userEmail']; ?>"></td>
                    </tr>
                    <tr>
                        <td>Phone number:</td>
                        <td><input class="w-50" type="text" name="phoneNumber" value="<?php echo $_SESSION['userTel']; ?>"></td>
                    </tr>
                    <tr>
                        <td><button type="submit" class="button w-70" name="updateAccountSubmit">Update Account</button></td>
                    </tr>
            </form>
            <tr>
                <td>
                    <form action="reset-password.php"><button class="button w-70">Change your password</button></form>
                </td>
            </tr>
            </table>
        </div>
    </section>
    </main>
</body>
<?php
}
require "footer.php";
?>
<!--Yannick Makwenge - E-Commerce-Website-->
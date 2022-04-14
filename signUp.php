<?php
require "header2.php";

?>

<main class="enri">
    <div class="signup-login font-xs">
        <h2 class="font-x2">Sign Up</h2>
        <form action="./includes/signUp.inc.php" method="post">

            <label for="firstname">First name :</label><br>
            <input class="field w-40" type="text" name="firstname" id="firstname"><br>

            <label for="lastname">Last name :</label><br>
            <input class="field w-40" type="text" name="lastname" id="lastname"><br>

            <label for="email">Email Address :</label><br>
            <input class="field w-40" type="email" name="email" id="email"><br>

            <label for="tel">Phone Number :</label><br>
            <input class="field w-40" type="text" name="tel" id="tel"><br>

            <label for="username">Username :</label><br>
            <input class="field w-40" type="text" name="username" id="username"><br>

            <label for="password">Password :</label><br>
            <input class="field w-40" type="password" name="password" id="password"><br>

            <label for="cpassword">Confirm Password :</label><br>
            <input class="field w-40" type="password" name="cpassword" id="cpassword"><br>

            <button type="submit" name="signup-submit" class="button w-40 font-xs" Sign Up>Sign Up</button>

        </form>
        <?php
        if (isset($_GET['error'])) {
            if ($_GET['error'] == 'emptyfields') {
                echo '<p class="signup-error">Fill in all fields </p>';
            } else if ($_GET['error'] == 'invalidusernamemail') {
                echo '<p class="signup-error">Invalid username and email </p>';
            } else if ($_GET['error'] == 'invalidemail') {
                echo '<p class="signup-error">Enter a valid email </p>';
            } else if ($_GET['error'] == 'invalidusername') {
                echo '<p class="signup-error">Enter a valid username </p>';
            } else if ($_GET['error'] == 'passwordcheck') {
                echo '<p class="signup-error">The two passwords does not math</p>';
            } else if ($_GET['error'] == 'usertaken') {
                echo '<p class="signup-error">Username already taken</p>';
            } else if ($_GET['error'] == 'emailtaken') {
                echo '<p class="signup-error">An account is already linked to this email address</p>';
            }
        }
        ?>
    </div>
</main>
<?php
require "footer.php";
?>
<!--Yannick Makwenge - E-Commerce-Website-->
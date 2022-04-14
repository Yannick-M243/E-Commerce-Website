<?php
require "header2.php";
?>
<main class="enri">
    <div class="signup-login font-xs">
        <h2 class="font-x2">Login</h2>
        <form class="font-xs" action="./includes/login.inc.php" method="post">
            <?php
            if (isset($_GET["newpwd"])) {
                if ($_GET["newpwd"] == "passwordupdated") {
                    echo '<p class="success">Your password has been reset!</p><br>';
                }
            }
            ?>

            <label for="mailuid">Username/Email Address :</label><br>
            <input class="field w-40" type="text" name="mailuid"><br>

            <label for="pwd">Password :</label><br>
            <input class="field w-40" type="password" name="pwd"><br>

            <button type="submit" name="login-submit" class="button w-40 font-xs">Login</button><br>
            <a href="reset-password.php" style="display: inline-block;color: #303030; margin:15px;">Forgot your password?</a><br>
            <a href="signUp.php" style="display: inline-block;color: #303030; margin:15px;">Not have an account yet?</a>
        </form>
        <?php
        if (isset($_GET['error'])) {
            if ($_GET['error'] == 'wrongpassword') {
                echo '<p class="signup-error">Wrong password </p>';
            } else if ($_GET['error'] == 'nouserfound') {
                echo '<p class="signup-error">No user found with this username or email address</p>';
            }
        }
        ?>
    </div>
</main>
<?php
require "footer.php";
?>
<!--Yannick Makwenge - E-Commerce-Website-->
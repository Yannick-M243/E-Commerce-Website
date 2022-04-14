<?php
require "header2.php";

?>

<main class="enri">
    <div class="signup-login font-xs">
        <h2 class="font-x2">Create a new Password</h2>
        <?php
        //Grap the selector and validator from the url
        $selector = $_GET['selector'];
        $validator = $_GET['validator'];

        //check if the validator and selector are empty
        if (empty($selector) || empty($validator)) {
            echo '<p class="signup-error">Request could not be validated</p>';
        } else {
            //checking if the token have the proper hexadecimal format
            if (ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false) {
        ?>
                <form action="includes/reset-password.inc.php" method="post">
                    <input class="field w-40" type="hidden" name="selector" value="<?php echo $selector ?>"><br>
                    <input class="field w-40" type="hidden" name="validator" value="<?php echo $validator ?>"><br>
                    <label for="pwd">Enter a new Password :</label><br>
                    <input class="field w-40" type="password" name="pwd"><br>
                    <label for="cpwd">Confirm new Password :</label><br>
                    <input class="field w-40" type="password" name="cpwd"><br>
                    <button type="submit" name="reset-pwd-submit" class="button w-40">Reset Password</button>
                </form>
        <?php

            }
        }
        ?>
    </div>
</main>
<?php
require "footer.php";
?>

<!--Yannick Makwenge - E-Commerce-Website-->
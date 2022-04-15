<?php
require "header2.php";

?>

<main class="enri">
    <section class="container">
    <div class="signup-login font-xs">
        <h2 class="font-x2">Reset Password</h2>
        <form action="includes/reset-request.inc.php" method="POST">
            <label for="mail">Enter your email address to receives instructions on how to reset your password:</label><br>
            <input class="field w-30" type="text" name="mail"><br>
            <button type="submit" name="pwdreset-submit" class="button w-30 font-xs">Send email</button><br>
            <?php
            if (isset($_GET["reset"])) {
                if (($_GET["reset"] == "success")) {
                    echo '<p class="success">Email sent! check your emails.</p> ';
                }
            }
            ?>
        </form>
    </div>
        </section>
</main>
<?php
require "footer.php";
?>
<!--Yannick Makwenge - E-Commerce-Website-->
<?php
require "header2.php";
if (isset($_SESSION['adminId'])) {
?>

    <main class="enri">
        <section>
            <div class="container font-xs">
                <h2 class="font-x2">Add a product</h2>
                <form action="./includes/addProduct.inc.php" method="post" enctype="multipart/form-data">
                    <table class="table">
                        <tr>
                            <td><label for="product-name">Product name:</label></td>
                            <td><input class="field w-70" type="text" name="product-name" id="product-name"></td>
                        </tr>
                        <tr>
                            <td><label for="product-desc">Description :</label></td>
                            <td><input class="field w-70" type="text" name="product-desc" id="product-desc"></td>
                        </tr>
                        <tr>
                            <td><label for="product-price">Price($) :</label></td>
                            <td><input class="field w-70" type="text" name="product-price" id="product-price"></td>
                        </tr>
                        <tr>
                            <td><label for="product-size">Select available sizes (UK)</label></td>
                            <td>
                                <label></label><br>
                                <input type="checkbox" name="size[]" id="size6" value="6">
                                <label for="size7">6 </label>
                                <input class="tab" type="checkbox" name="size[]" id="size65" value="6,5">
                                <label for="size7">6,5 </label>
                                <input class="tab" type="checkbox" name="size[]" id="size7" value="7">
                                <label for="size7">7 </label>
                                <input class="tab" type="checkbox" name="size[]" id="size75" value="7,5">
                                <label for="size7">7,5 </label>
                                <input class="tab" type="checkbox" name="size[]" id="size8" value="8">
                                <label for="size8">8 </label><br>
                                <input type="checkbox" name="size[]" id="size85" value="8,5">
                                <label for="size8">8,5 </label>
                                <input class="tab" type="checkbox" name="size[]" id="size9" value="9">
                                <label for="size9">9 </label>
                                <input class="tab" type="checkbox" name="size[]" id="size95" value="9,5">
                                <label for="size9">9,5 </label>
                                <input class="tab" type="checkbox" name="size[]" id="size10" value="10">
                                <label for="size10">10 </label>
                                <input class="tab" type="checkbox" name="size[]" id="size105" value="10,5">
                                <label for="size10">10,5 </label>
                                <input class="tab" type="checkbox" name="size[]" id="size11" value="11">
                                <label for="size11">11 </label><br>

                                <input type="checkbox" name="size[]" id="sizeXS" value="XS">
                                <label for="sizeXS">XS </label>
                                <input class="tab" type="checkbox" name="size[]" id="sizeS" value="S">
                                <label for="sizeS">S </label>
                                <input class="tab" type="checkbox" name="size[]" id="sizeM" value="M">
                                <label for="sizeM">M </label>
                                <input class="tab" type="checkbox" name="size[]" id="sizeL" value="L">
                                <label for="sizeL">L</label>
                                <input class="tab" type="checkbox" name="size[]" id="sizeXL" value="XL">
                                <label for="sizeXL">XL</label>
                                <input class="tab" type="checkbox" name="size[]" id="sizeXXL" value="XXL">
                                <label for="sizeXXL">XXL</label><br>
                            </td>
                            <!--<input class="field w-40" type="text" name="product-size" id="product-size"><br>-->
                        </tr>
                        <tr>
                            <td><label for="product-image">Product image :</label><br></td>
                            <td><input class="field w-40 file" type="file" name="file" id="file"><br></td>
                        </tr>
                        <tr>
                            <td><button type="submit" name="addProduct-submit" class="button w-40 font-xs" style="height: 45px;">Add a product</button></td>
                        </tr>
                    </table>

                </form>
                <?php
                if (isset($_GET['error'])) {
                    if ($_GET['error'] == 'emptyfields') {
                        echo '<p class="signup-error">Fill in all fields </p>';
                    } elseif ($_GET['error'] == 'toobig') {
                        echo '<p class="signup-error">File is too big</p>';
                    } elseif ($_GET['error'] == 'erroroccured') {
                        echo '<p class="signup-error">An error occured</p>';
                    } elseif ($_GET['error'] == 'notcompatible') {
                        echo '<p class="signup-error">File type not allowed! file type allowed = jpg,jpeg,png</p>';
                    }
                }
                if (isset($_GET['upload'])) {
                    if ($_GET['upload'] == 'success') {
                        echo '<p class="success">File successfully uploaded </p>';
                    }
                }
                ?>
            </div>
        </section>
        <section>

            <div class="container">
                <h2 class="font-x2">Items added</h2>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    <?php

                    include_once 'includes/dbh.inc.php';
                    $sql = "SELECT * FROM `product` ORDER BY `productOrder` DESC";
                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        header("Location: shop2.php?error=sqlerror");
                        exit();
                    } else {
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);

                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                            <div class="col">
                                <form action="includes/addProduct.inc.php" method="POST">
                                    <div class="card shadow-sm"><img src="img/product/<?php echo $row["image"]; ?>" alt="">
                                        <div class="card-body">
                                            <h5><?php echo $row['productName']; ?></h5>
                                            <p class="card-text"><?php echo $row['description']; ?></p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span> Size (UK) :</span>
                                                <span> <?php
                                                        $list = "";
                                                        $list = unserialize($row['size']);
                                                        echo "<select  name='sizes'>";
                                                        foreach ($list as $select => $row1) {
                                                            echo '<option value=' . $row1 . '>' . $row1 . '</option>';
                                                        }
                                                        echo "</select><br>";
                                                        ?></span>
                                            </div>

                                            <input type="hidden" name="hidden-name" value="<?php echo $row["productName"]; ?>">
                                            <input type="hidden" name="hidden-price" value="<?php echo $row["price"] ?>">
                                            <input type="hidden" name="hidden-productNo" value="<?php echo $row["productNo"] ?>">

                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="btn-group">
                                                    <button type="submit" class="btn btn-sm btn-outline-secondary" name="delete">Delete</button>
                                                </div>
                                                <small class="text-muted"><?php echo $row['price'] ?>$</small>
                                            </div>
                                </form>
                            </div>
                </div>
            </div>
    <?php
                        }
                    }
    ?>
        </section>
    </main>
<?php
}
require "footer.php";
?>

<!--Yannick Makwenge - E-Commerce-Website-->
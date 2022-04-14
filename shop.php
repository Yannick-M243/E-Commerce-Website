<?php
require "header2.php";


?>
<main class="enri">
    <h1>Shop</h1>
    <section>

        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <?php

                include_once 'includes/dbh.inc.php';
                $sql = "SELECT * FROM `product` ORDER BY `productOrder` DESC";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: shop.php?error=sqlerror");
                    exit();
                } else {
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);

                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                        <div class="col">
                            <form action="includes/manage-cart.php" method="POST">
                                <div class="card shadow-sm"><img src="img/product/<?php echo $row["image"]; ?>" alt="">
                                    <div class="card-body">
                                        <h5><?php echo $row['productName']; ?></h5>
                                        <p class="card-text"><?php echo $row['description']; ?></p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span> Size (UK):</span>
                                            <span><?php
                                                    $list = "";
                                                    $list = unserialize($row['size']);
                                                    echo "<select  name='sizes'>";
                                                    foreach ($list as $select => $row1) {
                                                        echo '<option value=' . $row1 . '>' . $row1 . '</option>';
                                                    }
                                                    echo "</select><br>";
                                                    ?></span>
                                        </div>
                                        <!--<div class="d-flex justify-content-between align-items-center">
                                                <span>Quantity:</span>
                                                <input style="width: 30px;" type="number" name="quantity" value="1">
                                            </div>-->
                                        <input type="hidden" name="hidden-name" value="<?php echo $row["productName"]; ?>">
                                        <input type="hidden" name="hidden-price" value="<?php echo $row["price"] ?>">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="btn-group">
                                                <button type="submit" class="btn btn-sm btn-outline-secondary" name="add-to-cart">Add to cart</button>
                                                <!--<button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>-->
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
require "footer.php";
?>
<!--Yannick Makwenge - E-Commerce-Website-->
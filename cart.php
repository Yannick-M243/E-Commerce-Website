<?php
require "header2.php";

?>

<main class="enri table-btn">
    <section class="container">
        <table class="table">
            <tr>
                <th width="10%">Item #</th>
                <th width="35%">Item Name</th>
                <th width="10%">Size</th>
                <th width="10%">Price</th>
                <th width="10%">Quantity</th>
                <th width="15%">Total</th>
            </tr>
            <?php
            $total = 0;
            if (isset($_SESSION['cart'])) {

                foreach ($_SESSION['cart'] as $key => $value) {
                    $itemNo = $key + 1;
            ?>
                    <tr>
                        <td><?php echo $itemNo ?></td>
                        <td><?php echo $value["Item_name"]; ?></td>
                        <td><?php echo $value["size"]; ?></td>
                        <td><?php echo $value["price"]; ?>$ <input type="hidden" class="iprice" value="<?php echo $value["price"]; ?>"></td>
                        <td>
                            <form action="includes/manage-cart.php" method="POST">
                                <input class="iquantity" name="mod_quantity" onchange="this.form.submit();" type="number" value="<?php echo $value["quantity"]; ?>" min='1' max='5'>
                                <input type="hidden" name="Item_name" value="<?php echo $value['Item_name']; ?>">
                            </form>
                        </td>
                        <td><span class='itotal'></span>$</td>

                        <form action="includes/manage-cart.php" method="POST">
                            <td><button class="button w-60" name="remove">Remove</button></td>
                            <input type="hidden" name="Item_name" value="<?php echo $value['Item_name']; ?>">
                        </form>
                    </tr>
                <?php
                }
                ?>
                <tr>
                    <td colspan="3">Total</td>
                    <td><span id="gtotal"></span>$</td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>
    <div class="container">
        <?php

        if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
            if (isset($_SESSION['userId'])) {
        ?>
                <div class="payment-method form-group">
                    <h3>Select a method of payment:</h3><br>
                    <input type="radio" class="form-check-input" name="payment-choice" id="cod-method" onclick="showMethod(1)">
                    <label class="form-check-label font-xs" for="cod">Cash On Delivery</label><br>
                    <input type="radio" class="form-check-input" name="payment-choice" id="paypal-method" onclick="showMethod(2)">
                    <label class="form-check-label font-xs" for="paypal">Paypal</label>
                </div>
                <div class="cod container" id="cod" style="display:none;">
                    <form action="includes/purchase.php" method="POST">
                        <table class="table">
                            <tr>
                                <td><label>First name:</label></td>
                                <td><input type="text" name="fName" value="<?php echo $_SESSION["userFirstname"]; ?>" class="form-control" readonly></td>
                            </tr>
                            <tr>
                                <td><label>Surname:</label></td>
                                <td><input type="text" name="lName" value="<?php echo $_SESSION['userLastname']; ?>" class="form-control" readonly></td>
                            </tr>
                            <tr>
                                <td><label>Phone number</label></td>
                                <td><input type="text" name="phone-num" class="form-control"></td>
                            </tr>
                            <tr>
                                <td><label>Address(street name and street number): </label></td>
                                <td><input type="text" name="dAddress" class="form-control"></td>
                            </tr>
                            <tr>
                                <td><label>City:</label></td>
                                <td> <select class="form-control" name="city">
                                        <option>Capetown</option>
                                        <option>johannesburg</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><label>Province:</label></td>
                                <td><select class="form-control" name="province">
                                        <option>Western Cape</option>
                                        <option>Eastern Cape</option>
                                        <option>Gauteng</option>
                                    </select></td>
                            </tr>
                            <tr>
                                <td><label>Zip Code</label></td>
                                <td><input type="text" name="zipCode" class="form-control"></td>
                            </tr>
                            <tr>
                                <td><input type="hidden" name="payment-method" id="payment-method" value="COD">
                                    <button type="submit" name="purchase-submit" class="button w-40">Place order</button>
                                </td>
                            </tr>
                    </form>
                    </table>
                </div>
                <div>
                    <table class="table">
                        <tr>
                            <td>
                                <div class="w-40" id="paypal-payment-button" style="display:none;"></div>
                            </td>
                        </tr>
                    </table>
                </div>
        <?php
                if (isset($_GET['error'])) {
                    if ($_GET['error'] == 'emptyfields') {
                        echo '<p class="signup-error">Fill in all fields </p>';
                    }
                }
            }
        }
        ?>
    </section>
</main>
<script>
    //calculating the total amount according to the quantity and the price
    var gt = 0;
    var iprice = document.getElementsByClassName('iprice');
    var iquantity = document.getElementsByClassName('iquantity');
    var itotal = document.getElementsByClassName('itotal');
    var gtotal = document.getElementById('gtotal');

    function subTotal() {
        gt = 0;
        for (i = 0; i < iprice.length; i++) {
            itotal[i].innerText = (iprice[i].value) * (iquantity[i].value);
            gt = gt + (iprice[i].value) * (iquantity[i].value);
        }
        gtotal.innerText = gt;
    }
    subTotal();
</script>
<script>
    //Hiding and Showing content according to the payment method
    function showMethod(x) {
        if (x == 1) {
            document.getElementById('paypal-payment-button').style.display = 'none';
            document.getElementById('cod').style.display = 'block';
        } else if (x == 2) {
            document.getElementById('cod').style.display = 'none';
            document.getElementById('paypal-payment-button').style.display = 'block';
        }
        return;
    }
</script>
<script src=" https://www.paypal.com/sdk/js?client-id=AeFkVRCYXq6WF8L8AYSXf_Rk3NFEIDR82EvE49JZKZcN_n3BFMuIgM-acUTocRgul9BOJ3lT4G3JXxgT&disable-funding=credit,card">
</script>
<script src="./js/paypal-btn.js"></script>
<?php
require "footer.php";
?>

<!--Yannick Makwenge - E-Commerce-Website-->
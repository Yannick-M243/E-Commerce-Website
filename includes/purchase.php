<?php
session_start();

//ensuring the request method is set to POST 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['purchase-submit'])) {
        require 'dbh.inc.php';

        $fName = $_POST['fName'];
        $lName = $_POST['lName'];
        $deliveryTel = $_POST['phone-num'];
        $address = $_POST['dAddress'];
        $city = $_POST['city'];
        $province = $_POST['province'];
        $zipCode = $_POST['zipCode'];
        $paymentMeth = $_POST['payment-method'];
        $fullName = $fName . " " . $lName;
        $fulladdress = $address . ", " . $city . ", " . $province . ", " . $zipCode;

        if (empty($deliveryTel) || empty($address) || empty($paymentMeth) || empty($zipCode)) {

            header("Location:../cart.php?error=emptyfields");
            exit(); //stop any other operation if fields are empty
        }

        $sql = "INSERT INTO `order_manager`(`fName`, `deliveryTel`, `deliveryAddress`, `pay_method`) VALUES (?,?,?,?)";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../cart.php?error=sqlerror1");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "ssss", $fullName, $deliveryTel, $fulladdress, $paymentMeth);
            mysqli_stmt_execute($stmt);
        }


        $orderId = mysqli_insert_id($conn);
        $sql1 = "INSERT INTO `customer_orders`(`orderId`,`itemName`,`size`, `price`, `quantity`) VALUES (?,?,?,?,?)";
        $stmt1 = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt1, $sql1)) {
            header("Location: ../cart.php?error=sqlerror2");
            exit();
        } else {


            mysqli_stmt_bind_param($stmt1, "issii", $orderId, $item_name, $item_size, $item_price, $item_quantity);
            foreach ($_SESSION['cart'] as $key => $values) {
                $item_name = $values['Item_name'];
                $item_size = $values['size'];
                $item_price = $values['price'];
                $item_quantity = $values['quantity'];
                mysqli_stmt_execute($stmt1);
            }
            unset($_SESSION['cart']);
            echo "<script>
                    alert('Order Placed');
                    window.location.href='../index.php';
                    </script>";
        }
    }
} else {
    header("Location: ../index.php");
    exit();
}

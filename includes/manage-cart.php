<?php
session_start();
//ensuring the request method is set to POST 
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //verifying if the add product button has been clicked
    if (isset($_POST['add-to-cart'])) {
        if (isset($_SESSION['userId'])) {
            //opening a new session called cart for the cart items
            if (isset($_SESSION['cart'])) {
                //checking if a specific item is already added to the cart
                $myItems = array_column($_SESSION['cart'], 'Item_name');
                if (in_array($_POST['hidden-name'], $myItems)) {
                    echo "<script>
                alert('Item Already Added');
                window.location.href='../shop.php';
                </script>";
                } else {
                    //adding multiple items to the cart
                    $count = count($_SESSION['cart']);
                    $_SESSION['cart'][$count] = array('Item_name' => $_POST['hidden-name'], 'price' => $_POST['hidden-price'], 'size' => $_POST['sizes'], 'quantity' => 1);
                    echo "<script>
            alert('Item Added');
            window.location.href='../shop.php';
            </script>";
                }
            } else {
                //if no items has been found in the cart add a new one
                $_SESSION['cart'][0] = array('Item_name' => $_POST['hidden-name'], 'price' => $_POST['hidden-price'], 'size' => $_POST['sizes'], 'quantity' => 1);
                echo "<script>
            alert('Item Added');
            window.location.href='../shop.php';
            </script>";
            }
        } else {
            echo "<script>
            alert('You must login before adding a product');
            window.location.href='../shop.php';
            </script>";
        }
    }

    if (isset($_POST["remove"])) {
        foreach ($_SESSION['cart'] as $key => $value) {
            if ($value['Item_name'] == $_POST['Item_name']) {
                unset($_SESSION['cart'][$key]);
                $_SESSION['cart'] = array_values($_SESSION['cart']);
                echo "<script>
                alert('Item Removed');
                window.location.href='../cart.php';
                </script>";
            }
        }
    }

    if (isset($_POST['mod_quantity'])) {
        foreach ($_SESSION['cart'] as $key => $value) {
            if ($value['Item_name'] == $_POST['Item_name']) {

                $_SESSION['cart'][$key]['quantity'] = $_POST['mod_quantity'];

                echo "<script>
                window.location.href='../cart.php';
                </script>";
            }
        }
    }
}

//Yannick Makwenge - E-Commerce-Website
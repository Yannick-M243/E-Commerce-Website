<?php

//checking if the user clicked on the button "sign up" to get access to this page

if (isset($_POST['addProduct-submit'])) {

    //fetch the information from the addproduct form
    $newFileName = $_POST['product-name'];
    if (empty($newFileName)) {
        $newFileName = "product";
    } else {
        $newFileName = strtolower(str_replace("", "-", $pdtName));
    }

    $pdtName = $_POST['product-name'];
    $pdtImage = $_POST['product-image'];
    $pdtDesc = $_POST['product-desc'];
    $pdtSize = $_POST['size'];
    $pdtPrice = $_POST['product-price'];

    //storing the file details into the variable file
    $file = $_FILES['file'];

    //storing each attribuute of the file into differents variables
    $fileName = $file['name'];
    $fileType = $file['type'];
    $fileTempName = $file['tmp_name'];
    $fileError = $file['error'];
    $fileSize = $file['size'];

    //get the filename extension
    $fileExt = explode(".", $fileName);

    //just keeping the file extension
    $fileActualExt = strtolower(end($fileExt));

    //type of file allowed
    $allowed = array("jpg", "jpeg", "png");

    //check if the file type is allowed
    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 2000000) {
                /*creating a name for the file on the server 
                    and making sure that there is no another 
                    image with the same name using a unique ID*/
                $imageName = $newFileName . "." . uniqID("", true) . "." . $fileActualExt;
                $fileDestination = "../img/product/" . $imageName;

                //connection to the database
                include_once "dbh.inc.php";

                //checking for empty fields
                if (empty($pdtName) || empty($pdtDesc) || empty($pdtSize) || empty($pdtPrice)) {
                    //sending back the user to the add product page with the error "emptyfields"
                    header("Location:../addProduct.php?error=emptyfields");
                    exit(); //stop any other operation if fields are empty
                } else {
                    $sql = "SELECT * FROM product";
                    $stmt = mysqli_stmt_init($conn);

                    //checking if the statment did not get prepared
                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        header("Location: ../addProduct.php?error=sqlerror2");
                        exit();
                    } else {
                        //executing the statement
                        mysqli_stmt_execute($stmt);
                        //storing the result of the statement into result
                        $result = mysqli_stmt_get_result($stmt);
                        //getting the number of rows from the product table
                        $rowCount = mysqli_num_rows($result);

                        $setImageOrder = $rowCount + 1;

                        $convertedArray = serialize($_POST['size']);
                        //storing product into the database
                        $sql = "INSERT INTO `product` (`productName`, `image`, `description`, `size`, `price`, `productOrder`) VALUES (?,?,?,?,?,?)";
                        $stmt = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                            header("Location: ../addProduct.php?error=sqlerror");
                            exit();
                        } else {

                            mysqli_stmt_bind_param($stmt, "ssssss", $pdtName, $imageName, $pdtDesc, $convertedArray, $pdtPrice, $setImageOrder);
                            mysqli_stmt_execute($stmt);

                            move_uploaded_file($fileTempName, $fileDestination);
                            header("Location:../addProduct.php?upload=success");
                            exit();
                        }

                        header("Location:../addProduct.php?upload=success");
                    }
                }
            } else {
                header("Location: ../addProduct.php?error=toobig");
                //echo "File is too big";
                exit();
            }
        } else {
            header("Location: ../addProduct.php?error=erroroccured");
            //echo "An error occured";
            exit();
        }
    } else {
        header("Location: ../addProduct.php?error=notcompatible");
        //echo "File type not allowed! file type allowed = jpg,jpeg,png";
        exit();
    }
} elseif (isset($_POST['delete'])) {

    include_once "dbh.inc.php";

    $productId = $_POST['hidden-productNo'];
    $sql = "DELETE FROM `product` WHERE `product`.`productNo` = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../addProduct.php?error=sqlerror1");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "s", $productId);
        mysqli_stmt_execute($stmt);
        header("Location: ../addProduct.php?delete=success");
        exit();
    }
} else {
    //redirect the admin to the index page add product is not set 
    header("Location: ../index.php");
    exit();
}

//Yannick Makwenge - E-Commerce-Website
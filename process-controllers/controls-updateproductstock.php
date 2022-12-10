<?php
session_start();
$conn = require '../database/connection.php';

    //directory for saving image file
    $ImageSavePath = "../ProductImages/";
    $ImageFile = $ImageSavePath . basename($_FILES["Edit-ProductImageFile"]["name"]);
    $ImageFileType = strtolower(pathinfo($ImageFile,PATHINFO_EXTENSION));

    //getting input values from the form
    $addstock = $_POST['EditInventory-AddProductStock'];

    //Getting the productID from URL
    $ProductID = $_SESSION['prdctid'];

    //Query for getting the specific product details
    $getProductExecution = mysqli_query($conn, "SELECT * FROM product WHERE ProductID='$ProductID'");
    $getProductResult = mysqli_fetch_assoc($getProductExecution);


    if(isset($_POST["updateproductinventorybtn"])) {
            //checking if the inputted stock count is not less than 0
            if ($addstock <= 0){
                $_SESSION['EditProductInventory-Status'] = "Stocks to be added must be greater than zero.";
                header("Location: ../admin/admin-editproductinventory.php?prdctid=".$ProductID);
                exit();
            }
            else {
                $CurrentStock = $getProductResult['CurrentStockCount'] + $addstock; //computing for total current stock by adding the inputed value to be added on stock

                $UpdateStockQuery = "UPDATE product SET
                                    LastAddedStockCount = '$addstock', CurrentStockCount = '$CurrentStock'
                                    WHERE ProductID='$ProductID'";

                if (mysqli_query($conn,$UpdateStockQuery)){
                    $_SESSION['EditProductInventory-Status'] = "Product stock count has been updated.";
                    header("Location: ../admin/admin-editproductinventory.php?prdctid=".$ProductID);
                    exit();
                }
                else {
                    $_SESSION['EditProductInventory-Status'] = "An error has occurred in adding product stock.";
                    header("Location: ../admin/admin-editproductinventory.php?prdctid=".$ProductID);
                    exit();
                }
            }

    }
    else {
        $_SESSION['EditProductInventory-Status'] = "Page has been reloaded.";
        header("Location: ../admin/admin-editproductinventory.php?prdctid=".$ProductID);
        exit();
    }
    ?>


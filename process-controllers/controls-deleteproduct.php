<?php
session_start();
$conn = require '../database/connection.php';

    //getting the product ID from URL parameter
    $ProductID = $_GET['prdctid'];

    if (($ProductID == null || $ProductID == "") || !isset($_SESSION['prdctid'])){
        $_SESSION['AddProduct-Status'] = "No product selected.";
        header("Location: ../admin/admin-products.php");
        exit();
    }

    //getting the product details
    $GetProductQuery = "SELECT * FROM product WHERE ProductID='$ProductID'";
    $GetProductQueryExecution = mysqli_query($conn, $GetProductQuery);
    $GetProductResult = mysqli_fetch_assoc($GetProductQueryExecution);

    //Product Image URL
    $ProductImageURL = $GetProductResult['ProductImageURL'];

    if (unlink($ProductImageURL)){
        $DeleteProductDetailsQuery = "DELETE FROM product WHERE ProductID='$ProductID'";

        //deleting the product details
        if (mysqli_query($conn, $DeleteProductDetailsQuery)){
            $DeleteProductRatingDetailsQuery = "DELETE FROM rating WHERE ProductID='$ProductID'";

            //deleting product rating details
            if(mysqli_query($conn, $DeleteProductRatingDetailsQuery)){
                $_SESSION['AddProduct-Status'] = "Product has been deleted.";
                header("Location: ../admin/admin-products.php");
                exit();
            }
            else {
                $_SESSION['EditProduct-Status'] = "A problem occurred in deleting the product details.";
                header("Location: ../admin/admin-editproduct.php?prdctid=".$ProductID);
                exit();
            }
        }
        else {
            $_SESSION['EditProduct-Status'] = "A problem occurred in deleting the product details.";
            header("Location: ../admin/admin-editproduct.php?prdctid=".$ProductID);
            exit();
        }
    }
    else {
        $_SESSION['EditProduct-Status'] = "A problem occurred in deleting the product image.";
        header("Location: ../admin/admin-editproduct.php?prdctid=".$ProductID);
        exit();
    }
    ?>


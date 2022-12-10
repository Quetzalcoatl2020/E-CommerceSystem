<?php
session_start();
$conn = require '../database/connection.php';

    //directory for saving image file
    $ImageSavePath = "../ProductImages/";
    $ImageFile = $ImageSavePath . basename($_FILES["ProductImageFile"]["name"]);
    $ImageFileType = strtolower(pathinfo($ImageFile,PATHINFO_EXTENSION));

    //getting input values from the form
    $productname = trim($_POST['ProductName']);
    $productcategory = $_POST['ProductCategoryDropdown'];
    $productprice = $_POST['ProductPrice'];
    $productdescription = $_POST['ProductDescription'];


    // Check if image file is an actual image
    if(isset($_POST["submit"])) {
        $checkImage = getimagesize($_FILES["ProductImageFile"]["tmp_name"]);
        if($checkImage !== false) {

            // Check image file size
            if ($_FILES["ProductImageFile"]["size"] > 1000000) {
                $_SESSION['AddProduct-Status'] = "Image file size should be less than 1mb.";
                header("Location: ../admin/admin-products.php");
                exit();
            }

            // Check the image file extensions
            if($ImageFileType != "jpg" && $ImageFileType != "png" && $ImageFileType != "jpeg") {
                $_SESSION['AddProduct-Status'] = "The allowed image types are JPG/JPEG and PNG only.";
                header("Location: ../admin/admin-products.php");
                exit();
            }

            // Checking if the category was set
            if ($productcategory == 0){
                $_SESSION['AddProduct-Status'] = "Please choose a product category.";
                header("Location: ../admin/admin-products.php");
                exit();
            }

            if ($productname != "" && $productprice > 0 && $productdescription != "") {
                if(move_uploaded_file($_FILES["ProductImageFile"]["tmp_name"], $ImageFile)){ //uploading the image

                    //getting the products with the same category/SKU tag inputted by the user
                    $getProductSKUQuery = "SELECT * FROM product WHERE CategoryID='$productcategory' ORDER BY SKU_Number DESC LIMIT 1";
                    $getProductSKUQueryExecution = mysqli_query($conn, $getProductSKUQuery);
                    $getProductSKUQueryResult = mysqli_fetch_assoc($getProductSKUQueryExecution);

                    //getting the category details of the product to be added
                    $getProductCategoryQuery = "SELECT * FROM category WHERE CategoryID='$productcategory'";
                    $getProductCategoryQueryExecution = mysqli_query($conn, $getProductCategoryQuery);
                    $getProductCategoryQueryResult = mysqli_fetch_assoc($getProductCategoryQueryExecution);


                    if($getProductSKUQueryResult != null){
                        $SKU_Number = $getProductSKUQueryResult['SKU_Number'] + 1;

                        if ($SKU_Number <= 9) {
                            $ProductSKU = $getProductCategoryQueryResult['CategoryCodeForSKU']."0000".$SKU_Number;
                        }
                        else if ($SKU_Number <= 99) {
                            $ProductSKU = $getProductCategoryQueryResult['CategoryCodeForSKU']."000".$SKU_Number;
                        }
                        else if ($SKU_Number <= 999) {
                            $ProductSKU = $getProductCategoryQueryResult['CategoryCodeForSKU']."00".$SKU_Number;
                        }
                        else if ($SKU_Number <= 9999) {
                            $ProductSKU = $getProductCategoryQueryResult['CategoryCodeForSKU']."0".$SKU_Number;
                        }
                        else if ($SKU_Number <= 99999) {
                            $ProductSKU = $getProductCategoryQueryResult['CategoryCodeForSKU'].$SKU_Number;
                        }

                    }
                    else {
                        $SKU_Number = 1;
                        $ProductSKU = $getProductCategoryQueryResult['CategoryCodeForSKU']."00001";
                    }

                    //inserting the product details
                    $AddProductQuery = "INSERT INTO product 
                        (CategoryID,RatingID,ProductName, Description, SKU, SKU_Number, PricePerUnit,LastAddedStockCount,CurrentStockCount,UnitsInOrder,ProductStatus,ProductImageURL)
                        VALUES
                        ('$productcategory',0,'$productname','$productdescription','$ProductSKU','$SKU_Number','$productprice',0,0,0,'Inactive','')";

                    if(mysqli_query($conn, $AddProductQuery)){
                        //getting the details of the last product in the list, which is the newly inserted product
                        $getProductExecution = mysqli_query($conn, "SELECT * FROM product ORDER BY ProductID DESC LIMIT 1");
                        $getProductResult = mysqli_fetch_assoc($getProductExecution);
                        $ProductID = $getProductResult['ProductID'];

                        //changing the name of the image
                        $NewImageName = $ImageSavePath.$ProductID."-".$productname.".".$ImageFileType;
                        rename($ImageFile, $NewImageName);

                        //creating the rating details for the product
                        $RatingQuery = "INSERT INTO rating (ProductID,RateOne,RateTwo,RateThree,RateFour,RateFive,AverageRating) 
                                        VALUES 
                                        ('$ProductID',0,0,0,0,0,0)";
                        $RatingQueryExecution = mysqli_query($conn, $RatingQuery);

                        //getting the rating details
                        $getRatingExecution = mysqli_query($conn, "SELECT * FROM rating ORDER BY RatingID DESC LIMIT 1");
                        $getRatingResult = mysqli_fetch_assoc($getRatingExecution);
                        $RatingID = $getRatingResult['RatingID'];

                        //Updating rating ID of the product
                        $UpdateProductQuery = "UPDATE product SET RatingID='$RatingID', ProductImageURL='$NewImageName' WHERE ProductID='$ProductID'";
                        $UpdateProductExecution = mysqli_query($conn, $UpdateProductQuery);

                        $_SESSION['AddProduct-Status'] = "Product successfully added.";
                        header("Location: ../admin/admin-products.php");
                        exit();
                    }
                    else {
                        $_SESSION['AddProduct-Status'] = "An error has occurred in adding the product.";
                        header("Location: ../admin/admin-products.php");
                        exit();
                    }
                }
            }
            else {
                $_SESSION['AddProduct-Status'] = "Incomplete product information.";
                header("Location: ../admin/admin-products.php");
                exit();
            }

        } else {
            $_SESSION['AddProduct-Status'] = "The file you uploaded is not an image.";
            header("Location: ../admin/admin-products.php");
            exit();
        }
    }
    ?>


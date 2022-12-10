<?php
session_start();
$conn = require '../database/connection.php';

    //directory for saving image file
    $ImageSavePath = "../ProductImages/";
    $ImageFile = $ImageSavePath . basename($_FILES["Edit-ProductImageFile"]["name"]);
    $ImageFileType = strtolower(pathinfo($ImageFile,PATHINFO_EXTENSION));

    //getting input values from the form
    $productname = trim($_POST['Edit-ProductName']);
    $productprice = $_POST['Edit-ProductPrice'];
    $productdescription = $_POST['Edit-ProductDescription'];
    $productstatus = $_POST['Edit-ProductStatusDropdown'];

    //Getting the productID from session
    $ProductID = $_SESSION['prdctid'];

    //Query for getting the specific product details
    $getProductExecution = mysqli_query($conn, "SELECT * FROM product WHERE ProductID='$ProductID'");
    $getProductResult = mysqli_fetch_assoc($getProductExecution);


    if(isset($_POST["updateproductbtn"])) {
            //checking if product name and description is not empty and product price is not less than 0
            if ($productname != "" && $productprice > 0 && $productdescription != "") {
                //checking if there's a newly uploaded image
                if ($_FILES["Edit-ProductImageFile"]["name"] != null){
                    $checkImage = getimagesize($_FILES["Edit-ProductImageFile"]["tmp_name"]);

                    // Check image file size
                    if ($_FILES["Edit-ProductImageFile"]["size"] > 500000) {
                        $_SESSION['EditProduct-Status'] = "Image file size should be less than 500kb.";
                        header("Location: ../admin/admin-editproduct.php?prdctid=".$ProductID);
                        exit();
                    }

                    // Check the image file extensions
                    if($ImageFileType != "jpg" && $ImageFileType != "png" && $ImageFileType != "jpeg") {
                        $_SESSION['EditProduct-Status'] = "The allowed image types are JPG/JPEG and PNG only.";
                        header("Location: ../admin/admin-editproduct.php?prdctid=".$ProductID);
                        exit();
                    }

                    //Unlinking (deleting) previous image file
                    $ProductImageURL = $getProductResult['ProductImageURL'];
                    if(unlink($ProductImageURL)){
                        if(move_uploaded_file($_FILES["Edit-ProductImageFile"]["tmp_name"], $ImageFile)){ //uploading the image

                            //changing the name of the newly uploaded image
                            $NewImageName = $ImageSavePath.$ProductID."-".$productname.".".$ImageFileType;
                            rename($ImageFile, $NewImageName);

                            //updating the product details
                            $EditProductQuery = "UPDATE product SET
                            ProductName='$productname', Description='$productdescription', ProductStatus = '$productstatus', PricePerUnit = '$productprice', ProductImageURl='$NewImageName' WHERE ProductID='$ProductID'
                            ";

                            //update query execution
                            if(mysqli_query($conn, $EditProductQuery)){
                                $_SESSION['EditProduct-Status'] = "Product successfully updated.";
                                header("Location: ../admin/admin-editproduct.php?prdctid=".$ProductID);
                                exit();
                            }
                            else {
                                $_SESSION['EditProduct-Status'] = "An error has occurred in updating the product.";
                                header("Location: ../admin/admin-editproduct.php?prdctid=".$ProductID);
                                exit();
                            }
                        }
                        else {
                            $_SESSION['EditProduct-Status'] = "An error has occurred in uploading the new product image.";
                            header("Location: ../admin/admin-editproduct.php?prdctid=".$ProductID);
                            exit();
                        }
                    }
                    else {
                        $_SESSION['EditProduct-Status'] = "An error has occurred in deleting the previous product image.";
                        header("Location: ../admin/admin-editproduct.php?prdctid=".$ProductID);
                        exit();
                    }
                }
                else {
                    //updating the product details
                    $EditProductQuery = "UPDATE product SET
                        ProductName='$productname', Description='$productdescription', ProductStatus = '$productstatus', PricePerUnit = '$productprice' WHERE ProductID='$ProductID'
                        ";

                    if(mysqli_query($conn, $EditProductQuery)){
                        $_SESSION['EditProduct-Status'] = "Product successfully updated.";
                        header("Location: ../admin/admin-editproduct.php?prdctid=".$ProductID);
                        exit();
                    }
                    else {
                        $_SESSION['EditProduct-Status'] = "An error has occurred in updating the product.";
                        header("Location: ../admin/admin-editproduct.php?prdctid=".$ProductID);
                        exit();
                    }
                }
            }
            else {
                $_SESSION['EditProduct-Status'] = "Incomplete product information.";
                header("Location: ../admin/admin-editproduct.php?prdctid=".$ProductID);
                exit();
            }
    }
    else {
        $_SESSION['EditProduct-Status'] = "Page has been reloaded.";
        header("Location: ../admin/admin-editproduct.php?prdctid=".$ProductID);
        exit();
    }
    ?>


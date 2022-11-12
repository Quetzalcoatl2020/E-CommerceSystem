<?php
session_start();
$conn = require '../database/connection.php';

    //getting input values from the form
    $categoryname = $_POST['CategoryName'];
    $categorycode = strtoupper($_POST['CategoryCode']);

    // RegEx for category code
    $categorycoderegex = '/^[A-Z]*$/';

    //getting all the existing category name based on the inputted category name
    $CategoryNameQuery = "SELECT * FROM category WHERE CategoryName='$categoryname'";
    $CategoryNameQueryExecution = mysqli_query($conn, $CategoryNameQuery);
    $CategoryNameQueryResult= mysqli_fetch_assoc($CategoryNameQueryExecution);

    //getting all the existing category code based on the inputted category code
    $CategoryCodeQuery = "SELECT * FROM category WHERE CategoryCodeForSKU='$categorycode'";
    $CategoryCodeQueryExecution = mysqli_query($conn, $CategoryCodeQuery);
    $CategoryCodeQueryResult= mysqli_fetch_assoc($CategoryCodeQueryExecution);


    if ($categoryname != "" && $categorycode != "") {
        if($CategoryNameQueryResult == null ){ // checking if there is an existing category name based in the inputted category name
            if($CategoryCodeQueryResult == null){ // checking if there is an existing category code based in the inputted category code
                if(preg_match($categorycoderegex, $categorycode)){ //checking if the category code only contains letters
                    if(strlen($categorycode) == 3) {  //checking if the category code is 3-characters long
                        $InsertCategoryQuery = "INSERT INTO category (CategoryName, CategoryCodeForSKU) VALUES ('$categoryname','$categorycode')";
                        $InsertCategoryQueryExecution = mysqli_query($conn,$InsertCategoryQuery);
                        $_SESSION['AddCategory-Status'] = "New category has been added.";
                        header("Location: ../admin/admin-products.php");
                        exit();
                    }
                    else {
                        $_SESSION['AddCategory-Status'] = "Category code must be exactly 3 letters.";
                        header("Location: ../admin/admin-products.php");
                        exit();
                    }
                }
                else {
                    $_SESSION['AddCategory-Status'] = "Category code must contain letters only.";
                    header("Location: ../admin/admin-products.php");
                    exit();
                }
            }
            else {
                $_SESSION['AddCategory-Status'] = "The category code you entered is already existing.";
                header("Location: ../admin/admin-products.php");
                exit();
            }
        }
        else {
            $_SESSION['AddCategory-Status'] = "The category name you entered is already existing.";
            header("Location: ../admin/admin-products.php");
            exit();
        }


    }
    else {
        $_SESSION['AddCategory-Status'] = "Incomplete inputs. Category not added.";
        header("Location: ../admin/admin-products.php");

    }
    ?>


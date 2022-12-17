<?php
session_start();
$conn = require '../database/connection.php';

    //getting the dropdown filter values
    $CategoryFilter = $_POST['UserView-ProductCategoryFilter'];
    $PriceFilter = $_POST['UserView-ProductPriceFilter'];

    $_SESSION['CategoryFilter'] = $CategoryFilter;
    $_SESSION['PriceFilter'] = $PriceFilter;
    header('Location: ../user/homepage.php');
?>
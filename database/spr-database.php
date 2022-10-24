<?php
$servername = "localhost";
$username = "root";
$password = "";

    // Creating connection
    $conn = mysqli_connect($servername, $username, $password);

    // Checking connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Creating the database for Shoppr
    $sql = "CREATE DATABASE IF NOT EXISTS shopprDB";
    if (mysqli_query($conn, $sql)) {
        //no arg
    } else {
        echo "Error creating database: " . mysqli_error($conn);
    }

    //refresh connection to connect to the created database
    mysqli_close($conn);
    $databasename = "shopprDB";

    $newConn = mysqli_connect($servername,$username,$password,$databasename);
    // Checking new connection
    if (!$newConn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    //-----------------CREATING DATABASE TABLES-----------------//

    //Users Table
    $UserTableQuery = "CREATE TABLE IF NOT EXISTS User
    (
        UserID INT(254) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
        FirstName VARCHAR(50) NOT NULL, 
        LastName VARCHAR(50) NOT NULL,
        Email VARCHAR(100) NOT NULL,
        Address VARCHAR(254) NOT NULL,
        Password VARCHAR(254) NOT NULL,
        PhoneNumber INT(11),
        PostalCode INT(4)
    )";

    //Category Table
    $CategoryTableQuery = "CREATE TABLE IF NOT EXISTS Category
        (
            CategoryID INT(254) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
            CategoryName VARCHAR(50) NOT NULL
        )";

    //Product Table
    $ProductTableQuery = "CREATE TABLE IF NOT EXISTS Product
        (
            ProductID INT(254) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            CategoryID INT (254) NOT NULL,
            RatingID INT(254) NOT NULL, 
            ProductName VARCHAR(100) NOT NULL,
            Description VARCHAR(254) NOT NULL,
            SKU VARCHAR(254) NOT NULL,
            PricePerUnit INT(10) NOT NULL,
            LastAddedStockCount INT(10) NOT NULL,
            CurrentStockCount INT(10) NOT NULL,
            UnitsInOrder INT(10) NOT NULL,
            ProductStatus VARCHAR(20) NOT NULL,
            ProductImageURL VARCHAR(254) NOT NULL
            )";

    //Rating Table
    $RatingTableQuery = "CREATE TABLE IF NOT EXISTS Rating
            (
            RatingID INT(254) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            ProductID INT (254) NOT NULL,
            RateOne INT(254) NOT NULL,
            RateTwo INT(254) NOT NULL,
            RateThree INT(254) NOT NULL,
            RateFour INT(254) NOT NULL,
            RateFive INT(254) NOT NULL,
            AverageRating INT(1) NOT NULL
            )";

    //Orders Table
    $OrdersTableQuery = "CREATE TABLE IF NOT EXISTS Orders
            (
            OrderID INT(254) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            ProductID INT (254) NOT NULL,
            ShipmentID INT (254) NOT NULL,
            PaymentID INT (254) NOT NULL,
            UserID INT(254) NOT NULL,
            Quantity INT(254) NOT NULL,
            TotalAmount INT(254) NOT NULL,
            OrderDate VARCHAR(254) NOT NULL,
            OrderStatus VARCHAR(254) NOT NULL,
            Discount INT(254)                     
            )";

    //Shipment Table
    $ShipmentTableQuery = "CREATE TABLE IF NOT EXISTS Shipment
             (
            ShipmentID INT(254) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            OrderID INT (254) NOT NULL,
            ShipmentStatus VARCHAR(50) NOT NULL,
            Track VARCHAR(254) NOT NULL                  
            )";

    //Payment Table
    $PaymentTableQuery = "CREATE TABLE IF NOT EXISTS Payment
             (
            PaymentID INT(254) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            OrderID INT (254) NOT NULL,
            PaymentMode VARCHAR(50) NOT NULL,
            PaymentStatus VARCHAR(254) NOT NULL                  
            )";

    //---Queries for table creation---//
    if (mysqli_query($newConn, $UserTableQuery)) { //User table query execution
        //no arg
    } else {
        echo "Error creating User table: " . mysqli_error($newConn);
    }

    if (mysqli_query($newConn, $CategoryTableQuery)) { //Category table query execution
        //no arg
    } else {
        echo "Error creating Category table: " . mysqli_error($newConn);
    }

    if (mysqli_query($newConn, $ProductTableQuery)) { //Product table query execution
        //no arg
    } else {
        echo "Error creating Product table: " . mysqli_error($newConn);
    }

    if (mysqli_query($newConn, $RatingTableQuery)) { //Rating table query execution
        //no arg
    } else {
        echo "Error creating Rating table: " . mysqli_error($newConn);
    }

    if (mysqli_query($newConn, $OrdersTableQuery)) { //Orders table query execution
        //no arg
    } else {
        echo "Error creating Orders table: " . mysqli_error($newConn);
    }

    if (mysqli_query($newConn, $ShipmentTableQuery)) { //Shipment table query execution
        //no arg
    } else {
        echo "Error creating Shipment table: " . mysqli_error($newConn);
    }

    if (mysqli_query($newConn, $PaymentTableQuery)) { //Payment table query execution
        //no arg
    } else {
        echo "Error creating Payment table: " . mysqli_error($newConn);
    }
?>
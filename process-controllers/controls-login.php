<?php
session_start();
$conn = require '../database/connection.php';

    //getting input values from login form
    $email = $_POST['Email'];
    $password1 = $_POST['Password1'];

    $UserAccountQuery="SELECT * FROM user WHERE Email='$email' LIMIT 1";
    //Query Execution
    $UserAccountAuth = mysqli_query($conn,$UserAccountQuery);
    //converting mysqli result into string
    $UserAccountDetails = mysqli_fetch_assoc($UserAccountAuth);

    //Account Authentication
    if ($UserAccountDetails != null){
        $EncryptedPassword = $UserAccountDetails['Password'];

        //comparing inputted password and decrypted password from database
        if (password_verify($password1, $EncryptedPassword)) {
            $_SESSION['UserID'] = $UserAccountDetails['UserID'];
            header("Location: ../user-profile.php");
        }
        else {
            $_SESSION['Login_Error'] = "Incorrect password.";
            header("Location: ../index.php");
        }
    }
    else {
        $_SESSION['Login_Error'] = "Your email does not match any accounts in the system.";
        header("Location: ../index.php");
    }
    ?>
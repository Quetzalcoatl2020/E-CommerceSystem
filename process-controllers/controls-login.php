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
            //checking the user's access level
            if ($UserAccountDetails['SuperUser'] == 0){
                $_SESSION['UserID'] = $UserAccountDetails['UserID'];
                header("Location: ../user/homepage.php");
                exit();
            }
            else if($UserAccountDetails['SuperUser'] > 0){
                if ($UserAccountDetails['SuperUser'] == 2){
                    $_SESSION['Login_Error'] = "Your account has been disabled. Contact the administrator.";
                    header("Location: ../index.php");
                    exit();
                }else {
                    $_SESSION['UserID'] = $UserAccountDetails['UserID'];
                    header("Location: ../admin/admin-products.php");
                    exit();
                }
            }

        }
        else {
            $_SESSION['Login_Error'] = "Incorrect password.";
            header("Location: ../index.php");
            exit();
        }
    }
    else {
        $_SESSION['Login_Error'] = "Your email does not match any accounts in the system.";
        header("Location: ../index.php");
        exit();
    }
    ?>
<?php
session_start();
$conn = require '../database/connection.php';

    //getting the user ID from URL parameter
    $UID_Delete = $_GET['uid'];
    if (($UID_Delete == null || $UID_Delete == "") || !isset($_SESSION['uid-edit'])){
        $_SESSION['DeleteAccount-Status'] = "No account selected";
        header("Location: ../admin/admin-accountmanagement.php");
        exit();
    }
    else {
        echo "true";
        //getting the current user
        $CurrentUserUID = $_SESSION['UserID'];

        $GetCurrentUserQuery = "SELECT * FROM user WHERE UserID='$CurrentUserUID' AND SuperUser>0";
        $GetCurrentUserQueryExecution = mysqli_query($conn, $GetCurrentUserQuery);
        $GetCurrentUserResult = mysqli_fetch_assoc($GetCurrentUserQueryExecution);

        //checking if the current user is a super administrator
        if ($GetCurrentUserResult['SuperUser'] != 5){
            $_SESSION['EditAccount-Status'] = "Only a super administrator can delete other administrator accounts.";
            header("Location: ../admin/admin-editadminaccount.php?uid=".$UID_Delete);
            exit();
        }
        else {
            //getting the account details to be deleted
            $GetAccountQuery = "SELECT * FROM user WHERE UserID='$UID_Delete' AND SuperUser>0";
            $GetAccountQueryExecution = mysqli_query($conn, $GetAccountQuery);
            $GetAccountResult = mysqli_fetch_assoc($GetAccountQueryExecution);

            //checking if the account to be deleted is a super admin account
            if ($GetAccountResult['SuperUser'] == 5){
                $_SESSION['EditAccount-Status'] = "Super administrator accounts cannot be deleted.";
                header("Location: ../admin/admin-editadminaccount.php?uid=".$UID_Delete);
                exit();
            }
            else {
                $DeleteAccountQuery = "DELETE FROM user WHERE UserID='$UID_Delete'";
                if(mysqli_query($conn, $DeleteAccountQuery)){
                    $_SESSION['DeleteAccount-Status'] = "Account has been deleted.";
                    header("Location: ../admin/admin-accountmanagement.php");
                    exit();
                }
            }
        }
    }

    ?>


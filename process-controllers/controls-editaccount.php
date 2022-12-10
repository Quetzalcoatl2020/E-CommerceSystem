<?php
session_start();
$conn = require '../database/connection.php';



    //getting input values from the form
    $fname = trim($_POST['FirstName']);
    $lname = trim($_POST['LastName']);
    $email = trim($_POST['Email']);
    $accountstatus = $_POST['Edit-AccountStatusDropdown'];


    //Getting the userID from URL
    $UserID = $_SESSION['uid-edit'];
    $CurrentUser = $_SESSION['UserID'];

    if ($accountstatus == 2) {
        if ($UserID == $CurrentUser) {
            $_SESSION['EditAccount-Status'] = "You cannot disable your own account.";
            header("Location: ../admin/admin-editadminaccount.php?uid=".$_SESSION['uid-edit']);
            exit();
        }
    }

    //Getting user details
    $GetAccountQuery = "SELECT * FROM user WHERE UserID='$UserID' AND SuperUser>0";
    $GetAccountQueryExecution = mysqli_query($conn, $GetAccountQuery);
    $GetAccountResult = mysqli_fetch_assoc($GetAccountQueryExecution);

    $EmailFilter="SELECT * FROM user WHERE Email='$email' && UserID<>'$UserID' LIMIT 1";
    $EmailFilterQuery = mysqli_query($conn, $EmailFilter);
    $EmailFilterResult = mysqli_fetch_assoc($EmailFilterQuery);

    if (isset($_POST['Password1']) && ($_POST['Password1'] != "" || $_POST['Password1'] != null)){ //if user also wants to change account password
        $currentpass = $_POST['Password1'];
        $newpass = $_POST['Password2'];

        if ($newpass != "" && $newpass != null && isset($newpass)) {
            //name check
            if($fname != ""){
                if (strlen($fname) < 2 || !preg_match("/^([a-zA-Z ]+)$/",$fname)){
                    $_SESSION['EditAccount-Status'] = "Follow correct name format.";
                    header("Location: ../admin/admin-editadminaccount.php");
                    exit();
                }
            }
            else {
                $_SESSION['EditAccount-Status'] = "Input your last name.";
                header("Location: ../admin/admin-editadminaccount.php");
                exit();
            }
            if($lname != ""){
                if (strlen($lname) < 2 || !preg_match("/^([a-zA-Z ]+)$/",$lname)){
                    $_SESSION['EditAccount-Status'] = "Follow correct name format.";
                    header("Location: ../admin/admin-editadminaccount.php");
                    exit();
                }
            }
            else {
                $_SESSION['EditAccount-Status'] = "Input your first name.";
                header("Location: ../admin/admin-editadminaccount.php");
                exit();
            }

            //email check
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { //verification of email format
                $_SESSION['EditAccount-Status'] = "Invalid email format";
                header("Location: ../admin/admin-editadminaccount.php");
                exit();
            }
            if ($EmailFilterResult != null){ //checking of email duplication
                $_SESSION['EditAccount-Status'] = "Email is already in use";
                header("Location: ../admin/admin-editadminaccount.php");
                exit();
            }

            //password check
            $EncryptedPassword = $GetAccountResult['Password'];

            //decrypting current password (raw password text)
            $DecryptedPassword = password_verify($currentpass, $EncryptedPassword);

            if ($currentpass == $newpass){
                $_SESSION['EditAccount-Status'] = "New password is same with your current password.";
                header("Location: ../admin/admin-editadminaccount.php?uid=".$UserID);
                exit();
            }
            if ($DecryptedPassword) {
                //password pattern validation
                $letters = preg_match('@[a-zA-Z]@', $newpass);
                $numbers = preg_match('@[0-9]@', $newpass);
                $specialchars = preg_match('/\W/', $newpass);

                if ($letters && $numbers && $specialchars && strlen($newpass) >= 8){

                    //Encryption of user password
                    $hashedPassword = password_hash($newpass , PASSWORD_DEFAULT);

                    //Putting user info on query
                    $UpdateAccountQuery = "UPDATE users SET 
                    FirstName = '$fname', LastName = '$lname',Email = '$email', Password = '$hashedPassword', SuperUser = '$accountstatus' 
                    WHERE UserID = '$UserID'";

                    //query execution
                    if (mysqli_query($conn,$UpdateAccountQuery)){
                        $_SESSION['EditAccount-Status'] = "Account updated successfully.";
                        header("Location: ../admin/admin-editadminaccount.php?uid=".$UserID);
                        exit();
                    }
                    else {
                        $_SESSION['EditAccount-Status'] = "An error has occurred in updating the account.";
                        header("Location: ../admin/admin-editadminaccount.php?uid=".$UserID);
                        exit();
                    }

                }
                else {
                    $_SESSION['EditAccount-Status'] = "Follow correct password format.";
                    header("Location: ../admin/admin-editadminaccount.php?uid=".$UserID);
                    exit();
                }
            }
            else {
                $_SESSION['EditAccount-Status'] = "The current password you entered is incorrect.";
                header("Location: ../admin/admin-editadminaccount.php?uid=".$UserID);
                exit();
            }
        }
        else {
            $_SESSION['EditAccount-Status'] = "Please input new password.";
            header("Location: ../admin/admin-editadminaccount.php?uid=".$UserID);
            exit();
        }
    }
    else { //if user is not changing the password
        //name check
        if($fname != ""){
            if (strlen($fname) < 2 || !preg_match("/^([a-zA-Z ]+)$/",$fname)){
                $_SESSION['EditAccount-Status'] = "Follow correct name format.";
                header("Location: ../admin/admin-editadminaccount.php?uid=".$UserID);
                exit();
            }
        }
        else {
            $_SESSION['EditAccount-Status'] = "Input your last name.";
            header("Location: ../admin/admin-editadminaccount.php?uid=".$UserID);
            exit();
        }
        if($lname != ""){
            if (strlen($lname) < 2 || !preg_match("/^([a-zA-Z ]+)$/",$lname)){
                $_SESSION['EditAccount-Status'] = "Follow correct name format.";
                header("Location: ../admin/admin-editadminaccount.php?uid=".$UserID);
                exit();
            }
        }
        else {
            $_SESSION['EditAccount-Status'] = "Input your first name.";
            header("Location: ../admin/admin-editadminaccount.php?uid=".$UserID);
            exit();
        }

        //email check
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { //verification of email format
            $_SESSION['EditAccount-Status'] = "Invalid email format";
            header("Location: ../admin/admin-editadminaccount.php?uid=".$UserID);
            exit();
        }
        if ($EmailFilterResult != null){ //checking of email duplication
            $_SESSION['EditAccount-Status'] = "Email is already in use";
            header("Location: ../admin/admin-editadminaccount.php?uid=".$UserID);
            exit();
        }

        //Putting user info on query
        $UpdateAccountQuery = "UPDATE user SET 
                    FirstName = '$fname', LastName = '$lname',Email = '$email', SuperUser = '$accountstatus' 
                    WHERE UserID = '$UserID'";

        //query execution
        if (mysqli_query($conn,$UpdateAccountQuery)){
            $_SESSION['EditAccount-Status'] = "Account updated successfully.";
            header("Location: ../admin/admin-editadminaccount.php?uid=".$UserID);
            exit();
        }
        else {
            $_SESSION['EditAccount-Status'] = "An error has occurred in updating the account.";
            header("Location: ../admin/admin-editadminaccount.php?uid=".$UserID);
            exit();
        }
    }

    ?>


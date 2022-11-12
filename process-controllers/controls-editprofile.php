<?php
session_start();
$conn = require '../database/connection.php';

    //getting input values from edit profile form
    $firstname = ucfirst(mysqli_real_escape_string($conn,$_POST['FirstName']));
    $lastname = ucfirst(mysqli_real_escape_string($conn,$_POST['LastName']));
    $email = $_POST['Email'];
    $address = $_POST['Address'];
    $postalcode = $_POST['ZipCode'];
    $phonenumber = $_POST['ContactNumber'];
    $currentpass = $_POST['Password1'];
    $newpass = $_POST['Password2'];
    $UserID = $_SESSION['UserID'];

    $UserInfoQuery="SELECT * FROM user WHERE UserID='$UserID' LIMIT 1";
    $QueryExecution = mysqli_query($conn, $UserInfoQuery);
    $UserInformation = mysqli_fetch_assoc($QueryExecution);

    //----- Comparing form inputs to user data in the database -----//

    //first name
    if($UserInformation['FirstName'] == $firstname ) {
        $firstname = $UserInformation['FirstName'];
    }
    //last name
    if($UserInformation['LastName'] == $lastname ) {
        $lastname = $UserInformation['LastName'];
    }
    //email
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
        if($UserInformation['Email'] == $email ) {
            $email = $UserInformation['Email'];
        }
    }
    else {
        $_SESSION['EditInfo-Status'] = "Invalid email format.";
        header("Location: ../user-profile.php");
        exit();
    }
    //address
    if($UserInformation['Address'] == $address){
        $address = $UserInformation['Address'];
    }
    //postal code
    if($UserInformation['PostalCode'] == $postalcode){
        $postalcode = $UserInformation['PostalCode'];
    }
    //phone number
    if($UserInformation['PhoneNumber'] == $phonenumber){
        $phonenumber = $UserInformation['PhoneNumber'];
    }

    //Password
    $EncryptedPassword = $UserInformation['Password'];
    if($newpass != "" && $currentpass != ""){

        //decrypting current password (raw password text)
        $DecryptedPassword = password_verify($currentpass, $EncryptedPassword);

        //checking if the current password inputted matches the password in the database
        if ($DecryptedPassword) {
            if($currentpass == $newpass){ //if raw password == the inputted new password
                $_SESSION['EditInfo-Status'] = "The new password you inputted is the same with your current password.";
                header("Location: ../user-profile.php");
                exit();
            }
            else {
                $newpassfinal = password_hash($newpass, PASSWORD_DEFAULT);
            }
        }
        else { //if the inputted password does not match the password in the database
            $_SESSION['EditInfo-Status'] = "Incorrect password.";
            header("Location: ../user-profile.php");
            exit();
        }
    }
    else {
        $newpassfinal = $EncryptedPassword;
    }

    //Updating of User Information
    $UpdateInfoQuery = "UPDATE user SET 
                 FirstName = '$firstname', LastName = '$lastname', Email = '$email', Address = '$address', PostalCode = '$postalcode', PhoneNumber = '$phonenumber', Password = '$newpassfinal' Where UserID = '$UserID'";

    //Query Execution
    if(mysqli_query($conn,$UpdateInfoQuery)){
        $_SESSION['EditInfo-Status'] = "Changes have been saved.";
        header("Location: ../user-profile.php");
    }

?>
<?php
session_start();
$conn = require '../database/connection.php';

    //getting input values from sign up form
    $firstname = ucfirst(mysqli_real_escape_string($conn,$_POST['FirstName']));
    $lastname = ucfirst(mysqli_real_escape_string($conn,$_POST['LastName']));
    $email = trim($_POST['Email']);
    $password1 = trim($_POST['Password1']);
    $password2 = trim($_POST['Password2']);

    $EmailFilter="SELECT * FROM user WHERE Email='$email' LIMIT 1";
    $EmailFilterQuery = mysqli_query($conn, $EmailFilter);
    $EmailFilterResult = mysqli_fetch_assoc($EmailFilterQuery);

    //-----Checking of Sign Up form inputs-----//

        if($firstname != ""){
            if (strlen($firstname) < 2 || !preg_match("/^([a-zA-Z ]+)$/",$firstname)){
                $_SESSION['AddAccount-Status'] = "Follow correct name format.";
                header("Location: ../admin/admin-accountmanagement.php");
                exit();
            }
        }
        else {
            $_SESSION['AddAccount-Status'] = "Input your last name.";
            header("Location: ../admin/admin-accountmanagement.php");
            exit();
        }
        if($lastname != ""){
            if (strlen($lastname) < 2 || !preg_match("/^([a-zA-Z ]+)$/",$lastname)){
                $_SESSION['AddAccount-Status'] = "Follow correct name format.";
                header("Location: ../admin/admin-accountmanagement.php");
                exit();
            }
        }
        else {
            $_SESSION['AddAccount-Status'] = "Input your first name.";
            header("Location: ../admin/admin-accountmanagement.php");
            exit();
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { //verification of email format
            $_SESSION['AddAccount-Status'] = "Invalid email format";
            header("Location: ../admin/admin-accountmanagement.php");
            exit();
        }
        if ($EmailFilterResult != null){ //checking of email duplication
            $_SESSION['AddAccount-Status'] = "Email is already in use";
            header("Location: ../admin/admin-accountmanagement.php");
            exit();
        }
        //password pattern validation
        $letters = preg_match('@[a-zA-Z]@', $password1);
        $numbers = preg_match('@[0-9]@', $password1);
        $specialchars = preg_match('/\W/', $password1);

        if($password1 != "" && $password2 != ""){
                if (!$letters || !$numbers || !$specialchars || strlen($password1) < 8){
                    $_SESSION['AddAccount-Status'] = "Follow correct password format.";
                    header("Location: ../admin/admin-accountmanagement.php");
                    exit();
                }
        }
        else {
            $_SESSION['AddAccount-Status'] = "Password fields cannot be empty.";
            header("Location: ../admin/admin-accountmanagement.php");
            exit();
        }
        if ($password1 != $password2) {
            $_SESSION['AddAccount-Status'] = "Passwords does not match.";
            header("Location: ../admin/admin-accountmanagement.php");
            exit();
        }

            //Encryption of user password
            $hashedPassword = password_hash($password2 , PASSWORD_DEFAULT);

            //Putting user info on query
            $RegisterUserQuery = "INSERT INTO user 
            (FirstName, LastName,Email, Address, Password, PhoneNumber, PostalCode, SuperUser)
            VALUES
            ('$firstname','$lastname','$email','','$hashedPassword',0,0,1)";

            //query execution
            if (mysqli_query($conn,$RegisterUserQuery)){
                $_SESSION['AddAccount-Status'] = "Account registered successfully.";
                header("Location: ../admin/admin-accountmanagement.php");
                exit();
            }
            else {
                $_SESSION['AddAccount-Status'] = "An error has occurred in adding the account.";
                header("Location: ../admin/admin-accountmanagement.php");
                exit();
            }


?>

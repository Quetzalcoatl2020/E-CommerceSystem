<?php
session_start();
$conn = require '../database/connection.php';

    //getting input values from sign up form
    $firstname = ucfirst(mysqli_real_escape_string($conn,$_POST['FirstName']));
    $lastname = ucfirst(mysqli_real_escape_string($conn,$_POST['LastName']));
    $email = $_POST['Email'];
    $address = $_POST['Address'];
    $password1 = $_POST['Password1'];
    $password2 = $_POST['Password2'];

    $EmailFilter="SELECT * FROM user WHERE Email='$email' LIMIT 1";
    $EmailFilterQuery = mysqli_query($conn, $EmailFilter);
    $EmailFilterResult = mysqli_fetch_assoc($EmailFilterQuery);

    //-----Checking of Sign Up form inputs-----//

    //since most of the input validation processes were already done in client-side
    //the verification of email format was the remaining input that was not validated.

        //verification of email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['Email_Error'] = "Invalid email format";
            header("Location: ../signup.php");
            exit();
        }
        else if ($EmailFilterResult != null){ //checking of email duplication
            $_SESSION['Email_Error'] = "Email is already in use";
            header("Location: ../signup.php");
            exit();
        }
        else {
            //Encryption of user password
            $hashedPassword = password_hash($password2 , PASSWORD_DEFAULT);

            //Putting user info on query
            $RegisterUserQuery = "INSERT INTO user 
            (FirstName, LastName,Email, Address, Password, PhoneNumber, PostalCode, SuperUser)
            VALUES
            ('$firstname','$lastname','$email','$address','$hashedPassword',0,0,0)";

            //query execution
            if (mysqli_query($conn,$RegisterUserQuery)){
                unset($_SESSION['Email_Error']);
                header("Location: ../index.php");
            }
            else {
                header("Location: ../signup.php?error=An error has occurred in saving user information");
            }
        }

?>

<?php
session_start();
?>

<html>
<head>
    <title>Shoppr | Sign Up</title>
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="bootstrap-4.0.0-dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="jquery.min.js"></script>
    <script type="text/javascript" src="js/functions-js.js"></script>
</head>
<body id="frontpages-background">
    <!-- Navigation bar at the top page -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
        <!-- Brand logo -->
        <span class="navbar-brand h1">Shoppr</span>
        <!-- Login and Sign up links-->
        <div class="container" id="LoginSignupContainer">
            <ul class="d-flex justify-content-end" id="navlist">
                <li class="nav-item">
                    <a class="nav-link text-light" href="signup.php" id="linksignup">Sign Up</a>
                </li>
                <li class="nav-item">
                    <a href="index.php" class="text-dark" id="linklogin"><button class="btn btn-outline-light" id="buttonlogin">Login</button></a>
                </li>

            </ul>
        </div>
    </nav>

    <!--Main Content-->
    <div class="container">
        <div class="row" id="landingcontent">
            <!--Form Area-->
            <div class="col-lg" id="landingcontent-firstcolumn">
                <form id="signupform" onsubmit="SignUp_onSubmitInputValidation()" action="process-controllers/controls-signup.php" method="POST">
                    <h5 style="font-family: Verdana; text-align: center">Account Registration</h5>

                    <!-- server-side error prompt-->
                        <?php
                        if (isset($_SESSION['Email_Error'])) { ?>
                        <div class="form-group rounded" id="ServerSide-ErrorContainer">
                            <p class="text-center" id="FormInput-ErrorText"><?php echo $_SESSION['Email_Error']?></p>
                        </div>
                        <?php
                        }
                        unset($_SESSION['Email_Error']);
                        ?>

                    <!-- client-side error prompt-->
                    <div class="form-group rounded" id="FormInput-ErrorContainer">
                        <p class="text-center" id="FormInput-ErrorText">Please follow correct input formats.</p>
                    </div>

                    <!-- first and last name text boxes-->
                    <div class="form-row">
                        <div class="col">
                            <input type="text" class="form-control" id="FirstName" name="FirstName" placeholder="First Name" onfocusout="checknameformat();" onkeyup="firstnamevalidate();" required>
                            </div>
                        <div class="col">
                            <input type="text" class="form-control" id="LastName" name="LastName" placeholder="Last Name" onfocusout="checknameformat();" onkeyup="lastnamevalidate();" required>
                        </div>
                    </div>
                    <!--small text input indicator below name textbox-->
                    <small class="form-text text-danger justify-content-start" id="nameError" name="nameError">First and last name must be at least 2 characters and contain letters only.</small>
                    <!-- email text box-->
                    <div class="form-group" style="margin-top: 15px">
                        <input type="email" class="form-control" id="Email" placeholder="Email" name="Email" required>
                    </div>
                    <!-- address text box-->
                    <div class="form-group">
                        <input type="text" class="form-control" id="Address" name="Address" placeholder="Complete Address" required>
                    </div>
                    <!-- password text box-->
                    <div class="form-group" style="margin-bottom: 20px;">
                        <input type="password" class="form-control" id="Password1" name="Password1" placeholder="Password" onkeyup="passwordformat()" onfocus="showpassformat()" onfocusout="otherpassformatmechanics()" required>
                    </div>
                    <!--small text input indicators that shows guidelines in password format-->
                    <div class="form-row" style="margin-top: -20px; margin-bottom: 7px">
                        <div class="col-sm-4">
                            <small class="form-text justify-content-start" id="pass8Char"><i class="bi bi-check-circle" id="pass8char_checkcircle"></i><i class="bi bi-check-circle-fill" id="pass8char_circlefill"></i>at least 8 characters</small>
                        </div>
                        <div class="col-sm-4">
                            <small class="form-text justify-content-start" id="passNumber"><i class="bi bi-check-circle" id="passNumber_checkcircle"></i><i class="bi bi-check-circle-fill" id="passNumber_circlefill"></i>contains number</small>
                            </div>
                        <div class="col-sm-4">
                            <small class="form-text justify-content-start" id="passSpecialChar"><i class="bi bi-check-circle" id="passSpecialChar_checkcircle"></i><i class="bi bi-check-circle-fill" id="passSpecialChar_circlefill"></i>contains special character</small>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="Password2" name="Password2" placeholder="Confirm Password" onkeyup="passwordchecking()" onfocusout="otherpassformatmechanics()">
                    </div>
                    <small class="form-text text-danger justify-content-start" id="passwordError" name="passwordError">Passwords does not match.</small>

                    <!-- form check box -->
                    <div class="form-group d-flex justify-content-center">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="TermsConditionsCheck" required>
                            <label class="form-check-label" for="TermsConditionsCheck" id="TermsConditionsLabel">
                                I agree to the terms and conditions of Shoppr
                            </label>
                        </div>
                    </div>
                    <div class="form-group d-flex justify-content-center">
                        <button type="submit" id="formbuttonregister" class="btn btn-outline-dark" name="formbuttonregister">Register</button>
                    </div>
                </form>
            </div>

            <!--Tagline Text Area-->
            <div class="col-lg" id="landingcontent-secondcolumn">
                <h1 id="signupshoppr">Sign up to Shoppr</h1>
                <p id="signup-smalldescription">One of the leading online shopping platform.</p>
            </div>
    </div>
    </div>
</body>
</html>
<?php
?>


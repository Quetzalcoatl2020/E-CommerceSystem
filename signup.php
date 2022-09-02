<html>
<head>
    <link rel="stylesheet" type="text/css" href="bootstrap-4.0.0-dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="bootstrap-4.0.0-dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js"></script>
    <script src="jquery-3.6.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="js/functions-js.js"></script>
</head>
<body>
    <!-- Navigation bar at the top page -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
        <!-- Brand logo -->
        <span class="navbar-brand h1">Shoppr</span>
        <!-- Login and Sign up links-->
        <div class="container" id="LoginSignupContainer">
            <ul class="d-flex justify-content-end" id="navlist">
                <li class="nav-item">
                    <a class="nav-link" href="signup.php" id="linksignup">Sign Up</a>
                </li>
                <li class="nav-item">
                    <a href="index.php" class="text-success" id="linklogin"><button class="btn btn-outline-success" id="buttonlogin">Login</button></a>
                </li>

            </ul>
        </div>
    </nav>

    <!--Main Content-->
    <div class="container">
        <div class="row" id="landingcontent">
            <!--Form Area-->
            <div class="col-lg" id="landingcontent-firstcolumn">
                <form id="signupform">
                    <h5 style="font-family: Verdana; text-align: center">Account Registration</h5>
                    <div class="form-row">
                        <div class="col">
                            <input type="text" class="form-control" id="FirstName" placeholder="First Name" onfocus="showNameFormat()" onkeyup="firstnamevalidate();" required>
                            </div>
                        <div class="col">
                            <input type="text" class="form-control" id="LastName" placeholder="Last Name" onfocus="showNameFormat()" onkeyup="lastnamevalidate();" required>
                        </div>
                    </div>
                    <!--small text input indicator below name textbox-->
                    <small class="form-text text-danger justify-content-start" id="nameError">First and last name must be at least 2 characters and contain letters only.</small>

                    <div class="form-group" style="margin-top: 15px">
                        <input type="email" class="form-control" id="Email" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="Address" placeholder="Complete Address" required>
                    </div>
                    <div class="form-group" style="margin-bottom: 20px;">
                        <input type="password" class="form-control" id="Password1" placeholder="Password" onkeyup="passwordformat()" onfocus="showpassformat()" onfocusout="hidepassformat()" required>
                    </div>
                    <div class="form-row" style="margin-top: -15px; margin-bottom: 7px">
                        <div class="col-sm-4">
                            <small class="form-text justify-content-start" id="pass8Char"><i class="bi bi-check-circle" id="checkcircle"></i>at least 8 characters</small>
                        </div>
                        <div class="col-sm-4">
                            <small class="form-text justify-content-start" id="passNumber"><i class="bi bi-check-circle" id="checkcircle"></i>contains number</small>
                            </div>
                        <div class="col-sm-4">
                            <small class="form-text justify-content-start" id="passSpecialChar"><i class="bi bi-check-circle" id="checkcircle"></i>contains special character</small>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="Password2" placeholder="Confirm Password" onkeyup="passwordchecking()">
                    </div>
                    <small class="form-text text-danger justify-content-start" id="passwordError">Passwords does not match.</small>

                    <div class="form-group d-flex justify-content-center">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="TermsConditionsCheck">
                            <label class="form-check-label" for="TermsConditionsCheck" id="TermsConditionsLabel">
                                I agree to the terms and conditions of Shoppr
                            </label>
                        </div>
                    </div>
                    <div class="form-group d-flex justify-content-center">
                        <button type="submit" id="formbuttonregister" class="btn btn-outline-success">Register</button>
                    </div>
                </form>
            </div>

            <!--Tagline Text Area-->
            <div class="col-lg" id="landingcontent-secondcolumn">
                <h1 id="signupshoppr">Sign up to Shoppr</h1>
                <p id="signup-smalldescription">The leading online shopping platform.</p>
            </div>
    </div>
    </div>
</body>
</html>
<?php
?>


<?php
session_start();
$conn = require '../database/connection.php';

    //getting user information using stored UserID from Session variable
    if (isset($_SESSION['UserID'])){
        $UID = $_SESSION['UserID'];
        $UserInformationQuery = "SELECT * FROM user where UserID='$UID'";
        $UserInformationQueryExecution = mysqli_query($conn,$UserInformationQuery);
        $UserInformation = mysqli_fetch_assoc($UserInformationQueryExecution);

        if($UserInformation['PostalCode'] == 0 || $UserInformation['PhoneNumber'] == 0){
            $_SESSION['IncompleteProfile'] = "Add postal code and phone number to begin your shopping";
        }
        else {
            unset($_SESSION['IncompleteProfile']);
        }
    } else {
        $_SESSION['Login_Error'] = "Please login first.";
        header("Location: index.php");
        exit();
    }

?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../bootstrap-4.0.0-dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="../jquery.min.js"></script>
    <script type="text/javascript" src="../js/functions-js.js"></script>
</head>
<body class="bg-light">

    <!-- server-side error prompt-->
    <?php
    if (isset($_SESSION['EditInfo-Status'])) { ?>
        <!-- Alert dialog for user info editing errors -->
        <div class="alert alert-info d-flex justify-content-between" role="alert" id="Error-AlertDialog">
            <p id="Error-AlertDialogText"><?php echo $_SESSION['EditInfo-Status']?></p>
            <button type="button" class="close ml-3" id="Error-AlertClose" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php
    }
    unset($_SESSION['EditInfo-Status']);
    ?>

<!-- Navigation bar at the top page -->
    <nav class="navbar fixed-top navbar-expand-sm navbar-dark bg-dark">
        <span class="navbar-brand h1">Shoppr</span>

        <!--Button that toggles the navbar contents to be visible when the screen is resized to a certain width-->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- div that encases navbar content, that will be collapsed when the screen is resize to a certain width-->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <!--Search feature-->
            <form class="form-inline my-2 ml-auto mr-auto">
                <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
            </form>

            <!--navbar links-->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-light" href="#"><i class="bi bi-house-door-fill" id="homeicon"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="user-profile.php" id="shoppingcartlink"><i class="bi bi-cart4" id="shoppingcart"></i></a>
                </li>

                <!--Dropdown-->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Menu
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown" id="navdropdown">
                        <a class="dropdown-item" href="#" ><i class="bi bi-person-fill" id="menuicon"></i>Profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="../index.php"><i class="bi bi-box-arrow-right" id="menuicon"></i>Log Out</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <!--Main content-->
        <div class="container-fluid d-flex justify-content-center align-items-center mb-0 pb-0" id="profile-maincontainer">
            <!-- USER PROFILE code block-->
            <div class="row d-flex align-items-center">
                <div class="col-sm-4 d-flex justify-content-center">
                    <img src="../images/profile-pic.png" class="rounded-circle" id="profilepic">
                </div>
                <div class="col-sm-8" id="profile-userinfoheader">
                    <div class="row" style="margin-bottom: -5px;">
                        <div class="col-11">
                            <p class="h4" id="user-name"><?php echo $UserInformation['FirstName']." ".$UserInformation['LastName']; ?> </p>
                        </div>
                        <div class="col-1" style="margin-left: -35px;">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-outline-dark bg-transparent border-0 shadow-none" id="edit-profile-button" data-toggle="modal" data-target="#UserInformationModal">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                        </div>
                    </div>
                    <div class="row" style="margin-bottom: -15px;">
                        <p id="user-email"><?php echo $UserInformation['Email']; ?></p>
                    </div>
                    <div class="row">
                        <small id="user-address"><?php echo $UserInformation['Address']; ?></small>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid justify-content-center pt-1" id="IncInfoError-MainContainer">
            <!-- server-side error prompt-->
            <?php
            if (isset($_SESSION['IncompleteProfile'])) { ?>
                <div class="container rounded d-flex justify-content-center p-1" id="IncProfileInfo-ServerSide-ErrorContainer">
                    <p class="text-center" id="IncProfileInfo-ErrorText"><?php echo $_SESSION['IncompleteProfile']?></p>
                    <button type="button" onclick="hideIncompleteInfoNotice()" class="close text-success ml-4 mb-1" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php
            }
            ?>
        </div>
        <!-- Code for tabs (Cart, Pending, Completed)-->
        <div class="container-fluid d-flex justify-content-center" id="profile-secondarycontainer">
                <nav class="navbar navbar-expand-lg" id="profile-ordernav">
                    <ul class="d-flex" id="profile-navlist">
                        <li class="nav-item">
                            <a class="nav-link text-center" id="cart-tab" href="#cart" onclick="showproductcart()"><i class="bi bi-cart4" id="profile-shoppingcart"></i><p id="profile-tabtext">Your Cart</p></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-center" id="pendingorders-tab" href="#pending" onclick="showppendingorders()"><i class="bi bi-card-list" id="profile-cardlistpending"></i><p id="profile-tabtext">Pending Orders</p></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-center" id="completedorders-tab" href="#completed" onclick="showpcompletedorders()"><i class="bi bi-clipboard-check" id="profile-clipboardcomplete"></i><p id="profile-tabtext">Completed Orders</p></a>
                        </li>
                    </ul>
                </nav>
        </div>

        <!--Product Cart Container-->
        <div class="container-fluid" id="productcartcontainer">
            <!--Code for cart label bar-->
            <div class="container d-flex justify-content-center mt-1">
                <div class="card mt-2" id="product-label-bar">
                    <div class="row">
                        <div class="col-1">
                        </div>
                        <div class="col-6">
                            <div class="card-body">
                                <small class="card-text">Product</small>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="card-body">
                                <small class="card-text">Total Amount</small>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="card-body">
                                <small class="card-text">Options</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--Code for product list here (card)-->
            <div class="container d-flex justify-content-center mt-1">
                <div class="card mt-2 p-1" id="cart-product-card">
                    <div class="row pb-2 pt-2">
                        <!--Checkbox here-->
                        <div class="col-1 pl-4 d-flex justify-content-center align-items-center">
                            <input type="checkbox">
                        </div>
                        <!--Product Image here-->
                        <div class="col-2 d-flex align-items-center">
                            <img class="card-img" id="product-img" src="../images/electric-drill.jpg" alt="Card image cap">
                        </div>

                        <div class="col-4">
                            <div class="card-body">
                                <!--Product Name here-->
                                <h6 class="card-title" id="product-name">All-Purpose Electric Drill</h6>
                                <!--Product Price here-->
                                <p class="card-text" id="product-price">₱2500.00</p>
                            </div>
                        </div>

                        <!--Total Price here-->
                        <div class="col-3 d-flex align-items-center">
                            <p class="card-text text-success font-weight-bold" id="product-total-price">₱2500.00</p>
                        </div>

                        <!--Options here-->
                        <div class="col-1 d-flex align-items-center justify-content-center">
                            <a href="#" style=""><i class="bi bi-x-lg text-danger"></i></a>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-secondary d-flex" style="padding-bottom: 0px; height: 42px;">
                        <p class="card-text" style="font-size: 13px; margin-top: 5px;">Quantity:</p><input class="ml-2" type="number" min="0" id="cart-quantity-input" inputmode="numeric">
                    </div>
                </div>
            </div>
        </div>

        <!--Pending Orders Container-->
        <div class="container-fluid" id="pendingorderscontainer">
            <!--Code for pending orders label bar-->
            <div class="container d-flex justify-content-center mt-1">
                <div class="card mt-2" id="product-label-bar">
                    <div class="row">
                        <div class="col-7">
                            <div class="card-body">
                                <small class="card-text d-flex justify-content-center">Product</small>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="card-body">
                                <small class="card-text">Quantity</small>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="card-body d-flex justify-content-center">
                                <small class="card-text">Total Amount</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--Code for product list here (card)-->
            <div class="container d-flex justify-content-center mt-1">
                <div class="card mt-2 p-1" id="pending-order-product-card">
                    <div class="row pb-2 pt-2">
                        <!--Product Image here-->
                        <div class="col-2 d-flex align-items-center">
                            <img class="card-img" id="product-img" src="../images/electric-drill.jpg" alt="Card image cap">
                        </div>

                        <div class="col-5">
                            <div class="card-body">
                                <!--Product Name here-->
                                <h6 class="card-title" id="product-name">All-Purpose Electric Drill</h6>
                                <!--Product Price here-->
                                <p class="card-text" id="product-price">₱2500.00</p>
                            </div>
                        </div>

                        <!--Product Quantity here-->
                        <div class="col-2 d-flex align-items-center">
                            <h6 class="card-title" id="product-quantity">1</h6>
                        </div>

                        <!--Total Price here-->
                        <div class="col-2 d-flex align-items-center justify-content-center">
                            <p class="card-text text-success font-weight-bold" id="product-total-price">₱2500.00</p>
                        </div>
                    </div>

                    <div class="card-footer bg-transparent border-secondary d-flex" style="padding-bottom: 4px; height: 42px;">
                        <small class="text-success d-flex align-items-center justify-content-start" id="orderstatus-indicator">The package has been picked up by the courier.</small>
                    </div>
                </div>
            </div>
        </div>

        <!--Completed Orders Container-->
        <div class="container-fluid" id="completedorderscontainer">
            <!--Code for completed orders label bar-->
            <div class="container d-flex justify-content-center mt-1">
                <div class="card mt-2" id="product-label-bar">
                    <div class="row">
                        <div class="col-7">
                            <div class="card-body">
                                <small class="card-text d-flex justify-content-center">Product</small>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="card-body">
                                <small class="card-text">Quantity</small>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="card-body d-flex justify-content-center">
                                <small class="card-text">Total Amount</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--Code for product list here (card)-->
            <div class="container d-flex justify-content-center mt-1">
                <div class="card mt-2 p-1" id="completed-order-product-card">
                    <div class="row pb-2 pt-2">
                        <!--Product Image here-->
                        <div class="col-2 d-flex align-items-center">
                            <img class="card-img" id="product-img" src="../images/electric-drill.jpg" alt="Card image cap">
                        </div>

                        <div class="col-5">
                            <div class="card-body">
                                <!--Product Name here-->
                                <h6 class="card-title" id="product-name">All-Purpose Electric Drill</h6>
                                <!--Product Price here-->
                                <p class="card-text" id="product-price">₱2500.00</p>
                            </div>
                        </div>

                        <!--Product Quantity here-->
                        <div class="col-2 d-flex align-items-center">
                            <h6 class="card-title" id="product-quantity">1</h6>
                        </div>

                        <!--Total Price here-->
                        <div class="col-2 d-flex align-items-center justify-content-center">
                            <p class="card-text text-success font-weight-bold" id="product-total-price">₱2500.00</p>
                        </div>
                    </div>

                    <div class="card-footer bg-transparent border-secondary d-flex" style="padding-bottom: 4px; height: 42px;">
                        <small class="text-success d-flex align-items-center justify-content-start" id="orderstatus-indicator">The package has been delivered.</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for user information viewing and editing -->
        <div class="modal fade" id="UserInformationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header pt-2 pb-2 bg-dark">
                        <h5 class="modal-title text-light" id="EditProfile-ModalTitle">Edit Profile</h5>
                        <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="edit-profile-form" onsubmit="EditProfile_onSubmitInputValidation()" action="../process-controllers/controls-editprofile.php" method="POST">
                            <!-- client-side error prompt-->
                            <div class="form-group rounded" id="EditProfileInput-ErrorContainer">
                                <p class="text-center" id="EditProfileInput-ErrorText">Please follow correct input formats.</p>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <input type="text" class="form-control" id="Edit-FirstName" placeholder="First Name" name="FirstName" value="<?php echo $UserInformation['FirstName']; ?>" onfocusout="checknameformat();" onkeyup="firstnamevalidate();" required>
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" id="Edit-LastName" placeholder="Last Name" name="LastName" value="<?php echo $UserInformation['LastName']; ?>" onfocusout="checknameformat();" onkeyup="lastnamevalidate();" required>
                                </div>
                            </div>
                            <!--small text input indicator below name textbox-->
                            <small class="form-text text-danger justify-content-start" id="nameError">First and last name must be at least 2 characters and contain letters only.</small>
                            <!-- email text box-->
                            <div class="form-group" style="margin-top: 15px">
                                <input type="email" class="form-control" id="Edit-Email" name="Email" value="<?php echo $UserInformation['Email']; ?>" placeholder="Email" required>
                            </div>
                            <!-- address text box-->
                            <div class="form-group">
                                <input type="text" class="form-control" id="Edit-Address" name="Address" value="<?php echo $UserInformation['Address']; ?>" placeholder="Complete Address" required>
                            </div>
                            <!-- Zip Code text box-->
                            <div class="form-group">
                                <input type="number" class="form-control" id="Edit-ZipCode" name="ZipCode" value="<?php if($UserInformation['PostalCode'] != 0){ echo $UserInformation['PostalCode']; } ?>" placeholder="Zip Code" required>
                            </div>
                            <!-- Contact Number text box-->
                            <div class="form-group">
                                <input type="number" class="form-control" id="Edit-ContactNumber" name="ContactNumber" value="0<?php if($UserInformation['PhoneNumber'] != 0){ echo $UserInformation['PhoneNumber']; } ?>" placeholder="Contact Number" required>
                            </div>
                            <hr style="margin-bottom: 6px;">
                            <h6 style="font-family: Verdana;">Change Password</h6>
                            <!-- password text box-->
                            <div class="form-group" style="margin-bottom: 20px;">
                                <input type="password" class="form-control" id="Edit-CurrentPassword" name="Password1" placeholder="Current Password" onkeyup="passwordformat()">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="Edit-NewPassword" name="Password2" placeholder="New Password" onkeyup="newpasswordformat()" onfocus="showpassformat()" onfocusout="hidepassformat()">
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
                    </div>
                    <div class="modal-footer bg-dark">
                        <button type="submit" id="formbutton-editprofile" class="btn btn-outline-light">Save Changes</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
</body>
</html>



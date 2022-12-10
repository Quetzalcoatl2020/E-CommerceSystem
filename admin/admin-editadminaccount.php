<?php
session_start();
$conn = require '../database/connection.php';

    //getting current user information using stored UserID from Session variable
    if (isset($_SESSION['UserID'])){
        $UID = $_SESSION['UserID'];
        $AdminInformationQuery = "SELECT * FROM user where UserID='$UID' AND SuperUser>0";
        $AdminInformationQueryExecution = mysqli_query($conn,$AdminInformationQuery);
        $AdminInformation = mysqli_fetch_assoc($AdminInformationQueryExecution);

        //getting the user details of the account to be edited
        if (isset($_GET['uid']) || $_GET['uid'] != "" ||  $_GET['uid'] != null){
            $AccountUID = $_GET['uid'];
            $_SESSION['uid-edit'] = $AccountUID;

            $GetAccountQuery = "SELECT * FROM user WHERE UserID='$AccountUID' AND SuperUser>0";
            $GetAccountQueryExecution = mysqli_query($conn, $GetAccountQuery);
            $GetAccountResult = mysqli_fetch_assoc($GetAccountQueryExecution);

            if ($GetAccountResult['SuperUser'] == 5 && $AdminInformation['SuperUser']<5) {
                unset($_SESSION['uid-edit']);
                $_SESSION['AddAccount-Status'] = "SuperAdmin account cannot be edited by lower-level administrators.";
                header("Location: ../admin/admin-accountmanagement.php");
                exit();
            }
        }
        else {
            $_SESSION['AddAccount-Status'] = "No account selected.";
            header("Location: ../admin/admin-accountmanagement.php");
            exit();
        }
    }
    else {
        $_SESSION['Login_Error'] = "Please login first.";
        header("Location: ../index.php");
        exit();
    }


?>
<html>
<head>
    <meta charset="utf-8">
    <title>Accounts - Shoppr</title>
    <!-- CSS only -->
    <link rel="stylesheet" type="text/css" href="bootstrap-4.0.0-dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <!-- JavaScript resources-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="../jquery.min.js"></script>
    <script type="text/javascript" src="../js/functions-js.js"></script>

</head>
<body>

    <!-- server-side error prompt for editing account-->
    <?php
    if (isset($_SESSION['EditAccount-Status'])) { ?>
        <!-- Alert dialog for user info editing errors -->
        <div class="alert alert-info d-flex justify-content-between" role="alert" id="AdminError-AlertDialog">
            <p id="AdminError-AlertDialogText"><?php echo $_SESSION['EditAccount-Status']?></p>
            <button type="button" class="close ml-3 bg-transparent border-0" id="AdminError-AlertClose" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php
    }
    unset($_SESSION['EditAccount-Status']);
    ?>

    <!-- Navigation bar at the top page -->
    <nav class="navbar fixed-top navbar-expand navbar-dark bg-dark w-100">
        <div class="container-fluid d-flex justify-content-start">
            <div class="row">
                <div class="col-5">
                    <!-- Hamburger button to open the off-canvas sidebar -->
                    <button class="btn btn-outline-light" type="button" title="hamburgerbutton" data-bs-toggle="offcanvas" data-bs-target="#sidebarcontent" id="hamburgerbutton" aria-controls="sidebarcontent">
                        <i class="bi bi-list" id="hamburgericon"></i>
                    </button>
                </div>
                <div class="col-7 mt-1">
                    <!-- Brand logo -->
                    <span class="navbar-brand h1">Shoppr</span>
                </div>
            </div>

            <!-- Logout Option for Admin-->
            <div class="container d-flex justify-content-end ml-auto" id="adminlogoutcontainer">
                <ul id="admin-navlist">
                    <!--Dropdown-->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-light" href="#" id="adminMenuDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php echo $AdminInformation['FirstName']." ".$AdminInformation['LastName'];?>
                        </a>
                        <div class="dropdown-menu mr-1 w-100" aria-labelledby="navbarDropdown" id="adminnavdropdown">
                            <a class="dropdown-item" href="../index.php" id="adminMenuItem"><i class="bi bi-box-arrow-right" id="adminmenuicon"></i>Log Out</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

    </nav>

    <!-- Sidebar Navigation Content-->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="sidebarcontent" aria-labelledby="sidebarcontent">
        <div class="offcanvas-header bg-dark mb-3">
            <h5 class="offcanvas-title text-light" id="sidebarcontent-title">Admin Menu</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body p-0">
            <div>
                <a href="admin-products.php" class="nav-link" id="adminSidebar-tabInactive">Products</a>
            </div>
            <div>
                <a href="admin-productinventory.php" class="nav-link" id="adminSidebar-tabInactive">Manage Inventory</a>
            </div>
            <div>
                <a href="admin-activitylog.php" class="nav-link" id="adminSidebar-tabInactive">Activity Log</a>
            </div>
            <div>
                <a href="admin-orders.php" class="nav-link" id="adminSidebar-tabInactive">Orders</a>
            </div>
            <div>
                <a href="admin-accountmanagement.php" class="nav-link" id="adminSidebar-tabActive">Admin Account Management</a>
            </div>

        </div>
    </div>

    <!--Main Content-->
    <div class="container" id="admin-maincontainer">
        <h2 id="admin-pagetitle">Edit Account Details</h2>
        <hr>
        <div class="container p-1">
            <!-- Form for adding new product-->
            <form id="admin-addaccountform" action="../process-controllers/controls-editaccount.php" method="POST">
                <h5 style="font-family: Verdana; text-align: left;" id="addaccount-label">Edit Account Details</h5>
                <!-- client-side error prompt-->
                <div class="form-group rounded" id="FormInput-ErrorContainer">
                    <p class="text-center" id="FormInput-ErrorText">Please follow correct input formats.</p>
                </div>
                <!--label for name textboxes-->
                <div class="form-row d-flex justify-content-center mt-2" style="padding-left: 15px; padding-right: 6px;">
                    <div class="col-6" style="margin-right: 10px;">
                        <small id="small-label">First Name</small>
                    </div>
                    <div class="col-6" style="margin-right: 10px;">
                        <small id="small-label">Last Name</small>
                    </div>
                </div>
                <!--Admin Account Name-->
                <div class="form-row d-flex justify-content-center" style="padding-left: 15px; padding-right: 6px;">
                    <div class="col-6" style="margin-right: 10px;">
                        <input type="text" class="form-control" id="FirstName" name="FirstName" placeholder="First Name" value="<?php echo $GetAccountResult['FirstName']; ?>" onfocusout="checknameformat();" onkeyup="firstnamevalidate();" required>
                    </div>
                    <div class="col-6" style="margin-right: 10px;">
                        <input type="text" class="form-control" id="LastName" name="LastName" placeholder="Last Name" value="<?php echo $GetAccountResult['LastName']; ?>" onfocusout="checknameformat();" onkeyup="lastnamevalidate();" required>
                    </div>
                </div>
                <!--small text input indicator below name textbox-->
                <small class="form-text text-danger justify-content-start" style="margin-left: 10px;" id="nameError" name="nameError">First and last name must be at least 2 characters and contain letters only.</small>

                <!--label for email and account status-->
                <div class="form-row d-flex justify-content-center mt-2" style="padding-left: 15px; padding-right: 6px;">
                    <div class="col-6" style="margin-right: 10px;">
                        <small id="small-label">Email</small>
                    </div>
                    <div class="col-6" style="margin-right: 10px;">
                        <small id="small-label">Account Status</small>
                    </div>
                </div>
                <!--Admin Account Email-->
                <div class="form-row d-flex justify-content-center" style="padding-left: 15px; padding-right: 6px;">
                    <div class="col-6" style="margin-right: 10px;">
                        <input type="text" class="form-control" id="Email" name="Email" placeholder="Email Address" value="<?php echo $GetAccountResult['Email']; ?>" required>
                    </div>
                    <div class="col-6" style="margin-right: 10px;">
                        <select type="number" class="form-select" style="border: 2px solid dimgray" id="AccountStatusDropdown" name="Edit-AccountStatusDropdown">
                            <?php
                            if ($GetAccountResult['SuperUser'] == 1){ ?>
                                <option value="<?php echo $GetAccountResult['SuperUser'];?>" selected>Active</option>
                                <option value="2">Disabled</option>
                                <?php
                            }
                            else if ($GetAccountResult['SuperUser'] == 2){ ?>
                                <option value="<?php echo $GetAccountResult['SuperUser'];?>" selected>Disabled</option>
                                <option value="1">Active</option>
                                <?php
                            }
                            else if ($GetAccountResult['SuperUser'] == 5) { ?>
                                <option value="<?php echo $GetAccountResult['SuperUser'];?>" selected>Active (SuperAdmin)</option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <h5 style="font-family: Verdana; text-align: left; margin-top: 20px;" id="addaccount-label">Change Password</h5>
                <!--Admin Account Password-->
                <div class="form-row d-flex justify-content-center mt-2" style="padding-left: 15px; padding-right: 6px;">
                    <div class="col-6" style="margin-right: 10px;">
                        <input type="password" class="form-control" id="Password2" name="Password1" placeholder="Current Password">
                    </div>
                    <div class="col-6" style="margin-right: 10px;">
                        <input type="password" class="form-control" id="Password1" name="Password2" placeholder="New Password" onkeyup="passwordformat()" onfocus="showpassformat()" onfocusout="hidepassformat()">
                    </div>
                </div>

                <div class="form-row d-flex justify-content-center" style="padding-left: 15px; padding-right: 6px;">
                    <div class="col-6" style="margin-right: 10px;">
                        <!--small text input indicators that shows guidelines in password format-->
                        <div class="form-row" style="margin-left: 10px;">

                        </div>
                    </div>
                    <div class="col-6" style="margin-right: 10px;">
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
                <div class="row mt-2">
                    <div class="container-fluid" id="deleteaccount-buttoncontainer">
                        <a href="../process-controllers/controls-deleteaccount.php?uid=<?php echo $GetAccountResult['UserID']; ?>">
                            <button type="submit" class="btn btn-dark" id="EditAccountBtn" name="submit" title="Edit Account">Save Changes</button>
                        </a>
                    </div>
                </div>
            </form>
            <div class="row" style="margin-top: -10px;">
                <div class="container-fluid" id="deleteaccount-buttoncontainer">
                    <a href="../process-controllers/controls-deleteaccount.php?uid=<?php echo $GetAccountResult['UserID']; ?>">
                        <button class="btn btn-danger" id="DeleteAccountBtn" title="Delete Product">Delete Account</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>



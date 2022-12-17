<?php
session_start();
$conn = require '../database/connection.php';

    //getting user information using stored UserID from Session variable
    if (isset($_SESSION['UserID'])){
        $UID = $_SESSION['UserID'];
        $AdminInformationQuery = "SELECT * FROM user where UserID='$UID' AND SuperUser>0";
        $AdminInformationQueryExecution = mysqli_query($conn,$AdminInformationQuery);
        $AdminInformation = mysqli_fetch_assoc($AdminInformationQueryExecution);
    }
    else {
        $_SESSION['Login_Error'] = "Please login first.";
        header("Location: ../index.php");
        exit();
    }

    if(!isset($_GET['prdctid']) || $_GET['prdctid'] == "") {
        $_SESSION['AddProduct-Status'] = "No product selected.";
        header("Location: ../admin/admin-productinventory.php");
        exit();
    }
    else {
        $ProductID = $_GET['prdctid'];
        //Setting a session variable to store the product ID
        $_SESSION['prdctid'] = $ProductID;

        $ProductQuery = "SELECT * FROM product WHERE ProductID='$ProductID'";
        $ProductQueryExecution = mysqli_query($conn, $ProductQuery);
        $ProductQueryResult = mysqli_fetch_assoc($ProductQueryExecution);
    }



?>
<html>
<head>

    <title>Update Product Stocks - Shoppr</title>
    <!-- CSS only -->
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
    <meta charset="utf-8">
</head>
<body>

    <!-- server-side error prompt for adding product-->
    <?php
    if (isset($_SESSION['EditProductInventory-Status'])) { ?>
        <!-- Alert dialog for user info editing errors -->
        <div class="alert alert-info d-flex justify-content-between" role="alert" id="AdminError-AlertDialog">
            <p id="AdminError-AlertDialogText"><?php echo $_SESSION['EditProductInventory-Status']?></p>
            <button type="button" class="close ml-3 bg-transparent border-0" id="AdminError-AlertClose" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php
    }
    unset($_SESSION['EditProductInventory-Status']);
    ?>

    <!-- Navigation bar at the top page -->
    <nav class="navbar fixed-top navbar-expand navbar-dark bg-dark">
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
                <a href="admin-productinventory.php" class="nav-link" id="adminSidebar-tabActive">Manage Inventory</a>
            </div>
            <div>
                <a href="admin-activitylog.php" class="nav-link" id="adminSidebar-tabInactive">Activity Log</a>
            </div>
            <div>
                <a href="admin-orders.php" class="nav-link" id="adminSidebar-tabInactive">Orders</a>
            </div>
            <div>
                <a href="admin-accountmanagement.php" class="nav-link" id="adminSidebar-tabInactive">Admin Account Management</a>
            </div>
        </div>
    </div>

    <!--Main Content-->
    <div class="container" id="admin-maincontainer">
        <h2 id="admin-pagetitle">Update Stocks</h2>
        <hr>
        <div class="container p-1">
            <!-- Form for editting product-->
            <form action="../process-controllers/controls-updateproductstock.php" method="POST" enctype="multipart/form-data">
                <h5 style="font-family: Verdana; text-align: left;" id="editproduct-label">Product Details</h5>
                <div class="form-row d-flex justify-content-center" style="padding-left: 15px; padding-right: 6px;">
                    <div class="col-4" style="margin-right: 10px;">
                        <input type="text" class="form-control" id="ProductName" name="Edit-ProductName" placeholder="Item Name" value="<?php echo $ProductQueryResult['ProductName'];?>" disabled>
                    </div>
                    <div class="col-4" style="margin-right: 10px;">
                        <select type="number" class="form-select" style="border: 2px solid dimgray" id="ProductCategoryDropdown" name="Edit-ProductCategoryDropdown" disabled>
                            <?php
                            $ProductCategoryID = $ProductQueryResult['CategoryID'];
                            $CategoryQuery = "SELECT * FROM category WHERE CategoryID='$ProductCategoryID'";
                            $CategoryQueryExecution = mysqli_query($conn, $CategoryQuery);
                            $CategoryQueryResult = mysqli_fetch_assoc($CategoryQueryExecution);
                            ?>
                            <option value="<?php echo $ProductQueryResult['CategoryID'];?>"><?php echo $CategoryQueryResult['CategoryName']; ?></option>
                        </select>
                        </ul>
                    </div>
                    <div class="col-4" style="margin-right: 10px; margin-bottom: 10px;">
                        <div class="input-group">
                            <span class="input-group-text" style="border: 2px solid dimgray" id="ProductPrice-CurrencyLabel">₱</span>
                            <input type="number" class="form-control" id="ProductPrice" name="Edit-ProductPrice" placeholder="Price" value="<?php echo $ProductQueryResult['PricePerUnit'];?>" disabled>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-8 mt-2">
                        <input type="text" class="form-control" id="ProductDescription" name="Edit-ProductDescription" placeholder="Product Description" value="<?php echo $ProductQueryResult['Description'];?>" disabled>
                    </div>
                    <div class="col-sm-4 mt-2">
                        <select type="number" class="form-select" style="border: 2px solid dimgray" id="ProductStatusDropdown" name="Edit-ProductStatusDropdown" disabled>
                            <?php
                            if ($ProductQueryResult['ProductStatus'] == "Inactive"){ ?>
                                <option value="<?php echo $ProductQueryResult['ProductStatus'];?>" selected><?php echo $ProductQueryResult['ProductStatus'];?></option>
                                <option value="Active">Active</option>
                                <?php
                            }
                            else { ?>
                                <option value="<?php echo $ProductQueryResult['ProductStatus'];?>" selected><?php echo $ProductQueryResult['ProductStatus'];?></option>
                                <option value="Inactive">Inactive</option>
                            <?php
                            }
                            ?>
                            </select>
                        </div>
                    </div>
                <div class="row mt-4" id="stockinput-container">
                    <h5 style="font-family: Verdana; text-align: left;" id="editproduct-label">Stock Details</h5>
                    <div class="form-row d-flex justify-content-center mt-1" style="padding-left: 15px; padding-right: 11px;">
                        <label style="width: 200px; align-self: center;" id="stockinput-label">Last Added Stock:</label><input type="text" class="form-control" id="ProductLastAddedStockCount" name="EditInventory-ProductLastStockAdded" placeholder="Last Added Stock Count" value="<?php echo $ProductQueryResult['LastAddedStockCount'];?>" disabled>
                    </div>
                    <div class="form-row d-flex justify-content-center mt-1" style="padding-left: 15px; padding-right: 11px;">
                        <label style="width: 200px; align-self: center;" id="stockinput-label">Current Stock:</label><input type="text" class="form-control" id="ProductCurrentStockCount" name="EditInventory-ProductCurrentStock" placeholder="Current Stock Count" value="<?php echo $ProductQueryResult['CurrentStockCount'];?>" disabled>
                    </div>
                    <div class="form-row d-flex justify-content-center mt-1" style="padding-left: 15px; padding-right: 11px;">
                        <label style="width: 200px; align-self: center;" id="stockinput-label">Add Product Stock:</label><input type="number" class="form-control" id="AddStock" name="EditInventory-AddProductStock" placeholder="Current Stock Count" value="0">
                    </div>
                </div>

                <div class="row" style="width: 300px">
                    <div class="container-fluid d-flex justify-content-start mt-2">
                       <button type="submit" class="btn btn-dark" id="EditProductInventoryBtn" name="updateproductinventorybtn" title="Edit Product Inventory">Save Changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>



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

unset($_SESSION['prdctid']);
?>
<html>
<head>

    <title>Products - Shoppr</title>
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

    <!-- server-side error prompt for adding category-->
    <?php
    if (isset($_SESSION['AddCategory-Status'])) { ?>
        <!-- Alert dialog for user info editing errors -->
        <div class="alert alert-info d-flex justify-content-between" role="alert" id="AdminError-AlertDialog">
            <p id="AdminError-AlertDialogText"><?php echo $_SESSION['AddCategory-Status']?></p>
            <button type="button" class="close ml-3 bg-transparent border-0" id="AdminError-AlertClose" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php
    }
    unset($_SESSION['AddCategory-Status']);
    ?>

    <!-- server-side error prompt for adding product-->
    <?php
    if (isset($_SESSION['AddProduct-Status'])) { ?>
        <!-- Alert dialog for user info editing errors -->
        <div class="alert alert-info d-flex justify-content-between" role="alert" id="AdminError-AlertDialog">
            <p id="AdminError-AlertDialogText"><?php echo $_SESSION['AddProduct-Status']?></p>
            <button type="button" class="close ml-3 bg-transparent border-0" id="AdminError-AlertClose" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php
    }
    unset($_SESSION['AddProduct-Status']);
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
                <a href="admin-products.php" class="nav-link" id="adminSidebar-tabActive">Products</a>
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
                <a href="admin-accountmanagement.php" class="nav-link" id="adminSidebar-tabInactive">Admin Account Management</a>
            </div>
        </div>
    </div>

    <!--Main Content-->
    <div class="container" id="admin-maincontainer">
        <h2 id="admin-pagetitle">Products</h2>
        <hr>
        <div class="container p-1">
            <!-- Form for adding new product-->
            <form action="../process-controllers/controls-addproduct.php" method="POST" enctype="multipart/form-data">
                <h5 style="font-family: Verdana; text-align: left;" id="addproduct-label">Add Product</h5>
                <div class="form-row d-flex justify-content-center" style="padding-left: 15px; padding-right: 6px;">
                    <div class="col-4" style="margin-right: 10px;">
                        <input type="text" class="form-control" id="ProductName" name="ProductName" placeholder="Item Name" required>
                    </div>
                    <div class="col-4" style="margin-right: 10px;">
                        <select type="number" class="form-select" style="border: 2px solid dimgray" id="ProductCategoryDropdown" name="ProductCategoryDropdown" required>
                            <option value="0" selected>--Select Category--</option>
                            <?php
                            //getting the categories
                            $CategoryQuery = "SELECT * FROM category";
                            $CategoryQueryExecution = mysqli_query($conn, $CategoryQuery);

                            while ($CategoryQueryResult = mysqli_fetch_array($CategoryQueryExecution)){ ?>
                                <option value="<?php echo $CategoryQueryResult['CategoryID'];?>"><?php echo $CategoryQueryResult['CategoryName']; ?></option>
                            <?php
                            }
                            ?>

                        </select>
                        </ul>
                    </div>
                    <div class="col-4" style="margin-right: 10px; margin-bottom: 10px;">
                        <div class="input-group">
                            <span class="input-group-text" style="border: 2px solid dimgray" id="ProductPrice-CurrencyLabel">₱</span>
                            <input type="number" class="form-control" id="ProductPrice" name="ProductPrice" placeholder="Price" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="ProductDescription" name="ProductDescription" placeholder="Product Description" required>
                    </div>
                    <div class="col-sm-4 d-flex align-items-center">
                        <input type="file" name="ProductImageFile" id="ProductImageFile" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-dark mt-2" id="AddProductBtn" name="submit" title="Add Product">Add New Product</button>
            </form>
        </div>

        <!-- Form for adding category-->
        <div class="container p-1">
            <form action="../process-controllers/controls-addcategory.php" method="POST">
                <h5 style="font-family: Verdana; text-align: left;" id="addproduct-label">Add Product Category</h5>
                <div class="row d-flex justify-content-start" style="padding-right: 6px;">
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="CategoryName" name="CategoryName" placeholder="Category Name" required>
                    </div>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="CategoryCode" name="CategoryCode" placeholder="3-Letter Category Code" required>
                    </div>
                    <div class="col-sm-4">
                        <button type="submit" class="btn btn-dark" id="AddCategoryBtn" title="Add Category">Add New Category</button>
                    </div>

            </form>
        </div>

        <!-- Product List Table-->
        <div class="container justify-content-center border shadow p-3 mb-5 bg-white rounded" id="admin-tablecontainer">
            <h5 id="table-title">Product List</h5>
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col" id="tableCell-ProductName">Product Name</th>
                        <th scope="col">Category</th>
                        <th scope="col">SKU</th>
                        <th scope="col">Price Per Unit</th>
                        <th scope="col">Current Stock</th>
                        <th scope="col">Product Status</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    //getting all the products
                    $getProductsQuery = "SELECT * FROM product";
                    $getProductsQueryExecution = mysqli_query($conn, $getProductsQuery);


                    while($getProductsQueryResult = mysqli_fetch_assoc($getProductsQueryExecution)){

                        //getting the category of the product
                        $productcategory_ID =  $getProductsQueryResult['CategoryID'];
                        $getCategoryQueryExecution = mysqli_query($conn,"SELECT * FROM category WHERE CategoryID='$productcategory_ID'");
                        $productCategoryQueryResult = mysqli_fetch_assoc($getCategoryQueryExecution);
                        $productcategory_Name = $productCategoryQueryResult['CategoryName'];

                        ?>
                    <tr>
                        <th scope="row"><?php echo $getProductsQueryResult['ProductID']; ?></th>
                        <td><?php echo $getProductsQueryResult['ProductName']; ?></td>
                        <td><?php echo $productcategory_Name; ?></td>
                        <td><?php echo $getProductsQueryResult['SKU']; ?></td>
                        <td><?php echo $getProductsQueryResult['PricePerUnit']; ?></td>
                        <td><?php echo $getProductsQueryResult['CurrentStockCount']; ?></td>
                        <td><?php echo $getProductsQueryResult['ProductStatus']; ?></td>
                        <td>
                            <a href="admin-editproduct.php?prdctid=<?php echo $getProductsQueryResult['ProductID'];?> ">
                                <button class="btn btn-success" title="Edit Product Details" id="editproduct-btn"><i class="bi bi-pencil-fill"></i></button>
                            </a>
                        </td>
                    </tr>
                   <?php
                    }
                    ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>



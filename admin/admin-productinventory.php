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
    <title>Inventory - Shoppr</title>
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

    <<!-- Navigation bar at the top page -->
    <nav class="navbar fixed-top navbar-expand navbar-dark bg-dark">
        <div class="container-fluid d-flex justify-content-between">
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
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown" id="adminnavdropdown">
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
        <h2 id="admin-pagetitle">Inventory Management</h2>
        <hr>
        <div class="container justify-content-center border shadow p-3 mb-5 bg-white rounded" id="admin-tablecontainer">
            <h4 id="table-title">Product Inventory</h4>
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Category</th>
                        <th scope="col">SKU</th>
                        <th scope="col">Last Added Stock</th>
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
                            <td><?php echo $getProductsQueryResult['LastAddedStockCount']; ?></td>
                            <td><?php echo $getProductsQueryResult['CurrentStockCount']; ?></td>
                            <td><?php echo $getProductsQueryResult['ProductStatus']; ?></td>
                            <td>
                                <a href="admin-editproductinventory.php?prdctid=<?php echo $getProductsQueryResult['ProductID'];?> ">
                                    <button class="btn btn-success" title="Update Product Inventory" id="editproductinventory-btn"><i class="bi bi-pencil-fill"></i></button>
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



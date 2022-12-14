<html>
<head>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <!-- JavaScript resources-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="../jquery.min.js"></script>
    <script type="text/javascript" src="../js/functions-js.js"></script>
    <meta charset="utf-8">
</head>
<body>

    <!-- Navigation bar at the top page -->
    <nav class="navbar fixed-top navbar-expand navbar-dark bg-dark">
        <div class="container-fluid d-flex justify-content-center">
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
            <div class="container d-flex justify-content-end" id="adminlogoutcontainer">
                <ul class="d-flex justify-content-end" id="navlist">
                    <!--Dropdown-->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-light" href="#" id="adminMenuDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Menu
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
                <a href="admin-productinventory.php" class="nav-link" id="adminSidebar-tabInactive">Manage Inventory</a>
            </div>
            <div>
                <a href="admin-activitylog.php" class="nav-link" id="adminSidebar-tabActive">Activity Log</a>
            </div>
            <div>
                <a href="admin-orders.php" class="nav-link" id="adminSidebar-tabInactive">Orders</a>
            </div>
        </div>
    </div>

    <!--Main Content-->
    <div class="container" id="admin-maincontainer">
        <div class="container justify-content-center border shadow p-3 mb-5 bg-white rounded" id="admin-tablecontainer">
            <h4 id="table-title">Activity Log</h4>
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Activity ID</th>
                        <th scope="col">Admin ID</th>
                        <th scope="col">Admin Name</th>
                        <th scope="col">Activity</th>
                        <th scope="col">Description</th>

                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>1</td>
                        <td>Jemrel Mangaliman</td>
                        <td>Order Update</td>
                        <td>Updated the order status of Order 00001 from confirming to pending</td>
                    </tr>
                    <tr>
                        <th scope="row">1</th>
                        <td>1</td>
                        <td>Jemrel Mangaliman</td>
                        <td>Order Update</td>
                        <td>Updated the order status of Order 00001 from confirming to pending</td>
                    </tr>
                    <tr>
                        <th scope="row">1</th>
                        <td>1</td>
                        <td>Jemrel Mangaliman</td>
                        <td>Order Update</td>
                        <td>Updated the order status of Order 00001 from confirming to pending</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>



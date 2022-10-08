<html>
<head>
    <link rel="stylesheet" type="text/css" href="bootstrap-4.0.0-dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="jquery.min.js"></script>
    <script type="text/javascript" src="js/functions-js.js"></script>
</head>
<body class="bg-light">
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
                    <a class="nav-link text-light" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="user-profile-cart.php" id="shoppingcartlink"><i class="bi bi-cart4" id="shoppingcart"></i></a>
                </li>

                <!--Dropdown-->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Menu
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown" id="navdropdown">
                        <a class="dropdown-item" href="#" ><i class="bi bi-person-fill" id="menuicon"></i>Profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="index.php"><i class="bi bi-box-arrow-right" id="menuicon"></i>Log Out</a>
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
                    <img src="images/profile-pic.png" class="rounded-circle" id="profilepic">
                </div>
                <div class="col-sm-8" id="profile-userinfoheader">
                    <div class="row" style="margin-bottom: -5px;">
                        <div class="col-11">
                            <p class="h4" id="user-name">Jemrel Ricky Mangaliman</p>
                        </div>
                        <div class="col-1" style="margin-left: -35px;">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-outline-dark bg-transparent border-0 shadow-none" id="edit-profile-button" data-toggle="modal" data-target="#UserInformationModal">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                        </div>
                    </div>
                    <div class="row" style="margin-bottom: -15px;">
                        <p id="user-email">mangalimanjemrel@gmail.com</p>
                    </div>
                    <div class="row">
                        <small id="user-address">Cavite, Region 4-A, Luzon, Philippines, Earth, Milky Way Galaxy</small>
                    </div>
                </div>
            </div>
        </div>
        <!-- Code for tabs (Cart, Pending, Completed)-->
        <div class="container-fluid d-flex justify-content-center" id="profile-secondarycontainer">
            <nav class="navbar navbar-expand-lg" id="profile-ordernav">
                <ul class="d-flex" id="profile-navlist">
                    <li class="nav-item">
                        <a class="nav-link text-secondary text-center" id="tab-inactive" href="user-profile-cart.php"><i class="bi bi-cart4" id="profile-shoppingcart"></i><p id="profile-tabtext">Your Cart</p></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark text-center" id="tab-active" href="user-profile-pending.php"><i class="bi bi-card-list" id="profile-cardlistpending"></i><p id="profile-tabtext">Pending Orders</p></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-secondary text-center" id="tab-inactive" href="user-profile-completed.php"><i class="bi bi-clipboard-check" id="profile-clipboardcomplete"></i><p id="profile-tabtext">Completed Orders</p></a>
                    </li>
                </ul>
            </nav>
        </div>

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
                        <img class="card-img" id="product-img" src="images/electric-drill.jpg" alt="Card image cap">
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
                        <h6 class="card-title" id="product-name">1</h6>
                    </div>

                    <!--Total Price here-->
                    <div class="col-2 d-flex align-items-center justify-content-center">
                        <p class="card-text text-success font-weight-bold" id="product-total-price">₱2500.00</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="UserInformationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
</body>
</html>



<?php
session_start();
$conn = require '../database/connection.php';

    //getting user information using stored UserID from Session variable
    if (isset($_SESSION['UserID'])){
        $UID = $_SESSION['UserID'];
        $UserInformationQuery = "SELECT * FROM user where UserID='$UID'";
        $UserInformationQueryExecution = mysqli_query($conn,$UserInformationQuery);
        $UserInformation = mysqli_fetch_assoc($UserInformationQueryExecution);

        //check if there are no filters set. If not filter is set, then the default value is 0
        if(!isset($_SESSION['PriceFilter']) && !isset($_SESSION['CategoryFilter'])){
            $PriceFilter = 0;
            $CategoryFilter = 0;
        }
        else { //if there are filter/s set, then we assign the session variables to local variables
            $PriceFilter = $_SESSION['PriceFilter'];
            $CategoryFilter = $_SESSION['CategoryFilter'];
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
            <form class="form-inline my-2 ml-auto mr-auto d-flex justify-content-center" method="POST" action="#">
                <input class="form-control" type="search" placeholder="Search" aria-label="Search" id="searchbox">
                <button class="btn btn-outline-light my-2 my-sm-0" type="submit" id="searchBtn">Search</button>
            </form>

            <!--navbar links-->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-light" href="#"><i class="bi bi-house-door-fill" id="homeicon"></i><small id="navbarDropdown-label">Home</small></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="user-profile.php" id="shoppingcartlink"><i class="bi bi-cart4" id="shoppingcart"></i><small id="navbarDropdown-label">Shopping Cart</small></a>
                </li>

                <!--Dropdown-->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Menu
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown" id="navdropdown">
                        <a class="dropdown-item" href="../user/user-profile.php" id="user-menuitem"><i class="bi bi-person-fill" id="menuicon"></i>Profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="../index.php" id="user-menuitem"><i class="bi bi-box-arrow-right" id="menuicon"></i>Log Out</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <!--Main content-->
    <div class="jumbotron jumbotron-fluid" id="jumbotron-container">
        <div class="container-fluid d-flex justify-content-center align-items-center">
            <h1 class="display-6" style="margin-top: 120px;">Shop Now!</h1>
        </div>
    </div>

    <div class="container" id="productview-container">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <h2 id="user-pagetitle">Products</h2>
                    </div>
                    <div class="col-sm-8">
                        <form method="POST" action="../process-controllers/controls-productviewfilter.php">
                            <!--Product Filtering-->
                            <div class="container d-flex justify-content-end"  id="filter-container">
                                <p id="ProductFilter-label">Filter:</p>
                                <select type="number" class="form-select" style="border: 2px solid dimgray" id="UserView-ProductCategoryFilter" name="UserView-ProductCategoryFilter">
                                    <option value="0">-Select Category-</option>
                                    <?php
                                    //get categories
                                    $getCategoriesQuery = "SELECT * FROM category";
                                    $getCategoriesQueryExecution = mysqli_query($conn, $getCategoriesQuery);

                                    while ($getCategoriesResult = mysqli_fetch_assoc($getCategoriesQueryExecution)){
                                        if ($CategoryFilter != 0 && $CategoryFilter == $getCategoriesResult['CategoryID']){
                                        ?>
                                            <option value="<?php echo $getCategoriesResult['CategoryID']?>" selected><?php echo $getCategoriesResult['CategoryName']?></option>
                                    <?php }
                                        else { ?>
                                            <option value="<?php echo $getCategoriesResult['CategoryID']?>"><?php echo $getCategoriesResult['CategoryName']?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                                <select type="number" class="form-select" style="border: 2px solid dimgray" id="UserView-ProductPriceFilter" name="UserView-ProductPriceFilter">
                                    <?php
                                    if ($PriceFilter != 0){
                                        if($PriceFilter == 1) {
                                            echo '
                                        <option value="0">-Select Price-</option>
                                        <option value="1" selected>Lowest to Highest</option>
                                        <option value="2">Highest to Lowest</option>
                                        ';
                                        }
                                        else if($PriceFilter == 2) {
                                            echo '
                                        <option value="0">-Select Price-</option>
                                        <option value="1">Lowest to Highest</option>
                                        <option value="2" selected>Highest to Lowest</option>
                                        ';
                                        }
                                    }
                                    else {
                                        echo '
                                        <option value="0">-Select Price-</option>
                                        <option value="1">Lowest to Highest</option>
                                        <option value="2">Highest to Lowest</option>
                                        ';
                                    }
                                    ?>


                                </select>
                                <button type="submit" class="btn btn-dark" id="filterbtn"><i class="bi bi-arrow-right"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <hr>

        <div class="row">
            <div class="container" id="productlist-container">

                    <?php
                    if ($CategoryFilter != 0) {
                        if($_SESSION['PriceFilter'] != 0){

                            if($PriceFilter == 1){
                                //getting all the existing products (filtered by category and price (low to high))
                                $getProductQuery = "SELECT * FROM product WHERE CategoryID='$CategoryFilter' ORDER BY PricePerUnit ASC";
                                $getProductQueryExecution = mysqli_query($conn, $getProductQuery);
                            }
                            else if ($PriceFilter == 2) {
                                //getting all the existing products (filtered by category and price (high to low))
                                $getProductQuery = "SELECT * FROM product WHERE CategoryID='$CategoryFilter' ORDER BY PricePerUnit DESC";
                                $getProductQueryExecution = mysqli_query($conn, $getProductQuery);
                            }
                        }
                        else {
                            //getting all the existing products (filtered by category only)
                            $getProductQuery = "SELECT * FROM product WHERE CategoryID='$CategoryFilter'";
                            $getProductQueryExecution = mysqli_query($conn, $getProductQuery);
                        }
                    }
                    else if ($PriceFilter != 0){
                        if($PriceFilter == 1){
                            //getting all the existing products (filtered by price (low to high))
                            $getProductQuery = "SELECT * FROM product ORDER BY PricePerUnit ASC";
                            $getProductQueryExecution = mysqli_query($conn, $getProductQuery);
                        }
                        else if ($PriceFilter == 2) {
                            //getting all the existing products (filtered by price (high to low))
                            $getProductQuery = "SELECT * FROM product ORDER BY PricePerUnit DESC";
                            $getProductQueryExecution = mysqli_query($conn, $getProductQuery);
                        }
                    }
                    else {
                        //getting all the existing products no filter)
                        $getProductQuery = "SELECT * FROM product";
                        $getProductQueryExecution = mysqli_query($conn, $getProductQuery);
                    }

                    $rowcontentcounter = 1;


                    while ($getProductResult = mysqli_fetch_assoc($getProductQueryExecution)){

                        if($getProductResult['ProductStatus'] == "Active" && $getProductResult['CurrentStockCount'] > 0){
                            //getting the product category
                            $ProductCategory = $getProductResult['CategoryID'];
                            $getProductCategoryQueryExecution = mysqli_query($conn, "SELECT * FROM category WHERE CategoryID='$ProductCategory'");
                            $getProductCategoryResult = mysqli_fetch_assoc($getProductCategoryQueryExecution);

                            //getting the product rating
                            $ProductRatingID = $getProductResult['RatingID'];
                            $ProductRatingQuery = "SELECT * FROM rating WHERE RatingID = '$ProductRatingID'";
                            $ProductRatingQueryExecution = mysqli_query($conn, $ProductRatingQuery);
                            $ProductRatingResult = mysqli_fetch_assoc($ProductRatingQueryExecution);

                            if ($rowcontentcounter == 1) {
                                echo '<div class="row" id="ProductCard-Row">';
                            }

                            if($rowcontentcounter >= 1 && $rowcontentcounter <= 4) { ?>
                                <div class="col-6 col-sm-3">
                                    <a href="../user/user-viewproduct.php?prdctid=<?php echo $getProductResult['ProductID'];?>" id="ProductCard-Link">
                                        <div class="card border shadow p-3 bg-white rounded" id="ProductCard">
                                            <img class="card-img-top" id="ProductCard-ProductImage" src="<?php echo $getProductResult['ProductImageURL'];?>" alt="Card image cap">
                                            <div class="card-body d-flex flex-column justify-content-between p-2">
                                                <div class="row">
                                                    <h6 class="card-text" id="ProductCard-ProductName"><?php echo $getProductResult['ProductName'];?></h6>
                                                    <small id="ProductCard-ProductCategory"><?php echo $getProductCategoryResult['CategoryName'];?></small>
                                                </div>
                                                <div class="container d-flex justify-content-center" id="ProductCard-StarContainer">
                                                    <?php
                                                    for ($x = 1; $x<=5; $x++){
                                                        if ($ProductRatingResult['AverageRating'] >= $x){
                                                            echo '<i class="bi bi-star-fill" id="ProductCard-StarFill"></i>';
                                                        }
                                                        else {
                                                            echo '<i class="bi bi-star" id="ProductCard-Star"></i>';
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="card-footer" >
                                                <h6 class="card-text" id="ProductCard-ProductPrice">₱ <?php echo $getProductResult['PricePerUnit'];?></h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <?php
                            }

                            if($rowcontentcounter > 4) {
                                echo '</div>';
                                echo '<div class="row" id="ProductCard-Row">';
                                $rowcontentcounter = 1; ?>
                                <div class="col-6 col-sm-3">
                                    <a href="../user/user-viewproduct.php?prdctid=<?php echo $getProductResult['ProductID'];?>" id="ProductCard-Link">
                                        <div class="card border shadow p-3 bg-white rounded" id="ProductCard">
                                            <img class="card-img-top" id="ProductCard-ProductImage" src="<?php echo $getProductResult['ProductImageURL'];?>" alt="Card image cap">
                                            <div class="card-body d-flex flex-column justify-content-between p-2">
                                                <div class="row">
                                                    <h6 class="card-text" id="ProductCard-ProductName"><?php echo $getProductResult['ProductName'];?></h6>
                                                    <small id="ProductCard-ProductCategory"><?php echo $getProductCategoryResult['CategoryName'];?></small>
                                                </div>
                                                <div class="container d-flex justify-content-center" id="ProductCard-StarContainer">
                                                    <?php
                                                    for ($x = 1; $x<=5; $x++){
                                                        if ($ProductRatingResult['AverageRating'] >= $x){
                                                            echo '<i class="bi bi-star-fill" id="ProductCard-StarFill"></i>';
                                                        }
                                                        else {
                                                            echo '<i class="bi bi-star" id="ProductCard-Star"></i>';
                                                        }
                                                    }

                                                    ?>
                                                </div>
                                            </div>
                                            <div class="card-footer" >
                                                <h6 class="card-text" id="ProductCard-ProductPrice">₱ <?php echo $getProductResult['PricePerUnit'];?></h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <?php
                            }

                         }
                        //increment $rowcontentcounter
                        $rowcontentcounter++;
                    }
                    ?>
            </div>
        </div>
    </div>

</body>
</html>



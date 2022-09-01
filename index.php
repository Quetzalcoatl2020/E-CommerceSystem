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
                <button class="btn btn-outline-success" id="buttonlogin"><a href="index.php" class="text-success" id="linklogin">Login</a></button>
            </li>

        </ul>
    </div>
</nav>

    <!--Main Content-->
    <div class="container">
        <div class="row" id="landingcontent">
            <!--Form Area-->
            <div class="col-lg" id="landingcontent-firstcolumn">
                <form id="loginform">
                    <h5 style="font-family: Verdana; text-align: center">Login</h5>
                    <div class="form-group">
                        <input type="email" class="form-control" id="Email" placeholder="Email">
                        <!---<small class="form-text text-muted">We'll never share your email with anyone else.</small>-->
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="Password1" placeholder="Password">
                    </div>
                    <button type="submit" id="formbuttonregister" class="btn btn-outline-success">Login</button>
                </form>
            </div>
            <!--Tagline Text Area-->
            <div class="col-lg" id="landingcontent-secondcolumn">
                <h1 id="tagline">Easy Shopping? Do it with Shoppr.</h1>
                <p id="landingcontent-smalldescription">Enjoy hassle-free shopping as Shoppr bring different products closer to you! Shop easy in three steps: Add to cart, Check out, Enjoy.</p>
            </div>
    </div>
    </div>




</body>
</html>
<?php
?>


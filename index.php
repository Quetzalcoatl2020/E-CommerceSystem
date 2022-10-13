<html>
<head>
    <!-- CSS only -->
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
<body id="frontpages-background">
    <!-- Navigation bar at the top page -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
        <!-- Brand logo -->
        <span class="navbar-brand h1">Shoppr</span>
        <!-- Login and Sign up links-->
        <div class="container" id="LoginSignupContainer">
            <ul class="d-flex justify-content-end" id="navlist">
                <li class="nav-item">
                    <a class="nav-link text-light" href="signup.php" id="linksignup">Sign Up</a>
                </li>
                <li class="nav-item">
                    <a href="index.php" class="text-dark" id="linklogin"><button class="btn btn-outline-light" id="buttonlogin">Login</button></a>
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
                    <div class="form-group">
                        <input type="email" class="form-control" id="Email" placeholder="Email" required>
                        <!---<small class="form-text text-muted">We'll never share your email with anyone else.</small>-->
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="Password1" placeholder="Password" required>
                    </div>
                    <button type="submit" id="formbuttonlogin" class="btn btn-outline-dark">Login</button>
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



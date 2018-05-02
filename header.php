<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Everyday Cooking</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="/index.php">Eveyday Cooking</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="/index.php">HOME</a></li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">CATEGORY
                    <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="/ImmediateImmersion/breakfast.php">Breakfast</a></li>
                    <li><a href="/ImmediateImmersion/lunch.php">Lunch</a></li>
                    <li><a href="/ImmediateImmersion/dinner.php">Dinner</a></li>
                    <li><a href="/ImmediateImmersion/dessert.php">Dessert</a></li>
                </ul>
            </li>
<!--            <li><a href='search/search.php'>Search</a>-->
            <?php
            session_start();
//            echo "enter the navi php";
//            echo $_SESSION['login_user'];
            if(empty($_SESSION['login_user'])) {
                echo "<li><a href='/SignInUpOut/signIn.html'>SIGN IN</a>";
                echo "</li><li><a href='/SignInUpOut/signUp.html'>SIGN UP</a></li>";
            } else {
                //payground is used to generate recommendation
//                echo "<li><a href='/playground.php'>PLAYGROUND</a></li>";
                echo "<li><a href='/profile/profile.php'>DASHBOARD</a></li>";
                echo "<li><a href='/SignInUpOut/SignOut.php'>SIGN OUT</a></li>";
            }
            ?>

            <li>
                <form class="form-inline my-2 my-lg-0" method="post" action="/search/searchPage.php">
                    <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search" name="search_string">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </li>
            <li><a href="/search/searchPage.php">Search</a></li>
        </ul>
    </div>
</nav>



</body>


<!--<button><a href="index.php">Home</button>-->

</html>

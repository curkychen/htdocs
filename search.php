<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!--	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
<!--    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
	<title>Every day cooking</title>
	<style type="text/css">
		.dropdown-submenu {
			width: 196px;
    		position: relative;
		}
 
		.dropdown-submenu>.dropdown-menu {
			width: 260px;
		    top: 0;
		    right: 100%;
		    margin-top: -6px;
		    margin-right: -1px;
		}
		 
		.dropdown-submenu:hover>.dropdown-menu {
		    display: block;
		}
		 
		.dropdown-submenu>a:after {
		    display: block;
		    content: " ";
		    float: right;
		    width: 0;
		    height: 0;
		    border-color: transparent;
		    border-style: solid;
		    border-width: 5px 0 5px 5px;
		    border-right-color: #ccc;
		    margin-top: 5px;
		    margin-right: -10px;
		}
		 
		.dropdown-submenu:hover>a:after {
		    border-right-color: #fff;
		}
		 
		.dropdown-submenu:hover {
		    background: white;
		}
		 
		.dropdown-submenu.pull-right {
		    float: none;
		}
		 
		.dropdown-submenu.pull-right>.dropdown-menu {
		    right: -100%;
		    margin-right: 10px;
		}
		.jumbotron {
		    background-color: #fffdfd;
		    color: black;
		    padding: 66px 136px;
		    padding-bottom: 0;
		    font-family: Montserrat, sans-serif;
		}
		.navbar {
		    margin-bottom: 0;
		    background-color: #d1d8bf;
		    z-index: 9999;
		    border: 0;
		    font-size: 14px !important;
		    line-height: 1.42857143 !important;
		    letter-spacing: 4px;
		    border-radius: 0;
		    font-family: Montserrat, sans-serif;
		}
		.navbar li a, .navbar .navbar-brand {
		    color: black !important;
		}
		.navbar-nav li a:hover, .navbar-nav li.active a {
		    color: #000000 !important;
		    background-color: #fff !important;
		}
		.navbar-default .navbar-toggle {
		    border-color: transparent;
		    color: #fff !important;
		}
		.mainbody {
			background-color: rgba(255, 248, 241, 0);
		}
		.fill {
			background-color: black;
			height: 1px;
		}
		.error {
			color: red;
		}
        .redirect {
            color: darkblue;
        }
		.centerdiv {
			text-align: center;
			margin-left: auto;
			margin-right: auto;
		}
        .postdisplay {
            text-align: left;
            padding-left: 10%;
            margin-left: auto;
            margin-right: auto;
            font-size: large;
            background-color: antiquewhite;
            width: fit-content;
            border-style: groove;
            padding-left: 16px;
            padding-right: 16px;
            width: 50%;
            margin-bottom: 10px;
        }
        h4 {
            font-family: "Apple LiGothic";
            font-size: 18px;
        }
        .like_favorite {
            text-align: right;
            padding-right: 10px;
            padding-bottom: 16px;
        }
        .submitbutton {
            background-color: antiquewhite;
            font-family: "Apple LiGothic";
            font-style: italic;
            font-size: 24px;
            border-style: groove;
        }
        button {
            background-color: antiquewhite;
            font-family: "Apple LiGothic";
            font-style: italic;
            font-size: 24px;
            border-style: groove;
        }
        .gotobutton {
            background-color: antiquewhite;
            font-family: "Apple LiGothic";
            font-style: italic;
            font-size: 60px;
            border-style: none;
        }
        a:hover {
            font-size: 24px;
            color: chocolate;
        }

	</style>
</head>

<body class="mainbody">

	<div id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
		<nav class="navbar navbar-default navbar-fixed-top">
		  <div class="container">
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>                        
		      </button>
<!--		      <a class="navbar-brand" href="#myPage">Post your favourite food recipe</a>-->
		    </div>
		    <div class="collapse navbar-collapse" id="myNavbar">
		      <ul class="nav navbar-nav navbar-right">
		        <li>
		        	<a class="dropdown-toggle" data-toggle="dropdown" href="#">CATEGORY<span class="caret"></span></a>
	        		<ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
				        <li class="dropdown-submenu">
	            			<a tabindex="-1" href="dog_search.php">Breakfast</a>
<!--	            			<ul class="dropdown-menu">-->
<!--	              				<li><a  href="shepherd_search.php">SHEPHERD</a></li>-->
<!--	              				<li><a tabindex="terrier_search.php" href="#">TERRIER</a></li>-->
<!--	              				<li><a tabindex="-1" href="retriever_search.php">RETRIVER</a></li>-->
<!--	            			</ul>-->
	          			</li>
                        <li class="dropdown-submenu">
                            <a tabindex="-1" href="cat_search.php">Lunch</a>
<!--                            <ul class="dropdown-menu">-->
<!--                                <li><a tabindex="-1" href="ragdoll_search.php">RAGDOLL</a></li>-->
<!--                                <li><a tabindex="-1" href="siamese_search.php">SIAMESE</a></li>-->
<!--                            </ul>-->
                        </li>
				        <li class="dropdown-submenu">
	            			<a tabindex="-1" href="cat_search.php">Dessert</a>
<!--	            			<ul class="dropdown-menu">-->
<!--	              				<li><a tabindex="-1" href="ragdoll_search.php">RAGDOLL</a></li>-->
<!--                                <li><a tabindex="-1" href="siamese_search.php">SIAMESE</a></li>-->
<!--	            			</ul>-->
	          			</li>
                        <li class="dropdown-submenu">
                            <a tabindex="-1" href="rabbit_search.php">Dinner</a>
<!--                            <ul class="dropdown-menu">-->
<!--                                <li><a tabindex="-1" href="lop_search.php">LOP</a></li>-->
<!--                                <li><a tabindex="-1" href="plush_search.php">PLUSH</a></li>-->
<!--                            </ul>-->
                        </li>
	       			 </ul>
		        </li>

		        <?php
		        	if(empty($_SESSION['login_user'])) {
		        		echo "<li><a href='login.php'>SIGN IN</a>";
		        		echo "</li><li><a href='sign_up.php'>SIGN UP</a></li>";
		        	} else {
		        		echo "<li><a href='header.php'>PLAYGROUND</a></li>";
                        echo "<li><a href='profile/profile.php'>HOME</a></li>";
		        		echo "<li><a href='signout.php'>SIGN OUT</a></li>";
		        	}
		        ?>
		        <!-- <li><a href="login.php">SIGN IN</a></li>
		        <li><a href="register.php">SIGN UP</a></li>
		        <li><a href="##">HOME</a></li>
		        <li><a href="##">SIGN OUT</a></li> -->
		      </ul>
		    </div>
		  </div>
		</nav>

		<div class="jumbotron text-center">
		  <h1>Enjoy your life, Enjoy your food</h1>
		  <p>Search the recipe</p>
		  <form action="searchbyinput.php" method="post">
		    <div class="input-group">
                <input type="hidden" name="search_post" value="true">
                <input type="text" class="form-control" name="search_string" size="50" placeholder="What do you want to know?" required>
		      <div class="input-group-btn">
		        <input type="submit" class="btn btn-danger" value="Search">
		      </div>
		    </div>
		  </form>
		</div>
	</div>

	<div class="fill">


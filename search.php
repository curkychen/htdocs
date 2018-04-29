<?php
    session_start();
    include ("header.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!--	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
<!--    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
	<title>Every day cooking</title>
</head>

<body class="mainbody">

	<div id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
<!--		<nav class="navbar navbar-default navbar-fixed-top">-->
<!--		  <div class="container">-->
<!--		    <div class="navbar-header">-->
<!--		      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">-->
<!--		        <span class="icon-bar"></span>-->
<!--		        <span class="icon-bar"></span>-->
<!--		        <span class="icon-bar"></span>                        -->
<!--		      </button>-->
<!--<!--		      <a class="navbar-brand" href="#myPage">Post your favourite food recipe</a>-->-->
<!--		    </div>-->
<!--		    <div class="collapse navbar-collapse" id="myNavbar">-->
<!--		      <ul class="nav navbar-nav navbar-right">-->
<!--		        <li>-->
<!--		        	<a class="dropdown-toggle" data-toggle="dropdown" href="#">CATEGORY<span class="caret"></span></a>-->
<!--	        		<ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">-->
<!--				        <li class="dropdown-submenu">-->
<!--	            			<a tabindex="-1" href="dog_search.php">Breakfast</a>-->
<!--<!--	            			<ul class="dropdown-menu">-->-->
<!--<!--	              				<li><a  href="shepherd_search.php">SHEPHERD</a></li>-->-->
<!--<!--	              				<li><a tabindex="terrier_search.php" href="#">TERRIER</a></li>-->-->
<!--<!--	              				<li><a tabindex="-1" href="retriever_search.php">RETRIVER</a></li>-->-->
<!--<!--	            			</ul>-->-->
<!--	          			</li>-->
<!--                        <li class="dropdown-submenu">-->
<!--                            <a tabindex="-1" href="cat_search.php">Lunch</a>-->
<!--<!--                            <ul class="dropdown-menu">-->-->
<!--<!--                                <li><a tabindex="-1" href="ragdoll_search.php">RAGDOLL</a></li>-->-->
<!--<!--                                <li><a tabindex="-1" href="siamese_search.php">SIAMESE</a></li>-->-->
<!--<!--                            </ul>-->-->
<!--                        </li>-->
<!--				        <li class="dropdown-submenu">-->
<!--	            			<a tabindex="-1" href="cat_search.php">Dessert</a>-->
<!--<!--	            			<ul class="dropdown-menu">-->-->
<!--<!--	              				<li><a tabindex="-1" href="ragdoll_search.php">RAGDOLL</a></li>-->-->
<!--<!--                                <li><a tabindex="-1" href="siamese_search.php">SIAMESE</a></li>-->-->
<!--<!--	            			</ul>-->-->
<!--	          			</li>-->
<!--                        <li class="dropdown-submenu">-->
<!--                            <a tabindex="-1" href="rabbit_search.php">Dinner</a>-->
<!--<!--                            <ul class="dropdown-menu">-->-->
<!--<!--                                <li><a tabindex="-1" href="lop_search.php">LOP</a></li>-->-->
<!--<!--                                <li><a tabindex="-1" href="plush_search.php">PLUSH</a></li>-->-->
<!--<!--                            </ul>-->-->
<!--                        </li>-->
<!--	       			 </ul>-->
<!--		        </li>-->
<!---->
<!--		        --><?php
//		        	if(empty($_SESSION['login_user'])) {
//		        		echo "<li><a href='login.php'>SIGN IN</a>";
//		        		echo "</li><li><a href='sign_up.php'>SIGN UP</a></li>";
//		        	} else {
//		        		echo "<li><a href='header.php'>PLAYGROUND</a></li>";
//                        echo "<li><a href='profile/profile.php'>HOME</a></li>";
//		        		echo "<li><a href='signout.php'>SIGN OUT</a></li>";
//		        	}
//		        ?>
<!--		        <!-- <li><a href="login.php">SIGN IN</a></li>-->
<!--		        <li><a href="register.php">SIGN UP</a></li>-->
<!--		        <li><a href="##">HOME</a></li>-->
<!--		        <li><a href="##">SIGN OUT</a></li> -->-->
<!--		      </ul>-->
<!--		    </div>-->
<!--		  </div>-->
<!--		</nav>-->

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


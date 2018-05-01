<?php
    session_start();
    include("../header.php");
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
		<div class="jumbotron text-center">
		  <h1>Enjoy your life, Enjoy your food</h1>
		  <p>Search the recipe</p>
		  <form action="searchPage.php" method="post">
		    <div class="input-group">
                <input type="hidden" name="search_post" value="true">
<!--                <input type="checkbox" name="Breakfast" value="Breakfast" checked="checked" /> Breakfast-->
<!--                <input type="checkbox" name="Lunch" value="Lunch" checked="checked" /> Lunch-->
<!--                <input type="checkbox" name="Dinner" value="Dinner" checked="checked" /> Dinner-->
<!--                <input type="checkbox" name="Dessert" value="Dessert" checked="checked" /> Dessert-->
                <input type="text" class="form-control" name="search_string" size="50" placeholder="What do you want to know?" required>
		      <div class="input-group-btn">
		        <input type="submit" class="btn btn-danger" value="Search">
		      </div>
		    </div>
		  </form>
		</div>
	</div>
    <?php
    require_once('../script/db/db_connect.php');
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $search = "";
        $logInFlag = false;
        $postUser = "";
        if(isset($_SESSION['login_user'])) {
            $logInFlag = true;
            $postUser = $_SESSION['login_user'];
        }
        if(isset($_POST["search_string"])) {
            $search = $_POST["search_string"];
        }
        $lunch = false;
        $breakfast = false;
        $dinner = false;
        $dessert = false;
        $searchEngine = new SearchEngineForCook();
        $query = $searchEngine->searchByQuery($search);
        $querySize = count($query);
        $searchQuery = "title LIKE '%$query[0]%'";
        $searchQuery = $searchQuery." OR Content LIKE '%$query[0]%'";
        $searchQuery = $searchQuery." OR tag LIKE '%$query[0]%'";
        $searchQuery = $searchQuery." OR Category LIKE '%$query[0]%'";
        for($y = 1; $y < $querySize; $y++) {
            $searchQuery = $searchQuery . " OR title LIKE '%$query[$y]%'";
            $searchQuery = $searchQuery . " OR Content LIKE '%$query[$y]%'";
            $searchQuery = $searchQuery . " OR tag LIKE '%$query[$y]%'";
            $searchQuery = $searchQuery . " OR Category LIKE '%$query[$y]%'";
        }
        $searchResult = $searchEngine->generateSearchResult($searchQuery, $dbc,$query);
        if(count($searchResult) == 0) {
            echo "<p>Nothing inside</p>";
        }
        foreach ($searchResult as $curRes) {
            echo "<li class=\"list-group-item\">
                       <h3>".$curRes['title']."</h3>
                       <p>".$curRes['postDate']."</p>
                       <p>".$curRes['Content']."</p>";
            if($logInFlag) {
                $vote = $curRes['vote'];
                echo "<p><a href='/search/searchPage.php?button_vote=".$row["postId"]."&vote=".$vote."\'>Vote</a></p>";
                $user2Id = $curRes['userId2'];
                follow($dbc,$postUser,$user2Id);
                echo "<p><a href=\"/profile/otherUserProfile.php??userId=".$curRes['userId2']."\">View the author profile</a></p>";
                echo "<p><a href=\"/profile/addTag.php?postId=".$curRes['postId']."\">Add to favorite</a></p>";
            }
            echo "</li>";
        }
        if($_SERVER["REQUEST_METHOD"] == "GET") {
            echo "detect get";
            if(isset($_GET["vote"])) {
                $vote = $_GET["vote"];
                $postId = $_GET["button_vote"];
                updateVote($dbc, $postId, $vote);
            }
            if(isset($_GET["button_follow"])) {
                $user2Id = $_GET["button_follow"];
                followPeople($dbc,$postUser, $user2Id);
            }
        }

        mysqli_close($dbc);
    }
    ?>
</body>



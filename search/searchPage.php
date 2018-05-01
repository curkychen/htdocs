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
                echo "<p><a href='/search/searchPage.php?button_vote=".$curRes['postId']."&vote=".$vote."\'>Vote</a></p>";
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
    function updateVote($dbc, $postId, $vote) {
        $vote = $vote + 1;
        echo $vote;
        echo $postId;
        $sql2 = "update posts set votes = ".$vote." where postId = \"".$postId."\"";
        $result2 = @mysqli_query($dbc, $sql2);
        if(!$result2) {
            echo "error in query2_vote";
            $postErr =  "<h1>" . mysqli_error($dbc) . "</h1>";
            echo $postErr;
            exit();
        }
        $page = 'searchPage.php';
        $url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
        $url = rtrim($url, '/\\');
        $url .= '/' . $page;
        header("Location: $url");
    }
    function follow($dbc, $postUser, $user2Id){
//    $sql3 = "select * from user_posts where postId = ".$postId."left join follow on follow.userId1 = ".$postUser." and follow.userId2 = user_posts.userId";
        $sql3 = "select * from follow where userId1 = ".$postUser." and userId2 = ".$user2Id;
        $result3 =  @mysqli_query($dbc, $sql3);
        if(!$result3) {
            echo "error in query3_checkFollow";
            $postErr =  "<h1>" . mysqli_error($dbc) . "</h1>";
            echo $postErr;
            exit();
        }
        if(mysqli_num_rows($result3) == 0) {
//        echo "<button id=\"btnfun2\" name=\"btnfun2\" onClick='location.href=\"?button_follow".$user2Id."=1\"'>Follow the Author</button>";
            echo "<p><a href='/profile/generalRecommendation.php?button_follow=".$user2Id."'></a></p>";
        }
    }
    function followPeople($dbc, $postUser, $user2Id) {
        $sql4 = "insert into follow (userId1, userId2) values (".$postUser.",".$user2Id.")";
        $result4 = @mysqli_query($dbc, $sql4);
        if(!$result4) {
            echo "error in query4_start_follow";
            $postErr =  "<h1>" . mysqli_error($dbc) . "</h1>";
            echo $postErr;
            exit();
        }
        $page = 'searchPage.php';
        $url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
        $url = rtrim($url, '/\\');
        $url .= '/' . $page;
        header("Location: $url");
    }
    ?>
</body>


